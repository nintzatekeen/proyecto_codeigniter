-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-11-2020 a las 11:14:10
-- Versión del servidor: 5.7.14
-- Versión de PHP: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `automoviles`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alquiler`
--

CREATE TABLE `alquiler` (
  `id` int(11) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `idautomovil` int(11) NOT NULL,
  `fecha_desde` datetime NOT NULL,
  `fecha_hasta` datetime NOT NULL,
  `seguro` tinyint(4) NOT NULL,
  `precio_final` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alquiler`
--

INSERT INTO `alquiler` (`id`, `idcliente`, `idautomovil`, `fecha_desde`, `fecha_hasta`, `seguro`, `precio_final`) VALUES
(26, 8, 3, '2020-11-20 11:08:22', '2020-11-30 11:08:22', 1, 2340),
(27, 8, 11, '2020-11-20 11:08:22', '2020-11-27 11:08:22', 1, 2457);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `automovil`
--

CREATE TABLE `automovil` (
  `id` int(11) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `matricula` varchar(10) NOT NULL,
  `anio` int(4) NOT NULL,
  `combustible` varchar(20) NOT NULL,
  `precio_base_dia` float NOT NULL,
  `devuelto` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `automovil`
--

INSERT INTO `automovil` (`id`, `marca`, `modelo`, `matricula`, `anio`, `combustible`, `precio_base_dia`, `devuelto`) VALUES
(1, 'Nissan', 'Skyline GTR', '0001ABC', 2004, 'gasolina', 350, 1),
(3, 'Mazda', 'RX7', '0002ABC', 1990, 'gasolina', 200, 0),
(5, 'Toyota', 'GR Supra', '0003ABC', 2019, 'gasolina', 200, 1),
(7, 'Honda', 'Civic Type R', '0004ABC', 2018, 'gasolina', 150, 1),
(9, 'Mitsubishi', 'Lancer Evolution X', '0005ABC', 2015, 'gasolina', 300, 1),
(11, 'Subaru', 'Impreza STI', '0006ABC', 2007, 'gasolina', 300, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `dni` varchar(9) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(400) NOT NULL,
  `email` varchar(100) NOT NULL,
  `premium` tinyint(4) NOT NULL,
  `cuenta_bancaria` varchar(23) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `nombre`, `dni`, `username`, `password`, `email`, `premium`, `cuenta_bancaria`) VALUES
(5, 'Demetrio Cansalmas', '01010101F', 'dimitri', '9572ed433aba2aa4c00183bae68fb135aea6b717385b1c2efd0295511794bdc239c5ed7e24a55a96334825ee63547411482a0dad548b54f593b6a38633eace28TLJ6ZoxlhJy65flZyc+jCTm9ZM1yjRYuyV20syjJi1Q=', 'nintzatekeen3@gmail.com', 0, 'ES000000000000000000000'),
(6, 'admin', '00000000A', 'admin', '85f9c6b6c2e96b719d766bed81d9ad774222700c76c8f6102958bad2b98d00ec2b82f52892f5d05cc4f8e5e68a58b774d671cbd68c2ac308d4d5ac550dd85f14oV8x6UClfOVq1cBES68GBfrkaPh5K2TG3Kxg9Hx/+dY=', '09iker05@gmail.com', 0, 'ES000000000000000000000'),
(7, 'Pepe Livingstone', '00000002B', 'peponsio', 'e2087f71e4c46433c89003f1d52a309527ec6f971f6b08420e3f3a979f5c84ee7e681efacddf1a99b8cfca8e6960d4339c9470676e13c5873338a35ae1d2379ebcgHPm6fRgKr8ScCrRCoSzHCorysg1jRPhweKumjYxA=', 'nintzatekeen@gmail.com', 0, 'ES000000000000000000000'),
(8, 'Paco Peluca', '00000003C', 'peluka_modric', '488e6d3db9dae2ea00c2c9abc5d238b645eacac51d24c430b1aec892898f7919e6d685e80c7658396ac9f2d413c1f040a32717ccddcb6e75bfeec36fb73a1dadlF7FYvrLnMUDWGSY9Z+HsIS1nX/FY4q07D2dpR31RKs=', 'nintzatekeen2@gmail.com', 1, 'ES000000000000000000000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `id` int(11) NOT NULL,
  `idautomovil` int(11) NOT NULL,
  `imagen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`id`, `idautomovil`, `imagen`) VALUES
(1, 1, 'img/skyline1.jpg'),
(2, 1, 'img/skyline2.jpg'),
(3, 1, 'img/skyline3.jpg'),
(4, 1, 'img/skyline4.jpg'),
(5, 1, 'img/skyline5.jpg'),
(6, 7, 'img/civic.jpg'),
(7, 7, 'img/civic1.jpg'),
(8, 9, 'img/evo.jpg'),
(9, 9, 'img/evo1.jpg'),
(10, 9, 'img/evo2.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alquiler`
--
ALTER TABLE `alquiler`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idcliente` (`idcliente`),
  ADD KEY `idautomovil` (`idautomovil`);

--
-- Indices de la tabla `automovil`
--
ALTER TABLE `automovil`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idautomovil` (`idautomovil`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alquiler`
--
ALTER TABLE `alquiler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT de la tabla `automovil`
--
ALTER TABLE `automovil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alquiler`
--
ALTER TABLE `alquiler`
  ADD CONSTRAINT `alquiler_ibfk_1` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `alquiler_ibfk_2` FOREIGN KEY (`idautomovil`) REFERENCES `automovil` (`id`);

--
-- Filtros para la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD CONSTRAINT `imagenes_ibfk_1` FOREIGN KEY (`idautomovil`) REFERENCES `automovil` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
