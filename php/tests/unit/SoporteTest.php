<?php

class SoporteTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
        include_once('./src/Soporte.php');


    }

    // tests
    public function testPreuAmbIva()
    {
        $soporte = new Soporte("Tenet", 22, 3);
        $this->assertEquals(3.63,$soporte->getPrecioConIVA());
    }


}