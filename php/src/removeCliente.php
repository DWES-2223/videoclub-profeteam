<?php
session_start();
require('./../vendor/autoload.php');

use Dwes\ProyectoVideoClub\Util\VideoclubException;
use Dwes\ProyectoVideoClub\Videoclub;

try {
    if ($_SESSION['username'] != 'admin') throw new VideoclubException('No estàs autoritzat');
    extract($_GET);
    $vc = unserialize($_SESSION['videoclub']);
    $soci = $vc->buscaSocio($socio);
    if (!$soci) throw new VideoclubException('Soci no trobat');
    $_SESSION['videoclub'] = serialize($vc->borraSocio($soci->getNumero()));
    header('location:mainAdmin.php');
 } catch (VideoclubException $e){
    echo $e->getMessage();
}
