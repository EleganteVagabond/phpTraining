<?php

$input = file("adventOfCode/src/day1data",);
// var_dump($input);
// this will hold our keys to tell us if we have the matching number
$valMap = [];
// loop one, create set
foreach($input as $num) {
    $num = intval($num);
    $valMap[$num] = $num;
}
// find the diff
// find if there are 2 numbers that match the diff
// find any number < diff and see if the other diff works

// loop two, find the answer
$answer = 0;
foreach($input as $ix=>$num) {
    $num = intval($num);
    // now we need to loop over to see check all the other numbers that might be smaller and check the diff
    for($inner=$ix+1;$inner<count($input);$inner++) {
        $numin = intval($input[$inner]);
        $rem = 2020-$numin-$num;
        if ($rem > 0 && is_integer($valMap[$rem])) {
            $answer = $numin * $num * $rem;
            echo "The answer is $numin * $num * $rem = $answer";
            return;
        }
    }
}