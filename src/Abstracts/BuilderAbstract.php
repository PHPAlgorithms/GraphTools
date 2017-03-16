<?php

namespace PHPAlgorithms\GraphTools\Abstracts;

use PHPAlgorithms\GraphTools\Interfaces\BuilderInterface;
use PHPAlgorithms\GraphTools\Traits\AllowedPropertiesTrait;

/**
 * Class BuilderAbstract
 * @package PHPAlgorithms\GraphTools\Abstracts
 */
abstract class BuilderAbstract implements BuilderInterface
{
    use AllowedPropertiesTrait;
}
