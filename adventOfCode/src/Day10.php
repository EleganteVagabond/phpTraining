<?php

require_once("vendor/autoload.php");
$input = file("adventOfCode/src/day10data",);
print_r($input[0]);
$numbers[0] = 0;
$maxJoltage = 0;
$joltDiffs = [1=>0, 3=>1];
foreach($input as $ix=>$num) {
    $num = trim($num);
    if ($num > $maxJoltage) $maxJoltage = $num;
    // store all the #s
    $numbers[] = $num;
}
sort($numbers);
// print_r($numbers);
// - 1 so we don't go past end of array
for($ix = 0; $ix < count($numbers)-1; $ix++ ){
    $diff = $numbers[$ix+1]-$numbers[$ix];
    $joltDiffs[$diff]++;
}

print_r($joltDiffs);

echo "Jolt diff prod is ".($joltDiffs[1] * $joltDiffs[3]);
