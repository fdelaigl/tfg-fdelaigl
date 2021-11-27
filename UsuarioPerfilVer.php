<?php

ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);
require_once "_com/DAO.php";
if(!DAO::haySesionIniciada()){
    redireccionar("SessionInicioFormulario.php");
}

if(isset($_SESSION["usuario"])){
    $usuarioCliente=$_SESSION["usuario"];
    $resultados=DAO::obtenerJugadorConUsuario($usuarioCliente);
        if ($resultados[0]["fotoDePerfil"] == "NULL"){
            $foto="default.jpg";
        }else{
            $foto=$resultados[0]["fotoDePerfil"];
        }

}else{
    $resultados="";
    redireccionar("SesionInicioFormulario.php");
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Ver perfil</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require_once "parts/imports.php"; ?>
</head>
<body>
<?php require_once "parts/navbarJuego.php"; ?>

<div class="container-main">

<h1>Perfil de <?=$resultados[0]["usuario"]?></h1>
<div class="formulario">
    <img src="uploads/<?=$foto?>" height="150" width="150">
    <p>Usuario : <?=$resultados[0]["usuario"]?></p>
    <p>Nombre : <?=$resultados[0]["nombreJugador"]?></p>
    <p>Apellidos : <?=$resultados[0]["apellidosJugador"]?></p>
    <p>Email : <?=$resultados[0]["email"]?></p>
</div>
<a href='UsuarioCambiarContrasenya.php' style="margin-left: 15px;">Cambiar contraseña</a>
</div>

</body>
</html>


