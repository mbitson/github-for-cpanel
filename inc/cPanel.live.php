<?php
/**
 * cPanel Integration Class File
 * PHP Version 5
 * @author   NeXt I.T. - Mikel Bitson <me@mbitson.com>
 * @license  http://opensource.org/licenses/MIT	MIT License
 * @link     http://github-for-cpanel.mbitson.com
 */
namespace GHCP;

// Require the cpanel class to be loadable to integrate.
require_once("/usr/local/cpanel/php/cpanel.php");

/**
 * cPanel Integration Class
 * Date: 5/19/2015
 * @author   NeXt I.T. - Mikel Bitson <me@mbitson.com>
 * @license  http://opensource.org/licenses/MIT	MIT License
 * @link     http://github-for-cpanel.mbitson.com
 */
class cPanel
{
    public static function userdata()
    {
        // Init a cpanel instnace.
        $cpanel = new \CPANEL();
        return $cpanel->uapi(                // Get domain user data.
            'DomainInfo', 'domains_data',
            array(
                'format'    => 'hash',
            )
        );
    }
}