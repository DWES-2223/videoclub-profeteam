<?php
include_once('Soporte.php');

class Juego extends Soporte
{
    public function __construct($titulo,$numero,$precio,protected $consola,protected $minNumJugadores,protected $maxNumJugadores) {
        parent::__construct($titulo,$numero,$precio);
    }

    public function muestraJugadoresPosibles(){
        $output = "Para ";
        $output .= match (true){
            $this->minNumJugadores === $this->maxNumJugadores => $this->minNumJugadores,
            default => $this->minNumJugadores.' a '.$this->maxNumJugadores,
        };
        $output.= ($this->maxNumJugadores > 1)?' Jugadores':' Jugador';
        return $output;
    }

    public function muestraResumen()
    {
        echo "<br>Juego para ".$this->consola;
        parent::muestraResumen();
        echo $this->muestraJugadoresPosibles();
    }

}