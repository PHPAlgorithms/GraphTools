<?php

namespace PHPAlgorithms\GraphTools\Tests\Graph;

use PHPAlgorithms\GraphTools\Graph;
use PHPAlgorithms\GraphTools\Graph\Builder;
use PHPAlgorithms\GraphTools\Graph\Connection;
use PHPAlgorithms\GraphTools\Graph\Node;
use PHPUnit\Framework\TestCase;

/**
 * Class BuilderTest
 * @package PHPAlgorithms\GraphTools\Tests\Graph
 */
final class BuilderTest extends TestCase
{
    public function testAddingNode()
    {
        $builder = new Builder;

        $this->assertInstanceOf(Builder::class, $builder->addNode(new Node));

        $this->assertSame($builder, $builder->addNode($node = new Node));

        $this->assertEquals(2, count($builder->nodes));

        $this->expectException(Builder\Exception::class);

        $builder->addNode($node);

        $this->assertEquals(2, count($builder->nodes));
    }

    public function testAddingConnection()
    {
        $builder = new Builder;

        $this->assertInstanceOf(Builder::class, $builder->addConnection(new Connection(new Node, new Node)));

        $this->assertSame($builder, $builder->addConnection($connection = new Connection(new Node, new Node)));

        $this->assertEquals(2, count($builder->connections));

        $builder->addConnection($connection);

        $this->assertEquals(3, count($builder->connections));
    }

    public function testAndViceVersaMethod()
    {
        $builder = new Builder;

        $this->assertEquals(0, count($builder->connections));

        $builder->createConnection()->setFrom($from = new Node)->setTo($to = new Node)->setWeight($weight = 10.0)
            ->build()->viceVersa();

        $this->assertEquals(2, count($builder->connections));

        /**
         * @var Connection $connection
         */

        $connection = $builder->connections[0];
        $this->assertEquals($from, $connection->from);
        $this->assertEquals($to, $connection->to);
        $this->assertEquals($weight, $connection->weight);


        $connection = $builder->connections[1];
        $this->assertEquals($to, $connection->from);
        $this->assertEquals($from, $connection->to);
        $this->assertEquals($weight, $connection->weight);

        $this->expectException(Builder\Exception::class);

        $builder->viceVersa();
    }

    public function testGeneratingGraph()
    {
        $builder = new Builder;

        $this->assertInstanceOf(Graph::class, $builder->build());

        $this->assertEquals($builder->build(), $builder->build());

        $this->assertNotSame($builder->build(), $builder->build());
    }

    public function testRestoringGraphBuilder()
    {
        $builder = new Builder;

        $this->assertNotInstanceOf(Builder::class, $connectionBuilder = $builder->createConnection());

        $connectionBuilder->setFrom(new Node)->setTo(new Node);

        $this->assertInstanceOf(Builder::class, $t = $connectionBuilder->build());

        $this->assertSame($builder, $t);
    }
}
