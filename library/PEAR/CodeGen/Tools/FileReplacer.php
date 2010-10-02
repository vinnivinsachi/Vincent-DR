<?php
/**
 * A file output class that only overwrites files on content changes
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
 * @version    CVS: $Id: FileReplacer.php,v 1.2 2005/08/14 16:47:59 hholzgra Exp $
 * @link       http://pear.php.net/package/CodeGen
 */

/**
 * A file output class that only overwrites files on content changes
 *
 * File output is first collected in a temporary file, 
 * after the output is finished the temporary file is compared
 * to the previous file (by size and md5 checksum), only when
 * changes are detected the file is replaced, else the old 
 * version is kept and the temporary file removed. This way
 * unchanged files keep their old modification date which 
 * improves "make" build times
 *
 * @category   Tools and Utilities
 * @package    CodeGen
 * @author     Hartmut Holzgraefe <hartmut@php.net>
 * @copyright  2005 Hartmut Holzgraefe
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version    Release: @package_version@
 * @link       http://pear.php.net/package/CodeGen
 */
class CodeGen_Tools_FileReplacer
{
    /**
     * output filename
     *
     * @var string
     */
    protected $fileName;

    /**
     * temporary filename
     *
     * @var string
     */
    protected $tempName;

    /** 
     * temporary file handle
     *
     * @var resource
     */
    protected $fp;

    /**
     * Constructor
     *
     * @param string target filename
     */
    function __construct($fileName)
    {
        $this->fileName = $fileName;

        $this->tempName = tempnam(dirname($fileName), "~tmp");
        
        $this->fp = fopen($this->tempName, "w");
    }

    /** 
     * Write text to file
     *
     * @param  string output text
     * @return int    number of characters written
     */
    function puts($string)
    {
        return fputs($this->fp, $string);
    }

    /**
     * Do final output, replace original file on changes
     *
     * @return bool success status
     */
    function close()
    {
        fclose($this->fp);

        if ( !file_exists($this->fileName)
             || (@filesize($this->fileName) != @filesize($this->tempName))
             || (md5(@file_get_contents($this->fileName)) != md5(file_get_contents($this->tempName)))) {
            if (file_exists($this->fileName)) {
                @rename($this->fileName, $this->fileName.".bak");
            } 
            if (!@rename($this->tempName, $this->fileName)) {
                unlink($this->tempName);
                return PEAR::raiseError("Can't write output file '{$this->fileName}'");
            }
        } else {
            unlink($this->tempName);
        }     

        return true;
    }
}
