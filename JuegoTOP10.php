<?php
require_once "_com/DAO.php";
$pokemons = DAO::top10Pokemon();

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Top 10</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "parts/imports.php"; ?>
</head>

<body>
    <?php require_once "parts/navbarJuego.php"; ?>
    <div class="container-main">
        <table class='table table-hover tabla-jugadores'>

            <tr>
                <th>Top</th>
                <th>Imagen</th>
                <th>Pokemon</th>
                <th>Usuario</th>
                <th>Nivel</th>
                <th>Numero Pokedex</th>
            </tr>

            <?php
            $top10 = 1;
            foreach ($pokemons as $pokemon) {
                if ($top10 < 11) { ?>
                    <tr>
                        <td>
                            <p><b><?= $top10; ?></b></p>
                        </td>
                        <td>
                            <img src="<?= $pokemon->getImagen(); ?>" height="55px"> 
                        </td>
                        <td>
                            <p class="nombre-poke"><?= $pokemon->getNombre(); ?></p>
                        </td>
                        <td>
                            <a href="JuegoEquipo.php?idJugador=<?= $pokemon->getIdJugador(); ?>" > <?php echo DAO::jugadorObtenerPokemon($pokemon->getIdJugador()); ?></a>
                        </td>
                        <td>
                            <?= $pokemon->getNivel(); ?>
                        </td>
                        <td>
                            <p><?= $pokemon->getNumPoke(); ?></p>
                        </td>
                    </tr>

            <?php }
                $top10++;
            } ?>

        </table>
    </div>
</body>

</html>
<script src="js/main.js"></script>