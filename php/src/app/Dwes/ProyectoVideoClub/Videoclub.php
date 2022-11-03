<?php
namespace Dwes\ProyectoVideoClub;


use Dwes\ProyectoVideoClub\Util\ClienteNoEncontradoException;
use Dwes\ProyectoVideoClub\Util\CupoSuperadoException;
use Dwes\ProyectoVideoClub\Util\SoporteYaAlquiladoException;
use Dwes\ProyectoVideoClub\Util\VideoclubException;

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
        //echo '<br>Incluido Soporte'.$producto->getNumero();
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

        //echo '<br>Incluido Socio'.$socio->getNumero();
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
        try {
            if (!isset($this->socios[$numeroCliente])){
                throw new ClienteNoEncontradoException("<p>Cliente $numeroCliente no existe</p>");
            }
            $cliente = $this->socios[$numeroCliente];
            $cliente->alquilar($this->productos[$numSoporte]);
        } catch (VideoclubException $e){
            echo $e->getMessage();
        }

        return $this;
    }

    public function alquilaSocioProductos(int $numSocio,array $numerosProductos): mixed
    {
        try {
            // Cliente existe
            if (!isset($this->socios[$numSocio])){
                throw new ClienteNoEncontradoException("<p>Cliente $numeroCliente no existe</p>");
            }
            // No va a alquilar mes elements dels que pot
            $cliente = $this->socios[$numSocio];
            $maxAlquiler = $cliente->getMaxAlquilerConcurrente() - $cliente->getNumSoportesAlquilados();
            if ($maxAlquiler < count($numerosProductos)){
                throw new CupoSuperadoException(
                    "<p>Este cliente solo puede alquilar".$maxAlquiler. "Soportes</p>");
            }
            // Els elements no estan llogats
            foreach ($numerosProductos as $producto)
            {
                if ($this->productos[$producto]->alquilado) {
                    throw new SoporteYaAlquiladoException("<p>El soporte $producto ya está alquilado</p>");
                }
            }
            foreach ($numerosProductos as $producto)
            {
                $this->alquilaSocioProducto($numSocio,$producto);
            }
            return $this;
        } catch (VideoclubException $e){
            echo $e->getMessage();
            return null;
        }
    }

    public function devolverSocioProducto($numeroCliente, $numSoporte): mixed
    {
        try {
            $cliente = $this->socios[$numeroCliente];
            $cliente->retornar($numSoporte);
        } catch (VideoclubException $e){
            echo $e->getMessage();
            return null;
        }
        return $this;
    }

    public function devolverSocioProductos(int $numSocio,array $numerosProductos): mixed
    {
        try {
            // Cliente existe
            if (!isset($this->socios[$numSocio])){
                throw new ClienteNoEncontradoException("<p>Cliente $numeroCliente no existe</p>");
            }

            foreach ($numerosProductos as $producto)
            {
                $this->devolverSocioProducto($numSocio,$producto);
            }
            return $this;
        } catch (VideoclubException $e){
            echo $e->getMessage();
            return null;
        }
    }
}
