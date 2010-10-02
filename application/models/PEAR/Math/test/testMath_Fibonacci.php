<?php
// $Id: testMath_Fibonacci.php,v 1.1 2003/01/02 01:57:00 jmcastagnetto Exp $
include_once 'Math/Fibonacci.php';

$idx = 20;
echo "Calculate F($idx), fast equation = ";
$fib =& Math_Fibonacci::term($idx);
echo $fib->toString()."\n";

$idx = 55;
echo "Calculate F($idx), lookup table = ";
$fib =& Math_Fibonacci::term($idx);
echo $fib->toString()."\n";

$idx = 502;
echo "Calculate F($idx), addition loop = ";
$fib = Math_Fibonacci::term($idx);
echo $fib->toString()."\n";

echo "\nSeries from F(0) to F(10):\n";
$series = Math_Fibonacci::series(10);
foreach ($series as $n=>$fib) {
    echo "n = $n, F(n) = ".$fib->toString()."\n";
}

echo "\nand now from F(11) to F(19):\n";
$series = Math_Fibonacci::series(11, 19);
foreach ($series as $n=>$fib) {
    echo "n = $n, F(n) = ".$fib->toString()."\n";
}

echo "\nChecking if 26 and 4181 are Fibonacci numbers\n";
$verb = Math_Fibonacci::isFibonacci(new Math_Integer(26)) ? 'is' : 'is not';
echo "26 $verb a Fibonacci number\n";
$verb = Math_Fibonacci::isFibonacci(new Math_Integer(4181)) ? 'is' : 'is not';
echo "4181 $verb a Fibonacci number\n";

echo "\nDecompose 34512\n";
$decarr = Math_Fibonacci::decompose(new Math_Integer(34512));
foreach ($decarr as $fib) {
    $index = Math_Fibonacci::getIndexOf($fib);
    echo "F(".$index->toString().") = ".$fib->toString()."\n";
}

echo "\nF(n) closest to 314156 is: ";
$fib = Math_Fibonacci::closestTo(new Math_Integer(314156));
echo $fib->toString()."\n\n";

echo 'The index for 1597 is : ';
$idx = Math_Fibonacci::getIndexOf(new Math_Integer(1597));
echo $idx->toString()."\n\n";

$bigint = '3141579834521345220291';
echo "Finding the Fibonacci numbers that add up to $bigint\n";
$series = Math_Fibonacci::decompose(new Math_Integer($bigint));
foreach ($series as $fib) {
    $index = Math_Fibonacci::getIndexOf($fib);
    echo "F(".$index->toString().") = ".$fib->toString()."\n";
}


// Benchmark below requires PEAR::Benchmark, PEAR::Math_Stats
// and PEAR::Math_Histogram
$benchmark = false;

if ($benchmark) {
    require_once 'Benchmark/Iterate.php';
    require_once 'Math/Histogram.php';

    // benchmark the fast algorithm
    $index = 45;
    // benchmark the lookup table
    //$index = 100;
    // benchmark the addition loop
    //$index = 1000;
    $runs = 2000;
    $bench =& new Benchmark_Iterate();
    echo "\n\nBenchmarking:\n";
    echo "Calculating F($index) $runs times = ".$index."\n";
    $bench->run($runs, 'Math_Fibonacci::term', $index);
    $res1 = $bench->get();

    // get some basic stats and clean up arrays for Math_Histogram
    echo "term($index)  : avg time = {$res1['mean']} ({$res1['iterations']})\n";
    unset($res1['mean']);
    unset($res1['iterations']);
    echo '----> max: '.max($res1).', min: '.min($res1).', count: '.count($res1)."\n";

    echo "\nFull Stats\n";
    echo "term($index)\n";
    $h = new Math_Histogram();
    $h->setData($res1);
    $h->calculate();
    echo $h->printHistogram();
    print_r($h->getDataStats());
    echo $h->toSeparated();
}

// vim: ts=4:sw=4:et:
// vim6: fdl=0:
?>
