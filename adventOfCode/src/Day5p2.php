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
$seatUsed = array_fill(0,127*8+7,false);
foreach($input as $seat) {
    $seat = trim($seat);
    $row = decodeValue(substr($seat,0,7),0,127,'F','B');
    $col = decodeValue(substr($seat,-3),0,7,'L','R');
    $seatId = $row * 8 + $col;
    if($seatId > $maxSeat ) {
        $maxSeat = $seatId;
    }
    $seatUsed[$seatId] = true;
}
$ourSeat = 0;
foreach($seatUsed as $six=>$used) {
    // first row
    if($six >= 0 && $six <=7) continue;
    // last row
    if($six >= 1016 && $six <=1023) continue;
    // isn't used and the +1 and -1 seat ids are taken
    if(!$used && $seatUsed[$six-1] && $seatUsed[$six+1]) {
        $ourSeat = $six;
        break;
    }
}
echo "Our seat is $ourSeat";
