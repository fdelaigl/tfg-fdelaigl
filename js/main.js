const api = "https://pokeapi.co/api/v2/pokemon/";

function findGetParameter(parameterName) {
  var result = null,
    tmp = [];
  location.search
    .substr(1)
    .split("&")
    .forEach(function(item) {
      tmp = item.split("=");
      if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
    });
  return result;
}

const buscarPokemon = async id => {
  try {
    console.log(id);

    const res = await fetch(`https://pokeapi.co/api/v2/pokemon/${id}`);
    const data = await res.json();

    console.log(data);

    const pokemon = {
      img: data.sprites.front_default,
      nombre: data.name,
      id: data.id
    };

    pintarCard(pokemon);
  } catch (error) {
    console.log(error);
  }
};
//Funcion que me pinta el pokemon encontrado
const pintarCard = pokemon => {
  document.getElementById("nombrePokemon").innerHTML = pokemon.nombre;
  document.getElementById("imagenPokemon").setAttribute("src", pokemon.img);
  document.getElementById("idPokemon").innerHTML = pokemon.id;
  document.getElementById("idPoke").setAttribute("value", pokemon.id);
  document.getElementById("imagenPoke").setAttribute("value", pokemon.img);
  document.getElementById("nombrePoke").setAttribute("value", pokemon.nombre);
};

function llamadaAjax(url, parametros, manejadorOK, manejadorError) {
  //TODO PARA DEPURACIÓN: alert("Haciendo ajax a " + url + "\nCon parámetros " + parametros);

  var request = new XMLHttpRequest();

  request.open("POST", url);
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  request.onreadystatechange = function() {
    if (this.readyState == 4 && request.status == 200) {
      manejadorOK(request.responseText);
    }
    if (
      manejadorError != null &&
      request.readyState == 4 &&
      this.status != 200
    ) {
      manejadorError(request.responseText);
    }
  };

  request.send(parametros);
}

function alertasJuego(mensaje, idPoke) {
  if (mensaje == "24") {
    Swal.fire({
      html: "<b>Todavia no han pasado 24 horas...</b>",
      confirmButtonText: "Ok",
      icon: "info",
      confirmButtonColor: "#ff4444",
      position: "bottom",
      backdrop: true,
      allowOutsideClick: false
    });
  }

  if (mensaje == "lleno") {
    Swal.fire({
      html:
        "<b>Tu equipo esta lleno.<br>Puedes liberar un pokemon en esta pestaña</b>",
      confirmButtonText: "Ok",
      icon: "info",
      confirmButtonColor: "#ff4444",
      position: "bottom",
      backdrop: true,
      allowOutsideClick: false
    });
  }

  if (mensaje == "hora") {
    Swal.fire({
      html:
        "<b>Todavia no ha pasado una hora desde que entrenaste por ultima vez.</b>",
      confirmButtonText: "Ok",
      icon: "info",
      confirmButtonColor: "#ff4444",
      position: "bottom",
      backdrop: true,
      allowOutsideClick: false
    });
  }
  if (mensaje == "borrarConfirma") {
    Swal.fire({
      title: "Seguro?",
      text: "Si liberas este pokemon lo perderas para siempre",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, liberalo!",
      cancelButtonText: "No, me equivoque!"
    }).then(result => {
      if (result.value) {
        window.location.href = "JuegoEliminarPokemon.php?idPoke=" + idPoke;
      }
    });
  }

  if (mensaje == "pokeMote") {
    $("h1").remove("#nombre-poke-" + idPoke);
    var input = "<input type='text' id='mote'>";
    $("#nombreMote-" + idPoke).prepend(input);

    $("#mote").click(function() {
      $("#mote").blur(function() {
        var nameMote = $("#mote").val();
        if ($("#mote").val().length >= 1) {
          $.ajax({
            url: "JuegoPonerMote.php",
            type: "POST",
            data: {
              idPoke: idPoke,
              mote: nameMote
            }
          })
            .done(function(respuesta) {
              window.location.href = "JuegoEquipo.php";
            })
            .fail(function() {
              console.log("error");
            });
        } else if ($("#mote").val().length === 0) {
          window.location.href = "JuegoEquipo.php";
        }
      });
    });
  }
}
