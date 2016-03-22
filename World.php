<?php
namespace totalFaker;

class World extends FakerComponent
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

    function getPersone(){

    }
}