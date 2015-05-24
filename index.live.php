<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);
/**
 * Created by PhpStorm.
 * PHP Version 5
 * @author   NeXt I.T. - Mikel Bitson <me@mbitson.com>
 * @license  http://opensource.org/licenses/MIT	MIT License
 * @link     http://github-for-cpanel.mbitson.com
 * Date: 5/19/2015
 */

// Default plugin path
define('GHCP_PLUGIN_PATH', '/usr/local/cpanel/base/frontend/paper_lantern/github_for_cpanel/');

// Include the composer autoloader
require_once( GHCP_PLUGIN_PATH . 'vendor/autoload.php' );

// Init our plugin
$plugin = new GHCP\Plugin();

// Output header, connect, page, footer, disconnect
$plugin->run();

// End of file index.php