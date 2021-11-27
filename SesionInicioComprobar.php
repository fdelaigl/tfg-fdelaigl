<?php
require_once "_com/DAO.php";
//print_r($_SESSION["id"]);
/*Si no hay session iniciada redirigimos a la pagina de Iniciar Session*/

    $id="";
    $nombreJugador="";
    $apellidosJugador="";
    $usuarioJugador=(string)$_REQUEST["usuario"];
    $contrasenyaJugador=(string)$_REQUEST["contrasenya"];

    /* Consultar que el usuario y contrasenna estan en la BDD */
    $resultados= DAO::obtenerJugadorConUsuario($usuarioJugador);

    /*---- Si se ha marcado "Recuerdame" generamos cookie ----*/
    if(isset($_POST["recordar"])){
      // DAO::marcarSesionComoIniciada($resultados);
       DAO::generarCookieRecordar($resultados);
        //redireccionar("ComicListado.php");
    }
    /* SI hay un solo resultado---> Inicio session correcto */
    if(count($resultados)==1 && password_verify($contrasenyaJugador,$resultados[0]["contrasenya"])){
        $idCliente=(int)$resultados[0]["id"];
        $usuarioJugador=(string)$resultados[0]["usuario"];
        $nombreCliente=(string)$resultados[0]["nombreJugador"];
        $apellidosCliente=(string)$resultados[0]["apellidosJugadr"];
        /*--- funcion abajo tmbn redericiona ---*/
       DAO::marcarSesionComoIniciada($resultados);
        redireccionar("JuegoEquipo.php");
    }else{
        $_SESSION["txto"]="El usuario o la contraseña no son correctos";
        redireccionar("SesionInicioFormulario.php");
    }


