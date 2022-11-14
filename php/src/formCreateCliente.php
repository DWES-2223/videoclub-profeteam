<?php
session_start();
require('./../vendor/autoload.php');
if (!isset($_SESSION['username'])){
    header("Location:index.php");
}
$error = $_SESSION['error']??null;
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
<?php include_once ("main.php");
if ($error){
    echo "<p style='color: red'>$error</p>";
    unset ($_SESSION['error']);
}
?>

<form method="post" action="createCliente.php">
    <div class="form-group row">
        <label for="nombre" class="col-4 col-form-label">Nom</label>
        <div class="col-8">
            <div class="input-group">
                <input id="nombre" name="nombre" placeholder="Escriu el nom" type="text" required="required" class="form-control">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="username" class="col-4 col-form-label">Nom usuari</label>
        <div class="col-8">
            <div class="input-group">
                <input id="username" name="username" placeholder="Escriu el nom d'usuari" type="text" class="form-control">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="password" class="col-4 col-form-label">Password</label>
        <div class="col-8">
            <div class="input-group">
                <input id="password" type="password" name="password" placeholder="Escriu el password"  class="form-control">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="offset-4 col-8">
            <button name="submit" type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
</body>
</html>

