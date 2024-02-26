-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-02-2024 a las 17:52:32
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `realstate`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenesinmuebles`
--

CREATE TABLE `imagenesinmuebles` (
  `IdImagen` int(11) NOT NULL,
  `RutaImagen` varchar(255) NOT NULL,
  `IdInmueble` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbladministrador`
--

CREATE TABLE `tbladministrador` (
  `Cedula` int(11) NOT NULL,
  `Nombres` varchar(40) NOT NULL,
  `Correo` varchar(40) NOT NULL,
  `Contraseña` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcategoria`
--

CREATE TABLE `tblcategoria` (
  `IdCategoria` int(11) NOT NULL,
  `Nombres` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblcategoria`
--

INSERT INTO `tblcategoria` (`IdCategoria`, `Nombres`) VALUES
(1, 'Casa'),
(2, 'Apartamento'),
(3, 'Lote'),
(4, 'Finca'),
(5, 'Bodega');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcita`
--

CREATE TABLE `tblcita` (
  `IdCita` int(11) NOT NULL,
  `Dirección` varchar(50) NOT NULL,
  `Fecha` date NOT NULL,
  `Telefono` varchar(12) DEFAULT NULL,
  `codigoc` int(11) NOT NULL,
  `infoinmueble` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblinmueble`
--

CREATE TABLE `tblinmueble` (
  `IdInmueble` int(11) NOT NULL,
  `Precio` varchar(200) NOT NULL,
  `Localidad` varchar(10) NOT NULL,
  `Dirección` varchar(50) NOT NULL,
  `Estrato` int(11) NOT NULL,
  `Area_construida` varchar(20) NOT NULL,
  `NumeroPisos` int(11) DEFAULT NULL,
  `Habitaciones` int(11) DEFAULT NULL,
  `Baños` int(11) DEFAULT NULL,
  `Cocina` int(11) DEFAULT NULL,
  `Garaje` varchar(10) DEFAULT NULL,
  `Patio` varchar(10) DEFAULT NULL,
  `Estudio` varchar(10) DEFAULT NULL,
  `Contacto` varchar(50) NOT NULL,
  `codigoc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblinmueble`
--

INSERT INTO `tblinmueble` (`IdInmueble`, `Precio`, `Localidad`, `Dirección`, `Estrato`, `Area_construida`, `NumeroPisos`, `Habitaciones`, `Baños`, `Cocina`, `Garaje`, `Patio`, `Estudio`, `Contacto`, `codigoc`) VALUES
(1, '8000000', 'los andes', 'cra2341', 3, '324243', 3, 3, 3, 0, 'No', 'No', 'No', '32535765848', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblusuarios`
--

CREATE TABLE `tblusuarios` (
  `IdUsuarios` int(11) NOT NULL,
  `Nombres` varchar(40) NOT NULL,
  `Correo` varchar(40) NOT NULL,
  `Contraseña` varchar(40) NOT NULL,
  `rol` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `imagenesinmuebles`
--
ALTER TABLE `imagenesinmuebles`
  ADD PRIMARY KEY (`IdImagen`),
  ADD KEY `IdInmueble` (`IdInmueble`);

--
-- Indices de la tabla `tbladministrador`
--
ALTER TABLE `tbladministrador`
  ADD PRIMARY KEY (`Cedula`);

--
-- Indices de la tabla `tblcategoria`
--
ALTER TABLE `tblcategoria`
  ADD PRIMARY KEY (`IdCategoria`);

--
-- Indices de la tabla `tblcita`
--
ALTER TABLE `tblcita`
  ADD PRIMARY KEY (`IdCita`);

--
-- Indices de la tabla `tblinmueble`
--
ALTER TABLE `tblinmueble`
  ADD PRIMARY KEY (`IdInmueble`);

--
-- Indices de la tabla `tblusuarios`
--
ALTER TABLE `tblusuarios`
  ADD PRIMARY KEY (`IdUsuarios`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `imagenesinmuebles`
--
ALTER TABLE `imagenesinmuebles`
  MODIFY `IdImagen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tblcategoria`
--
ALTER TABLE `tblcategoria`
  MODIFY `IdCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tblcita`
--
ALTER TABLE `tblcita`
  MODIFY `IdCita` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tblinmueble`
--
ALTER TABLE `tblinmueble`
  MODIFY `IdInmueble` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tblusuarios`
--
ALTER TABLE `tblusuarios`
  MODIFY `IdUsuarios` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `imagenesinmuebles`
--
ALTER TABLE `imagenesinmuebles`
  ADD CONSTRAINT `imagenesinmuebles_ibfk_1` FOREIGN KEY (`IdInmueble`) REFERENCES `tblinmueble` (`IdInmueble`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
