<?php

require_once "_com/clases.php";
require_once "_com/varios.php";


class DAO
{
    private static $pdo = null;

    private static function obtenerPdoConexionBD(): PDO
    {
        $servidor = "localhost";
        $bd = "juegowebpokemon";
        $identificador = "root";
        $contrasenna = "";
        $opciones = [
            PDO::ATTR_EMULATE_PREPARES => false, // Modo emulación desactivado para prepared statements "reales"
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Que los errores salgan como excepciones.
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // El modo de fetch que queremos por defecto.

        ];

        try {
            $pdo = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8", $identificador, $contrasenna, $opciones);
        } catch (Exception $e) {
            error_log("Error al conectar: " . $e->getMessage());
            exit("Error al conectar" . $e->getMessage());
        }

        return $pdo;
    }
    //ERRORES


    public static function anotarCookieEnBDD($codigoCookie, $idUsuario): bool
    {
        $pdo = DAO::obtenerPdoConexionBD();
        if ($codigoCookie == "NULL") {
            $codigoCookie = NULL;
        }
        $sqlSentencia = "UPDATE jugador SET codigoCookie=? WHERE id=?";

        $sqlUpdate = $pdo->prepare($sqlSentencia);
        $sqlUpdate->execute([$codigoCookie, $idUsuario]);
        if ($sqlUpdate->rowCount() == 1) {
            return true;
        } else {
            return false;
        }
    }
    public static function iniciarSessionConCookie(): bool
    {
        if (isset($_COOKIE["usuarioJugador"]) && isset($_COOKIE["clave"])) {
            $usuarioCliente = $_COOKIE["usuarioJugador"];
            $codigoCookie = $_COOKIE["clave"];
            $arrayUsuario = DAO::obtenerJugadorConUsuario($usuarioCliente);
            if ($arrayUsuario && $arrayUsuario[0]["codigoCookie"] == $codigoCookie) {
                DAO::generarCookieRecordar($arrayUsuario);
                return true;
            } else {
                DAO::borrarCookieRecordar($arrayUsuario);
                return false;
            }
        } else {
            return false;
        }
    }

    public static function haySesionIniciada(): bool
    {
        if (isset($_SESSION["usuario"])) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public static function borrarCookieRecordar(array $arrayUsuario)
    {
        $idCliente = $arrayUsuario[0]["id"];
        DAO::anotarCookieEnBDD("NULL", $idCliente);
        // Pedir borrar cookie (setcookie con tiempo time() - negativo...)
        setcookie("identificador", "", time() - 86400);
        setcookie("clave", "", time() - 86400);
    }
    public static function cerrarSesion()
    {
        $resultados = DAO::obtenerJugadorConUsuario($_SESSION["usuario"]);
        DAO::borrarCookieRecordar($resultados);
        session_unset();
        session_destroy();
        redireccionar("SesionInicioFormulario.php");
    }
    public static function generarCookieRecordar(array $arrayUsuario)
    {
        // Creamos un código cookie muy complejo (no necesariamente único).
        $codigoCookie = generarCadenaAleatoria(32); // Random...
        $idCliente = $arrayUsuario[0]["id"];
        // actualizar el codigoCookie en la BDD
        DAO::anotarCookieEnBDD($codigoCookie, $idCliente);
        // anotar la cookie en el navegador
        $usuarioCliente = $arrayUsuario[0]["usuario"];
        $valorCookie = $codigoCookie;
        setcookie("usuarioJugador", $usuarioCliente, time() + 86400);
        setcookie("clave", $valorCookie, time() + 86400);
    }
    public static function marcarSesionComoIniciada($arrayUsuario)
    {
        $_SESSION["id"] = $arrayUsuario[0]["id"];
        $_SESSION["usuario"] = $arrayUsuario[0]["usuario"];
        $_SESSION["nombreJugador"] = $arrayUsuario[0]["nombreJugador"];
        $_SESSION["apellidosJugador"] = $arrayUsuario[0]["apellidosJugador"];
    }

    public static function ejecutarConsultaObtener(string $sql, array $parametros): ?array
    {
        if (!isset(DAO::$pdo)) DAO::$pdo = DAO::obtenerPdoConexionBd();

        $sentencia = DAO::$pdo->prepare($sql);
        $sentencia->execute($parametros);
        $resultado = $sentencia->fetchAll();
        return $resultado;
    }
    public static function ejecutarConsultaActualizar(string $sql, array $parametros): int
    {
        if (!isset(DAO::$pdo)) DAO::$pdo = DAO::obtenerPdoConexionBd();

        $sentencia = DAO::$pdo->prepare($sql);
        $sentencia->execute($parametros);
        return $sentencia->rowCount();
    }

    public static function obtenerJugadorConId(string $id): ?array
    {
        $pdo = DAO::obtenerPdoConexionBD();
        $sql = "SELECT * FROM jugador WHERE id='$id' ";
        $select = $pdo->prepare($sql);
        $select->execute([]);
        $resultados = $select->fetchAll();
        return $resultados;
    }


    public static function obtenerJugadorConUsuario(string $usuario): ?array
    {
        $pdo = DAO::obtenerPdoConexionBD();
        $sql = "SELECT * FROM jugador WHERE usuario='$usuario' ";
        $select = $pdo->prepare($sql);
        $select->execute([]);
        $resultados = $select->fetchAll();
        return $resultados;
    }
    public static function obtenerJugador(string $usuario, string $email): ?array
    {
        $pdo = DAO::obtenerPdoConexionBD();
        $sql = "SELECT * FROM jugador WHERE usuario='$usuario' OR email='$email'";
        $select = $pdo->prepare($sql);
        $select->execute([]);
        $resultados = $select->fetchAll();
        return $resultados;
    }
    public static function obtenerJugadoresBusqueda($usuario)
    {
        $datos = [];
        $rs = self::ejecutarConsultaObtener(
            "SELECT * FROM jugador WHERE usuario LIKE '%$usuario%' ",
            []
        );
        foreach ($rs as $fila) {

            $jugador = self::jugadorCrearDesdeRs($fila);
            array_push($datos, $jugador);
        }

        return $datos;
    }


    public static function guardarImg($usuarioCliente, $foto, $ruta)
    {
        //foto: name del de la foto
        //ruta: ruta temporal
        //usuario: usuario de que vamos a modificar

        $destino = "uploads/$foto";
        move_uploaded_file($ruta, $destino);
        $extension = pathinfo($foto, PATHINFO_EXTENSION);
        if ($foto != "NULL") {
            $nombreNuevo = "$usuarioCliente" . "." . "$extension";
            rename("uploads/$foto", "uploads/" . "$nombreNuevo");
            /*------- Insertar en la BDD ---------*/
            $pdo = DAO::obtenerPdoConexionBD();
            $sqlSentencia = "UPDATE jugador SET fotoDePerfil=? WHERE usuario=?";
            $sqlUpdate = $pdo->prepare($sqlSentencia);
            $sqlUpdate->execute([$nombreNuevo, $usuarioCliente]);
        }
    }
    public static function crearUsuario(array $informacionUsuario)
    {
        $pdo = DAO::obtenerPdoConexionBD();
        /*CRAGAR LOS DATOS DEL ARRAY*/
        $codigoCookie = (string)NULL;
        $nombreJugador = (string)$informacionUsuario["nombreJugador"];
        $apellidosJugador = (string)$informacionUsuario["apellidosJugador"];
        $usuario = (string)$informacionUsuario["usuario"];
        $email = (string)$informacionUsuario["email"];
        $contrasenya = (string)$informacionUsuario["contrasenya"];
        if ($informacionUsuario["foto"]) {
            $foto = $informacionUsuario["foto"];
        } else {
            $foto = "NULL";
        }
        $ruta = $informacionUsuario["ruta"];
        $verificarIdCliente = DAO::obtenerJugador($usuario, $email);

        if (!empty($verificarIdCliente)) {
            $_SESSION["txt"] = "¡ERROR! El usuario o el email introducidos ya existen.";
            redireccionar("UsuarioNuevoFormulario.php");
        } else {
            $sqlSentencia = "INSERT INTO jugador (usuario,email,contrasenya,
                     codigoCookie,fotoDePerfil,nombreJugador,apellidosJugador) VALUES (?,?,?,?,?,?,?)";
            $sqlInsert = $pdo->prepare($sqlSentencia);
            $sqlInsert->execute([
                $usuario, $email, password_hash($contrasenya, PASSWORD_BCRYPT), $codigoCookie, $foto, $nombreJugador, $apellidosJugador
            ]);
            DAO::guardarImg($usuario, $foto, $ruta);
            if ($sqlInsert->rowCount() == 1) {
                $_SESSION["txt"] = "¡La cuenta se ha creado correctamente! Ya pudes iniciar session.";
                redireccionar("UsuarioPokemonInicial.php?usuario=$usuario&email=$email");
            } else {
                $_SESSION["txt"] = "¡ERROR! No se ha podido crear la cuenta, intentalo otra vez.";
                redireccionar("UsuarioNuevoFormulario.php");
            }
        }
    }
    //FIN FUNCION DE CREAR NUEVO USUARIO


    //FINERRORES


    /*--------------------------- FUNCIONES PARA POKEMONS ------------------------------*/
    public static function insertarPokemon($idUsuario, $idPokemon, $nombre, $imagen)
    {
        $pdo = DAO::obtenerPdoConexionBD();
        $sqlSentencia = "INSERT INTO pokemon (numPoke,idJugador,nivel,
        nombre,imagen) VALUES (?,?,?,?,?)";
        $sqlInsert = $pdo->prepare($sqlSentencia);
        $sqlInsert->execute([$idPokemon, $idUsuario, 1, $nombre, $imagen]);
    }
    public static function pokemonPorId($idPokemon)
    {
        $pdo = DAO::obtenerPdoConexionBD();
        $sqlSentencia = "SELECT * FROM pokemon WHERE id=?";
        $sqlInsert = $pdo->prepare($sqlSentencia);
        $sqlInsert->execute([$idPokemon]);
        $resultados = $sqlInsert->fetchAll();
        return $resultados;
    }


    public static function elminarPokemonPorId($idPokemon)
    {
        $pdo = DAO::obtenerPdoConexionBD();
        DAO::ejecutarConsultaActualizar("DELETE FROM pokemon WHERE id=?",[$idPokemon]);
        
    }
    public static function jugadorObtenerPokemon($id): string
    {
        $rs = self::ejecutarConsultaObtener(
            "SELECT usuario FROM jugador WHERE id=?",
            [$id]
        );
        return $rs[0]["usuario"];
    }

    public static function top10Pokemon(): array
    {
        $datos = [];
        $rs = self::ejecutarConsultaObtener(
            "SELECT * FROM pokemon ORDER BY nivel DESC",
            []
        );

        foreach ($rs as $fila) {
            $pokemon = self::pokemonCrearDesdeRs($fila);
            array_push($datos, $pokemon);
        }

        return $datos;
    }


    public static function subirNivel($id, $nivel)
    {
        $pdo = DAO::obtenerPdoConexionBD();

        $sqlSentencia = "UPDATE pokemon SET nivel=? WHERE id=?";

        $sqlUpdate = $pdo->prepare($sqlSentencia);
        $sqlUpdate->execute([$nivel, $id]);
    }


    public static function recuperarEquipo($usuarioJugador)
    {
        $datos = [];
        $rs = self::ejecutarConsultaObtener(
            "SELECT * FROM pokemon WHERE idJugador='$usuarioJugador' ",
            []
        );
        foreach ($rs as $fila) {

            $pokemon = self::pokemonCrearDesdeRs($fila);
            array_push($datos, $pokemon);
        }

        return $datos;
    }
    public static function pokemonMoteModificar($idPoke,$mote): bool
    {
        $sql = "UPDATE pokemon SET nombre=? WHERE id=?";
        $parametros = [$mote,$idPoke];
        return $datosNoModificados = DAO::ejecutarConsultaActualizar($sql, $parametros);
    }

    private static function pokemonCrearDesdeRs(array $fila): Pokemon
    {
        return new Pokemon($fila['id'], $fila['numPoke'], $fila["idJugador"], $fila["nivel"], $fila["nombre"], $fila["imagen"]);
    }
    private static function jugadorCrearDesdeRs(array $fila): Jugador
    {
        return new Jugador($fila['id'], $fila['usuario'], $fila["email"], $fila["contrasenya"], $fila["codigoCookie"], $fila["fotoDePerfil"], $fila["nombreJugador"], $fila["apellidosJugador"], $fila["ultCazar"], $fila["ultEntrenar"]);
    }

    public static function actualizarFechaCaza()
    {
        $hoy = date('Y-m-d H:i:s');
        $pdo = DAO::obtenerPdoConexionBD();

        $sqlSentencia = "UPDATE jugador SET ultCazar=? WHERE usuario=?";

        $sqlUpdate = $pdo->prepare($sqlSentencia);
        $sqlUpdate->execute([$hoy, $_SESSION['usuario']]);
    }

    public static function actualizarFechaEntrenar()
    {
        $hoy = date('Y-m-d H:i:s');
        $pdo = DAO::obtenerPdoConexionBD();

        $sqlSentencia = "UPDATE jugador SET ultEntrenar=? WHERE usuario=?";

        $sqlUpdate = $pdo->prepare($sqlSentencia);
        $sqlUpdate->execute([$hoy, $_SESSION['usuario']]);
    }
    public static function chatObtener()
    {
        $pdo = DAO::obtenerPdoConexionBD();
        $date = date("Y-m-d", time() - 60 * 60 * 24);
        $sql = "SELECT * FROM chat  WHERE fecha >= NOW() - INTERVAL 1 DAY ORDER BY id ASC";
        $ejecutar = $pdo->prepare($sql);
        $ejecutar->execute();
        $filas = $ejecutar->fetchAll();
        return $filas;
    }

    public static function chatInsertar()
    {
        $pdo = DAO::obtenerPdoConexionBD();
        $nombre = $_SESSION["usuario"];
        $mensaje = $_REQUEST["mensaje"];
        $sql = "INSERT INTO chat (usuario, mensaje) VALUES (?,?)";
        $ejecutar = $pdo->prepare($sql);
        $ejecutar->execute([$nombre, $mensaje]);
    }
}
