<?php declare(strict_types=1);

namespace Standard;

interface ArrayTester
{
    public function getOne(): array;

    public function getTwo(): array;

    public function getThree(): array;
}

class ArrTestArrays implements ArrayTester {
    public function getOne(): array {
        return [1];
    }

    public function getTwo(): array {
        return [0,1];
    }

    public function getThree(): array {
        return array(0,1,2);
    }
}

$arrTestA = new ArrTestArrays();

echo 'One: '.$arrTestA->getOne()."\n\n";
echo 'Two: '.$arrTestA->getTwo()."\n\n";
echo 'Three: '.$arrTestA->getThree()."\n\n";

$avar = array();
// this appends to the array. could also comment out the above line and it would create an array
$avar[] = 1;
echo var_dump($avar);
