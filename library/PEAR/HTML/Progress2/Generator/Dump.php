<?php
/**
 * Interactive memory debugging tool.
 *
 * You can display contents of :
 * - default PEAR_PackageFileManager2 class options
 * - this frontend options
 * - all forms values, defaults and validation states
 *
 * @category   HTML
 * @package    HTML_Progress2
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @copyright  2006-2007 The PHP Group
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    CVS: $Id: Dump.php,v 1.2 2007/01/02 10:58:38 farell Exp $
 * @since      File available since Release 2.1.0
 */

require_once 'HTML/QuickForm/Action.php';

function varDump($var)
{
    $available = HTML_Progress2_Generator::isIncludeable('Var_Dump.php');
    if ($available) {
        include_once 'Var_Dump.php';
        Var_Dump::display($var, false, array('display_mode' => 'HTML4_Table'));
    } else {
        echo '<pre style="background-color:#eee; color:#000; padding:1em;">';
        var_dump($var);
        echo '</pre>';
    }
}

/**
 * You can display contents of :
 * - default PEAR_PackageFileManager2 class options
 * - this frontend options
 * - all forms values, defaults and validation states
 * - the Warnings/Errors stack
 *
 * @category   HTML
 * @package    HTML_Progress2
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @copyright  2006-2007 Laurent Laville
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    Release: 2.2.0
 * @since      Class available since Release 2.1.0
 */
class ActionDump extends HTML_QuickForm_Action
{
    /**
     * Processes the request.
     *
     * @param  object   HTML_QuickForm_Page  the current form-page
     * @param  string   Current action name, as one Action object can serve multiple actions
     * @since  2.1.0
     * @access public
     */
    function perform(&$page, $actionName)
    {
        $page->isFormBuilt() or $page->buildForm();
        $page->handle('display');

        $sess =& $page->controller->container();

        $opt = $page->getSubmitValue('dumpOption');
        switch ($opt) {
            case '1':   // Progress2 dump info
                $arr = $page->controller->_progress->toArray();
                varDump($arr);
                break;
            case '2':   // Forms values container
                varDump($sess);
                break;
            case '3':   // Included files
                $includes = get_included_files();
                varDump($includes);
                break;
            case '4':   // declared classes
                $classes = get_declared_classes();
                varDump($classes);
                break;
            case '5':   // declared actions
                $actions = $page->controller->_actions;
                varDump($actions);
                break;
        }
    }
}
?>