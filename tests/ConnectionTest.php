<?php
namespace Algorithms\Tests;

class ConnectionTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $point1 = new \Algorithms\GraphTools\Point(1);
        $point2 = new \Algorithms\GraphTools\Point(2);
        $distance = 10;

        $connection = new \Algorithms\GraphTools\Connection($point1, $point2, $distance);
        $this->assertNotNull($connection);
        $this->assertTrue($connection instanceof \Algorithms\GraphTools\Connection);

        $this->assertNotNull($connection->from);
        $this->assertEquals($point1, $connection->from);

        $this->assertNotNull($connection->to);
        $this->assertEquals($point2, $connection->to);

        $this->assertNotNull($connection->distance);
        $this->assertEquals($distance, $connection->distance);
    }
}
