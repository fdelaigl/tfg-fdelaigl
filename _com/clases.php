<?php
abstract class Dato
{
}

trait Identificable
{
    protected int $id;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }
}

/*----------------- Clase Jugador -------------------*/
class Jugador extends Dato
{
    use Identificable;
    private string $usuario;
    private string $email;
    private string $contrasenya;
    private string $codigoCookie;
    private  $fotoDePerfil;
    private string $nombreJugador;
    private string $apellidosJugador;
    private  $ultCazar;
    private  $ultEntrenar;

    public function __construct(
        int $idJugador,
        string $usuario,
        string $email,
        string $contrasenya,
        string $codigoCookie,
        $fotoDePerfil,
        string $nombreJugador,
        string $apellidosJugador,
        $ultCazar,
        $ultEntrenar
    ) {
        $this->setId($idJugador);
        $this->setUsuario($usuario);
        $this->setEmail($email);
        $this->setContrasenya($contrasenya);
        $this->setCodigoCookie($codigoCookie);
        $this->setFotoDePerfil($fotoDePerfil);
        $this->setNombreJugador($nombreJugador);
        $this->setApellidosJugador($apellidosJugador);
        $this->setUltCazar($ultCazar);
        $this->setUltEntrenar($ultEntrenar);
    }

    /*------------------ Funciones GET de todas la propiedades de Jugador -----------------*/
    public function getUsuario(): string
    {
        return $this->usuario;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function getContrasenya(): string
    {
        return $this->contrasenya;
    }
    public function getCodigoCookie(): string
    {
        return $this->codigoCookie;
    }
    public function getFotoDePerfil()
    {
        return $this->fotoDePerfil;
    }
    public function getNombreJugador(): string
    {
        return $this->nombreJugador;
    }
    public function getApellidosJugador(): string
    {
        return $this->apellidosJugador;
    }
    public function getUltCazar()
    {
        return $this->ultCazar;
    }
    public function getUltEntrenar()
    {
        return $this->ultEntrenar;
    }

    /*------------------ Funciones SET de todas la propiedades de Jugador -----------------*/
    public function setUsuario(string $usuario): void
    {
        $this->usuario = $usuario;
    }
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
    public function setContrasenya(string $contrasenya): void
    {
        $this->contrasenna = $contrasenya;
    }
    public function setCodigoCookie(string $codigoCookie): void
    {
        $this->codigoCookie = $codigoCookie;
    }
    public function setFotoDePerfil($fotoDePerfil): void
    {
        $this->fotoDePerfil = $fotoDePerfil;
    }
    public function setNombreJugador(string $nombreJugador): void
    {
        $this->nombreCliente = $nombreJugador;
    }
    public function setApellidosJugador(string $apellidosJugador): void
    {
        $this->apellidos = $apellidosJugador;
    }

    public function setUltCazar($ultCazar): void
    {
        $this->ultCazar = $ultCazar;
    }
    public function setUltEntrenar($ultEntrenar): void
    {
        $this->ultEntrenar = $ultEntrenar;
    }
}
/*----------------- Clase Pokemon -------------------*/
class Pokemon extends Dato
{
    use Identificable;
    private int $idJugador;
    private int $nivel;
    private string $nombre;
    private string $imagen;

    public function __construct(
        int $id,
        int $numPoke,
        int $idJugador,
        int $nivel,
        string $nombre,
        string $imagen,
    ) {

        $this->setId($id);
        $this->setNumPoke($numPoke);
        $this->setIdJugador($idJugador);
        $this->setNivel($nivel);
        $this->setNombre($nombre);
        $this->setImagen($imagen);
    }

    /*------------------ Funciones GET de todas la propiedades de Pokemon -----------------*/
    public function getNumPoke(): string
    {
        return $this->numPoke;
    }
    public function getIdJugador(): string
    {
        return $this->idJugador;
    }
    public function getNivel(): string
    {
        return $this->nivel;
    }
    public function getNombre(): string
    {
        return $this->nombre;
    }
    public function getImagen(): string
    {
        return $this->imagen;
    }
    /*------------------ Funciones SET de todas la propiedades de Pokemon -----------------*/
    public function setNumPoke(int $numPoke): void
    {
        $this->numPoke = $numPoke;
    }
    public function setIdJugador(int $idJugador): void
    {
        $this->idJugador = $idJugador;
    }
    public function setNivel(int $nivel): void
    {
        $this->nivel = $nivel;
    }
    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }
    public function setImagen(string $imagen): void
    {
        $this->imagen = $imagen;
    }
}
