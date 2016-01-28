<?php
namespace Algorithms\GraphTools;

class Connection
{
    private $from;
    private $to;
    private $distance;

    public function __construct($from, $to, $distance)
    {
        if (self::isPoint($from) && self::isPoint($to)) {
            $this->from = $from;
            $this->to = $to;
        } else {
            throw new ConnectionException('Sent data are not points');
        }

        $distance = intval($distance);
        if ($distance > 0) {
            $this->distance = $distance;
        } else {
            throw new ConnectionException('Distance is less than or equal to zero');
        }
    }

    private static function isPoint($element)
    {
        return ($element instanceof Point) || (filter_var($element, FILTER_VALIDATE_INT) !== false);
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function getTo()
    {
        return $this->to;
    }

    public function getDistance()
    {
        return $this->distance;
    }
}
