<?php

namespace PHPAlgorithms\GraphTools\Graph\Node;

use PHPAlgorithms\GraphTools\Abstracts\BuilderAbstract;
use PHPAlgorithms\GraphTools\Graph\Builder as GraphBuilder;
use PHPAlgorithms\GraphTools\Graph\Node;

/**
 * Class Builder
 * @package PHPAlgorithms\GraphTools\Graph\Node
 * @method integer|null getX()
 * @method integer|null getY()
 * @method integer|null getZ()
 * @method Builder setX(integer|null $x)
 * @method Builder setY(integer|null $y)
 * @method Builder setZ(integer|null $z)
 * @property integer|null $x
 * @property integer|null $y
 * @property integer|null $z
 */
class Builder extends BuilderAbstract
{
    /**
     * @var string[] $allowedGet
     */
    protected $allowedGet = array('x', 'y', 'z');

    /**
     * @var string[] $allowedSet
     */
    protected $allowedSet = array('x', 'y', 'z');

    /**
     * @var GraphBuilder|null $builder
     */
    private $builder;

    /**
     * @var integer $x
     */
    protected $x;

    /**
     * @var integer $y
     */
    protected $y;

    /**
     * @var integer $z
     */
    protected $z;

    /**
     * Builder constructor.
     * @param GraphBuilder|null $builder
     */
    public function __construct(?GraphBuilder $builder = null)
    {
        $this->builder = $builder;
    }

    /**
     * @return Node|GraphBuilder
     */
    public function build()
    {
        $node = new Node($this->x, $this->y, $this->z);

        if (empty($this->builder)) {
            return $node;
        }

        return $this->builder->addNode($node);
    }
}
