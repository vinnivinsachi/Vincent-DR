<?php
/**
 * A helper class for platform management
 *
 * PHP versions 5
 *
 * LICENSE: This source file is subject to version 3.0 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_0.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category   Tools and Utilities
 * @package    CodeGen
 * @author     Hartmut Holzgraefe <hartmut@php.net>
 * @copyright  2005 Hartmut Holzgraefe
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version    CVS: $Id: Platform.php,v 1.3 2006/01/25 21:16:34 hholzgra Exp $
 * @link       http://pear.php.net/package/CodeGen
 */

/**
 * A helper class for platform management
 *
 * @category   Tools and Utilities
 * @package    CodeGen
 * @author     Hartmut Holzgraefe <hartmut@php.net>
 * @copyright  2005 Hartmut Holzgraefe
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version    Release: @package_version@
 * @link       http://pear.php.net/package/CodeGen
 */
class CodeGen_Tools_Platform
{
    /**
     * The supported platforms are collected here
     *
     * @access private
     * @var    array   the platform short names
     */
    protected $platforms = array();

    /**
     * Constructor gets a list of names or "all"
     *
     * @access public
     * @param  string|array names as comma separated string or array
     */
    function __construct($names) 
    {
        if (is_string($names)) {
            $names = explode(",", $names);
        }
        
        foreach ($names as $name) {
            switch (strtolower(trim($name))) {
            case "all":
                $this->platforms["win"] = true;
                $this->platforms["unix"] = true;
                break;

            case "win":
            case "win23":
            case "windows":
            case "microsoft":
                $this->platforms["win"] = true;
                break;

            case "unix":
            case "posix":
            case "gnu":
                $this->platforms["unix"] = true;
                break;

            default:
                $this->error = PEAR::raiseError("'$name' is not a supported platform");
                break(2);
            }
        }
    }

    /**
     * Test for a platform shortname
     *
     * @access public
     * @param  string shortname
     * @return bool   true if supported else false
     */
    function test($name) 
    {
        switch (strtolower(trim($name))) {
        case "all":
            return 2 == $this->count(); 
            
        case "win":
        case "win32":
        case "windows":
        case "microsoft":
            return isset($this->platforms["win"]);
            
        case "unix":
        case "posix":
        case "gnu":
            return isset($this->platforms["unix"]);
            
        default:
            return false;
        }
    }

    /** 
     * Count the number of supported platforms
     *
     * @access public
     * @return int    platform count
     */
    function count()
    {
        return count($this->platforms);
    }
}

?>
