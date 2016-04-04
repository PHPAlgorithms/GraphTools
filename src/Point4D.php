<?php

namespace PHPAlgorithms\GraphTools;

use PHPAlgorithms\GraphTools\Interfaces\PointInterface;
use PHPAlgorithms\GraphTools\Exceptions\PointException;

class Point4D extends Point3D implements PointInterface {
    protected $t;

    protected function checkT($t)
    {
        if (!is_numeric($t)) {
            throw new PointException("t: {$t} must be numeric value");
        }
    }

    public function __construct($x, $y, $z, $t)
    {
        parent::__construct($x, $y, $z);

        $this->checkT($t);

        $this->t = $t;
    }

    public function move($x = 0, $y = 0, $z = 0, $t = 0)
    {
        parent::move($x, $y, $z);

        $this->checkT($t);

        $this->t += $t;

        return $this;
    }

    public function lowerDimension()
    {
        return new Point3D($this->x, $this->y, $this->z);
    }
}
