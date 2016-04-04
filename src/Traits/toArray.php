<?php

namespace PHPAlgorithms\GraphTools\Traits;

trait toArray {
    public function toArray()
    {
        $properties = array();

        foreach ((new \ReflectionClass($this))->getProperties() as $reflectionProperty) {
            $properties[$reflectionProperty->getName()] = $this->{$reflectionProperty->getName()};
        }

        return $properties;
    }
}
