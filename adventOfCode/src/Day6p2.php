<?php

function matchCount(array $qzr,int $tot) : int {
    $ret = 0;
    foreach($qzr as $resp) {
        if($resp === $tot) $ret++;
    }
    return $ret;
}

$input = file("adventOfCode/src/day6data",);
echo "Total lines=".count($input).PHP_EOL;
$uniqueResponses = 0;
$quizResponses = [];
$groups = 0;
$respInGroup = 0;
foreach($input as $ix=>$qr) {
    $qr = trim($qr);
    // echo "$ix : $qr".PHP_EOL;
    // merge these new fields with what we have
    if($qr) {
        foreach(str_split($qr) as $char) {
            $quizResponses[$char]++;
        }
        $respInGroup++;
    }
    // last line so let's process what we have OR
    // empty line is our 'delimiter'
    if($ix == count($input)-1 || strlen($qr) == 0 ) {
        // echo "Group $groups, count ".count($quizResponses).PHP_EOL;
        $groups++;
        // var_dump($quizResponses);
        $uniqueResponses += matchCount($quizResponses,$respInGroup);
        $quizResponses = [];
        $respInGroup = 0;
        continue;
        // break;
    }

}

echo "We found $uniqueResponses unique responses from $groups groups!";