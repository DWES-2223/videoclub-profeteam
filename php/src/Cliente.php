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
        echo "<p><strong>Cliente $this->numero:</strong>$this->nombre<br/>Alquiles actuales: ".count($this->soportesAlquilados)."</p>";
    }

    public function tienesAlquilado(Soporte $s):bool{
        return isset($this->soportesAlquilados[$s->getNumero()]);
    }

    public function retornar(int $numSoporte): bool{
        if ($this->numSoportesAlquilados == 0) {
            echo '<p>Este cliente no tiene alquilado ningún elemento</p>';
            return false;
        }
        if (isset($this->soportesAlquilados[$numSoporte])){
            $this->numSoportesAlquilados --;
            unset($this->soportesAlquilados[$numSoporte]);
            echo 'Devolución correcta';
            return true;
        }
        echo '<p>No se ha podido encontrar el soporte en los alquileres de este cliente</p>';
        return false;
    }

    public function listarAlquileres(): void{
        echo "<p>El cliente tiene $this->maxAlquilerConcurrente soporte alquilados.</p>";
        foreach ($this->soportesAlquilados as $soporte){
            $soporte->muestraResumen();
        }

    }

    public function alquilar(Soporte $s):bool
    {
        if ($this->tienesAlquilado($s)) {
            echo '<p>El cliente ya tiene alquilado el soporte <strong'.$s->titulo.'</strong</p>';

            return false;
        }
        if ($this->numSoportesAlquilados >= $this->maxAlquilerConcurrente) {
            echo "<p>Este cliente tiene $this->maxAlquilerConcurrente elementos alquilados. No puede alquilar más en este videoclub hasta que no devuelva algo</p>";
            return false;
        }
        $this->soportesAlquilados[$s->getNumero()] = $s;
        $this->numSoportesAlquilados ++;
        echo '<p><strong>Alquilado soporte a: </strong>'.$this->nombre.'</p>';
        $s->muestraResumen();
        return true;

    }
}