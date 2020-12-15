<?php

# todo implement a polymorphic calculator

use PHPUnit\Framework\Constraint\Operator;

abstract class Node {
    public abstract function evaluate() : float;
}

class ValueNode extends Node {
    private $value;

    public function __construct(float $val) {
        $this->value = $val;
    }

    public function evaluate() : float {
        return $this->value;
    }
}

abstract class OperatorNode extends Node {
    protected $left;
    protected $right;

    public function __construct(Node $left, Node $right) {
        $this->left = $left;
        $this->right = $right;
    }
}

class MultiplicationOperatorNode extends OperatorNode {

    public function evaluate(): float
    {
        return $this->left->evaluate() * $this->right->evaluate();
    }
}

class AdditionOperatorNode extends OperatorNode {

    public function evaluate(): float
    {
        return $this->left->evaluate() + $this->right->evaluate();
    }
}

class SubtractionOperatorNode extends OperatorNode {

    public function evaluate(): float
    {
        return $this->left->evaluate() - $this->right->evaluate();
    }
}

class DivisionOperatorNode extends OperatorNode {

    public function evaluate(): float
    {
        return $this->left->evaluate() / $this->right->evaluate();
    }
}


?>