<?php
use Dwes\ProjecteVideoClub\Soporte;
use Dwes\ProjecteVideoClub\CintaVideo;

class SoporteTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
        $path = './src/ProjectoVideoClub';
        include_once("$path/Soporte.php");
        include_once("$path/CintaVideo.php");
    }

    // tests
    public function testPreuAmbIva()
    {
        $soporte = new CintaVideo("Tenet", 22, 3,100);
        $this->assertEquals(3.63,$soporte->getPrecioConIVA());
    }


}