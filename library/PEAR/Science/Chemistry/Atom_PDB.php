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
// $Id: Atom_PDB.php,v 1.5 2003/05/13 01:18:17 jmcastagnetto Exp $
//

require_once "Science/Chemistry/Atom.php" ;

/**
 * Represents a PDB atom record
 * and contains a reference to the PDB residue to which it belongs
 *
 * @author  Jesus M. Castagnetto <jmcastagnetto@php.net>
 * @version 1.0
 * @access  public
 * @package Science_Chemistry
 */
class Science_Chemistry_Atom_PDB extends Science_Chemistry_Atom {

    /**
     * PDB Atom record type, one of ATOM or HETATM
     *
     * @var     string
     * @access  private
     * @see     getField()
     */
    var $rec_name;

    /**
     * PDB Atom serial number
     *
     * @var     integer
     * @access   private
     * @see     getField()
     */
    var $ser_num;

    /**
     * PDB Atom name
     *
     * @var     string
     * @access  private
     * @see     getField()
     */
    var $atom_name;

    /**
     * PDB Atom alternative location
     *
     * @var     string
     * @access  private
     * @see     getField()
     */
    var $alt_loc;

    /**
     * PDB Atom's Residue name
     *
     * @var     string
     * @access  private
     * @see     getField()
     */
    var $res_name;

    /**
     * PDB Atom's Residue chain ID
     *
     * @var     string
     * @access  private
     * @see     getField()
     */
    var $chain_id;

    /**
     * PDB Atom's Residue sequential numnber
     *
     * @var     string
     * @access  private
     * @see     getField()
     */
    var $res_seq_num;

    /**
     * PDB Atom insert code
     *
     * @var     string
     * @access  private
     * @see     getField()
     */
    var $ins_code;

    /**
     * PDB Atom occupancy
     *
     * @var     float
     * @access  private
     * @see     getField()
     */
    var $occupancy;

    /**
     * PDB Atom temperature factor
     *
     * @var     float
     * @access  private
     * @see     getField()
     */
    var $temp_factor;

    /**
     * PDB Atom segment identifier
     *
     * @var     string
     * @access  private
     * @see     getField()
     */
    var $segment_id;

    /**
     * PDB Atom electronic charge
     *
     * @var     float
     * @access  private
     * @see     getField()
     */
    var $charge;

    /**
     * If the atom object has been initialized
     *
     * @var     boolean
     * @access  public
     * @see     initAtom()
     */
    var $VALID = false;

    /**
     * Reference to the containing Residue object
     *
     * @var     object  Residue_PDB
     * @access  public
     */
    var $parent_residue;

    
    function Science_Chemistry_Atom_PDB($atomrec, $residue="") {
        // reference to containing residue
        if (!empty($residue))
            $this->parent_residue =& $residue;
        // process PDB atom record
        // no error checking, assumes correct and standard record
        $this->VALID = true;
        $this->rec_name = trim(substr($atomrec,0,6));
        $this->ser_num = (int) trim(substr($atomrec,6,5));
        $this->atom_name = trim(substr($atomrec,12,4));
        $this->alt_loc = trim(substr($atomrec,16,1));
        $this->res_name = trim(substr($atomrec,17,3));
        $this->chain_id = trim(substr($atomrec,21,1));
        $this->res_seq_num = (int) trim(substr($atomrec,22,4));
        $this->ins_code = trim(substr($atomrec,26,1));
        $this->occupancy = (float) trim(substr($atomrec,54,6));
        $this->temp_factor = (float) trim(substr($atomrec,60,6));
        $this->segment_id = trim(substr($atomrec,72,4));
        $this->charge = (float)trim(substr($atomrec,78,2));
        $x = (double) trim(substr($atomrec,30,8));
        $y = (double) trim(substr($atomrec,38,8));
        $z = (double) trim(substr($atomrec,46,8));
        $this->xyz = new Science_Chemistry_Coordinates(array($x, $y, $z));
        $element = trim(substr($atomrec,76,2));
        // if no element is present, use the atom_name
        $this->element = (preg_match('/^[A-Z]{1,2}/', $element)) ? $element : $this->atom_name;
    }

    function getField($field) {
        // mapping needed so we follow both the PEAR
        // variable naming convention, and the PDB
        // standard field naming convention
        $map = array (
                    "RecName"       => "rec_name",
                    "SerNum"        => "ser_num",
                    "AtomName"      => "atom_name",
                    "AltLoc"        => "alt_loc",
                    "ResName"       => "res_name",
                    "ChainID"       => "chain_id",
                    "ResSeqNum"     => "res_seq_num",
                    "InsCode"       => "ins_code",
                    "Ocuppancy"     => "ocuppancy",
                    "TempFactor"    => "temp_factor",
                    "SegmentID"     => "segment_id",
                    "Charge"        => "charge",
                    "Element"       => "element"
                );
        // for coordinates index mapping
        $cmap = array ("X"=>0, "Y"=>1, "Z"=>2);

        if (in_array($field, array_keys($map))) {
            $internal_name = $map[$field];
            return $this->$internal_name;
        } elseif (in_array(strtoupper($field), array_keys($cmap))) {
            $index = $cmap[strtoupper($field)];
            return $this->xyz->coords[$index];
        } else {
            return null;
        }
    }
}

// vim: expandtab: ts=4: sw=4
?>
