<?php

namespace PHPAlgorithms\GraphTools;

use PHPAlgorithms\GraphTools\Interfaces\PointInterface;
use PHPAlgorithms\GraphTools\Exceptions\PointException;

class Point2D extends Point1D implements PointInterface {
    protected $y;

    protected function checkY($y)
    {
        if (!is_numeric($y)) {
            throw new PointException("y: {$y} must be numeric value");
        }
    }

    public function __construct($x, $y)
    {
        parent::__construct($x);

        $this->checkY($y);

        $this->y = $y;
    }

    public function move($x = 0, $y = 0)
    {
        parent::move($x);

        $this->checkY($y);

        $this->y += $y;

        return $this;
    }

    public function lowerDimension()
    {
        return new Point1D($this->x);
    }
}
