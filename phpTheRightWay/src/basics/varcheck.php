<?php
$a = 5;   // 5 as an integer

var_dump($a == 5);       // compare value; return true
var_dump($a == '5');     // compare value (ignore type); return true
var_dump($a === 5);      // compare type/value (integer vs. integer); return true
var_dump($a === '5');    // compare type/value (integer vs. string); return false

var_dump($a != '5');      // compare type (integer vs. string); return false
var_dump($a !== '5');    // compare type/value (integer vs. string); return true

//Equality comparisons
if (strpos('testing', 'test')) {    // 'test' is found at position 0, which is interpreted as the boolean 'false'
    // code...
}

// vs. strict comparisons
if (strpos('testing', 'test') !== false) {    // true, as strict comparison was made (0 !== false)
    // code...
}