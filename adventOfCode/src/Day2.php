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
    $min = intval($limits[0]);
    $max = intval($limits[1]);
    $char = $pvals[1][0];
    $password = $pvals[2];
    $count = substr_count($password,$char);
    // echo "PP is $min-$max $char (s) which occurs $count times in $password";
    if($count <= $max && $count >= $min) {
        $valids++;
    }
    // break;
}

echo "$valids are valid";
