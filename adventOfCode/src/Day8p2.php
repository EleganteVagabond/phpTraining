<?php

function runProgram($instructions) {
    $currI = 0;
    $accumulator = 0;
    $visitedInstructions = [];
    while($currI < count($instructions)) {
        if($visitedInstructions[$currI]) {
            throw new Error("Duplicate at $currI:".$instructions[$currI][0]);
        }
        [$instr,$value] = $instructions[$currI];
        $visitedInstructions[$currI] = true;
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
    return $accumulator;
}

$input = file("adventOfCode/src/day8data",);
// print_r($input[0]);
$bagsAndHolders = [];
const BAG_DELIM = " bag";
const BAG_TEST="shiny gold";
$instructions = [];
$lastJumpIx = 0;
$jumps = [];
foreach($input as $ix=>$bd) {
    $bd = trim($bd);
    // add all the instructions
    $instructions[$ix] = explode(" ",$bd);
    if($instructions[$ix][0] === "jmp") {
        $lastJumpIx = $ix;
        $jumps[] = $ix;
    }
}
// try changing jumps into noops
foreach($jumps as $jumpIx) {
    $instructions[$jumpIx][0] = "nop";
    try {
        $accumulator = runProgram($instructions);
        break;
    }catch (Error $e) {
        echo "Fail with $jumpIx, try again".PHP_EOL;
        $instructions[$jumpIx][0] = "jmp";
    }
}

// print_r($instructions);



// print_r($bagsAndHolders[BAG_TEST]);

echo "Program ended successfully, accumulator is $accumulator!";