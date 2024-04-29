<?php

require_once("vendor/autoload.php");

function validateNumber(array $preamble, $value) : bool {
    $preambleHash = [];
    // create a hash of the preamble values (O(n))
    foreach ($preamble as $pre) {
        $preambleHash[$pre] = true;
    }
    // now see if a necessary matching value for any preamble value exists
    foreach($preamble as $pre) {
        // if any value exists, then it is valid
        // TODO we could use the same number twice here...
        if($preambleHash[$value - $pre] ) {
            return true;
        }
    }

    return false;
}

const PREAMBLE_LENGTH = 25;
$input = file("adventOfCode/src/day9data",);
// print_r($input[0]);
$numbers = [];
$preamble = new Ds\Queue();
$preamble->allocate(PREAMBLE_LENGTH);

$culprit = 0;
foreach($input as $ix=>$num) {
    $num = trim($num);
    if($preamble->count() > PREAMBLE_LENGTH) {
        $preamble->pop();
    }
    $preamble->push($num);
    if($ix >= PREAMBLE_LENGTH) {
        // validate number
        if(!validateNumber($preamble->toArray(),$num)) {
            $culprit = $num;
            break;
        }
    }
    // store all the #s
    $numbers[$ix] = $num;
}

echo "The culprit value is .... $culprit".PHP_EOL;

// so we know the culprit, now try to find a set of numbers that equals the value
// use a sliding window approach, left value and right value
$leftIx = 0;
$rightIx = 1;

$sum = $numbers[$leftIx]+$numbers[$rightIx];
while ($rightIx < count($numbers)) {
    // echo "Looking for $culprit, $sum between $leftIx and $rightIx ".PHP_EOL;
    if($sum == $culprit) {
        echo "Culprit sum $culprit found between $leftIx and $rightIx...";
        print_r(array_slice($numbers,$leftIx,$rightIx-$leftIx+1));
        break;
    }
    if($sum < $culprit) {
        $rightIx++;
        $sum += $numbers[$rightIx];
    }else {
        $sum -= $numbers[$leftIx];
        $leftIx++;
        // maybe the given number is bigger than the sum?
        if($leftIx >= $rightIx) {
            $rightIx = $leftIx+1;
            $sum = $numbers[$leftIx]+$numbers[$rightIx];
        }
    }
}

// now find the smalles and largest in the given range
$min = $numbers[$leftIx];
$max = $min;
for($ix = $leftIx; $ix <= $rightIx; $ix++) {
    if($numbers[$ix] < $min) $min = $numbers[$ix];
    if($numbers[$ix] > $max) $max = $numbers[$ix];
}
echo "Min is $min, max is $max so weakness = ".($min+$max);
