<?php

namespace Polymorphism\Node;

/**
 * Abstract base class for all operators
 */
abstract class OperatorNode extends MathNode {
    protected $left;
    protected $right;

    /**
     * @return string the symbol associated with the operation
     */
    public abstract function getSymbol() : string;

    /**
     * Sets the operands for the operator
     * @param MathNode $left the left operand
     *
     * @param MathNode $right the right operand
     *
     * @return void
     */
    public function setOperands(MathNode $left, MathNode $right) {
        $this->left = $left;
        $this->right = $right;
    }
}

?>

