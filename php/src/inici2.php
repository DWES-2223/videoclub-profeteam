<?php
require('./../vendor/autoload.php');

use Dwes\ProyectoVideoClub\CintaVideo;
use Dwes\ProyectoVideoClub\Dvd;
use Dwes\ProyectoVideoClub\Juego;
use Dwes\ProyectoVideoClub\Cliente;
use Dwes\ProyectoVideoClub\Util\VideoclubException;

//instanciamos un par de objetos Clientee
$cliente1 = new Cliente("Bruce Wayne", 23);
$cliente2 = new Cliente("Clark Kent", 33);

//mostramos el número de cada cliente creado 
echo "<br>El identificador del cliente 1 es: " . $cliente1->getNumero();
echo "<br>El identificador del cliente 2 es: " . $cliente2->getNumero();

//instancio algunos soportes 
$soporte1 = new CintaVideo("Los cazafantasmas", 23, 3.5, 107);
$soporte2 = new Juego("The Last of Us Part II", 26, 49.99, "PS4", 1, 1);
$soporte3 = new Dvd("Origen", 24, 15, "es,en,fr", "16:9");
$soporte4 = new Dvd("El Imperio Contraataca", 4, 3, "es,en","16:9");

try {
//alquilo algunos soportes
    $cliente1->alquilar($soporte1)->alquilar($soporte2)->alquilar($soporte3);
} catch (VideoclubException $e){
    echo $e->getMessage();
}

try {
//voy a intentar alquilar de nuevo un soporte que ya tiene alquilado
    $cliente1->alquilar($soporte1);
} catch (VideoclubException $e){
    echo $e->getMessage();
}
//el cliente tiene 3 soportes en alquiler como máximo
//este soporte no lo va a poder alquilar
try{
    $cliente1->alquilar($soporte4);
} catch (VideoclubException $e){
    echo $e->getMessage();
}
//este soporte no lo tiene alquilado
try{
    $cliente1->retornar(4);
} catch (VideoclubException $e){
    echo $e->getMessage();
}
//devuelvo un soporte que sí que tiene alquilado
try{
    $cliente1->retornar(2);
} catch (VideoclubException $e){
    echo $e->getMessage();
}
//alquilo otro soporte
try{
    $cliente1->Alquilar($soporte4);
} catch (VideoclubException $e){
    echo $e->getMessage();
}
//listo los elementos alquilados
try{
    $cliente1->listarAlquileres();
} catch (VideoclubException $e){
    echo $e->getMessage();
}
//este cliente no tiene alquileres
try{
    $cliente2->retornar(2);
} catch (VideoclubException $e){
    echo $e->getMessage();
}