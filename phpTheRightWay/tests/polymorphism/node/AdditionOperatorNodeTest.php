<?php

namespace Polymorphism\Node;

use \Polymorphism\Node\Operator\AdditionOperatorNode;
use PHPUnit\Framework\TestCase;
use \Polymorphism\Node\ValueNode;

final class AdditionOperatorNodeTest extends TestCase
{
    public function testCanBeCreated() : void {
        $this->assertInstanceOf(AdditionOperatorNode::class, new AdditionOperatorNode());
    }

    public function testCanAdd() : void {
        $addNode = new AdditionOperatorNode();
        $addNode->setOperands(new ValueNode(1),new ValueNode(1));
        $this->assertEquals(2,$addNode->evaluate());
    }

}

