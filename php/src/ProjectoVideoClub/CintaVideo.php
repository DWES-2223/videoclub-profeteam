<?php
namespace Dwes\ProjecteVideoClub;

require_once ('Soporte.php');
use Dwes\ProjecteVideoClub\Soporte;

class CintaVideo extends Soporte
{
    public function __construct($titulo, $numero, $precio, protected $duracion)
    {
        parent::__construct($titulo, $numero, $precio);
    }

    public function muestraResumen()
    {
        parent::muestraResumen();
        echo "<br>Duracion: ".$this->duracion." minutos";
    }
}
