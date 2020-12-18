<?php

$input = file("adventOfCode/src/day3data",);
// var_dump($input);
$rowinc = [1,1,1,1,2];
$colinc = [1,3,5,7,1];
$alltrees = [];
for($i=0;$i<count($rowinc);$i++) {
    $nextCol = $colinc[$i];
    $nextRow = $rowinc[$i];
    $rowLength = strlen(trim($input[0]));
    $trees = 0;
    while($nextRow < count($input))  {
        $char = $input[$nextRow][$nextCol];
        // echo "$nextRow, $nextCol = $char ".PHP_EOL;
        if($input[$nextRow][$nextCol] == "#") {
            $trees++;
        }
        $nextRow+=$rowinc[$i];
        $nextCol += $colinc[$i];
        if ($nextCol >= $rowLength) {
            // echo "wrapping from $nextCol because > $rowLength";
            $nextCol = 0 + $nextCol-$rowLength;
            // echo "next col is now $nextCol".PHP_EOL;
            // break;
        }
    }
    $alltrees[] = $trees;
}
$treeshit = array_product($alltrees);
echo "Oh noze, we hit $treeshit trees!";
