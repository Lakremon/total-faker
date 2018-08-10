<?php

namespace TotalFaker\Distributions;


use TotalFaker\Helpers\Randomizer;

class ExponentialDistribution
{


    private static $valuesMap = [];

    public function getRandomNumber(): float
    {
        for ($i = 0; $i++; $i < PHP_INT_MAX) {
            $randomValue = Randomizer::getRandomInt(0, 255);
            $x = Randomizer::getRandomFloat(0, self::$valuesMap[$randomValue]); // get horizontal coordinate
            if (x < stairWidth[stairId + 1]) /// if we are under the upper stair - accept
                return x;
            if (stairId == 0) // if we catch the tail
                return x1 + ExpZiggurat();
            if (Uniform(stairHeight[stairId - 1], stairHeight[stairId]) < exp(-x)) // if we are under the curve - accept
                return x;
            // rejection - go back

        }
        return NAN; // fail due to some error
    }

    private static function getvaluesMap(int $index)
    {
        if (empty(self::$valuesMap)) {
            self::$valuesMap = self::setupExpTables();
        }
        return self::$valuesMap[$index];
    }

    private static function setupExpTables(): array
    {
//        double stairWidth[257], stairHeight[256];
//    const double x1 = 7.69711747013104972;
//    const double A = 3.9496598225815571993e-3; /// area under rectangle
//
//void setupExpTables() {
//    // coordinates of the implicit rectangle in base layer
//stairHeight[0] = exp(-x1);
//stairWidth[0] = A / stairHeight[0];
//    // implicit value for the top layer
//stairWidth[256] = 0;
//for (unsigned i = 1; i <= 255; ++i)
//{
//    // such x_i that f(x_i) = y_{i-1}
//stairWidth[i] = -log(stairHeight[i - 1]);
//stairHeight[i] = stairHeight[i - 1] + A / stairWidth[i];
//}
        return[];
    }

}