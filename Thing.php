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
     * @param $name
     * @return mixed
     * @throws AttributeGeneratorNotFoundException
     * @throws WrongAttributeException
     */
    final function __get($name)
    {
        if (array_key_exists($name, $this->_attributes)) {
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
        } elseif (array_key_exists($name, $this->_variables)) {
            return $this->_variables[$name];
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
        if (array_key_exists($name, $this->_attributes)) {
            $this->_attributes[$name] = $value;
        } else {
            $this->_variables[$name] = $value;
        }
    }

    /**
     * @return array
     */
    public function attrNamesList()
    {
        return array_keys($this->_attributes);
    }

    /**
     * @return array
     */
    public function customVarsNames()
    {
        return array_keys($this->_variables);
    }
}