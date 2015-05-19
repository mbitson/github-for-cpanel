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

// Include application class
require_once('inc/Application.php');

// Init app
$app = new GHCP\Application();

// Output header, connect
$app->start();
?>

	<p>Hello World!</p>

<?php
// Output footer, disconnect
$app->stop();

// End of file index.php