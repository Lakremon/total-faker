<?php

namespace TotalFaker\Distributions;

/**
 * Class PoissonDistribution to get Poisson distribution emulation. This class transform exponential distribution to
 * Poisson distribution. It use Poisson distribution feature. Main method is getRandomNumber(). It returns only integer
 * numbers. More information here - https://en.wikipedia.org/wiki/Poisson_distribution
 *
 * If you call this method 10000 times and insert values in one array. This array should use rounded value as a key
 * and count of got values as array value. Below you can see example of usage this function:
 *
 * array dump example:
 * <==========>
 * 0 => 3690
 * 1 => 3729
 * 2 => 1797
 * 3 => 554
 * 4 => 175
 * 5 => 50
 * 6 => 4
 * 7 => 1
 * <==========>
 *
 * times  ^
 *        |
 *        *  *
 *        |
 *        |
 *        |
 *        |     *
 *        |
 *        |        *
 *        |              *
 *        +--|--|--|--|--|--|------> values
 *
 *
 * @package TotalFaker\Distributions
 */
class PoissonDistribution
{
    private $rate;
    private static $exponentialDistribution;

    /**
     * PoissonDistribution constructor.
     * @param int $rate
     */
    public function __construct(int $rate = 1)
    {
        $this->rate = $rate;
    }

    /**
     * Get random number via Poisson distribution.
     * @return int
     * @throws \TotalFaker\Exceptions\RandomFunctionException
     */
    public function getRandomNumber(): int
    {
        $s = 0;

        for ($i = -1; $s < $this->rate; $i++) {
            $s += self::getRandomExponential();
        }
        return $i;
    }

    /**
     * Get random number via exponential distribution with rate one.
     * @return float
     * @throws \TotalFaker\Exceptions\RandomFunctionException
     */
    private static function getRandomExponential(): float
    {
        if (empty(self::$exponentialDistribution)) {
            self::$exponentialDistribution = new ExponentialDistribution();
        }
        return self::$exponentialDistribution->getRandomNumber();
    }
}