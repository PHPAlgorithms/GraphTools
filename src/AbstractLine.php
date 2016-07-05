<?php

/**
 * @author ventaquil <ventaquil@outlook.com>
 * @licence MIT
 */

namespace PHPAlgorithms\GraphTools;

use PHPAlgorithms\GraphTools\Interfaces\LineInterface;
use PHPAlgorithms\GraphTools\Exceptions\LineException;
use PHPAlgorithms\GraphTools\Traits\MagicGet;
use PHPAlgorithms\GraphTools\Traits\toArray;

/**
 * Class AbstractLine
 * @package PHPAlgorithms\GraphTools
 * @property-read Point $from
 * @property-read Point $to
 */
class AbstractLine implements LineInterface {
    use MagicGet, toArray;

    /**
     * @var Point $from First end of the line.
     * @var Point $to Second end of the line.
     */
    protected $from, $to;

    /**
     * Method checks send arguments and throws exception if it is the same point.
     *
     * @param mixed $from First variable to check.
     * @param mixed $to Second variable to check.
     * @throws LineException When $from and $to is the same object.
     */
    protected function checkPoints($from, $to)
    {
        if ($from->equals($to)) {
            throw new LineException('You can not build the line from the same point');
        }
    }

    /**
     * Method checks sent variable and throws LineException if it is not an AbstractPoint instance.
     *
     * @param mixed $point Variable to check.
     * @throws LineException If sent argument is not an AbstractPoint instance.
     */
    protected function checkPoint($point)
    {
        if (!($point instanceof AbstractPoint)) {
            throw new LineException('This is not a point');
        }
    }

    /**
     * Set first end of the line.
     *
     * @param AstractPoint $from First end of the line.
     */
    protected function setFrom($from)
    {
        $this->checkPoint($from);
        $this->from = $from;
    }

    /**
     * Set second end of the line.
     *
     * @param AstractPoint $to Second end of the line.
     */
    protected function setTo($to)
    {
        $this->checkPoint($to);
        $this->to = $to;
    }

    /**
     * Abstract Line constructor.
     *
     * @param AbstractPoint $from First end of the line.
     * @param AbstractPoint $to Second end of the line.
     */
    public function __construct($from, $to)
    {
        $this->setFrom($from);

        $this->setTo($to);

        $this->checkPoints($from, $to);
    }
}
