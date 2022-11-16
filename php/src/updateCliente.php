<?php
session_start();
require('./../vendor/autoload.php');

use Dwes\ProyectoVideoClub\Util\VideoclubException;
use Dwes\ProyectoVideoClub\Videoclub;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    extract($_POST);
    $vc = unserialize($_SESSION['videoclub']);
    try {
        $updateSocio = $vc->buscaSocio($oldname);
        $socio = $vc->buscaSocio($username);
        if ($socio && $updateSocio != $socio){
            throw new VideoclubException("Usuari ja donat d'alta");
        }
        if (!empty($nombre) && $updateSocio->getNombre() != $nombre) {
            $updateSocio->setNombre($nombre);
        }
        if (!empty($username) && $updateSocio->getUserName() != $username) {
            $updateSocio->setUserName($username);
        }
        if (!empty($password) && $updateSocio->getPassword() != $password) {
            $updateSocio->setPassword($password);
        }
        $_SESSION['videoclub'] = serialize($vc);
        if ($_SESSION['username'] == 'admin'){
            header('Location:mainAdmin.php');
        } else {
            $_SESSION['username'] = $username;
            header('Location:mainCliente.php');
        }
    } catch (VideoclubException $e){
      $_SESSION['error'] = $e->getMessage();
        header("Location:formUpdateCliente.php?socio=$oldname");
    }
}
