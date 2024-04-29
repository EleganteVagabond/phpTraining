<?php

namespace Polymorphism\Node;

/**
 * Concrete implementation class for a node which is a literal numeric value
 */
class ValueNode extends MathNode {
    private $value;

    /**
     * Builds the value node with the given value
     * @param float $val the value for the node
     */
    public function __construct(float $val) {
        $this->value = $val;
    }

    /**
     * @override
     */
    public function evaluate() : float {
        return $this->value;
    }
}


?>