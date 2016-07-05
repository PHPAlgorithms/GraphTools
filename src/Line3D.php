<?php

/**
 * @author ventaquil <ventaquil@outlook.com>
 * @licence MIT
 */

namespace PHPAlgorithms\GraphTools;

use PHPAlgorithms\GraphTools\Interfaces\LineInterface;
use PHPAlgorithms\GraphTools\Exceptions\LineException;

/**
 * Class Line3D
 * @package PHPAlgorithms\GraphTools
 */
class Line3D extends Line2D implements LineInterface {
    /**
     * Method checks sent variable and throws LineException if it is not an Point3D instance.
     *
     * @param mixed $point Variable to check.
     * @throws LineException If sent argument is not an Point3D instance.
     */
    protected function checkPoint($point)
    {
        if (!($point instanceof Point3D)) {
            throw new LineException('This is not a point');
        }
    }

    /**
     * Method counts width.
     *
     * return float Line width.
     */
    protected function countWidth()
    {
        return sqrt(pow($this->from->x - $this->to->x, 2) + pow($this->from->y - $this->to->y, 2) + pow($this->from->z - $this->to->z, 2));
    }

    /**
     * Line3D constructor.
     *
     * @param mixed $from First end of the line.
     * @param mixed $to Second end of the line.
     */
    public function __construct($from, $to)
    {
        parent::__construct($from, $to);
    }
}
