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
// $Id: Coordinates.php,v 1.3 2003/01/04 11:56:25 mj Exp $
//

/**
 * Utility class for defining 3D coordinates and
 * its associated distance() method
 *
 * @author  Jesus M. Castagnetto <jmcastagnetto@php.net>
 * @version 1.0
 * @access  public
 * @package Science_Chemistry
 */
class Science_Chemistry_Coordinates {

    /**
     * Array of tridimensional coordinates: (x, y, z)
     * 
     * @var     array
     * @access  private
     */
    var $coords;
    
    /**
     * Constructor for the class, returns null if parameter is
     * not an array with 3 entries
     *
     * @param   array   $coords array of three floats (x, y, z)
     * @return  object  Science_Chemistry_Coordinates
     * @access  public
     */
    function Science_Chemistry_Coordinates($coords) {
        if (is_array($coords) && count($coords) == 3)
            $this->coords = $coords;
        else
            return null;
    }
    
    /**
     * Castesian distance calculation method
     *
     * @param   object  Science_Chemistry_Coordinates $coord
     * @return  float   distance
     * @access  public
     */
    function distance($coord) {
        if (Science_Chemistry_Coordinates::areCoordinates($coord)) {
            $xyz2 = $coord->getCoordinates();
            for ($i=0; $i<count($xyz2); $i++)
                $sum2 += pow(($xyz2[$i] - $this->coords[$i]),2);
            return sqrt($sum2);
        }
    }

    /**
     * Checks if the object is an instance of Science_Chemistry_Coordinates
     * 
     * @param   object  Science_Chemistry_Coordinates    $obj
     * @return  boolean
     * @access  public
     */
    function areCoordinates($obj) {
        return  ( is_object($obj) && 
                 (strtolower(get_class($obj)) == strtolower("Science_Chemistry_Coordinates")
                  || is_subclass_of($obj, strtolower("Science_Chemistry_Coordinates")))
                );
    }

    /**
     * Returns the array of coordinates
     *
     * @return  array   array (x, y, z)
     * @access  public
     */
    function getCoordinates() {
        if (is_array($this->coords) && !empty($this->coords))
            return $this->coords;
    }

    /**
     * Returns a string representation of the coordinates: x y z
     *
     * @return  string 
     * @access  public
     */
    function toString() {
        for ($i=0; $i<count($this->coords); $i++)
            $tmp[$i] = sprintf("%10.4f",$this->coords[$i]);
        return implode(" ",$tmp);
    }

    /**
     * Returns a CML representation of the coordinates
     *
     * @return  string
     * @access  public
     */
    function toCML() {
        $out = "<coordinate3 builtin=\"xyz3\">";
        $tmp = array();
        for ($i=0; $i < count($this->coords); $i++)
            $tmp[] = trim(sprintf("%10.4f", $this->coords[$i]));
        $out .= implode(" ",$tmp)."</coordinate3>\n";
        return $out;
    }

} // end of class Science_Chemistry_Coordinates

// vim: expandtab: ts=4: sw=4
?>
