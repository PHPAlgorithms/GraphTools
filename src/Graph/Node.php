<?php

namespace PHPAlgorithms\GraphTools\Graph;

use JsonSerializable;
use PHPAlgorithms\GraphTools\Abstracts\BuildableAbstract;

/**
 * Class Point
 * @package PHPAlgorithms\GraphTools\Graph
 * @method integer getId()
 * @method float|null getX()
 * @method float|null getY()
 * @method float|null getZ()
 * @property-read integer $id
 * @property-read float|null $x
 * @property-read float|null $y
 * @property-read float|null $z
 */
class Node extends BuildableAbstract implements JsonSerializable
{
    /**
     * @var string[] $allowedGet
     */
    protected $allowedGet = array('id', 'x', 'y', 'z');

    /**
     * @var integer $increment
     */
    private static $increment = 0;

    /**
     * @var integer $id
     */
    protected $id;

    /**
     * @var float|null $x
     */
    protected $x;

    /**
     * @var float|null $y
     */
    protected $y;

    /**
     * @var float|null $z
     */
    protected $z;

    /**
     * Point constructor.
     * @param float|null $x
     * @param float|null $y
     * @param float|null $z
     */
    public function __construct(?float $x = null, ?float $y = null, ?float $z = null)
    {
        $this->id = $this::$increment++;

        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
    }

    /**
     * @return array
     */
    public function jsonSerialize() : array
    {
        $serialize = array();

        foreach ($this->allowedGet as $variable) {
            /**
             * @var string $variable
             */

            if (!is_null($variable)) {
                $serialize[$variable] = $this->{$variable};
            }
        }

        return $serialize;
    }

    /**
     * @param float|null $x
     * @param float|null $y
     * @param float|null $z
     * @return Node
     */
    public function move(float $x = null, float $y = null, float $z = null) : Node
    {
        $this->x += $x;
        $this->y += $y;
        $this->z += $z;

        return $this;
    }
}