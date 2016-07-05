<?php

namespace PHPAlgorithms\GraphTools\Tests;

use PHPAlgorithms\GraphTools\AbstractLine;
use PHPAlgorithms\GraphTools\Exceptions\LineException;
use PHPAlgorithms\GraphTools\Line;
use PHPAlgorithms\GraphTools\Line1D;
use PHPAlgorithms\GraphTools\Line2D;
use PHPAlgorithms\GraphTools\Line3D;
use PHPAlgorithms\GraphTools\Line4D;
use PHPAlgorithms\GraphTools\Point;

class LineTest extends \PHPUnit_Framework_TestCase {
    public function testAbstractLineConstructor()
    {
        try {
            new AbstractLine(Point::AbstractPoint(), Point::AbstractPoint());

            $exception = false;
        } catch (LineException $e) {
            $exception = true;
        }

        $this->assertFalse($exception);

        try {
            $point = Point::create();

            new AbstractLine($point, $point);

            $exception = false;
        } catch (LineException $e) {
            $exception = true;
        }

        $this->assertTrue($exception);

        try {
            new AbstractLine(0, 15);

            $exception = false;
        } catch (LineException $e) {
            $exception = true;
        }

        $this->assertTrue($exception);
    }

    public function testAbstractLineGetter()
    {
        $from = Point::create();
        $to = Point::create();
        $abstractLine = new AbstractLine($from, $to);

        $this->assertNull($abstractLine->length);
        $this->assertEquals($from, $abstractLine->from);
        $this->assertEquals($to, $abstractLine->to);
    }

    public function testLine1DConstructor()
    {
        try {
            new Line1D(Point::Point1D(0), Point::Point1D(8));

            $exception = false;
        } catch (LineException $e) {
            $exception = true;
        }

        $this->assertFalse($exception);

        try {
            $point = Point::create(1);

            new Line1D($point, $point);

            $exception = false;
        } catch (LineException $e) {
            $exception = true;
        }

        $this->assertTrue($exception);

        try {
            new Line1D(Point::create(), Point::create());

            $exception = false;
        } catch (LineException $e) {
            $exception = true;
        }

        $this->assertTrue($exception);

        try {
            new Line1D(0, 15);

            $exception = false;
        } catch (LineException $e) {
            $exception = true;
        }

        $this->assertTrue($exception);
    }

    public function testLine1DGetter()
    {
        $line1D = new Line1D(Point::create(0), Point::create(5));

        $this->assertEquals(5, $line1D->length);

        $from = Point::create(8);
        $to = Point::create(1);
        $line1D = new Line1D($from, $to);

        $this->assertEquals(7, $line1D->length);
        $this->assertEquals($from, $line1D->from);
        $this->assertEquals($to, $line1D->to);
    }

    public function testLine2DConstructor()
    {
        try {
            new Line2D(Point::Point2D(0, 0), Point::Point2D(8, 13));

            $exception = false;
        } catch (LineException $e) {
            $exception = true;
        }

        $this->assertFalse($exception);

        try {
            $point = Point::create(4, -2);

            new Line2D($point, $point);

            $exception = false;
        } catch (LineException $e) {
            $exception = true;
        }

        $this->assertTrue($exception);

        try {
            new Line2D(Point::create(), Point::create());

            $exception = false;
        } catch (LineException $e) {
            $exception = true;
        }

        $this->assertTrue($exception);

        try {
            new Line2D(0, 15);

            $exception = false;
        } catch (LineException $e) {
            $exception = true;
        }

        $this->assertTrue($exception);
    }

    public function testLine2DGetter()
    {
        $line2D = new Line2D(Point::create(0, 0), Point::create(1, 1));

        $this->assertEquals(sqrt(2), $line2D->length);

        $from = Point::create(3, 0);
        $to = Point::create(-2, 0);
        $line2D = new Line2D($from, $to);

        $this->assertEquals(5, $line2D->length);
        $this->assertEquals($from, $line2D->from);
        $this->assertEquals($to, $line2D->to);
    }

    public function testLine3DConstructor()
    {
        try {
            new Line3D(Point::Point3D(0, 0, 0), Point::Point3D(10, -19, 241));

            $exception = false;
        } catch (LineException $e) {
            $exception = true;
        }

        $this->assertFalse($exception);

        try {
            $point = Point::create(1.12, 3.14, -8);

            new Line3D($point, $point);

            $exception = false;
        } catch (LineException $e) {
            $exception = true;
        }

        $this->assertTrue($exception);

        try {
            new Line3D(Point::create(), Point::create());

            $exception = false;
        } catch (LineException $e) {
            $exception = true;
        }

        $this->assertTrue($exception);

        try {
            new Line3D(-2, -13);

            $exception = false;
        } catch (LineException $e) {
            $exception = true;
        }

        $this->assertTrue($exception);
    }

    public function testLine3DGetter()
    {
        $line3D = new Line3D(Point::create(0, 0, 0), Point::create(1, 1, 1));

        $this->assertEquals(sqrt(3), $line3D->length);

        $from = Point::create(0, 0, 1);
        $to = Point::create(-2, 2, -1);
        $line3D = new Line3D($from, $to);

        $this->assertEquals(sqrt(12), $line3D->length);
        $this->assertEquals($from, $line3D->from);
        $this->assertEquals($to, $line3D->to);
    }

    public function testLine4DConstructor()
    {
        try {
            new Line4D(Point::Point4D(0, 0, 0, 0), Point::Point4D(5, 10, 15, -8));

            $exception = false;
        } catch (LineException $e) {
            $exception = true;
        }

        $this->assertFalse($exception);

        try {
            $point = Point::create(13, 4.8, -1, 11);

            new Line4D($point, $point);

            $exception = false;
        } catch (LineException $e) {
            $exception = true;
        }

        $this->assertTrue($exception);

        try {
            new Line4D(Point::create(), Point::create());

            $exception = false;
        } catch (LineException $e) {
            $exception = true;
        }

        $this->assertTrue($exception);

        try {
            new Line4D(8, 20);

            $exception = false;
        } catch (LineException $e) {
            $exception = true;
        }

        $this->assertTrue($exception);
    }

    public function testLine4DGetter()
    {
        $line4D = new Line4D(Point::create(0, 0, 0, 0), Point::create(1, 1, 1, 1));

        $this->assertEquals(2, $line4D->length);

        $from = Point::create(1, 2, 3, 4);
        $to = Point::create(-1, -2, -3, -4);
        $line4D = new Line4D($from, $to);

        $this->assertEquals(sqrt(120), $line4D->length);
        $this->assertEquals($from, $line4D->from);
        $this->assertEquals($to, $line4D->to);
    }

    public function testLineCreate()
    {
        $abstractLine = Line::create(Point::create(), Point::create(1, 2, 3, 4));

        $this->assertInstanceOf(AbstractLine::class, $abstractLine);

        $line1D = Line::create(Point::create(1), Point::create(2, 3, 4, 5));

        $this->assertInstanceOf(Line1D::class, $line1D);

        $line2D = Line::create(Point::create(1, 2), Point::create(3, 4, 5, 6));

        $this->assertInstanceOf(Line2D::class, $line2D);

        $line3D = Line::create(Point::create(1, 2, 3), Point::create(4, 5, 6, 7));

        $this->assertInstanceOf(Line3D::class, $line3D);

        $line4D = Line::create(Point::create(1, 2, 3, 4), Point::create(5, 6, 7, 8));

        $this->assertInstanceOf(Line4D::class, $line4D);
    }
}
