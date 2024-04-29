<?php

$input = file("adventOfCode/src/day2data",);
// echo $input[0];
// var_dump($input);
// this will hold our keys to tell us if we have the matching number
$valids = 0;
// loop one, create set
foreach($input as $pp) {
    $pvals = explode(" ",$pp);
    // var_dump($pvals);
    // first, get the limits
    $limits = explode("-",$pvals[0]);
    $p1 = intval($limits[0])-1;
    $p2 = intval($limits[1])-1;
    $char = $pvals[1][0];
    $password = $pvals[2];
    $hasp1 = $password[$p1] === $char;
    $hasp2 = $password[$p2] === $char;
    if($hasp1 xor $hasp2 ) {
        $valids++;
    }
    // break;
}

echo "$valids are valid";
