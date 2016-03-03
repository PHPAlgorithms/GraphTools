<?php
namespace Algorithms\GraphTools;

class ConnectionsContainer
{
    private $connections = array();

    public function __construct($connections = null)
    {
        if (is_array($connections)) {
            foreach ($connections as $connection) {
                $this->add($connection);
            }
        } elseif(!is_null($connections)) {
            throw new ConnectionException('ConnectionsContainer contructor only accept connections array');
        }
    }

    protected function getLastConnection()
    {
        $lastPos = count($this->connections) - 1;
        if ($lastPos == -1) {
            return null;
        } else {
            return $this->connections[$lastPos];
        }
    }

    protected function addToLastConnection(Point $point, $distance)
    {
        $lastConnection = $this->getLastConnection();
        if (is_null($lastConnection)) {
            throw new ConnectionException('Can\'t add to last connection because last connection do not exists');
        }

        return $this->add($this->createNewConnection($lastConnection->from, $point, $distance));
    }

    protected function createNewConnection(Point $from, Point $to, $distance)
    {
        return new Connection($from, $to, $distance);
    }

    public function addConnection(Point $first, $second, $third = null)
    {
        if (!Point::check($second) && is_null($third)) {
            return $this->addToLastConnection($first, $second);
        } else {
            return $this->add($this->createNewConnection($first, $second, $third));
        }
    }

    public function add(Connection $connection)
    {
        $this->connections[] = $connection;

        return $this;
    }

    public function each(\Closure $function)
    {
        foreach ($this->connections as $connection) {
            call_user_func($function, $connection);
        }
    }

    public function get($from)
    {
        $connections = array();

        $this->each(function ($connection) use (&$connections, $from) {
            if ($connection->from
                           ->id == $from) {
                $connections[] = $connection;
            }
        });

        return $connections;
    }

    public function all()
    {
        return $this->connections;
    }
}
