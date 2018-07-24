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
    private $_persons;


    function __construct()
    {
        $this->_attributes['skyColor'] = [
                rand(0, 255),
                rand(0, 255),
                rand(0, 255),
        ];
    }

    function generatePerson($params = [], $isNewPerson = true)
    {
        if (!is_array($params)) {
            //TODO add params is not array exception
            throw new \Exception();
        }
        if ($isNewPerson) {
            $person = New Person($params, $this);
            $this->_persons[] = $person;
        } else {
            $person = $this - $this->_persons[rand(0, count($this->_persons) + 1)];
        }
        return $person;
    }

    function findAnyPerson()
    {

    }
}