<?php
require_once "_com/dao.php";
$equipo = DAO::recuperarEquipo($_SESSION['id']);
$contadorEquipo = 0;
$jugador = DAO::obtenerJugadorConUsuario($_SESSION['usuario']);
$fecha = date($jugador[0]['ultCazar']);
$fecha_actual = date('Y-m-d H:i:s');
$ayer =  date('Y-m-d H:i:s', strtotime($fecha_actual . "- 1 days"));
// TODO: Funcion para comprobar que ha pasado una hora PARA SUBIR NIVEL
//   $horamenos = date("Y-m-d H:i:s", strtotime("-1 hours"));
//   echo $horamenos;
foreach ($equipo as $pokemon) {
    $contadorEquipo++;
}

if ($contadorEquipo >= 6) {
    redireccionar("JuegoEquipo.php?mensaje=lleno");
} else {
    if ($ayer > $fecha || $fecha == NULL) {
        DAO::actualizarFechaCaza();
    } else {
        redireccionar("JuegoEquipo.php?mensaje=24");
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Zona de caza</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "parts/imports.php"; ?>
</head>

<body>
    <?php require_once "parts/navbarJuego.php"; ?>
    <div class="container-main">
        <img id="imagenPokemon">
        <h1 id="nombrePokemon"></h1>
        <p>Numero en la pokedex: </p>
        <p id="idPokemon"></p>
        <form id="pokeCaza" action="UsuarioPokemonInicialCrear.php" method="post">
            <input type="hidden" name="idPoke" id="idPoke">
            <input type="hidden" name="imagen" id="imagenPoke">
            <input type="hidden" name="nombre" id="nombrePoke">

        </form>
        <button class="btn btn-danger" onclick="capturar()">Capturar</button>
    </div>
</body>

</html>
<script src="js/main.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        var randomNumber = Math.floor(Math.random() * 151 + 1);
        buscarPokemon(randomNumber);
    });

    function capturar() {
        var porcentajeHuida = Math.floor(Math.random() * 100 + 1);
        var porcentajeCaptura = Math.floor(Math.random() * 100 + 1);
        var form = document.getElementById("pokeCaza");

        if (porcentajeHuida < 70) {
            Swal.fire({
                text: '<?= $_SESSION['usuario'] ?> tira una pokeball...',
                confirmButtonText: 'Vamos!',
                confirmButtonColor: '#ff4444'
            }).then(function() {
                if (porcentajeCaptura > 70) {
                    Swal.fire({
                        text: 'La pokeball fallo!',
                        confirmButtonText: 'Intentar de nuevo',
                        confirmButtonColor: '#ff4444'
                    })
                } else {
                    Swal.fire({
                        text: 'Capturaste al pokemon',
                        confirmButtonText: 'Vamos!',
                        confirmButtonColor: '#ff4444'
                    }).then(function() {
                        form.submit();
                    });
                }
            });
        } else {
            Swal.fire({
                text: 'El pokemon escapo..',
                confirmButtonText: 'Ups..',
                confirmButtonColor: '#ff4444'
            }).then(function() {
                window.location.href = "JuegoEquipo.php";
            });

        }
    }
</script>