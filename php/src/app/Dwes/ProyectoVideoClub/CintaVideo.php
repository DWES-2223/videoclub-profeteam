<?php
namespace Dwes\ProyectoVideoClub;

/**
 *   Classe per a guardar les cintes de video que exten de suport
 */
class CintaVideo extends Soporte
{
    /**
     * @param $titulo
     * @param $numero
     * @param $precio
     * @param $duracion
     */
    public function __construct($titulo, $numero, $precio, protected $duracion)
    {
        parent::__construct($titulo, $numero, $precio);
    }

    /**
     * @return void
     */
    public function muestraResumen()
    {
        parent::muestraResumen();
        echo "<br>Duracion: ".$this->duracion." minutos";
    }
}
