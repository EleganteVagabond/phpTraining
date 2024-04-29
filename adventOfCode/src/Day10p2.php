<?php

/**
 * Walks the "graph" of the numbers following some basic rules
 * -max distance between any two values is 3
 * -min distance is 1
 *
 * so 1-3 is good
 *
 * 0 is bad
 *
 * 4+ is bad
 *
 * @param array $numbers a sorted list of values for joltage adapters
 * @param int $startIx the start index from which to walk (since we are recursing)
 *
 */
function walkIt(array $numbers,int $startIx) {
    // we're going to find all the ways we can get from the start index to the end index and return that
    if($startIx == count($numbers)-1) {
        return 1;
    }
    $ways = 0;
    for ($ix=$startIx+1;$ix<count($numbers);$ix++) {
        if ($numbers[$ix] - $numbers[$startIx] > 3) {
            // break from this loop
            break;
        }
        $ways += walkIt($numbers,$ix);
    }

    return $ways;
}
/**
 * Find how many different ways there are to go from this to another number
 */
function getValidConnectionCount(array $numbers, int $startIx) : int {
    $ways = 0;
    for ($ix=$startIx+1;$ix<count($numbers);$ix++) {
        if ($numbers[$ix] - $numbers[$startIx] > 3) {
            // break from this loop
            break;
        }
        $ways++;
    }

    return $ways;
}

$input = file("adventOfCode/src/day10data",);
// print_r($input[0]);
$numbers[0] = 0;
$maxJoltage = 0;
$joltDiffs = [1=>0, 3=>1];
foreach($input as $ix=>$num) {
    $num = trim($num);
    if ($num > $maxJoltage) $maxJoltage = $num;
    // store all the #s
    $numbers[] = $num;
}
sort($numbers);
print_r($numbers);
// how could we use memoization...
// start at end and count ways as we move backwards?
// figure out how many valid ways are from each vertex then multiply?
$connectionCount = [];
foreach($numbers as $ix=>$num) {
    $connectionCount[$num] = getValidConnectionCount($numbers,$ix);
}
print_r($connectionCount);
// go backwards calculating all of the total ways you can get from a to b?
// $ways = walkIt($numbers,0);
echo "There are $ways ways to connect the appliances";