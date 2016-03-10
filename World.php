<?php
namespace totalFaker;

class World
{
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