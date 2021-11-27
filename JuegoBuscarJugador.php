<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Buscar jugador</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "parts/imports.php"; ?>
</head>

<body>
    <?php require_once "parts/navbarJuego.php"; ?>
    <div class="container-main">
        <h1>Busqueda de jugadores</h1>
        <div class="row justify-content-center">
            <div class="col-4">
                <label for="Jugador">Jugador: </label>
                <input type="text" class="form-control input-sm" id="buscarJugador" name="Jugador" width="30px">
            </div>
        </div>
        <div id="tabla-jugador">
        </div>
    </div>
</body>

</html>
<script src="js/main.js"></script>
<script>
$(buscar_datos());
function buscar_datos(jugador){
    $.ajax({
        url: 'BusquedaJugadores.php',
        type: 'POST',
        dataType: 'html',
        data: {jugador: jugador},
    })
    .done(function(respuesta){
        $("#tabla-jugador").html(respuesta);
    })
    .fail(function(){
        console.log("error")
    })
}

$(document).on('keyup','#buscarJugador', function(){
var valor = $(this).val();
if(valor != ""){
    buscar_datos(valor);
}else{
    buscar_datos();
}
});
</script>