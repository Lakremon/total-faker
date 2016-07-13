<?php
namespace totalFaker;

class World extends FakerComponent
{
    use Thing;
    private $_skyColor;

    function __construct()
    {
        $this->_attributes = [

        ];
        $this->_skyColor = [
            rand(0, 255),
            rand(0, 255),
            rand(0, 255),
        ];
    }

    function getPersone(){

    }
}