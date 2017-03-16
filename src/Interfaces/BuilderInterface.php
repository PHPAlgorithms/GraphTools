<?php

namespace PHPAlgorithms\GraphTools\Interfaces;

/**
 * Interface BuilderInterface
 * @package PHPAlgorithms\GraphTools\Interfaces
 */
interface BuilderInterface extends AllowedPropertiesInterface
{
    /**
     * @return BuildableInterface
     */
    public function build();
}
