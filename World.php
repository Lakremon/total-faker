<?php
namespace totalFaker;

class World extends FakerComponent
{
    use Thing;

    protected $_attributes = [
            'skyColor' => null,
            'persons' => [],
            'companies' => [],
            'cars' => [],
            'cities' => [],
    ];
    private $_skyColor;


    function __construct()
    {
        $this->_attributes['skyColor'] = [
                rand(0, 255),
                rand(0, 255),
                rand(0, 255),
        ];
    }

    function generatePerson($params=[])
    {
        if(!is_array($params)){
            //TODO add params is not array exception
            throw new \Exception();
        }

        $person = New Person($params);


    }

    function findAnyPerson()
    {

    }
}