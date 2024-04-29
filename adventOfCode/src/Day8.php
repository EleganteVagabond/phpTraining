<?php

$input = file("adventOfCode/src/day8data",);
// print_r($input[0]);
$bagsAndHolders = [];
const BAG_DELIM = " bag";
const BAG_TEST="shiny gold";
$instructions = [];
foreach($input as $ix=>$bd) {
    $bd = trim($bd);
    // add all the instructions
    $instructions[$ix] = explode(" ",$bd);
    $instructions[$ix][] = false;
}
// print_r($instructions);
$currI = 0;
$accumulator = 0;
while(!$instructions[$currI][2] ) {
    [$instr,$value,$visited] = $instructions[$currI];
    $instructions[$currI][2] = true;
    // echo "Processing instruction $currI: $instr $value".PHP_EOL;
    switch($instr)
    {
        case "jmp": $currI += (int) $value; break;

        case "acc" : $accumulator += (int)$value;
        default : $currI++;
    }
    // echo "Next instr $currI accum is $accumulator".PHP_EOL;
    // break;
}


// print_r($bagsAndHolders[BAG_TEST]);

echo "Duplicate instr at $currI, accumulator is $accumulator!";