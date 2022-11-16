<?php
require_once('./vendor/autoload.php');


use Dwes\ProyectoVideoClub\Cliente;
use Dwes\ProyectoVideoClub\Dvd;
use Dwes\ProyectoVideoClub\Videoclub;

class VideoClubTest extends \Codeception\Test\Unit
{
    const IGNASI_GOMIS = "Ignasi Gomis";

    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
        // No needed
    }

    // tests
    public function testAltaSoporte()
    {
        $vc = new Videoclub('El palmar');
        $vc->incluirJuego("God of War", 19.99, "PS4", 1, 1);
        $vc->incluirJuego("The Last of Us Part II", 49.99, "PS4", 1, 1);
        $vc->incluirDvd("Torrente", 4.5, "es", "16:9");
        $vc->incluirDvd("Origen", 4.5, "es,en,fr", "16:9");
        $vc->incluirDvd("El Imperio Contraataca", 3, "es,en","16:9");
        $vc->incluirCintaVideo("Los cazafantasmas", 3.5, 107);
        $vc->incluirCintaVideo("El nombre de la Rosa", 1.5, 140);
        $this->assertEquals(7,$vc->getNumProductos());
        $this->assertEquals(new Dvd("Torrente", 2,4.5, "es","16:9"), $vc->getProductos(2));
    }

    public function testAltaSocio()
    {
        $vc = new Videoclub('El palmar');
        $vc->incluirSocio("Amancio Ortega");
        $vc->incluirSocio("Pablo Picasso", 2);
        $this->assertEquals(2, $vc->getNumSocios());
        $this->assertEquals(new Cliente("Pablo Picasso", 1, 2),$vc->getSocios(1));
    }

    public function testProductoAlquilado(){
        $vc = new Videoclub('El palmar');
        $vc->incluirSocio("Amancio Ortega");
        $vc->incluirDvd("Torrente", 4.5, "es", "16:9");
        $this->assertEquals(false,$vc->getProductos(0)->alquilado);
        $vc->alquilaSocioProducto(0,0);
        $this->assertEquals(true,$vc->getProductos(0)->alquilado);
        $vc->devolverSocioProducto(0,0);
        $this->assertEquals(false,$vc->getProductos(0)->alquilado);
    }

    public function testProductosAlquiladosFailTooMuch(){
        $vc = new Videoclub('El palmar');
        $vc->incluirSocio("Amancio Ortega");
        $vc->incluirJuego("God of War", 19.99, "PS4", 1, 1);
        $vc->incluirJuego("The Last of Us Part II", 49.99, "PS4", 1, 1);
        $vc->incluirDvd("Torrente", 4.5, "es","16:9");
        $vc->incluirDvd("Origen", 4.5, "es,en,fr", "16:9");
        $vc->incluirDvd("El Imperio Contraataca", 3, "es,en","16:9");
        $vc->incluirCintaVideo("Los cazafantasmas", 3.5, 107);
        $vc->incluirCintaVideo("El nombre de la Rosa", 1.5, 140);
        $this->assertEquals(null, $vc->alquilaSocioProductos(0,[1,2,3,4]));
    }

    public function testProductosAlquiladosSuccess(){
        $vc = new Videoclub('El palmar');
        $vc->incluirSocio("Amancio Ortega");
        $vc->incluirJuego("God of War", 19.99, "PS4", 1, 1);
        $vc->incluirJuego("The Last of Us Part II", 49.99, "PS4", 1, 1);
        $vc->incluirDvd("Torrente", 4.5, "es","16:9");
        $vc->incluirDvd("Origen", 4.5, "es,en,fr", "16:9");
        $vc->incluirDvd("El Imperio Contraataca", 3, "es,en","16:9");
        $vc->incluirCintaVideo("Los cazafantasmas", 3.5, 107);
        $vc->incluirCintaVideo("El nombre de la Rosa", 1.5, 140);
        $this->assertEquals($vc,$vc->alquilaSocioProductos(0,[1,2,3]));
        $this->assertEquals(3, $vc->getSocios(0)->getNumSoportesAlquilados());
    }

    public function testRetornarProductosAlquiladosSuccess() {
        $vc = new Videoclub('El palmar');
        $vc->incluirSocio("Amancio Ortega");
        $vc->incluirJuego("God of War", 19.99, "PS4", 1, 1);
        $vc->incluirJuego("The Last of Us Part II", 49.99, "PS4", 1, 1);
        $vc->incluirDvd("Torrente", 4.5, "es","16:9");
        $vc->incluirDvd("Origen", 4.5, "es,en,fr", "16:9");
        $vc->incluirDvd("El Imperio Contraataca", 3, "es,en","16:9");
        $vc->incluirCintaVideo("Los cazafantasmas", 3.5, 107);
        $vc->incluirCintaVideo("El nombre de la Rosa", 1.5, 140);
        $this->assertEquals($vc,$vc->alquilaSocioProductos(0,[1,2,3]));
        $this->assertEquals(true,$vc->getProductos(2)->alquilado);
        $this->assertEquals($vc,$vc->devolverSocioProductos(0,[2,3]));
        $this->assertEquals(false,$vc->getProductos(2)->alquilado);
        $this->assertEquals(true,$vc->getProductos(1)->alquilado);
        $this->assertEquals(1, $vc->getSocios(0)->getNumSoportesAlquilados());
        $this->assertEquals($vc,$vc->devolverSocioProductos(0,[1]));
        $this->assertEquals(false,$vc->getProductos(1)->alquilado);
        $this->assertEquals(0, $vc->getSocios(0)->getNumSoportesAlquilados());
    }
    public function testRetornarProductosAlquiladosFail(){
        $vc = new Videoclub('El palmar');
        $vc->incluirSocio("Amancio Ortega");
        $vc->incluirJuego("God of War", 19.99, "PS4", 1, 1);
        $vc->incluirJuego("The Last of Us Part II", 49.99, "PS4", 1, 1);
        $vc->incluirDvd("Torrente", 4.5, "es","16:9");
        $vc->incluirDvd("Origen", 4.5, "es,en,fr", "16:9");
        $vc->incluirDvd("El Imperio Contraataca", 3, "es,en","16:9");
        $vc->incluirCintaVideo("Los cazafantasmas", 3.5, 107);
        $vc->incluirCintaVideo("El nombre de la Rosa", 1.5, 140);
        $this->assertEquals($vc,$vc->alquilaSocioProductos(0,[1,2,3]));
        $this->assertEquals($vc,$vc->devolverSocioProductos(0,[4]));
        $this->assertEquals(3, $vc->getSocios(0)->getNumSoportesAlquilados());

    }
}
