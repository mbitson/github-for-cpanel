<?php
/**
 * Router Class File
 * PHP Version 5
 * @author   NeXt I.T. - Mikel Bitson <webprojects@next-it.net>
 * @license  http://opensource.org/licenses/MIT	MIT License
 * @link     http://www.next-it.net/
 */

namespace GHCP;

/**
 * Router Class
 * This class is used to route the request to the proper template.
 * @author   NeXt I.T. - Mikel Bitson <webprojects@next-it.net>
 * @license  http://opensource.org/licenses/MIT	MIT License
 * @link     http://www.next-it.net/
 */
class Router
{

	/**
	 * @var string The default template to load up for this route
	 */
	private $_default_route = 'application-list';

    /**
     * @var string The template directory to load from
     */
    private $_template_dir;

    /**
     * @var array Userdata from cpanel live php api
     */
    public $cpanel_userdata;

    /**
     * @var array Contains the routes for this particular system
     */
    private $_routes = array(
        'GET' => array(
            'application-create' => 'Application::create',
            'application-list' => 'Application::apps',
            'application-delete' => 'Application::delete',
            'application-deploy' => 'Application::deployByKey',
        ),
        'POST' => array(
            'application-create' => 'Application::save',
        ),
        'ANY'   => array(
        ),
    );

    /**
     * @var array Contains the data to be used in the view
     */
    private $_view_data;

    /**
     * Function to set default template directory
     */
    public function __construct()
    {
        // Set default template directory
        $this->_template_dir = GHCP_PLUGIN_PATH . 'templates/';
    }

	/**
	 * Function to determine path and render.
	 * @return void
	 */
	public function route($path = NULL, $requestMethod = NULL)
	{
        // If a path is not passed
        if(is_null($path))
        {
            // Get the current path from $_GET or property
            $path = (isset($_GET['route'])?$_GET['route']:$this->_default_route);
        }

        // If the request method was not passed.
        if(is_null($requestMethod))
        {
            // Determine the request method
            if(in_array($_SERVER['REQUEST_METHOD'],array_keys($this->_routes)))
            {
                // Set the request method
                $requestMethod = $_SERVER['REQUEST_METHOD'];
            }

            // Else set the request method default
            else
            {
                // To any
                $requestMethod = 'ANY';
            }
        }

        // Determine if we have php to fire for this route
        if(in_array($path, array_keys($this->_routes[$requestMethod])))
        {
            // Get the string to fire
            $toExecute = $this->_routes[$requestMethod][$path];

            // Explode on ::
            $executePieces = explode('::', $toExecute);

            // Add namespace to class piece.
            $executePieces[0] = '\GHCP\\'.$executePieces[0];

            // Init new object
            $obj = new $executePieces[0]();

            // Fire method suggested
            $this->_view_data = $obj->{$executePieces[1]}();
        }

		// Render this route.
		$this->render($path);
	}

    /**
     * @param $path The template to load from the template directory.
     */
	public function render($path)
	{
        // All templates utilize .php
        $path .= '.php';

        // Set data var for the view
        $data = $this->_view_data;

        // Set cpanel userdata for view
        $userdata = $this->cpanel_userdata;

        // If data allows rendering...
        if($data !== FALSE)
        {
            // If the file exists
            if(file_exists( $this->_template_dir . $path ))
            {
                // Start stream buffering
                ob_start();

                // Include the template file
                include( $this->_template_dir . $path );

                // Get the output source
                $source = ob_get_clean();
            }

            // Else, if no template file is found
            else
            {
                // Set default source code
                $source = '<div style="margin: 100px auto;"><strong>No template file found.</strong><br />Attempted To Load: ' . $this->_template_dir . $path . '</div>';
            }

            // Output source code
            echo $source;
        }
	}
}