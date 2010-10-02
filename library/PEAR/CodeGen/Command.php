<?php
/**
 * Command wrapper class 
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
 * @version    CVS: $Id: Command.php,v 1.6 2006/02/15 15:25:09 hholzgra Exp $
 * @link       http://pear.php.net/package/CodeGen
 */

/**
 * includes
 */
require_once 'PEAR.php';

require_once "CodeGen/Tools/Getopt.php";
require_once "CodeGen/Extension.php";

/**
 * Command wrapper class
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
class CodeGen_Command
{
    /**
     * The extension the command class is going to work on
     *
     * @var object
     */
    protected $extension;

    /**
     * Command constructor
     *
     * @param object  Extension to work on
     */
    function __construct(CodeGen_Extension $extension)
    {
        $this->extension = $extension;

        // no compromise
        error_reporting(E_ALL);

        // but make sure errors are written to stderr so they can't be collected by ob_* functions
        set_error_handler(array($this, "errorHandler"));

        list($shortOptions, $longOptions) = $this->commandOptions();

        $this->options = new CodeGen_Tools_Getopt($shortOptions, 
                                                   $longOptions,
                                                   array($this, "showUsage"));

        if ($this->options->have("help", "h")) {
            $this->showVersion();
            $this->showUsage();
            exit(0);
        }
        
        if ($this->options->have("version")) {
            $this->showVersion();
            exit(0);
        }
    }

    /**
     * Define the available command line options
     *
     * @return array  the available short and long options
     */
    function commandOptions()
    {
        $shortOptions = "fd=hlqx";

        $longOptions = array( "help",
                              "dir=",
                              "experimental",
                              "force",
                              "lint",
                              "quiet", 
                              "version", 
                              );

        return array($shortOptions, $longOptions);
    }

    /**
     * Show copyright and version info taken from extension class
     *
     */
    function showVersion() 
    {
        $fp = fopen("php://stderr", "w");
        fputs($fp, basename($_SERVER["argv"][0]) . " ". $this->extension->version() . "," . $this->extension->copyright() . "\n");
        fclose($fp);
    }

    
    /**
     * Show usage/help message
     *
     * @param string  optional error message to display
     */
    function showUsage($message = false)
    {
        $fp = fopen("php://stderr", "w");
        
        if ($message) fputs($fp, "$message\n\n");
        
        fputs($fp, "Usage:

". $_SERVER["argv"][0] ." [-hxf] [-d dir] [--version] specfile.xml

  -h|--help          this message
  -x|--experimental  enable experimental features
  -d|--dir           output directory
  -f|--force         overwrite existing files/directories
  -l|--lint          check syntax only, don't create output
  --version          show version info
");

        fclose($fp);
    }

    /**
     * Show error message and bailout
     *
     * @param string  error message
     */
    function terminate($msg)
    {
        $stderr = fopen("php://stderr", "w");
        if ($stderr) {
            fprintf($stderr, "%s\n", $msg);
            fclose($stderr);
        } else {
            echo "$msg\n";
        }
        exit(3);
    }

    /**
     * Error handler callback
     *
     * @param int     error level number
     * @param string  error message
     * @param string  source file
     * @param int     source line
     */
    function errorHandler($errno, $errstr, $errfile, $errline) 
    {
        if ($errno & error_reporting()) {
            $fp = fopen("php://stderr", "w");
            
            switch ($errno) {
            case E_ERROR           : fputs($fp, "Error"); break;
            case E_WARNING         : fputs($fp, "Warning"); break;
            case E_PARSE           : fputs($fp, "Parsing Error"); break;
            case E_NOTICE          : fputs($fp, "Notice"); break;
            case E_CORE_ERROR      : fputs($fp, "Core Error"); break;
            case E_CORE_WARNING    : fputs($fp, "Core Warning"); break;
            case E_COMPILE_ERROR   : fputs($fp, "Compile Error"); break;
            case E_COMPILE_WARNING : fputs($fp, "Compile Warning"); break;
            case E_USER_ERROR      : fputs($fp, "User Error"); break;
            case E_USER_WARNING    : fputs($fp, "User Warning"); break;
            case E_USER_NOTICE     : fputs($fp, "User Notice"); break;
            case E_STRICT          : fputs($fp, "Runtime Notice"); break;
            default                : fputs($fp, "Unknown Error"); break;
            }
            
            fputs($fp, ": $errstr in $errfile on line $errline\n");
            fclose($fp);
        }
    }

    /**
     * Create extension using the given parser 
     *
     * @param object  Extension parser
     */
    function execute($parser)
    {
        // normal operation: read XML file and go with that
        $arguments = $this->options->arguments();
        if (count($arguments) != 1) {
            $this->showUsage();
            exit(3);
        }
        
        $xmlfile = $arguments[0];
        
        if (!file_exists($xmlfile) || !is_readable($xmlfile)) {
            $this->terminate("Cannot open spec file '$xmlfile'");
        }
        
        // create parser for extension specs
        $err = $parser->setInputFile($xmlfile);
        if (PEAR::isError($err)) {
            $this->terminate($err->message);
        }
        
        // do the actual parsing
        $err = $parser->parse();
        if (PEAR::isError($err)) {
            $this->terminate($err->getMessage()." ".$err->getUserInfo());
        } else if(is_string($err)) {
          $this->terminate($err);
        }
      
        if ($this->options->have("l", "lint")) {
            return;
        }  
        
        // and now create the actual extension from the collected specs
        $err = $this->extension->createExtension($this->options->value("d", "dir"), $this->options->have("f", "force"));
        if (PEAR::isError($err)) {
            $this->terminate($err->getMessage()." ".$err->getUserInfo());
        }
        
        if (!$this->options->have("q", "quiet")) {
            echo $this->extension->successMsg($this->extension->getName());
        }
        
    }
}
