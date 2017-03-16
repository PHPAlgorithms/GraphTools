<?php

namespace PHPAlgorithms\GraphTools\Graph;

use PHPAlgorithms\GraphTools\Abstracts\BuilderAbstract;
use PHPAlgorithms\GraphTools\Graph;

/**
 * Class Builder
 * @package PHPAlgorithms\GraphTools\Graph
 * @method  Connection[] getConnections()
 * @method Node[] getNodes()
 * @property-read Connection[] $connections
 * @property-read Node[] $nodes
 */
class Builder extends BuilderAbstract
{
    private const OPERATION_ADD_CONNECTION = 2;

    private const OPERATION_ADD_NODE = 1;

    private const OPERATION_NO_OPERATION = 0;

    /**
     * @var array $allowedGet
     */
    protected $allowedGet = array('connections', 'nodes');

    /**
     * @var Connection[] $connections
     */
    protected $connections = array();

    /**
     * @var Connection|null $lastConnection
     */
    private $lastConnection = null;

    /**
     * @var integer $lastOperation
     */
    private $lastOperation = self::OPERATION_NO_OPERATION;

    /**
     * @var Node[] $nodes
     */
    protected $nodes = array();

    /**
     * @param Connection $connection
     * @return Builder
     */
    public function addConnection(Connection $connection) : Builder
    {
        try {
            $this->addNode($connection->from);
        } catch (Builder\Exception $exception) {
        }


        try {
            $this->addNode($connection->to);
        } catch (Builder\Exception $exception) {
        }

        $this->connections[] = $connection;

        $this->lastOperation = self::OPERATION_ADD_CONNECTION;

        $this->lastConnection = $connection;

        return $this;
    }

    /**
     * @param Node $node
     * @return Builder
     * @throws Builder\Exception
     */
    public function addNode(Node $node) : Builder
    {
        if (in_array($node, $this->nodes, true)) {
            throw new Builder\Exception('Node was added before');
        }

        $this->nodes[] = $node;

        $this->lastOperation = self::OPERATION_ADD_NODE;

        return $this;
    }

    /**
     * @return Graph
     */
    public function build() : Graph
    {
        return new Graph($this->nodes, $this->connections);
    }

    /**
     * @param Node $from
     * @param Node $to
     * @param float|null $weight
     * @return Builder
     */
    public function connect(Node $from, Node $to, float $weight = null) : Builder
    {
        $this->addConnection(new Connection($from, $to, $weight));

        return $this;
    }

    /**
     * @return Node\Builder
     */
    public function createNode() : Node\Builder
    {
        return new Node\Builder($this);
    }

    /**
     * @return Connection\Builder
     */
    public function createConnection() : Connection\Builder
    {
        return new Connection\Builder($this);
    }

    /**
     * @param integer $index
     * @return Node
     */
    public function getNode(int $index) : Node
    {
        return $this->nodes[$index];
    }

    /**
     * @return Builder
     * @throws Builder\Exception
     */
    public function viceVersa() : Builder
    {
        if (($this->lastOperation !== self::OPERATION_ADD_CONNECTION) || is_null($this->lastConnection)) {
            throw new Builder\Exception('To which connection, hm?');
        }

        $lastConnection = $this->lastConnection;

        $this->addConnection(new Connection($lastConnection->to, $lastConnection->from, $lastConnection->weight));

        $this->lastOperation = self::OPERATION_NO_OPERATION;

        $this->lastConnection = null;

        return $this;
    }
}
