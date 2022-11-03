<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    extract($_POST);
    if (($username === 'admin') && ($password == 'admin') || ($username === 'usuari') && ($password == 'usuari')) {
        $_SESSION['username'] = $username;
        if ($username === 'admin'){
            $vc = include_once("./loadVideoclub.php");
            $_SESSION['videoclub'] = serialize($vc);
            header('Location:mainAdmin.php');
        } else {
            header('Location:mainCliente.php');
        }

    } else {
        header("Location:index.php?acces=$username");
    }
} else {
    header('Location:index.php');
}
