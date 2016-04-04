<?php

namespace PHPAlgorithms\GraphTools\Interfaces;

interface LineInterface {
    public function __construct($from, $to);

    public function __get($name);

    public function toArray();
}
