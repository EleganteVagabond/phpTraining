<?php

/**
 * Blue = 2
 * Green = 4
 * Yellow = 8
 * Orange = 16
 * Red = 32
 * Gold = 64
 */

function getBagName($arr, $ix) : string {
    return $arr[$ix]." ".$arr[$ix+1];
}

function visitColors($factor,$colors, &$visited, $colorsMap) : int {
    $ret = 0;
    // the end of our line
    if( $colors ) {
        foreach($colors as $colorInfo) {
            [$qty, $color] = $colorInfo;
            // echo "walking $color, q=$qty, f=$factor".PHP_EOL;
            $visited[$color] = true;
            $ccnt = $factor*$qty;
            $childCount = visitColors($ccnt,$colorsMap[$color],$visited,$colorsMap);
            $total = $ccnt + $childCount;
            $ret += $total;
            // echo "bag count for $color = ($qty * $factor) + $childCount = $total".PHP_EOL;
        }
    }
    return $ret;
}
$input = file("adventOfCode/src/day7data",);
// var_dump($input[0]);
# dull coral bags contain 1 dim olive bag, 5 muted violet bags, 2 dark gray bags
# bag name = [0->' bag']
# bag # = is_integer (but we don't care about the # right now)
# build array of nodes where each node has a list of bags that can hold it
# traverse graph,
// print_r($input[0]);
$bags = 0;
$bagsAndHolders = [];
const BAG_DELIM = " bag";
const BAG_TEST="shiny gold";
foreach($input as $ix=>$bd) {
    $bdExplode = explode(" ",$bd);
    // var_dump($bdExplode);
    // get the bags from the string
    $holder = getBagName($bdExplode,0);
    // explode the array past the holder, then find numbers, then capture bag name
    // echo "Holder = $holder".PHP_EOL;
    for($ix=4;$ix<count($bdExplode);$ix++) {
        // echo is_numeric($bdExplode[$ix]).PHP_EOL;
        if(is_numeric($bdExplode[$ix])) {
            $bagName = getBagName($bdExplode,$ix+1);
            // this is the opposite from p1
            $bagsAndHolders[$holder][] = [$bdExplode[$ix],$bagName];
            // skip past name (2) + bag (1)
            $ix += 3;
        }
    }
     // wire them up
    //var_dump(($bagsAndHolders));
    // break;
}
$bags = count($bagsAndHolders[BAG_TEST]);
$visited[BAG_TEST] = true;
// now let's follow them
$bags = visitColors(1,$bagsAndHolders[BAG_TEST],$visited,$bagsAndHolders);
// print_r($bagsAndHolders[BAG_TEST]);

echo "We have to use $bags bags to get our bag on the plane!";