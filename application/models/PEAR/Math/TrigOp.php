<?php
//
// +----------------------------------------------------------------------+
// | PHP Version 4                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997-2002 The PHP Group                                |
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
// $Id: TrigOp.php,v 1.1 2002/11/24 07:16:24 jmcastagnetto Exp $
//

require_once 'PEAR.php';

/**
 * Static class implementing supplementary trigonometric functions
 *
 * Example of use:
 *
 * $cot = Math_TrigOp::cot(0.3445);
 * $x = Math_TrigOp::acsch(-0.231);
 * 
 * Originally this class was part of NumPHP (Numeric PHP package)
 *
 * @author	Jesus M. Castagnetto <jmcastagnetto@php.net>
 * @version	1.0
 * @access	public
 * @package	Math_TrigOp
 */

class Math_TrigOp {/*{{{*/

	// supplementary trigonometric functions
	
	/**
	 * Calculates the secant of the parameter
	 * 
	 * @param float $x
	 * @returns mixed A floating point on success, PEAR_Error object otherwise
	 * @access public
	 */
	function sec($x) {/*{{{*/
		$x = floatval($x);
		$cos = cos($x);
		if ($cos == 0.0) {
			return PEAR::raiseError('Undefined operation, cosine of parameter is zero');
		} else {
			return 1/$cos;
		}
	}/*}}}*/

	/**
	 * Calculates the cosecant of the parameter
	 * 
	 * @param float $x
	 * @returns mixed A floating point on success, PEAR_Error object otherwise
	 * @access public
	 */
	function csc($x) {/*{{{*/
		$x = floatval($x);
		$sin = sin($x);
		if ($sin == 0.0) {
			return PEAR::raiseError('Undefined operation, sine of parameter is zero');
		} else {
			return 1/$sin;
		}
	}/*}}}*/

	/**
	 * Calculates the cotangent of the parameter
	 * 
	 * @param float $x
	 * @returns mixed A floating point on success, PEAR_Error object otherwise
	 * @access public
	 */
	function cot($x) {/*{{{*/
		$x = floatval($x);
		$tan = tan($x);
		if ($tan == 0.0) {
			return PEAR::raiseError('Undefined operation, tangent of parameter is zero');
		} else {
			return 1/$tan;
		}
	}/*}}}*/

	// Hyperbolic functions

	/**
	 * Calculates the hyperbolic secant of the parameter
	 * 
	 * @param float $x
	 * @returns mixed A floating point on success, PEAR_Error object otherwise
	 * @access public
	 */
	function sech ($x) {/*{{{*/
		$x = floatval($x);
		$cosh = cosh($x);
		if ($cosh == 0.0) {
			return PEAR::raiseError('Undefined operation, hyperbolic cosine of parameter is zero');
		} else {
			return 1/$cosh;
		}
	}/*}}}*/

	/**
	 * Calculates the hyperbolic cosecant of the parameter
	 * 
	 * @param float $x
	 * @returns mixed A floating point on success, PEAR_Error object otherwise
	 * @access public
	 */
	function csch ($x) {/*{{{*/
		$x = floatval($x);
		$sinh = sinh($x);
		if ($sinh == 0.0) {
			return PEAR::raiseError('Undefined operation, hyperbolic sine of parameter is zero');
		} else {
			return 1/$sinh;
		}
	}/*}}}*/

	/**
	 * Calculates the hyperbolic cotangent of the parameter
	 * 
	 * @param float $x
	 * @returns mixed A floating point on success, PEAR_Error object otherwise
	 * @access public
	 */
	function coth ($x) {/*{{{*/
		$x = floatval($x);
		$tanh = tanh($x);
		if ($tanh == 0.0) {
			return PEAR::raiseError('Undefined operation, hyperbolic tangent of parameter is zero');
		} else {
			return 1/$tanh;
		}
	}/*}}}*/

	// Inverse hyperbolic functions

	/**
	 * Calculates the inverse hyperbolic secant of the parameter
	 * 
	 * @param float $x
	 * @returns mixed A floating point on success, PEAR_Error object otherwise
	 * @access public
	 */
	function asech ($x) {/*{{{*/
		$x = floatval($x);
		if ($x == 0.0) {
			return PEAR::raiseError('Undefined operation, parameter is zero');
		} else {
			return log((1 + sqrt(1 - $x*$x)) / $x);
		}
	}/*}}}*/

	/**
	 * Calculates the inverse hyperbolic cosecant of the parameter
	 * 
	 * @param float $x
	 * @returns mixed A floating point on success, PEAR_Error object otherwise
	 * @access public
	 */
	function acsch ($x) {/*{{{*/
		$x = floatval($x);
		if ($x == 0.0) {
			return PEAR::raiseError('Undefined operation, parameter is zero');
		} elseif ($x < 0) {
			return PEAR::raiseError('Undefined operation, parameter is negative');
		} else {
			return log((1 + sqrt(1 + $x*$x)) / $x);
		}
	}/*}}}*/

	/**
	 * Calculates the inverse hyperbolic cotangent of the parameter
	 * 
	 * @param float $x
	 * @returns mixed A floating point on success, PEAR_Error object otherwise
	 * @access public
	 */
	function acoth ($x) {/*{{{*/
		$x = floatval($x);
		if ($x == 1.0) {
			return PEAR::raiseError('Undefined operation, parameter is 1.0');
		} else {
			$rat = ($x + 1)/($x - 1);
			if ($rat < 0) {
				return PEAR::raiseError('Undefined operation, (x+1)/(x-1) is negative');
			} else {
				return 0.5*log($rat);
			}
		}
	}/*}}}*/

}/*}}}*/
?>
