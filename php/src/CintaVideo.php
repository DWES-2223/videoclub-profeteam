<?php
include_once('Soporte.php');

class CintaVideo extends Soporte
{
    public function __construct($titulo,$numero,$precio,protected $duracion) {
        parent::__construct($titulo,$numero,$precio);
    }

    public function muestraResumen()
    {
        parent::muestraResumen();
        echo "<br>Duracion: ".$this->duracion." minutos";
    }

}