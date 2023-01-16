-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-01-2023 a las 12:17:20
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdcontable`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categorias` int(11) NOT NULL,
  `Tipo_Inversion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categorias`, `Tipo_Inversion`) VALUES
(1, '[Acciones]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `info_contable`
--

CREATE TABLE `info_contable` (
  `id_contable` int(11) NOT NULL,
  `Fecha` varchar(15) NOT NULL,
  `Detalle` varchar(100) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Comision` int(11) NOT NULL,
  `Importe` int(50) NOT NULL,
  `id_categorias_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `info_contable`
--

INSERT INTO `info_contable` (`id_contable`, `Fecha`, `Detalle`, `Cantidad`, `Comision`, `Importe`, `id_categorias_fk`) VALUES
(2, '0000-00-00', 'Hola', 0, 0, 1200, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categorias`);

--
-- Indices de la tabla `info_contable`
--
ALTER TABLE `info_contable`
  ADD PRIMARY KEY (`id_contable`),
  ADD KEY `fk_contable` (`id_categorias_fk`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categorias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `info_contable`
--
ALTER TABLE `info_contable`
  MODIFY `id_contable` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `info_contable`
--
ALTER TABLE `info_contable`
  ADD CONSTRAINT `fk_contable` FOREIGN KEY (`id_categorias_fk`) REFERENCES `categorias` (`id_categorias`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
