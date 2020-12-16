<?php

namespace Polymorphism\Node\Operator;

use Polymorphism\Node\OperatorNode;

/**
 * Operator node that handles multiplication
 */
class SubtractionOperatorNode extends OperatorNode {

    public function evaluate(): float
    {
        return $this->left->evaluate() - $this->right->evaluate();
    }

    public function getSymbol(): string
    {
        return "-";
    }
}

?>

