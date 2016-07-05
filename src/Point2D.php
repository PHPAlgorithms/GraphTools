<?php

/**
 * @author ventaquil <ventaquil@outlook.com>
 * @licence MIT
 */

namespace PHPAlgorithms\GraphTools;

use PHPAlgorithms\GraphTools\Interfaces\PointInterface;
use PHPAlgorithms\GraphTools\Exceptions\PointException;

/**
 * Class Point2D
 * @package PHPAlgorithms\GraphTools
 * @property-read int|float $y
 */
class Point2D extends Point1D implements PointInterface {
    /**
     * @var int|float $y Position on OY axis.
     */
    protected $y;

    /**
     * Method checks position on OY axis.
     *
     * @param int|float $y Position on OY axis.
     * @throws PointException When $y is not a numeric value.
     */
    protected function checkY($y)
    {
        if (!is_numeric($y)) {
            throw new PointException("y: {$y} must be numeric value");
        }
    }

    /**
     * Point2D constructor.
     *
     * @param int|float $x Position on OX axis.
     * @param int|float $y Position on OY axis.
     */
    public function __construct($x, $y)
    {
        parent::__construct($x);

        $this->checkY($y);

        $this->y = $y;
    }

    /**
     * Move point by sent value.
     *
     * @param int|float $x Move vector on OX axis.
     * @param int|float $y Move vector on OY axis.
     * @return Point2D Method returns current object instance.
     */
    public function move($x = 0, $y = 0)
    {
        parent::move($x);

        $this->checkY($y);

        $this->y += $y;

        return $this;
    }

    /**
     * Method creates point in lower dimension.
     *
     * @return Point1D Returns an point in 1D.
     */
    public function lowerDimension()
    {
        return new Point1D($this->x);
    }
}
