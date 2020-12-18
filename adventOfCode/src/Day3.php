<?php

$input = file("adventOfCode/src/day3data",);
// var_dump($input);
$nextCol = 3;
$nextRow = 1;
$rowLength = strlen(trim($input[0]));
$trees = 0;
while($nextRow < count($input))  {
    $char = $input[$nextRow][$nextCol];
    // echo "$nextRow, $nextCol = $char ".PHP_EOL;
    if($input[$nextRow][$nextCol] == "#") {
        $trees++;
    }
    $nextRow++;
    $nextCol += 3;
    if ($nextCol >= $rowLength) {
        // echo "wrapping from $nextCol because > $rowLength";
        $nextCol = 0 + $nextCol-$rowLength;
        // echo "next col is now $nextCol".PHP_EOL;
        // break;
    }
}
echo "Oh noze, we hit $trees trees!";
