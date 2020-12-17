<?php

namespace Polymorphism\Node\Factory;

use Ds\Set;
use Polymorphism\Node\MathNode;
use Polymorphism\Node\ValueNode;
use Polymorphism\Node\OperatorNode;
use InvalidArgumentException;

/**
 * Factory class for creating evaluatable nodes from an expression
 */
class MathNodeFactory
{
    // Must be initialized in the constructor because of the new operator
    private static $operatorClasses = ["Addition","Division","Multiplication","Subtraction"];
    private static $operators;
    private static $operatorStrings;

    public function __construct()
    {
        // only initialize once
        if (self::$operators == null) {
            self::$operators = $this->loadOperatorClasses();
        }
        // only initialize once
        if (self::$operatorStrings == null) {
            // ["+","*","-","/"]);
            self::$operatorStrings = new Set();
            foreach (array_keys(self::$operators) as $oper) {
                self::$operatorStrings->add($oper);
            }
        }
    }

    /**
     * Loads the classes dynamically based on the value of the $operatorClasses variable
     *
     * @return array Array of class objects
     */
    private function loadOperatorClasses() : array {
        $ret = [];
        foreach(self::$operatorClasses as $class) {
            $className = "\\Polymorphism\\Node\\Operator\\".$class."OperatorNode";
            $operator = new $className();
            $ret[$operator->getSymbol()] = $operator;
        }
        return $ret;
    }

    /**
     * Builds a value node
     *
     * @param float $value The value for the node
     *
     * @return MathNode the created node
     */
    private function buildValueNode($value) : MathNode {
        if( $this->isValue($value) )
            return new ValueNode($value);
        throw new InvalidArgumentException("Values must be numbers: ${value}");
    }

    /**
     * Builds an operation node
     *
     * @param float $operator string representation of the operator
     *
     * @return OperatorNode the created node
     */
    private function buildOperationNode($operator) : OperatorNode {
        if($this->isOperator($operator) ) {
            $operClass = self::$operators[$operator];
            if ($operClass == null) {
                throw new InvalidArgumentException("Unimplemented operator: ${operator}");
            }

            return clone $operClass;
        }
        throw new InvalidArgumentException("Undefined operator: ${operator}");
    }

    /**
     * Checks if the param is a valid value
     *
     * @param string $param The value to be evaluated
     *
     * @return bool whether the parameter is a valid value
     */
    private function isValue($param) {
        return is_numeric($param);
    }

    /**
     * Checks if the param is a valid operator
     *
     * @param string $param the value to be evaluated
     *
     * @return bool whether the paramater is a valid (known) operator
     */
    private function isOperator($param) {
        return self::$operatorStrings->contains($param);
    }

    /**
     * Parses an expression into nodes
     *
     * @param string $expression a conforming mathematical expression
     *                           e.g. value operator value
     *                           where value may be a numeric value or a value operator value expression
     *                           examples: 4 + 4 * 3, 4 + 1 + 1 + 4
     * @return MathNode root node which can be evaluated to calculate the values
     */

    public function parse($expression) : MathNode {
        $values = array();
        $operators = array();
        $unknown = array();
        $exps = explode(" ",$expression);
        foreach ($exps as $exp) {
            // TODO handle 1 + 2 ok but + 1 2 not okay (or 1 2 +)
            if ($this->isValue($exp)) {
                array_push($values,$exp);
                continue;
            }

            if ($this->isOperator($exp)) {
                array_push($operators,$exp);
                continue;
            }

            array_push($unknown,$exp);
        }
        if (count($unknown) > 0) {
            throw new InvalidArgumentException("Unknown values in expression ".print_r($unknown));
        }
        if(count($operators) == 0) {
            throw new InvalidArgumentException("No operators found in expression. Check format matches 1 + 2");
        }
        if(count($values) != count($operators)+1) {
            throw new InvalidArgumentException("Insufficient values found 1 + 2 + 3 + 5");
        }
        $rootNode = null;
        while(!empty($operators)) {
            $oper = array_pop($operators);
            $operNode = $this->buildOperationNode($oper);
            $right = $rootNode;
            if (is_null($rootNode)) {
                $right = $this->buildValueNode(array_pop($values));
            }
            $rootNode = $operNode;
            $left = $this->buildValueNode(array_pop($values));
            $operNode->setOperands($left,$right);
        }
        # todo build a tree
        return $rootNode;
    }
}

