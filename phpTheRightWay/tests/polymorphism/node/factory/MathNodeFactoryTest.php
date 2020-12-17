<?php

namespace Polymorphism\Node\Factory;

use InvalidArgumentException;
use \Polymorphism\Node\Factory\MathNodeFactory;
use PHPUnit\Framework\TestCase;
use Polymorphism\Node\OperatorNode;

final class MathNodeFactoryTest extends TestCase
{
    protected $factory;

    protected function setUp() : void {
        $this->factory = new MathNodeFactory();

    }
    public function testCanBeCreated() : void {
        $this->assertInstanceOf(MathNodeFactory::class, new MathNodeFactory());
    }

    public function testCanParseOneAdditionOperation() : void {
        $node = $this->factory->parse("1 + 1");
        $this->assertNotNull($node);
        $this->assertInstanceOf(OperatorNode::class, $node);
        $this->assertEquals(2,$node->evaluate());
    }

    public function testCanParseTwoAdditionOperations() : void {
        $node = $this->factory->parse("1 + 1 + 1");
        $this->assertNotNull($node);
        $this->assertInstanceOf(OperatorNode::class, $node);
        $this->assertEquals(3,$node->evaluate());
    }

    public function testCanParseOneMultiplicationOperation() : void {
        $node = $this->factory->parse("1 * 5");
        $this->assertNotNull($node);
        $this->assertInstanceOf(OperatorNode::class, $node);
        $this->assertEquals(5,$node->evaluate());
    }

    public function testCanParseTwoMultiplicationOperations() : void {
        $node = $this->factory->parse("1 * 2 * 3");
        $this->assertNotNull($node);
        $this->assertInstanceOf(OperatorNode::class, $node);
        $this->assertEquals(6,$node->evaluate());
    }

    public function testCanParseOneDivisionOperation() : void {
        $node = $this->factory->parse("4 / 2");
        $this->assertNotNull($node);
        $this->assertInstanceOf(OperatorNode::class, $node);
        $this->assertEquals(2,$node->evaluate());
    }

    public function testCanParseTwoDivisionOperations() : void {
        $node = $this->factory->parse("8 / 8 / 2");
        $this->assertNotNull($node);
        $this->assertInstanceOf(OperatorNode::class, $node);
        $this->assertEquals(2,$node->evaluate());
    }

    public function testCanParseOneSubtractionOperation() : void {
        $node = $this->factory->parse("4 - 2");
        $this->assertNotNull($node);
        $this->assertInstanceOf(OperatorNode::class, $node);
        $this->assertEquals(2,$node->evaluate());
    }

    public function testCanParseTwoSubtractionOperations() : void {
        $node = $this->factory->parse("8 - 4 - 2");
        $this->assertNotNull($node);
        $this->assertInstanceOf(OperatorNode::class, $node);
        $this->assertEquals(6,$node->evaluate());
    }

    public function testCanParseMixedOperations() : void {
        $node = $this->factory->parse("8 / 4 - 2");
        $this->assertNotNull($node);
        $this->assertInstanceOf(OperatorNode::class, $node);
        $this->assertEquals(4,$node->evaluate());
    }

    public function testHandlesInvalidOperators() : void {
        $this->expectException(InvalidArgumentException::class);
        $this->factory->parse("5 ^ 3");
    }

    public function testHandlesInvalidOperatorPosition() : void {
        // $this->expectException(InvalidArgumentException::class);
        // $this->factory->parse("+ 5 3");
        $node = $this->factory->parse("+ 5 3 + 6");
        $this->assertNotNull($node);
        $this->assertInstanceOf(OperatorNode::class, $node);
        $this->assertEquals(14,$node->evaluate());
        $node = $this->factory->parse("5 3 +");
        $this->assertNotNull($node);
        $this->assertInstanceOf(OperatorNode::class, $node);
        $this->assertEquals(8,$node->evaluate());
    }

    public function testHandlesInvalidValues() : void {
        $this->expectException(InvalidArgumentException::class);
        $this->factory->parse("a * b");
    }

    public function testHandlesInsufficientValues() : void {
        $this->expectException(InvalidArgumentException::class);
        $this->factory->parse("1 + 2 3");
    }

}

