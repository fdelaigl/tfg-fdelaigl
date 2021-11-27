-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-06-2021 a las 18:25:32
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `juegowebpokemon`
--
CREATE DATABASE IF NOT EXISTS `juegowebpokemon` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `juegowebpokemon`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat`
--

DROP TABLE IF EXISTS `chat`;
CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(45) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(45) NOT NULL,
  `mensaje` varchar(1000) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `chat`
--

INSERT INTO `chat` (`id`, `usuario`, `mensaje`, `fecha`) VALUES
(4, 'Ferky', 'Hola', '2021-05-31 16:54:02'),
(5, 'Ferky', 'Hola', '2021-05-31 16:54:11'),
(6, 'Ferky', 'Hola', '2021-05-31 16:55:59'),
(7, 'Ferky', 'Hola', '2021-05-31 16:56:41'),
(8, 'Ferky', 'Hola', '2021-05-31 16:58:40'),
(9, 'Ferky', 'Que tal?', '2021-05-31 16:58:47'),
(10, 'Ferky', 'Que tal?', '2021-05-31 16:59:06'),
(11, 'Ferky', 'Que tal?', '2021-05-31 16:59:42'),
(12, 'f', 'Hola', '2021-05-31 17:01:13'),
(13, 'Ferky', 'Que tal?\r\n', '2021-05-31 17:01:25'),
(15, 'Ferky', 'jajajajaja\r\n', '2021-05-31 17:01:35'),
(16, 'Ferky', '', '2021-05-31 17:02:41'),
(17, 'Ferky', 'Hola', '2021-05-31 17:06:54'),
(18, 'Ferky', 'Hola', '2021-05-31 17:07:11'),
(19, 'Ferky', '', '2021-05-31 17:07:15'),
(20, 'Ferky', '', '2021-05-31 17:08:06'),
(21, 'Ferky', '', '2021-05-31 17:08:47'),
(22, '1', 'Hello', '2021-06-01 10:52:49'),
(23, '1', '', '2021-06-01 10:52:49'),
(24, '1', '', '2021-06-01 10:53:09'),
(25, 'm', 'Hello', '2021-06-01 11:33:04'),
(26, 'Ferky', 'hola', '2021-06-09 12:51:30'),
(27, 'Proyecto', 'Acabo de capturar un Charizard\r\n', '2021-06-12 13:09:23'),
(28, 'Ferky', 'Lo tengo hace 2 semanas\r\n', '2021-06-12 13:09:43');



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pokemon`
--

DROP TABLE IF EXISTS `pokemon`;
CREATE TABLE IF NOT EXISTS `pokemon` (
  `id` int(45) NOT NULL AUTO_INCREMENT,
  `numPoke` int(100) NOT NULL,
  `idJugador` int(3) NOT NULL,
  `nivel` int(3) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk` (`idJugador`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pokemon`
--

INSERT INTO `pokemon` (`id`, `numPoke`, `idJugador`, `nivel`, `nombre`, `imagen`) VALUES
(1, 65, 28, 9, 'Alakazam', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/65.png'),
(2, 1, 29, 1, 'bulbasaur', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/1.png'),
(3, 4, 30, 2, 'charmander', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/4.png'),
(4, 16, 30, 1, 'pidgey', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/16.png'),
(5, 4, 32, 2, 'charmander', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/4.png'),
(6, 6, 32, 1, 'charizard', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/6.png'),
(7, 4, 33, 2, 'Charmander', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/4.png'),
(8, 128, 33, 5, 'Tauros', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/128.png'),
(11, 4, 34, 1, 'charmander', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/4.png'),
(12, 1, 35, 1, 'bulbasaur', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/1.png'),
(13, 4, 36, 1, 'charmander', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/4.png'),
(14, 4, 37, 1, 'charmander', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/4.png'),
(15, 1, 38, 1, 'bulbasaur', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/1.png'),
(16, 4, 39, 1, 'charmander', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/4.png'),
(17, 150, 28, 4, 'Cabezon', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/150.png'),
(18, 30, 33, 1, 'Nidorine', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/30.png'),
(19, 28, 28, 1, 'sandslash', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/28.png'),
(21, 145, 28, 2, 'zapdos', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/145.png'),
(22, 4, 40, 3, 'Proyecto Final', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/4.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugador`
--

DROP TABLE IF EXISTS `jugador`;
CREATE TABLE IF NOT EXISTS `jugador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `contrasenya` varchar(80) NOT NULL,
  `codigoCookie` varchar(45) NOT NULL,
  `fotoDePerfil` varchar(45) NOT NULL,
  `nombreJugador` varchar(45) NOT NULL,
  `apellidosJugador` varchar(45) NOT NULL,
  `ultCazar` datetime DEFAULT NULL,
  `ultEntrenar` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `jugador`
--

INSERT INTO `jugador` (`id`, `usuario`, `email`, `contrasenya`, `codigoCookie`, `fotoDePerfil`, `nombreJugador`, `apellidosJugador`, `ultCazar`, `ultEntrenar`) VALUES
(23, 'a', 'a@gmail.com', '$2y$10$0kInkl9EvjasTvqI8n0Ml.b4JCAWHp8Xybyvm.fNLETO6ztybIXXy', '', 'a.jpg', 'a', 'a', '2021-05-31 17:41:23', NULL),
(24, 'b', 'b@gmail.com', '$2y$10$OQTed120kce3TxIFjTLCAunX07ATYsc5vj4X1hNpMhuRhPSU5lGYu', '', 'NULL', 'b', 'b', '2021-05-31 17:41:23', NULL),
(25, 'q', 'q@gmail.com', '$2y$10$k0TcVlaH3JM9C9MUdRm/uOt24LEK1wspHaOPy35oJjaVvuLldOSKe', '', 'q.jpg', 'q', 'q', '2021-05-31 17:41:23', NULL),
(26, 'h', 'h@gmail.com', '$2y$10$Qz0sCKvmswWjcuBDEISSteaR7trXRxuDhCF7.zIe8WkW9Od4PEVr6', '', 'NULL', 'h', 'h', '2021-05-31 17:41:23', NULL),
(27, 'f', 'f@gmail.com', '$2y$10$J7ZgrxJfFSLV9Az4liHr7.4jEyTwOxGG/Lyk.CI0aCaB88yHMf/Q2', '0wPsGL5j27k7t3qewMkx8JPvCXDO9zcO', 'NULL', 'f', 'f', '2021-05-31 17:41:23', NULL),
(28, 'Ferky', 'ferky@gmail.com', '$2y$10$doiovklqljmUm58jfAxl5OO2FNRWKLIqsMQ4vsLwvA4Z.PireD5P2', '', 'Ferky.jpg', 'Fernando', 'de la Iglesia', '2021-06-11 18:55:57', '2021-06-11 19:57:07'),
(29, 'l', 'l@gmail.com', '$2y$10$q5czsifmlp9oaggUMEfgJey2Faro8jiqTXICf.zUuk/2r/qasH8Um', '', 'NULL', 'l', 'l', '2021-05-31 19:24:27', NULL),
(30, 'noe', 'noe@gmail.com', '$2y$10$/MVACinP9M/.uTqBaInRQ.VaM9f/GVxoNNdFnTnVUCgGTUavDYjba', '', 'noe.jpg', 'Noe', 'Noe noe', '2021-06-01 12:37:17', '2021-06-01 12:38:40'),
(31, 'e', 'e@gmail.com', '$2y$10$rsDBbfIz.nJybKvfDL20R.R98Cie7imcbghU9PXZidu3FHaaP2RAm', '', 'NULL', 'e', 'e', '2021-06-01 12:46:36', NULL),
(32, '1', '1@gmail.com', '$2y$10$bLt.zEh4pYhZBPMySMWTq.C9ZcYjuYTO7uALNfux8GFHiRH/pvnZ2', '', 'NULL', '1', '1', '2021-06-01 12:52:28', '2021-06-01 12:52:20'),
(33, 'm', 'm@gmail.com', '$2y$10$s45qDTtz02cZKTEjcdAtOOQvQdCsipNjcHL8Dr7fq8kS3hGNlrreW', '', 'NULL', 'm', 'm', '2021-06-08 22:42:03', '2021-06-09 09:23:49'),
(34, 'jose', 'jose@gmail.com', '$2y$10$sTCR9Uf98Jk6m0tDRwckMuKbG/VcB4dl6EpeeoOGT5Z9vXdFQRu5m', '', 'NULL', 'jose', 'jose', NULL, NULL),
(35, 'Roge', 'Roge@gmail.com', '$2y$10$pqAGgUKTRhOuPlFXCIP1JeM9.ivZaXqiwjXd8L1kU/nChUQhOjoei', '', 'NULL', 'Roge', 'Roge', NULL, NULL),
(36, 'Julieta', 'f2wqe@gmail.com', '$2y$10$qNRkTwm7dqWKn4udaHRsrO/Kwt715x/jMC4dMlo1WxkIbpzaxiP1.', '', 'NULL', 'Julieta', 'Julieta', NULL, NULL),
(37, 'er', 'er@gmail.com', '$2y$10$HItkcxGMmMXd7CWsRh0qo.AquzFlA2JjcSju/DtdZQqOqMzfoMMwC', '', 'NULL', 'er', 'er', NULL, NULL),
(38, 'et', 'et@gmail.com', '$2y$10$DLruUHZPAG9/Ey43or50JOiU2rMm7CpsaG3ZdORDOMx6M7nmOvHTe', '', 'NULL', 'et', 'et', NULL, NULL),
(39, 'ew', 'ew@gmail.com', '$2y$10$dqOwKeMvbgcmTcXg.JMUXuZ7AQHnD3c1h09.wgOv985V.D3paFBKS', '', 'NULL', 'ew', 'ew', NULL, NULL),
(40, 'Proyecto', 'proyecto@gmail.com', '$2y$10$5MBgaDRDUk1mwUbo5.gD.e0kzc0Ody1YuN4512CBYLuVsMTXCDFuu', 'P63suc8e7CsFYqiE4rdzsq0TmkoUOmnD', 'Proyecto.png', 'Proyecto', 'Final', '2021-06-12 10:17:32', '2021-06-13 18:24:47');


--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pokemon`
--
ALTER TABLE `pokemon`
  ADD CONSTRAINT `fk` FOREIGN KEY (`idJugador`) REFERENCES `jugador` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
