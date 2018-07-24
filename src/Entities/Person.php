<?php
/**
 * Created by PhpStorm.
 * User: pspirin
 * Date: 7/26/2016
 * Time: 1:17 PM
 */

namespace totalFaker;


class Person
{
    use Thing {
        Thing::__construct as private __thConstruct;
    }

    protected $_attributes = [
            'firstName' => null,
            'soName' => null,
            'lastName' => null,
            'patronymic' => null,
            'age' => null,
            'bethDate' => null,
            'gender' => null,
            'characterStructure' => null,
            'eysColor' => null,
            'hairColor' => null,
            'language' => null,
    ];

    public function __construct($params = [], $world = null)
    {
        $this->_attributes = array_merge_recursive($this->_attributes, $params);
        $this->__thConstruct($params, $world);
    }

    public function getFirstName(){

    }

    public function getLanguage({
        
    })
}