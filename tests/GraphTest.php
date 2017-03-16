<?php

namespace PHPAlgorithms\GraphTools\Tests;

use PHPAlgorithms\GraphTools\Graph;
use PHPAlgorithms\GraphTools\Graph\Connection;
use PHPAlgorithms\GraphTools\Graph\Node;
use PHPUnit\Framework\TestCase;

/**
 * Class GraphTest
 * @package PHPAlgorithms\GraphTools\Tests
 */
final class GraphTest extends TestCase
{
    public function testAddingNodes()
    {
        /**
         * @var Node[] $nodes
         */
        $nodes = array();
        for ($i = 0; $i < 10; ++$i) {
            $nodes[] = new Node;
        }
        $nodes[] = $nodes[0];

        $graph = new Graph($nodes, array());

        /**
         * @var Node[] $graphNodes
         */
        $graphNodes = array();
        foreach ($nodes as $node) {
            $graphNodes[$node->id] = $node;
        }

        $this->assertEquals(count($graphNodes), count($graph->nodes));
        $this->assertSame($graphNodes, $graph->nodes);
    }

    public function testAddingConnections()
    {
        /**
         * @var Node[] $nodes
         */
        $nodes = array();
        for ($i = 0; $i < 10; ++$i) {
            $nodes[] = new Node;
        }
        $nodes[] = $nodes[0];

        /**
         * @var Connection[] $connections
         */
        $connections = array();
        for ($i = 0, $j = count($nodes); $i < $j; ++$i) {
            $connections[] = new Connection($nodes[$i], $nodes[rand(0, $j - 1)]);
        }

        $graph = new Graph(array(), $connections);

        /**
         * @var Node[] $graphNodes
         */
        $graphNodes = array();
        foreach ($nodes as $node) {
            $graphNodes[$node->id] = $node;
        }

        $this->assertEquals(count($graphNodes), count($graph->nodes));
        $this->assertEquals($graphNodes, $graph->nodes);
    }

    public function testGraphConnections()
    {
        /**
         * @var Node[] $nodes
         */
        $nodes = array();
        for ($i = 0; $i < 10; ++$i) {
            $nodes[] = new Node;
        }

        /**
         * @var Connection[] $connections
         */
        $min = $connections = array();
        for ($i = 0, $j = count($nodes); $i < $j; ++$i) {
            $connections[] = $connection =
                new Connection($nodes[$i], $nodes[rand(0, $j - 1)], rand(-100, 100) / 10.);

            if (!isset($min[$connection->from->id][$connection->to->id])) {
                $min[$connection->from->id][$connection->to->id] = floatval(INF);
            }

            $min[$connection->from->id][$connection->to->id] = min([$min[$connection->from->id][$connection->to->id],
                $connection->weight]);
        }

        $graph = new Graph(array(), $connections);

        foreach ($connections as $connection) {
            $this->assertContains($connection, $graph->getConnections($connection->from, $connection->to));

            $this->assertContains($connection->weight, $graph->getDistances($connection->from, $connection->to));

            $this->assertContains($connection->to, $graph->getNeighbour($connection->from));

            $this->assertEquals($min[$connection->from->id][$connection->to->id],
                $graph->getNearestDistance($connection->from, $connection->to));

            $this->assertEquals($graph->getNearestDistance($connection->from, $connection->to),
                $graph->getNearestConnection($connection->from, $connection->to)->weight);
        }
    }
}
