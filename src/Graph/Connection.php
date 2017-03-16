<?php

namespace PHPAlgorithms\GraphTools\Graph;

use JsonSerializable;
use PHPAlgorithms\GraphTools\Abstracts\BuildableAbstract;

/**
 * Class Connection
 * @package PHPAlgorithms\GraphTools\Graph
 * @method Node getFrom()
 * @method Node getTo()
 * @method float|null getWeight()
 * @property-read Node $from
 * @property-read Node $to
 * @property-read float|null $weight
 */
class Connection extends BuildableAbstract implements JsonSerializable
{
    /**
     * @var string[] $allowedGet
     */
    protected $allowedGet = array('from', 'to', 'weight');

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
     * Connection constructor.
     * @param Node $from
     * @param Node $to
     * @param float|null $weight
     */
    public function __construct(Node $from, Node $to, float $weight = null)
    {
        $this->from = $from;

        $this->to = $to;

        $this->weight = $weight;
    }

    /**
     * @return array
     */
    public function jsonSerialize() : array
    {
        $serialize = array();

        foreach ($this->allowedGet as $variable) {
            /**
             * @var string $variable
             */

            if (!is_null($variable)) {
                $serialize[$variable] = $this->{$variable};
            }
        }

        return $serialize;
    }
}