<?php

namespace TotalFaker\Entities;

use TotalFaker\Exceptions\WrongAttributeException;
use TotalFaker\Exceptions\AttributeGeneratorNotFoundException;

/**
 * Trait Thing
 * @package TotalFaker\Entities
 */
trait Thing
{
    protected $variables = [];
    protected $world = null;

    public function __construct($params = [], World $world = null)
    {
        foreach ($this->attributes as $attrName => $attrValue) {
            if (key_exists($attrName, $params)) {
                $this->attributes[$attrName] = $params[$attrName];
            }
        }
        $this->world = $world;
    }

    /**
     * @param $name
     * @return mixed
     * @throws AttributeGeneratorNotFoundException
     * @throws WrongAttributeException
     */
    final function __get($name)
    {
        if (array_key_exists($name, $this->attributes)) {
            if (is_null($this->attributes[$name])) {
                $methodName = 'get' . ucfirst($name);
                if (method_exists($this, $methodName)) {
                    $this->attributes[$name] = $this->$methodName();
                } else {
                    throw new AttributeGeneratorNotFoundException();
                }
            }
            return $this->attributes[$name];
        } elseif (array_key_exists($name, $this->variables)) {
            return $this->variables[$name];
        } else {
            throw new WrongAttributeException();
        }
    }

    /**
     * @param $name
     * @param $value
     */
    final function __set($name, $value)
    {
        if (array_key_exists($name, $this->attributes)) {
            $this->attributes[$name] = $value;
        } else {
            $this->variables[$name] = $value;
        }
    }

    /**
     * @return array
     */
    public function attrNamesList()
    {
        return array_keys($this->attributes);
    }

    /**
     * @return array
     */
    public function varsNamesList()
    {
        return array_keys($this->variables);
    }
}