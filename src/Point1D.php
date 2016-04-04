<?php

namespace PHPAlgorithms\GraphTools;

use PHPAlgorithms\GraphTools\Interfaces\PointInterface;
use PHPAlgorithms\GraphTools\Exceptions\PointException;

class Point1D extends AbstractPoint implements PointInterface {
    protected $x;

    protected function checkX($x)
    {
        if (!is_numeric($x)) {
            throw new PointException("x: {$x} must be numeric value");
        }
    }

    public function __construct($x)
    {
        $this->checkX($x);

        $this->x = $x;
    }

    public function move($x = 0)
    {
        $this->checkX($x);

        $this->x += $x;

        return $this;
    }

    public function lowerDimension()
    {
        return new AbstractPoint();
    }
}
