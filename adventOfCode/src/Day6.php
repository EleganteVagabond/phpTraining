<?php

$input = file("adventOfCode/src/day6data",);
echo "Total lines=".count($input).PHP_EOL;
$uniqueResponses = 0;
$quizResponses = [];
$groups = 0;
foreach($input as $ix=>$qr) {
    $qr = trim($qr);
    // echo "$ix : $qr".PHP_EOL;
    // merge these new fields with what we have
    foreach(str_split($qr) as $char) {
        if($char !== '' && !$quizResponses[$char]) $quizResponses[$char]=true;
    }
    // last line so let's process what we have OR
    // empty line is our 'delimiter'
    if($ix == count($input)-1 || strlen($qr) == 0 ) {
        // echo "Group $groups, count ".count($quizResponses).PHP_EOL;
        $groups++;
        // var_dump($quizResponses);
        $uniqueResponses += count($quizResponses);
        $quizResponses = [];
        continue;
        // break;
    }

}

echo "We found $uniqueResponses unique responses from $groups groups!";