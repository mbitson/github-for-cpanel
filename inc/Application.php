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
     * @var bool Rather or not to install composer dependencies.
     */
    public $composer;

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
        // Load list of applications
        $apps = glob($this->_application_dir.'*.json');

        // If we found apps
        if(!empty($apps))
        {
            // Apps found!
            $this->alert('Applications found for this cPanel account!');

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
            // Get router for routing to the create page
            $router = new \GHCP\Router();

            // Route to the create page
            $router->route('application-create');

            // Return false to prevent view on current router instance
            return false;
        }
    }

    public function load($key)
    {
        // Load an application by application key (domain-directory)
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

        // Set this key
        $this->key = str_replace('/', '-', 'domainuser-'.$this->repo);

        // Save properties to json file
        $this->store();

        // Alert the user saved correctly
        $this->alert('Your application has been created successfully!');

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
}
