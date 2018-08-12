<?php

namespace TotalFaker\Entities;

use TotalFaker\Distributions\CustomDistribution;

/**
 * Class Person
 * @package TotalFaker\Entities
 *
 * @property string $firstName
 * @property string $soName
 * @property string $lastName
 * @property string $patronymic
 * @property int $age
 * @property string $bethDate
 * @property string $gender
 * @property string $characterStructure
 * @property string $eysColor
 * @property string $hairColor
 * @property string $language
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
     * @return string
     */
    protected function getFirstName()
    {
        $mapArray = $this->gender == 'male' ? self::getMaleNamesMap() : self::getFemaleNamesMap();
        return CustomDistribution::getOne($mapArray);
    }

    /**
     * @return string
     */
    protected function getLastName()
    {
        return CustomDistribution::getOne(self::getLastNamesMap());
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

    private static function getMaleNamesMap()
    {
        if (empty(self::$maleNamesMap)) {
            $fileName = dirname(__FILE__) . '/../../l10n/en-US/male-first-name-map.arr';
            $fileContent = file_get_contents($fileName);
            self::$maleNamesMap = unserialize($fileContent);
        }
        return self::$maleNamesMap;
    }

    private static function getFemaleNamesMap()
    {
        if (empty(self::$femaleNamesMap)) {
            $fileName = dirname(__FILE__) . '/../../l10n/en-US/female-first-name-map.arr';
            $fileContent = file_get_contents($fileName);
            self::$femaleNamesMap = unserialize($fileContent);
        }
        return self::$femaleNamesMap;
    }

    private static function getLastNamesMap()
    {
        if (empty(self::$lastNamesMap)) {
            $fileName = dirname(__FILE__) . '/../../l10n/en-US/last-name-map.arr';
            self::$lastNamesMap = unserialize(file_get_contents($fileName));
        }
        return self::$lastNamesMap;
    }
}