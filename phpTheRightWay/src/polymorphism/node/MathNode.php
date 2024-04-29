<?php

namespace Polymorphism\Node;

/**
 * Base class for all math nodes, defines basic contract with node processor
 */
abstract class MathNode {
    /**
     * Evaluates and returns a value associated with the node
     *
     * @return float Numerical value of the node
     */
    public abstract function evaluate() : float;

    /**
     * Prints a string interpretation of this node
     * */
    public function __toString(): string
    {
        return $this->evaluate();
    }
}

?>