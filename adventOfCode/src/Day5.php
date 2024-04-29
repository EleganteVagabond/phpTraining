<?php

function decodeValue($text,$min,$max,$minChar,$maxChar) : int {
    // echo "Decoding $text".PHP_EOL;
    for($cix=0;$cix<strlen($text); $cix++) {
        $mid = round(($max-$min+1) / 2);
        if($text[$cix] === $minChar) {
            $max = $min+$mid-1;
        }else {
            $min = $min+$mid;
        }
        // echo "Round $cix(".$text[$cix].") $min-$max".PHP_EOL;
    }
    // echo $min."-".$max.PHP_EOL;
    return $min;
}

$input = file("adventOfCode/src/day5data",);
$seat = "FBFBBFFRLR";
$maxSeat = 0;
foreach($input as $seat) {
    $seat = trim($seat);
    $row = decodeValue(substr($seat,0,7),0,127,'F','B');
    $col = decodeValue(substr($seat,-3),0,7,'L','R');
    $seatId = $row * 8 + $col;
    if($seatId > $maxSeat ) {
        $maxSeat = $seatId;
    }
}
echo "The highest seat ID is $maxSeat";