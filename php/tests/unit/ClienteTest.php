<?php
use Dwes\ProyectoVideoClub\Cliente;
use Dwes\ProyectoVideoClub\Juego;
use Dwes\ProyectoVideoClub\CintaVideo;

class ClienteTest extends \Codeception\Test\Unit
{
    const IGNASI_GOMIS = "Ignasi Gomis";
    protected $exceptions;

    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
        require_once('./vendor/autoload.php');
        $this->exceptions = file_exists('./src/app/Dwes/ProyectoVideoClub/Util/VideoclubException.php');

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
        $juego2 = new Juego('Walking Dead',23,50,"PS5",1,4);
        $juego3 = new Juego('Fear Walking Dead',23,50,"PS5",1,4);
        $cliente->alquilar($juego);
        $this->assertEquals(1,$cliente->getNumSoportesAlquilados());
        $cliente->alquilar($cinta);
        $this->assertEquals(2,$cliente->getNumSoportesAlquilados());
        if ($this->exceptions) {
            $this->expectException(\Dwes\ProyectoVideoClub\Util\SoporteYaAlquiladoException::class);
            $cliente->alquilar($cinta);
        } else {
            $this->assertEquals(false,$cliente->alquilar($cinta));
        }
        $this->assertEquals(2,$cliente->getNumSoportesAlquilados());
        if ($this->exceptions) {
            $cliente->alquilar($juego2);
            $this->expectException(\Dwes\ProyectoVideoClub\Util\CupoSuperadoException::class);
            $cliente->alquilar($juego3);
        }
    }

    public function testRetornar(){
        $cliente = new Cliente(self::IGNASI_GOMIS, 22);
        $juego = new Juego("The Last of Us Part II", 26, 49.99, "PS4", 1, 1);
        $cinta = new CintaVideo("Tenet", 22, 3,100);
        $cliente->alquilar($juego);
        $cliente->alquilar($cinta);
        $this->assertEquals(true,$cliente->retornar(26));
        if ($this->exceptions) {
            $this->expectException(\Dwes\ProyectoVideoClub\Util\SoporteNoEncontradoException::class);
            $cliente->retornar(21);
        } else {
            $this->assertEquals(false, $cliente->retornar(26));
        }
        $this->assertEquals(1, $cliente->getNumSoportesAlquilados());
        $this->assertEquals(true, $cliente->retornar(22));
        $this->assertEquals(0, $cliente->getNumSoportesAlquilados());
    }


}
