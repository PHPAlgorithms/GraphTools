<?php

namespace PHPAlgorithms\GraphTools;

use PHPAlgorithms\GraphTools\Interfaces\PointInterface;
use PHPAlgorithms\GraphTools\Traits\MagicGet;
use PHPAlgorithms\GraphTools\Traits\toArray;

class AbstractPoint implements PointInterface {
    use MagicGet, toArray;

    public function __construct()
    {

    }

    public function move()
    {
        
    }

    public function equals($point)
    {
        return $this === $point;
    }

    public function lowerDimension()
    {
        return null;
    }
}
