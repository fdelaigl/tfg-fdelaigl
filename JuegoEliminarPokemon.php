<?php
require_once "_com/DAO.php";
$id = $_REQUEST['idPoke'];
DAO::elminarPokemonPorId($id);
redireccionar("JuegoEquipo.php");