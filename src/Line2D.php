<?php

/**
 * @author ventaquil <ventaquil@outlook.com>
 * @licence MIT
 */

namespace PHPAlgorithms\GraphTools;

use PHPAlgorithms\GraphTools\Interfaces\LineInterface;
use PHPAlgorithms\GraphTools\Exceptions\LineException;

/**
 * Class Line2D
 * @package PHPAlgorithms\GraphTools
 */
class Line2D extends Line1D implements LineInterface {
    /**
     * Method checks sent variable and throws LineException if it is not an Point2D instance.
     *
     * @param mixed $point Variable to check.
     * @throws LineException If sent argument is not an Point2D instance.
     */
    protected function checkPoint($point)
    {
        if (!($point instanceof Point2D)) {
            throw new LineException('This is not a point');
        }
    }

    /**
     * Method counts width.
     *
     * return float Line width.
     */
    protected function countLength()
    {
        return sqrt(pow($this->from->x - $this->to->x, 2) + pow($this->from->y - $this->to->y, 2));
    }

    /**
     * Line2D constructor.
     *
     * @param mixed $from First end of the line.
     * @param mixed $to Second end of the line.
     */
    public function __construct($from, $to)
    {
        parent::__construct($from, $to);
    }
}
