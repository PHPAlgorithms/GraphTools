<?php
namespace Algorithms\Tests;

class PointTest extends \PHPUnit_Framework_TestCase
{
    public function testMode()
    {
        $creator = new \Algorithms\GraphTools\Creator;

        $point = $creator->addPoint(1);
        $this->assertNotEmpty($point);

        $creator->addPoint(2)
                ->addRelation($point, 1)
                ->addRelation(3, 3);

        $this->assertEquals($creator->getPoint(1), $point);

        $point = \Algorithms\GraphTools\Point::create(6);
        $this->assertNotEmpty($point);

        $creator->addPoint($point)
                ->addRelation(2, 6);

        $this->assertEquals($creator->getPoint(6)
                                    ->getLabel(),
                            $point->getLabel());
    }

    public function testCoordinates()
    {
        $point = new \Algorithms\GraphTools\Point(1);

        $this->assertNull($point->getX());
        $this->assertEquals($point->setX(15), $point);
        $this->assertEquals($point->getX(15), 15);

        $this->assertNull($point->getY());
        $this->assertEquals($point->setY(29), $point);
        $this->assertEquals($point->getY(29), 29);
    }

    public function testToArrayMethod()
    {
        $point = new \Algorithms\GraphTools\Point(1);

        $this->assertTrue(is_array($point->toArray()));
        $this->assertEquals($point->toArray()['id'], 1);

        $point->setX(0)
              ->setY(-5);
        $this->assertEquals($point->toArray()['x'], 0);
        $this->assertEquals($point->toArray()['y'], -5);
    }
}
