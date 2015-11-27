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

    private function pointNotExists($pointId)
    {
        if (isset($this->points[$pointId])) {
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

    private function createPointFromID($pointId, $label = null)
    {
        if ($this->pointNotExists($pointId) && $this->labelNotExists($label)) {
            if (empty($label)) {
                $newPoint = Point::create($pointId);
            } else {
                $this->labels[$label] = $pointId;
                $newPoint = Point::create($pointId, $label);
            }

            $this->points[$pointId] = $newPoint;

            return $newPoint;
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

    public function getPoint($pointId)
    {
        try {
            return $this->getPointOrFail($pointId);
        } catch (PointException $e) {
            return null;
        }
    }

    public function getPointOrFail($pointId)
    {
        if (isset($this->points[$pointId])) {
            return $this->points[$pointId];
        } elseif (isset($this->labels[$pointId])) {
            return $this->points[$this->labels[$pointId]];
        } else {
            throw new PointException('Point not exists');
        }
    }

    public function createConnections()
    {
        $relations = array();

        foreach ($this->points as $pointId => $point) {
            $relations[$pointId] = $point->getDinstances();

            foreach ($relations[$pointId] as $arrayToAnalyze) {
                if (!isset($relations[$arrayToAnalyze[0]])) {
                    $relations[$arrayToAnalyze[0]] = array();
                }
            }
        }

        return $relations;
    }
}
