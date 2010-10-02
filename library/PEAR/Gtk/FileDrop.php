<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
// +----------------------------------------------------------------------+
// | PHP version 4                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997-2004 The PHP Group                                |
// +----------------------------------------------------------------------+
// | This source file is subject to version 3.0 of the PHP license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.php.net/license/3_0.txt.                                  |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Authors: Christian Weiske <cweiske@php.net>                          |
// +----------------------------------------------------------------------+
//
// $Id: FileDrop.php,v 1.1 2004/11/06 16:22:36 cweiske Exp $

require_once('MIME/Type.php');
require_once('PEAR.php');

/**
 * A FileDrop error code.
 * @const GTK_FILEDROP_WIDGET_NOT_SUPPORTED
 */
define('GTK_FILEDROP_WIDGET_NOT_SUPPORTED', 1);

/**
*   A class which makes it easy to
*   make a GtkWidget accept the dropping
*   of files or folders
*   @author Christian Weiske <cweiske@cweiske.de>
*   @package Gtk
*
*   @date 2004-10-21 13:12
*   @license PHP
*
*   @todo
*   - reject files when moving the dragging mouse over the widget, just like opera does
*       how does this work? I don't know, but I suppose I should
*
*   @example
*   Usage:
*   Simply change the text of a widget 
*   (accept files with MIME-Types text/plain and text/html and files with .sgml extension):
*       Gtk_FileDrop::attach($entry, array('text/plain', 'text/html', '.sgml'));
*   Call a callback, and don't change the text (accept directories only):
*       Gtk_FileDrop::attach($entry, array( 'inode/directory'), array( &$this, 'callback'), false);
*/
class Gtk_FileDrop
{
    /**
    *   prepares a widget to accept file drops
    *   @static
    *   @param GtkWidget    The widget which shall accept files
    *   @param array        List of MIME-Types to accept OR extensions, beginning with a dot "."
    *   @param mixed        Callback to call when a drop with valid files happened
    *   @param boolean      If the widget's text/label/content shall be changed automatically
    *
    *   @return boolean     If all was ok
    */
    function attach($widget, $arTypes, $objCallback = null, $bSetText = true)
    {
        $widget->drag_dest_set(GTK_DEST_DEFAULT_ALL, array(array('text/uri-list', 0, 0)), GDK_ACTION_COPY | GDK_ACTION_MOVE);
        
        $fd = new Gtk_FileDrop( $arTypes, $objCallback, $bSetText);
        $widget->connect('drag-data-received', array( &$fd, 'dragDataReceived'));
        
        return true;
    }
    

    
    /**
    *   constructor
    *   Use attach() instead!
    *
    *   @access private
    */
    function Gtk_FileDrop( $arTypes, $objCallback = null, $bSetText = true) 
    {
        $this->arTypes     = $arTypes;
        $this->objCallback = $objCallback;
        $this->bSetText    = $bSetText;
    }
    
    
    
    /**
    *   prepares a widget to accept directories only
    *   Just a shortcut for the exhausted programmer
    *   @static
    *   @param GtkWidget    The widget which shall accept directories
    *
    *   @return boolean     If all was ok
    */
    function attachDirectory($widget)
    {
        return Gtk_FileDrop::attach($widget, array('inode/directory'));
    }

    
    
    /**
    *   Data have been dropped over the widget
    *   @param GtkWidget      The widget on which the data have been dropped
    *   @param GdkDragContext The context of the drop
    *   @param int            X position
    *   @param int            Y position
    *   @param int            Info parameter (0 in our case)
    *   @param int            The time on which the event happened
    */
    function dragDataReceived($widget, $context , $x, $y, $data , $info, $time)
    {
        $arData     = explode("\n", $data->data);
        $arAccepted = array();
        $arRejected = array();
        $bDirectories = false;
        foreach ($arData as $strLine) {
            $strLine = trim($strLine);
            if ($strLine == '') { 
                continue; 
            }
            $strFile     = Gtk_FileDrop::getPathFromUrilistEntry($strLine);
            $strFileMime = Gtk_FileDrop::getMimeType($strFile);
            $bAccepted   = false;
            foreach ($this->arTypes as $strType) {
                if ($strType == 'inode/directory') { 
                    $bDirectories = true; 
                }
                if (($strType[0] == '.' && Gtk_FileDrop::getFileExtension($strFile) == $strType)
                 || $strType == $strFileMime || MIME_Type::wildcardMatch($strType, $strFileMime)) {
                    $arAccepted[] = $strFile;
                    $bAccepted    = true;
                    break;
                }
            }//foreach type
            if (!$bAccepted) {
                $arRejected[] = $strFile;
            }
        }//foreach line
        
        //make directories from the files if dirs are accepted
        //this is done here to give native directories first places on the list
        if ($bDirectories && count($arRejected) > 0) {
            foreach ($arRejected as $strFile) {
                $arAccepted[] = dirname( $strFile);
            }
        }
        
        if (count($arAccepted) == 0) {
            //no matching files
            return;
        }
        
        if ($this->bSetText) {
            $strClass = get_class($widget);
            switch ($strClass) {
            case 'GtkEntry':
            case 'GtkLabel':
                $widget->set_text($arAccepted[0]);
                break;
            case 'GtkButton':
            case 'GtkToggleButton':
            case 'GtkCheckButton':
            case 'GtkRadioButton':
                $childs = $widget->children();
                $child = $childs[0];
                if (get_class($child) == 'GtkLabel') {
                    $child->set_text($arAccepted[0]);
                } else {
                    trigger_error('No label found on widget.');
                }
                break;
            case 'GtkCombo':
                $entry = $widget->entry;
                $entry->set_text($arAccepted[0]);
                break;
            case 'GtkFileSelection':
                $widget->set_filename($arAccepted[0]);
                break;
            case 'GtkList':
                foreach ($arAccepted as $strFile) {
                    $items[] =& new GtkListItem($strFile);
                }
                $widget->append_items($items);
                $widget->show_all();
                break;
            default:
                PEAR::raiseError( 'Widget class "' . $strClass . '" is not supported', GTK_FILEDROP_WIDGET_NOT_SUPPORTED, PEAR_ERROR_TRIGGER, E_USER_WARNING);
                break;
            }
        }//if bSetText
        
        if ($this->objCallback !== null) {
            call_user_func( $this->objCallback, $widget, $arAccepted);
        }//objCallback !== null
    }
    
    
    
    /**
    *   converts a file path gotten from a text/uri-list
    *   drop to a usable local filepath
    *
    *   Php functions like parse_url can't be used as it is
    *   likely that the dropped URI is no real URI but a 
    *   strange thing which tries to look like one
    *   See the explanation at:
    *   http://gtk.php.net/manual/en/tutorials.filednd.urilist.php
    *
    *   @static
    *   @param  string  The line from the uri-list
    *   @return string  The usable local filepath
    */
    function getPathFromUrilistEntry($strUriFile)
    {
        $strUriFile = urldecode($strUriFile);//should be URL-encoded
        $bUrl = false;
        if (substr($strUriFile, 0, 5) == 'file:') {
            //(maybe buggy) file protocol
            if (substr($strUriFile, 0, 17) == 'file://localhost/') {
                //correct implementation
                $strFile = substr($strUriFile, 16);
            } else if (substr($strUriFile, 0, 8) == 'file:///') {
                //no hostname, but three slashes - nearly correct
                $strFile = substr($strUriFile, 7);
            } else if ($strUriFile[5] == '/') {
                //theoretically, the hostname should be the first
                //but no one implements it
                $strUriFile = substr($strUriFile, 5);
                for( $n = 1; $n < 5; $n++) {
                    if ($strUriFile[$n] != '/') { 
                        break; 
                    }
                }
                $strUriFile = substr($strUriFile, $n - 1);
                if (!file_exists($strUriFile)) {
                    //perhaps a correct implementation with hostname???
                    $strUriFileNoHost = strstr(substr($strUriFile, 1), '/');
                    if (file_exists($strUriFileNoHost)) {
                        //seems so
                        $strUriFile = $strUriFileNoHost;
                    }
                }
                $strFile = $strUriFile;
            } else {
                //NO slash after "file:" - what is that for a crappy program?
                $strFile = substr ($strUriFile, 5);
            }
        } else if (strstr($strUriFile, '://')) {
            //real protocol, but not file
            $strFile = $strUriFile;
            $bUrl    = true;
        } else {
            //local file?
            $strFile = $strUriFile;
        }
        if (!$bUrl && $strFile[2] == ':' && $strFile[0] == '/') {
            //windows file path
            $strFile = str_replace('/', '\\', substr($strFile, 1));
        }
        return $strFile;
    }
    
    
    
    /**
    *   returns the extension if a filename
    *   including the leading dot
    *   @static
    *   @param  string  The filename
    *   @return string  The extension with a leading dot
    */
    function getFileExtension($strFile)
    {
        $strExt = strrchr($strFile, '.');
        if ($strExt == false) { 
            return ''; 
        }
        $strExt = str_replace('\\', '/', $strExt);
        if (strpos($strExt, '/') !== false) {
            return ''; 
        }
        return $strExt;
    }
    
    
    
    /**
    *   determines the mime-type for the given file
    *   @static
    *   @param  string  The file name
    *   @return string  The MIME type or FALSE in the case of an error
    */
    function getMimeType($strFile)
    {
        //MIME_Type doesn't return the right type for directories
        //The underlying functions MIME_Type used don't return it right, 
        //so there is no chance to fix MIME_Type itself
        if ((file_exists($strFile) && is_dir($strFile))
          || substr($strFile, -1) == '/') {
            return 'inode/directory';
        }
        $strMime = MIME_Type::autoDetect($strFile);
        if (!PEAR::isError($strMime)) {
            return $strMime;
        }
        
        //determine by extension | as MIME_TYPE doesn't support this, I have to do this myself
        $strExtension = Gtk_FileDrop::getFileExtension($strFile);
        switch ($strExtension) {
            case '.txt' : 
                $strType = 'text/plain'; 
                break;
            case '.gif' : 
                $strType = 'image/gif'; 
                break;
            case '.jpg' :
            case '.jpeg': 
                $strType = 'image/jpg'; 
                break;
            case '.png' : 
                $strType = 'image/png'; 
                break;
            case '.xml' : 
                $strType = 'text/xml';
                break;
            case '.htm' :
            case '.html': 
                $strType = 'text/html'; 
                break;
            default:     
                $strType = false; 
                break;
        }
        return $strType;
    }
    
}
?>
