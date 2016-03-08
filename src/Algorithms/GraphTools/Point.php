<?php
namespace Algorithms\GraphTools;

class Point
{
    protected $id,
              $x,
              $y,
              $label = null;

    public function __construct($id, $label = null)
    {
        if (!(filter_var($id, FILTER_VALIDATE_INT) || is_numeric($id))) {
            throw new PointException('ID is must be a number');
        }

        $this->id = $id;
        $this->label = $label;
    }

    public static function create($id, $label = null)
    {
        return new self($id, $label);
    }

    public static function check($point)
    {
        return ($point instanceof self);
    }

    public static function checkOrFail($point)
    {
        if (!Point::check($point)) {
            throw new PointException('Sent object is not a Point');
        }

        return true;
    }

    public function __get($name)
    {
        return $this->{$name};
    }

    public function __set($name, $value)
    {
        if (in_array($name, array('x', 'y'))) {
            if (!(filter_var($value, FILTER_VALIDATE_INT) || is_numeric($value))) {
                throw new PointException("Parameter {$value} must be a number");
            }

            $this->{$name} = $value;
        } elseif ($name == 'id') {
            throw new PointException('You can\'t change point ID');
        } else {
            $this->{$name} = $value;
        }
    }

    public function toArray()
    {
        $point = array(
            'id' => $this->id,
        );

        foreach (array('label', 'x', 'y') as $name) {
            if (!is_null($this->{$name})) {
                $point[$name] = $this->{$name};
            }
        }

        return $point;
    }

    public function addConnection(Point $point, $distance)
    {
        return new ConnectionsContainer(
            array(
                new Connection($this, $point, $distance),
            )
        );
    }
}
