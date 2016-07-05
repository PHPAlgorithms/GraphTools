<?php

/**
 * @author ventaquil <ventaquil@outlook.com>
 * @licence MIT
 */

namespace PHPAlgorithms\GraphTools;

use PHPAlgorithms\GraphTools\Interfaces\PointInterface;
use PHPAlgorithms\GraphTools\Exceptions\PointException;

/**
 * Class Point3D
 * @package PHPAlgorithms\GraphTools
 * @property-read int|float $z
 */
class Point3D extends Point2D implements PointInterface {
    /**
     * @var int|float $z Position on OZ axis.
     */
    protected $z;

    /**
     * Method checks position on OZ axis.
     *
     * @param int|float $z Position on OZ axis.
     * @throws PointException When $z is not a numeric value.
     */
    protected function checkZ($z)
    {
        if (!is_numeric($z)) {
            throw new PointException("z: {$z} must be numeric value");
        }
    }

    /**
     * Point3D constructor.
     *
     * @param int|float $x Position on OX axis.
     * @param int|float $y Position on OY axis.
     * @param int|float $z Position on OZ axis.
     */
    public function __construct($x, $y, $z)
    {
        parent::__construct($x, $y);

        $this->checkZ($z);

        $this->z = $z;
    }

    /**
     * Move point by sent value.
     *
     * @param int|float $x Move vector on OX axis.
     * @param int|float $y Move vector on OY axis.
     * @param int|float $z Move vector on OY axis.
     * @return Point3D Method returns current object instance.
     */
    public function move($x = 0, $y = 0, $z = 0)
    {
        parent::move($x, $y);

        $this->checkZ($z);

        $this->z += $z;

        return $this;
    }

    /**
     * Method creates point in lower dimension.
     *
     * @return Point2D Returns an point in 2D.
     */
    public function lowerDimension()
    {
        return new Point2D($this->x, $this->y);
    }
}
