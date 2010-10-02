<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
// +----------------------------------------------------------------------+
// | PHP Version 4                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 2004 The PHP Group                                     |
// +----------------------------------------------------------------------+
// | This source file is subject to version 3.0 of the PHP license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.php.net/license/3_0.txt.                                  |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Author: Scott Mattocks <scottmattocks@php.net>                       |
// +----------------------------------------------------------------------+
//
// $Id:$
/**
 * Gtk_ScrollingLabel
 *
 * This is a class to encapsulate the functionality
 * needed for a scrolling gtk label. This class    
 * provides a simple, easy to understand API for   
 * setting up and controlling the label.  It allows
 * for the ability to scroll in either direction,  
 * start and stop the scroll, pause and unpause the
 * scroll, get and set the text, and set display   
 * properites of the text.                         
 *                                                 
 * @author    Scott Mattocks                          
 * @category  Gtk
 * @package   ScrollingLabel                     
 * @license   http://www.php.net/license/3_0.txt PHP License 3.0
 * @copyright Copyright &copy 2004 Scott Mattocks
 *
 * @todo Allow text to wrap the visible area.
 */

/**
 * A constant for representing srolls that move from left to right
 * @const GTK_SCROLL_LEFT
 */
define('GTK_SCROLLINGLABEL_LEFT',  1);
/**
 * A constant for representing srolls that move from right to left
 * @const GTK_SCROLLINGLABEL_RIGHT
 */
define('GTK_SCROLLINGLABEL_RIGHT', 2);
/**
 * A SrollingLabel error code.
 * @const GTK_SCROLLINGLABEL_DEFAULT_ERROR
 */
define('GTK_SCROLLINGLABEL_DEFAULT_ERROR', 1);

/**
 * Class for creating a label with the ability to scroll
 * text.
 */
class Gtk_ScrollingLabel {
    
    /**
     * The event box which will contain the label and listen for events.
     * @var object
     */
    var $widget;
    /**
     * The label which will display the text.
     * @var object
     */
    var $label;
    /**
     * The full text that will be displayed over time.
     * @var string
     */
    var $labelText;
    /**
     * The tag returned to indicate the call to gtk timeout.
     * @var integer
     */
    var $gtkTimeoutTag;
    /**
     * The number of characters that should be visible
     * @var integer
     */
    var $visibleLength = 70;
    /**
     * The number of milliseconds between calls to the method passed
     * to gtk timeout.
     * @var integer
     */
    var $speed = 70;
    /**
     * The first character to show when direction is GTK_SCROLLINGLABEL_LEFT
     * The last character to show when direction is GTK_SCROLLINGLABEL_RIGHT
     * @var integer
     */
    var $currentCharPosition = 0;
    /**
     * The direction the text should be moving.
     * @var integer
     */
    var $direction = GTK_SCROLLINGLABEL_LEFT;
    /**
     * Whether the text should change direction when it hits an edge.
     * @var boolean
     */
    var $bounce = true;
    
    /**
     * Constructor.
     * Loads module if needed then builds needed widgets.
     *
     * @access private
     * @param  string  $startingText The text to display uppon creation.
     * @return void
     */
    function Gtk_ScrollingLabel($startingText = '') 
    {        
        // Create a GTK_eventbox.
        // This is used to connect events to the label (Sort of).
        $this->widget =& new GtkEventBox;
        
        // We need to add an event mask for the event box.
        $this->widget->add_events(GDK_BUTTON_PRESS_MASK);
        
        // Next we need to create a label.
        $this->label =& new GtkLabel($startingText);
        $this->labelText = $startingText;
        
        // We need to set up some label stuff
        $this->label->set_alignment(0, 1.0);
        $this->label->set_usize(-1, 1);
        $this->label->set_justify(GTK_JUSTIFY_LEFT);
        
        // We need to set the direction of the scroll.
        $this->setDirection($this->direction);
        
        // Then we can cram the label into the event box.
        $this->widget->add($this->label);
    }
    
    /**
     * Display the visible text and de/increment the current position.
     * Needs to check if we are at the end of the string and which
     * direction the text is moving.
     *
     * This is the brains of the class. _scrollLabel figures out what
     * to do next.  If we are scrolling in one direction we need to 
     * know when the text has all passed through the visible "window"
     * so that we can start all over again.  If we are bouncing the
     * text between the two edges of the visible window we need to 
     * know when we have reached an edge so that the text can go in 
     * the opposite direction next time.  
     *
     * Note: If the text is set to bounce and the text is larger than
     * the visible window can display, the text will not bounce the 
     * way one would expect. Larger than visible window text bouncing
     * may be supported later but that is not guaranteed.
     *
     * @access private
     * @param  none
     * @return boolean False if the scrolling should stop.
     */
    function _scrollLabel()
    {
        // If the timeout is dead we return false.
        if (!isset($this->gtkTimeoutTag)) {
            return false;
        }
        
        // Get the visible text.
        $visible = $this->getVisibleText();
        
        // Set the text.
        $this->label->set_text($visible);
        
        // We need to figure out which way to move the text.
        if ($this->direction == GTK_SCROLLINGLABEL_LEFT) {
            ++$this->currentCharPosition;
        } else {
            --$this->currentCharPosition;
        }
        
        // Check to see if we need to do change direction.
        if ($this->bounce) {
            // We are going to change direction eventually.
            if ($this->direction == GTK_SCROLLINGLABEL_LEFT &&
                $visible == $this->labelText) {
                
                // If we are scrolling right to left and displaying the last character,
                // we need to turn around and move left to right next time.
                $this->setDirection(GTK_SCROLLINGLABEL_RIGHT);
                
                // We need to set the current position to the end.
                $this->currentCharPosition = strlen($this->padText()) - strlen($this->labelText);
                
            } elseif ($this->direction == GTK_SCROLLINGLABEL_RIGHT &&
                      $this->currentCharPosition <= 0) {
                
                // If we are scrolling left to right and we are showing the first
                // character, we need to turn around and go right to left next time.
                $this->setDirection(GTK_SCROLLINGLABEL_LEFT);
                
                // We need to start the scroll back at the begining.
                $this->currentCharPosition = 0;
            }
        }
        
        // Check to see if we need to start over.
        if ($this->direction == GTK_SCROLLINGLABEL_LEFT &&
            $this->currentCharPosition >= strlen($this->padText())) {
            // We need to start back at the beginning.
            $this->currentCharPosition = 0;
        } elseif ($this->direction == GTK_SCROLLINGLABEL_RIGHT &&
                  $this->currentCharPosition < 0) {
            // We need to start back at the end.
            $this->currentCharPosition = strlen($this->labelText) + $this->visibleLength - 1;
        }
        
        return true;
    }
    
    /**
     * Begin scrolling the text from the start of the string.
     * Usually connected to an event.
     *
     * startScroll() will make the text begin scrolling in the
     * direction given by calling setDirection().  If the text
     * is scrolling left to right (GTK_SCROLLINGLABEL_RIGHT), the 
     * current character position is set to the end of the text.
     * This means that the last character of the label will be
     * the first character shown.  If the text is scrolling
     * right to left (GTK_SCROLLINGLABEL_LEFT), the current character
     * position is set to zero.  This means that first character
     * shown will be a blank space.
     *
     * This method is best used when connected to an event.
     *
     * @access public
     * @param  none
     * @return boolean true if the scrolling has started.
     * @uses   unPause
     * @see    setStartSignal
     */
    function startScroll()
    {
        // First reset the current character position.
        $this->currentCharPosition = 0;
        
        // Then return the value of a call to the unpuase method.
        return $this->unPause();
    }
    
    /**
     * Begin scrolling the text from the current character position.
     * Work horse for startScroll.  Usually connected to an event.
     *
     * unPause() does pretty much the same thing as startScroll 
     * except that it does not manipulate the current character
     * position.  When you unpause the scroll, the text continues
     * from where it left off when it was paused.
     *
     * This method is best used when conneted to an event.
     *
     * @access public
     * @param  none
     * @return boolean true if the scrolling has started.
     * @see    setUnPauseSignal
     */
    function unPause()
    {
        // Pretty much just like start but without resetting the postion.
        
        // First check to see if there is a timeout already started.
        if (isset($this->gtkTimeoutTag)) {
            // Throw error about scroll already started.
            $this->_error('Cannot unpause. Text not scrolling.', GTK_SCROLLINGLABEL_DEFAULT_ERROR, PEAR_ERROR_PRINT);
            return false;
            
        } elseif (!isset($this->speed)) {
            // Throw error about no value for speed.
            return $this->_error('Cannot unpause. No speed set.');
            
        } else {
            // Start the scrolling.
            $this->gtkTimeoutTag =& gtk::timeout_add($this->speed, array(&$this, '_scrollLabel'));
        }
        
        // Give back the timeout tag.
        return $this->gtkTimeoutTag;
    }
    
    /**
     * Stop scrolling the text and return the string to the beginning.
     * Usually connected to an event.
     *
     * stopScroll will stop the text from scrolling and set the 
     * current character position to zero.  When the text is 
     * started in motion again, it will be shown as it would if
     * it had been started for the first time.
     *
     * This method is best used when connected to an event.
     *
     * @access public
     * @param  none
     * @return boolean true if the scrolling has stopped.
     * @uses   pause
     * @see    setStopSignal
     */
    function stopScroll()
    {
        // First pause the scroll.
        if ($this->pause()) {
            // Then, if that worked, reset the current position.
            $this->currentCharPosition = 0;
            // Finally call the method to change the display returning
            // the value from that method to indicate success.
            return $this->_scrollLabel();
        }
        return false;
    }
    
    /**
     * Stop the scroll where it is and do not change the current position.
     * Usually connected to an event.
     *
     * pause() will stop the text in its tracks.  The scrolling
     * will stop but the visible text will not change.  This is
     * different from stopScroll() in that stopScroll() will 
     * clear the display back to its starting state.
     *
     * This method is best used when connected to an event.
     *
     * @access public
     * @param  none
     * @return boolean true if the scrolling has stopped.
     * @see    setPauseSignal
     */
    function pause()
    {
        // Pretty much like stop but without reseting the position.
        if (empty ($this->gtkTimeoutTag)) {
            // Throw an error about no scroll in progress.
            $this->_error('Cannot pause. No timeout found.', 
                          GTK_SCROLLINGLABEL_DEFAULT_ERROR, PEAR_ERROR_PRINT);
            return false;
            
        } else {
            
            // All we need todo is unset the tag member because it is a reference.
            unset ($this->gtkTimeoutTag);
            
            // Indicate success by returning true.
            return true;
        }
    }
    
    /**
     * Connect a signal to a method.
     *
     * This private method will connect the event $signal to the
     * method $methodName.  If the optional parameter $after is
     * set to true, the event will be connected using connect
     * after.  All methods connected to an event with connect
     * after will be called after methods connected with plain
     * old connect.  The GTK label does not listen for signals so
     * all events must be connected to the event box.
     * 
     * @access private
     * @param  object  $signal     The GTK_Signal to listen for.
     * @param  string  $methodName The method to connect.
     * @param  boolean $after      Should we make this one of the last calls.
     * @return boolean
     */
    function _connectSignal($signal, $methodName, $after = false)
    {
        // Check that signal is accepted by eventbox.
        /**
         * @todo Check the above
         **/
        
        // Check to see if we are using connect after
        if ($after) {
            $method = 'connect_after';
        } else {
            $method = 'connect';
        }
        
        // Connect the event box to the signal with the method.
        $this->widget->$method($signal, array(&$this, $methodName));
        
        return true;
    }
    
    /**
     * Connect a signal to a method and act on another widget.
     *
     * This private method connects an event to a method and
     * passes that method a widget from which to get data or
     * to act on in some way. If the optional parameter $after
     * is set to true, the event will be connected using connect
     * after.  All methods connected to an event with connect
     * after will be called after methods connected with plain
     * old connect.  The GTK label does not listen for signals
     * so all events must be connected to the event box.
     *
     * @access private
     * @param  object  $signal     The GTK_Signal to listen for.
     * @param  string  $methodName The method to connect.
     * @param  &object $object     The widget to act on.
     * @param  boolean $after      Should we make this one of the last calls.
     * @return boolean
     */
    function _connectObjectSignal($signal, $methodName, &$object, $after = false)
    {
        // Check that signal is accepted by eventbox.
        /**
         * @todo Check the above
         **/
        
        // Check to see if we are using connect after
        if ($after) {
            $method = 'connect_object_after';
        } else {
            $method = 'connect_object';
        }
        
        // Connect the event box to the signal with the method.
        $this->widget->$method($signal, array(&$this, $methodName), $object);
    }
    
    /**
     * Connect the pause method to an event.
     *
     * setPauseSignal() will make the event box listen for the
     * signal $signal and will envoke pause() when ever it is
     * heard.  The signal should be a signal that GTKEventBox
     * listens for normally or a button press event.
     *
     * @access public
     * @param  string $signal The GTK signal to connect to the method.
     * @return integer
     * @uses   _connectSignal
     */
    function setPauseSignal($signal)
    {
        // Call the private connectSignal method.
        return $this->_connectSignal($signal, 'pause');
    }
    
    /**
     * Connect the unpause method to an event.
     *
     * setUnPauseSignal() will make the event box listen for the
     * signal $signal and will envoke unPause() when ever it is
     * heard.  The signal should be a signal that GTKEventBox
     * listens for normally or a button press event.
     *
     * @access public
     * @param  string $signal The GTK signal to connect to the method.
     * @return integer
     * @uses   _connectSignal
     */
    function setUnPauseSignal($signal)
    {
        // Call the private connectSignal method.
        return $this->_connectSignal($signal, 'unPause');
    }
    
    /**
     * Connect the start method to an event.
     *
     * setStartSignal() will make the event box listen for the
     * signal $signal and will envoke startScroll() when ever it is
     * heard.  The signal should be a signal that GTKEventBox
     * listens for normally or a button press event.
     *
     * 
     * @access public
     * @param  string $signal The GTK signal to connect to the method.
     * @return integer
     * @uses   _connectSignal
     */
    
    function setStartSignal($signal)
    {
        // Call the private connectSignal method.
        return $this->_connectSignal($signal, 'startScroll');
    }
    
    /**
     * Connect the stop method to an event.
     *
     * setStopSignal() will make the event box listen for the
     * signal $signal and will envoke stopScroll() when ever it is
     * heard.  The signal should be a signal that GTKEventBox
     * listens for normally or a button press event.
     *
     *
     * @access public
     * @param  string $signal The GTK signal to connect to the method.
     * @return integer
     * @uses   _connectSignal
     */
    function setStopSignal($signal)
    {
        // Call the private connectSignal method.
        return $this->_connectSignal($signal, 'stopScroll');
    }
    
    /**
     * Set the speed of the scrolling text.
     *
     * setSpeed() will change how quickly the text scrolls
     * across the visible label area. $speed is the number
     * of milliseconds to wait between calls to _scrollLabel.
     * $speed is passes to gtk::timeout_add().  If $restart
     * is set to true, the speed of the text will be changed
     * immediately. Otherwise the speed will not be changed
     * until _scrollLabel is called again. This effectively
     * means that the speed changes one letter after you set
     * the new speed if $restart is false.
     *
     * @access public
     * @param  string  $speed   The speed the text should scroll.
     * @param  boolean $restart Whether or not the speed should be changed before the next call to _scrollLabel
     * @return integer
     */
    function setSpeed($speed, $restart = false)
    {
        // Check the speed.
        if (!is_numeric($speed) || $speed < 1 || $speed > 1000) {
            // Throw an error about illegal speed value
            $this->_error('Cannot set speed. Invalid value: ' . $speed, 
                          GTK_SCROLLINGLABEL_DEFAULT_ERROR, PEAR_ERROR_PRINT);
        } else {
            // Speed is the number of milliseconds between timeouts.
            $this->speed = $speed;
        }
        
        // If the scroll is currently moving we may need to 
        // pause and unpause the scroll.
        if ($restart && isset ($this->gtkTimeoutTag)) {
            // Pausing and unpausing the scroll will affectively change the speed.
            $this->pause();
            $this->unPause();
        }
        
        return $this->speed;
    }
    
    /**
     * Set the diretion that the text should scroll.
     *
     * Set the direction that the text will move across the visible
     * area of the label. The only accepted directions are the two
     * constants GTK_SCROLLINGLABEL_LEFT and GTK_SCROLLINGLABEL_RIGHT which move the
     * from right to left and left to right respectively. The return
     * value is the diretion the text will move on the next call to 
     * _scrollLabel().
     *
     * @access public
     * @param  integer $direction (GTK_SCROLLINGLABEL_LEFT|GTK_SCROLLINGLABEL_RIGHT)
     * @return integer
     */
    function setDirection($direction)
    {
        // Check direction.
        if ($direction != GTK_SCROLLINGLABEL_LEFT && $direction != GTK_SCROLLINGLABEL_RIGHT) {
            // Throw an error about illegal direction choice.
            $this->_error('Cannot set direction. Illegal value: ' . $direction,
                          GTK_SCROLLINGLABEL_DEFAULT_ERROR, PEAR_ERROR_PRINT);
        } else {
            $this->direction = $direction;
        }
        
        return $this->direction;
    }
    
    /**
     * Set whether or not the text should change directions when it hits an edge
     *
     * If bounce is true, the text will scroll to the left until the
     * first character hits the left edge of the visible window then
     * it will scroll to the right. When the last character hits the
     * right edge of the visible window the text will scroll back to
     * the left.
     *
     * Note: I don't know what will happen if bounce is true and the
     * text is larger than what can be viewed at one time in the
     * window. Therefore it is suggested that the length of the text
     * always be at least one less than the size of the window.
     *
     * @access public
     * @param  boolean $bounce true means change directions.
     * @return boolean         The current state of $this->bounce
     */
    function setBounce($bounce)
    {
        $this->bounce = $bounce;
        return $this->bounce;
    }
    
    /**
     * Deprecated method to set bouncing.
     *
     * @deprecated
     * @access public
     * @param  boolean $bounce true means change directions.
     * @return boolean         The current state of $this->bounce
     * @see    setBounce
     */
    function bounce($bounce)
    {
        return $this->setBounce($bounce);
    }
    
    /**
     * Set the style in which the text will be displayed.
     *
     * setStyle() lets you define the look of the text that is
     * scrolling as well as the background of the widget.  
     *
     * This method has not been implemented yet.
     *
     * @access public
     * @param  &object $style The GTK_Style object to use.
     * @return &object
     */
    function setStyle(&$style)
    {
        $this->label->set_style($style);
    }
    
    /**
     * Get the label's style widget.
     *
     * getStyle() returns the label's style widget. This lets you
     * make changes to the style to alter the look and feel of the 
     * widget. You can change the font of the display, the color of
     * the background, etc.
     * 
     * @access public
     * @param  none
     * @return &object
     */
    function &getStyle()
    {
        return $this->label->get_style();
    }
    
    /**
     * Return the portion of the label text that should be visible
     *
     * getVisibleText() is used internally to get the text that 
     * should be shown everytime the text scrolls.  It can also
     * be called publically to get the text that is currently
     * displayed in the visible window area. The part of the text
     * that is visible depends on the current character position
     * and the direction the text is moving.
     *
     * @access public
     * @param  none
     * @return string  The visible text.
     * @uses   padText()
     */
    function getVisibleText()
    {
        // Pad the text.
        $text = $this->padText();
        
        // We need to show from the current character position to 
        // the character at currentCharPosition + visibleLength.
        if ($this->direction == GTK_SCROLLINGLABEL_LEFT) {
            $text = substr($text, $this->currentCharPosition, $this->visibleLength);
        } else {
            // I want to start at the end and get the text 
            // $visibleLength in front of that.
            $text = substr($text, $this->currentCharPosition - $this->visibleLength, $this->visibleLength);
        }
        
        return $text;
    }
    
    /**
     * Pad the text with enough space to fill the visible area.
     *
     * padText adds the needed amount of white space to the
     * text so that it can scroll properly.  When the text is
     * set to bounce the padding should only be what is needed
     * to make the string as long as the visible window area.
     * If the text is not bouncing, the text must be padded with 
     * as many spaces as the length of the visible area.
     *
     * @access public
     * @param  none
     * @return string   The padded text.
     */
    function padText()
    {
        // Get the full label text.
        $text = $this->labelText;
        
        // We need to pad the text on the left unless we are bouncing the text.
        if (!$this->bounce) {
            $text = str_pad($text, strlen($text) + $this->visibleLength, ' ', STR_PAD_LEFT);
        } elseif (strlen($this->labelText) < $this->visibleLength) {
            $text = str_pad($text, $this->visibleLength, ' ', STR_PAD_LEFT);
        }
        
        return $text;
    }
    
    /**
     * Return all of the text that can ever be shown by this label.
     *
     * @access public
     * @param  none
     * @return string
     */
    function getFullText()
    {
        return $this->labelText;
    }
    
    /**
     * Return all of the text that is not currently visible.
     * 
     * @access public
     * @param  none
     * @return string
     */
    function getHiddenText()
    {
        // Pad the text.
        $text = $this->padText();
        
        // We need to get the text minus the visible portion.
        // I don't know if this will ever be useful.
        $firstPart  = substr($text, 0, $this->currentCharPosition);
        $secondPart = substr($text, $this->currentCharPosition + $this->visibleLength);
        
        return $firstPart . $secondPart;
    }
    
    /**
     * Set the full text of the label.
     *
     * setFullText() will change the text of the scrolling label.
     * The return value is what the text of the label will be
     * when _scrollLabel is next called.  
     *
     * @access public
     * @param  string $text The new text for the label.
     * @return string       The label's text.
     */
    function setFullText($text)
    {
        // Set the label text to the supplied text.
        $this->labelText = $text;
        
        return $this->labelText;
    }
    
    /**
     * Change the current character position.
     *
     * jumpToChar() allows you to go directly to a character
     * position on the next call to _scrollLabel.  The new
     * position must be between zero (the first character) 
     * and the length of the label minus one. The character
     * position should be calculated using the string from
     * padText(). When the text is scrolling to the left the
     * $charPosition should be the left-most character to 
     * display. When text is scrolling to the right, 
     * $charPosition should be the right-most character to
     * display.
     *
     * The visible label will not change until _scrollLabel
     * is called again.
     *
     * @access public
     * @param  integer $charPosition Depending on the direction either the left or right most character to display.
     * @return integer               The new current character position. (PEAR_Error when there is a problem.)
     */
    function jumpToChar($charPosition)
    {
        // Check that the charPosition exists.
        if (!is_numeric ($charPosition) || $charPosition < 0 || $charPosition >= strlen($this->labelText)) {
            // Throw an error about illegal char position.
            $this->_error('Cannot jump to character. Invalid value. Character position must be a number between zero and the length of the string (' . strlen($this->padText()) . ')');
        } else {
            // Set the current character position.
            $this->currentCharPosition = $charPosition;
        }
        
        return $this->currentCharPosition;
    }
    
    /**
     * Change how many characters should be visible at any given time.
     *
     * setVisibleLength() will set the number of characters that are
     * visible at any given time.  While it is ik to set the visible
     * length smaller than the width of the displaying widget, you 
     * probably don't want to make it larger then the width of the
     * displaying widget.  It will make the padded lenght longer and
     * add additional time before the text begins to appear on screen.
     *
     * @access public
     * @param  integer $length The new size of the visible area in characters.
     * @return integer         The new size of the visible area in characters.
     */
    function setVisibleLength($length)
    {
        // First check the length.
        if (!is_numeric($length) || $length < 0) {
            // Throw an error about illegal visible length.
            $this->_error('Cannot set visible length. Invalid value. Length must be a number greater than zero.');
        } else {
            $this->visibleLength = $length;
        }
        
        return $this->visibleLength;
    }
    
    /**
     * Return the visible area length in characters
     *
     * @access public
     * @param  none
     * @return integer
     */
    function getVisibleLength()
    {
        return $this->visibleLength;
    }
    
    /**
     * Show the GTK components.
     *
     * @access public
     * @param  none
     * @return void
     */
    function show()
    {
        // Show the eventbox and the label.
        $this->widget->show_all();
    }
    
    /**
     * Hide the GTK components.
     * 
     * @access public
     * @param  none
     * @return void
     */
    function hide()
    {
        // Hide the label and the eventbox.
        $this->widget->hide_all();
    }
    
    /**
     * Return the GTKEventBox with the GTKLabel inside.
     *
     * @access public
     * @param  none
     * @return &object
     */
    function &getScrollingLabel()
    {
        return $this->widget;
    }
    
    /**
     * Raise a pear error.
     *
     * _error will raise a PEAR error with $msg as the message.  
     * If the optional parameter $code is set, that error code
     * will be used. Otherwise the default error code will be
     * used. If the optional $pearMode is passed that mode will
     * be used to display/return the error.
     *
     * @access private
     * @param  string  $msg      The human readable error message.
     * @param  integer $code     The error code.
     * @param  integer $pearMode The PEAR mode for the error.
     * @return mixed             A PEAR_Error or void.
     */
    function _error($msg, $code = GTK_SCROLLINGLABEL_DEFAULT_ERROR, $pearMode = PEAR_ERROR_RETURN)
    {    
        // Require the pear class so that we can use its error functionality.
        require_once ('PEAR.php');
        
        // Check whether or not we should print the error.
        if ($pearMode == PEAR_ERROR_PRINT) {
            PEAR::setErrorHandling(PEAR_ERROR_PRINT, "Gtk_ScrollingLabel error: %s<BR />\n");
        }
        
        PEAR::raiseError($msg, $code, $pearMode);
    }
}
/*
 * Local variables:
 * tab-width: 4
 * c-basic-offset: 4
 * End:
 */
?>