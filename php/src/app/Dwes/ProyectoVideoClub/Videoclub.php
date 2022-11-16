<?php
namespace Dwes\ProyectoVideoClub;


use Dwes\ProyectoVideoClub\Util\ClienteNoEncontradoException;
use Dwes\ProyectoVideoClub\Util\CupoSuperadoException;
use Dwes\ProyectoVideoClub\Util\SoporteYaAlquiladoException;
use Dwes\ProyectoVideoClub\Util\VideoclubException;
use Dwes\ProyectoVideoClub\Util\LogFactory;
use Monolog\Logger;

/**
 *     Classe per a gestionar el videoclub
 */
class Videoclub
{
    /**
     * @var int
     */
    protected $numSocios = 0;

    /**
     * @var int
     */
    protected $numProductos = 0;

    /**
     * @var array
     */
    protected $productos = [];

    /**
     * @var array
     */
    protected $socios = [];

    /**
     * @var \Monolog\Logger|\Psr\Log\LoggerInterface
     */
    protected Logger $log;

    /**
     * @param $nombre
     */
    public function __construct(protected $nombre)
    {
        $this->log = LogFactory::getLogger();
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

    /**
     * @param \Dwes\ProyectoVideoClub\Soporte $producto
     * @return void
     */
    protected function incluirProducto(Soporte $producto, $metacritic=null)
    {
        $producto->setMetacritic($metacritic);
        $this->productos[$producto->getNumero()] = $producto;
        $this->numProductos++;
        $this->log->info('Incluido Soporte', ['numero' => $producto->getNumero()]);
    }

    /**
     * @param $username
     * @return false|mixed
     */
    public function buscaSocio($username)
    {
        foreach ($this->getSocios() as $socio) {
            if ($socio->getUserName() === $username) {
                return $socio;
            }
        }
        return false;
    }

    /**
     * @param $titulo
     * @param $precio
     * @param $duracion
     * @return void
     */
    public function incluirCintaVideo($titulo, $precio, $duracion, $metacritic=null)
    {
        $cinta = new CintaVideo($titulo, $this->numProductos, $precio, $duracion);
        $this->incluirProducto($cinta, $metacritic);
    }

    /**
     * @param $titulo
     * @param $precio
     * @param $idiomas
     * @param $pantalla
     * @return void
     */
    public function incluirDvd($titulo, $precio, $idiomas, $pantalla, $metacritic=null)
    {
        $dvd = new Dvd($titulo, $this->numProductos, $precio, $idiomas, $pantalla);
        $this->incluirProducto($dvd, $metacritic);
    }

    /**
     * @param $titulo
     * @param $precio
     * @param $consola
     * @param $minJug
     * @param $maxJug
     * @return void
     */
    public function incluirJuego($titulo, $precio, $consola, $minJug, $maxJug, $metacritic=null)
    {
        $juego = new Juego($titulo, $this->numProductos, $precio, $consola, $minJug, $maxJug);
        $this->incluirProducto($juego, $metacritic);
    }

    /**
     * @param $nombre
     * @param $maxAlquilesConcurrentes
     * @param $username
     * @param $password
     * @return void
     */
    public function incluirSocio($nombre, $maxAlquilesConcurrentes = 3,$username=null,$password='1234')
    {
        $socio = new Cliente($nombre, $this->numSocios, $maxAlquilesConcurrentes,$username,$password);
        $this->socios[$socio->getNumero()] = $socio;
        $this->numSocios++;

        $this->log->info('Incluido Socio',['socio' => $socio->getNumero()]);

    }

    /**
     * @return void
     */
    public function listarProductos()
    {
        echo "<p>Listado de los $this->numProductos productos disponibles:";
        foreach ($this->productos as $producto) {
            $producto->muestraResumen();
        }
        echo "</p>";
    }

    /**
     * @return void
     */
    public function listarSocios()
    {
        echo "<p>Listado de los $this->numSocios socios del videoclub:";
        foreach ($this->socios as $socio) {
            echo '<a id="mod_'.$socio->getUsername().'" class="btn btn-info" href="formUpdateCliente.php?socio='.$socio->getUsername().'">Modificar Perfil</a>';
            echo '<a id="del_'.$socio->getUsername().'" class="btn btn-danger" href="removeCliente.php?socio='.$socio->getUsername().'" onclick="return confirm('."'Estàs segur?')".'" >Esborrar Usuari</a>';
            $socio->muestraResumen();
        }
        echo "</p>";
    }

    /**
     * @param $numeroCliente
     * @param $numSoporte
     * @return mixed
     */
    public function alquilaSocioProducto($numeroCliente, $numSoporte): mixed
    {
        try {
            if (!isset($this->socios[$numeroCliente])){
                throw new ClienteNoEncontradoException("<p>Cliente $numeroCliente no existe</p>");
            }
            $cliente = $this->socios[$numeroCliente];
            $cliente->alquilar($this->productos[$numSoporte]);
        } catch (VideoclubException $e) {
            echo $e->getMessage();
            $this->log->warning($e->getMessage());
        }

        return $this;
    }

    /**
     * @param int $numSocio
     * @param array $numerosProductos
     * @return mixed
     */
    public function alquilaSocioProductos(int $numSocio, array $numerosProductos): mixed
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
                $this->alquilaSocioProducto($numSocio, $producto);
            }
            return $this;
        } catch (VideoclubException $e) {
            echo $e->getMessage();
            $this->log->warning($e->getMessage());
            return null;
        }
    }

    /**
     * @param $numeroCliente
     * @param $numSoporte
     * @return mixed
     */
    public function devolverSocioProducto($numeroCliente, $numSoporte): mixed
    {
        try {
            $cliente = $this->socios[$numeroCliente];
            $cliente->retornar($numSoporte);
        } catch (VideoclubException $e){
            $this->log->warning($e->getMessage());
        }
        return $this;
    }

    /**
     * @param $numeroCliente
     * @return $this
     */
    public function borraSocio($numeroCliente) {
        unset($this->socios[$numeroCliente]);
        $this->numSocios --;
        return $this;
    }

    /**
     * @param int $numSocio
     * @param array $numerosProductos
     * @return mixed
     */
    public function devolverSocioProductos(int $numSocio, array $numerosProductos): mixed
    {
        try {
            // Cliente existe
            if (!isset($this->socios[$numSocio])){
                throw new ClienteNoEncontradoException("<p>Cliente $numeroCliente no existe</p>");
            }

            foreach ($numerosProductos as $producto)
            {
                $this->devolverSocioProducto($numSocio, $producto);
            }
            return $this;
        } catch (VideoclubException $e) {
            echo $e->getMessage();
            $this->log->warning($e->getMessage());
            return $this;
        }
    }
}
