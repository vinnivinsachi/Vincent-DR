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
// $Id: Fibonacci.php,v 1.1 2003/01/02 01:56:59 jmcastagnetto Exp $
//

include_once 'PEAR.php';
include_once 'Math/IntegerOp.php';
include_once 'Math/Fibonacci/_fibonacciTable.php';

// PHI and phi are the roots of: x^2 - x - 1 = 0
// PHI is called the golden ratio. Also phi = -1/PHI = 1 - PHI
/**
 * MATH_PHI: The golden ratio = (1 + sqrt(5))/2
 */
define ('MATH_PHI', (1 + sqrt(5))/2);
/**
 * MATH_PHI_x100000: (int) (MATH_PHI * 100000)
 */
define ('MATH_PHI_x100000', intval(MATH_PHI * 100000));

/**
 * MATH_phi: The reciprocal of PHI = (1 - sqrt(5))/2
 */
define ('MATH_phi', (1 - sqrt(5))/2);
/**
 * MATH_phi_x100000: (int) (MATH_phi * 100000)
 */
define ('MATH_phi_x100000', intval(MATH_phi * 100000));

/**
 * MATH_SQRT5_x100000: (int) (sqrt(5) * 100000)
 */
define ('MATH_SQRT5_x100000', intval(sqrt(5) * 100000));

/**
 * MATH_LNSQRT5: ln(sqrt(5))
 */
define ('MATH_LNSQRT5', log(sqrt(5)));

/**
 * MATH_LNPHI: ln(PHI)
 */
define ('MATH_LNPHI', log(MATH_PHI));

/**
 * Math_Fibonacci: class to calculate, validate, and decompose into Fibonacci numbers
 *
 * Examples:
 * <pre>
 * include_once 'Math/Fibonacci.php';
 * 
 * $idx = 20;
 * echo "Calculate F($idx), fast equation = ";
 * $fib =& Math_Fibonacci::term($idx);
 * echo $fib->toString()."\n";
 * // Calculate F(20), fast equation = 6765
 * 
 * $idx = 55;
 * echo "Calculate F($idx), lookup table = ";
 * $fib =& Math_Fibonacci::term($idx);
 * echo $fib->toString()."\n";
 * // Calculate F(55), lookup table = 139583862445
 * 
 * $idx = 502;
 * echo "Calculate F($idx), addition loop = ";
 * $fib = Math_Fibonacci::term($idx);
 * echo $fib->toString()."\n";
 * // Calculate F(502), addition loop = 365014740723634211012237077906479355996081581501455497852747829366800199361550174096573645929019489792751
 * 
 * echo "\nSeries from F(0) to F(10):\n";
 * $series = Math_Fibonacci::series(10);
 * foreach ($series as $n=>$fib) {
 *     echo "n = $n, F(n) = ".$fib->toString()."\n";
 * }
 * // Series from F(0) to F(10):
 * // n = 0, F(n) = 0
 * // n = 1, F(n) = 1
 * // n = 2, F(n) = 1
 * // n = 3, F(n) = 2
 * // n = 4, F(n) = 3
 * // n = 5, F(n) = 5
 * // n = 6, F(n) = 8
 * // n = 7, F(n) = 13
 * // n = 8, F(n) = 21
 * // n = 9, F(n) = 34
 * // n = 10, F(n) = 55
 * 
 * echo "\nand now from F(11) to F(19):\n";
 * $series = Math_Fibonacci::series(11, 19);
 * foreach ($series as $n=>$fib) {
 *     echo "n = $n, F(n) = ".$fib->toString()."\n";
 * }
 * // and now from F(11) to F(19):
 * // n = 11, F(n) = 89
 * // n = 12, F(n) = 144
 * // n = 13, F(n) = 233
 * // n = 14, F(n) = 377
 * // n = 15, F(n) = 610
 * // n = 16, F(n) = 987
 * // n = 17, F(n) = 1597
 * // n = 18, F(n) = 2584
 * // n = 19, F(n) = 4181
 *
 * echo "\nChecking if 26 and 4181 are Fibonacci numbers\n";
 * $verb = Math_Fibonacci::isFibonacci(new Math_Integer(26)) ? 'is' : 'is not';
 * echo "26 $verb a Fibonacci number\n";
 * // 26 is not a Fibonacci number
 * $verb = Math_Fibonacci::isFibonacci(new Math_Integer(4181)) ? 'is' : 'is not';
 * echo "4181 $verb a Fibonacci number\n";
 * // 4181 is a Fibonacci number
 * 
 * echo "\nDecompose 34512\n";
 * $decarr = Math_Fibonacci::decompose(new Math_Integer(34512));
 * foreach ($decarr as $fib) {
 *     $index = Math_Fibonacci::getIndexOf($fib);
 *     echo "F(".$index->toString().") = ".$fib->toString()."\n";
 * }
 * // Decompose 34512
 * // F(23) = 28657
 * // F(19) = 4181
 * // F(17) = 1597
 * // F(10) = 55
 * // F(8) = 21
 * // F(2) = 1
 * 
 * echo "\nF(n) closest to 314156 is: ";
 * $fib = Math_Fibonacci::closestTo(new Math_Integer(314156));
 * echo $fib->toString()."\n\n";
 * // F(n) closest to 314156 is: 317811
 * 
 * echo 'The index for 1597 is : ';
 * $idx = Math_Fibonacci::getIndexOf(new Math_Integer(1597));
 * echo $idx->toString()."\n\n";
 * // The index for 1597 is : 17
 * 
 * $bigint = '3141579834521345220291';
 * echo "Finding the Fibonacci numbers that add up to $bigint\n";
 * $series = Math_Fibonacci::decompose(new Math_Integer($bigint));
 * foreach ($series as $fib) {
 *     $index = Math_Fibonacci::getIndexOf($fib);
 *     echo "F(".$index->toString().") = ".$fib->toString()."\n";
 * }
 * // Finding the Fibonacci numbers that add up to 3141579834521345220291
 * // F(104) = 2427893228399975082453
 * // F(101) = 573147844013817084101
 * // F(98) = 135301852344706746049
 * // F(91) = 4660046610375530309
 * // F(86) = 420196140727489673
 * // F(83) = 99194853094755497
 * // F(81) = 37889062373143906
 * // F(79) = 14472334024676221
 * // F(76) = 3416454622906707
 * // F(74) = 1304969544928657
 * // F(71) = 308061521170129
 * // F(68) = 72723460248141
 * // F(63) = 6557470319842
 * // F(60) = 1548008755920
 * // F(57) = 365435296162
 * // F(53) = 53316291173
 * // F(51) = 20365011074
 * // F(49) = 7778742049
 * // F(44) = 701408733
 * // F(37) = 24157817
 * // F(31) = 1346269
 * // F(26) = 121393
 * // F(20) = 6765
 * // F(16) = 987
 * // F(13) = 233
 * // F(8) = 21
 * // F(6) = 8
 * // F(3) = 2
 * 
 * </pre>
 *
 * @author  Jesus M. Castagnetto <jmcastagnetto@php.net>
 * @version 0.8
 * @access  public
 * @package Math_Fibonacci
 */
class Math_Fibonacci {/*{{{*/

    /**
     * Calculates a Fibonacci number using the (exact) golden ratio equation:
     * F(n) = (PHI^n - phi^n)/sqrt(5) [Lucas formula]
     * for terms from [0,46]
     * from [47,500] it uses a lookup table
     * from then on uses the recursive addition
     *
     * @param mixed $n the index of the Fibonacci number to calculate, as an integer or a Math_Integer number
     * @return mixed numeric on success, PEAR_Error otherwise
     * @access public
     */
    function &term($n) {/*{{{*/
        if (Math_IntegerOp::isMath_Integer($n)) {
            $idx =& $n;
        } elseif (is_numeric($n) && $n >= 0) {
            $idx =& new Math_Integer($n);
        } else {
            return PEAR::raiseError("The parameter $n is not a Math_Integer object");
        }
        
        $table =& $GLOBALS['_fibonacciTable'];

        // shortcut and check if it is already a cached value
        if (isset($table[$idx->toString()])) {
            return new Math_Integer($table[$idx->toString()]);
        }
        
        // from index [0,46] use the fast algorithm
        $cmp_0 = Math_IntegerOp::compare($idx, new Math_Integer(0));
        $cmp_46 = Math_IntegerOp::compare($idx, new Math_Integer(46));
        if ( ($cmp_0 >= 0) && ($cmp_46 <= 0) ) {
            $val = intval($idx->toString());
            $fn = (pow(MATH_PHI, $val) - pow(MATH_phi, $val))/sqrt(5);
            // add to lookup table
            $table[$val] = $fn;
            return new Math_Integer(strval($fn));
        }
        // from [47,500] use the lookup table
        $cmp_500 = Math_IntegerOp::compare($idx, new Math_Integer(500));
        if ( ($cmp_46 > 0) && ($cmp_500 <= 0) ) {
            return new Math_Integer($table[$idx->toString()]);
        } else {
            // calculate and cache the values
            $a = new Math_Integer($table['499']);
            $b = new Math_Integer($table['500']);
            $pos = new Math_Integer('501');
            $one = new Math_Integer('1');
            while (Math_IntegerOp::compare($pos,$idx) <= 0) {
                $c = Math_IntegerOp::add($a, $b);
                $table[$pos->toString()] = $c->toString();
                $a = $b;
                $b = $c;
                $pos = Math_IntegerOp::add($pos, $one);
            }
            return $c;
        }
        
    }/*}}}*/

    /**
     * Returns a series of Fibonacci numbers using the given limits.
     * Method accepts two parameters, of which the second one is
     * optional. If two parameters are passed, the first one will be 
     * lower bound and the second one the upper bound. If only one
     * parameter is passed, it will be the upper bound, and the lower
     * bound will be 0 (zero).
     *
     * @param integer $idx1 the lower index for the series (if two parameters) were passed, or the upper index if only one was given.
     * @param optional integer $idx2 the upper index for the series
     * @return mixed on success, an array of integers where the keys correspond to the indexes of the corresponding Fibonacci numbers, or PEAR_Error othewise
     * @access public
     */
    function series($idx1, $idx2=null) {/*{{{*/
        if (is_integer($idx1) && $idx1 > 0) {
            if ($idx2 == null) {
                $lower_bound = 0;
                $upper_bound = $idx1;
            } elseif (is_integer($idx2)) {
                if ($idx2 < 0) {
                    return PEAR::raiseError("Upper limit $idx2 cannot be negative");
                } elseif ($idx2 < $idx1) {
                    return PEAR::raiseError("Upper limit cannot be smaller than lower limit");
                } else {
                    $lower_bound = $idx1;
                    $upper_bound = $idx2;
                }
            }
            $fibSeries = array();
            for ($i=$lower_bound; $i <= $upper_bound; $i++) {
                $fibSeries[$i] =& Math_Fibonacci::term($i);
            }
            return $fibSeries;
        } else {
            return PEAR::raiseError("The parameter $idx1 is not a valid integer");
        }
    }/*}}}*/

    /**
     * Determines if a particular integer is part of the Fibonacci series
     *
     * @param integer $num
     * @return mixed TRUE if it is a Fibonacci number, FALSE if not, PEAR_Error if the parameter was not an integer
     * @access public
     * @see Math_Fibonacci::term
     */ 
    function isFibonacci($num) {/*{{{*/
        if (!Math_IntegerOp::isMath_Integer($num)) {
            return PEAR::raiseError('Not a valid Math_Integer object'); 
        }
        $n = Math_Fibonacci::_estimateN($num);
        $intcalc =& Math_Fibonacci::term($n); 
        $cmp = Math_IntegerOp::compare($num, $intcalc);
        return ($cmp == 0);
    }/*}}}*/

    /**
     * Decomposes an integer into a sum of Fibonacci numbers
     * 
     * @param integer $num
     * @return mixed an array of Fibonacci numbers on success, PEAR_Error otherwise 
     * @access public
     */
    function decompose($num) {/*{{{*/
        if (!Math_IntegerOp::isMath_Integer($num)) {
            return PEAR::raiseError('Not a valid Math_Integer object'); 
        }
        $err = Math_Fibonacci::_recDecompose($num, &$sum);  
        if (PEAR::isError($err)) {
            return $err;
        }
        $check = new Math_Integer(0);
        foreach($sum as $fib) {
            if (PEAR::isError($fib)) {
                return $fib;
            } else {
                $check = Math_IntegerOp::add($check, $fib);
            }
        }
        $int =& new Math_Integer($num);
        if (Math_IntegerOp::compare($num,$check) == 0) {
            return $sum;
        } else {
            $numstr = $num->toString();
            $sumsrt = $check->toString;
            return PEAR::raiseError("Number and sum do not match: $numstr != $sumstr");
        }
    }/*}}}*/

    /**
     * Finds the Fibonacci number closest to an given integer
     *
     * @param integer $num
     * @return mixed a Fibonacci number (integer) on success, PEAR_Error otherwise
     * @access public
     */
    function closestTo($num) {/*{{{*/
        if (!Math_IntegerOp::isMath_Integer($num)) {
            return PEAR::raiseError("Invalid parameter: not a Math_Integer object");
        }
        $n = Math_Fibonacci::_estimateN($num);
        $fib1 =& Math_Fibonacci::term($n);
        $cmp = Math_IntegerOp::compare($fib1,$num);
        if ($cmp == 0) {
            return $fib1;
        } elseif ($cmp == 1) { // overshoot, see n - 1
            $new_n = Math_IntegerOp::sub($n, new Math_Integer(1));
        } else { // undeshoot, try n + 1
            $new_n = Math_IntegerOp::add($n, new Math_Integer(1));
        }
        $fib2 = Math_Fibonacci::term($new_n);
        $d1 = Math_IntegerOp::abs(Math_IntegerOp::sub($fib1, $num));
        $d2 = Math_IntegerOp::abs(Math_IntegerOp::sub($fib2, $num));
        $cmp = Math_IntegerOp::compare($d1, $d2);
        if ($cmp == -1 || $cmp == 0) {
            return $fib1;
        } else {
            return $fib2;
        }
    }/*}}}*/
    
    /**
     * Gets the index in the Fibonacci series of a given number.
     * If the integer given is not a Fibonacci number a PEAR_Error object
     * will be returned.
     * 
     * @param integer $num the Fibonacci number
     * @return mixed the index of the number in the series on success, PEAR_Error otherwise.
     * @access public
     */
    function getIndexOf($num) {/*{{{*/
        if (!Math_IntegerOp::isMath_Integer($num)) {
            return PEAR::raiseError("Invalid parameter: not a Math_Integer object");
        }
        // check in the lookup table
        
        $n = Math_Fibonacci::_estimateN($num);
        $fibn = Math_Fibonacci::term($n);
        $cmp = Math_IntegerOp::compare($num, $fibn);
        if ($cmp == 0) {
            return $n;
        } else {
            return PEAR::raiseError("Integer $num is not a Fibonacci number");
        }
    }/*}}}*/

    /**
     * Recursive utility method used by Math_Fibonacci::decompose()
     * 
     * @param integer $num
     * @param array $sum array of Fibonacci numbers
     * @return mixed null on success, PEAR_Error otherwise
     * @access private
     */
    function _recDecompose($num, &$sum) {/*{{{*/
        if (!Math_IntegerOp::isMath_Integer($num)) {
            return PEAR::raiseError('Not a valid Math_Integer object'); 
        }
        if (!is_array($sum)) {
            $sum = array();
        }
        $n = Math_Fibonacci::_estimateN($num);
        if (PEAR::isError($n)) {
            return $n;
        }
        $fibn = Math_Fibonacci::term($n);
        if (PEAR::isError($fibn)) {
            return $fibn;
        }
        $cmp = Math_IntegerOp::compare($fibn, $num);
        if ($cmp == 0) {
            $sum[] = $fibn;
            return null;
        } elseif ($cmp == -1) {
            $sum[] = $fibn;
            $newnum = Math_IntegerOp::sub($num, $fibn);
            Math_Fibonacci::_recDecompose($newnum, &$sum);
        } elseif ($cmp == 1) {
            $n_1 = Math_IntegerOp::sub($n, new Math_Integer(1));
            if (PEAR::isError($n_1)) {
                return $n_1;
            }
            $fibn_1 = Math_Fibonacci::term($n_1);
            if (PEAR::isError($fibn_1)) {
                return $fibn_1;
            }
            $sum[] = $fibn_1;
            $newnum = Math_IntegerOp::sub($num, $fibn_1);
            Math_Fibonacci::_recDecompose($newnum, &$sum);
        }
    }/*}}}*/

    /**
     * Estimates the approximate index for a given number
     * It uses the approximate formula:
     * F(n) ~ (PHI^n)/sqrt(5), where '~' means the 'closest integer to'
     * This equation is based on the relation: phi = -1/PHI
     * Which turns Lucas' formula into:
     * F(n) = (PHI^2n + 1)/(PHI^n * sqrt(5))
     * From which we get the formula above, after making the approximation:
     * (PHI^2n + 1) -> (PHI^2n)
     *
     * @param integer $num
     * @return integer the approximate index
     * @access private
     */
    function &_estimateN(&$num) {/*{{{*/
        if (Math_IntegerOp::isMath_Integer($num)) {
            $f = $num->toString();
        } else {
            $f = $num;
        }
        return Math_Fibonacci::_closestInt((log($f) + MATH_LNSQRT5) / MATH_LNPHI);
    }/*}}}*/
    
    /**
     * Finds the closest integer to a given number
     *
     * @param numeric $num
     * @return integer
     * @access private
     */
    function &_closestInt($num) {/*{{{*/
        $f = floor($num);
        $c = ceil($num);
        return new Math_Integer(($num - $f) < ($c - $num) ? $f : $c);
    }/*}}}*/

}/* End of Math_Fibonacci }}}*/

// vim: ts=4:sw=4:et:
// vim6: fdl=1:
?>
