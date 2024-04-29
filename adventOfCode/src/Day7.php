<?php

function getBagName($arr, $ix) : string {
    return $arr[$ix]." ".$arr[$ix+1];
}

function visitColors($colors, &$visited, $colorsMap) : int {
    $ret = 0;
    // the end of our line
    if( $colors ) {
        foreach($colors as $color) {
            if(!$visited[$color]) {
                echo "adding $color to the list".PHP_EOL;
                $ret++;
                $visited[$color] = true;
                $ret += visitColors($colorsMap[$color],$visited,$colorsMap);
            }
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
$ways = 0;
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
            $bagsAndHolders[$bagName][] = $holder;
            // skip past name (2) + bag (1)
            $ix += 3;
        }
    }
     // wire them up
    // break;
}
$ways = count($bagsAndHolders[BAG_TEST]);
$visited[BAG_TEST] = true;
// now let's follow them
$ways = visitColors($bagsAndHolders[BAG_TEST],$visited,$bagsAndHolders);
// print_r($bagsAndHolders[BAG_TEST]);

echo "We found $ways ways to get our bag on the plane!";