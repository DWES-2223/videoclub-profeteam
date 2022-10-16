<?php
namespace Dwes\ProjecteVideoClub;

include_once("Soporte.php");
include_once("CintaVideo.php");
include_once("Dvd.php");
include_once("Juego.php");
include_once("Cliente.php");

use Dwes\ProjecteVideoClub\CintaVideo;
use Dwes\ProjecteVideoClub\Cliente;
use Dwes\ProjecteVideoClub\Dvd;
use Dwes\ProjecteVideoClub\Juego;
use Dwes\ProjecteVideoClub\Soporte;

class Videoclub
{
    protected $numSocios = 0;

    protected $numProductos = 0;

    protected $productos = [];

    protected $socios = [];

    public function __construct(protected $nombre)
    {
    }

    /**
     * @return int
     */
    public function getNumSocios(): int
    {
        return $this->numSocios;
    }

    /**
     * @return int
     */
    public function getNumProductos(): int
    {
        return $this->numProductos;
    }

    /**
     * @return array
     */
    public function getProductos($numProducto = null): mixed
    {

        return (isset($numProducto)) ? $this->productos[$numProducto] : $this->productos;
    }

    /**
     * @return array
     */
    public function getSocios($numSocio = null): mixed
    {
        return (isset($numSocio)) ? $this->socios[$numSocio] : $this->socios;
    }

    protected function incluirProducto(Soporte $producto)
    {
        $this->productos[$producto->getNumero()] = $producto;
        $this->numProductos++;
        echo '<br>Incluido Soporte'.$producto->getNumero();
    }

    public function incluirCintaVideo($titulo, $precio, $duracion)
    {
        $cinta = new CintaVideo($titulo, $this->numProductos, $precio, $duracion);
        $this->incluirProducto($cinta);
    }

    public function incluirDvd($titulo, $precio, $idiomas, $pantalla)
    {
        $dvd = new Dvd($titulo, $this->numProductos, $precio, $idiomas, $pantalla);
        $this->incluirProducto($dvd);
    }

    public function incluirJuego($titulo, $precio, $consola, $minJug, $maxJug)
    {
        $juego = new Juego($titulo, $this->numProductos, $precio, $consola, $minJug, $maxJug);
        $this->incluirProducto($juego);
    }

    public function incluirSocio($nombre, $maxAlquilesConcurrentes = 3)
    {
        $socio = new Cliente($nombre, $this->numSocios, $maxAlquilesConcurrentes);
        $this->socios[$socio->getNumero()] = $socio;
        $this->numSocios++;

        echo '<br>Incluido Socio'.$socio->getNumero();
    }

    public function listarProductos()
    {
        echo "<p>Listado de los $this->numProductos productos disponibles:";
        foreach ($this->productos as $producto) {
            $producto->muestraResumen();
        }
        echo "</p>";
    }

    public function listarSocios()
    {
        echo "<p>Listado de los $this->numSocios socios del videoclub:";
        foreach ($this->socios as $socio) {
            $socio->muestraResumen();
        }
        echo "</p>";
    }

    public function alquilaSocioProducto($numeroCliente, $numSoporte): mixed
    {
        $cliente = $this->socios[$numeroCliente];
        $cliente->alquilar($this->productos[$numSoporte]);

        return $this;
    }
}
