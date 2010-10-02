<?php
/**
 * Class collecting release information
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
 * @version    CVS: $Id: Release.php,v 1.5 2006/01/25 21:16:34 hholzgra Exp $
 * @link       http://pear.php.net/package/CodeGen
 */

/**
 * Class collecting release information
 *
 * This class wraps up the functionality needed for the 
 * command line script. 
 *
 * @category   Tools and Utilities
 * @package    CodeGen
 * @author     Hartmut Holzgraefe <hartmut@php.net>
 * @copyright  2005 Hartmut Holzgraefe
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version    Release: @package_version@
 * @link       http://pear.php.net/package/CodeGen
 */
class CodeGen_Release 
{
    /**
     * The current version number 
     *
     * @access private
     * @var     string
     */
    protected $version = "0.0.1";
    
    /**
     * Set method for version number
     *
     * @access public
     * @param  string version
     * @return bool   true on success
     */
    function setVersion($version) 
    {
        // TODO check format
        $this->version = $version;
        
        return true;
    }
    
    /**
     * version getter
     *
     * @access public
     * @return string
     */
    function getVersion()
    {
        return $this->version;
    }



    /**
     * The release date
     *
     * @access private
     * @var     string
     */
    protected $date = "";
    
    /**
     * Set method for release date
     *
     * @access public
     * @param  int    timestamp
     * @return bool   true on success
     */
    function setDate($date)
    {
        if (!is_numeric($date)) {
            $date = strtotime($date);
        }

        // TODO check valid dates
        $this->date = $date;
        
        return true;
    }
    

    /**
     * date getter
     *
     * @access public
     * @return int 
     */
    function getDate()
    {
        return $this->date;
    }





    /**
     * The 'state': alpha, beta, stable, devel ...
     *
     * @access private
     * @var     string
     */
    protected $state = "devel";
    
    /**
     * Set method for state
     *
     * @access public
     * @param  string state
     * @return bool   true on success
     */
    function setState($state)
    {
        switch ($state) {
            case "alpha":
            case "beta":
            case "stable":
            case "snapshot":
            case "devel":
                $this->state = $state;
                return true;

            default:
                return PEAR::raiseError("'$state' is not a valid release state'");
        }
    }

    /**
     * state getter
     *
     * @access public
     * @return string
     */
    function getState()
    {
        return $this->state;
    }





    /**
     * Release notes
     *
     * @access private
     * @var     string
     */
    protected $notes = "";


    /**
     * Set method for release notes
     *
     * @access public
     * @param  string release notes
     * @return bool   true on success
     */
    function setNotes($notes)
    {
        $this->notes = $notes;
        
        return true;
    }
    
    /**
     * notes getter
     *
     * @access public
     * @return string
     */
    function getNotes()
    {
        return $this->notes;
    }

    



    /**
     * Constructor
     *
     * @access public
     */
    function __construct()
    {
        $this->date = time();
    }

}

?>
