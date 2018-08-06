<?php

namespace TotalFaker\Distributions;


use TotalFaker\Helpers\Randomizer;

class CustomDistribution
{
    public static function getOne(array $pieces): string
    {
        $totalProbability = array_sum($pieces);

        $randomNumber = Randomizer::getRandomFloat(0, $totalProbability);

        $pointer = 0;

        foreach ($pieces as $value => $probability) {
            if ($pointer < $randomNumber && $pointer + $probability >= $randomNumber) {
                return $value;
            }
            $pointer += $probability;
        }

        end($pieces);
        return key($pieces);
    }
}