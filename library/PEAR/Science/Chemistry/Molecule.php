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
// $Id: Molecule.php,v 1.4 2003/05/13 01:18:17 jmcastagnetto Exp $
//

require_once "Science/Chemistry.php";
require_once "Science/Chemistry/Atom.php";

/**
 * Base class representing a Molecule
 *
 * @author  Jesus M. Castagnetto <jmcastagnetto@php.net>
 * @version 1.0
 * @access  public
 * @package Science_Chemistry
 */
class Science_Chemistry_Molecule {

    /**
     * Molecule name
     *
     * @var     string
     * @access  public
     */
    var $name = "";

    /**
     * Number of atoms in the molecule
     * 
     * @var     integer
     * @access  public
     * @see     initMolecule()
     */
    var $num_atoms = 0;

    /**
     * Array of atom objects in the molecule
     *
     * @var     array
     * @access  private
     * @see     initMolecule()
     */
    var $atoms = array();

    /**
     * Atom-Atom distance matrix
     *
     * @var     array
     * @access  private
     * @see     calcDistanceMatrix()
     */
    var $dist_matrix = array();

    /**
     * Atom-Atom connection (bond) table
     *
     * @var     array
     * @access  private
     * @see     calcConnectionTable()
     */
    var $conn_table = array();

    /**
     * Distance cutoff for bond estimation
     *
     * @var     float
     * @access  private
     * @see     setBondCutoff()
     * @see     getBondCutoff()
     * @see     calcConnectionTable()
     */
    var $BONDCUTOFF = 1.8;

    /**
     * Constructor for the class, requires a molecule name
     * and an optional array of Science_Chemistry_Atom objects
     * 
     * @param   string  $name
     * @param   optional    array   $atoms
     * @return  object  Science_Chemistry_Molecule
     * @access  public
     * @see     $name
     * @see     initMolecule()
     */
    function Science_Chemistry_Molecule($name, $atoms="") {
        if ($name)
            $this->name = $name;
        else
            return null;
        if ($atoms && is_array($atoms))
            if (!$this->initMolecule($atoms))
                return null;
    }

    /**
     * Initializes the array of Science_Chemistry_Atom objects
     * 
     * @param   array   $atoms
     * @return  boolean
     * @access  public
     * @see     $num_atoms
     * @see     $atoms
     * @see     addAtom()
     */
    function initMolecule($atoms) {
        if (is_array($atoms)) {
            for ($i=0; $i=count($atoms); $i++) {
                if (!$this->addAtom($atoms[$i]))
                    return false;
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * Adds a Science_Chemistry_Atom object to the list of atoms in the molecule
     * 
     * @param   object  Science_Chemistry_Atom   $atom
     * @return  boolean
     * @access  public
     * @see     initMolecule()
     */
    function addAtom($atom) {
        if (Science_Chemistry_Atom::isAtom($atom)) {
            $this->atoms[] = $atom;
            $this->num_atoms++;
            // unset the distance matrix and 
            // connection table if they are not empty
            // so next time either one is requested
            // it gets calculated anew
            if (!empty($this->dist_matrix))
                $this->dist_matrix = array();
            if (!empty($this->conn_table))
                $this->conn_table = array();
            return true;
        } else {
            return false;
        }
    }


    /**
     * Returns an array of Atom objects
     *
     * @return  array
     * @access  public
     * @see     $atoms
     */
    function getAtoms() {
        return $this->atoms;
    }

    /**
     * Checks if the object is an instance of Science_Chemistry_Molecule
     *
     * @param   object  Science_Chemistry_Molecule $obj
     * @return  boolean
     * @access  public
     */
    function isMolecule($obj) {
        return  (is_object($obj) && 
                 (strtolower(get_class($obj)) == strtolower("Science_Chemistry_Molecule") ||
                  is_subclass_of($obj, strtolower("Science_Chemistry_Molecule")))
                );
    }

    /**
     * Returns a string representation of the molecule  as a XYZ-format file
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
     * Returns a string representation of the molecule  as a XYZ-format file
     *
     * @return  string
     * @access  public
     * @see toString()
     */
    function toXYZ() {
        if (!$this->atoms)
            return false;
        $out[] = $this->num_atoms;
        $out[] = $this->name;
        reset($this->atoms);
        for ($i=0; $i<$this->num_atoms; $i++)
            $out[] = $this->atoms[$i]->toString();
        return implode("\n",$out)."\n";
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
    function toCML($title="molecule", $id="mol1", $connect=false) {
        $out = " <molecule title=\"$title\" id=\"$id\">\n";
        $out .= "  <string title=\"name\">".$this->name."</string>\n";
        $out .= "  <list title=\"atoms\">\n";
        for ($i=0; $i<$this->num_atoms; $i++)
            $out .= $this->atoms[$i]->toCML($i+1);
        $out .= "  </list>\n";
        if ($connect) {
            // calculate the connection table if needed
            // and short-circuit if we cannot do that
            if (empty($this->conn_table)) 
                if (!$this->calcConnectionTable()) {
                    $out .= " </molecule>\n";
                    return $out;
                }
            $out .= "  <list title=\"connections\">\n";
            for ($i=0; $i < count($this->conn_table); $i++) {
                $tmp = array();
                foreach ($this->conn_table[$i] as $atomid=>$flag) {
                    if ($flag)
                        $tmp[] = $atomid + 1;
                }
                if (!empty($tmp)) {
                    $out .= "   <list title=\"connect\" id=\"".($i + 1)."\">";
                    $out .= implode(" ", $tmp)."</list>\n";
                }
            }
            $out .= "  </list>\n";
        }
        $out .= " </molecule>\n";
        return $out;
    }

    
    /**
     * Sets the distance cutoff for bond determination
     *
     * @param   float   $cutoff
     * @return  boolean
     * @access  public
     * @see     $BONDCUTOFF
     * @see     getBondCutoff()
     * @see     calcConnectionTable()
     */
    function setBondCutoff($cutoff) {
        if ((float)$cutoff > 0.0) {
            $this->BONDCUTOFF = (float)$cutoff;
            return true;
        } else {
            return false;
        }
    }

    /**
     * Returns the bond cutoff uses to determine bonds
     * 
     * @return  float
     * @access  public
     * @see     $BONDCUTOFF
     * @see     setBondCutoff()
     * @see     calcConnectionTable()
     */
    function getBondCutoff() {
        return $this->BONDCUTOFF;
    }

    /**
     * Calculates the atom-atom distance matrix in Angstroms
     *
     * @return  boolean
     * @access  public
     */
    function calcDistanceMatrix() {
        if (empty($this->atoms))
            return false;
        $this->dist_matrix = array();
        for ($i=0; $i < $this->num_atoms; $i++)
            for ($j=0; $j < $this->num_atoms; $j++) {
                if ($i == $j) {
                    $this->dist_matrix[$i][$j] = 0.0;
                } elseif ($i < $j) {
                    $this->dist_matrix[$i][$j] = $this->atoms[$i]->distance($this->atoms[$j]);
                }
            }
        return true;
    }

    /**
     * Prints the atom-atom distance matrix
     *
     * @return  string
     * @access  public
     */
    function printDistanceMatrix() {
        if (empty($this->dist_matrix))
            if(!$this->calcDistanceMatrix())
                return false;
        $dmat = &$this->dist_matrix;
        echo "# Atom-Atom Distance Matrix:\n";
        for ($i=0; $i < $this->num_atoms; $i++)
            echo "\t".($i+1);
        for ($i=0; $i < $this->num_atoms; $i++) {
            echo "\n".($i+1);
            for ($j=0; $j < $this->num_atoms; $j++)
                if (!isset($dmat[$i][$j])) {
                    echo "\t";
                } else {
                    printf("\t%.4f",$dmat[$i][$j]);
                }
        }
        echo "\n";
        return true;
    }

    /**
     * Returns the atom-atom distance matrix
     *
     * @return  array
     * @access  public
     */
    function getDistanceMatrix() {
        if (empty($this->dist_matrix))
            if (!$this->calcDistanceMatrix())
                return false;
        return $this->dist_matrix;
    }

    /**
     * Calculates the connection table for the molecule
     *
     * @return  boolean
     * @access  public
     */
    function calcConnectionTable(){
        if (empty($this->dist_matrix))
            if (!$this->calcDistanceMatrix())
                return false;
        $dmat = &$this->dist_matrix;
        for ($i=0; $i < $this->num_atoms; $i++)
            for ($j=($i+1); $j < $this->num_atoms; $j++)
                $this->conn_table[$i][$j] = ($dmat[$i][$j] <= $this->BONDCUTOFF);
        return true;
    }

    /**
     * Prints the molecule's connection table
     *
     * @return  boolean
     * @access  public
     */
    function printConnectionTable() {
        if (empty($this->conn_table))
            if (!$this->calcConnectionTable())
                return false;
        printf("# Connection Table: (cutoff = %.4f Angstroms)\n", $this->BONDCUTOFF);
        for ($i=0; $i < $this->num_atoms; $i++)
            for ($j=($i+1); $j < $this->num_atoms; $j++)
                if ($this->conn_table[$i][$j]) {
                    echo $this->atoms[$i]->element.($i+1)."\t";
                    echo $this->atoms[$j]->element.($j+1)."\n";
                }
        return true;
    }

    /**
     * Returns an array of connected atoms and their bond distance
     * e.g. array ( array ($atomobj1, $atomobj2, $distance ), ... )
     * 
     * @return  array
     * @access  public
     */
    function getConnectionTable() {
        if (empty($this->conn_table))
            if (!$this->calcConnectionTable())
                return false;
        $ct = 0; $ctable=array();
        for ($i=0; $i < $this->num_atoms; $i++)
            for ($j=($i+1); $j < $this->num_atoms; $j++)
                if ($this->conn_table[$i][$j]) {
                    $ctable[$ct] = array ($this->atoms[$i], $this->atoms[$j],
                                    $this->dist_matrix[$i][$j]);
                    $ct++;
                }
       return $ctable; 
    }

} // end of class Science_Chemistry_Molecule


// vim: expandtab: ts=4: sw=4
?>
