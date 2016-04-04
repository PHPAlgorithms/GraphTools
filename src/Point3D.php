<?php

namespace PHPAlgorithms\GraphTools;

use PHPAlgorithms\GraphTools\Interfaces\PointInterface;
use PHPAlgorithms\GraphTools\Exceptions\PointException;

class Point3D extends Point2D implements PointInterface {
    protected $z;

    protected function checkZ($z)
    {
        if (!is_numeric($z)) {
            throw new PointException("z: {$z} must be numeric value");
        }
    }

    public function __construct($x, $y, $z)
    {
        parent::__construct($x, $y);

        $this->checkZ($z);

        $this->z = $z;
    }

    public function move($x = 0, $y = 0, $z = 0)
    {
        parent::move($x, $y);

        $this->checkZ($z);

        $this->z += $z;

        return $this;
    }

    public function lowerDimension()
    {
        return new Point2D($this->x, $this->y);
    }
}
