<?php
/**
 * The ActionDisplay class provides the default form rendering.
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
 * @version    CVS: $Id: Default.php,v 1.6 2007/01/02 10:58:38 farell Exp $
 * @link       http://pear.php.net/package/HTML_Progress2
 * @since      File available since Release 2.0.0RC1
 */


/**
 * The ActionDisplay class provides the default form rendering.
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
        $formTemplate = "\n<form{attributes}>"
                      . "\n<table class=\"maintable\">"
                      . "\n<caption>HTML_Progress2 Generator</caption>"
                      . "\n{content}"
                      . "\n</table>"
                      . "\n</form>";

        $headerTemplate = "\n<tr>"
                        . "\n\t<th colspan=\"2\">"
                        . "\n\t\t{header}"
                        . "\n\t</th>"
                        . "\n</tr>";

        $elementTemplate = "\n<tr valign=\"top\">"
                         . "\n\t<td class=\"qfLabel\">&nbsp;{label}</td>"
                         . "\n\t<td class=\"qfElement\">"
                         . "\n{element}"
                         . "<!-- BEGIN label_2 -->&nbsp;"
                         . "<span class=\"qfLabel2\">{label_2}</span>"
                         . "<!-- END label_2 -->"
                         . "\n\t</td>"
                         . "\n</tr>";

        $groupTemplate = "\n\t\t<table class=\"group\">"
                       . "\n\t\t<tr>"
                       . "\n\t\t\t{content}"
                       . "\n\t\t</tr>"
                       . "\n\t\t</table>";

        $groupElementTemplate = "<td>{element}"
                              . "<!-- BEGIN label --><br/>"
                              . "<span class=\"qfLabel\">{label}</span>"
                              . "<!-- END label -->"
                              . "</td>";

        $renderer =& $page->defaultRenderer();

        $renderer->setFormTemplate($formTemplate);
        $renderer->setHeaderTemplate($headerTemplate);
        $renderer->setElementTemplate($elementTemplate);

        $groups = array('progresssize',                                   // on page 1
                        'cellvalue','cellsize', 'cellcolor', 'cellfont',  // on page 2
                        'borderstyle',                                    // on page 3
                        'stringsize','stringfont'                         // on page 4
                       );

        foreach ($groups as $grp) {
            $renderer->setGroupTemplate($groupTemplate, $grp);
            $renderer->setGroupElementTemplate($groupElementTemplate, $grp);
        }

        $styles = $this->getStyleSheet();
        $js     = '';

        // on preview tab, add progress bar javascript and stylesheet
        if ($page->getAttribute('id') == 'Preview') {
            $pb = $page->controller->createProgressBar();
            $pb->setTab('    ');

            $styles .= $pb->getStyle();
            $js      = $pb->getScript();

            $pbElement =& $page->getElement('progressBar');
            $pbElement->setText($pb->toHtml() . '<br /><br />');
        }
        $page->accept($renderer);

        $body = $renderer->toHtml();

        $html = <<<HTML
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>HTML_Progress2 Generator</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<style type="text/css">
<!--
$styles
 -->
</style>
<script type="text/javascript">
//<![CDATA[
$js
//]]>
</script>
</head>
<body>
$body
</body>
</html>
HTML;
        echo $html;
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
                 . 'default.css';
        }

        $res = isset($css) && file_exists($css);
        if ($res) {
            $this->css = $css;
        }
        return $res;
    }
}
?>