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
// $Id: Element.php,v 1.3 2003/01/04 11:56:25 mj Exp $
//

/**
 * Utility class that defines a chemical element object
 *
 * @author  Jesus M. Castagnetto <jmcastagnetto@php.net>
 * @version 1.0
 * @access  public
 * @package Science_Chemistry
 */
class Science_Chemistry_Element {

    /**
     * Element's symbol, one or two characters, case sensitive
     *
     * @var     string
     * @access  public
     */
    var $symbol;

    /**
     * Element's name
     *
     * @var     string
     * @access  public
     */
    var $name;

    /**
     * Element's atomic number
     *
     * @var     integer
     * @access  public
     */
    var $number;

    /**
     * Element's atomic weight in a.m.u (atomic mass units)
     *
     * @var     float
     * @access  public
     */
    var $weight;

    /**
     * Element's melting point, with comments
     *
     * @var     string
     * @access  public
     */
    var $melting_point;

    /**
     * Element's boiling point, with comments
     *
     * @var     string
     * @access  public
     */
    var $boiling_point;

    /**
     * Element's family
     *
     * @var     string
     * @access  public
     */
    var $family;

    /**
     * Constructor for the class
     *
     * @param   string  $sym    element symbol
     * @param   string  $name   element name
     * @param   integer $num    atomic number
     * @param   float   $wgt    atomic weight
     * @param   string  $mp     melting point (with comments)
     * @param   string  $bp     boiling point (with comments)
     * @param   string  $fam    family
     * @return  object  Science_Chemistry_Element
     * @access  public
     */
    function Science_Chemistry_Element ($sym, $name, $num, $wgt, $mp, $bp, $fam) {
        $this->symbol = $sym;
        $this->name = $name;
        $this->number = $num;
        $this->weight = $wgt;
        $this->melting_point = $mp;
        $this->boiling_point = $b;
        $this->family = $fam;
    }

    /**
     * Checks if an object is a Science_Chemistry_Element instance
     *
     * @param   object  Science_Chemistry_Element $obj
     * @return  boolean 
     * @access  public
     */
    function isElement($obj) {
        return (is_object($obj) &&
                (get_class($obj) == "Science_Chemistry_Element" ||
                 is_subclass_of($obj, "Science_Chemistry_Element"))
               );
    }

} // end of Science_Chemistry_Element

// vim: expandtab: ts=4: sw=4
?>
