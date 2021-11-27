<?php
$usuario = $_REQUEST['usuario'];
$email = $_REQUEST['email'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Comienza tu aventura</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "parts/imports.php"; ?>
</head>

<body>
    <?php require_once "parts/navbarRegistro.php"; ?>
    <div class="container-main">
        <h1>Comienza la aventura</h1>
        <p>¡Hola! ¡Éste es el mundo de Pokémon!  ¡Este mundo está habitado por unas criaturas llamadas Pokémon!
             Para algunos, los Pokémon son mascotas. Pero otros los usan para pelear. En cuanto a mí... 
             Estudio a los Pokémon como profesión. Déjame pensar... ¡
             Ah, sí! ¡Te pedí que vinieras! Espera... ¡<?=$usuario?>, toma! ¡Aquí hay tres Pokémon! ¡Bien! ¡Están dentro de las Poké Balls! ¡Cuando yo era joven, era un buen entrenador de Pokémon!
                  Pero ahora sólo me quedan tres. Te daré uno. 
                  ¿Cuál quieres?</p>
        <div class="equipo-incial">
            <div id="bulbasaur">
                <form action="UsuarioPokemonInicialCrear.php" method="post">
                    <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/1.png">
                    <input type="hidden" name="imagen" value="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/1.png">
                    <h1>Bulbasaur</h1>
                    <input type="hidden" name="idPoke" value="1">
                    <input type="hidden" name="nombre" value="bulbasaur">
                    <input type="hidden" name="usuario" value="<?= $usuario ?>">
                    <input type="hidden" name="email" value="<?= $email ?>">
                    <input type="submit" value="Elegir" class="btn btn-danger">
                </form>
            </div>
            <div id="charmander">
                <form action="UsuarioPokemonInicialCrear.php" method="post">
                    <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/4.png">
                    <input type="hidden" name="imagen" value="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/4.png">
                    <h1>Charmander</h1>
                    <input type="hidden" name="idPoke" value="4">
                    <input type="hidden" name="nombre" value="charmander">
                    <input type="hidden" name="usuario" value="<?= $usuario ?>">
                    <input type="hidden" name="email" value="<?= $email ?>">
                    <input type="submit" value="Elegir" class="btn btn-danger">
                </form>
            </div>
            <div id="squirtle">
                <form action="UsuarioPokemonInicialCrear.php" method="post">
                    <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/7.png">
                    <input type="hidden" name="imagen" value="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/7.png">
                    <h1>Squirtle</h1>
                    <input type="hidden" name="idPoke" value="7">
                    <input type="hidden" name="nombre" value="Squirtle">
                    <input type="hidden" name="usuario" value="<?= $usuario ?>">
                    <input type="hidden" name="email" value="<?= $email ?>">
                    <input type="submit" value="Elegir" class="btn btn-danger">
                </form>
            </div>
        </div>
    </div>
</body>

</html>