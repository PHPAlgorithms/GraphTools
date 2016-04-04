<?php

namespace PHPAlgorithms\GraphTools;

use PHPAlgorithms\GraphTools\Interfaces\LineInterface;
use PHPAlgorithms\GraphTools\Exceptions\LineException;

class Line2D extends Line1D implements LineInterface {
    protected function checkPoint($point)
    {
        if (!($point instanceof Point2D)) {
            throw new LineException('This is not a point');
        }
    }

    protected function countWidth()
    {
        return sqrt(pow($this->from->x - $this->to->x, 2) + pow($this->from->y - $this->to->y, 2));
    }

    public function __construct($from, $to)
    {
        parent::__construct($from, $to);
    }
}
