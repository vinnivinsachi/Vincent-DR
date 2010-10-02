<?php
/**
 * Output buffer handling class
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
 * @version    CVS: $Id: Outbuf.php,v 1.4 2006/02/02 22:00:57 hholzgra Exp $
 * @link       http://pear.php.net/package/CodeGen
 */

/**
 * Includes
 */
require_once "CodeGen/Tools/Indent.php";
require_once "CodeGen/Tools/FileReplacer.php";

/**
 * Output buffer handling class
 *
 * Helper class that starts output buffering and writes the collected
 * output to a file later. Tab and line ending conversions may be 
 * applied to the collected output.
 *
 * @category   Tools and Utilities
 * @package    CodeGen
 * @author     Hartmut Holzgraefe <hartmut@php.net>
 * @copyright  2005 Hartmut Holzgraefe
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version    Release: @package_version@
 * @link       http://pear.php.net/package/CodeGen
 */
class CodeGen_Tools_Outbuf
{
    /**
     * Output path to write to
     *
     * @var  string
     */
    private $path = "";

    /**
     * Output modification flags 
     *
     * @var int
     */
    private $flags = 0;

    /**
     * Flag bits
     *
     */
    const OB_DOSIFY   = 1;
    const OB_TABIFY   = 2;
    const OB_UNTABIFY = 4;

    /**
     * Constructor
     *
     * @param  string  path to write to
     * @param  int     output modifier flags
     */
    function __construct($path, $flags = 0) 
    {
        $this->path = $path;

        $this->flags = $flags;

        ob_start();
    }


    /**
     * write current output buffer to file
     *
     * @param  file path
     * @param  formating flags
     * @access private
     */
    function write()                                
    {
        $stat = true;

        if ($this->path) 
        {
            $text = ob_get_clean();
            
            $fp = new CodeGen_Tools_FileReplacer($this->path);
            
            if ($this->flags && self::OB_TABIFY) {
                $text = CodeGen_Tools_Indent::tabify($text);
            } else if ($this->flags && self::OB_UNTABIFY) {
                $text = CodeGen_Tools_Indent::untabify($text);
            }
            
            if ($this->flags && self::OB_DOSIFY) {
                $text = CodeGen_Tools_Indent::tabify($text);
            }
            
            $fp->puts($text);
            $stat = $fp->close();

            $this->path = "";
        }

        return $stat;
    }
}



