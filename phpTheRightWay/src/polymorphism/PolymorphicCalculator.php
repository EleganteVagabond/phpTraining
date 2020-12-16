<?php

namespace Polymorphism;

require "../../../vendor/autoload.php";

use \Polymorphism\Node\Factory\MathNodeFactory;
// use \Polymorphism\Node\Operator\AdditionOperatorNode;

# todo implement a polymorphic calculator
class PolymorphicCalculator
{

}

// new AdditionOperatorNode();

$factory = new MathNodeFactory();
$node = $factory->parse("1 + 1");
var_dump($node);
echo $node->evaluate();

?>