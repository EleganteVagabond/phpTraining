<?php

function invalidRange($field,$min,$max) : bool {
    return $field < $min || $field > $max;
}

function endsWith($haystack, $needle) : bool {
    return substr_compare($haystack, $needle, -strlen($needle)) === 0;
}

function processPassportData($ppData) : bool {
    // case 1 : has all fields
    // case 2 : only missing cid
    $fieldCount = count($ppData);
    // necessary but not sufficient
    if ($fieldCount == 8 || ($fieldCount == 7 && !$ppData["cid"])) {
        // byr (Birth Year) - four digits; at least 1920 and at most 2002.
        if (invalidRange($ppData["byr"],1920, 2002)) return false;
        // iyr (Issue Year) - four digits; at least 2010 and at most 2020.
        if (invalidRange($ppData["iyr"],2010, 2020)) return false;
        // eyr (Expiration Year) - four digits; at least 2020 and at most 2030.
        if (invalidRange($ppData["eyr"],2020, 2030)) return false;
        // hgt (Height) - a number followed by either cm or in:
        $height = $ppData["hgt"];
        $ending = substr($height,-2);
        $isCm = $ending === "cm";
        $isIn = $ending === "in";
        $num = intval(substr($height,0,strlen($height)-2));
        if(!$isCm && !$isIn) return false;
        if(!$num) return false;
        // If cm, the number must be at least 150 and at most 193.
        if($isCm && invalidRange(intval($num),150,193)) return false;
        // If in, the number must be at least 59 and at most 76.
        if($isIn && invalidRange(intval($num),59,76)) return false;
        // hcl (Hair Color) - a # followed by exactly six characters 0-9 or a-f.
        if(!preg_match("/#([a-f0-9]{3}){1,2}\b/i", $ppData["hcl"])) return false;
        // ecl (Eye Color) - exactly one of: amb blu brn gry grn hzl oth.
        if(!preg_match("/(amb|blu|brn|gry|grn|hzl|oth){1}\b/i", $ppData["ecl"])) return false;
        // pid (Passport ID) - a nine-digit number, including leading zeroes.
        if(!intval($ppData['pid']) || strlen(trim($ppData['pid'])) != 9) return false;
        // cid (Country ID) - ignored, missing or not.
        // noop
        return true;
    }
    return false;
}

// make a test
$input = file("adventOfCode/src/day4data",);
$valids = 0;
$total = 0;
$ppFields = [];
foreach($input as $ix=>$pp) {
    $pp = trim($pp);
    // empty line is our 'delimiter', always check last entry
    if(strlen(trim($pp)) == 0 ) {
        // var_dump($ppFields);
        if (processPassportData($ppFields)) {
            $valids++;
        }
        $ppFields = [];
        $total++;
        continue;
    }
    // option 1, find/replace to match format expected by parse_str
    $string = strtr($pp, array(":"=>"="," "=>"&"));
    parse_str($string, $pairs);
    // merge these new fields with what we have
    $ppFields = array_merge($ppFields,$pairs);
    // last line so let's process what we have
    if($ix == count($input)-1) {
        if (processPassportData($ppFields)) {
            $valids++;
        }

        $total++;
    }

}

echo "We found $valids valid passports out of $total!";