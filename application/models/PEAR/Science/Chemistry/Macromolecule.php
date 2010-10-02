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
// $Id: Macromolecule.php,v 1.5 2003/05/13 01:18:17 jmcastagnetto Exp $
//

require_once "Science/Chemistry.php";
require_once "Science/Chemistry/Atom.php";
require_once "Science/Chemistry/Molecule.php";

/**
 * Represents a macromolecule, composed of several
 * Science_Chemistry_Molecule objects
 *
 * @author  Jesus M. Castagnetto <jmcastagnetto@php.net>
 * @version 1.0
 * @access  public
 * @package Science_Chemistry
 */
class Science_Chemistry_Macromolecule {

    /**
     * Macromolecule's name
     *
     * @var     string
     * @access   private
     */
    var $name;

    /**
     * Array of molecular objects
     *
     * @var     array
     * @access  private
     */
    var $molecules;

    /**
     * Number of molecules/subunits
     *
     * @var     int
     * @access  private
     */
    var $num_molecules;

    /**
     * Constructor for the class, requires a macromolecule name
     * and an optional array of Science_Chemistry_Molecule objects
     * 
     * @param   string  $name
     * @param   optional    array   $molecules
     * @return  object  Science_Chemistry_Macromolecule
     * @access  public
     * @see     $name
     * @see     initMacromolecule()
     */
    function Science_Chemistry_Macromolecule($name, $molecules="") {
        $this->name = $name;
        if (!empty($molecules))
            if (!$this->initMacromolecule($molecules))
                return null;
    }
    

    /**
     * Initializes the array of Science_Chemistry_Molecule objects
     * 
     * @param   array   $molecules
     * @return  boolean
     * @access  public
     * @see     $num_molecules
     * @see     $molecules
     * @see     addMolecule()
     */
    function initMacromolecule($molecules) {
        if (!is_array)
            return false;
        for ($i=0; $i < count($molecules); $i++)
            if(!$this->addMolecule($molecules[$i]))
                return false;
        return true;
    }

    /**
     * Adds a Science_Chemistry_Molecule object to the list of molecules in the macromolecule
     * 
     * @param   object  Science_Chemistry_Molecule   $mol
     * @return  boolean
     * @access  public
     * @see     initMacromolecule()
     */
    function addMolecule($mol) {
        if (Science_Chemistry_Molecule::isMolecule($mol)) {
            $this->molecules[] = $mol;
            $this->num_molecules++;
            return true;
        } else {
            return false;
        }
    }

    /**
     * Returns an array of Science_Chemistry_Molecule objects
     *
     * @return  array
     * @access  public
     * @see     $molecules
     */
    function getMolecules() {
        return $this->molecules;
    }

    /**
     * Checks if the object is an instance of Science_Chemistry_Macromolecule
     *
     * @param   object  Science_Chemistry_Macromolecule $obj
     * @return  boolean
     * @access  public
     */
    function isMacromolecule($obj) {
        return  (is_object($obj) && 
                 (strtolower(get_class($obj)) == strtolower("Science_Chemistry_Macromolecule") ||
                  is_subclass_of($obj, strtolower("Science_Chemistry_Macromolecule")))
                );
    }


    /**
     * Returns a string representation of the macromolecule
     * as a multiple molecule XYZ-format file
     *
     * @return  string
     * @access  public
     * @see toString()
     */
    function toXYZ() {
        $out = "# Number of molecules: ".$this->num_molecules."\n";
        for ($i=0; $i < $this->num_molecules; $i++)
            $out .= "# Molecule ".($i+1)."\n".$this->molecules[$i]->toString()."\n";
        return $out;
    }

    /**
     * Returns a string representation of the macromolecule
     * as a multiple molecule XYZ-format file
     * Alias of toXYZ()
     *
     * @return  string
     * @access  public
     * @see toString()
     */
    function toString() {
        return $this->toXYZ();
    }

    /**
     * Returns a CML representation of the molecule
     * Accepts an optional id, and a flag to signal
     * printing of the connection table
     *
     * @param   optional    string  $id
     * @param   optional    boolean $connect
     * @return  string
     * @access  public
     */
    function toCML($title="macromolecule", $id="macromol1", $connect=false) {
        $out = "<molecule title=\"$title\" id=\"$id\">\n";
        $out .= "<list title=\"molecules\">\n";
        for ($i=0; $i < $this->num_molecules; $i++) {
            $mol =& $this->molecules[$i];
            $out .= $mol->toCML($mol->name, ($i+1), $connect);
        }
        $out .= "</list>\n</molecule>\n";
        return $out;
    }

} // end of Science_Chemistry_Macromolecule

// vim: expandtab: ts=4: sw=4
?>
