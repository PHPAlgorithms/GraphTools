<?php
namespace Algorithms\Tests;

class CreatorTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $creator = new \Algorithms\GraphTools\Creator();
        $this->assertNotEmpty($creator);

        $creator = new \Algorithms\GraphTools\Creator(
            array(
                new \Algorithms\GraphTools\Point(1),
                new \Algorithms\GraphTools\Point(2)
            )
        );
        $this->assertNotEmpty($creator);
    }

    public function testAddPoints()
    {
        $creator = new \Algorithms\GraphTools\Creator();
        $this->assertNull($creator->get(1));

        $creator->add(1);
        $this->assertNotEmpty($creator->get(1));
        $this->assertTrue($creator->get(1) instanceof \Algorithms\GraphTools\Point);

        $creator->add(new \Algorithms\GraphTools\Point(2));
        $this->assertNotEmpty($creator->get(2));
        $this->assertTrue($creator->get(2) instanceof \Algorithms\GraphTools\Point);
    }
}
