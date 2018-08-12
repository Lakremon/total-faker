<?php

namespace TotalFakerTests;


use PHPUnit\Framework\TestCase;
use TotalFaker\TotalFaker;

class PersonTest extends TestCase
{
    public function testAttributesGeneration()
    {
        for($i=0;$i<1000;$i++){
            $person = TotalFaker::getWorld()->getNewPerson();

            $this->assertInternalType("string", $person->firstName);
//        $this->assertInternalType("string", $person->soName);
            $this->assertInternalType("string", $person->lastName);
//        $this->assertInternalType("string", $person->patronymic);
//        $this->assertInternalType("int", $person->age);
//        $this->assertInternalType("int", strtotime($person->bethDate));
//        $this->assertInternalType("string", $person->gender);
//        $this->assertInternalType("string", $person->characterStructure);
//        $this->assertInternalType("string", $person->eysColor);
//        $this->assertInternalType("string", $person->hairColor);
//        $this->assertInternalType("string", $person->language);
        }

    }
}