<?php

namespace TotalFaker\Entities;

use TotalFaker\Distributions\CustomDistribution;

/**
 * Class Person
 * @package TotalFaker\Entities
 *
 * @property int $firstName
 * @property int $soName
 * @property int $lastName
 * @property int $patronymic
 * @property int $age
 * @property int $bethDate
 * @property int $gender
 * @property int $characterStructure
 * @property int $eysColor
 * @property int $hairColor
 * @property int $language
 */
class Person
{
    use Thing {
        Thing::__construct as private __thConstruct;
    }

    private static $maleNamesMap = [];
    private static $femaleNamesMap = [];
    private static $lastNamesMap = [];

    protected $attributes = [
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

    /**
     * Person constructor.
     * @param array $params
     * @param World|null $world
     */
    public function __construct($params = [], $world = null)
    {
        $this->__thConstruct($params, $world);
    }

    /**
     *
     */
    public function getFirstName()
    {

    }

    /**
     */
    public function getLanguage()
    {

    }

    public function getGender()
    {
        return CustomDistribution::getOne([
            'male' => 1014,
            'female' => 1000,
        ]);
    }
}