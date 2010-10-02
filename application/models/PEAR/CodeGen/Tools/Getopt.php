<?php
/**
 * A more convenient command line argument parser class
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
 * @copyright  2003-2005 Hartmut Holzgraefe
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version    CVS: $Id: Getopt.php,v 1.3 2006/02/17 09:47:00 hholzgra Exp $
 * @link       http://pear.php.net/package/CodeGen
 */

/**
 * includes
 */
require_once "Console/Getopt.php";

/**
 * A more convenient command line argument parser class
 *
 * @category   Tools and Utilities
 * @package    CodeGen
 * @author     Hartmut Holzgraefe <hartmut@php.net>
 * @copyright  2005 Hartmut Holzgraefe
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version    Release: @package_version@
 * @link       http://pear.php.net/package/CodeGen
 */
class CodeGen_Tools_Getopt 
    extends Console_Getopt
{
    /**
     * Internal storage for parsed arguments
     *
     * @access private
     * @var    array
     */
    private $options = array();

    /**
     * Constructor will parse specified short and long arguments
     *
     * @access public
     * @param  string   short options specification
     * @param  array    long options specification
     * @param  callback error callback, call this and exit on errors if given
     */
    function __construct ($short_options, $long_options = NULL, $usage = NULL)
    {
        // use parent methods for actual parsing, store result internaly
        $argv = parent::readPHPArgv();
        $this->options = parent::getopt($argv, $short_options, $long_options);
        if (PEAR::isError($this->options)) {
            if (!is_null($usage) && is_callable($usage)) {
                call_user_func($usage, $this->options->message);
                exit(3);
            }
        }
    }
    
    /**
     * Check if any of the specified options was given
     *
     * @access public
     * @param  string a short or long option name
     * @param  ...
     * @return bool   true if anything found else false
     */
    function have($name /*, ... */)
    {
        // foreach argument
        foreach (func_get_args() as $arg) {
            // short or long option?
            switch (strlen($arg)) {
            case 0: 
                continue(2);
            case 1:
                $arg = "$arg";
                break;
            default:
                $arg = "--$arg";
                break;
            }

            // search given command line options
            foreach ($this->options[0] as $opt) {

                // found?
                if ($opt[0] == $arg) {
                    return true;
                }
            }
        }

        // nothing found
        return false;
    }


    /**
     * Check if all of the specified options were given
     *
     * @access public
     * @param  string a short or long option name
     * @param  ...
     * @return bool   true if all found else false
     */
    function haveAll($name /*, ... */)
    {
        // foreach argument
        foreach (func_get_args() as $name) {
            // short or long option?
            switch (strlen($name)) {
            case 0: 
                continue(2);
            case 1:
                $name = "-$name";
                break;
            default:
                $name = "--$name";
                break;
            }

            // check for this option
            $found = false;
            foreach ($this->options[0] as $opt) {
                if ($opt[0] == $name) {
                    $found = true;
                }
            }

            // not found? -> all fails
            if (!$found) {
                return false;
            }
        }

        // all passed
        return true;
    }

    /**
     * Get argument value for an option
     *
     * @access public
     * @param  string $name
     * @return string option value or true for options without argument
     */
    function value($name, $name2 = false)
    {
        foreach (func_get_args() as $name) {
            switch (strlen($name)) {
            case 0: 
                return false;
            case 1:
                $name = "-$name";
                break;
            default:
                $name = "--$name";
                break;
            }
            
            foreach ($this->options[0] as $opt)
            {
                if ($opt[0] == $name) {
                    return is_null($opt[1]) ? true : $opt[1]; 
                }
            }
        }

        // not found
        return false;
    }

    /**
     * Get all given option names
     *
     * @access public
     * @return array  an array of option names
     */
    function options()
    {
        $names = array();
        foreach ($this->options [0] as $opt) {
            $names[] = preg_replace("|^-*|", "", $opt[0]);
        }

        return $names;
    }

    /** 
     * Get all additional arguments not bound to options
     *
     * @access public
     * @return array  an array of argument string values
     */
    function arguments()
    {
        $names = array();
        foreach ($this->options[1] as $arg) {
            $names[] = $arg;
        }

        return $names;
    }

}
?>