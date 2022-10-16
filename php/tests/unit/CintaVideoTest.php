<?php
use Dwes\ProjecteVideoClub\CintaVideo;

class CintaVideoTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
        $path = './src/ProjectoVideoClub';
        include_once("$path/CintaVideo.php");
    }
    // tests
    public function testPreuAmbIva()
    {
        $cinta = new CintaVideo("Tenet", 22, 3,100);
        $this->assertEquals(3.63,$cinta->getPrecioConIVA());
    }





}