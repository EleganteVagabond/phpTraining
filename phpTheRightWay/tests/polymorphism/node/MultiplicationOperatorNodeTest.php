<?php

namespace Polymorphism\Node;

use \Polymorphism\Node\Operator\MultiplicationOperatorNode;
use PHPUnit\Framework\TestCase;
use \Polymorphism\Node\ValueNode;

final class MultiplicationOperatorNodeTest extends TestCase
{
    public function testCanBeCreated() : void {
        $this->assertInstanceOf(MultiplicationOperatorNode::class, new MultiplicationOperatorNode());
    }

    public function testCanMultiply() : void {
        $multNode = new MultiplicationOperatorNode();
        $multNode->setOperands(new ValueNode(2),new ValueNode(2));
        $this->assertEquals(4,$multNode->evaluate());
    }

}

