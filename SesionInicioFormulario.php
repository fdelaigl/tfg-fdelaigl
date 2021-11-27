<?php
require_once "_com/DAO.php";
/*Si no hay session iniciada redirigimos a la pagina de CONTENIDO PRIADO 1*/

if (DAO::iniciarSessionConCookie()) {
    $usuarioCliente = $_COOKIE["usuarioJugador"];
    $codigoCookie = $_COOKIE["clave"];
    $arrayUsuario = DAO::obtenerJugadorConUsuario($usuarioCliente);
    //generarCookieRecordar($arrayUsuario); // Generar otro codigo cookie nuevo
    DAO::marcarSesionComoIniciada($arrayUsuario); // Canjear la session
} elseif (DAO::haySesionIniciada()) {
    redireccionar("JuegoEquipo.php");
} else {
}

?>




<html>

<head>
    <meta charset='UTF-8'>
    <?php require_once "parts/imports.php"; ?>
</head>



<body>
<?php require_once "parts/navbarRegistro.php"; ?>
    <div class="container-log">
        <h1>Iniciar sesión</h1>
        <?php
        if (isset($_SESSION["txto"])) {
        ?>
            <p><?= $_SESSION["txto"] ?></p>

        <?php
            unset($_SESSION["txto"]);
        }
        ?>
        <?php if (isset($_SESSION["cambiarContraseña"])) { ?>
            <p><?= $_SESSION["cambiarContraseña"] ?></p>
        <?php session_unset();
        } ?>
        <div class="formulario">
            <form method="post" action="SesionInicioComprobar.php">
                <input type="text" name="usuario" placeholder="Introduce tu usuario" required><br><br>
                <input type="password" name="contrasenya" placeholder="Introduce tu contraseña" required><br><br>
                Recuerdame: <input type='checkbox' name='recordar' id='recordar'><br><br>
                <input type="submit" name="Iniciar Session" value="Iniciar Session" class="btn btn-danger">
            </form>
        </div>
        <a href="UsuarioNuevoFormulario.php">Registrarse...</a>
    </div>
</body>

</html>