<?php
require_once "_com/dao.php";
$pokemon = DAO::pokemonPorId($_REQUEST['id']);
$id = $pokemon[0]['id'];
$jugador = DAO::obtenerJugadorConUsuario($_SESSION['usuario']);
$nivel = ($pokemon[0]['nivel'] + 1);
$fecha = date($jugador[0]['ultEntrenar']);
$horamenos = date("Y-m-d H:i:s", strtotime("-1 hours"));
if ($horamenos > $fecha || $fecha == NULL) {
    echo $id;
    DAO::subirNivel($id, $nivel);
    DAO::actualizarFechaEntrenar();
    redireccionar("JuegoEquipo.php");
} else {
    redireccionar("JuegoEquipo.php?mensaje=hora");
}
