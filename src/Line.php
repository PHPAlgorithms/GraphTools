<?php

namespace PHPAlgorithms\GraphTools;

use PHPAlgorithms\GraphTools\Exceptions\LineException;

abstract class Line {
    private static function checkPoint($point)
    {
        if (!($point instanceof AbstractPoint)) {
            throw new LineException('This is not a point');
        }
    }

    private static function getDimensionNumber($point)
    {
        $pointDimensions = array(AbstractPoint::class, Point1D::class, Point2D::class, Point3D::class, Point4D::class);

        foreach ($pointDimensions as $dimension => $pointDimension)
        {
            if (!($point instanceof $pointDimension)) {
                return --$dimension;
            }
        }

        return $dimension;
    }

    private static function getLowestPointsDimension($from, $to)
    {
        $fromDimension = self::getDimensionNumber($from);
        $toDimension = self::getDimensionNumber($to);

        switch (true) {
            case $fromDimension <= $toDimension:
                return $fromDimension;
            case $fromDimension > $toDimension:
                return $toDimension;
        }
    }

    public static function create($from, $to)
    {
        self::checkPoint($from);
        self::checkPoint($to);

        $lowestDimension = self::getLowestPointsDimension($from, $to);

        switch ($lowestDimension) {
            case 0:
                return new AbstractLine($from, $to);
            case 1:
                return new Line1D($from, $to);
            case 2:
                return new Line2D($from, $to);
            case 3:
                return new Line3D($from, $to);
            case 4:
                return new Line4D($from, $to);
            default:
                throw new LineException('Unknown dimension');
        }
    }
}
