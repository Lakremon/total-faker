<?php

namespace TotalFakerTests;


use PHPUnit\Framework\TestCase;
use TotalFaker\Helpers\Math;

class MathTest extends TestCase
{


    public function testFactFunction(): void
    {
        $this->assertEquals(1, Math::fact(0));
        $this->assertEquals(1, Math::fact(1));
        $this->assertEquals(6, Math::fact(3));
        $this->assertEquals(24, Math::fact(4));
        $this->assertEquals(120, Math::fact(5));
        $this->assertEquals(720, Math::fact(6));
        $this->assertEquals(5040, Math::fact(7));
        $this->assertEquals(40320, Math::fact(8));
        $this->assertEquals(362880, Math::fact(9));
        $this->assertEquals(3628800, Math::fact(10));
    }

}