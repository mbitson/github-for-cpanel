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

	public function render($path)
	{
		echo include()
	}

}