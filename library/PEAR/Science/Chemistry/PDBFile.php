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
// $Id: PDBFile.php,v 1.5 2003/05/13 01:18:17 jmcastagnetto Exp $
//

require_once "Science/Chemistry/Macromolecule_PDB.php";

/**
 * Represents a PDB file, composed of one or more Science_Chemistry_Macromolecule_PDB objects
 *
 * @author  Jesus M. Castagnetto <jmcastagnetto@php.net>
 * @version 1.0
 * @access  public
 * @package Science_Chemistry
 * @see     Science_Chemistry_PDBParser
 */
class Science_Chemistry_PDBFile {

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
     * @var     string
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
     * Array of meta records
     *
     * @var     array
     * @access  private
     */
    var $meta;

    /**
     * Array of macromolecular objects
     *
     * @var     array
     * @access  private
     */
    var $macromolecules;

    /**
     * Number of molecules/subunits
     *
     * @var     int
     * @access  private
     */
    var $num_macromolecules;

    /**
     * Constructor for the class, requires a PDB filename
     * 
     * @param   string  $filename
     * @return  object  PDBFile;
     * @access  public
     * @see     $pdb
     * @see     $file
     * @see     mkArrays()
     */
    function Science_Chemistry_PDBFile($filename, $usemeta=false) {
        if (!file_exists($filename))
            return null;
        list($pdb,) = explode(".",basename($filename));
        $this->pdb = $pdb;
        $this->file = realpath($filename);
        $this->parseFile(file($filename), $usemeta);
    }

    /**
     * Makes the arrays of all present PDB record types
     *
     * @param   array   $arr    array of lines
     * @access  private
     * @see     Science_Chemistry_Macromolecule_PDB()
     */
	function parseFile($arr, $usemeta) {
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
			$rectype = trim(strtok($arr[$i]," "));
            
            // check if we have multi-model file
            if ($rectype == "MODEL") {
                $flag = "model";
                continue;
            }

            // create the meta array and accumulate the atom records
            if ($rectype != "ATOM" && $rectype != "HETATM") {
                if ($usemeta) {
                    $this->meta[$rectype][] = trim($arr[$i]);
                } else {
                    continue;
                }
            } else {
                $tmparr[] = $arr[$i];
            }

            // did we get a multi-model file and are parsing the end
            // of a model, if so, create new macromolecule and change
            // the flag
            if ($rectype == "ENDMDL") {
                $this->macromolecules[] = new Science_Chemistry_Macromolecule_PDB($this->pdb, 
                                                $tmparr, &$this);
                $this->num_macromolecules++;
                $flag = "endmodel";
                $tmparr = array();
            }
		}
        // if we got to the end without hitting a MODEL ... ENDMDL pair
        // add the only macromolecule in this file to the array
        if ($flag == "nomodel") {
            $this->macromolecules[] = new Science_Chemistry_Macromolecule_PDB(&$this->pdb, 
                                            &$tmparr, &$this);
            $this->num_macromolecules++;
        }
	}

    /**
     * Returns a CML representation of the PDB file
     * TODO
     *
     * @return  string
     * @access  public
     */
    function toCML() {
        // TODO
    }
    
} // end of PDBFile

// vim: expandtab: ts=4: sw=4
?>
