<?php

namespace PHPAlgorithms\GraphTools\Graph\Connection;

use PHPAlgorithms\GraphTools\Abstracts\BuilderAbstract;
use PHPAlgorithms\GraphTools\Graph\Builder as GraphBuilder;
use PHPAlgorithms\GraphTools\Graph\Connection;
use PHPAlgorithms\GraphTools\Graph\Node;

/**
 * Class Builder
 * @package PHPAlgorithms\GraphTools\Graph\Connection
 * @method Node|null getFrom()
 * @method Node|null getTo()
 * @method float|null getWeight()
 * @method Builder setFrom(Node|null $from)
 * @method Builder setTo(Node|null $to)
 * @method Builder setWeight(float|null $weight)
 * @property Node|null $from
 * @property Node|null $to
 * @property float|null $weight
 */
class Builder extends BuilderAbstract
{
    /**
     * @var string[] $allowedGet
     */
    protected $allowedGet = array('from', 'to', 'weight');

    /**
     * @var string[] $allowedSet
     */
    protected $allowedSet = array('from', 'to', 'weight');

    /**
     * @var GraphBuilder|null $builder
     */
    private $builder;

    /**
     * @var Node $from
     */
    protected $from;

    /**
     * @var Node $to
     */
    protected $to;

    /**
     * @var float|null $weight
     */
    protected $weight;

    /**
     * Builder constructor.
     * @param GraphBuilder|null $builder
     */
    public function __construct(?GraphBuilder $builder = null)
    {
        $this->builder = $builder;
    }

    /**
     * @return Connection|GraphBuilder
     */
    public function build()
    {
        $connection = new Connection($this->from, $this->to, $this->weight);

        if (empty($this->builder)) {
            return $connection;
        }

        return $this->builder->addConnection($connection);
    }
}
