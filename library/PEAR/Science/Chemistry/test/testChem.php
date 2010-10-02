<pre>
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
// $Id: testChem.php,v 1.3 2003/01/04 11:56:25 mj Exp $
//

require_once "Science/Chemistry.php";
require_once "Science/Chemistry/Molecule_XYZ.php";
require_once "Science/Chemistry/Macromolecule.php";

echo "Creating and printing an atom\n";
$a = new Science_Chemistry_Atom("N", array(2.3,4.5,-2.1));
echo $a->toString()."\n";
echo "Creating a second atom and calculating distance to first one\n";
$b = new Science_Chemistry_Atom("C", array(1.2,3.4,-1.6));
echo $b->toString()."\n";
echo "\nDistance N to C: ".sprintf("%.4f", $a->distance($b))." Angstroms\n";
//print_r($a);
//print_r($b);

echo "\n=====\nReading a molecule:\n";
$m = new Science_Chemistry_Molecule_XYZ("his.xyz");
echo "\$m is a molecule: ".(int)Science_Chemistry_Molecule::isMolecule($m)."\n";
echo $m->toString();
//echo "Calculating Distance Matrix\n";
//$m->printDistanceMatrix();
//echo "Calculating Connection Table\n";
//$m->printConnectionTable();
//echo $m->toCML("Histidine","His", true);
//print_r($m);
//print_r($m->getConnectionTable());
//$start=time();

$n = new Science_Chemistry_Molecule_XYZ("lys.xyz");

$mols = array($m, $n);

$big = new Science_Chemistry_Macromolecule("big one", $mols);

echo $big->toString();
echo $big->toCML("biggie", "big", true);

?>
</pre>
