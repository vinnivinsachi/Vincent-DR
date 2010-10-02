<?php
/**
 * Parser for XML based extension desription files
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
 * @version    CVS: $Id: ExtensionParser.php,v 1.16 2006/06/24 12:37:03 hholzgra Exp $
 * @link       http://pear.php.net/package/CodeGen
 */


/**
 * includes
 */
require_once "CodeGen/XmlParser.php";
require_once "CodeGen/Tools/Indent.php";

/**
 * Parser for XML based extension desription files
 *
 * @category   Tools and Utilities
 * @package    CodeGen
 * @author     Hartmut Holzgraefe <hartmut@php.net>
 * @copyright  2005 Hartmut Holzgraefe
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version    Release: @package_version@
 * @link       http://pear.php.net/package/CodeGen
 */
abstract class CodeGen_ExtensionParser 
    extends CodeGen_XmlParser
{
    /**
     * The extension to parse specs into
     *
     * @access private
     * @var    object
     */
    protected $extension;
    
    /** 
     * Constructor
     *
     * @access public
     * @param  object the extension to parse specs into
     */
    function __construct($extension) 
    {
        parent::__construct();
        $this->extension = $extension;
    }
    
    /**
     * Handle <extension>
     *
     * @access private
     * @param  array    attribute/value pairs
     * @return bool     success status
     */
    function tagstart_extension($attr)
    {
        $err = $this->checkAttributes($attr, array("name", "prefix", "version"));
        if (PEAR::isError($err)) {
            return $err;
        }
                                      
        if (!isset($attr["name"])) {
            return PEAR::raiseError("needed attribute 'name' for <extension> not given");
        }
        $err = $this->extension->setName(trim($attr["name"]));
        if (PEAR::isError($err)) {
            return $err;
        }

        if (isset($attr["prefix"])) {
            $err = $this->extension->setPrefix(trim($attr["prefix"]));
            if (PEAR::isError($err)) {
                return $err;
            }
        }

        if (isset($attr["version"])) {
            $err = $this->extension->setVersion($attr["version"]);
            if (PEAR::isError($err)) {
                return $err;
            }
        } else {
            error_log("Warning: no 'version' attribute given for <extension>, assuming ".$this->extension->version()."\n".
                      "         this may lead to compile errors if your spec file was created for an older version");
        }

        return true;
    }
    
    /**
     * Handle <extension><name>
     *
     * @access private
     * @param  array    attribute/value pairs
     * @return bool     success status
     */
    function tagstart_extension_name($attr)
    {
        return PEAR::raiseError("extension <name> tag is no longer supported, use <extension>s 'name=...' attribute instead");
    }
    
    
    /**
     * Handle <extension><summary>
     *
     * @access private
     * @param  array    attribute/value pairs
     * @return bool     success status
     */
    function tagstart_extension_summary($attr)
    {
        return $this->noAttributes($attr);
    }

    /**
     * Handle <extension></summary>
     *
     * @access private
     * @param  array    attribute/value pairs
     * @param  array    tag data content
     * @return bool     success status
     */
    function tagend_extension_summary($attr, $data)
    {
        return $this->extension->setSummary(CodeGen_Tools_Indent::linetrim($data));
    }
    
    /**
     * Handle <extension><description>
     *
     * @access private
     * @param  array    attribute/value pairs
     * @return bool     success status
     */
    function tagstart_extension_description($attr)
    {
        return $this->noAttributes($attr);
    }

    /**
     * Handle <extension></description>
     *
     * @access private
     * @param  array    attribute/value pairs
     * @param  array    tag data content
     * @return bool     success status
     */
    function tagend_extension_description($attr, $data)
    {
        return $this->extension->setDescription(CodeGen_Tools_Indent::linetrim($data));
    }

        


    
    function tagstart_maintainer($attr)
    {
        $this->pushHelper(new CodeGen_Maintainer);
        return $this->noAttributes($attr);;
    }
    
    function tagstart_maintainer_user($attr)
    {
        return $this->noAttributes($attr);;
    }

    function tagend_maintainer_user($attr, $data)
    {
        return $this->helper->setUser(trim($data));
    }
    
    function tagstart_maintainer_name($attr)
    {
        return $this->noAttributes($attr);;
    }

    function tagend_maintainer_name($attr, $data)
    {
        return $this->helper->setName(trim($data));
    }

    function tagstart_maintainer_email($attr)
    {
        return $this->noAttributes($attr);;
    }

    function tagend_maintainer_email($attr, $data)
    {
        return $this->helper->setEmail(trim($data));
    }

    function tagstart_maintainer_role($attr)
    {
        return $this->noAttributes($attr);;
    }

    function tagend_maintainer_role($attr, $data)
    {
        return $this->helper->setRole(trim($data));
    }

    function tagend_maintainer($attr, $data)
    {
        $err = $this->extension->addAuthor($this->helper);
        $this->popHelper();
        return $err;
    }

    function tagend_maintainers($attr, $data) 
    {
        return true;
    }

    function tagstart_release($attr)
    {
        $this->pushHelper(new CodeGen_Release);
        return $this->noAttributes($attr);;
    }

    function tagstart_release_version($attr)
    {
        return $this->noAttributes($attr);;
    }

    function tagend_release_version($attr, $data)
    {
        return $this->helper->setVersion(trim($data));
    }

    function tagstart_release_date($attr)
    {
        return $this->noAttributes($attr);;
    }

    function tagend_release_date($attr, $data)
    {
        return $this->helper->setDate(trim($data));
    }

    function tagstart_release_state($attr)
    {
        return $this->noAttributes($attr);;
    }

    function tagend_release_state($attr, $data)
    {
        return $this->helper->setState(trim($data));
    }

    function tagstart_release_notes($attr)
    {
        return $this->noAttributes($attr);;
    }

    function tagend_release_notes($attr, $data)
    {
        return $this->helper->setNotes(CodeGen_Tools_Indent::linetrim($data));
    }

    function tagend_release($attr, $data)
    {
        $err = $this->extension->setRelease($this->helper);
        $this->popHelper(new CodeGen_Release);
        return $err;
    }

    function tagstart_extension_changelog($attr, $data) 
    {
        $this->verbatim();
        return $this->noAttributes($attr);;
    }

    function tagend_extension_changelog($attr, $data) 
    {
        return $this->extension->setChangelog(CodeGen_Tools_Indent::linetrim($data));
    }

        
    function tagend_license($attr, $data)
    {
        $license = CodeGen_License::factory(trim($data));
        
        if (PEAR::isError($license)) {
            return $license;
        }
        
        return $this->extension->setLicense($license);
    }

    function tagend_extension_code($attr, $data) {
        $err = $this->checkAttributes($attr, array("role", "position"));
        if (PEAR::isError($err)) {
            return $err;
        }
                                      
        $role     = isset($attr["role"])     ? $attr["role"]     : "code";
        $position = isset($attr["position"]) ? $attr["position"] : "bottom";

        if (isset($attr["src"])) {
            return $this->extension->addCode($role, $position, CodeGen_Tools_Indent::linetrim(file_get_contents($attr["src"])));
        } else {
            return $this->extension->addCode($role, $position, CodeGen_Tools_Indent::linetrim($data));
        }
    }


    function tagstart_deps($attr)
    {
        $err = $this->checkAttributes($attr, array("platform","language"));
        if (PEAR::isError($err)) {
            return $err;
        }
                                      
        if (isset($attr["platform"])) {
            $err = $this->extension->setPlatform($attr["platform"]);
            if (PEAR::isError($err)) {
                return $err;
            }
        }

        if (isset($attr["language"])) {
            $err = $this->extension->setLanguage($attr["language"]);
            if (PEAR::isError($err)) {
                return $err;
            }
        }

    }

    function tagstart_deps_file($attr) 
    {
        $err = $this->checkAttributes($attr, array("name", "dir"));
        if (PEAR::isError($err)) {
            return $err;
        }
                                      
        if (!isset($attr['name'])) {
            return PEAR::raiseError("name attribut for file missing");
        }

        if (isset($attr["dir"])) {
            return $this->extension->addSourceFile($attr['name'], $attr['dir']);
        } else {
            return $this->extension->addSourceFile($attr['name']);
        }
    }
        
    function tagstart_deps_lib($attr)
    {
        $err = $this->checkAttributes($attr, array("name", "platform", "function"));
        if (PEAR::isError($err)) {
            return $err;
        }
                                      
        if (!isset($attr['name'])) {
            return PEAR::raiseError("name attribut for lib missing");
        }

        // TODO need to use addLibs(), libs[] is protected
        $this->extension->libs[$attr['name']] = $attr;
        if (isset($attr['platform'])) {
            $platform = new CodeGen_Tools_Platform($attr["platform"]);
        } else {
            $platform = new CodeGen_Tools_Platform("all");
        }

        if (PEAR::isError($platform)) {
            return $platform;
        }

        $this->extension->libs[$attr['name']]['platform'] = $platform;
        return true;
    }

    function tagstart_deps_header($attr)
    {
        $err = $this->checkAttributes($attr, array("name", "prepend", "path"));
        if (PEAR::isError($err)) {
            return $err;
        }
                                      
        // TODO check name
        $header = new CodeGen_Dependency_Header($attr["name"]);

        if (isset($attr['path'])) {
            $header->setPath($attr["path"]);
        }

        if (isset($attr['prepend'])) {
            $header->setPrepend($attr["prepend"]);
        }

        $this->extension->addHeader($header);
    }
}


/*
 * Local variables:
 * tab-width: 4
 * c-basic-offset: 4
 * indent-tabs-mode:nil
 * End:
 */
?>
