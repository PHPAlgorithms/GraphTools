<?php
namespace Algorithms\Tests;

class ConnectionsContainerTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $point1 = new \Algorithms\GraphTools\Point(1);
        $point2 = new \Algorithms\GraphTools\Point(2);
        $distance = 10;

        $container = $point1->addConnection($point2, $distance);
        $this->assertNotNull($container);
        $this->assertTrue($container instanceof \Algorithms\GraphTools\ConnectionsContainer);
        $this->assertNotEmpty($container->get($point1->id));
        $this->assertEquals($container->get($point1->id), $container->get(1));
        $this->assertEmpty($container->get($point2->id));
        $this->assertEquals($container->get($point2->id), $container->get(2));

        $connection = new \Algorithms\GraphTools\Connection($point1, $point2, $distance);
        $container = new \Algorithms\GraphTools\ConnectionsContainer(array($connection));
        $this->assertNotEmpty($container->get($point1->id));
        $this->assertEquals($container->get($point1->id), $container->get(1));
        $this->assertEmpty($container->get($point2->id));
        $this->assertEquals($container->get($point2->id), $container->get(2));
    }

    public function testAdding()
    {
        $point1 = new \Algorithms\GraphTools\Point(1);
        $point2 = new \Algorithms\GraphTools\Point(2);
        $point3 = new \Algorithms\GraphTools\Point(3);
        $distance = 10;

        $container = new \Algorithms\GraphTools\ConnectionsContainer();

        $connection = new \Algorithms\GraphTools\Connection($point1, $point2, $distance);
        $this->assertEquals($container, $container->add($connection));
        $this->assertNotEmpty($container->get($point1->id));
        $this->assertEquals($container->get($point1->id), $container->get(1));
        $this->assertEmpty($container->get($point2->id));
        $this->assertEquals($container->get($point2->id), $container->get(2));

        $container = new \Algorithms\GraphTools\ConnectionsContainer();
        $container->addConnection($point1, $point2, $distance);
        $this->assertNotEmpty($container->get($point1->id));
        $this->assertEquals($container->get($point1->id), $container->get(1));
        $this->assertEmpty($container->get($point2->id));
        $this->assertEquals($container->get($point2->id), $container->get(2));

        $container = $point1->addConnection($point2, $distance)
                            ->addConnection($point3, $distance);
        $this->assertTrue($container instanceof \Algorithms\GraphTools\ConnectionsContainer);
        $this->assertNotEmpty($container->get($point1->id));
        $this->assertEquals($container->get($point1->id), $container->get(1));
        $this->assertEmpty($container->get($point2->id));
        $this->assertEquals($container->get($point2->id), $container->get(2));
    }

    public function testAll()
    {
        $point1 = new \Algorithms\GraphTools\Point(1);
        $point2 = new \Algorithms\GraphTools\Point(2);
        $point3 = new \Algorithms\GraphTools\Point(3);
        $distance = 10;

        $container = new \Algorithms\GraphTools\ConnectionsContainer();
        $container->addConnection($point1, $point2, $distance)
                  ->addConnection($point3, $distance)
                  ->addConnection($point3, $point1, $distance);

        $this->assertTrue(is_array($container->all()));

        $this->assertEquals(count($container->all()), 3);
    }
}
