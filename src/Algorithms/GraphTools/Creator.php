<?php
namespace Algorithms\GraphTools;

class Creator
{
    private $points = array();
    private $labels = array();

    private static function checkPointID($point)
    {
        return (is_int($point) && ($point > 0)) ? 'int' : 'string';
    }

    private function randNewID()
    {
        do {
            $rand = mt_rand();
        } while (isset($this->points[$rand]));

        return $rand;
    }

    private function pointNotExists($point_id)
    {
        if (isset($this->points[$point_id])) {
            throw new CreatorException('Point was added earlier');
        }

        return true;
    }

    private function labelNotExists($label)
    {
        if (($label != null) && (isset($this->labels[$label]))) {
            throw new CreatorException('Label exists! Must be unique');
        }

        return true;
    }

    private function createPointFromID($point_id, $label = null)
    {
        if ($this->pointNotExists($point_id) && $this->labelNotExists($label)) {
            if (empty($label)) {
                $new_point = Point::create($point_id);
            } else {
                $this->labels[$label] = $point_id;
                $new_point = Point::create($point_id, $label);
            }

            $this->points[$point_id] = $new_point;

            return $new_point;
        }
    }

    public function addPoint($point)
    {
        if (Point::checkPoint($point)) {
            return $this->addPointObject($point);
        } elseif (self::checkPointID($point) == 'int') {
            return self::createPointFromID($point);
        } else {
            return self::createPointFromID($this->randNewID(), $point);
        }
    }

    private function addPointObject($object)
    {
        $this->createPointFromID($object->getID(), $object->getLabel());

        return $object;
    }

    public function getPoint($point_id)
    {
        try {
            return $this->getPointOrFail($point_id);
        } catch (PointException $e) {
            return null;
        }
    }

    public function getPointOrFail($point_id)
    {
        if (isset($this->points[$point_id])) {
            return $this->points[$point_id];
        } elseif (isset($this->labels[$point_id])) {
            return $this->points[$this->labels[$point_id]];
        } else {
            throw new PointException('Point not exists');
        }
    }

    public function createConnections()
    {
        $relations = array();

        foreach ($this->points as $point_id => $point) {
            $relations[$point_id] = $point->getDinstances();

            foreach ($relations[$point_id] as $array_to_analyze) {
                if (!isset($relations[$array_to_analyze[0]])) {
                    $relations[$array_to_analyze[0]] = array();
                }
            }
        }

        return $relations;
    }
}
