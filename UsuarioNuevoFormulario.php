<?php
session_start();
?>

<html>

<head>
    <meta charset='UTF-8'>
    <?php require_once "parts/imports.php"; ?>

</head>



<body>
<?php require_once "parts/navbarRegistro.php"; ?>
    <div class="container-main">
<h1>Crea una nueva cuenta</h1>
<?php if(isset($_SESSION["txt"])){?>
<p><?=$_SESSION["txt"]?></p>
<?php session_unset();}?>
<?php if(isset($_SESSION["cambiarContraseña"])){?>
    <p><?=$_SESSION["cambiarContraseña"]?></p>
    <?php session_unset();}?>
<div class="formulario">
    <form method="post" action="UsuarioNuevoCrear.php" enctype="multipart/form-data">
        <input type="text" name="nombreJugador" placeholder="Introduce tu nombre" required><br><br>
        <input type="text" name="apellidosJugador" placeholder="Introduce tus apellidos"required><br><br>
        <input type="text" name="usuario" placeholder="Introduce tu usuario" required><br><br>
        <input type="email" name="email" placeholder="ejemplo@gmail.com" pattern=".+@gmail.com" required><br><br>
        <input type="password" name="contrasenya" placeholder="Introduce tu contraseña" required><br><br>
        <input type="file" name="fotoDePerfil" accept="image/x-png,image/gif,image/jpeg"><br><br>
        <input type="submit" name="Crear" value="Crear Cuenta" class="btn btn-danger">
    </form>
</div>
<a href="SesionInicioFormulario.php">Ya tengo cuenta...</a>
</div>
</body>

</html>

