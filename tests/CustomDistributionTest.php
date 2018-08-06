<?php

namespace TotalFakerTests;


use PHPUnit\Framework\TestCase;
use TotalFaker\Distributions\CustomDistribution;

class CustomDistributionTest extends TestCase
{

    public function testRandomNumberFunction(): void
    {
        $lastNameMap = unserialize(file_get_contents(dirname(__FILE__) . '/../l10n/en-US/last-name-map.arr'));
        $values = [];
        for ($i = 0; $i < 10000; $i++) {
            $lastName = CustomDistribution::getOne($lastNameMap);
            if (!key_exists($lastName, $values)) {
                $values[$lastName] = 0;
            }
            $values[$lastName]++;
        }
        arsort($values);

        $this->assertEquals(10000, array_sum($values));
        foreach ($values as $key => $value) {
            echo "{$key} => {$value}\r\n";
        }
        echo "\r\n";
    }
}