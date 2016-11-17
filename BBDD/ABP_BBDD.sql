-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-11-2016 a las 16:41:22
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gimnasio_abp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE `actividad` (
  `idActividad` int(255) NOT NULL,
  `nombreActividad` varchar(50) NOT NULL,
  `descripcionActividad` varchar(500) NOT NULL,
  `plazasActividad` int(50) NOT NULL,
  `idEntrenador` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad_anual`
--

CREATE TABLE `actividad_anual` (
  `idActividad` int(255) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFin` date NOT NULL,
  `diaSemana` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad_eventual`
--

CREATE TABLE `actividad_eventual` (
  `idActividad` int(255) NOT NULL,
  `fechaRealizacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejercicio`
--

CREATE TABLE `ejercicios` (
  `idEjercicio` int(255) NOT NULL,
  `nombreEjercicio` varchar(50) NOT NULL,
  `descripcionEjercicio` varchar(500) NOT NULL,
  `fotoEjercicio` varchar(500) NOT NULL,
  `videoEjercicio` varchar(500) NOT NULL,
  `tipoEjercicio` enum('M','E','C','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participacion`
--

CREATE TABLE `participacion` (
  `idUsuario` int(255) NOT NULL,
  `idActividad` int(255) NOT NULL,
  `fechaParticipacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesion`
--

CREATE TABLE `sesion` (
  `idUsuario` int(255) NOT NULL,
  `idTabla` int(255) NOT NULL,
  `fechaSesion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla`
--

CREATE TABLE `tabla` (
  `idTabla` int(255) NOT NULL,
  `nombreTabla` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_deportistapef`
--

CREATE TABLE `tabla_deportistapef` (
  `idUsuario` int(255) NOT NULL,
  `idTabla` int(255) NOT NULL,
  `indicacionesRiesgo` varchar(500) NOT NULL,
  `anotacionesPersonales` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_deportistatdu`
--

CREATE TABLE `tabla_deportistatdu` (
  `idUsuario` int(255) NOT NULL,
  `idTabla` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_ejercicio`
--

CREATE TABLE `tabla_ejercicio` (
  `idEjercicio` int(255) NOT NULL,
  `idTabla` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(255) NOT NULL,
  `dniUsuario` varchar(50) NOT NULL,
  `nombreUsuario` varchar(50) NOT NULL,
  `apellidoUsuario` varchar(50) NOT NULL,
  `telefonoUsuario` varchar(50) NOT NULL,
  `correoUsuario` varchar(50) NOT NULL,
  `passUsuario` varchar(50) NOT NULL,
  `tipoUsuario` enum('A','D','E') NOT NULL,
  `tipoAbono` enum('TDU','PEF') NOT NULL,
  `fechaRevision` date NOT NULL,
  `anotacionesMedicas` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD PRIMARY KEY (`idActividad`),
  ADD KEY `idEntrenador` (`idEntrenador`);

--
-- Indices de la tabla `actividad_anual`
--
ALTER TABLE `actividad_anual`
  ADD PRIMARY KEY (`idActividad`),
  ADD KEY `idActividad` (`idActividad`);

--
-- Indices de la tabla `actividad_eventual`
--
ALTER TABLE `actividad_eventual`
  ADD PRIMARY KEY (`idActividad`),
  ADD KEY `idActividad` (`idActividad`);

--
-- Indices de la tabla `ejercicio`
--
ALTER TABLE `ejercicio`
  ADD PRIMARY KEY (`idEjercicio`);

--
-- Indices de la tabla `participacion`
--
ALTER TABLE `participacion`
  ADD KEY `idActividad` (`idActividad`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `sesion`
--
ALTER TABLE `sesion`
  ADD KEY `idTabla` (`idTabla`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `tabla`
--
ALTER TABLE `tabla`
  ADD PRIMARY KEY (`idTabla`);

--
-- Indices de la tabla `tabla_deportistapef`
--
ALTER TABLE `tabla_deportistapef`
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idTabla` (`idTabla`);

--
-- Indices de la tabla `tabla_deportistatdu`
--
ALTER TABLE `tabla_deportistatdu`
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idTabla` (`idTabla`);

--
-- Indices de la tabla `tabla_ejercicio`
--
ALTER TABLE `tabla_ejercicio`
  ADD KEY `idTabla` (`idTabla`),
  ADD KEY `idEjercicio` (`idEjercicio`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `dniUsuario` (`dniUsuario`),
  ADD UNIQUE KEY `telefonoUsuario` (`telefonoUsuario`),
  ADD UNIQUE KEY `correoUsuario` (`correoUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividad`
--
ALTER TABLE `actividad`
  MODIFY `idActividad` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ejercicio`
--
ALTER TABLE `ejercicio`
  MODIFY `idEjercicio` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tabla`
--
ALTER TABLE `tabla`
  MODIFY `idTabla` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(255) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD CONSTRAINT `actividad_ibfk_1` FOREIGN KEY (`idEntrenador`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `actividad_anual`
--
ALTER TABLE `actividad_anual`
  ADD CONSTRAINT `actividad_anual_ibfk_1` FOREIGN KEY (`idActividad`) REFERENCES `actividad` (`idActividad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `actividad_eventual`
--
ALTER TABLE `actividad_eventual`
  ADD CONSTRAINT `actividad_eventual_ibfk_1` FOREIGN KEY (`idActividad`) REFERENCES `actividad` (`idActividad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `participacion`
--
ALTER TABLE `participacion`
  ADD CONSTRAINT `participacion_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `participacion_ibfk_2` FOREIGN KEY (`idActividad`) REFERENCES `actividad` (`idActividad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sesion`
--
ALTER TABLE `sesion`
  ADD CONSTRAINT `sesion_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sesion_ibfk_2` FOREIGN KEY (`idTabla`) REFERENCES `tabla` (`idTabla`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tabla`
--
ALTER TABLE `tabla`
  ADD CONSTRAINT `tabla_ibfk_1` FOREIGN KEY (`idTabla`) REFERENCES `tabla_deportistatdu` (`idTabla`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tabla_deportistapef`
--
ALTER TABLE `tabla_deportistapef`
  ADD CONSTRAINT `tabla_deportistapef_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tabla_deportistapef_ibfk_2` FOREIGN KEY (`idTabla`) REFERENCES `tabla` (`idTabla`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tabla_deportistatdu`
--
ALTER TABLE `tabla_deportistatdu`
  ADD CONSTRAINT `tabla_deportistatdu_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tabla_ejercicio`
--
ALTER TABLE `tabla_ejercicio`
  ADD CONSTRAINT `tabla_ejercicio_ibfk_1` FOREIGN KEY (`idEjercicio`) REFERENCES `ejercicio` (`idEjercicio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tabla_ejercicio_ibfk_2` FOREIGN KEY (`idTabla`) REFERENCES `tabla` (`idTabla`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
