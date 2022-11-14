<?php
use Dwes\ProyectoVideoClub\Cliente;
use Dwes\ProyectoVideoClub\Videoclub;


class CRUDTest extends \Codeception\Test\Unit
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
    }


    public function testBorraSocioVideoClub()
    {
        $vc = new Videoclub('El palmar');
        $vc->incluirSocio("Amancio Ortega");
        $vc->incluirSocio("Ignasi Gomis");
        $vc->borraSocio(0);
        $this->assertEquals(1, $vc->getNumSocios());
        $this->assertEquals(false, $vc->buscaSocio('pepe'));
    }




}
