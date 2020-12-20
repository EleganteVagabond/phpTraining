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

$badVal = 0;
foreach($input as $ix=>$num) {
    $num = trim($num);
    if($preamble->count() > PREAMBLE_LENGTH) {
        $preamble->pop();
    }
    $preamble->push($num);
    if($ix >= PREAMBLE_LENGTH) {
        // validate number
        if(!validateNumber($preamble->toArray(),$num)) {
            $badVal = $num;
            break;
        }
    }
    // store all the #s
    $numbers[$ix] = $num;
}

echo "The culprit value is .... $badVal";
