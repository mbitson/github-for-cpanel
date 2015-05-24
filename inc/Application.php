<?php
/**
 * Application Class File
 * PHP Version 5
 * @author   NeXt I.T. - Mikel Bitson <me@mbitson.com>
 * @license  http://opensource.org/licenses/MIT	MIT License
 * @link     http://github-for-cpanel.mbitson.com
 */
namespace GHCP;

/**
 * Application Class
 * Date: 5/19/2015
 * @author   NeXt I.T. - Mikel Bitson <me@mbitson.com>
 * @license  http://opensource.org/licenses/MIT	MIT License
 * @link     http://github-for-cpanel.mbitson.com
 */
class Application
{
    /**
     * @var string Tthe key that identifies this application.
     */
    public $key;

    /**
     * @var string The directory to install this repo to.
     */
    public $directory;

    /**
     * @var string The branch to checkout.
     */
    public $branch;

    /**
     * @var string The repo name to install (user/repo)
     */
    public $repo;

    public function apps()
    {
        // Load list of applications
    }

    public function load($key)
    {
        // Load an application by application key (domain-directory)
    }

    public function setData(array $data)
    {
        // Set an array of data onto this object
    }

    public function create()
    {
        // Return the data for the form view
        return array('test'=>'test');
    }

    public function save()
    {
        // Save properties to json file
    }
}
