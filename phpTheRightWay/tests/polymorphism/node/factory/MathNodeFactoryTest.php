<?php

namespace Polymorphism\Node\Factory;

use \Polymorphism\Node\Factory\MathNodeFactory;
use PHPUnit\Framework\TestCase;
use Polymorphism\Node\OperatorNode;

final class MathNodeFactoryTest extends TestCase
{
    public function testCanBeCreated() : void {
        $this->assertInstanceOf(MathNodeFactory::class, new MathNodeFactory());
    }

    public function testCanParseOneAdditionOperation() : void {
        $factory = new MathNodeFactory();
        $node = $factory->parse("1 + 1");
        $this->assertNotNull($node);
        $this->assertInstanceOf(OperatorNode::class, $node);
        $this->assertEquals(2,$node->evaluate());
    }

    public function testCanParseTwoAdditionOperations() : void {
        $factory = new MathNodeFactory();
        $node = $factory->parse("1 + 1 + 1");
        $this->assertNotNull($node);
        $this->assertInstanceOf(OperatorNode::class, $node);
        $this->assertEquals(3,$node->evaluate());
    }

    public function testCanParseOneMultiplicationOperation() : void {
        $factory = new MathNodeFactory();
        $node = $factory->parse("1 * 5");
        $this->assertNotNull($node);
        $this->assertInstanceOf(OperatorNode::class, $node);
        $this->assertEquals(5,$node->evaluate());
    }

    public function testCanParseTwoMultiplicationOperations() : void {
        $factory = new MathNodeFactory();
        $node = $factory->parse("1 * 2 * 3");
        $this->assertNotNull($node);
        $this->assertInstanceOf(OperatorNode::class, $node);
        $this->assertEquals(6,$node->evaluate());
    }

    public function testCanParseOneDivisionOperation() : void {
        $factory = new MathNodeFactory();
        $node = $factory->parse("4 / 2");
        $this->assertNotNull($node);
        $this->assertInstanceOf(OperatorNode::class, $node);
        $this->assertEquals(2,$node->evaluate());
    }

    public function testCanParseTwoDivisionOperations() : void {
        $factory = new MathNodeFactory();
        $node = $factory->parse("8 / 8 / 2");
        $this->assertNotNull($node);
        $this->assertInstanceOf(OperatorNode::class, $node);
        $this->assertEquals(2,$node->evaluate());
    }

    public function testCanParseOneSubtractionOperation() : void {
        $factory = new MathNodeFactory();
        $node = $factory->parse("4 - 2");
        $this->assertNotNull($node);
        $this->assertInstanceOf(OperatorNode::class, $node);
        $this->assertEquals(2,$node->evaluate());
    }

    public function testCanParseTwoSubtractionOperations() : void {
        $factory = new MathNodeFactory();
        $node = $factory->parse("8 - 4 - 2");
        $this->assertNotNull($node);
        $this->assertInstanceOf(OperatorNode::class, $node);
        $this->assertEquals(6,$node->evaluate());
    }

    public function testCanParseMixedOperations() : void {
        $factory = new MathNodeFactory();
        $node = $factory->parse("8 / 4 - 2");
        $this->assertNotNull($node);
        $this->assertInstanceOf(OperatorNode::class, $node);
        $this->assertEquals(4,$node->evaluate());
    }

}

