<?php
namespace Algorithms\GraphTools;

class Point
{
    private $_id;
    private $distances = array();
    private $label = null;
    private $x;
    private $y;

    public function __construct($pointId, $label = null)
    {
        if (filter_var($pointId, FILTER_VALIDATE_INT) !== false) {
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
        if (filter_var($point, FILTER_VALIDATE_INT) !== false) {
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

    public function setX($x)
    {
        $this->x = intval($x);
        return $this;
    }

    public function setY($y)
    {
        $this->y = intval($y);
        return $this;
    }

    public function getX()
    {
        return $this->x;
    }

    public function getY()
    {
        return $this->y;
    }

    public function toArray()
    {
        $array = array(
            'id' => $this->_id
        );

        if (!empty($this->label)) {
            $array['label'] = $this->label;
        }

        if (!empty($this->x)) {
            $array['x'] = $this->x;
        }

        if (!empty($this->y)) {
            $array['y'] = $this->y;
        }

        return $array;
    }
}
