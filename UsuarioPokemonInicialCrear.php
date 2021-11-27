<?php
require_once "_com/DAO.php";

if(isset($_SESSION['usuario'])){
    $usuario = $_SESSION['usuario'];
}else{
    $usuario = $_REQUEST['usuario'];
}

$idPoke = $_REQUEST['idPoke'];
$imagen = $_REQUEST['imagen'];
$nombre = $_REQUEST['nombre'];
$usuarioBdd = DAO::obtenerJugadorConUsuario($usuario);
$idUsuario = $usuarioBdd[0]["id"];
DAO::insertarPokemon($idUsuario,$idPoke,$nombre,$imagen);


if(isset($_SESSION['usuario'])){
    redireccionar("JuegoEquipo.php");
}else{
    redireccionar("SesionInicioFormulario.php");
}
