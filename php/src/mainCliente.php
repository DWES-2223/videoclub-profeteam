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
        <title>Videoclub</title>
    </head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
        crossorigin="anonymous">
    <body>
    <?php include_once ("main.php") ?>
    <?php
        $vc = unserialize($_SESSION['videoclub']);
        $username = $_SESSION['username'];
        $socio = $vc->buscaSocio($username);
        $socio->listarAlquileres();
    ?>
    <a id="perfil" class="btn btn-info" href="formUpdateCliente.php?socio=<?= $username ?>">Modificar Perfil</a>
    </body>
</html>
