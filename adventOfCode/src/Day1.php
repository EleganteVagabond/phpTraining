<?php

$input = file("adventOfCode/src/day1data",);
// var_dump($input);
// this will hold our keys to tell us if we have the matching number
$diffs = [];
// loop one, calculate diffs
foreach($input as $num) {
    $num = intval($num);
    $diff = 2020-$num;
    if (is_integer($diffs[$diff]) ) {
        echo "Already got the answer first loop!".PHP_EOL;
        echo "$num plus $diff = 2020".PHP_EOL;
        echo $num*$diff.PHP_EOL;
        return;
    }
    $diffs[$diff] = $num;
}

// loop two, find the answer
$answer = 0;
foreach($input as $num) {
    $num = intval($num);
    $othernum = $diffs[$num];
    if (is_integer($othernum)) {
        echo "$num plus $othernum = 2020".PHP_EOL;
        $answer = $othernum * $num;
        break;
    }
}
echo "The answer is $answer";