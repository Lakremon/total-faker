<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 12.07.2016
 * Time: 22:11
 */

namespace totalFaker;

use totalFaker\Exceptions\WrongAttributeException;
use totalFaker\Exceptions\AttributeGeneratorNotFoundException;

trait Thing
{
    protected $_attributes = [];
    protected $_variables = [];

    /**
     * @param $name - name of attribute or
     */
    final function __get($name)
    {
        if (key_exists($name, $this->_attributes)) {
            if (is_null($this->_attributes[$name])) {
                $methodName = 'get' . ucfirst($name);
                if (method_exists($this, $methodName)) {
                    return $this->$methodName();
                } else {
                    throw new AttributeGeneratorNotFoundException();
                }
            } else {
                return $this->_attributes[$name];
            }
        } elseif (key_exists($name, $this->_variables)) {
            return $this->_variables[$name];
        } else {
            throw new WrongAttributeException();
        }
    }

    final function __set($name, $value)
    {
        if (key_exists($name, $this->_attributes)) {
            $this->_attributes[$name] = $value;
        } else {
            $this->_variables[$name] = $value;
        }
    }
}