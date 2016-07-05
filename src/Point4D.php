<?php

/**
 * @author ventaquil <ventaquil@outlook.com>
 * @licence MIT
 */

namespace PHPAlgorithms\GraphTools;

use PHPAlgorithms\GraphTools\Interfaces\PointInterface;
use PHPAlgorithms\GraphTools\Exceptions\PointException;

/**
 * Class Point4D
 * @package PHPAlgorithms\GraphTools
 * @property-read int|float $t
 */
class Point4D extends Point3D implements PointInterface {
    /**
     * @var int|float $t Position on OT axis.
     */
    protected $t;

    /**
     * Method checks position on OT axis.
     *
     * @param int|float $t Position on OT axis.
     * @throws PointException When $t is not a numeric value.
     */
    protected function checkT($t)
    {
        if (!is_numeric($t)) {
            throw new PointException("t: {$t} must be numeric value");
        }
    }

    /**
     * Point4D constructor.
     *
     * @param int|float $x Position on OX axis.
     * @param int|float $y Position on OY axis.
     * @param int|float $z Position on OZ axis.
     * @param int|float $t Position on OT axis.
     */
    public function __construct($x, $y, $z, $t)
    {
        parent::__construct($x, $y, $z);

        $this->checkT($t);

        $this->t = $t;
    }

    /**
     * Move point by sent value.
     *
     * @param int|float $x Move vector on OX axis.
     * @param int|float $y Move vector on OY axis.
     * @param int|float $z Move vector on OY axis.
     * @param int|float $t Move vector on OT axis.
     * @return Point4D Method returns current object instance.
     */
    public function move($x = 0, $y = 0, $z = 0, $t = 0)
    {
        parent::move($x, $y, $z);

        $this->checkT($t);

        $this->t += $t;

        return $this;
    }

    /**
     * Method creates point in lower dimension.
     *
     * @return Point3D Returns an point in 3D.
     */
    public function lowerDimension()
    {
        return new Point3D($this->x, $this->y, $this->z);
    }
}
