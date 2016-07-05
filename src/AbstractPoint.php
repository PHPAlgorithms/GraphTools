<?php

/**
 * @author ventaquil <ventaquil@outlook.com>
 * @licence MIT
 */

namespace PHPAlgorithms\GraphTools;

use PHPAlgorithms\GraphTools\Interfaces\PointInterface;
use PHPAlgorithms\GraphTools\Traits\MagicGet;
use PHPAlgorithms\GraphTools\Traits\toArray;

/**
 * Class AbstractPoint
 * @package PHPAlgorithms\GraphTools
 */
class AbstractPoint implements PointInterface {
    use MagicGet, toArray;

    /**
     * Do nothing. For higher dimensions.
     */
    public function move() { }

    /**
     * Method checks if sent variable is instance of the same object.
     *
     * @param mixed $point Variable to check.
     * @return boolean True if sent variable is the same object or false otherwise.
     */
    public function equals($point)
    {
        return $this === $point;
    }

    /**
     * Method returns lower dimension point.
     *
     * @return null Returns null.
     */
    public function lowerDimension()
    {
        return null;
    }
}
