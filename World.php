<?php
namespace totalFaker;

class World
{
    use Thing;
    private $_skyColor;

    function __construct()
    {
        $this->_skyColor = [
            rand(0, 255),
            rand(0, 255),
            rand(0, 255),
        ];
    }
}