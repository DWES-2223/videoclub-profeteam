<?php
use Dwes\ProjecteVideoClub\Cliente;
use Dwes\ProjecteVideoClub\Juego;
use Dwes\ProjecteVideoClub\CintaVideo;

class ClienteTest extends \Codeception\Test\Unit
{
    const IGNASI_GOMIS = "Ignasi Gomis";

    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
        $path = './src/ProjectoVideoClub';
        include_once("$path/Cliente.php");
        include_once("$path/Juego.php");
        include_once("$path/CintaVideo.php");
    }

    // tests
    public function testClienteSenseLlogues()
    {
        $cliente = new Cliente(self::IGNASI_GOMIS, 22);
        $this->assertEquals(0,$cliente->getNumSoportesAlquilados());
    }

    public function testAlquiler(){
        $cliente = new Cliente(self::IGNASI_GOMIS, 22);
        $juego = new Juego("The Last of Us Part II", 26, 49.99, "PS4", 1, 1);
        $cinta = new CintaVideo("Tenet", 22, 3,100);
        $cliente->alquilar($juego);
        $this->assertEquals(1,$cliente->getNumSoportesAlquilados());
        $cliente->alquilar($cinta);
        $this->assertEquals(2,$cliente->getNumSoportesAlquilados());
        $this->assertEquals(false,$cliente->alquilar($cinta));
        $this->assertEquals(2,$cliente->getNumSoportesAlquilados());
    }

    public function testRetornar(){
        $cliente = new Cliente(self::IGNASI_GOMIS, 22);
        $juego = new Juego("The Last of Us Part II", 26, 49.99, "PS4", 1, 1);
        $cinta = new CintaVideo("Tenet", 22, 3,100);
        $cliente->alquilar($juego);
        $cliente->alquilar($cinta);
        $this->assertEquals(true,$cliente->retornar(26));
        $this->assertEquals(false,$cliente->retornar(26));
        $this->assertEquals(1,$cliente->getNumSoportesAlquilados());
        $this->assertEquals(true,$cliente->retornar(22));
        $this->assertEquals(0,$cliente->getNumSoportesAlquilados());
    }





}