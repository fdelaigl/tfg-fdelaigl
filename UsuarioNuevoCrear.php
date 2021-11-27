<?php
ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);
require_once "_com/DAO.php";

if(isset($_POST["Crear"])){
    if(empty($_POST["usuario"])|| empty($_POST["contrasenya"]) || empty($_POST["nombreJugador"])
        || empty($_POST["apellidosJugador"]) || empty($_POST["email"])){
        $_SESSION["txt"]="¡Asegurate de rellenar todos los campos!";
        redireccionar("UsuarioNuevoFormulario.php");
    }else{
        $emailCliente=(string)$_POST["email"];
        $usuarioCliente=(string)$_POST["usuario"];
        $contrasennaCliente=(string)$_POST["contrasenya"];
        $nombreCliente=(string)$_POST["nombreJugador"];
        $apellidosCliente=(string)$_POST["apellidosJugador"];
        if(isset($_FILES["fotoDePerfil"])){
            $foto= $_FILES["fotoDePerfil"]["name"];
        }else{
            $foto= "NULL";
        }
       // $foto= $_FILES["fotoDePerfilCliente"]["name"];
        $ruta= $_FILES["fotoDePerfil"]["tmp_name"];

        /* CARGAR EL ARRAY CON DATOS*/
        $informacionUsuario= array(
            "usuario"=>$usuarioCliente,
            "contrasenya"=>$contrasennaCliente,
            "email"=>$emailCliente,
            "nombreJugador"=>$nombreCliente,
            "apellidosJugador"=>$apellidosCliente,
            "foto"=>$foto,
            "ruta"=>$ruta
        );

        DAO::crearUsuario($informacionUsuario);


    }
}


