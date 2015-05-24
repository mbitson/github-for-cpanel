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
                        Application Name
                    </span>
            </th>
            <th>
                    <span toggle-sort id="sortLastName" sort-meta="meta"
                          sort-field="lastName"
                          onSort="sortList">
                        Last Name
                    </span>
            </th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($data['apps'] as $app): ?>
            <tr>
                <td class="checkColumn">
                    <input type="checkbox"
                           title="Select this application.">
                </td>
                <td data-title="Application Slug"><?php echo $app; ?></td>
                <td data-title="Last Name"></td>
                <td data-title="">
                    <button class="btn btn-link">
                        <span class="glyphicon glyphicon-pencil"></span>
                        Edit
                    </button>
                    <button class="btn btn-link">
                        <span class="glyphicon glyphicon-trash"></span>
                        Delete
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>