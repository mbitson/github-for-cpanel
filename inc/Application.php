<?php
/**
 * Application Class File
 * PHP Version 5
 * @category cPanel
 * @package  cPanel.Plugin
 * @author   NeXt I.T. - Mikel Bitson <me@mbitson.com>
 * @license  http://opensource.org/licenses/MIT	MIT License
 * @link     http://github-for-cpanel.mbitson.com
 */
namespace GHCP;

/**
 * Application Class File
 * PHP Version 5
 * Date: 5/19/2015
 * @category cPanel
 * @package  cPanel.Plugin
 * @author   NeXt I.T. - Mikel Bitson <me@mbitson.com>
 * @license  http://opensource.org/licenses/MIT	MIT License
 * @link     http://github-for-cpanel.mbitson.com
 */
class Application 
{
	/**
	 * @var \Github\Client Will contain the (KNPLabs) GitHub API client when loaded.
	 */
	protected $_github;

	/**
	 * Initialize GitHub for Cpanel Application
	 */
	public function __construct()
	{
		// Include composer autoloader.
		require_once 'vendor/autoload.php';
	}

	public function github()
	{
		// Initialize github api into protected property.
		$this->_github = new \Github\HttpClient\CachedHttpClient();

		// Configure cache for this github instance to avoid rate limit hits.
		$this->_github->setCache(
			new \Github\HttpClient\Cache\FilesystemCache('/tmp/github-api-cache')
		);

	}
}
