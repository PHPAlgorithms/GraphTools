<?php

namespace PHPAlgorithms\GraphTools;

use PHPAlgorithms\GraphTools\Exceptions\PointException;

abstract class Point {
    public static function create()
    {
        switch (func_num_args()) {
            case 0:
                return self::AbstractPoint();
            case 1:
                return self::Point1D(func_get_arg(0));
            case 2:
                return self::Point2D(func_get_arg(0), func_get_arg(1));
            case 3:
                return self::Point3D(func_get_arg(0), func_get_arg(1), func_get_arg(2));
            case 4:
                return self::Point4D(func_get_arg(0), func_get_arg(1), func_get_arg(2), func_get_arg(3));
            default:
                throw new PointException('Unknown constructor');
        }
    }

    public static function AbstractPoint()
    {
        return new AbstractPoint();
    }

    public static function Point1D($x)
    {
        return new Point1D($x);
    }

    public static function Point2D($x, $y)
    {
        return new Point2D($x, $y);
    }

    public static function Point3D($x, $y, $z)
    {
        return new Point3D($x, $y, $z);
    }

    public static function Point4D($x, $y, $z, $t)
    {
        return new Point4D($x, $y, $z, $t);
    }
}
