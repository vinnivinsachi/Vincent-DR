#! /usr/local/bin/php -q
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
// Sample script that uses the Chemistry classes to convert a XYZ file to CML
//
// $Id: xyz2cml.php,v 1.3 2003/01/04 11:56:25 mj Exp $

require_once "Science/Chemistry.php";
require_once "Science/Chemistry/Molecule_XYZ.php";

// save the old value of "track_errors"
$oldtrack = ini_get("track_errors");
// set it so $php_errormsg will be used
ini_set("track_errors", 1);

// Use a local or the original DTD
//$DTDPATH = "http://www.xml-cml.org/cml_10.dtd";
// change the local path
$DTDPATH = "/usr/local/dtd/cml.dtd";

function usage ($extra) {
    global $argv;
    echo $extra;
    echo "Usage:\n\t".basename($argv[0])." xyzfile cmlfile [title] \n\n";
    // restore old "track_errors" value
    ini_set("track_errors", $oldtrack);
    exit -1;
}

if ($argc < 3)
    usage("*ERROR* Wrong number of parameters\n");

// assume that any parameter after the cmlfile name 
// is part of the title
if ($argc > 3)
    for ($i=3; $i < $argc; $i++)
        $title .= $argv[$i]." ";
else
    $title = "molecule";

$date = date("Y-m-d H:i:s T");
$title = trim($title);
$xyz = realpath($argv[1]);
$id = str_replace("/","_", $xyz);
list($moltitle,) = explode(".",basename($xyz));
$cml = $argv[2];

echo "Converting ".$argv[1]." to $cml... ";
// create the molecule object
$mol = new Science_Chemistry_Molecule_XYZ($xyz);

// prepare output
$out = "<?xml version=\"1.0\">
<!DOCTYPE document SYSTEM \"$DTDPATH\" [
<!ELEMENT document ANY>
<!ELEMENT cml ANY>
<!ATTLIST cml
    title CDATA #IMPLIED
    id CDATA #IMPLIED
>
]>
<!-- 
  -- CML document  
  -- converted from: $xyz 
  -- on: $date
  -->\n";
$out .= "<document>\n<cml title=\"$title\" id=\"$id\">\n";
$out .= $mol->toCML($moltitle, $moltitle."1", true);
$out .= "</cml>\n</document>";

// write the output
$fp = @fopen($cml, "w");
if ($fp) {
    fwrite($fp, $out);
    flush();
    fclose($fp);
    echo " finished!\n\n";
} else {
    usage("\n*ERROR* while writing to $cml\n--> $php_errormsg\n");
}

// restore old "track_errors" value
ini_set("track_errors", $oldtrack);
?>
