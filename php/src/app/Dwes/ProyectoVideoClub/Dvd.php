<?php
namespace Dwes\ProyectoVideoClub;


class Dvd extends Soporte
{
    public function __construct($titulo, $numero, $precio, protected $idiomas, protected $formatoPantalla)
    {
        parent::__construct($titulo, $numero, $precio);
    }

    public function muestraResumen()
    {
        parent::muestraResumen();
        echo "<br>Idiomas: ".$this->idiomas;
        echo "<br>Formato de pantalla: ".$this->formatoPantalla;

    }

}
