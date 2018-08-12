<?php

namespace TotalFaker\Helpers;


use TotalFaker\Exceptions\RandomFunctionException;
use TotalFaker\Exceptions\WrongRandomizerPullLength;
use TotalFaker\Exceptions\WrongRandomStringLengthException;

/**
 * Class Randomizer get random numbers and strings functions.
 *
 * @package TotalFaker\Helpers
 */
class Randomizer
{
    const DEFAULT_LETTERS_PULL = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

    /**
     * Return cryptographically secure random integer number from $min to $max.
     *
     * @param int $min
     * @param int $max
     * @return int
     * @throws RandomFunctionException
     */
    public static function getRandomInt(int $min = PHP_INT_MIN, int $max = PHP_INT_MAX): int
    {
        try {
            return random_int($min, $max);
        } catch (\Throwable $e) {
            throw new RandomFunctionException();
        }
    }

    /**
     * Return cryptographically secure random float number from $min to $max.
     *
     * @param float $min
     * @param float $max
     * @return float
     * @throws RandomFunctionException
     */
    public static function getRandomFloat(float $min = PHP_INT_MIN, float $max = PHP_INT_MAX): float
    {
        try {
            return self::getRandomZeroOne() * ($max - $min) + $min;
        } catch (\Throwable $e) {
            throw new RandomFunctionException();
        }
    }

    /**
     * Return cryptographically secure random float number from 0 to 1.
     *
     * @return float
     * @throws RandomFunctionException
     */
    public static function getRandomZeroOne(): float
    {
        try {
            return (random_int(0, PHP_INT_MAX) / PHP_INT_MAX);
        } catch (\Throwable $e) {
            throw new RandomFunctionException();
        }
    }

    /**
     * Generate random string with length $length. And completed by letters from $pull string.
     *
     * @param int $length
     * @param string $pull
     * @return string
     * @throws RandomFunctionException
     * @throws WrongRandomStringLengthException
     * @throws WrongRandomizerPullLength
     */
    public static function getRandomString(int $length = 32, string $pull = self::DEFAULT_LETTERS_PULL): string
    {
        if (0 > $length) {
            throw new WrongRandomStringLengthException();
        }

        $pullLength = strlen($pull);
        if ($pullLength === 0) {
            throw new WrongRandomizerPullLength();
        }

        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= substr($pull, self::getRandomInt(0, $pullLength - 1), 1);
        }
        return $string;
    }
}