<?php

namespace PHPAlgorithms\GraphTools\Tests\Graph\Connection;

use PHPAlgorithms\GraphTools\Graph\Builder as GraphBuilder;
use PHPAlgorithms\GraphTools\Graph\Connection;
use PHPAlgorithms\GraphTools\Graph\Connection\Builder;
use PHPAlgorithms\GraphTools\Graph\Node;
use PHPUnit\Framework\Error\Error;
use PHPUnit\Framework\TestCase;

/**
 * Class BuilderTest
 * @package PHPAlgorithms\GraphTools\Tests\Graph\Connection
 */
final class BuilderTest extends TestCase
{
    public function testGettersAndSetters()
    {
        $builder = new Builder;

        $this->assertSame($builder, $builder->setFrom($from = new Node));
        $this->assertSame($builder, $builder->setTo($to = new Node));
        $this->assertSame($builder, $builder->setWeight(15.0));

        $this->assertSame($from, $builder->from);
        $this->assertSame($to, $builder->to);
        $this->assertSame(15.0, $builder->weight);

        $this->assertSame($builder->from, $builder->getFrom());
        $this->assertSame($builder->to, $builder->getTo());
        $this->assertSame($builder->weight, $builder->getWeight());

        $this->expectException(Error::class);

        $builder->setTest(null);
    }

    public function testBuild()
    {
        $builder = new Builder;
        $builder->setFrom($from = new Node)->setTo($to = new Node)->setWeight(-5.0);

        $this->assertInstanceOf(Connection::class, $builder->build());
        $this->assertEquals($builder->build(), $builder->build());
        $this->assertNotSame($builder->build(), $builder->build());

        /**
         * @var Connection $connection
         */
        $connection = $builder->build();

        $this->assertSame($from, $connection->from);
        $this->assertSame($to, $connection->to);
        $this->assertSame(-5.0, $connection->weight);

        $graphBuilder = new GraphBuilder;
        $builder = new Builder($graphBuilder);
        $builder->setFrom(new Node)->setTo(new Node);

        $this->assertInstanceOf(GraphBuilder::class, $builder->build());
        $this->assertSame($graphBuilder, $builder->build());
    }
}
