<?php
/**
 * The ActionDisplay class provides the table less form rendering.
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
 * @copyright  2006-2007 The PHP Group
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    CVS: $Id: Tableless.php,v 1.2 2007/01/02 10:58:38 farell Exp $
 * @link       http://pear.php.net/package/HTML_Progress2
 * @since      File available since Release 2.1.0
 */

require_once 'HTML/QuickForm/Renderer/Tableless.php';

/**
 * The ActionDisplay class provides the table less form rendering.
 *
 * @category   HTML
 * @package    HTML_Progress2
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @copyright  2006-2007 The PHP Group
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    Release: 2.2.0
 * @link       http://pear.php.net/package/HTML_Progress2
 * @since      Class available since Release 2.1.0
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
     * @since  2.1.0
     */
    function _renderForm(&$page)
    {
        $renderer =& new HTML_QuickForm_Renderer_Tableless();

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
                 . 'tableless.css';
        }

        $res = isset($css) && file_exists($css);
        if ($res) {
            $this->css = $css;
        }
        return $res;
    }
}
?>