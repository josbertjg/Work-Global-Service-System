-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-05-2024 a las 21:59:52
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
-- Base de datos: `workglobalservice`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `taccesos`
--

CREATE TABLE `taccesos` (
  `idAcceso` varchar(20) NOT NULL,
  `rol` varchar(20) NOT NULL,
  `permiso` varchar(20) NOT NULL,
  `modulo` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcalendarios`
--

CREATE TABLE `tcalendarios` (
  `cedula` varchar(20) NOT NULL,
  `inicioHora` time NOT NULL,
  `finHora` time NOT NULL,
  `diaInicio` varchar(20) NOT NULL,
  `diaFin` varchar(20) NOT NULL,
  `exepcion` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tciudades`
--

CREATE TABLE `tciudades` (
  `idCiudad` varchar(20) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tclientes`
--

CREATE TABLE `tclientes` (
  `cedula` varchar(20) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `testablecimientos`
--

CREATE TABLE `testablecimientos` (
  `idEstablecimientos` varchar(20) NOT NULL,
  `descripcion` longtext NOT NULL,
  `tamaño` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `testado`
--

CREATE TABLE `testado` (
  `idEstado` varchar(20) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tfacturas`
--

CREATE TABLE `tfacturas` (
  `idFactura` varchar(20) NOT NULL,
  `ordenesServicio` varchar(20) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `precioInicial` float NOT NULL,
  `precioFinal` float NOT NULL,
  `tipoPago` varchar(20) NOT NULL,
  `pagado` tinyint(1) NOT NULL,
  `referencia` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tfumigadores`
--

CREATE TABLE `tfumigadores` (
  `cedula` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `idUbicacion` varchar(20) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `imagenCedula` varchar(20) NOT NULL,
  `activo` tinyint(4) NOT NULL,
  `fechaValidado` date NOT NULL,
  `fotoPerfil` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmodulos`
--

CREATE TABLE `tmodulos` (
  `idModulo` varchar(20) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `estatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tnofiticaciones`
--

CREATE TABLE `tnofiticaciones` (
  `id` int(11) NOT NULL,
  `descripcion` longtext NOT NULL,
  `status` varchar(20) NOT NULL,
  `usuario` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tordenesservicios`
--

CREATE TABLE `tordenesservicios` (
  `IdOrdenesServicio` varchar(20) NOT NULL,
  `fechaServicio` date NOT NULL,
  `cliente` varchar(20) NOT NULL,
  `fumigador` varchar(20) NOT NULL,
  `sobrecargo` varchar(20) NOT NULL,
  `ubicacion` varchar(20) NOT NULL,
  `establecimiento` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tpagodetalles`
--

CREATE TABLE `tpagodetalles` (
  `id` int(11) NOT NULL,
  `factura` varchar(20) NOT NULL,
  `monto` float NOT NULL,
  `descripcion` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tpermisos`
--

CREATE TABLE `tpermisos` (
  `idPermiso` varchar(20) NOT NULL,
  `nombrePermisos` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tprecioservicios`
--

CREATE TABLE `tprecioservicios` (
  `id` int(11) NOT NULL,
  `servicio` varchar(20) NOT NULL,
  `establecimiento` varchar(20) NOT NULL,
  `precio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tquimicos`
--

CREATE TABLE `tquimicos` (
  `idQuimico` varchar(20) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `foto` varchar(20) NOT NULL,
  `descripcion` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `troles`
--

CREATE TABLE `troles` (
  `IdRol` varchar(10) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `troles`
--

INSERT INTO `troles` (`IdRol`, `nombre`, `status`) VALUES
('CLWGS1', 'Cliente', 1),
('FGWGS1', 'Fumigador', 1),
('SAWGS1', 'Super Administrador', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tservicios`
--

CREATE TABLE `tservicios` (
  `idServicio` varchar(20) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `quimico` varchar(20) NOT NULL,
  `precio` float NOT NULL,
  `descripcion` longtext NOT NULL,
  `habilitado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tservicios/ordenesservicio`
--

CREATE TABLE `tservicios/ordenesservicio` (
  `id` int(11) NOT NULL,
  `ordenServicio` varchar(20) NOT NULL,
  `servicio` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tsobrecargos`
--

CREATE TABLE `tsobrecargos` (
  `idSobrecargo` int(11) NOT NULL,
  `precio` float NOT NULL,
  `descripcion` longtext NOT NULL,
  `factura` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tubicaciones`
--

CREATE TABLE `tubicaciones` (
  `idUbicacion` varchar(20) NOT NULL,
  `latitud` varchar(20) NOT NULL,
  `altitud` varchar(20) NOT NULL,
  `direccion` longtext NOT NULL,
  `ciudad` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tusuarios`
--

CREATE TABLE `tusuarios` (
  `email` varchar(40) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `fotoPerfil` varchar(500) NOT NULL,
  `emailVerificado` tinyint(1) NOT NULL DEFAULT 0,
  `oauth_type` enum('gmail_oauth','account_password','multi_oauth','') NOT NULL,
  `idRol` varchar(10) NOT NULL,
  `creado` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tusuarios`
--

INSERT INTO `tusuarios` (`email`, `contraseña`, `nombre`, `apellido`, `fotoPerfil`, `emailVerificado`, `oauth_type`, `idRol`, `creado`, `activo`) VALUES
('josbertjg@gmail.com', '', 'Josbert', 'Guedez', 'https://lh3.googleusercontent.com/a/ACg8ocIYxgSVKmpdVhUOFnSf7DM1UbzOGrdaaIBopvTOKnWhhNlccJxZ=s96-c', 1, 'gmail_oauth', 'SAWGS1', '2024-04-30 23:21:27', 1),
('workglobalserviceca@gmail.com', '', 'Josnel', 'Guedez', 'https://lh3.googleusercontent.com/a/ACg8ocJ7XYRMlybwZhYlo0ebVr57DV1ETJMQZnJR6vzAX3tkSr0YNQ=s96-c', 1, 'gmail_oauth', 'SAWGS1', '2024-05-01 05:59:41', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `taccesos`
--
ALTER TABLE `taccesos`
  ADD PRIMARY KEY (`idAcceso`),
  ADD KEY `rol` (`rol`,`permiso`,`modulo`),
  ADD KEY `permiso` (`permiso`),
  ADD KEY `modulo` (`modulo`);

--
-- Indices de la tabla `tcalendarios`
--
ALTER TABLE `tcalendarios`
  ADD UNIQUE KEY `cedula` (`cedula`);

--
-- Indices de la tabla `tciudades`
--
ALTER TABLE `tciudades`
  ADD PRIMARY KEY (`idCiudad`),
  ADD KEY `estado` (`estado`);

--
-- Indices de la tabla `tclientes`
--
ALTER TABLE `tclientes`
  ADD PRIMARY KEY (`cedula`),
  ADD KEY `email` (`email`) USING BTREE;

--
-- Indices de la tabla `testablecimientos`
--
ALTER TABLE `testablecimientos`
  ADD PRIMARY KEY (`idEstablecimientos`);

--
-- Indices de la tabla `testado`
--
ALTER TABLE `testado`
  ADD PRIMARY KEY (`idEstado`);

--
-- Indices de la tabla `tfacturas`
--
ALTER TABLE `tfacturas`
  ADD PRIMARY KEY (`idFactura`),
  ADD KEY `ordenesServicio` (`ordenesServicio`);

--
-- Indices de la tabla `tfumigadores`
--
ALTER TABLE `tfumigadores`
  ADD PRIMARY KEY (`cedula`),
  ADD KEY `email` (`email`),
  ADD KEY `idUbicacion` (`idUbicacion`);

--
-- Indices de la tabla `tmodulos`
--
ALTER TABLE `tmodulos`
  ADD PRIMARY KEY (`idModulo`);

--
-- Indices de la tabla `tnofiticaciones`
--
ALTER TABLE `tnofiticaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `tordenesservicios`
--
ALTER TABLE `tordenesservicios`
  ADD PRIMARY KEY (`IdOrdenesServicio`),
  ADD KEY `fumigador` (`fumigador`),
  ADD KEY `sobrecargo` (`sobrecargo`),
  ADD KEY `ubicacion` (`ubicacion`),
  ADD KEY `cliente` (`cliente`),
  ADD KEY `establecimiento` (`establecimiento`);

--
-- Indices de la tabla `tpagodetalles`
--
ALTER TABLE `tpagodetalles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `factura` (`factura`);

--
-- Indices de la tabla `tpermisos`
--
ALTER TABLE `tpermisos`
  ADD PRIMARY KEY (`idPermiso`);

--
-- Indices de la tabla `tprecioservicios`
--
ALTER TABLE `tprecioservicios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `servicio` (`servicio`),
  ADD KEY `establecimiento` (`establecimiento`);

--
-- Indices de la tabla `tquimicos`
--
ALTER TABLE `tquimicos`
  ADD PRIMARY KEY (`idQuimico`);

--
-- Indices de la tabla `troles`
--
ALTER TABLE `troles`
  ADD PRIMARY KEY (`IdRol`);

--
-- Indices de la tabla `tservicios`
--
ALTER TABLE `tservicios`
  ADD PRIMARY KEY (`idServicio`),
  ADD KEY `Quimico` (`quimico`);

--
-- Indices de la tabla `tservicios/ordenesservicio`
--
ALTER TABLE `tservicios/ordenesservicio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ordenServicio` (`ordenServicio`),
  ADD KEY `servicio` (`servicio`);

--
-- Indices de la tabla `tsobrecargos`
--
ALTER TABLE `tsobrecargos`
  ADD PRIMARY KEY (`idSobrecargo`),
  ADD KEY `factura` (`factura`);

--
-- Indices de la tabla `tubicaciones`
--
ALTER TABLE `tubicaciones`
  ADD PRIMARY KEY (`idUbicacion`),
  ADD UNIQUE KEY `ciudad` (`ciudad`);

--
-- Indices de la tabla `tusuarios`
--
ALTER TABLE `tusuarios`
  ADD PRIMARY KEY (`email`),
  ADD KEY `idRol` (`idRol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tnofiticaciones`
--
ALTER TABLE `tnofiticaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tpagodetalles`
--
ALTER TABLE `tpagodetalles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tprecioservicios`
--
ALTER TABLE `tprecioservicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tservicios/ordenesservicio`
--
ALTER TABLE `tservicios/ordenesservicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tsobrecargos`
--
ALTER TABLE `tsobrecargos`
  MODIFY `idSobrecargo` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `taccesos`
--
ALTER TABLE `taccesos`
  ADD CONSTRAINT `taccesos_ibfk_1` FOREIGN KEY (`permiso`) REFERENCES `tpermisos` (`idPermiso`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `taccesos_ibfk_2` FOREIGN KEY (`rol`) REFERENCES `troles` (`IdRol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `taccesos_ibfk_3` FOREIGN KEY (`modulo`) REFERENCES `tmodulos` (`idModulo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tcalendarios`
--
ALTER TABLE `tcalendarios`
  ADD CONSTRAINT `tcalendarios_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `tfumigadores` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tciudades`
--
ALTER TABLE `tciudades`
  ADD CONSTRAINT `tciudades_ibfk_1` FOREIGN KEY (`estado`) REFERENCES `testado` (`idEstado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tclientes`
--
ALTER TABLE `tclientes`
  ADD CONSTRAINT `tclientes_ibfk_1` FOREIGN KEY (`email`) REFERENCES `tusuarios` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tfacturas`
--
ALTER TABLE `tfacturas`
  ADD CONSTRAINT `tfacturas_ibfk_1` FOREIGN KEY (`ordenesServicio`) REFERENCES `tordenesservicios` (`IdOrdenesServicio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tfumigadores`
--
ALTER TABLE `tfumigadores`
  ADD CONSTRAINT `tfumigadores_ibfk_1` FOREIGN KEY (`email`) REFERENCES `tusuarios` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tfumigadores_ibfk_2` FOREIGN KEY (`idUbicacion`) REFERENCES `tubicaciones` (`idUbicacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tnofiticaciones`
--
ALTER TABLE `tnofiticaciones`
  ADD CONSTRAINT `tnofiticaciones_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `tusuarios` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tordenesservicios`
--
ALTER TABLE `tordenesservicios`
  ADD CONSTRAINT `tordenesservicios_ibfk_1` FOREIGN KEY (`fumigador`) REFERENCES `tfumigadores` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tordenesservicios_ibfk_2` FOREIGN KEY (`cliente`) REFERENCES `tclientes` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tordenesservicios_ibfk_3` FOREIGN KEY (`ubicacion`) REFERENCES `tubicaciones` (`idUbicacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tordenesservicios_ibfk_4` FOREIGN KEY (`establecimiento`) REFERENCES `testablecimientos` (`idEstablecimientos`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tpagodetalles`
--
ALTER TABLE `tpagodetalles`
  ADD CONSTRAINT `tpagodetalles_ibfk_1` FOREIGN KEY (`factura`) REFERENCES `tfacturas` (`idFactura`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tprecioservicios`
--
ALTER TABLE `tprecioservicios`
  ADD CONSTRAINT `tprecioservicios_ibfk_1` FOREIGN KEY (`establecimiento`) REFERENCES `testablecimientos` (`idEstablecimientos`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tservicios`
--
ALTER TABLE `tservicios`
  ADD CONSTRAINT `tservicios_ibfk_1` FOREIGN KEY (`quimico`) REFERENCES `tquimicos` (`idQuimico`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tservicios/ordenesservicio`
--
ALTER TABLE `tservicios/ordenesservicio`
  ADD CONSTRAINT `tservicios/ordenesservicio_ibfk_1` FOREIGN KEY (`ordenServicio`) REFERENCES `tordenesservicios` (`IdOrdenesServicio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tservicios/ordenesservicio_ibfk_2` FOREIGN KEY (`servicio`) REFERENCES `tservicios` (`idServicio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tsobrecargos`
--
ALTER TABLE `tsobrecargos`
  ADD CONSTRAINT `tsobrecargos_ibfk_1` FOREIGN KEY (`factura`) REFERENCES `tordenesservicios` (`IdOrdenesServicio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tubicaciones`
--
ALTER TABLE `tubicaciones`
  ADD CONSTRAINT `tubicaciones_ibfk_1` FOREIGN KEY (`ciudad`) REFERENCES `tciudades` (`idCiudad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tusuarios`
--
ALTER TABLE `tusuarios`
  ADD CONSTRAINT `tusuarios_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `troles` (`IdRol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
