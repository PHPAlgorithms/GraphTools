<?php

/**
 * @author ventaquil <ventaquil@outlook.com>
 * @licence MIT
 */

namespace PHPAlgorithms\GraphTools;

use PHPAlgorithms\GraphTools\Interfaces\PointInterface;
use PHPAlgorithms\GraphTools\Exceptions\PointException;

/**
 * Class Point1D
 * @package PHPAlgorithms\GraphTools
 * @property-read int|float $x
 */
class Point1D extends AbstractPoint implements PointInterface {
    /**
     * @var int|float $x Position on OX axis.
     */
    protected $x;

    /**
     * Method checks position on OX axis.
     *
     * @param int|float $x Position on OX axis.
     * @throws PointException When $x is not a numeric value.
     */
    protected function checkX($x)
    {
        if (!is_numeric($x)) {
            throw new PointException("x: {$x} must be numeric value");
        }
    }

    /**
     * Point1D constructor.
     *
     * @param int|float $x Position on OX axis.
     */
    public function __construct($x)
    {
        $this->checkX($x);

        $this->x = $x;
    }

    /**
     * Move point by sent value.
     *
     * @param int|float $x Move vector on OX axis.
     * @return Point1D Method returns current object instance.
     */
    public function move($x = 0)
    {
        $this->checkX($x);

        $this->x += $x;

        return $this;
    }

    /**
     * Method creates point in lower dimension.
     *
     * @return AbstractPoint Returns an abstract point.
     */
    public function lowerDimension()
    {
        return new AbstractPoint();
    }
}
