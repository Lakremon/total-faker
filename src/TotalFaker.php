<?php

namespace TotalFaker;

use TotalFaker\Entities\World;

class TotalFaker
{
    private static $world;

    /**
     * get
     * @return World
     */
    public static function getWorld():World
    {
        return self::$world ?? self::$world = new World();
    }
}