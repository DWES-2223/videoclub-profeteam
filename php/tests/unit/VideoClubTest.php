<?php
use Dwes\ProyectoVideoClub\Videoclub;
use Dwes\ProyectoVideoClub\Cliente;
use Dwes\ProyectoVideoClub\Dvd;

class VideoClubTest extends \Codeception\Test\Unit
{
    const IGNASI_GOMIS = "Ignasi Gomis";

    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
        include_once("./src/autoload.php");
    }

    // tests
    public function testAltaSoporte()
    {
        $vc = new Videoclub('El palmar');
        $vc->incluirJuego("God of War", 19.99, "PS4", 1, 1);
        $vc->incluirJuego("The Last of Us Part II", 49.99, "PS4", 1, 1);
        $vc->incluirDvd("Torrente", 4.5, "es","16:9");
        $vc->incluirDvd("Origen", 4.5, "es,en,fr", "16:9");
        $vc->incluirDvd("El Imperio Contraataca", 3, "es,en","16:9");
        $vc->incluirCintaVideo("Los cazafantasmas", 3.5, 107);
        $vc->incluirCintaVideo("El nombre de la Rosa", 1.5, 140);
        $this->assertEquals(7,$vc->getNumProductos());
        $this->assertEquals(new Dvd("Torrente", 2,4.5, "es","16:9"),$vc->getProductos(2));
    }

    public function testAltaSocio()
    {
        $vc = new Videoclub('El palmar');
        $vc->incluirSocio("Amancio Ortega");
        $vc->incluirSocio("Pablo Picasso", 2);
        $this->assertEquals(2,$vc->getNumSocios());
        $this->assertEquals(new Cliente("Pablo Picasso", 1,2),$vc->getSocios(1));
    }

    public function testProductoAlquilado(){
        $vc = new Videoclub('El palmar');
        $vc->incluirSocio("Amancio Ortega");
        $vc->incluirDvd("Torrente", 4.5, "es","16:9");
        $this->assertEquals(false,$vc->getProductos(0)->alquilado);
        $vc->alquilaSocioProducto(0,0);
        $this->assertEquals(true,$vc->getProductos(0)->alquilado);
    }
}
