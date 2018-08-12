<?php
/**
 * Created by PhpStorm.
 * User: lakremon
 * Date: 8/11/18
 * Time: 10:18 PM
 */

namespace TotalFakerTests;


use PHPUnit\Framework\TestCase;
use TotalFaker\Distributions\ExponentialDistribution;

class ExponentialDistributionTest extends TestCase
{

    public function testRandomNumberFunction(): void
    {
        $normalDistribution = new ExponentialDistribution();
        $values = [];
        for ($i = 0; $i < 10000; $i++) {
            $number = $normalDistribution->getRandomNumber();
            $key = intval(floor($number * 10));
            if (!key_exists($key, $values)) {
                $values[$key] = 0;
            }
            $values[$key]++;
        }
        ksort($values);

        $this->assertEquals(10000, array_sum($values));
        foreach ($values as $key => $value) {
            $name = number_format($key / 10, 1);
            echo "{$name} => {$value}\r\n";
        }
        echo "\r\n";
    }
}