<?php
//
// +----------------------------------------------------------------------+
// | PHP Version 4                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997-2003 The PHP Group                                |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the PHP license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available at through the world-wide-web at                           |
// | http://www.php.net/license/2_02.txt.                                 |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Authors: Jesus M. Castagnetto <jmcastagnetto@php.net>                |
// +----------------------------------------------------------------------+
//
// $Id: Atom.php,v 1.4 2003/05/13 01:18:17 jmcastagnetto Exp $
//

require_once "Science/Chemistry.php";

/**
 * Base class representing an Atom
 *
 * @author  Jesus M. Castagnetto <jmcastagnetto@php.net>
 * @version 1.0
 * @access  public
 * @package Science_Chemistry
 */
class Science_Chemistry_Atom {

    /**
     * Element symbol
     *
     * @var     string
     * @access  private
     *
     * @see     getElement();
     */
    var $element="";

    /**
     * Science_Chemistry_Coordinates object
     *
     * @var     object  Science_Chemistry_Coordinates
     * @access  private
     *
     * @see     getCoordinates();
     */
    var $xyz;

    /**
     * Constructor for the class, requires the element symbol
     * and an optional array of coordinates
     *
     * @param   string  $element    chemical symbol
     * @param   optional array   $coords     array of coordinates (x, y, z)
     * @access  public
     * @return  object  Science_Chemistry_Atom
     *
     * @see     setCoordinates()
     */
    function Science_Chemistry_Atom($element, $coords="") {
        if ($element && ereg("[[:alpha:]]{1,2}", $element))
            $this->element = $element;
        else
            return null;
        if (is_array($coords) && count($coords) == 3)
            if (!$this->xyz = new Science_Chemistry_Coordinates($coords))
                return null;
    }

    /**
     * Sets the coordinates for the atom object
     *
     * @param   array   $coords     array of coordinates (x, y, z)
     * @return  boolean
     * @access  public
     */
    function setCoordinates($coords) {
        $this->xyz = new Science_Chemistry_Coordinates($coords);
        return (is_object($this->xyz) && !empty($this->xyz));
    }

    /**
     * Returns the chemical symbol for the atom
     *
     * @return  string
     * @access  public
     *
     * @see     $element;
     */
    function getElement() {
        return $this->element;
    }

    /**
     * Returns the coordinates object for the atom
     *
     * @return  object  Science_Chemistry_Coordinates
     * @access  public
     *
     * @see     $xyz;
     */
    function getCoordinates() {
        return $this->xyz;
    }

    /**
     * Calculates the cartesian distance from this atom
     * instance to another
     *
     * @param   object  Science_Chemistry_Atom $atom2
     * @return  float   distance
     * @access  public
     */
    function distance($atom2) {
        if (!empty($this->xyz) && Science_Chemistry_Coordinates::areCoordinates($this->xyz) 
            && Science_Chemistry_Atom::isAtom($atom2))
            return $this->xyz->distance($atom2->xyz);
        else
            return -1.0;
    }

    /**
     * Checks if the object is an instance of Science_Chemistry_Atom
     *
     * @param   object  Science_Chemistry_Atom $obj
     * @return  boolean
     * @access  public
     */
    function isAtom($obj) {
        return  (is_object($obj) && 
                 (strtolower(get_class($obj)) == strtolower("Science_Chemistry_Atom")
                  || is_subclass_of($obj, strtolower("Science_Chemistry_Atom")))
                );
    }

    /**
     * Returns a string representation of the Science_Chemistry_Atom object
     * Alias of toXYZ()
     *
     * @return  string
     * @access  public
     * @see toXYZ()
     */
    function toString() {
        return $this->toXYZ();
    }

    /**
     * Returns a XYZ representation of the Science_Chemistry_Atom object
     *
     * @return  string
     * @access  public
     * @see toString()
     */
    function toXYZ() {
        if ($this->element && $this->xyz)
            return sprintf("%2s",$this->element)." ".$this->xyz->toString();
    }

    /**
     * Returns a CML representation of the Science_Chemistry_Atom object
     * Accepts an optional id
     *
     * @param   optional    string  $id
     * @return  string
     * @access  public
     */
    function toCML($id=1) {
        $out = "   <atom title=\"atom\" id=\"$id\">\n";
        $out .= "    <string title=\"name\">".$this->element."</string>\n";
        $out .= "    ".$this->xyz->toCML();
        $out .= "   </atom>\n";
        return $out;
    }

} // end of class Science_Chemistry_Atom

// vim: expandtab: ts=4: sw=4
?>
