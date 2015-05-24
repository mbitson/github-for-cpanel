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
                $app = str_replace($this->_application_dir, '', $app);

                // Remove the .json from string
                $app = str_replace('.json', '', $app);
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

    public function setData(array $data)
    {
        // Set an array of data onto this object
    }

    public function create()
    {
        // Return the data for the form view
        return array('test'=>'test');
    }

    public function save()
    {
        // Save properties to json file
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
