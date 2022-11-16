<?php
use Dwes\ProyectoVideoClub\Soporte;
use Dwes\ProyectoVideoClub\CintaVideo;

class SoporteTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
        require_once('./vendor/autoload.php');
    }

    // tests
    public function testPreuAmbIva()
    {
        $soporte = new CintaVideo("Tenet", 22, 3,100);
        $this->assertEquals(3.63,$soporte->getPrecioConIVA());
    }


}