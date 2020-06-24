-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-06-2020 a las 20:37:14
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `constantesvitalesbd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facultativo`
--

CREATE TABLE `facultativo` (
  `Nombre` varchar(50) NOT NULL,
  `Apellidos` varchar(50) NOT NULL,
  `Dni` varchar(9) NOT NULL,
  `Fechanacimiento` date NOT NULL,
  `Sexo` varchar(10) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Contrasena` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `facultativo`
--

INSERT INTO `facultativo` (`Nombre`, `Apellidos`, `Dni`, `Fechanacimiento`, `Sexo`, `Email`, `Contrasena`) VALUES
('Alberto', 'López García', '12121212L', '1960-05-10', 'Hombre', 'albertolg@gmail.com', '$2y$12$DozjdpuIHhsRKZT7vZ3P5uTGUzmoWWurz5JkVDUjxAy4GCq.9HzHe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `limites`
--

CREATE TABLE `limites` (
  `Limiteglucosas` int(11) NOT NULL DEFAULT 1000,
  `Limiteglucosai` int(11) NOT NULL DEFAULT 0,
  `Limiteoxigenos` int(11) NOT NULL DEFAULT 1000,
  `Limiteoxigenoi` int(11) NOT NULL DEFAULT 0,
  `Limitepulsos` int(11) NOT NULL DEFAULT 1000,
  `Limitepulsoi` int(11) NOT NULL DEFAULT 0,
  `Limitetemperaturas` int(11) NOT NULL DEFAULT 1000,
  `Limitetemperaturai` int(11) NOT NULL DEFAULT 0,
  `Limitetensionaltas` int(11) NOT NULL DEFAULT 1000,
  `Limitetensionaltai` int(11) NOT NULL DEFAULT 0,
  `Limitetensionbajas` int(11) NOT NULL DEFAULT 1000,
  `Limitetensionbajai` int(11) NOT NULL DEFAULT 0,
  `Dniu` varchar(9) NOT NULL,
  `Dnif` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `limites`
--

INSERT INTO `limites` (`Limiteglucosas`, `Limiteglucosai`, `Limiteoxigenos`, `Limiteoxigenoi`, `Limitepulsos`, `Limitepulsoi`, `Limitetemperaturas`, `Limitetemperaturai`, `Limitetensionaltas`, `Limitetensionaltai`, `Limitetensionbajas`, `Limitetensionbajai`, `Dniu`, `Dnif`) VALUES
(1000, 0, 1000, 0, 110, 70, 1000, 0, 1000, 0, 1000, 0, '44666438R', '12121212L');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `Dniu` varchar(9) NOT NULL,
  `Dnif` varchar(9) NOT NULL,
  `Fecha` datetime NOT NULL,
  `Valor` int(11) NOT NULL,
  `Texto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`Dniu`, `Dnif`, `Fecha`, `Valor`, `Texto`) VALUES
('44666438R', '12121212L', '2020-06-23 13:22:00', 60, 'José  Blázquez Sánchez no ha superado el limite mínimo en pulso cardíaco');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tablaunion`
--

CREATE TABLE `tablaunion` (
  `Dnif` varchar(9) NOT NULL,
  `Dniu` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tablaunion`
--

INSERT INTO `tablaunion` (`Dnif`, `Dniu`) VALUES
('12121212L', '44666438R');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Nombre` varchar(30) NOT NULL,
  `Apellidos` varchar(50) NOT NULL,
  `Dni` varchar(9) NOT NULL,
  `Sexo` varchar(10) NOT NULL,
  `Fechanacimiento` date NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Contrasena` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Nombre`, `Apellidos`, `Dni`, `Sexo`, `Fechanacimiento`, `Email`, `Contrasena`) VALUES
('José ', 'Blázquez Sánchez', '44666438R', 'Hombre', '1998-11-10', 'pepillobs@gmail.com', '$2y$12$EutVOi0.oGO/wqZ6DSH8sO5GYABzDxtb6.URzA3aKvLc1dZXdsUJS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `validacion`
--

CREATE TABLE `validacion` (
  `Contraseña` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `validacion`
--

INSERT INTO `validacion` (`Contraseña`) VALUES
('Facultativo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valorglucosa`
--

CREATE TABLE `valorglucosa` (
  `Glucosa` float NOT NULL,
  `Dni` varchar(9) NOT NULL,
  `Toma` datetime NOT NULL,
  `Ubicacion` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `valorglucosa`
--

INSERT INTO `valorglucosa` (`Glucosa`, `Dni`, `Toma`, `Ubicacion`) VALUES
(120, '44666438R', '2020-06-22 11:35:00', 'Centro Salud El Palo'),
(88, '44666438R', '2020-06-23 13:02:00', 'el palo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoroxigeno`
--

CREATE TABLE `valoroxigeno` (
  `Oxigeno` float NOT NULL,
  `Dni` varchar(9) NOT NULL,
  `Toma` datetime NOT NULL,
  `Ubicacion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `valoroxigeno`
--

INSERT INTO `valoroxigeno` (`Oxigeno`, `Dni`, `Toma`, `Ubicacion`) VALUES
(99, '44666438R', '2020-06-22 11:33:00', 'Casa'),
(97, '44666438R', '2020-06-23 13:06:00', 'er palo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valorpulso`
--

CREATE TABLE `valorpulso` (
  `Pulso` float NOT NULL,
  `Dni` varchar(9) NOT NULL,
  `Toma` datetime NOT NULL,
  `Ubicacion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `valorpulso`
--

INSERT INTO `valorpulso` (`Pulso`, `Dni`, `Toma`, `Ubicacion`) VALUES
(85, '44666438R', '2020-06-22 11:29:00', 'Hospital Carlos Haya'),
(60, '44666438R', '2020-06-22 12:02:00', 'CASA JSE'),
(60, '44666438R', '2020-06-22 12:02:01', 'CASA JSE'),
(60, '44666438R', '2020-06-22 12:02:02', 'CASA JSE'),
(60, '44666438R', '2020-06-22 12:02:03', 'CASA JSE'),
(60, '44666438R', '2020-06-22 12:02:04', 'CASA JSE'),
(60, '44666438R', '2020-06-22 12:02:05', 'CASA JSE'),
(120, '44666438R', '2020-06-22 12:03:16', 'Hospital El Ángel'),
(120, '44666438R', '2020-06-22 12:03:17', 'Hospital El Ángel'),
(120, '44666438R', '2020-06-22 12:03:18', 'Hospital El Ángel'),
(120, '44666438R', '2020-06-22 12:03:19', 'Hospital El Ángel'),
(120, '44666438R', '2020-06-22 12:03:20', 'Hospital El Ángel'),
(90, '44666438R', '2020-06-22 12:12:00', 'Casa '),
(120, '44666438R', '2020-06-22 12:34:41', 'Centro Salud El Palo'),
(120, '44666438R', '2020-06-22 12:34:42', 'Centro Salud El Palo'),
(120, '44666438R', '2020-06-22 12:34:43', 'Centro Salud El Palo'),
(120, '44666438R', '2020-06-22 12:34:44', 'Centro Salud El Palo'),
(120, '44666438R', '2020-06-22 12:34:45', 'Centro Salud El Palo'),
(120, '44666438R', '2020-06-22 12:34:46', 'Centro Salud El Palo'),
(120, '44666438R', '2020-06-22 12:34:47', 'Centro Salud El Palo'),
(120, '44666438R', '2020-06-22 12:34:48', 'Centro Salud El Palo'),
(100, '44666438R', '2020-06-22 12:34:49', 'Centro Salud El Palo'),
(100, '44666438R', '2020-06-22 12:34:50', 'Centro Salud El Palo'),
(100, '44666438R', '2020-06-22 12:34:51', 'Centro Salud El Palo'),
(80, '44666438R', '2020-06-22 12:34:52', 'Centro Salud El Palo'),
(80, '44666438R', '2020-06-22 12:34:53', 'Centro Salud El Palo'),
(80, '44666438R', '2020-06-22 12:34:54', 'Centro Salud El Palo'),
(60, '44666438R', '2020-06-22 12:34:55', 'Centro Salud El Palo'),
(60, '44666438R', '2020-06-22 12:34:56', 'Centro Salud El Palo'),
(60, '44666438R', '2020-06-22 12:34:57', 'Centro Salud El Palo'),
(60, '44666438R', '2020-06-22 12:34:58', 'Centro Salud El Palo'),
(60, '44666438R', '2020-06-22 12:34:59', 'Centro Salud El Palo'),
(60, '44666438R', '2020-06-22 12:35:00', 'Centro Salud El Palo'),
(60, '44666438R', '2020-06-22 12:35:01', 'Centro Salud El Palo'),
(60, '44666438R', '2020-06-23 13:22:00', 'er palo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valortemperatura`
--

CREATE TABLE `valortemperatura` (
  `Temperatura` float NOT NULL,
  `Dni` varchar(9) NOT NULL,
  `Toma` datetime NOT NULL,
  `Ubicacion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `valortemperatura`
--

INSERT INTO `valortemperatura` (`Temperatura`, `Dni`, `Toma`, `Ubicacion`) VALUES
(36, '44666438R', '2020-06-22 11:38:00', 'Centro Salud El Palo'),
(37, '44666438R', '2020-06-23 13:12:00', 'er palo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valortension`
--

CREATE TABLE `valortension` (
  `Tensionalta` float NOT NULL,
  `Tensionbaja` float NOT NULL,
  `Dni` varchar(9) NOT NULL,
  `Toma` datetime NOT NULL,
  `Ubicacion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `valortension`
--

INSERT INTO `valortension` (`Tensionalta`, `Tensionbaja`, `Dni`, `Toma`, `Ubicacion`) VALUES
(12, 8, '44666438R', '2020-06-22 11:41:00', 'Centro Salud El Palo'),
(120, 80, '44666438R', '2020-06-23 13:16:00', 'er palo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `facultativo`
--
ALTER TABLE `facultativo`
  ADD PRIMARY KEY (`Dni`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indices de la tabla `limites`
--
ALTER TABLE `limites`
  ADD UNIQUE KEY `Dniu_FK` (`Dniu`),
  ADD UNIQUE KEY `Dnif_FK` (`Dnif`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD KEY `Dniu_FK` (`Dniu`) USING BTREE,
  ADD KEY `Dnif_FK` (`Dnif`) USING BTREE;

--
-- Indices de la tabla `tablaunion`
--
ALTER TABLE `tablaunion`
  ADD KEY `FK_Dni_facultativo` (`Dnif`),
  ADD KEY `FK_Dni_usuario` (`Dniu`) USING BTREE;

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Dni`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indices de la tabla `valorglucosa`
--
ALTER TABLE `valorglucosa`
  ADD KEY `Dni` (`Dni`);

--
-- Indices de la tabla `valoroxigeno`
--
ALTER TABLE `valoroxigeno`
  ADD KEY `Dni` (`Dni`);

--
-- Indices de la tabla `valorpulso`
--
ALTER TABLE `valorpulso`
  ADD KEY `Dni` (`Dni`);

--
-- Indices de la tabla `valortemperatura`
--
ALTER TABLE `valortemperatura`
  ADD KEY `Dni` (`Dni`);

--
-- Indices de la tabla `valortension`
--
ALTER TABLE `valortension`
  ADD KEY `Dni` (`Dni`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `limites`
--
ALTER TABLE `limites`
  ADD CONSTRAINT `limites_ibfk_1` FOREIGN KEY (`Dniu`) REFERENCES `usuario` (`Dni`),
  ADD CONSTRAINT `limites_ibfk_2` FOREIGN KEY (`Dnif`) REFERENCES `facultativo` (`Dni`);

--
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `notificaciones_ibfk_1` FOREIGN KEY (`Dniu`) REFERENCES `usuario` (`Dni`),
  ADD CONSTRAINT `notificaciones_ibfk_2` FOREIGN KEY (`Dnif`) REFERENCES `facultativo` (`Dni`);

--
-- Filtros para la tabla `tablaunion`
--
ALTER TABLE `tablaunion`
  ADD CONSTRAINT `tablaunion_ibfk_1` FOREIGN KEY (`Dnif`) REFERENCES `facultativo` (`Dni`);

--
-- Filtros para la tabla `valorglucosa`
--
ALTER TABLE `valorglucosa`
  ADD CONSTRAINT `valorglucosa_ibfk_1` FOREIGN KEY (`Dni`) REFERENCES `usuario` (`Dni`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `valoroxigeno`
--
ALTER TABLE `valoroxigeno`
  ADD CONSTRAINT `valoroxigeno_ibfk_1` FOREIGN KEY (`Dni`) REFERENCES `usuario` (`Dni`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `valorpulso`
--
ALTER TABLE `valorpulso`
  ADD CONSTRAINT `valorpulso_ibfk_1` FOREIGN KEY (`Dni`) REFERENCES `usuario` (`Dni`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `valortemperatura`
--
ALTER TABLE `valortemperatura`
  ADD CONSTRAINT `valortemperatura_ibfk_1` FOREIGN KEY (`Dni`) REFERENCES `usuario` (`Dni`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `valortension`
--
ALTER TABLE `valortension`
  ADD CONSTRAINT `valortension_ibfk_1` FOREIGN KEY (`Dni`) REFERENCES `usuario` (`Dni`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
