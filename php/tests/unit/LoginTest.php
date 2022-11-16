<?php
use Dwes\ProyectoVideoClub\Cliente;
use Dwes\ProyectoVideoClub\Videoclub;


class LoginTest extends \Codeception\Test\Unit
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
    public function testClienteSenseUserPassword()
    {
        $cliente = new Cliente(self::IGNASI_GOMIS, 22);
        $this->assertEquals('ignasi', $cliente->getUsername());
        $this->assertEquals('1234', $cliente->getPassword());
    }

    public function testClienteAmbUserPassword()
    {
        $cliente = new Cliente(self::IGNASI_GOMIS, 22,5,'pepe','12345');
        $this->assertEquals('pepe', $cliente->getUsername());
        $this->assertEquals('12345', $cliente->getPassword());
    }

    public function testEncuentraClienteVideoClub()
    {
        $vc = new Videoclub('El palmar');
        $vc->incluirSocio("Amancio Ortega");
        $vc->incluirSocio("Ignasi Gomis");
        $this->assertEquals('Ignasi Gomis', $vc->buscaSocio('ignasi')->getNombre());
        $this->assertEquals(false, $vc->buscaSocio('pepe'));
    }




}
