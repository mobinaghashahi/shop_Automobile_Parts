<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OffFunctionTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $this->assertEquals(152,offCalculation(10,1520));
        $this->assertEquals(304,offCalculation(20,1520));
        $this->assertEquals(456,offCalculation(30,1520));
        $this->assertEquals(836,offCalculation(55,1520));


        $this->assertEquals(24000,offCalculation(15,160000));
        $this->assertEquals(16000,offCalculation(10,160000));
        $this->assertEquals(12800,offCalculation(8,160000));
        $this->assertEquals(7200,offCalculation(4.5,160000));
        $this->assertEquals(80000,offCalculation(50,160000));
        $this->assertEquals(89600,offCalculation(56,160000));
        $this->assertEquals(99520,offCalculation(62.2,160000));
        $this->assertEquals(104160,offCalculation(65.1,160000));
        $this->assertEquals(158560,offCalculation(99.1,160000));
    }
}
