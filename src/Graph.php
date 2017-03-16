<?php

namespace PHPAlgorithms\GraphTools;

use PHPAlgorithms\GraphTools\Abstracts\BuildableAbstract;
use PHPAlgorithms\GraphTools\Graph\Connection;
use PHPAlgorithms\GraphTools\Graph\Node;

/**
 * Class Graph
 * @package PHPAlgorithms\GraphTools
 * @method Node[] getNodes()
 * @property-read Node[] $nodes
 */
class Graph extends BuildableAbstract
{
    /**
     * @var string[] $allowedGet
     */
    protected $allowedGet = array('nodes');

    /**
     * @var Connection[] $connections
     */
    protected $connections;

    /**
     * @var Node[] $nodes
     */
    protected $nodes;

    /**
     * Graph constructor.
     * @param Node[] $nodes
     * @param Connection[] $connections
     */
    public function __construct(array $nodes, array $connections)
    {
        foreach ($nodes as $node) {
            $this->addNode($node);
        }

        foreach ($connections as $connection) {
            $this->addConnection($connection);
        }
    }

    /**
     * @param Connection $connection
     * @return Graph
     */
    protected function addConnection(Connection $connection) : Graph
    {
        $this->addNode($connection->from)->addNode($connection->to);

        if (!isset($this->connections[$connection->from->id][$connection->to->id])) {
            $this->connections[$connection->from->id][$connection->to->id] = array();
        }

        $this->connections[$connection->from->id][$connection->to->id][] = $connection;

        return $this;
    }

    /**
     * @param Node $node
     * @return Graph
     */
    protected function addNode(Node $node) : Graph
    {
        if (!isset($this->nodes[$node->id])) {
            $this->nodes[$node->id] = $node;
        }

        return $this;
    }

    /**
     * @param Node $from
     * @param Node $to
     * @return Connection[]
     */
    public function getConnections(Node $from, Node $to) : array
    {
        if (isset($this->connections[$from->id][$to->id])) {
            return $this->connections[$from->id][$to->id];
        }

        return array();
    }

    /**
     * @param Node $from
     * @param Node $to
     * @return (float|null)[]
     */
    public function getDistances(Node $from, Node $to) : array
    {
        $distances = array();

        foreach ($this->getConnections($from, $to) as $connection) {
            /**
             * @var Connection $connection
             */

            $distances[] = $connection->getWeight();
        }

        return $distances;
    }

    /**
     * @param Node $from
     * @param Node $to
     * @return null|Connection
     */
    public function getNearestConnection(Node $from, Node $to) : ?Connection
    {
        /**
         * @var null|Connection $nearest
         */
        $nearest = null;

        foreach ($this->getConnections($from, $to) as $connection) {
            /**
             * @var Connection $connection
             */

            if (is_null($nearest) || ($nearest->getWeight() > $connection->getWeight())) {
                $nearest = $connection;
            }
        }

        return $nearest;
    }

    /**
     * @param Node $from
     * @param Node $to
     * @return null|float
     */
    public function getNearestDistance(Node $from, Node $to) : ?float
    {
        $nearest = $this->getNearestConnection($from, $to);

        if (is_null($nearest)) {
            return null;
        }

        return $nearest->getWeight();
    }

    /**
     * @param Node $node
     * @return Node[]
     */
    public function getNeighbour(Node $node) : array
    {
        $neighbour = array();

        if (isset($this->connections[$node->id])) {
            $ids = array_keys($this->connections[$node->id]);

            foreach ($this->nodes as $node) {
                if (in_array($node->id, $ids)) {
                    $neighbour[] = $node;
                }
            }
        }

        return $neighbour;
    }
}
