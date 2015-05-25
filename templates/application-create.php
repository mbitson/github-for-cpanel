<?php
/**
 * Created by PhpStorm.
 * User: mbitson
 * Date: 5/21/2015
 */
?>
<div class="callout callout-warning">
    This plugin is in an early stage and utilizing it <strong>will completely delete your current web files</strong> within the directory specified for application installation. Only use this for new accounts- do not use this on sites that are already working. <strong>Backup EVERYTHING.<br />Public GitHub repos only, for now.</strong>
</div>
<ol class="breadcrumb">
    <li>
        <a href="#">
            <span class="glyphicon glyphicon-home"></span>
            <span>cPanel</span>
        </a>
    </li>
    <li><a href="index.live.php">Github Integration</a></li>
    <li><a href="index.live.php?route=application-list">Applications</a></li>
    <li class="active"><a href="index.live.php?route=application-create">Create An Application</a></li>
</ol>
<form class="layout-medium application-create" action="index.live.php?route=application-create" method="post">
    <h4 class="section-heading">
        Create An Application
    </h4>
    <div class="section-body">
        <div class="form-group">
            <!--
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
            -->
            <div class="row">
                <div class="col-xs-12 col-md-4 label-cont">
                    <label for="repository">Directory To Install To</label>
                </div>
                <div class="col-xs-12 col-md-8">
                    <div class="input-group">
                        <input type="text" placeholder="public_html/" class="form-control" name="directory" id="directory">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-4 label-cont">
                    <label for="repository">Repository Name</label>
                </div>
                <div class="col-xs-12 col-md-8">
                    <div class="input-group">
                        <input type="text" placeholder="user/repository" class="form-control" name="repo" id="repo">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-4 label-cont">
                    <label for="branch">Branch</label>
                </div>
                <div class="col-xs-12 col-md-8">
                    <div class="input-group">
                        <input type="text" placeholder="master" class="form-control" id="branch" name="branch">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-4 label-cont">
                    <label for="install-opt-composer">Installation Options</label>
                </div>
                <div class="col-xs-12 col-md-8">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="composer" name="composer">
                            Install Composer Dependencies (Composer Update)
                        </label>
                    </div>
                </div>
                <div class="col-xs-12 col-md-4 label-cont">
                </div>
                <div class="col-xs-12 col-md-8">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="private" name="private">
                            This is a private repo
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-4 label-cont">
                    <label for="repository">GitHub Username</label><br />
                    <small>(Only if private repo)</small>
                </div>
                <div class="col-xs-12 col-md-8">
                    <div class="input-group">
                        <input type="text" placeholder="username" class="form-control" name="gh_username" id="gh-username">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-4 label-cont">
                    <label for="repository">GitHub Password</label><br />
                    <small>(Only if private repo)</small>
                </div>
                <div class="col-xs-12 col-md-8">
                    <div class="input-group">
                        <input type="password" class="form-control" name="gh_password" id="gh-password">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-4 label-cont">
                </div>
                <div class="col-xs-12 col-md-8">
                    <button type="submit" class="btn btn-primary">Create New Application</button>
                </div>
            </div>
        </div>
	</div>
</form>