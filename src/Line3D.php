<?php

namespace PHPAlgorithms\GraphTools;

use PHPAlgorithms\GraphTools\Interfaces\LineInterface;
use PHPAlgorithms\GraphTools\Exceptions\LineException;

class Line3D extends Line2D implements LineInterface {
    protected function checkPoint($point)
    {
        if (!($point instanceof Point3D)) {
            throw new LineException('This is not a point');
        }
    }

    protected function countWidth()
    {
        return sqrt(pow($this->from->x - $this->to->x, 2) + pow($this->from->y - $this->to->y, 2) + pow($this->from->z - $this->to->z, 2));
    }

    public function __construct($from, $to)
    {
        parent::__construct($from, $to);
    }
}
