<?php
session_start();
require('./../vendor/autoload.php');

use Dwes\ProyectoVideoClub\Util\VideoclubException;

$vc = unserialize($_SESSION['videoclub']);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    extract($_POST);
    try {
        if (empty($nombre)) {
            throw new VideoclubException("Camp nom buid");
        }
        if (empty($username)) {
            throw new VideoclubException("Camp username buid");
        }
        if (empty($password)) {
            throw new VideoclubException("Camp password buid");
        }
        if ($vc->buscaSocio($username)) {
            throw new VideoclubException("Usuari ja donat d'alta");
        }
        $vc->incluirSocio($nombre,3,$username,$password);
        $_SESSION['videoclub'] = serialize($vc);
        header('Location:mainAdmin.php');
    } catch (VideoclubException $e){
      $_SESSION['error'] = $e->getMessage();
        header('Location:formCreateCliente.php');
  
    }
}

