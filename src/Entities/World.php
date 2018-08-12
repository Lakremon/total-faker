<?php

namespace TotalFaker\Entities;

use TotalFaker\Helpers\Randomizer;

class World
{
    use Thing;

    protected $attributes = [
        'skyColor' => null,
        'persons' => [],
        'companies' => [],
        'cars' => [],
        'cities' => [],
    ];
    private $persons;

    function __construct()
    {
        $this->attributes['skyColor'] = [
            Randomizer::getRandomInt(0, 255),
            Randomizer::getRandomInt(0, 255),
            Randomizer::getRandomInt(0, 255),
        ];
    }

    function getNewPerson(array $params = []): Person
    {
        $this->persons[] = new Person($params, $this);
        return end($this->persons);
    }

    function getAnyPerson(): Person
    {
        if (empty($this->persons)) {
            return $this->getNewPerson();
        }
        return $this->persons[Randomizer::getRandomInt(0, count($this->persons) - 1)];
    }
}