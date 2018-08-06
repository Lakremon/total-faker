<?php

namespace TotalFakerTests;


use PHPUnit\Framework\TestCase;
use TotalFaker\Distributions\PoissonDistribution;

class PoissonDistributionTest extends TestCase
{
    public function testRandomNumberFunction(): void
    {
        $poissonDistribution = new PoissonDistribution(1);
        $values = [];
        for ($i = 0; $i < 10000; $i++) {
            $number = $poissonDistribution->getRandomNumber();
            $key = intval(round($number));
            if (!key_exists($key, $values)) {
                $values[$key] = 0;
            }
            $values[$key]++;
        }
        ksort($values);

        $this->assertEquals(10000, array_sum($values));
        foreach ($values as $key => $value) {
            echo "{$key} => {$value}\r\n";
        }
        echo "\r\n";
    }

}