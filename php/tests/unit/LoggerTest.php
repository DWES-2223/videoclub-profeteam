<?php
use Dwes\ProyectoVideoClub\Cliente;
use Dwes\ProyectoVideoClub\Videoclub;
use Dwes\ProyectoVideoClub\Juego;
use Dwes\ProyectoVideoClub\CintaVideo;


class LoggerTest extends \Codeception\Test\Unit
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


    public function testExistLogFactory(){
        $this->fileExists('app/Dwes/ProyectoVideoClub/Util/LogFactory.php');
        $this->fileExists('logs/videoclub.log');
    }
    // tests
    public function testAlquilerLogsProperly()
    {
        $abans = $this->numLineesFichero('logs/videoclub.log');
        $cliente = new Cliente(self::IGNASI_GOMIS, 22);
        $juego = new Juego("The Last of Us Part II", 26, 49.99, "PS4", 1, 1);
        $cinta = new CintaVideo("Tenet", 22, 3,100);
        $cliente->alquilar($juego);
        $cliente->alquilar($cinta);
        $despres = $this->numLineesFichero('logs/videoclub.log');
        $this->assertEquals(2,$despres-$abans);
    }

    public function testRetornarLogsProperly(){
        $abans = $this->numLineesFichero('logs/videoclub.log');
        $cliente = new Cliente(self::IGNASI_GOMIS, 22);
        $juego = new Juego("The Last of Us Part II", 26, 49.99, "PS4", 1, 1);
        $cinta = new CintaVideo("Tenet", 22, 3,100);
        $cliente->alquilar($juego);
        $cliente->alquilar($cinta);
        $cliente->retornar(26);
        $this->expectException(\Dwes\ProyectoVideoClub\Util\SoporteNoEncontradoException::class);
        $cliente->retornar(21);
        $cliente->retornar(22);
        $despres = $this->numLineesFichero('logs/videoclub.log');
        $this->assertEquals(5,$despres-$abans);

    }

    public function testProductosAlquiladosLogProperly()
    {
        $abans = $this->numLineesFichero('logs/videoclub.log');
        $vc = new Videoclub('El palmar');
        $vc->incluirSocio("Amancio Ortega");
        $vc->incluirJuego("God of War", 19.99, "PS4", 1, 1);
        $vc->incluirJuego("The Last of Us Part II", 49.99, "PS4", 1, 1);
        $vc->incluirCintaVideo("El nombre de la Rosa", 1.5, 140);
        $vc->alquilaSocioProductos(0, [1, 2, 0]);
        $despres = $this->numLineesFichero('logs/videoclub.log');
        $this->assertEquals(7, $despres-$abans);

    }

    private function numLineesFichero($file): int {
        $archivo = fopen('logs/videoclub.log','r');
        $numLines = 0;
        while ($linea = fgets($archivo)) {
            $numLines++;
        }
        fclose($archivo);
        return $numLines;
    }


}
