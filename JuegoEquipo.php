<?php
require_once "_com/DAO.php";
$equipoPropio = false;
if (isset($_GET['idJugador'])) {
  $idJugador = $_GET['idJugador'];
} else {
  $idJugador = $_SESSION['id'];
  $equipoPropio = true;
}
$equipo = DAO::recuperarEquipo($idJugador);

if (!$equipoPropio) {
  $jugador = DAO::obtenerJugadorConId($idJugador);
  $extrañoNombre = $jugador[0]['usuario'];
}
if (DAO::haySesionIniciada() == false) {
  redireccionar("SesionInicioFormulario.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <title>Equipo de <?= $_SESSION['usuario'] ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require_once "parts/imports.php"; ?>
</head>

<body>
  <?php require_once "parts/navbarJuego.php"; ?>
  <div class="container-main">
    <?php if ($equipoPropio) { ?>
      <h1>Equipo de <?= $_SESSION['usuario'] ?></h1>
      <div class="equipo-main">

        <?php

        foreach ($equipo as $pokemon) { ?>
          <div>
            <img src="<?= $pokemon->getImagen(); ?>" alt="" class="border border-danger rounded-circle">
            <div id="nombreMote-<?= $pokemon->getId() ?>">
              <h1 class="nombre-poke" id="nombre-poke-<?= $pokemon->getId() ?>"><?= $pokemon->getNombre() ?></h1>
            </div>
            <p>Numero en pokedex: <?= $pokemon->getNumPoke() ?></p>
            <p>Nivel: <?= $pokemon->getNivel() ?></p>
            <div class="botones">
              <a href="JuegoComprobacionesEntrenar.php?id=<?= $pokemon->getId() ?>" class="btn btn-danger btn-sm btn-block">Entrenar Pokemon</a>
              <a href="JuegoEquipo.php?mensaje=borrarConfirma&idPoke=<?= $pokemon->getId() ?>" class="btn btn-danger btn-sm btn-block">Liberar Pokemon</a>
              <a href="JuegoEquipo.php?mensaje=pokeMote&idPoke=<?= $pokemon->getId() ?>" class="btn btn-danger btn-sm btn-block" id="mote-<?= $pokemon->getId() ?>">Poner un mote Pokemon</a>
            </div>
          </div>

        <?php }
      } else {
        ?>
        <h1>Equipo de <?= $extrañoNombre ?></h1>
        <div class="equipo-main"><?php
                                  foreach ($equipo as $pokemon) { ?>
            <div>
              <img src="<?= $pokemon->getImagen(); ?>" alt="" class="border border-danger rounded-circle">
              <h1 class="nombre-poke"><?= $pokemon->getNombre() ?></h1>
              <p>Numero en pokedex: <?= $pokemon->getNumPoke() ?></p>
              <p>Nivel: <?= $pokemon->getNivel() ?></p>
            </div>

        <?php }
                                }
        ?>
        </div>
      </div>
</body>

</html>
<script src="js/main.js"></script>
<script>
  var mensaje = findGetParameter("mensaje");
  var idPoke = findGetParameter("idPoke");
  alertasJuego(mensaje, idPoke);
</script>