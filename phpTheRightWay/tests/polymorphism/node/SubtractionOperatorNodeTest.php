<?php

namespace Polymorphism\Node;

use \Polymorphism\Node\Operator\SubtractionOperatorNode;
use PHPUnit\Framework\TestCase;
use \Polymorphism\Node\ValueNode;

final class SubtractionOperatorNodeTest extends TestCase
{
    public function testCanBeCreated() : void {
        $this->assertInstanceOf(SubtractionOperatorNode::class, new SubtractionOperatorNode());
    }

    public function testCanSubtract() : void {
        $subNode = new SubtractionOperatorNode();
        $subNode->setOperands(new ValueNode(2),new ValueNode(2));
        $this->assertEquals(0,$subNode->evaluate());
    }

}

