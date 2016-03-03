<?php
namespace Algorithms\GraphTools;

class Connection
{
    private $from;
    private $to;
    private $distance;

    public function __construct(Point $from, Point $to, $distance)
    {
        if (!(filter_var($distance, FILTER_VALIDATE_INT) || is_numeric($distance)) && ($distance > 0)) {
            throw new ConnectionException('Distance must be positive number');
        }

        $this->from = $from;
        $this->to = $to;
        $this->distance = $distance;
    }

    public function __get($name)
    {
        return $this->{$name};
    }
}
