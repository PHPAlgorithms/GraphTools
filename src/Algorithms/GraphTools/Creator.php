<?php
namespace Algorithms\GraphTools;

class Creator
{
    protected $points = array(),
              $labels = array();

    public function __construct($points = null)
    {
        if (is_array($points)) {
            foreach ($points as $point) {
                $this->add($point);
            }
        } elseif(!is_null($points)) {
            throw new CreatorException('Creator contructor only accept points array');
        }
    }

    protected function pointNotExists($point)
    {
        Point::checkOrFail($point);

        foreach ($this->points as $p) {
            if ($p == $point) {
                return false;
            }
        }

        return true;
    }

    protected function addPoint($point)
    {
        if (!$this->pointNotExists($point)) {
            throw new CreatorException('Point is already stored in Creator object');
        }

        $this->points[] = $point;
    }

    public function add($point)
    {
        if (filter_var($point, FILTER_VALIDATE_INT) && is_numeric($point)) {
            $point = new Point($point);
        } elseif (!Point::check($point)) {
            throw new CreatorException('You can only add points to Creator object');
        }

        $this->addPoint($point);

        return $point;
    }

    public function get($id)
    {
        foreach ($this->points as $point)
        {
            if ($point->id == $id) {
                return $point;
            }
        }

        return null;
    }

    public function getOrFail($id)
    {
        $point = $this->get($id);

        if (!is_null($point)) {
            throw new CreatorException("Point with ID {$id} not found");
        }

        return $point;
    }
}
