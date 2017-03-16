<?php

namespace PHPAlgorithms\GraphTools\Traits;

/**
 * Class AllowedPropertiesTrait
 * @package PHPAlgorithms\GraphTools\Traits
 */
trait AllowedPropertiesTrait
{
    /**
     * @var string[] $allowedGet
     */
    protected $allowedGet = array();

    /**
     * @var string[] $allowedSet
     */
    protected $allowedSet = array();

    /**
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public function __call(string $name, array $arguments)
    {
        $variable = lcfirst(substr($name, 3));

        switch (substr($name, 0, 3)) {
            case 'get':
                return $this->__get($variable);
            case 'set':
                call_user_func_array([$this, '__set'], array_merge([$variable], $arguments));
                return $this;
        }


        return trigger_error('Call to undefined method '. static::class . "::{$name}()", E_USER_ERROR);
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get(string $name)
    {
        if ($this->canGet($name)) {
            return $this->{$name};
        }

        return trigger_error("Property {$name} doesn't exists and cannot be get.", E_USER_ERROR);
    }

    /**
     * @param string $name
     * @return boolean
     */
    public function __isset(string $name)
    {
        return property_exists(static::class, $name);
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return mixed
     */
    public function __set(string $name, $value)
    {
        if ($this->canSet($name)) {
            return $this->{$name} = $value;
        }

        return trigger_error("Property {$name} doesn't exists and cannot be set.", E_USER_ERROR);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function __unset(string $name)
    {
        if ($this->canSet($name)) {
            unset($this->{$name});
        }

        return trigger_error("Property {$name} doesn't exists and cannot be unset.", E_USER_ERROR);
    }

    /**
     * @param string $name
     * @return boolean
     */
    public function canGet(string $name) : bool
    {
        return $this->__isset($name) && in_array($name, $this->allowedGet, true);
    }

    /**
     * @param string $name
     * @return boolean
     */
    public function canSet(string $name)
    {
        return $this->__isset($name) && in_array($name, $this->allowedSet, true);
    }
}
