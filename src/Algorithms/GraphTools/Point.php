<?php
namespace Algorithms\GraphTools;

class Point
{
    private $_id;
    private $distances = array();
    private $label = null;

    public function __construct($pointId, $label = null)
    {
        if (is_int($pointId)) {
            $this->_id = $pointId;
            $this->label = $label;
        } else {
            throw new PointException('Wrong data sent');
        }
    }

    public static function create($pointId, $label = null)
    {
        return new self($pointId, $label);
    }

    public static function checkPoint($point)
    {
        return ($point instanceof self);
    }

    public static function validate($point)
    {
        if (is_int($point)) {
            return $point;
        } elseif (self::checkPoint($point)) {
            return $point->getID();
        } else {
            throw new PointException('Wrong data sent');
        }
    }

    public function addRelation($point, $distance)
    {
        $point = $this::validate($point);

        $this->distances[$point] = $distance;

        return $this;
    }

    public function getDinstances()
    {
        $distances = array();

        foreach ($this->distances as $pointId => $distance) {
            $distances[] = [$pointId, $distance];
        }

        return $distances;
    }

    public function distanceTo($point)
    {
        $point = $this::validate($point);

        return (isset($this->distances[$point])) ? $this->distances[$point] : false;
    }

    public function getID()
    {
        return $this->_id;
    }

    public function getLabel()
    {
        return $this->label;
    }
}
