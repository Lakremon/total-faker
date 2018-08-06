<?php

namespace TotalFaker\Helpers;


class Math
{

    public static function fact($variable)
    {
        if (function_exists('gmp_fact')) {
            return gmp_fact($variable);
        } else {
            $fact = 1;
            for ($i = 1; $i <= $variable; $i++) {
                $fact *= $i;
            }
            return $fact;
        }
    }

}