<?php

namespace PHPAlgorithms\GraphTools;

use PHPAlgorithms\GraphTools\Interfaces\LineInterface;
use PHPAlgorithms\GraphTools\Exceptions\LineException;
use PHPAlgorithms\GraphTools\Traits\MagicGet;
use PHPAlgorithms\GraphTools\Traits\toArray;

class AbstractLine implements LineInterface {
    use MagicGet, toArray;

    protected $from, $to;

    protected function checkPoints($from, $to)
    {
        if ($from->equals($to)) {
            throw new LineException('You can not build the line from the same point');
        }
    }

    protected function checkPoint($point)
    {
        if (!($point instanceof AbstractPoint)) {
            throw new LineException('This is not a point');
        }
    }

    protected function setFrom($from)
    {
        $this->checkPoint($from);
        $this->from = $from;
    }

    protected function setTo($to)
    {
        $this->checkPoint($to);
        $this->to = $to;
    }

    public function __construct($from, $to)
    {
        $this->setFrom($from);

        $this->setTo($to);

        $this->checkPoints($from, $to);
    }
}
