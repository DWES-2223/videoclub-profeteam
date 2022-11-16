<?php
namespace Dwes\ProyectoVideoClub;

/**
 *   Classe per a guardar els DVD's que exten de suport
 */
class Dvd extends Soporte
{
    /**
     * @param $titulo
     * @param $numero
     * @param $precio
     * @param $idiomas
     * @param $formatoPantalla
     */
    public function __construct($titulo, $numero, $precio, protected $idiomas, protected $formatoPantalla)
    {
        parent::__construct($titulo, $numero, $precio);
    }

    /**
     * @return void
     */
    public function muestraResumen()
    {
        parent::muestraResumen();
        echo "<br>Idiomas: ".$this->idiomas;
        echo "<br>Formato de pantalla: ".$this->formatoPantalla;

    }

}
