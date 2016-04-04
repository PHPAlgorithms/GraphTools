<?php

namespace PHPAlgorithms\GraphTools;

use PHPAlgorithms\GraphTools\Interfaces\LineInterface;
use PHPAlgorithms\GraphTools\Exceptions\LineException;

class Line1D extends AbstractLine implements LineInterface {
    protected $width;

    protected function checkPoint($point)
    {
        if (!($point instanceof Point1D)) {
            throw new LineException('This is not a point');
        }
    }

    protected function countWidth()
    {
        return abs($this->from->x - $this->to->x);
    }

    public function __construct($from, $to)
    {
        parent::__construct($from, $to);

        $this->width = $this->countWidth();
    }
}
