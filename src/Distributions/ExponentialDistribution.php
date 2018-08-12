<?php

namespace TotalFaker\Distributions;


use TotalFaker\Helpers\Randomizer;

/**
 * Class ExponentialDistribution to get exponential distribution emulation. This class transform linear distribution to
 * exponential distribution. It use the ziggurat algorithm transform as a base. Main method is getRandomNumber(). More
 * information here - https://en.wikipedia.org/wiki/Ziggurat_algorithm
 *
 * If you call this method 10000 times and insert values in one array. This array should use rounded value as a key
 * and count of got values as array value. Below you can see example of usage this function:
 *
 * array dump example:
 * <==========>
 * 0 => 6275
 * 1 => 2358
 * 2 => 871
 * 3 => 310
 * 4 => 126
 * 5 => 33
 * 6 => 21
 * 7 => 5
 * 8 => 1
 * <==========>
 *
 * times  ^
 *        |
 *        |*
 *        |
 *        | *
 *        |
 *        |   *
 *        |     *
 *        |        *
 *        |               *     *
 *        +------------------------> values
 *
 *
 * @package TotalFaker\Distributions
 */
class ExponentialDistribution
{
//    const ALGO_ZIGGURAT = 1;

    const X0 = 7.69711747013104972;
    const A = 3.9496598225815571993e-3;

    private static $stairHeight = [];
    private static $stairWidth = [];

    private $rate;

    /**
     * NormalDistribution constructor.
     * @param float $rate rate, or inverse scale
     * need full transformation make this param false.
     */
    public function __construct(float $rate = 1)
    {
        $this->rate = $rate;
    }

    /**
     * Get random number via exponential distribution with custom rate.
     * @return float
     * @throws \TotalFaker\Exceptions\RandomFunctionException
     */
    public function getRandomNumber(): float
    {
        return $this->getExponentialDistribution() / $this->rate;
    }

    /**
     * Get random number via exponential distribution with rate = 1.
     * @return float
     * @throws \TotalFaker\Exceptions\RandomFunctionException
     */
    private function getExponentialDistribution(): float
    {
        for ($i = 0; $i < PHP_INT_MAX; $i++) {
            $randomValue = Randomizer::getRandomInt(0, 255);
            $x = Randomizer::getRandomFloat(0, self::getStairWidth($randomValue)); // get horizontal coordinate
            if ($x < self::getStairWidth($randomValue + 1)) // if we are under the upper stair - accept
                return $x;
            if ($randomValue == 0) // if we catch the tail
                return self::X0 + $this->getExponentialDistribution();
            if (Randomizer::getRandomFloat(self::getStairHeight($randomValue - 1), self::getStairHeight($randomValue)) < exp(-$x)) // if we are under the curve - accept
                return $x;

        }
        return NAN; // fail due to some error
    }

    /**
     * Get stair height array element
     * @param int $index
     * @return float
     */
    private static function getStairHeight(int $index): float
    {
        if (empty(self::$stairHeight)) {
            self::setupExpTables();
        }
        return self::$stairHeight[$index];
    }

    /**
     * Get stair width array element
     * @param int $index
     * @return float
     */
    private static function getStairWidth(int $index): float
    {
        if (empty(self::$stairWidth)) {
            self::setupExpTables();
        }
        return self::$stairWidth[$index];
    }

    /**
     * Fill stair arrays (height and width) for the ziggurat algorithm and exponential distribution.
     */
    private static function setupExpTables()
    {
        // coordinates of the implicit rectangle in base layer
        self::$stairHeight[0] = exp(-self::X0);
        self::$stairWidth[0] = self::A / self::$stairHeight[0];
        // implicit value for the top layer
        for ($i = 1; $i <= 255; $i++) {
            self::$stairWidth[$i] = -log(self::$stairHeight[$i - 1]);
            self::$stairHeight[$i] = self::$stairHeight[$i - 1] + self::A / self::$stairWidth[$i];
        }
        self::$stairWidth[256] = 0;
    }
}