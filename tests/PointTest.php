<?php

namespace PHPAlgorithms\GraphTools\Tests;

use PHPAlgorithms\GraphTools\AbstractPoint;
use PHPAlgorithms\GraphTools\Exceptions\PointException;
use PHPAlgorithms\GraphTools\Point;
use PHPAlgorithms\GraphTools\Point1D;
use PHPAlgorithms\GraphTools\Point2D;
use PHPAlgorithms\GraphTools\Point3D;
use PHPAlgorithms\GraphTools\Point4D;

class PointTest extends \PHPUnit_Framework_TestCase
{
    public function testAbstractPointConstructor()
    {
        try {
            new AbstractPoint();

            $exception = false;
        } catch (PointException $e) {
            $exception = true;
        }

        $this->assertFalse($exception);

        try {
            new AbstractPoint('test');

            $exception = false;
        } catch (PointException $e) {
            $exception = true;
        }

        $this->assertFalse($exception);
    }

    public function testAbstractPointEquals()
    {
        $abstractPoint = new AbstractPoint();

        $this->assertTrue($abstractPoint->equals($abstractPoint));

        $this->assertFalse($abstractPoint->equals(new AbstractPoint()));
    }

    public function testAbstractPointLowerDimension()
    {
        $abstractPoint = new AbstractPoint();

        $this->assertNull($abstractPoint->lowerDimension());
    }

    public function testPoint1DConstructor()
    {
        try {
            new Point1D(1);

            $exception = false;
        } catch (PointException $e) {
            $exception = true;
        }

        $this->assertFalse($exception);

        try {
            new Point1D('test');

            $exception = false;
        } catch (PointException $e) {
            $exception = true;
        }

        $this->assertTrue($exception);

        try {
            new Point1D(true);

            $exception = false;
        } catch (PointException $e) {
            $exception = true;
        }

        $this->assertTrue($exception);
    }

    public function testPoint1DMove()
    {
        $point1D = new Point1D(1.3);

        $this->assertEquals($point1D->x + 5, $point1D->move(5)->x);
        $this->assertEquals($point1D->x - 13.25, $point1D->move(-13.25)->x);
    }

    public function testPoint1DEquals()
    {
        $point1D = new Point1D(1);

        $this->assertTrue($point1D->equals($point1D));
        $this->assertFalse($point1D->equals(new Point1D(1)));
        $this->assertFalse($point1D->equals(new Point1D(80)));
        $this->assertTrue($point1D->equals($point1D->move(-30)));
    }

    public function testPoint1DLowerDimension()
    {
        $point1D = new Point1D(17);

        $this->assertInstanceOf(AbstractPoint::class, $point1D->lowerDimension());
    }

    public function testPoint2DConstructor()
    {
        try {
            new Point2D(1, 1);

            $exception = false;
        } catch (PointException $e) {
            $exception = true;
        }

        $this->assertFalse($exception);

        try {
            new Point2D('test', 'test');

            $exception = false;
        } catch (PointException $e) {
            $exception = true;
        }

        $this->assertTrue($exception);

        try {
            new Point2D(true, false);

            $exception = false;
        } catch (PointException $e) {
            $exception = true;
        }

        $this->assertTrue($exception);
    }

    public function testPoint2DMove()
    {
        $point2D = new Point2D(1, 2);

        $this->assertEquals($point2D->y + 3.2, $point2D->move(0, 3.2)->y);
        $this->assertEquals($point2D->y - 0.12, $point2D->move(0, -0.12)->y);
    }

    public function testPoint2DEquals()
    {
        $point2D = new Point2D(-12, 0);

        $this->assertTrue($point2D->equals($point2D));
        $this->assertFalse($point2D->equals(new Point2D(-12, 0)));
        $this->assertFalse($point2D->equals(new Point2D(-12, -1)));
        $this->assertTrue($point2D->equals($point2D->move(1, 2)));
    }

    public function testPoint2DLowerDimension()
    {
        $point2D = new Point2D(13, 14);

        $this->assertInstanceOf(Point1D::class, $point2D->lowerDimension());
    }

    public function testPoint3DConstructor()
    {
        try {
            new Point3D(1, 1, 1);

            $exception = false;
        } catch (PointException $e) {
            $exception = true;
        }

        $this->assertFalse($exception);

        try {
            new Point3D('test', 'test', 'test');

            $exception = false;
        } catch (PointException $e) {
            $exception = true;
        }

        $this->assertTrue($exception);

        try {
            new Point3D(true, false, true);

            $exception = false;
        } catch (PointException $e) {
            $exception = true;
        }

        $this->assertTrue($exception);
    }

    public function testPoint3DMove()
    {
        $point3D = new Point3D(18, 128, -314);

        $this->assertEquals($point3D->z + 8, $point3D->move(0, 0, 8)->z);
        $this->assertEquals($point3D->z - 3, $point3D->move(0, 0, -3)->z);
    }

    public function testPoint3DEquals()
    {
        $point3D = new Point2D(16, 18, 20);

        $this->assertTrue($point3D->equals($point3D));
        $this->assertFalse($point3D->equals(new Point3D(16, 18, 20)));
        $this->assertFalse($point3D->equals(new Point3D(16, -1, 20)));
        $this->assertTrue($point3D->equals($point3D->move(0, 0, 5)));
    }

    public function testPoint3DLowerDimension()
    {
        $point3D = new Point3D(-1, -2, -3);

        $this->assertInstanceOf(Point2D::class, $point3D->lowerDimension());
    }

    public function testPoint4DConstructor()
    {
        try {
            new Point4D(1, 1, 1, 1);

            $exception = false;
        } catch (PointException $e) {
            $exception = true;
        }

        $this->assertFalse($exception);

        try {
            new Point4D('test', 'test', 'test', 'test');

            $exception = false;
        } catch (PointException $e) {
            $exception = true;
        }

        $this->assertTrue($exception);

        try {
            new Point4D(true, false, true, false);

            $exception = false;
        } catch (PointException $e) {
            $exception = true;
        }

        $this->assertTrue($exception);
    }

    public function testPointCreate()
    {
        $abstractPoint = Point::create();

        $this->assertInstanceOf(AbstractPoint::class, $abstractPoint);

        $point1D = Point::create(10);

        $this->assertInstanceOf(Point1D::class, $point1D);

        $point2D = Point::create(8, -21.4);

        $this->assertInstanceOf(Point2D::class, $point2D);

        $point3D = Point::create(0, 2, 5);

        $this->assertInstanceOf(Point3D::class, $point3D);

        $point4D = Point::create(12.34, 0.13, -3.14, 5.02);

        $this->assertInstanceOf(Point4D::class, $point4D);

        try {
            Point::create(1, 2, 3, 4, 5);

            $exception = false;
        } catch (PointException $e) {
            $exception = true;
        }

        $this->assertTrue($exception);
    }
}
