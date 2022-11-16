<?php
namespace Dwes\ProyectoVideoClub;

use Dwes\ProyectoVideoClub\Util\CupoSuperadoException;
use Dwes\ProyectoVideoClub\Util\LogFactory;
use Dwes\ProyectoVideoClub\Util\SoporteNoEncontradoException;
use Dwes\ProyectoVideoClub\Util\SoporteYaAlquiladoException;
use Monolog\Logger;

/**
 *     Classe per a guardar els socis del videoclub
 */
class Cliente
{
    /**
     * @var int
     */
    protected $numSoportesAlquilados = 0;

    /**
     * @var array
     */
    protected $soportesAlquilados = array();

    /**
     * @var \Monolog\Logger|\Psr\Log\LoggerInterface
     */
    protected Logger $log;

    /**
     * @param $nombre
     * @param $numero
     * @param $maxAlquilerConcurrente
     * @param $username
     * @param $password
     */
    public function __construct(protected $nombre,
        protected $numero,
        protected $maxAlquilerConcurrente=3,
        protected $username=null,
        protected $password='1234'
    )
    {
        $this->username = $username??strtolower(strtok($nombre, " "));
        $this->log = LogFactory::getLogger();
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param mixed $numero
     */
    public function setNumero($numero): void
    {
        $this->numero = $numero;
    }

    /**
     * @return mixed
     */
    public function getNumSoportesAlquilados()
    {
        return $this->numSoportesAlquilados;
    }

    /**
     * @return mixed
     */
    public function getMaxAlquilerConcurrente()
    {
        return $this->maxAlquilerConcurrente;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param $nombre
     * @return void
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return void
     */
    public function muestraResumen()
    {
        echo "<p>$this->username = <strong>Cliente $this->numero:</strong>$this->nombre<br/>Alquiles actuales: "
            .count($this->soportesAlquilados)."</p>";
    }

    /**
     * @param \Dwes\ProyectoVideoClub\Soporte $s
     * @return bool
     */
    public function tienesAlquilado(Soporte $s):bool
    {
        return isset($this->soportesAlquilados[$s->getNumero()]);
    }

    /**
     * @param int $numSoporte
     * @return mixed
     * @throws \Dwes\ProyectoVideoClub\Util\SoporteNoEncontradoException
     */
    public function retornar(int $numSoporte): mixed
    {
        if ($this->numSoportesAlquilados == 0) {
            $this->log->warning("Client $this->username no te cap soport llogat");
            throw new SoporteNoEncontradoException(
            '<p>Este cliente no tiene alquilado ningún elemento</p>');
        }
        if (isset($this->soportesAlquilados[$numSoporte])) {
            $this->numSoportesAlquilados --;
            $this->soportesAlquilados[$numSoporte]->alquilado = false;
            unset($this->soportesAlquilados[$numSoporte]);
            $this->log->info('Devolució correcta');
            return true;
        }
        $this->log->warning("Client $this->username no te llogat el soport $numSoporte");
        throw new SoporteNoEncontradoException(
        '<p>No se ha podido encontrar el soporte en los alquileres de este cliente</p>');
    }

    /**
     * @return array
     */
    public function getAlquileres()
    {
       return $this->soportesAlquilados;
    }

    /**
     * @return void
     */
    public function listarAlquileres(): void
    {
        echo "El cliente tiene $this->numSoportesAlquilados soportes alquilados.";
        foreach ($this->getAlquileres() as $soporte) {
            $soporte->muestraResumen();
        }

    }

    /**
     * @param \Dwes\ProyectoVideoClub\Soporte $s
     * @return mixed
     * @throws \Dwes\ProyectoVideoClub\Util\CupoSuperadoException
     * @throws \Dwes\ProyectoVideoClub\Util\SoporteYaAlquiladoException
     */
    public function alquilar(Soporte $s):mixed
    {
        if ($this->tienesAlquilado($s)) {
            $this->log->warning("Client $this->username ja el soport llogat");
            throw new
            SoporteYaAlquiladoException("<p>El cliente ya tiene alquilado el soporte <strong $s->titulo </strong</p>");
        }
        if ($this->numSoportesAlquilados >= $this->maxAlquilerConcurrente) {
            $this->log->warning("Client $this->username ja té tots els llogers possibles");
            throw new CupoSuperadoException(
            "<p>Este cliente tiene $this->maxAlquilerConcurrente elementos alquilados. ".
            "No puede alquilar más en este videoclub hasta que no devuelva algo</p>");
        }
        $this->soportesAlquilados[$s->getNumero()] = $s;
        $this->numSoportesAlquilados ++;
        $this->log->info("Llogat soport a: $this->nombre");
        $s->alquilado = true;
        return $this;

    }
}
