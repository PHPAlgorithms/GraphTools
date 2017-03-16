<?php

namespace PHPAlgorithms\GraphTools\Tests\Graph\Node;

use PHPAlgorithms\GraphTools\Graph\Builder as GraphBuilder;
use PHPAlgorithms\GraphTools\Graph\Node;
use PHPAlgorithms\GraphTools\Graph\Node\Builder;
use PHPUnit\Framework\Error\Error;
use PHPUnit\Framework\TestCase;

/**
 * Class BuilderTest
 * @package PHPAlgorithms\GraphTools\Tests\Graph\Node
 */
final class BuilderTest extends TestCase
{
    public function testGettersAndSetters()
    {
        $builder = new Builder;

        $this->assertSame($builder, $builder->setX(5.0));
        $this->assertSame($builder, $builder->setY(10.0));
        $this->assertSame($builder, $builder->setZ(15.0));

        $this->assertSame(5.0, $builder->x);
        $this->assertSame(10.0, $builder->y);
        $this->assertSame(15.0, $builder->z);

        $this->assertSame($builder->x, $builder->getX());
        $this->assertSame($builder->y, $builder->getY());
        $this->assertSame($builder->z, $builder->getZ());

        $this->expectException(Error::class);

        $builder->setTest(null);
    }

    public function testBuild()
    {
        $builder = new Builder;
        $builder->setX(0.0)->setY(1.0)->setZ(2.0);

        $this->assertInstanceOf(Node::class, $builder->build());
        $this->assertNotEquals($builder->build(), $builder->build());
        $this->assertNotSame($builder->build(), $builder->build());

        /**
         * @var Node $node
         */
        $node = $builder->build();

        $this->assertSame(0.0, $node->x);
        $this->assertSame(1.0, $node->y);
        $this->assertSame(2.0, $node->z);

        $graphBuilder = new GraphBuilder;
        $builder = new Builder($graphBuilder);

        $this->assertInstanceOf(GraphBuilder::class, $builder->build());
        $this->assertSame($graphBuilder, $builder->build());
    }
}
