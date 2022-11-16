<?php
use Dwes\ProyectoVideoClub\Cliente;
use Dwes\ProyectoVideoClub\Videoclub;


class ScrapingTest extends \Codeception\Test\Unit
{
    const IGNASI_GOMIS = "Ignasi Gomis";

    protected function _before()
    {
        require_once('./vendor/autoload.php');
    }

    public function testDvdShow()
    {
        $vc = new Videoclub('El palmar');
        $vc->incluirDvd('Terminator', 12, 'es', '16:9', 'movie/the-terminator');
        $dvd = $vc->getProductos(0);
        $this->expectOutputString('<br>Terminator<br>12 € (IVA no incluido) <br/> Puntuació: 84<br/><br>Idiomas: es<br>Formato de pantalla: 16:9');
        $dvd->muestraResumen();
    }

    public function testCintaVideoShowWhitOutMetacritic()
    {
        $vc = new Videoclub('El palmar');
        $vc->incluirCintaVideo('The Walking Dead', 120, '4680' );
        $dvd = $vc->getProductos(0);
        $this->expectOutputString('<br>The Walking Dead<br>120 € (IVA no incluido) <br/> Puntuació: 79<br/><br>Duracion: 4680 minutos');
        $dvd->muestraResumen();
    }

    public function testCintaVideoNotFoundShowWhitOutMetacritic()
    {
        $vc = new Videoclub('El palmar');
        $vc->incluirCintaVideo('Camino Santiafo', 120, '4680' );
        $dvd = $vc->getProductos(0);
        $this->expectOutputString('<br>Camino Santiafo<br>120 € (IVA no incluido) <br/> Puntuació: Desconeguda<br/><br>Duracion: 4680 minutos');
        $dvd->muestraResumen();
    }
}
