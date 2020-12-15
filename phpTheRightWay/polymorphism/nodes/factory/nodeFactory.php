<?php

use Ds\Set;

class NodeFactory
{
    private $operators = new Set(["+","*","-","/"]);

    public function buildNode($value) : Node {
        if( $this->isValue($value) )
            return new ValueNode($value);

        switch ($value) {
            // case "+" : return new AdditionOperatorNode(); break;
            // case "*" : return new MultiplicationOperatorNode(); break;
            // case "-" : return new MultiplicationOperatorNode(); break;
            // case "/" : return new MultiplicationOperatorNode(); break;
            default : throw new InvalidArgumentException("Unimplemented operator ${value}");
        }
    }

    private function isValue($param) {
        return is_numeric($param);
    }

    private function isOperator($param) {
        return $this->operators->contains($param);
    }

    public function buildNode($left,$operator,$right) : Node {
        $left;
        if ($this->isValue($left)) {
            $left = new ValueNode($left);
        }else {
            $left = $this->buildNode(explode(" ",$left));
        }

        $right;
    }
}

