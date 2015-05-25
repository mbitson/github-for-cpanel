<?php
/**
 * Created by PhpStorm.
 * User: mbitson
 * Date: 5/23/2015
 * Time: 11:00 PM
 */
?>
<div class="callout callout-warning">
    This plugin is in an early stage and utilizing it <strong>will completely delete your current web files</strong> within the directory specified for application installation. Only use this for new accounts- do not use this on sites that are already working. <strong>Backup EVERYTHING.</strong>
</div>
<ol class="breadcrumb">
    <li>
        <a href="#">
            <span class="glyphicon glyphicon-home"></span>
            <span>cPanel</span>
        </a>
    </li>
    <li><a href="index.live.php">Github Integration</a></li>
    <li class="active"><a href="index.live.php?route=application-list">Applications</a></li>
</ol>
<div class="row">
    <div class="col-xs-12">
        <a href="index.live.php?route=application-create" class="btn btn-primary">Create New Application</a>
    </div>
</div>
<div ng-controller="applicationCtrl" class="list-container">
    <table class="table table-striped responsive-table">
        <thead>
        <tr>
            <th class="checkColumn">
                <div class="btn-group checkbox-group">
                        <span class="btn check-box">
                            <input type="checkbox" id="selectAll"
                                   title="Select all employees on this page.">
                        </span>
                    <button type="button" class="btn btn-default">
                        <span class="caret"></span>
                        <span class="sr-only">Checkbox Options</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Clear all selections</a></li>
                    </ul>
                </div>
            </th>
            <th>
                    <span toggle-sort id="sortFirstName" sort-meta="meta"
                          sort-field="firstName"
                          onSort="sortList">
                        Application Key
                    </span>
            </th>
            <th>
                    <span toggle-sort id="sortLastName" sort-meta="meta"
                          sort-field="lastName"
                          onSort="sortList">
                        Directory
                    </span>
            </th>
            <th>
                    <span toggle-sort id="sortLastName" sort-meta="meta"
                          sort-field="lastName"
                          onSort="sortList">
                        Repo
                    </span>
            </th>
            <th>
                    <span toggle-sort id="sortLastName" sort-meta="meta"
                          sort-field="lastName"
                          onSort="sortList">
                        Branch
                    </span>
            </th>
            <th>
                    <span toggle-sort id="sortLastName" sort-meta="meta"
                          sort-field="lastName"
                          onSort="sortList">
                        Composer
                    </span>
            </th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php if(!empty($data['apps'])): ?>
        <?php foreach($data['apps'] as $app): ?>
            <tr>
                <td class="checkColumn">
                    <input type="checkbox"
                           title="Select this application.">
                </td>
                <td data-title="Application Key"><?php echo $app->key; ?></td>
                <td data-title="Directory"><?php echo $app->directory; ?></td>
                <td data-title="Repo"><?php echo $app->repo; ?></td>
                <td data-title="Branch"><?php echo $app->branch; ?></td>
                <td data-title="Composer"><?php echo $app->composer; ?></td>
                <td data-title="">
                    <a href="index.live.php?route=application-deploy&key=<?php echo $app->key; ?>" class="btn btn-link">
                        <span class="fa fa-upload"></span>
                        Deploy
                    </a>
                    <a href="index.live.php?route=application-delete&key=<?php echo $app->key; ?>" class="btn btn-link">
                        <span class="glyphicon glyphicon-trash"></span>
                        Delete
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>