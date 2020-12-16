<?php

namespace Polymorphism\Node\Operator;

use Polymorphism\Node\OperatorNode;

/**
 * Operator node that handles addition
 */
class AdditionOperatorNode extends OperatorNode {

    public function evaluate(): float
    {
        return $this->left->evaluate() + $this->right->evaluate();
    }

    public function getSymbol(): string
    {
        return "+";
    }
}

?>

