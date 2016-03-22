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
    private $_attributes = [];
    private $_customAttributes = [];

    function __get($varName)
    {
        if (array_key_exists($varName, $this->_attributes)) {
            return $this->_attributes[$varName];
        } elseif (method_exists($this, 'get' . $varName)) {

        } elseif (array_key_exists($varName, $this->_customAttributes)) {
            return $this->_customAttributes[$varName];
        }
    }

}