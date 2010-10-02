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
// $Id: Periodic_Table.php,v 1.4 2003/01/04 11:56:25 mj Exp $
//

require_once "Science/Chemistry.php";

/** 
 * Utility class that defines a Periodic Table of elements
 *
 * @author  Jesus M. Castagnetto <jmcastagnetto@php.net>
 * @version 1.0
 * @access  public
 * @package Science_Chemistry
 */
class Science_Chemistry_Periodic_Table {

    /**
     * The associative array containing the chemical elements
     *
     * @var     array
     * @access  public
     */
    var $periodic_table = array();

    /**
     * Returns a Science_Chemistry_Element object correspoding to the symbol (case sensitive)
     *
     * @param   string  $symbol
     * @return  object Science_Chemistry_Element
     * @access  public
     */
    function getElement($symbol) {
        if (empty($this->periodic_table))
            initTable();
        $elem = $this->periodic_table[$symbol];
        if (Science_Chemistry_Element::isElement($elem))
            return $elem;
        else
            return null;
    }

    /**
     * Returns an array of Science_Chemistry_Element objects belonging to an element family
     *
     * @param   string  $family
     * @return  array   Science_Chemistry_Element objects
     * @access  public
     */
    function getElementFamily($family) {
        if (empty($this->periodic_table))
            initTable();
        $elemlist = array();
        foreach ($this->periodic_table as $sym=>$elem)
            if ($elem->family == $family)
                $elemlist[$sym] = $elem;
        return $elemlist;
    }

    /**
     * Initializes the Periodic Table array
     *
     * @access  public
     */
    function initTable() {
		$periodic_table["H"] = new Science_Chemistry_Element("H", "Hydrogen",
			1,1.0079, "-255.34", "-252.87", "");
		$periodic_table["He"] = new Science_Chemistry_Element("He", "Helium",
			2,4.00260, "< -272.2", "-268.934", "Noble gas");
		$periodic_table["Li"] = new Science_Chemistry_Element("Li", "Lithium",
			3,6.941, "180.54", "1342", "Alkaline");
		$periodic_table["Be"] = new Science_Chemistry_Element("Be", "Beryllium",
			4,9.01218, "1278", "2970", "Alkaline Earth");
		$periodic_table["B"] = new Science_Chemistry_Element("B", "Boron",
			5,10.81, "2079", "2550", "");
		$periodic_table["C"] = new Science_Chemistry_Element("C", "Carbon",
			6,12.011, "3550", "4827", "");
		$periodic_table["N"] = new Science_Chemistry_Element("N", "Nitrogen",
			7,14.0067, "-209.86", "-195.8", "");
		$periodic_table["O"] = new Science_Chemistry_Element("O", "Oxygen",
			8,15.9994, "-218.4", "-182.962", "");
		$periodic_table["F"] = new Science_Chemistry_Element("F", "Fluorine",
			9,18.9984, "-219.62", "-188", "Halogen");
		$periodic_table["Ne"] = new Science_Chemistry_Element("Ne", "Neon",
			10,20.179, "-248.67", "-246.048", "Noble gas");
		$periodic_table["Na"] = new Science_Chemistry_Element("Na", "Sodium",
			11,22.9898, "97.81", "882.9", "Alkaline");
		$periodic_table["Mg"] = new Science_Chemistry_Element("Mg", "Magnesium",
			12,24.305, "648.8", "1090", "Alkaline Earth");
		$periodic_table["Al"] = new Science_Chemistry_Element("Al", "Aluminum",
			13,26.9815, "660.37", "2467", "");
		$periodic_table["Si"] = new Science_Chemistry_Element("Si", "Silicon",
			14,28.0855, "1410", "2355", "");
		$periodic_table["P"] = new Science_Chemistry_Element("P", "Phosphorus",
			15,30.9738, "44.1", "280", "");
		$periodic_table["S"] = new Science_Chemistry_Element("S", "Sulfur",
			16,32.06, "112.8 (rhombic); 119.0 (monoclinic)", "4.6", "");
		$periodic_table["Cl"] = new Science_Chemistry_Element("Cl", "Chlorine",
			17,35.453, "-100.98", "-34", "Halogen");
		$periodic_table["Ar"] = new Science_Chemistry_Element("Ar", "Argon",
			18,39.948, "-189.2", "-185.7", "Noble gas");
		$periodic_table["K"] = new Science_Chemistry_Element("K", "Potassium",
			19,39.0983, "63.25", "759.9", "Alkaline");
		$periodic_table["Ca"] = new Science_Chemistry_Element("Ca", "Calcium",
			20,40.078, "839", "1484", "Alkaline Earth");
		$periodic_table["Sc"] = new Science_Chemistry_Element("Sc", "Scandium",
			21,44.9579, "1541", "2836", "Transition Metal");
		$periodic_table["Ti"] = new Science_Chemistry_Element("Ti", "Titanium",
			22,47.88, "1660", "3287", "Transition Metal");
		$periodic_table["V"] = new Science_Chemistry_Element("V", "Vanadium",
			23,50.9415, "1890", "3380", "Transition Metal");
		$periodic_table["Cr"] = new Science_Chemistry_Element("Cr", "Chromium",
			24,51.996, "1857", "2672", "Transition Metal");
		$periodic_table["Mn"] = new Science_Chemistry_Element("Mn", "Manganese",
			25,54.9380, "1244", "1962", "Transition Metal");
		$periodic_table["Fe"] = new Science_Chemistry_Element("Fe", "Iron",
			26,55.847, "1535", "2750", "Transition Metal");
		$periodic_table["Co"] = new Science_Chemistry_Element("Co", "Cobalt",
			27,58.9332, "1857", "2672", "Transition Metal");
		$periodic_table["Ni"] = new Science_Chemistry_Element("Ni", "Nickel",
			28,58.69, "1453", "2732", "Transition Metal");
		$periodic_table["Cu"] = new Science_Chemistry_Element("Cu", "Copper",
			29,63.546, "1083", "2567", "Transition Metal");
		$periodic_table["Zn"] = new Science_Chemistry_Element("Zn", "Zinc",
			30,65.38, "419.58", "907", "Transition Metal");
		$periodic_table["Ga"] = new Science_Chemistry_Element("Ga", "Gallium",
			31,69.72, "29.78", "2403", "");
		$periodic_table["Ge"] = new Science_Chemistry_Element("Ge", "Germanium",
			32,72.59, "937.4", "2830", "");
		$periodic_table["As"] = new Science_Chemistry_Element("As", "Arsenic",
			33,74.9216, "817", "613", "");
		$periodic_table["Se"] = new Science_Chemistry_Element("Se", "Selenium",
			34,78.96, "50 (amorphous); 217 (gray form)", "685", "");
		$periodic_table["Br"] = new Science_Chemistry_Element("Br", "Bromine",
			35,79.904, "-7.2", "58.78", "Halogen");
		$periodic_table["Kr"] = new Science_Chemistry_Element("Kr", "Krypton",
			36,83.80, "-156.6", "-152.30", "Noble gas");
		$periodic_table["Rb"] = new Science_Chemistry_Element("Rb", "Rubidium",
			37,85.4678, "38.89", "686", "Alkaline");
		$periodic_table["Sr"] = new Science_Chemistry_Element("Sr", "Strontium",
			38,87.62, "769", "1384", "Alkaline Earth");
		$periodic_table["Y"] = new Science_Chemistry_Element("Y", "Yttrium",
			39,88.9059, "1522", "5338", "Transition Metal");
		$periodic_table["Zr"] = new Science_Chemistry_Element("Zr", "Zirconium",
			40,91.22, "1852", "4377", "Transition Metal");
		$periodic_table["Nb"] = new Science_Chemistry_Element("Nb", "Niobium",
			41,92.9064, "2468", "4742", "Transition Metal");
		$periodic_table["Mo"] = new Science_Chemistry_Element("Mo", "Molybdenum",
			42,95.94, "2617", "4612", "Transition Metal");
		$periodic_table["Tc"] = new Science_Chemistry_Element("Tc", "Technetium",
			43,97.9072, "2172", "4877", "Transition Metal");
		$periodic_table["Ru"] = new Science_Chemistry_Element("Ru", "Ruthenium",
			44,101.07, "2310", "3900", "Transition Metal");
		$periodic_table["Rh"] = new Science_Chemistry_Element("Rh", "Rhodium",
			45,102.9055, "1966", "3727", "Transition Metal");
		$periodic_table["Pd"] = new Science_Chemistry_Element("Pd", "Palladium",
			46,106.42, "1554", "3140", "Transition Metal");
		$periodic_table["Ag"] = new Science_Chemistry_Element("Ag", "Silver",
			47,107.8682, "961.93", "2212", "Transition Metal");
		$periodic_table["Cd"] = new Science_Chemistry_Element("Cd", "Cadmium",
			48,112.41, "320.9", "765", "Transition Metal");
		$periodic_table["In"] = new Science_Chemistry_Element("In", "Indium",
			49,114.82, "156.61", "2080", "");
		$periodic_table["Sn"] = new Science_Chemistry_Element("Sn", "Tin",
			50,118.69, "231.97", "2270", "");
		$periodic_table["Sb"] = new Science_Chemistry_Element("Sb", "Antimony",
			51,121.79, "630.74", "1750", "");
		$periodic_table["Te"] = new Science_Chemistry_Element("Te", "Tellurium",
			52,127.60, "449.5", "4877", "");
		$periodic_table["I"] = new Science_Chemistry_Element("I", "Iodine",
			53,126.9045, "113.5", "184.35", "Halogen");
		$periodic_table["Xe"] = new Science_Chemistry_Element("Xe", "Xenon",
			54,131.29, "-111.9", "-107.1", "Noble gas");
		$periodic_table["Cs"] = new Science_Chemistry_Element("Cs", "Cesium",
			55,132.9054, "28.40", "669.3", "Alkaline");
		$periodic_table["Ba"] = new Science_Chemistry_Element("Ba", "Barium",
			56,137.33, "725", "1640", "Alkaline Earth");
		$periodic_table["La"] = new Science_Chemistry_Element("La", "Lanthanum",
			57,138.9055, "918", "3464", "Lanthanide");
		$periodic_table["Ce"] = new Science_Chemistry_Element("Ce", "Cerium",
			58,140.12, "798", "3443", "Lanthanide");
		$periodic_table["Pr"] = new Science_Chemistry_Element("Pr", "Praseodymium",
			59,140.9077, "931", "3520", "Lanthanide");
		$periodic_table["Nd"] = new Science_Chemistry_Element("Nd", "Neodymium",
			60,144.24, "1021", "3074", "Lanthanide");
		$periodic_table["Pm"] = new Science_Chemistry_Element("Pm", "Promethium",
			61,144.9127, "1042", "3000", "Lanthanide");
		$periodic_table["Sm"] = new Science_Chemistry_Element("Sm", "Samarium",
			62,150.36, "1074", "1794", "Lanthanide");
		$periodic_table["Eu"] = new Science_Chemistry_Element("Eu", "Europium",
			63,151.96, "822", "1527", "Lanthanide");
		$periodic_table["Gd"] = new Science_Chemistry_Element("Gd", "Gadolinium",
			64,157.27, "1313", "3273", "Lanthanide");
		$periodic_table["Tb"] = new Science_Chemistry_Element("Tb", "Terbium",
			65,158.9254, "1356", "3230", "Lanthanide");
		$periodic_table["Dy"] = new Science_Chemistry_Element("Dy", "Dysprosium",
			66,162.50, "1412", "2567", "Lanthanide");
		$periodic_table["Ho"] = new Science_Chemistry_Element("Ho", "Holmium",
			67,164.9304, "1474", "2700", "Lanthanide");
		$periodic_table["Er"] = new Science_Chemistry_Element("Er", "Erbium",
			68,167.26, "1529", "2868", "Lanthanide");
		$periodic_table["Tm"] = new Science_Chemistry_Element("Tm", "Thulium",
			69,168.9342, "1545", "1950", "Lanthanide");
		$periodic_table["Yb"] = new Science_Chemistry_Element("Yb", "Ytterbium",
			70,172.04, "819", "1196", "Lanthanide");
		$periodic_table["Lu"] = new Science_Chemistry_Element("Lu", "Lutetium",
			71,174.967, "1663", "3402", "Lanthanide");
		$periodic_table["Hf"] = new Science_Chemistry_Element("Hf", "Hafnium",
			72,178.49, "2227", "4602", "Transition Metal");
		$periodic_table["Ta"] = new Science_Chemistry_Element("Ta", "Tantalum",
			73,180.9479, "2996", "5425", "Transition Metal");
		$periodic_table["W"] = new Science_Chemistry_Element("W", "Tungsten",
			74,183.85, "3410", "5660", "Transition Metal");
		$periodic_table["Re"] = new Science_Chemistry_Element("Re", "Rhenium",
			75,186.207, "3180", "5627", "Transition Metal");
		$periodic_table["Os"] = new Science_Chemistry_Element("Os", "Osmium",
			76,190.2, "3054", "5027", "Transition Metal");
		$periodic_table["Ir"] = new Science_Chemistry_Element("Ir", "Iridium",
			77,192.22, "2410", "4130", "Transition Metal");
		$periodic_table["Pt"] = new Science_Chemistry_Element("Pt", "Platinum",
			78,195.08, "1772", "3827", "Transition Metal");
		$periodic_table["Au"] = new Science_Chemistry_Element("Au", "Gold",
			79,196.9665, "1064.4", "2808", "Transition Metal");
		$periodic_table["Hg"] = new Science_Chemistry_Element("Hg", "Mercury",
			80,200.59, "-38.87", "356.58", "Transition Metal");
		$periodic_table["Tl"] = new Science_Chemistry_Element("Tl", "Thallium",
			81,204.383, "303.5", "1457", "");
		$periodic_table["Pb"] = new Science_Chemistry_Element("Pb", "Lead",
			82,207.2, "327.502", "1740", "");
		$periodic_table["Bi"] = new Science_Chemistry_Element("Bi", "Bismuth",
			83,208.9804, "271.3", "1560", "");
		$periodic_table["Po"] = new Science_Chemistry_Element("Po", "Polonium",
			84,208.9824, "254", "962", "");
		$periodic_table["At"] = new Science_Chemistry_Element("At", "Astatine",
			85,209.9871, "302", "337", "Halogen");
		$periodic_table["Rn"] = new Science_Chemistry_Element("Rn", "Radon",
			86,222.0176, "-71", "-62", "Noble gas");
		$periodic_table["Fr"] = new Science_Chemistry_Element("Fr", "Francium",
			87,223.0197, "27", "677", "Alkaline");
		$periodic_table["Ra"] = new Science_Chemistry_Element("Ra", "Radium",
			88,226.0254, "700", "1140", "Alkaline Earth");
		$periodic_table["Ac"] = new Science_Chemistry_Element("Ac", "Actinium",
			89,227.0278, "1050", "3200", "Actinide");
		$periodic_table["Th"] = new Science_Chemistry_Element("Th", "Thorium",
			90,232.0381, "1750", "3800", "Actinide");
		$periodic_table["Pa"] = new Science_Chemistry_Element("Pa", "Protactinium",
			91,231.0359, "1600", "unknown", "Actinide");
		$periodic_table["U"] = new Science_Chemistry_Element("U", "Uranium",
			92,238.0289, "1132", "3818", "Actinide");
		$periodic_table["Np"] = new Science_Chemistry_Element("Np", "Neptunium",
			93,237.0482, "640", "3902", "Actinide");
		$periodic_table["Pu"] = new Science_Chemistry_Element("Pu", "Plutonium",
			94,244.0642, "641", "3232", "Actinide");
		$periodic_table["Am"] = new Science_Chemistry_Element("Am", "Americium",
			95,243.0614, "994", "2607", "Actinide");
		$periodic_table["Cm"] = new Science_Chemistry_Element("Cm", "Curium",
			96,247.0703, "1340", "unknown", "Actinide");
		$periodic_table["Bk"] = new Science_Chemistry_Element("Bk", "Berkelium",
			97,247.0703, "unknown", "unknown", "Actinide");
		$periodic_table["Cf"] = new Science_Chemistry_Element("Cf", "Californium",
			98,251.0796, "unknown", "unknown", "Actinide");
		$periodic_table["Es"] = new Science_Chemistry_Element("Es", "Einsteinium",
			99,252.083, "unknown", "unknown", "Actinide");
		$periodic_table["Fm"] = new Science_Chemistry_Element("Fm", "Fermium",
			100,257.0951, "unknown", "unknown", "Actinide");
		$periodic_table["Md"] = new Science_Chemistry_Element("Md", "Mendelevium",
			101,258.10, "unknown", "unknown", "Actinide");
		$periodic_table["No"] = new Science_Chemistry_Element("No", "Nobelium",
			102,259.1009, "unknown", "unknown", "Actinide");
		$periodic_table["Lr"] = new Science_Chemistry_Element("Lr", "Lawrencium",
			103,262.11, "unknown", "unknown", "Actinide");
		$periodic_table["Unq (Rf)"] = new Science_Chemistry_Element("Unq (Rf)", "Unnilquadium (Rutherfordium)",
			104,261.11, "unknown", "unknown", "");
		$periodic_table["Unp (Db)"] = new Science_Chemistry_Element("Unp (Db)", "Unnilpentium (Dubnium)",
			105,262.114, "unknown", "unknown", "");
		$periodic_table["Unh (Sg)"] = new Science_Chemistry_Element("Unh (Sg)", "Unnilhexium (Seaborgium)",
			106,263.118, "unknown", "unknown", "");
		$periodic_table["Uns (Bh)"] = new Science_Chemistry_Element("Uns (Bh)", "Unnilseptium (Bohrium)",
			107,262.12, "unknown", "unknown", "");
		$periodic_table["Uno (Hs)"] = new Science_Chemistry_Element("Uno (Hs)", "Unniloctium (Hassium)",
			108,-1, "unknown", "unknown", "");
		$periodic_table["Une (Mt)"] = new Science_Chemistry_Element("Une (Mt)", "Unnilennium (Meitnerium)",
			109,-1, "unknown", "unknown", "");
    }
    
} // end of Science_Chemistry_Periodic_Table

// vim: expandtab: ts=4: sw=4
?>
