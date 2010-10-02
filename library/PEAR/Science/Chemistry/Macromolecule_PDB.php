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
// $Id: Macromolecule_PDB.php,v 1.4 2003/05/13 01:18:17 jmcastagnetto Exp $
//

require_once "Science/Chemistry/Macromolecule.php";
require_once "Science/Chemistry/Residue_PDB.php";

/**
 * Represents a PDB macromolecule, composed of several
 * Science_Chemistry_Residue_PDB objects
 *
 * @author  Jesus M. Castagnetto <jmcastagnetto@php.net>
 * @version 1.0
 * @access  public
 * @package Science_Chemistry
 */
class Science_Chemistry_Macromolecule_PDB extends Science_Chemistry_Macromolecule {

    /**
     * Constructor for the class
     * 
     * @param   string $pdb PDB ID of the containing file
     * @param   array  $records Array of lines comprising the macromolecule
     * @param   object  PDBFile $pdbfile    reference to the PDB file object
     * @return  object  Science_Chemistry_Macromolecule_PDB
     * @access  public
     * @see     $pdb
     * @see     parseResidues()
     */
    function Science_Chemistry_Macromolecule_PDB($pdb, $records, $pdbfile="") {
        $this->pdb =& $pdb;
        $this->pdbfile =& $pdbfile;
        $this->parseResidues($records);
    }

    /**
     * Makes the array of residues in the macromolecule
     *
     * @param   array   $records
     * @access  private
     * @see     Science_Chemistry_Macromolecule_PDB()
     */
	function parseResidues($records) {
        $curr_res_id = '';
        $res_atoms = array();
        $nrecs = count($records);
        for ($i=0; $i< $nrecs; $i++) {
            $atomrec = $records[$i];
            $res_name = trim(substr($atomrec,17,3));
            $chain = trim(substr($atomrec,21,1));
            $seq_num = (int) trim(substr($atomrec,22,4));
            $res_id = $res_name.":".$seq_num.":".$chain;
            $res_atoms[$res_id][] = $atomrec;
        }

         foreach ($res_atoms as $mol_id => $atoms_list) {
            $this->molecules[] =& new Science_Chemistry_Residue_PDB(&$this->pdb, 
                                            &$atoms_list, &$this);
            $this->num_molecules++;
        }
        return true;
	}
} // end of Science_Chemistry_Macromolecule_PDB

// vim: expandtab: ts=4: sw=4
?>
