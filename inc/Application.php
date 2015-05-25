<?php
/**
 * Application Class File
 * PHP Version 5
 * @author   NeXt I.T. - Mikel Bitson <me@mbitson.com>
 * @license  http://opensource.org/licenses/MIT	MIT License
 * @link     http://github-for-cpanel.mbitson.com
 */
namespace GHCP;

/**
 * Application Class
 * Date: 5/19/2015
 * @author   NeXt I.T. - Mikel Bitson <me@mbitson.com>
 * @license  http://opensource.org/licenses/MIT	MIT License
 * @link     http://github-for-cpanel.mbitson.com
 */
class Application
{
    /**
     * @var string Tthe key that identifies this application.
     */
    public $key;

    /**
     * @var string The directory to install this repo to.
     */
    public $directory;

    /**
     * @var string The branch to checkout.
     */
    public $branch;

    /**
     * @var string The repo name to install (user/repo)
     */
    public $repo;

    /**
     * @var string Rather or not to install composer dependencies.
     */
    public $composer;

    /**
     * @var string Rather or not this repo is private and should use ssh.
     */
    public $private;

    /**
     * @var string The directory applications are installed to.
     */
    private $_application_dir;

    /**
     * Function to set default applications directory
     */
    public function __construct()
    {
        // Set default template directory
        $this->_application_dir = GHCP_PLUGIN_PATH . 'applications/';
    }

    /**
     * Function to load a list of applications and present them to the view.
     * @return array Data array for view that contains app list
     */
    public function apps()
    {
        // Get global userdata
        global $userdata;

        // Load list of applications for this particular user.
        $apps = glob( $this->_application_dir . $userdata['user'] . '-*.json' );

        // If we found apps
        if(!empty($apps))
        {
            // Cleanup on each app
            foreach($apps as &$app)
            {
                // Remove the path from string
                $app = file_get_contents($app);

                // Remove the .json from string
                $app = json_decode($app);
            }

            // Return for view
            return array('apps'=>$apps);
        }

        // If we found no apps...
        else
        {
            // Alert the user that they must create an appliction
            $this->alert('No applications found for your cPanel user. Please create one below.');

            // Get router for routing to the create page
            $router = new \GHCP\Router();

            // Route to the create page
            $router->route('application-create');

            // Return false to prevent view on current router instance
            return false;
        }
    }

    /**
     * A function to load in data for a particular key.
     * @param $key The key to load data for.
     * @return $this This object with loaded data from the key.
     */
    public function load($key)
    {
        // Load data from json file
        $data = file_get_contents($this->_application_dir . $key . '.json');

        // Json decode string into array
        $data = (array) json_decode($data);

        // Set data onto app
        $this->setData($data);

        // Return loaded application
        return $this;
    }

    /**
     * Attempts to fill all public properties with values from passed array.
     * @param array $data Array of data to set on this object.
     */
    public function setData(array $data)
    {
        // Get public (fillable) properties
        $properties = array_keys(get_object_vars($this));

        // For each of the properties...
        foreach($properties as $property)
        {
            // If the passed data has this property...
            if(in_array($property, array_keys($data)))
            {
                // Set this value
                $this->{$property} = $data[$property];
            }
        }
    }

    public function create()
    {
        // Return the data for the form view
        return array('test'=>'test');
    }

    /**
     * Function that will set passed data and post data to object and then store.
     * @param null $data Array of data to set on new object
     * @return false
     */
    public function save($data = NULL)
    {
        // Set post data onto object
        if(!empty($_POST)){
            $this->setData($_POST);
        }

        // Set passed data onto object
        if(!is_null($data) && !empty($data)){
            $this->setData($data);
        }

        // Get the username
        global $userdata;

        // Set this key
        $this->key = str_replace('/', '-', $userdata['user'].'-'.$this->repo);

        // Save properties to json file
        $this->store();

        // Setup this instance!
        $this->setup();

        // Route to list page.
        $router = new \GHCP\Router();
        $router->route('application-list', 'GET');

        // Return false to prevent this router from rendering
        return FALSE;
    }

    /**
     * Function to save this model as a json file based on key.
     */
    public function store()
    {
        // Open an application file based on key
        $applicationFile = fopen( $this->_application_dir . $this->key . '.json', "w")
            or die("Unable to open file! ".$this->key.'.json');

        // Write our json into
        fwrite($applicationFile, json_encode($this));

        // Close write con
        fclose($applicationFile);
    }

    public function delete()
    {
        // Attempt to get a key from query string
        if(isset($_GET['key']) && is_numeric((int)$_GET['key']))
        {
            // Store the key
            $key = $_GET['key'];
        }

        // Else throw an error!
        else
        {
            // Display not allowed, return false to prevent view
            echo "<h2>Not Allowed.</h2>";
            return false;
        }

        // Delete the file for this key
        if(unlink($this->_application_dir . $key . '.json'))
        {
            // Display the success
            $this->alert('Application Deleted Successfully! You will need to manually remove or replace the files the application installed.');
        }

        // If the file couldn't be deleted...
        else
        {
            // Alert the user with a warning, couldn't delete
            $this->warning( 'Your application file could not be deleted. Please delete it manually with one of the following commands: <br/>
                <strong>rm -f ' . $this->_application_dir . $this->key . '.json' . '</strong><br />
                <strong>sudo rm -f ' . $this->_application_dir . $this->key . '.json' . '</strong>' );
        }

        // Reroute to list page
        $router = new \GHCP\Router();
        $router->route('application-list');

        // Return false to prevent this view from being rendered
        return false;
    }

    /**
     * Function to do initial installation of this application.
     * @return void
     */
    public function setup()
    {
        // Make userdata accessable
        global $userdata;

        // Get deployment path
        $deploymentPath = $userdata['homedir'].'/'.$this->directory;

        // Delete current contents of dir
        $this->deleteDirectory( $deploymentPath );

        // Create empty folder for repo
        mkdir($deploymentPath);

        // If private repo
        if(isset($_POST['private']) && $_POST['private'] === 'on')
        {
            // Add deploy key to github account
            $privateKey = $this->addGithubDeployKey();

            // Checkout github repo to deployment path with ssh
            shell_exec("ssh-agent bash -c 'ssh-add $privateKey; /usr/bin/git clone git@github.com:$this->repo.git $deploymentPath'");
        }

        // If public repo
        else
        {
            // Checkout github repo to deployment path
            shell_exec('/usr/bin/git clone https://github.com/'.$this->repo.'.git '.$deploymentPath);
        }

        // Change directory to deployment path to operate on repo
        chdir($deploymentPath);

        // Checkout the specified branch
        shell_exec('/usr/bin/git checkout '.$this->branch);

        // If composer dependencies are set to yes
        if($this->composer === 'on' && chdir($deploymentPath))
        {
            // Run composer update
            shell_exec('/usr/local/bin/php '.GHCP_PLUGIN_PATH.'composer.phar update');
        }


        // later - install the deploy script
        // later - setup github hook to point to deploy script

        // Alert the user that this worked!
        $this->alert('Your repo has been checked out successfully! You may now use the deploy button to automatically checkout the latest changes for this application.');
    }

    /**
     * A function to deploy this application.
     * Assumes setup() was already run on this application.
     * @return void
     */
    public function deploy()
    {
        // Make userdata accessable
        global $userdata;

        // Get deployment path
        $deploymentPath = $userdata['homedir'].'/'.$this->directory;

        // Change directory to deployment path to operate on repo
        chdir($deploymentPath);

        // Update this git repo
        shell_exec('/usr/bin/git pull');

        // If composer dependencies are set to yes
        if($this->composer === 'on')
        {
            // Run composer update
            shell_exec('/usr/local/bin/php composer.phar update');
        }

        // Alert success
        $this->alert('Successfully deployed '.$this->key.'!');
    }

    public function deployByKey()
    {
        // Attempt to get a key from query string
        if(isset($_GET['key']) && is_numeric((int)$_GET['key']))
        {
            // Store the key
            $key = $_GET['key'];
        }

        // Else throw an error!
        else
        {
            // Display not allowed, return false to prevent view
            echo "<h2>Not Allowed.</h2>";
            return false;
        }

        // Load this application's data
        $this->load($key);

        // Deploy this application
        $this->deploy();

        // Reroute to list page
        $router = new \GHCP\Router();
        $router->route('application-list');

        // Return false to prevent this view
        return FALSE;
    }

    public function deleteDirectory($dir) {
        if (!file_exists($dir)) {
            return true;
        }

        if (!is_dir($dir)) {
            return unlink($dir);
        }

        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }

            if (!$this->deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }

        }

        return rmdir($dir);
    }

    public function addGithubDeployKey()
    {
        // Determine public and private key paths
        $privateKey = GHCP_PLUGIN_PATH.'ssh/'.$this->key;
        $publicKey = GHCP_PLUGIN_PATH.'ssh/'.$this->key.'.pub';

        // If an old private key exists
        if(file_exists($privateKey))
        {
            // Delete it
            unlink($privateKey);
        }

        // If an old public key exists
        if(file_exists($publicKey))
        {
            // Delete it
            unlink($publicKey);
        }

        // Generate the key pair
        shell_exec('ssh-keygen -b 2048 -t rsa -f '.$privateKey.' -q -N ""');

        // Initialize github api into protected property.
        $this->_github = new \Github\Client();

        // Login to github
        $this->_github->authenticate($_POST['gh_username'], $_POST['gh_password']);

        // Get the current user
        $currentUser = $this->_github->me();

        // Get the keys object
        $keys = $currentUser->keys();

        // Create this new key!
        $keys->create(array(
            'title'=>'GitHub for cPanel - '.$this->key,
            'key'=>file_get_contents($publicKey)
        ));

        // Return private key
        return $privateKey;
    }

    /**
     * A function to display a message to the user
     * @param $message The message to alert to the user
     */
    public function alert($message)
    {
        echo "
        <div class=\"alert alert-success alert-dismissable\">
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
            <span class=\"glyphicon glyphicon-ok-sign\"></span>
            <div class=\"alert-message\">
                <strong>Success:</strong>
                $message
            </div>
        </div>
        ";
    }

    /**
     * A function to display a warning to the user
     * @param $message The message to warn the user about
     */
    public function warning($message)
    {
        echo "
        <div class=\"alert alert-warning alert-dismissable\">
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
            <span class=\"glyphicon glyphicon-ok-sign\"></span>
            <div class=\"alert-message\">
                <strong>Warning:</strong>
                $message
            </div>
        </div>
        ";
    }
}
