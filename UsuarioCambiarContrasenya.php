<?php
require_once "_com/DAO.php";
if (!DAO::haySesionIniciada()) {
    redireccionar("SessionInicioFormulario.php");
}
if (isset($_POST["guardar"])) {
    $usuarioACtual = $_SESSION["usuario"];
    $resultados = DAO::obtenerJugadorConUsuario($usuarioACtual);
    $contraActual = $_POST["actual"];
    $contraNueva = $_POST["nueva"];
    $contraConfirmar = $_POST["confirmar"];
    //TODO: Mover esto a dao
    if (
        password_verify($contraActual, $resultados[0]["contrasenya"])
        && $contraNueva == $contraConfirmar
    ) {

        $sql = "UPDATE jugador SET contrasenya=? WHERE usuario=?";
        $contraNueva = password_hash($contraNueva, PASSWORD_BCRYPT);

        if (DAO::ejecutarConsultaActualizar($sql, [$contraNueva, $usuarioACtual]) == 1) {
            $_SESSION["cambiarContraseña"] = "La contraseña se ha actualizado correctamente";
            redireccionar("SesionCerrar.php");
        } else {
            $_SESSION["cambiarContraseña"] = "La contraseña no se ha actualizado correctamente";
            redireccionar("UsuarioCambiarContrasenna.php");
        }
    } else {
        $_SESSION["cambiarContraseña"] = "La contraseña no se ha actualizado correctamente";
        redireccionar("UsuarioCambiarContrasenna.php");
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Cambiar contraseña</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "parts/imports.php"; ?>
</head>

<body>
    <?php require_once "parts/navbarJuego.php"; ?>
    <div class="container-main">
        <?php if (isset($_SESSION["cambiarContraseña"])) { ?>
            <p><?= $_SESSION["cambiarContraseña"] ?></p>
        <?php session_unset();
        } ?>

        <form action="UsuarioCambiarContrasenya.php" method="post">
            <label>Contraseña Actual</label> <input type="text" name="actual" placeholder="Contraseña actual" required><br><br>
            <label>Contraseña Nueva</label> <input type="password" name="nueva" placeholder="Contraseña nueva" required><br><br>
            <label>Confirmar Contraseña</label> <input type="password" name="confirmar" placeholder="Confirmar contraseña" required><br><br>
            <input type="submit" name="guardar" value="Guardar Cambios" class="btn btn-danger">
        </form>
    </div>
</body>

</html>