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
	private $_default_route = 'application-create';

    /**
     * @var string The template directory to load from
     */
    private $_template_dir;

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
	public function route()
	{
		// Get the current path from $_GET or property
		$path = (isset($_GET['route'])?$_GET['route']:$this->_default_route);

		// Render this route.
		$this->render($path);
	}

    /**
     * @param $path The template to load from the template directory.
     */
	public function render($path)
	{
        // If the file exists
        if(file_exists( $this->_template_dir . $path ))
        {
            // Get the template file's source
            $source = file_get_contents( $this->_template_dir . $path );
        }

        // Else, if no template file is found
        else
        {
            // Set default source code
            $source = '<div style="margin: 100px auto;">No template file found.<br />Attempted To Load: ' . $path . '</div>';
        }

        // Output source code
        echo $source;
	}

}