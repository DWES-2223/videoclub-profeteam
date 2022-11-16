<?php
namespace Dwes\ProyectoVideoClub;

/**
 *    Classe per a guardar els Jocs que exten de Suport
 */
class Juego extends Soporte
{
    /**
     * @param $titulo
     * @param $numero
     * @param $precio
     * @param $consola
     * @param $minNumJugadores
     * @param $maxNumJugadores
     */
    public function __construct(
        $titulo,
        $numero,
        $precio,
        protected $consola,
        protected $minNumJugadores,
        protected $maxNumJugadores
    ) {
        parent::__construct($titulo, $numero, $precio);
    }

    /**
     * @return string
     */
    public function muestraJugadoresPosibles()
    {
        $output = "Para ";
        $output .= match (true) {
            $this->minNumJugadores === $this->maxNumJugadores => $this->minNumJugadores,
            default => $this->minNumJugadores.' a '.$this->maxNumJugadores,
        };
        $output.= ($this->maxNumJugadores > 1)?' Jugadores':' Jugador';
        return $output;
    }

    /**
     * @return void
     */
    public function muestraResumen()
    {
        echo "<br>Juego para ".$this->consola;
        parent::muestraResumen();
        echo $this->muestraJugadoresPosibles();
    }

}
