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
}
