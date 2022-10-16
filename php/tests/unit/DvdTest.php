<?php
use Dwes\ProjecteVideoClub\Dvd;

class DvdTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
        $path = './src/ProjectoVideoClub';
        include_once("$path/Dvd.php");
    }

    // tests
    public function testPreuAmbIva()
    {
        $cinta = new Dvd("Origen", 24, 15, "es,en,fr", "16:9");
        $this->assertEquals(18.15,$cinta->getPrecioConIVA());
    }





}