<?php

namespace TotalFaker\Distributions;


use TotalFaker\Helpers\Randomizer;
use TotalFaker\Helpers\Math;

class PoissonDistribution
{
    private $expectedValue;

    public function __construct(float $expectedValue = 1)
    {
        $this->expectedValue = $expectedValue;
    }

    /**
     * Get one number in Poisson Distribution
     *
     * @return float
     * @throws \TotalFaker\Exceptions\RandomFunctionException
     */
    public function getRandomNumber(): int
    {
//        $count = 0;
//
//        do {
//            $count++;
//            $randomValue1 = Randomizer::getRandomInt(0, $this->expectedValue);
//        } while ($randomValue1 !== 0);
        $count = 0;
        $randomValue1 = Randomizer::getRandomInt(0);
        for ($i = 0; $i <= $randomValue1; $i++) {
            $count += pow($this->expectedValue, $i) / Math::fact($i);
        }
        return $count * pow(M_E, -$this->expectedValue);
    }


}