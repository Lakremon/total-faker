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
    use Thing;
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
    ];

    public function __construct($params = [])
    {
        $this->_attributes = array_merge_recursive($this->_attributes, $params);
    }
}