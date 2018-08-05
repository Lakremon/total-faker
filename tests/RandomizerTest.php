<?php

namespace TotalFakerTests;

use PHPUnit\Framework\TestCase;
use TotalFaker\Exceptions\WrongRandomizerPullLength;
use TotalFaker\Exceptions\WrongRandomStringLengthException;
use TotalFaker\Helpers\Randomizer;

class RandomizerTest extends TestCase
{
    public function testRandomZeroOneFunction(): void
    {
        for ($i = 0; $i < 1000; $i++) {
            $number = Randomizer::getRandomZeroOne();
            $this->assertTrue(1 >= $number);
            $this->assertTrue(0 <= $number);
        }
    }

    public function testRandomIntFunction(): void
    {
        for ($i = 0; $i < 1000; $i++) {
            $number = Randomizer::getRandomInt(-$i, $i);
            $this->assertTrue($i >= $number);
            $this->assertTrue(-$i <= $number);
            $this->assertEquals('integer', gettype($number));
        }
    }

    public function testRandomFloatFunction(): void
    {
        for ($i = 0; $i < 1000; $i++) {
            $number = Randomizer::getRandomFloat(-$i, $i);
            $this->assertTrue($i >= $number);
            $this->assertTrue(-$i <= $number);
            $this->assertEquals('double', gettype($number));
        }
    }

    public function testRandomStringExceptionsFunction(): void
    {
        $this->expectException(WrongRandomStringLengthException::class);
        Randomizer::getRandomString(-1);
        $this->expectException(WrongRandomizerPullLength::class);
        Randomizer::getRandomString(0, '');
    }

    public function testRandomStringFunction(): void
    {
        $this->assertEquals('a', Randomizer::getRandomString(1, 'a'));
        $this->assertTrue(!!preg_match('/^[abc]$/', Randomizer::getRandomString(1, 'abc')));
        $this->assertTrue(!!preg_match('/^\d$/', Randomizer::getRandomString(1, '1234567890')));
        $this->assertFalse(!!preg_match('/^\W$/', Randomizer::getRandomString(1, 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')));
        $this->assertTrue(!!preg_match('/a/', Randomizer::getRandomString(100, 'abc')));
        $this->assertTrue(!!preg_match('/b/', Randomizer::getRandomString(100, 'abc')));
        $this->assertTrue(!!preg_match('/c/', Randomizer::getRandomString(100, 'abc')));
    }
}