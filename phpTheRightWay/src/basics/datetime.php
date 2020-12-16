<?php

$now = new DateTime();
echo "RFC1123 date format is ".$now->format(DateTimeInterface::RFC1123)."\n";

$raw = '22. 11. 1968';
$start = DateTime::createFromFormat('d. m. Y', $raw);

echo "ATOM formatted date is ".$start->format(DateTimeInterface::ATOM)."\n";

echo 'Start date: ' . $start->format('Y-m-d') . "\n";

echo 'Simple date, lightweight: ' . date("Y-m-d") . "\n";

?>