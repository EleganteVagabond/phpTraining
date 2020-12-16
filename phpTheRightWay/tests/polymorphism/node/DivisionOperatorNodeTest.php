<?php

namespace Polymorphism\Node;

use \Polymorphism\Node\Operator\DivisionOperatorNode;
use PHPUnit\Framework\TestCase;
use \Polymorphism\Node\ValueNode;

final class DivisionOperatorNodeTest extends TestCase
{
    public function testCanBeCreated() : void {
        $this->assertInstanceOf(DivisionOperatorNode::class, new DivisionOperatorNode());
    }

    public function testCanDivide() : void {
        $divNode = new DivisionOperatorNode();
        $divNode->setOperands(new ValueNode(4),new ValueNode(2));
        $this->assertEquals(2,$divNode->evaluate());
    }

}

