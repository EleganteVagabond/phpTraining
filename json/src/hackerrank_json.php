<?php

use function PHPUnit\Framework\isEmpty;

echo getcwd()."\n\n";
// $dataFile = fopen("json/src/data.json", "r") or die ("unable to open file");
// while (! feof($dataFile)) {
//     echo fgets($file). "\n";
// }
// fclose($dataFile);

$manager = "Brice Martin";
// raw data
// $fileContents = array_map('trim',file("json/src/data.json", FILE_IGNORE_NEW_LINES));
$fileContents = json_decode(file_get_contents("json/src/data.json"));
// convert to associative array
$jsonarray= [];
$managerids = [];
// find all matching manager ids
foreach($fileContents as $record) {
    if($record[1] == $manager) {
        $managerids[$record[0]] = 1;
    }
}
var_dump($managerids);
// now build records for just the ones that match
foreach($fileContents as $record) {
    if( $managerids[$record[2]]) {
        $keyedRecord = ["id"=>$record[0], "name"=>$record[1], "manager_id"=>(strlen($record[2]) === 0 ? null : $record[2])];
        $jsonarray[] = $keyedRecord;
    }
}
// now find all
// use php built in function
echo json_encode($jsonarray);
