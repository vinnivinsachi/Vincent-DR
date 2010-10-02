<?php
/**
 * The ActionDisplay class provides a ITDynamic form rendering
 * with Sigma template engine.
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
 * @version    CVS: $Id: ITDynamic.php,v 1.5 2007/01/02 10:58:38 farell Exp $
 * @link       http://pear.php.net/package/HTML_Progress2
 * @since      File available since Release 2.0.0RC1
 */

require_once 'HTML/QuickForm/Renderer/ITDynamic.php';
require_once 'HTML/Template/Sigma.php';

/**
 * The ActionDisplay class provides a ITDynamic form rendering
 * with template engine IT[x] family.
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

class ActionDisplay extends HTML_QuickForm_Action_Display
{
    /**
     * Style sheet for the custom layout
     *
     * @var    string
     * @access public
     * @since  2.1.0
     */
    var $css;

    /**
     * class constructor
     *
     * @param  string  $css  custom stylesheet to apply, or default if not set
     * @access public
     * @since  2.1.0
     */
    function ActionDisplay($css = null)
    {
        // when no user-styles defined, used the default values
        $this->setStyleSheet($css);
    }

    /**
     * Outputs the form.
     *
     * @param  object HTML_QuickForm_Page  the page being processed
     * @access public
     * @since  2.0.0RC1
     */
    function _renderForm(&$page)
    {
        // can use either HTML_Template_Sigma or HTML_Template_ITX
        $tpl =& new HTML_Template_Sigma('.', 'cache/');
        $tpl->loadTemplateFile('itdynamic.html');

        $renderer =& new HTML_QuickForm_Renderer_ITDynamic($tpl);
        $renderer->setElementBlock(array(
            'buttons'     => 'qf_buttons'
        ));

        $styles = $this->getStyleSheet();
        $js     = '';

        // on preview tab, add progress bar javascript and stylesheet
        if ($page->getAttribute('id') == 'Preview') {
            $pb = $page->controller->createProgressBar();

            $styles .= $pb->getStyle();
            $js      = $pb->getScript();

            $pbElement =& $page->getElement('progressBar');
            $pbElement->setText($pb->toHtml() . '<br /><br />');
        }
        $page->accept($renderer);

        $tpl->setVariable(array('qf_style' => $styles, 'qf_script' => $js));
        $tpl->show();
    }

    /**
     * Returns the custom style sheet to use for layout
     *
     * @param  bool  $content (optional) Either return css filename or string contents
     * @return string
     * @access public
     * @since  2.1.0
     */
    function getStyleSheet($content = true)
    {
        if ($content) {
            $styles = file_get_contents($this->css);
        } else {
            $styles = $this->css;
        }
        return $styles;
    }

    /**
     * Set the custom style sheet to use your own styles
     *
     * @param  string  $css (optional) File to read user-defined styles from
     * @return bool    true if custom styles, false if default styles applied
     * @access public
     * @since  2.1.0
     */
    function setStyleSheet($css = null)
    {
        // default stylesheet is into package data directory
        if (!isset($css)) {
            $this->css = 'C:\php5\pear\data' . DIRECTORY_SEPARATOR
                 . 'HTML_Progress2' . DIRECTORY_SEPARATOR
                 . 'itdynamic.css';
        }

        $res = isset($css) && file_exists($css);
        if ($res) {
            $this->css = $css;
        }
        return $res;
    }
}
?>