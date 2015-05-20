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

define('GHCP_PLUGIN_PATH', '/usr/local/cpanel/base/frontend/paper_lantern/github_for_cpanel/');

// Include application class
require_once( GHCP_PLUGIN_PATH . 'inc/Application.live.php' );

// Init app
$app = new GHCP\Application();

// Output header, connect
$app->start();
?>

	<form class="layout-medium">
		<div class="form-group">
			<div class="row">
				<div class="col-xs-12">
					<label for="provider-github">Please select a Git repo provider.</label>
				</div>
				<div class="col-xs-12">
					<div class="radio">
						<label>
							<input type="radio" name="provider" id="provider-github" value="github" checked>
							<span>GitHub</span>
						</label>
					</div>
					<div class="radio">
						<label>
							<input type="radio" name="provider" id="provider-custom" value="custom" disabled>
							<span>Custom Provider</span>
						</label>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<label for="repository">Repository Name</label>
				</div>
				<div class="col-xs-12">
					<div class="input-group">
						<input type="text" placeholder="user/repository" class="form-control" id="repository">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<label for="branch">Branch</label>
				</div>
				<div class="col-xs-12">
					<div class="input-group">
						<input type="text" placeholder="master" class="form-control" id="branch">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<label for="install-opt-composer">Installation Options</label>
				</div>
				<div class="col-xs-12">
					<div class="checkbox">
						<input type="checkbox" id="install-opt-composer">
					</div>
				</div>
			</div>
		</div>
	</form>

<?php
// Output footer, disconnect
$app->stop();

// End of file index.php