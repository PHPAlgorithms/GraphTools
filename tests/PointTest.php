<?php
namespace Algorithms\Tests;

class PointTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $point = new \Algorithms\GraphTools\Point(1);
        $this->assertNotEmpty($point);

        $point = \Algorithms\GraphTools\Point::create(1);
        $this->assertNotEmpty($point);
        $this->assertTrue($point instanceof \Algorithms\GraphTools\Point);

        $this->assertTrue(\Algorithms\GraphTools\Point::create(2) == new \Algorithms\GraphTools\Point(2));
    }

    public function testLabels()
    {
        $point = new \Algorithms\GraphTools\Point(1);
        $this->assertNull($point->label);

        $point = new \Algorithms\GraphTools\Point(1, 'label');
        $this->assertNotNull($point->label);
        $this->assertEquals($point->label, 'label');

        $point->label = 'abecadlo';
        $this->assertNotNull($point->label);
        $this->assertEquals($point->label, 'abecadlo');
    }

    public function testCoordinates()
    {
        $point = new \Algorithms\GraphTools\Point(1);
        $this->assertNull($point->x);
        $this->assertNull($point->y);

        $point->x = 15;
        $this->assertNotNull($point->x);
        $this->assertEquals($point->x, 15);

        $point->y = -2;
        $this->assertNotNull($point->y);
        $this->assertEquals($point->y, -2);
    }

    public function testToArrayMethod()
    {
        $point = new \Algorithms\GraphTools\Point(1);

        $this->assertTrue(is_array($point->toArray()));
        $this->assertNotNull($point->toArray()['id']);
        $this->assertEquals($point->toArray()['id'], 1);

        $point->x = 0;
        $point->y = -5;
        $this->assertNotNull($point->toArray()['x']);
        $this->assertEquals($point->toArray()['x'], 0);
        $this->assertNotNull($point->toArray()['y']);
        $this->assertEquals($point->toArray()['y'], -5);
    }

    public function testCheckMethods()
    {
        $point = null;
        $this->assertFalse(\Algorithms\GraphTools\Point::check($point));

        $point = new \Algorithms\GraphTools\Point(1);
        $this->assertTrue(\Algorithms\GraphTools\Point::check($point));
        $this->assertTrue(\Algorithms\GraphTools\Point::checkOrFail($point));
    }
}
