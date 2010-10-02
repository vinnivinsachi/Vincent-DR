<?php
// Example of converting from PDB for XYZ
set_time_limit(0);

require_once "Science/Chemistry/PDBFile.php";
$file = new Science_Chemistry_PDBFile($argv[1]);
for ($j=0; $j < $file->num_macromolecules; $j++) {
	$macromol =& $file->macromolecules[$j];
    // use the builtin method for the macromolecule
    echo $macromol->toXYZ();
    // for more control on the printing
    /*
    foreach ($macromol->molecules as $mol) {
        echo $mol->toXYZ();
        $mol->printConnectionTable();
        $mol->printDistanceMatrix();
    }
    */
}

?>
