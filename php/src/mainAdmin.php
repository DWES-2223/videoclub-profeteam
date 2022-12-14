<?php
session_start();
require('./../vendor/autoload.php');
use Dwes\ProyectoVideoClub\Videoclub;

if (!isset($_SESSION['username'])){
    header("Location:index.php");
}
?>
<!DOCTYPE>
<html lang="es">
    <head>
        <title>Crear Client</title>
    </head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
        crossorigin="anonymous">
    <body>
    <?php include_once ("main.php") ?>
    <?php
        $vc = unserialize($_SESSION['videoclub']);
        $vc->listarProductos();
        $vc->listarSocios();
    ?>
    <a id="Crear" class="btn btn-primary" href="formCreateCliente.php">Crear nou client</a>
    </body>
</html>
