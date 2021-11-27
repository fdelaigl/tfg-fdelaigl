<?php
require_once "_com/DAO.php";
$salida = "";
if (isset($_REQUEST['jugador'])) {
    $jugadores = DAO::obtenerJugadoresBusqueda($_REQUEST['jugador']);
    $salida .= "<br><table class='table table-hover tabla-jugadores''>
    <thead>
    <tr>
    <td>Usuario</td>
    </tr>
    </thead>
    <tbody>";
    if ($jugadores) {
       
        foreach ($jugadores as $jugador) {
            $salida .= "<tr>
                        <td> <a href=JuegoEquipo.php?idJugador=" . $jugador->getId() . ">" . $jugador->getUsuario() . "</a></td>
                        <tr>";
        }

        $salida .= "</tbody></table>";
    }else{
        $salida .= "<tr>
        <td> Ningun usuario con ese nombre</td>
        <tr></tbody></table>";
    }
} else {
    $salida = "<br><p>Busca a tus amigos!</p>";
}




echo $salida;
