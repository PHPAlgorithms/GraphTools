<?php

namespace PHPAlgorithms\GraphTools\Tests;

use PHPAlgorithms\GraphTools\Graph\Connection;
use PHPAlgorithms\GraphTools\Graph\Node;
use PHPUnit\Framework\TestCase;

final class ConnectionTest extends TestCase
{
    public function testConstructor()
    {
        $connection = new Connection($from = new Node, $to = new Node);

        $this->assertSame($from, $connection->from);
        $this->assertSame($to, $connection->to);
        $this->assertNull($connection->weight);

        $this->assertSame($connection->from, $connection->getFrom());
        $this->assertSame($connection->to, $connection->getTo());
        $this->assertSame($connection->weight, $connection->getWeight());

        $connection = new Connection($from = new Node, $to = new Node, $weight = 3.14);

        $this->assertSame($from, $connection->from);
        $this->assertSame($to, $connection->to);
        $this->assertSame($weight, $connection->weight);

        $this->assertSame($connection->from, $connection->getFrom());
        $this->assertSame($connection->to, $connection->getTo());
        $this->assertSame($connection->weight, $connection->getWeight());
    }

    public function testJsonSerialization()
    {
        $connection = new Connection($from = new Node, $to = new Node, $weight = -1.41);

        $this->assertEquals(json_encode(array_combine(array('from', 'to', 'weight'), compact('from', 'to', 'weight'))),
            json_encode($connection));
    }
}