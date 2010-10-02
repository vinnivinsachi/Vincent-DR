<?php
/**
 * Wrapper class for code block generation
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
 * @version    CVS: $Id: Code.php,v 1.5 2006/07/08 20:04:37 hholzgra Exp $
 * @link       http://pear.php.net/package/CodeGen
 */

/**
 * includes
 */

require_once("CodeGen/Tools/IndentC.php");
// TODO make this configurable by language

/**
 * Wrapper class for code block generation
 *
 * all methods are actually static, the class is just needed for
 * namespace emulation to conform with PEAR naming conventions
 *
 * @category   Tools and Utilities
 * @package    CodeGen
 * @author     Hartmut Holzgraefe <hartmut@php.net>
 * @copyright  2005 Hartmut Holzgraefe
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version    Release: @package_version@
 * @link       http://pear.php.net/package/CodeGen
 */


class CodeGen_Tools_Code {
    /**
     * Programming language to generate code for
     *
     * @var string
     */
    protected $language = 'c';

    /**
     * Setter for language property
     *
     * @param string
     */
    function setLanguage($language)
    {
        // TODO check?
        $this->language = $language;
    }

    /**
     * Number of blanks to use for indent steps
     *
     * @var int 
     */
    protected $indentSteps = 4;

    /**
     * Setter for indentSteps property
     *
     * @param int
     */
    function setIntentSteps($indentSteps)
    {
        $this->indentSteps = $indentSteps;
    }

    /**
     * Generate simple indented codeblock
     *
     * @param  string   code
     * @param  int      indent level
     * @return string   formated code block
     */
    function block($code, $indent = 1) {
        return CodeGen_Tools_IndentC::indent($indent*$this->indentSteps, $code);     
    }


    /**
     * Generate indented codeblock with variable declarations
     *
     * @param  string   code
     * @param  int      indent level
     * @return string   formated code block
     */
    function varblock($code, $indent = 1) {    
        if ($this->language == 'c') {
            $head = CodeGen_Tools_IndentC::indent($indent * $this->indentSteps, "do {\n");   
            $foot = CodeGen_Tools_IndentC::indent($indent * $this->indentSteps, "} while (0);\n");   
            $indent++;
        } else {
            $head = $foot = "";
        }

        $code = CodeGen_Tools_IndentC::indent($indent * $this->indentSteps, $code); 
        return $head . $code . $foot;
    }

    
};
