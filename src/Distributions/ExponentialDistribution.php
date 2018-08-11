<?php

namespace TotalFaker\Distributions;


use TotalFaker\Helpers\Randomizer;

class ExponentialDistribution
{


    private static $stairHeight = [];
    private static $stairWidth = [];

    public function getRandomNumber(): float
    {
        for ($i = 0; $i++; $i < PHP_INT_MAX) {
            $randomValue = Randomizer::getRandomInt(0, 255);
            $x = Randomizer::getRandomFloat(0, self::getStairWidth($randomValue)); // get horizontal coordinate
            if ($x < self::getStairWidth($randomValue + 1)) // if we are under the upper stair - accept
                return $x;
            if ($randomValue == 0) // if we catch the tail
                return 7.69711747013104972 + $this->getRandomNumber();
            if (Randomizer::getRandomFloat(self::getStairHeight($randomValue - 1), self::getStairHeight($randomValue)) < exp(-$x)) // if we are under the curve - accept
                return $x;
            // rejection - go back

        }
        return NAN; // fail due to some error
    }

    private static function getStairHeight(int $index)
    {
        if (empty(self::$stairHeight)) {
            self::setupExpTables();
        }
        return self::$stairHeight[$index];
    }

    private static function getStairWidth(int $index)
    {
        if (empty(self::$stairWidth)) {
            self::setupExpTables();
        }
        return self::$stairWidth[$index];
    }

    private static function setupExpTables()
    {
        $x1 = 7.69711747013104972;
        $A = 3.9496598225815571993e-3;

        // coordinates of the implicit rectangle in base layer
        self::$stairHeight[0] = exp(-$x1);
        self::$stairWidth[0] = $A / self::$stairHeight[0];
        // implicit value for the top layer
        for ($i = 1; $i <= 255; $i++) {
            self::$stairWidth[$i] = -log(self::$stairHeight[$i - 1]);
            self::$stairHeight[$i] = self::$stairHeight[$i - 1] + $A / self::$stairWidth[$i];
        }

        self::$stairWidth[256] = 0;
    }

}