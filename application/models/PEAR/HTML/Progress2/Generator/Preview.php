<?php
/**
 * The ActionPreview class provides a live demonstration
 * of the progress bar built by HTML_Progress2_Generator.
 *
 * PHP versions 4 and 5
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category   HTML
 * @package    HTML_Progress2
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @copyright  2005-2007 The PHP Group
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    CVS: $Id: Preview.php,v 1.4 2007/01/02 10:58:38 farell Exp $
 * @link       http://pear.php.net/package/HTML_Progress2
 * @since      File available since Release 2.0.0RC1
 */


/**
 * The ActionPreview class provides a live demonstration
 * of the progress bar built by HTML_Progress2_Generator.
 *
 * @category   HTML
 * @package    HTML_Progress2
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @copyright  2005-2007 The PHP Group
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    Release: 2.2.0
 * @link       http://pear.php.net/package/HTML_Progress2
 * @since      Class available since Release 2.0.0RC1
 */

class ActionPreview extends HTML_QuickForm_Action
{
    function perform(&$page, $actionName)
    {
        // like in Action_Next
        $page->isFormBuilt() or $page->buildForm();
        $page->handle('display');

        $stringid = $page->controller->exportValue('page4','stringid');
        $bar = $page->controller->createProgressBar();

        do {
            $percent = $bar->getPercentComplete();
            if ($percent == 1) {
                break;   // the progress bar has reached 100%
            }
            $bar->sleep();
            $bar->moveNext();
        } while(1);

    }
}
?>