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
// $Id: Molecule_XYZ.php,v 1.4 2003/01/04 11:56:25 mj Exp $
//

require_once "Science/Chemistry.php";
require_once "Science/Chemistry/Molecule.php";

/**
 * Base class representing a Molecule from a XYZ format file
 *
 * @author  Jesus M. Castagnetto <jmcastagnetto@php.net>
 * @version 1.0
 * @access  public
 * @package Science_Chemistry
 */
class Science_Chemistry_Molecule_XYZ extends Science_Chemistry_Molecule {

    /**
     * Energy of the molecule. Optional value in XYZ file format.
     *
     * @var float
     * @access public
     */
	var $energy = 0.0;

    /**
     * Constructor for the class, accepts 2 optional parameters:
     * the data and its source. Possible values for $src: "file", "string"
     *
     * @param   optional    string $xyzdata
     * @param   optional    string  $src   one of "file" or "string"
     * @return  object Science_Chemistry_Molecule_XYZ
     * @access  public
     * @see     parseXYZ()
     */
	function Science_Chemistry_Molecule_XYZ($xyzdata="", $src="file") {
		if (!empty($xyzdata))
			if (!$this->parseXYZ($xyzdata, $src))
				return null;
	}

    /**
     * method that does the parsing of the XYZ data itself
     *
     * @param   string  $xyzdata
     * @param   string  $src
     * @return  boolean
     * @access  public
     * @see     Science_Chemistry_Molecule_XYZ()
     */
	function parseXYZ($xyzdata, $src) {
		if ($src == "file") {
			$line = file($xyzdata);
		} elseif ($src == "string") {
			$line = explode("\n", $xyzdata);
		} else {
			return false;
		}
		unset($this->atoms);
		// first line is number of atoms
		$this->num_atoms = trim($line[0]);
		// second line is molecule name and energy
		ereg("^([[:alnum:].]+)[[:space:]]+([[:digit:].-]+)",trim($line[1]),&$re);
		$this->name = trim($re[1]);
		$this->energy = trim($re[2]);
		for ($i=2; $i<count($line); $i++) {
			if (!ereg("^#",$line[$i]) && !ereg("^$", $line[$i])) {
				$this->atoms[] = $this->parseAtom($line[$i]);
			}
		}
	}

    /**
     * Parses an XYZ atom record
     *
     * @param   string  $line
     * @return  object  Science_Chemistry_Atom
     * @access   public
     * @see     parseXYZ()
     */
	function parseAtom($line) {
		list($element, $x, $y, $z) = split("[\t ]+",trim($line));
		return new Science_Chemistry_Atom($element, array($x, $y, $z));
	}

    /**
     * Generates a string representation of the XYZ molecule
     * Overrides parent Science_Chemistry_Molecule::toString() method
     *
     * @return  string
     * @access  public
     */
	function toString() {
		if (!$this->atoms)
			return false;
		$out[] = $this->num_atoms;
		$out[] = $this->name."\t".sprintf("%15f",$this->energy);
		reset($this->atoms);
		for ($i=0; $i<$this->num_atoms; $i++)
			$out[] = $this->atoms[$i]->toString();
		return implode("\n",$out)."\n";
	}

} // end of class Science_Chemistry_Molecule_XYZ

// vim: expandtab: ts=4: sw=4
?>
