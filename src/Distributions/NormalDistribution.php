<?php

namespace TotalFaker\Distributions;


use TotalFaker\Helpers\Randomizer;


/**
 * Class NormalDistribution to get normal distribution emulation. This class transform linear distribution to normal
 * distribution. It use Box–Muller transform as a base. Main method is getRandomNumber(). More information here -
 * https://en.wikipedia.org/wiki/Box%E2%80%93Muller_transform
 *
 * If you call this method 10000 times and insert values in one array. This array should use rounded value as a key
 * and count of got values as array value. Below you can see example of usage this function:
 *
 * array dump example:
 * <==========>
 * -4 => 2
 * -3 => 73
 * -2 => 629
 * -1 => 2424
 * 0 => 3824
 * 1 => 2394
 * 2 => 599
 * 3 => 53
 * 4 => 2
 * <==========>
 *
 * times  ^
 *        |
 *        |
 *        |            *
 *        |          *   *
 *        |
 *        |         *     *
 *        |
 *        |       *         *
 *        |  *                   *
 *        +------------|--|--------> values
 *                     0  σ
 *
 *
 * @package TotalFaker\Distributions
 */
class NormalDistribution
{
    private $secondValue = null;
    private static $normalDistributions = [];
    private $expectedValue;
    private $standardDeviation;
    private $useShortTransformation;

    /**
     * NormalDistribution constructor.
     * @param float $expectedValue
     * @param float $standardDeviation
     * @param bool $useShortTransformation - true if you need use short transformation without sin/cos usage. If you
     * need full transformation make this param false.
     */
    public function __construct(float $expectedValue = 0, float $standardDeviation = 1, bool $useShortTransformation = true)
    {
        $this->expectedValue = $expectedValue;
        $this->standardDeviation = $standardDeviation;
        $this->useShortTransformation = $useShortTransformation;
    }

    /**
     * Method return one of $pieces value. Middle value is most possible value. First and last value is lowest possible
     * value.
     *
     * @param iterable $pieces
     * @param bool $useShortTransformation
     * @return mixed
     * @throws \TotalFaker\Exceptions\RandomFunctionException
     */
    public static function getOne(iterable $pieces, bool $useShortTransformation = true)
    {
        $normalizedArray = [];
        foreach ($pieces as $value) {
            $normalizedArray[] = $value;
        }

        $piecesCount = count($normalizedArray);

        if (!key_exists($piecesCount, self::$normalDistributions)) {
            // Three standard deviations account for 99.7% probability
            $standardDeviation = $piecesCount / 6;
            $expectedValue = ($piecesCount - 1) / 2;
            self::$normalDistributions[$piecesCount] = new NormalDistribution(
                $expectedValue,
                $standardDeviation,
                $useShortTransformation
            );
        }

        $probablyKey = self::$normalDistributions[$piecesCount]->getRandomNumber();

        $normalizedKey = round($probablyKey);
        $normalizedKey = 0 > $normalizedKey ? 0 : $normalizedKey;
        $normalizedKey = $piecesCount <= $normalizedKey ? $piecesCount - 1 : $normalizedKey;

        return $normalizedArray[$normalizedKey];
    }

    /**
     * Get one number in Normal Distribution
     *
     * @return float
     * @throws \TotalFaker\Exceptions\RandomFunctionException
     */
    public function getRandomNumber(): float
    {
        if (isset($this->secondValue)) {
            $value = $this->secondValue;
            $this->secondValue = null;
            return $value;
        } else {
            if ($this->useShortTransformation) {
                return $this->shortTransformation();
            } else {
                return $this->fullTransformation();
            }
        }
    }

    /**
     * @return float
     * @throws \TotalFaker\Exceptions\RandomFunctionException
     */
    private function shortTransformation(): float
    {
        do {
            $randomValue1 = Randomizer::getRandomZeroOne() * 2 - 1;
            $randomValue2 = Randomizer::getRandomZeroOne() * 2 - 1;
            $circleSquare = pow($randomValue1, 2) + pow($randomValue2, 2);
        } while ($circleSquare > 1.0 || $circleSquare == 0.0);
        $circleRadius = sqrt(-2 * log($circleSquare) / $circleSquare);

        $this->secondValue = $this->expectedValue + $circleRadius * $randomValue2 * $this->standardDeviation;

        return $this->expectedValue + $circleRadius * $randomValue1 * $this->standardDeviation;
    }

    /**
     * @return float
     * @throws \TotalFaker\Exceptions\RandomFunctionException
     */
    private function fullTransformation(): float
    {
        $randomValue1 = Randomizer::getRandomZeroOne();
        $randomValue2 = Randomizer::getRandomZeroOne();
        $normalRandomValue1 = sqrt(-2 * log($randomValue1)) * cos(2 * M_PI * $randomValue2);
        $normalRandomValue2 = sqrt(-2 * log($randomValue1)) * sin(2 * M_PI * $randomValue2);

        $this->secondValue = $this->expectedValue + $normalRandomValue2 * $this->standardDeviation;

        return $this->expectedValue + $normalRandomValue1 * $this->standardDeviation;
    }
}