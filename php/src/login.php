<?php
require('./../vendor/autoload.php');

use Dwes\ProyectoVideoClub\Videoclub;

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    extract($_POST);
    $vc = isset($_SESSION['videoclub'])?unserialize($_SESSION['videoclub']):include_once("loadVideoclub.php");

    if (($username === 'admin') && ($password == 'admin')) {
        $_SESSION['username'] = $username;
        $_SESSION['videoclub'] = serialize($vc);
        header('Location:mainAdmin.php');
    } else {
        $socio = $vc->buscaSocio($username);
        if ($socio && $password === $socio->getPassword()){
            $_SESSION['username'] = $socio->getUserName();
            $_SESSION['videoclub'] = serialize($vc);
            header('Location:mainCliente.php');
        } else {
            header("Location:index.php?acces=$username");
        }
    }
} else {
    header('Location:index.php');
}
