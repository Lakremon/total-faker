<?php

namespace TotalFakerTests;

use function PHPSTORM_META\type;
use PHPUnit\Framework\TestCase;
use TotalFaker\Helpers\Randomizer;

class RandomizerTest extends TestCase
{
    public function testCheckRandomZeroOneFunction(): void
    {
        for ($i = 0; $i < 1000; $i++) {
            $number = Randomizer::getRandomZeroOne();
            $this->assertTrue(1 >= $number);
            $this->assertTrue(0 <= $number);
        }
    }

    public function testCheckRandomIntFunction(): void
    {
        for ($i = 0; $i < 1000; $i++) {
            $number = Randomizer::getRandomInt(-$i, $i);
            $this->assertTrue($i >= $number);
            $this->assertTrue(-$i <= $number);
            $this->assertEquals('integer', gettype($number));
        }
    }

    public function testCheckRandomFloatFunction(): void
    {
        for ($i = 0; $i < 1000; $i++) {
            $number = Randomizer::getRandomFloat(-$i, $i);
            $this->assertTrue($i >= $number);
            $this->assertTrue(-$i <= $number);
            $this->assertEquals('double', gettype($number));
        }
    }
}