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

// Include the composer autoloader & live.php file for integration
require_once( GHCP_PLUGIN_PATH . 'vendor/autoload.php' );

// I would like to do this in a better way...
// but for now I've got to load in the cPanel
// userdata in a .live.php file and make it
// globally accessible.
// Save user's data to the global var
require_once("/usr/local/cpanel/php/cpanel.php");

// Create new cpanel object to integrate.
$cpanel = new \CPANEL();

// Request this user's domain info.
$userdata = $cpanel->uapi(                // Get domain user data.
    'DomainInfo', 'domains_data',
    array(
        'format'    => 'hash',
    )
);

// Select only the main domain
$userdata = $userdata['cpanelresult']['result']['data']['main_domain'];

// Init our plugin
$plugin = new GHCP\Plugin($cpanel);

// Output header, connect, page, footer, disconnect
$plugin->run();

// End of file index.php