<?php

namespace TotalFakerTests;

use PHPUnit\Framework\TestCase;
use TotalFaker\Distributions\NormalDistribution;

class NormalDistributionTest extends TestCase
{

    public function testRandomNumberFunction(): void
    {
        $normalDistribution = new NormalDistribution();
        $values = [];
        for ($i = 0; $i < 10000; $i++) {
            $number = $normalDistribution->getRandomNumber();
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

    public function testRandomNumberFunctionFull(): void
    {
        $normalDistribution = new NormalDistribution(0, 1, false);
        $values = [];
        for ($i = 0; $i < 10000; $i++) {
            $number = $normalDistribution->getRandomNumber();
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

    public function testGetOneFunction()
    {
        $valuesPull = ['one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
        $values = array_fill_keys($valuesPull, 0);
        for ($i = 0; $i < 10000; $i++) {
            $values[NormalDistribution::getOne($valuesPull)]++;
        }
        $this->assertEquals(10000, array_sum($values));
        foreach ($values as $key => $value) {
            echo "{$key} => {$value}\r\n";
        }
        echo "\r\n";
    }

    public function testGetOneFunctionFull()
    {
        $valuesPull = ['one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
        $values = array_fill_keys($valuesPull, 0);
        for ($i = 0; $i < 10000; $i++) {
            $values[NormalDistribution::getOne($valuesPull, false)]++;
        }
        $this->assertEquals(10000, array_sum($values));
        foreach ($values as $key => $value) {
            echo "{$key} => {$value}\r\n";
        }
        echo "\r\n";
    }

}