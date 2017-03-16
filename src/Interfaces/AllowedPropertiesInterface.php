<?php

namespace PHPAlgorithms\GraphTools\Interfaces;

/**
 * Interface AllowedPropertiesInterface
 * @package PHPAlgorithms\GraphTools\Interfaces
 */
interface AllowedPropertiesInterface
{
    /**
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public function __call(string $name, array $arguments);

    /**
     * @param string $name
     * @return mixed
     */
    public function __get(string $name);

    /**
     * @param string $name
     * @param mixed $value
     * @return mixed
     */
    public function __set(string $name, $value);
}