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
// $Id: Residue_PDB.php,v 1.4 2003/01/04 11:56:25 mj Exp $
//

require_once "Science/Chemistry.php";
require_once "Science/Chemistry/Atom_PDB.php";
require_once "Science/Chemistry/Molecule.php";

/**
 * Represents a PDB residue 
 *
 * @author  Jesus M. Castagnetto <jmcastagnetto@php.net>
 * @version 1.0
 * @access  public
 * @package Science_Chemistry
 */
class Science_Chemistry_Residue_PDB extends Science_Chemistry_Molecule {

    /**
     * PDB Residue sequence number
     *
     * @var     integer
     * @access   private
     */
    var $seq_num;

    /**
     * PDB Residue chain
     *
     * @var     string
     * @access  private
     */
    var $chain;

    /**
     * PDB Residue ID
     * $id = "$name:$seq_num:$chain"
     *
     * @var     string
     * @access  private
     */
    var $id;

    /**
     * PDB ID for the protein that contains
     * this residue
     *
     * @var     string
     * @access  private
     */
    var $pdb;

    /**
     * If the PDB residue object has been initialized
     *
     * @var     boolean
     * @access  public
     */
    var $VALID = false;


    /**
     * Reference to the protein
     * to which this residue belongs
     *
     * @var      object  Science_Chemistry_Macromolecule_PDB
     * @access   public
     */
    var $macromol;
    
    /**
     * Constructor for the class
     *
     * @param   string  $pdb    PDB if of the protein/nucleic acid/etc.
     * @param   array   $atomrec_arr    Array of PDB atom record lines
     * @param   object  Science_Chemistry_Macromolecule_PDB  $macromol   reference to the containing macromolecule
     * @return  object  Science_Chemistry_Residue_PDB
     * @access  public
     */
    function Science_Chemistry_Residue_PDB($pdb, $atomrec_arr, $macromol="") {
        for ($i=0; $i < count($atomrec_arr); $i++)
            $this->atoms[] = new Science_Chemistry_Atom_PDB(&$atomrec_arr[$i], &$this);
        if (!empty($this->atoms)) {
            $this->VALID = true;
            $this->macromol =& $macromol;
            $this->pdb =& $pdb;
            $this->num_atoms = count($this->atoms);
            $line =& $atomrec_arr[0];
            $this->name = trim(substr($line,17,3));
            $this->chain = trim(substr($line,21,1));
            $this->seq_num = (int) trim(substr($line,22,4));
            $this->id = $this->name.":".$this->seq_num.":".$this->chain;
        } else {
            return null;
        }
    }


    /**
     * Calculates geometrical parameters for the residue
     * Backbone bond distances, angles and torsions
     * Sidechain Chi angles
     * TODO
     *
     * @return  boolean
     * @access  public
     */
    /*
    function calcGeomParams() {
        // TODO
        return true;
    }
    */

    /**
     * Returns geometrical parameter for the residue
     * One of: bonds, angles, torsions, or chis
     * TODO
     *
     * @return  array
     * @access  public
     */
    /*
    function getGeomParams($param) {
        // TODO
        return array();
    }
    */

} // end of Science_Chemistry_Residue_PDB class

// vim: expandtab: ts=4: sw=4
?>
