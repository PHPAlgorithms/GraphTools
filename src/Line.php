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

        $argsToClass = array(
            'AbstractLine',
            'Line1D',
            'Line2D',
            'Line3D',
            'Line4D',
        );

        if (!isset($argsToClass[$lowestDimension])) {
            throw new LineException('Unknown dimension');
        }

        $className = __NAMESPACE__ . "\\{$argsToClass[$lowestDimension]}";

        return new $className($from, $to);
    }
}
