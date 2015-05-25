<?php
/**
 * Plugin Class File
 * PHP Version 5
 * @author   NeXt I.T. - Mikel Bitson <me@mbitson.com>
 * @license  http://opensource.org/licenses/MIT	MIT License
 * @link     http://github-for-cpanel.mbitson.com
 */
namespace GHCP;

/**
 * Plugin Class
 * Date: 5/19/2015
 * @author   NeXt I.T. - Mikel Bitson <me@mbitson.com>
 * @license  http://opensource.org/licenses/MIT	MIT License
 * @link     http://github-for-cpanel.mbitson.com
 */
class Plugin
{
	/**
	 * @var \Github\Client Will contain the (KNPLabs) GitHub API client when loaded.
	 */
	protected $_github;

	/**
	 * @var \CPANEL Will contain the cpanel client when loaded.
	 */
	protected $_cpanel;

	/**
	 * @var array Will contain the specific user's data in cpanel when loaded.
	 */
	public $cpanel_userdata;

    public function __construct(\CPANEL $CPANEL)
    {
        $this->_cpanel = $CPANEL;
    }

	/**
	 * Start cPanel integration, output header of paper lantern.
	 * @return bool Return status
	 */
	public function start()
	{
		// Print header per cpanel docs (I'd prefer echo, but will remain consistent with cPanel)
		print $this->_cpanel->header( 'GitHub' );

        print '<link rel="stylesheet" type="text/css" href="css/styles.css">';

		// Return status!
		return TRUE;
	}

	/**
	 * End cPanel integration, output footer of paper lantern and disconnect.
	 * @return bool Return status
	 */
	public function stop()
	{
		// Print the footer (I'd prefer echo, but will remain consistent with cPanel)
		print $this->_cpanel->footer();

		// Disconnect the cpanel integration instance
		$this->_cpanel->end();

		// Return status!
		return TRUE;
	}

	/**
	 * A function to run the entire app- outputs header, page, and footer.
	 * @return void
	 */
	public function run()
	{
		// Run the app, connect to cpanel, output header
		$this->start();

		// Parse the request and output the page.
		$this->page();

		// Output footer & disconnect from cpanel
		$this->stop();
	}

	public function page()
	{
		// Obtain the router class
		$router = new \GHCP\Router();

		// Fire the router class
		$router->route();
	}
}
