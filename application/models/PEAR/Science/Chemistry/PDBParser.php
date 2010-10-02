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
// $Id: PDBParser.php,v 1.4 2003/01/04 11:56:25 mj Exp $
//

/**
 * A self-contained class to parse a PDB file into an array of residues
 * each containing an array of atoms
 * <br>
 * Useful when dealing with big PDB files, where using the Science_Chemistry_PDBFile
 * class will generate out of memory errors.
 *
 * @author  Jesus M. Castagnetto <jmcastagnetto@php.net>
 * @version 1.0
 * @access  public
 * @package Science_Chemistry
 * @see     Science_Chemistry_PDBFile
 */
class Science_Chemistry_PDBParser {

    /**
     * PDB ID
     *
     * @var     string
     * @access   private
     */
    var $pdb;

    /**
     * Full path to PDB file
     *
     * @var     string
     * @access  private
     */
    var $file;

    /**
     * PDB file's date
     *
     * @var     date
     * @access  private
     */
    var $date;

    /**
     * PDB macromolecule(s) class
     *
     * @var     string
     * @access  private
     */
    var $class;

    /**
     * Array of macromolecules
     *
     * @var     array
     * @access  private
     */
    var $macromolecules;

    /**
     * Number of macromolecules
     *
     * @var     int
     * @access  private
     */
    var $num_macromolecules;

    /**
     * Constructor for the class, requires a PDB filename
     * 
     * @param   string  $filename   PDB filename
     * @param   boolean $multi  whether to parse all models in a multi-model file
     * @param   boolean $meta   whether to store the PDB file meta information
     * @param   boolean $full   whether to store the full set of fields per atom
     * @return  object  PDBParser
     * @access  public
     * @see     parseResidues()
     */
    function Science_Chemistry_PDBParser($filename, $multi=false, $meta=false, $full=false) {
        if (!file_exists($filename))
            return null;
        list($pdb,) = explode(".",basename($filename));
        $this->pdb = $pdb;
        $this->file = realpath($filename);
        $arr = file($filename);
        // parsing the PDB file
        $month = array (
                "JAN" => "01", "FEB" => "02", "MAR" => "03",
                "APR" => "04", "MAY" => "05", "JUN" => "06",
                "JUL" => "07", "AUG" => "08", "SEP" => "09",
                "OCT" => "10", "NOV" => "11", "DEC" => "12"
                );
        $header_re = "/^HEADER[[:space:]]+(([^[:space:]]+ )+)[[:space:]]+";
        $header_re .= "([0-9]{2}-[A-Z]{3}-[0-9]{2,4})[[:space:]]+[A-Z0-9]{4}/";

        if (preg_match($header_re, $arr[0], &$regs)) {
            $this->class = trim($regs[1]);
            // put date in a more standard format
            $tmp = explode("-", $regs[3]);
            if ($tmp[2] <= 23)
                $year = 2000 + (int)$tmp[2];
            else
                $year = 1900 + (int)$tmp[2];
            $this->date = $year."-".$month[$tmp[1]]."-".$tmp[0];
        }
        
        $flag = "nomodel";
        $tmparr = array();
        for ($i=0; $i < count($arr); $i++) {
			if (!trim($arr[$i]))
                continue;
			$rectype = strtok($arr[$i]," ");
            
            // check if we have multi-model file
            if ($rectype == "MODEL")
                continue;

            // did we get a multi-model file and are parsing the end
            // of a model, if so, end parsing altogether
            if ($rectype == "ENDMDL") {
                if ($multi) {
                    $this->macromolecules[] = $this->parseResidues(&$tmparr, $full);
                    $this->num_macromolecules++; // = count($this->macromolecules);
                    $tmparr = array();
                } else {
                    break;
                }
                continue;
            }

            // accumulate atom records, put the rest into the meta array
            if ($rectype == "ATOM" || $rectype == "HETATM")
                $tmparr[] = $arr[$i];
            elseif ($meta)
                $this->meta[$rectype][] = $arr[$i];
		}
        if (!empty($tmparr)) {
            $this->macromolecules[] = $this->parseResidues(&$tmparr, $full);
            $this->num_macromolecules++; // = count($this->macromolecules);
        }
	}

    /**
     * Makes the array of residues in the macromolecule
     *
     * @param   array   $records
     * @param   boolean $full   whether to store the full set of fields per atom
     * @see     parseFile()
     * @see     parseAtom()
     */
	function parseResidues($records, $full) {
        $curr_res_id = "";
        $residues = array();
        $res_atoms = array();
        for ($i=0; $i< count($records); $i++) {
            $atomrec =& $records[$i];
            $res_name = trim(substr($atomrec,17,3));
            $chain = trim(substr($atomrec,21,1));
            $seq_num = (int) trim(substr($atomrec,22,4));
            $res_id = $res_name.":".$seq_num.":".$chain;
            
            //if ($i == 0)
              //  $curr_res_id = $res_id;

            if ($res_id == $curr_res_id) {
                $res_atoms[] = $atomrec;
                if ($i != (count($records) - 1))
                    continue;
            }

            if (($res_id != $curr_res_id) || 
                ($i == (count($records) - 1))
                ) {
                if (!empty($res_atoms)) {
                    for ($j=0; $j < count($res_atoms); $j++) {
                        $temp = $this->parseAtom($res_atoms[$j], $full, &$atomname);
                        $residues[$curr_res_id][$atomname] = $temp;
                    }
                }
                $curr_res_id = $res_id;
                $res_atoms = array($atomrec);
            }
        }
        return $residues;
	}

    /**
     * Parses an atom record into an associative array
     *
     * @param   string  $atomrec    PDB atom record
     * @param   boolean $full   whether to store the full set of fields per atom
     * @see     parseResidues()
     */
    function parseAtom($atomrec, $full, &$atomname) {
        $atom = array();
        // process PDB atom record
        // no error checking, assumes correct and standard record
        $atom["RecName"] = trim(substr($atomrec,0,6));
        $atom["SerNum"] = (int) trim(substr($atomrec,6,5));
        $atom["AtomName"] = trim(substr($atomrec,12,4));
        $atomname = $atom["AtomName"];
        if ($full) {
            $atom["AltLoc"] = trim(substr($atomrec,16,1));
            $atom["ResName"] = trim(substr($atomrec,17,3));
            $atom["ChainID"] = trim(substr($atomrec,21,1));
            $atom["ResSeqNum"] = (int) trim(substr($atomrec,22,4));
            $atom["InsCode"] = trim(substr($atomrec,26,1));
            $atom["Occupancy"] = (float) trim(substr($atomrec,54,6));
            $atom["TempFactor"] = (float) trim(substr($atomrec,60,6));
            $atom["SegmentID"] = trim(substr($atomrec,72,4));
            $atom["Charge"] = (float)trim(substr($atomrec,78,2));
            $atom["Element"] = trim(substr($atomrec,76,2));
        }
        $atom["X"] = (double) trim(substr($atomrec,30,8));
        $atom["Y"] = (double) trim(substr($atomrec,38,8));
        $atom["Z"] = (double) trim(substr($atomrec,46,8));
        return $atom;
    }

    /**
     * Returns an array of residues with a particular name
     * from the indicated macromolecule index
     *
     * @param   integer $macromol   Index of the macromolecule in the $macromolecules array
     * @param   string  $resnam     Residue name, e.g. HIS, CYS, etc.
     * @return  array   list of residues with the requested name
     * @access  public
     * @see     $macromolecules
     */
    function getResidueList ($macromol, $resname) {
        $mol =& $this->macromolecules[$macromol];
        $reslist = array();
        if (!$mol)
            return $reslist;
        foreach($mol as $resid=>$atoms) {
            list($curr_res_name,,) = explode(":",$resid);
        //    echo $curr_res_name."***\n";
            if ($curr_res_name == $resname)
                $reslist[$resid] = $atoms;
            else
                continue;
            
        }
        return $reslist;
    }

} // end of PDBParser

// vim: expandtab: ts=4: sw=4
?>
