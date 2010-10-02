<?php
/**
 * Extension generator class
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
 * @version    CVS: $Id: Extension.php,v 1.23 2006/07/08 21:28:01 hholzgra Exp $
 * @link       http://pear.php.net/package/CodeGen
 */

/**
 * includes
 *
 */
require_once "CodeGen/Maintainer.php";
require_once "CodeGen/License.php";
require_once "CodeGen/Release.php";
require_once "CodeGen/Tools/Platform.php";
require_once "CodeGen/Tools/FileReplacer.php";
require_once "CodeGen/Tools/Outbuf.php";
require_once "CodeGen/Tools/Code.php";
require_once "CodeGen/Dependency/Lib.php";
require_once "CodeGen/Dependency/Header.php";

/**
 * Extension generator class
 *
 * @category   Tools and Utilities
 * @package    CodeGen
 * @author     Hartmut Holzgraefe <hartmut@php.net>
 * @copyright  2005 Hartmut Holzgraefe
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version    Release: @package_version@
 * @link       http://pear.php.net/package/CodeGen
 */
abstract class CodeGen_Extension 
{
    /**
    * Current version number
    * 
    * @return string
    */
    abstract public function version();

    /**
    * Copyright message
    *
    * @return string
    */
    abstract public function copyright();

    /**
     * The extensions basename (C naming rules apply)
     *
     * @var string
     */
    protected $name = "unknown";
    

    /**
     * The extensions descriptive name
     *
     * @var string
     */
    protected $summary = "The unknown extension";
    
    /**
     * extension description
     *
     * @var    string
     * @access private
     */
    protected $description;

    /** 
     * The license for this extension
     *
     * @var object
     */
    protected $license  = NULL;
    
    /** 
     * The release info for this extension
     *
     * @var object
     */
    protected $release  = NULL;
        
    /** 
     * The implementation language
     *
     * Currently we support "c" and "cpp"
     *
     * @var string
     */
    protected $language  = "c";
    
    /**
     * The target platform for this extension
     *
     * Possible values are "unix", "win" and "all"
     * 
     * @var string
     */
    protected $platform = null;
    
    
    /**
     * The authors contributing to this extension
     *
     * @var array
     */
    protected $authors = array();
    
    
    /**
     * Name prefix for functions etc.
     * 
     * @var string
     */
    protected $prefix = "";


    /**
     * Release changelog
     *
     * @access private
     * @var     string
     */
    protected $changelog = "";

    
    /** 
     * Basedir for all created files
     *
     * @access protected
     * @var    string
     */
    public $dirpath = ".";


    /**
     * External libraries
     *
     * @var    array
     * @access private
     */
    protected $libs = array();

    /**
     * External header files
     *
     * @var    array
     * @access private
     */
    protected $headers = array();

    /**
     * Code snippets
     *
     * @var array
     */
    protected $code = array();

    /**
     * The package files created by this extension
     *
     * @var array
     */
    protected $packageFiles = array();

    /**
     * Version requested by input if any
     *
     * @var string
     */
    protected $version = "";


    /**
     * Makefile fragments
     *
     * @var    array
     * @access private
     */
    protected $makefragments = array();


    /**
     * config.m4 fragments
     *
     * @var    array
     * @access private
     */
    protected $configfragments = array("top"=>array(), "bottom"=>array());


    /**
     * acinclude fragments
     *
     * @var    array
     * @access private
     */
    protected $acfragments = array("top"=>array(), "bottom"=>array());


    /**
     * CodeGen_Tool_Code instance for internal use
     *
     * @var object
     */
    public $codegen;

    // {{{ constructor

    /**
     * The constructor
     *
     * @access public
     */
    function __construct() 
    {
        setlocale(LC_ALL, "C"); // ASCII only

        if ($this->release == NULL) {
            $this->release = new CodeGen_Release;
        }
        if ($this->platform == NULL) {
            $this->platform = new CodeGen_Tools_Platform("all");
        }

        $this->codegen = new CodeGen_Tools_Code;
    }
    
    // }}} 
    /**
     * Set method for changelog
     *
     * @access public
     * @param  string changelog
     * @return bool   true on success
     */
    function setChangelog($changelog)
    {
        $this->changelog = $changelog;
        
        return true;
    }
    
    /**
     * changelog getter
     *
     * @access public
     * @return string
     */
    function getChangelog()
    {
        return $this->changelog;
    }

    /**
     * Set extension base name
     *
     * @access public
     * @param  string  name
     */
    function setName($name) 
    {
        if (!preg_match('|^[a-z_]\w*$|i', $name)) {
            return PEAR::raiseError("'$name' is not a valid extension name");
        }
        
        $this->name = $name;
        return true;
    }

    /**
     * Get extension base name
     *
     * @return string
     */
    function getName()
    {
        return $this->name;
    }

    /**
     * Set extension summary text
     *
     * @access public
     * @param  string  short summary
     */
    function setSummary($text) 
    {
        $this->summary = $text;
        return true;
    }

    /** 
     * Set extension documentation text
     *
     * @access public
     * @param  string  long description
     */
    function setDescription($text) 
    {
        $this->description = $text;
        return true;
    }

    /**
     * Set the programming language to produce code for
     *
     * @access public
     * @param  string  programming language name
     */
    function setLanguage($lang)
    {
        switch (strtolower($lang)) {
        case "c":
            $this->language = "c";
            $this->codegen->setLanguage("c");
            return true;
        case "cpp":
        case "cxx":
        case "c++":
            $this->language = "cpp";
            $this->codegen->setLanguage("cpp");
            return true;
        default:
            break;
        }

        return PEAR::raiseError("'$lang' is not a supported implementation language");
    }

    /**
     * Get programming language
     *
     * @return string
     */
    function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set target platform for generated code
     *
     * @access public
     * @param  string  platform name
     */
    function setPlatform($type)
    {
        $this->platform = new CodeGen_Tools_Platform($type);
        if (PEAR::isError($this->platform)) {
            return $this->platform;
        }
        
        return true;
    }

    /**
     * Add an author or maintainer to the extension
     *
     * @access public
     * @param  object   a maintainer object
     */
    function addAuthor($author)
    {
        if (!is_a($author, "CodeGen_Maintainer")) {
            return PEAR::raiseError("argument is not CodeGen_Maintainer");
        }
        
        $this->authors[$author->getUser()] = $author;
        
        return true;
    }

    /** 
     * Set release info
     * 
     * @access public
     * @var    object
     */
    function setRelease($release)
    {
        $this->release = $release;

        return true;
    }


    /** 
     * Set license 
     * 
     * @access public
     * @param  object
     */
    function setLicense($license)
    {
        $this->license = $license;

        return true;
    }


    /**
     * Set extension name prefix (for functions etc.)
     *
     * @access public
     * @param  string  name
     */
    function setPrefix($prefix) 
    {
        if (! CodeGen_Element::isName($prefix)) {
            return PEAR::raiseError("'$name' is not a valid name prefix");
        }
        
        $this->prefix = $prefix;
        return true;
    }

    /**
     * Get extension name prefix
     *
     * @return string
     */
    function getPrefix()
    {
        return $this->prefix;
    }

    /** 
     * Add verbatim code snippet to extension
     *
     * @access public
     * @param  string  which file to put the code to
     * @param  string  where in the file the code should be put
     * @param  string  the actual code
     */
    function addCode($role, $position, $code)
    {
        if (!in_array($role, array("header", "code"))) {
            return PEAR::raiseError("'$role' is not a valid custom code role");
        }
        if (!in_array($position, array("top", "bottom"))) {
            return PEAR::raiseError("'$position' is not a valid custom code position");
        }
        $this->code[$role][$position][] = $code;
    }


    /**
     * Add toplevel library dependancy 
     *
     * @var  string  library basename
     */
    function addLib(CodeGen_Dependency_Lib $lib) 
    {
        $name = $lib->getName();
       
        if (isset($this->libs[$name])) {
            return PEAR::raiseError("library '{$name}' added twice");
        }

        $this->libs[$name] = $lib;

        return true;
    }

    /**
     * Add toplevel header file dependancy 
     *
     * @var  string  header filename
     */
    function addHeader(CodeGen_Dependency_Header $header) 
    {
        $name = $header->getName();
       
        if (isset($this->headers[$name])) {
            return PEAR::raiseError("header '{$name}' added twice");
        }

        $this->headers[$name] = $header;

        // TODO $this->addConfigFragment($header->configm4());

        return true;
    }

    /**
    * Describe next steps after successfull extension creation
    *
    * @access private
    */
    function successMsg()
    {
        $relpath = str_replace(getcwd(), '.', $this->dirpath);
    
        $msg = "\nYour extension has been created in directory $relpath.\n";
        $msg.= "See $relpath/README and $relpath/INSTALL for further instructions.\n";

        return $msg;
    }

    /**
     * Get requested version
     *
     * @return  string
     */
    function getVersion()
    {
        return $this->version;
    }

    /**
     * Set requested version
     *
     * @param  string
     */
    function setVersion($version)
    {
        if (!preg_match('/^\d+\.\d+\.\d+(dev|alpha|beta|gamma|rc|pl)?\d*$/', $version)) {
            return PEAR::raiseError("'$version' is not a valid version number");
        }
        
        if (version_compare($version, $this->version(), ">")) {
            return PEAR::raiseError("This is ".get_class($this)." ".$this->version().", input file requires at least version $version ");
        }
        
        $this->version = $version;
        return true;
    }

    /**
     * Check requested version
     *
     * @param  string version
     * @return bool
     */
    function haveVersion($version)
    {
        return version_compare(empty($this->version) ? $this->version() : $this->version, $version) >= 0;

        return true; // 
    }

    /**
     * Add a package file by type and path
     *
     * @access  public
     * @param   string  type
     * @param   string  path
     * @param   string  optional target dir
     * @returns bool    success state
     */
    function addPackageFile($type, $path, $dir = "")
    {
        $targetpath = basename($path);
        if ($dir) {
            if ($dir{0} == "/") {
                return PEAR::raiseError("only relative pathes are allowed as target dir");
            }
            $targetpath = $dir."/".$targetpath;
        }

        if (isset($this->packageFiles[$type][$targetpath])) {
            return PEAR::raiseError("duplicate distribution file name '$targetpath'");
        }

        $this->packageFiles[$type][$targetpath] = $path;
        return true;
    }

    /**
     * Add a source file to be copied to the extension dir
     *
     * @access public
     * @param  string path
     * @param  string optional target dir
     */
    function addSourceFile($name, $dir="") 
    {
        // TODO catch errors returned from addPackageFile

        $filename = realpath($name);

        if (!is_file($filename)) {
          return PEAR::raiseError("'$name' is not a valid file");
        }
        
        if (!is_readable($filename)) {
          return PEAR::raiseError("'$name' is not readable");
        }
        
        $pathinfo = pathinfo($filename);
        $ext = $pathinfo["extension"];

        switch ($ext) {
        case 'c':
          $this->addConfigFragment("AC_PROG_CC");
          $this->addPackageFile('code', $filename);
          break;
        case 'cpp':
        case 'cxx':
        case 'c++':
          $this->addConfigFragment("AC_PROG_CXX");
          $this->addConfigFragment("AC_LANG([C++])");
          $this->addPackageFile('code', $filename);
          break;
        case 'l':
        case 'flex':
          $this->addConfigFragment("AM_PROG_LEX");
          $this->addPackageFile('code', $filename);
          break;
        case 'y':
        case 'bison':
          $this->addConfigFragment("AM_PROG_YACC");
          $this->addPackageFile('code', $filename);
          break;
        default:
          break;
        }
        
        return $this->addPackageFile('copy', $filename, $dir);
    }

    /**
     * Add makefile fragment
     *
     * @access public
     * @param  string
     */
    function addMakeFragment($text)
    {
        $this->makefragments[] = $text;
        return true;
    }
            

    /**
     * Add config.m4 fragment
     *
     * @access public
     * @param  string
     */
    function addConfigFragment($text, $position="top")
    {
        if (!in_array($position, array("top", "bottom"))) {
            return PEAR::raiseError("'$position' is not a valid config snippet position");
        }
        $this->configfragments[$position][] = $text;
        return true;
    }


    /**
     * Add acinclude.m4 fragment
     *
     * @access public
     * @param  string
     */
    function addAcIncludeFragment($text, $position="top")
    {
        if (!in_array($position, array("top", "bottom"))) {
            return PEAR::raiseError("'$position' is not a valid config snippet position");
        }
        $this->acfragments[$position][] = $text;
        return true;
    }
            

    /**
    * Write .cvsignore entries
    *
    * @access public
    * @param  string  directory to write to
    */
    function writeDotCvsignore()
    {
        $file = new CodeGen_Tools_Outbuf($this->dirpath."/.cvsignore");

        // unix specific entries
        if ($this->platform->test("unix")) {
            echo 
"*.lo
*.la
.deps
.libs
Makefile
Makefile.fragments
Makefile.global
Makefile.objects
acinclude.m4
aclocal.m4
autom4te.cache
build
config.cache
config.guess
config.h
config.h.in
config.log
config.nice
config.status
config.sub
configure
configure.in
conftest
conftest.c
include
install-sh
libtool
ltmain.sh
missing
mkinstalldirs
modules
scan_makefile_in.awk
";
        }

        // windows specific entries
        if ($this->platform->test("windows")) {
            echo 
"*.dsw
*.plg
*.opt
*.ncb
Release
Release_inline
Debug
Release_TS
Release_TSDbg
Release_TS_inline
Debug_TS
";
        }

        // "pear package" creates .tgz
        echo "{$this->name}*.tgz\n";

        return $file->write();
    }

    /**
     * Generate Editor settings block for C source files
     *
     * @access public
     * @return string Editor settings comment block
    */
    function cCodeEditorSettings() 
    {
            return '
/*
 * Local variables:
 * tab-width: 4
 * c-basic-offset: 4
 * End:
 * vim600: noet sw=4 ts=4 fdm=marker
 * vim<600: noet sw=4 ts=4
 */
';
     }

    /**
     * Generate Editor settings block for documentation files
     *
     * @access public
     * @param  int    Directory nesting depth of target file (default: 3)
     * @return string Editor settings comment block
    */
    static function docEditorSettings($level=3) 
    {
        return "";
    }
}



?>
