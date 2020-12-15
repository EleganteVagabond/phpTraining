<?php
class MultiplicationOperatorNode extends OperatorNode {

    public function evaluate(): float
    {
        return $this->left->evaluate() * $this->right->evaluate();
    }
}

?>

