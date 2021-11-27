<?php
require_once "_com/DAO.php";
$id = $_REQUEST['idPoke'];
$mote = $_REQUEST['mote'];
DAO::pokemonMoteModificar($id,$mote);
redireccionar("JuegoEquipo.php");