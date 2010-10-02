<?php
set_time_limit(0);

require "Science/Chemistry/PDBFile.php";
$file = new Science_Chemistry_PDBFile("small.pdb");
//$file = new Science_Chemistry_PDBFile("1hca.pdb");
for ($j=0; $j < $file->num_macromolecules; $j++) {
	$mol =& $file->macromolecules[$j];
	echo $mol->toCML("model", ($j + 1));
	/*
	for ($i=0; $i < $mol->num_molecules; $i++) {
		echo $mol->molecules[$i]->id." - atoms: ";
		echo $mol->molecules[$i]->num_atoms."\n";
	}
	*/
	echo "\n================\n\n";
}

?>
