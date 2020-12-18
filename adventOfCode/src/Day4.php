<?php

function processPassportData($ppData) : bool {
    // case 1 : has all fields
    // case 2 : only missing cid
    $fieldCount = count($ppData);
    return $fieldCount == 8 || ($fieldCount == 7 && !$ppData["cid"]);
}

$input = file("adventOfCode/src/day4data",);
$valids = 0;
$ppFields = [];
foreach($input as $ix=>$pp) {
    $pp = trim($pp);
    // empty line is our 'delimiter'
    if(strlen(trim($pp)) == 0) {
        // var_dump($ppFields);
        if (processPassportData($ppFields)) {
            $valids++;
        }
        $ppFields = [];
        continue;
    }
    // option 1, find/replace to match format expected by parse_str
    $string = strtr($pp, array(":"=>"="," "=>"&"));
    parse_str($string, $pairs);
    // merge these new fields with what we have
    $ppFields = array_merge($ppFields,$pairs);
}

echo "We found $valids valid passports!";