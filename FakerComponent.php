<?php
/**
 * Created by PhpStorm.
 * User: Ehym
 * Date: 22.03.2016
 * Time: 21:39
 */

namespace totalFaker;


class FakerComponent
{
    protected $_attributes = [];
    protected $_customAttributes = [];

    function __get($varName)
    {
        if (array_key_exists($varName, $this->_attributes)) {
            return $this->_attributes[$varName];
        } elseif (array_key_exists($varName, $this->_customAttributes)) {
            return $this->_customAttributes[$varName];
        } elseif (method_exists($this, 'get' . ucfirst($varName))) {
            $callMethod = 'get' . ucfirst($varName);
            return $this->$callMethod();
        } else {
            //TODO add Faker Exception
            throw new \Exception('Try to get wrong attribute "' . $varName . '" from class "' . __CLASS__ . '".');
        }
    }

    function __set($varName, $varValue)
    {
        if (array_key_exists($varName, $this->_attributes)) {
            $this->_attributes[$varName] = $varValue;
        } elseif (method_exists($this, 'set' . ucfirst($varName))) {
            $callMethod = 'set' . ucfirst($varName);
            $this->$callMethod();
        } else {
            $this->_customAttributes[$varName] = $varValue;
        }
    }

    public function attrNamesList()
    {
        return array_keys($this->_attributes);
    }

    public function customAttrNames()
    {
        return array_keys($this->_customAttributes);
    }

}