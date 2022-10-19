<?php
namespace Dwes\ProyectoVideoClub;


abstract class Soporte implements Resumible
{
    private const IVA = 0.21;
    public $alquilado = false;

    public function __construct(public $titulo, protected $numero, protected $precio)
    {}


    /**
     * @return mixed
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @return mixed
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    public function getPrecioConIVA()
    {
        return $this->getPrecio()+$this->getPrecio()*self::IVA;
    }

    public function muestraResumen()
    {
        echo "<br>".$this->titulo."<br>".$this->getPrecio()." € (IVA no incluido)";
    }
}
