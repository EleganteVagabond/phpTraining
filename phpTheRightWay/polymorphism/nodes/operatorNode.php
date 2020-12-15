<?php
abstract class OperatorNode extends Node {
    protected $left;
    protected $right;

    public function __construct(Node $left, Node $right) {
        $this->left = $left;
        $this->right = $right;
    }
}

?>

