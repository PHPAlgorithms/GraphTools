<?php

namespace PHPAlgorithms\GraphTools\Abstracts;

use PHPAlgorithms\GraphTools\Interfaces\BuildableInterface;
use PHPAlgorithms\GraphTools\Traits\AllowedPropertiesTrait;

/**
 * Class BuildableAbstract
 * @package PHPAlgorithms\GraphTools\Abstracts
 */
abstract class BuildableAbstract implements BuildableInterface
{
    use AllowedPropertiesTrait;
}
