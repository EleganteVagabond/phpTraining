<?php

class ValueNode extends Node {
    private $value;

    public function __construct(float $val) {
        $this->value = $val;
    }

    public function evaluate() : float {
        return $this->value;
    }
}


?>