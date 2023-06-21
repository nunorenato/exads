<?php

// start and end can be set as parameters
$min = $_REQUEST['min']??1;
$max = $_REQUEST['max']??100;

printIntegers($min, $max);

/**
 * Print a list of integer and its divisors
 *
 * @param $min
 * @param $max
 * @return void
 */
function printIntegers($min, $max){

    for($i=$min;$i<=$max;$i++){
        echo "$i:";
        $divs = getDivisors($i);
        if(count($divs) <= 2)
            $output = 'PRIME';
        else
            $output = implode(',', $divs);
        echo "[$output]<br>";
    }

}

/**
 * Returns an array with all the divisors of an integer
 *
 * @param $n
 * @return array
 */
function getDivisors($n){

    // only need to do up to sqrt
    $maxDivisor = (int)sqrt($n);

    $divisors = [];
    for($i=1;$i<=$maxDivisor;$i++){
        if($n % $i == 0){ // it's a divisor
            $divisors[] = $i;
            $d = $n/$i;
            if($d != $i) // avoid duplicates
                $divisors[] = $n/$i;
        }
    }
    return $divisors;
}