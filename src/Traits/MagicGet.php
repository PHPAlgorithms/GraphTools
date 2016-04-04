<?php

namespace PHPAlgorithms\GraphTools\Traits;

trait MagicGet {
    public function __get($name)
    {
        if (isset($this->{$name})) {
            return $this->{$name};
        }

        return null;
    }
}
