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
// $Id: Chemistry.php,v 1.3 2003/01/04 11:56:23 mj Exp $
//

require_once "PEAR.php";

/**
 * Package version constant
 */
define (SCIENCE_CHEMISTRY_VERSION, 1.0);

require_once "Science/Chemistry/Element.php";
require_once "Science/Chemistry/Periodic_Table.php";
require_once "Science/Chemistry/Coordinates.php";

// vim: expandtab: ts=4: sw=4
?>
