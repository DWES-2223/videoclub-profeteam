<?php
namespace Dwes\ProyectoVideoClub;

use Dwes\ProyectoVideoClub\Util\CupoSuperadoException;
use Dwes\ProyectoVideoClub\Util\SoporteNoEncontradoException;
use Dwes\ProyectoVideoClub\Util\SoporteYaAlquiladoException;

class Cliente
{
    protected $numSoportesAlquilados = 0;
    protected $soportesAlquilados = array();
    protected $username;
    protected $password;

    public function __construct(protected $nombre, protected $numero, protected $maxAlquilerConcurrente=3)
    {}

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

    public function muestraResumen()
    {
        echo "<p><strong>Cliente $this->numero:</strong>$this->nombre<br/>Alquiles actuales: "
            .count($this->soportesAlquilados)."</p>";
    }

    public function tienesAlquilado(Soporte $s):bool
    {
        return isset($this->soportesAlquilados[$s->getNumero()]);
    }

    public function retornar(int $numSoporte): mixed
    {
        if ($this->numSoportesAlquilados == 0) {
            throw new SoporteNoEncontradoException(
            '<p>Este cliente no tiene alquilado ningún elemento</p>');
        }
        if (isset($this->soportesAlquilados[$numSoporte])) {
            $this->numSoportesAlquilados --;
            $this->soportesAlquilados[$numSoporte]->alquilado = false;
            unset($this->soportesAlquilados[$numSoporte]);
            echo 'Devolución correcta';
            return true;
        }
        throw new SoporteNoEncontradoException(
        '<p>No se ha podido encontrar el soporte en los alquileres de este cliente</p>');
    }

    public function listarAlquileres(): void
    {
        echo "<p>El cliente tiene $this->maxAlquilerConcurrente soporte alquilados.</p>";
        foreach ($this->soportesAlquilados as $soporte) {
            $soporte->muestraResumen();
        }

    }

    public function alquilar(Soporte $s):mixed
    {
        if ($this->tienesAlquilado($s)) {
            throw new
            SoporteYaAlquiladoException("<p>El cliente ya tiene alquilado el soporte <strong $s->titulo </strong</p>");
        }
        if ($this->numSoportesAlquilados >= $this->maxAlquilerConcurrente) {
            throw new CupoSuperadoException(
            "<p>Este cliente tiene $this->maxAlquilerConcurrente elementos alquilados. ".
            "No puede alquilar más en este videoclub hasta que no devuelva algo</p>");
        }
        $this->soportesAlquilados[$s->getNumero()] = $s;
        $this->numSoportesAlquilados ++;
        echo '<p><strong>Alquilado soporte a: </strong>'.$this->nombre.'</p>';
        $s->muestraResumen();
        $s->alquilado = true;
        return $this;

    }
}
