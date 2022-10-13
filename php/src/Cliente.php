<?php
class Cliente
{
    protected $numSoportesAlquilados = 0;
    protected $soportesAlquilados = array();

    public function __construct(protected $nombre,protected $numero,protected $maxAlquilerConcurrente=3) {}

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

    public function muestraResumen(){
        echo $this->nombre.': '.count($this->soportesAlquilados);
    }

    public function tienesAlquilado(Soporte $s):bool{
        return isset($this->soportesAlquilados[$s->getNumero()]);
    }

    public function alquilar(Soporte $s):bool
    {
        if ($this->numSoportesAlquilados >= $this->maxAlquilerConcurrente) {
            echo "No puedes alquilar mas";
            return false;
        }
        if ($this->tienesAlquilado($s)){
            echo $s->muestraResumen().' ya alquilado';
            return false;
        } else {
            $this->soportesAlquilados[$s->getNumero()] = $s;
            $this->numSoportesAlquilados ++;
            return true;
        }
    }
}