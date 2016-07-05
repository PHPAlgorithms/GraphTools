<?php

/**
 * @author ventaquil <ventaquil@outlook.com>
 * @licence MIT
 */

namespace PHPAlgorithms\GraphTools;

use PHPAlgorithms\GraphTools\Interfaces\LineInterface;
use PHPAlgorithms\GraphTools\Exceptions\LineException;

/**
 * Class Line1D
 * @package PHPAlgorithms\GraphTools
 * @property-read float $length
 * @property-read float $width
 */
class Line1D extends AbstractLine implements LineInterface {
    /**
     * @var float $length Line length property.
     * @var float $width Line width property.
     */
    protected $length,
              $width;

    /**
     * Method checks sent variable and throws LineException if it is not an Point1D instance.
     *
     * @param mixed $point Variable to check.
     * @throws LineException If sent argument is not an Point1D instance.
     */
    protected function checkPoint($point)
    {
        if (!($point instanceof Point1D)) {
            throw new LineException('This is not a point');
        }
    }

    /**
     * Method counts length.
     *
     * return float Line length.
     */
    protected function countLength()
    {
        return abs($this->from->x - $this->to->x);
    }

    /**
     * Line1D constructor.
     *
     * @param mixed $from First end of the line.
     * @param mixed $to Second end of the line.
     */
    public function __construct($from, $to)
    {
        parent::__construct($from, $to);

        $this->width = $this->length
                     = $this->countLength();
    }
}
