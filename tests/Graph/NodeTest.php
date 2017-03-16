<?php

namespace PHPAlgorithms\GraphTools\Tests;

use PHPAlgorithms\GraphTools\Graph\Node;
use PHPUnit\Framework\TestCase;

final class NodeTest extends TestCase
{
    public function testConstructor()
    {
        $node = new Node($x = 0.0, $y = 1.0, $z = 2.0);

        $this->assertSame($x, $node->x);
        $this->assertSame($y, $node->y);
        $this->assertSame($z, $node->z);

        $this->assertSame($node->id, $node->getId());
        $this->assertSame($node->x, $node->getX());
        $this->assertSame($node->y, $node->getY());
        $this->assertSame($node->z, $node->getZ());
    }

    public function testIncrementId()
    {
        $previous = (new Node)->id;

        for ($i = 0; $i < 2; ++$i) {
            $this->assertSame($previous + 1, $previous = ($node = new Node())->id);
        }
    }

    public function testJsonSerialization()
    {
        $id = (new Node())->id + 1;

        $node = new Node($x = -5.0, $y = 0.0, $z = +5.0);

        $this->assertSame(json_encode(array_combine(array('id', 'x', 'y', 'z'), compact('id', 'x', 'y', 'z'))),
            json_encode($node));
    }

    public function testMoveNode()
    {
        $node = new Node($x = -8.0, $y = +2.0, $z = -15.2);

        $this->assertInstanceOf(Node::class, $node->move(2.0, -8.0));
        $this->assertSame($node, $node->move(0.0, 0.0, 0.1));

        $x += 2.0;
        $y += -8.0;
        $z += 0.1;

        $this->assertSame($x, $node->x);
        $this->assertSame($y, $node->y);
        $this->assertSame($z, $node->z);
    }
}
