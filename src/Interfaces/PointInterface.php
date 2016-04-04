<?php

namespace PHPAlgorithms\GraphTools\Interfaces;

interface PointInterface {
    public function __get($name);

    public function move();

    public function equals($point);

    public function lowerDimension();
}
