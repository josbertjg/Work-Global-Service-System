-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-06-2024 a las 02:02:24
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
-- Estructura de tabla para la tabla `tbitacoras`
--

CREATE TABLE `tbitacoras` (
  `id` int(11) NOT NULL,
  `modulo` varchar(20) NOT NULL,
  `usuario` varchar(40) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
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
  `orden` varchar(20) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `precioInicial` float NOT NULL,
  `precioFinal` float NOT NULL,
  `pagado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tfacturasobrecargos`
--

CREATE TABLE `tfacturasobrecargos` (
  `id` int(11) NOT NULL,
  `factura` varchar(20) NOT NULL,
  `sobrecargo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tfumigadores`
--

CREATE TABLE `tfumigadores` (
  `cedula` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
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
-- Estructura de tabla para la tabla `tordenes`
--

CREATE TABLE `tordenes` (
  `IdOrdenes` varchar(20) NOT NULL,
  `fechaServicio` date NOT NULL,
  `cliente` varchar(20) NOT NULL,
  `fumigador` varchar(20) NOT NULL,
  `ubicacion` varchar(20) NOT NULL,
  `establecimiento` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tordenesservicios`
--

CREATE TABLE `tordenesservicios` (
  `id` int(11) NOT NULL,
  `orden` varchar(20) NOT NULL,
  `servicio` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tpagodetalles`
--

CREATE TABLE `tpagodetalles` (
  `id` int(11) NOT NULL,
  `factura` varchar(20) NOT NULL,
  `monto` float NOT NULL,
  `descripcion` longtext NOT NULL,
  `referencia` varchar(100) NOT NULL,
  `tipoPago` enum('efectivo','transferencia','pago_movil') NOT NULL,
  `fechaPago` datetime NOT NULL DEFAULT current_timestamp()
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
  `foto` varchar(1000) NOT NULL,
  `descripcion` longtext NOT NULL,
  `habilitado` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tquimicos`
--

INSERT INTO `tquimicos` (`idQuimico`, `nombre`, `foto`, `descripcion`, `habilitado`) VALUES
('InPlCh', 'Insecticida Plagatox', 'assets/img/uploads/images.jpg.jpg', 'Insecticida en Polvo Plagatox\r\npara Chiripas y Cucarachas\r\nuso domestico', 1),
('RaPlP', 'Raticida Plagatox P', 'assets/img/uploads/mug-today-is-a-good-day.jpg.jpg', 'Cebo Raticida marca Plagatox\r\nContenido Neto:150g\r\nUso domestico', 1);

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
-- Estructura de tabla para la tabla `tsobrecargos`
--

CREATE TABLE `tsobrecargos` (
  `idSobrecargo` varchar(20) NOT NULL,
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
  `longitud` varchar(20) NOT NULL,
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
  `telefono` varchar(20) NOT NULL,
  `fotoPerfil` varchar(500) NOT NULL,
  `emailVerificado` tinyint(1) NOT NULL DEFAULT 0,
  `oauth_type` enum('gmail_oauth','account_password','multi_oauth','') NOT NULL,
  `idRol` varchar(10) NOT NULL DEFAULT 'CLWGS1',
  `creado` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tusuarios`
--

INSERT INTO `tusuarios` (`email`, `contraseña`, `nombre`, `apellido`, `telefono`, `fotoPerfil`, `emailVerificado`, `oauth_type`, `idRol`, `creado`, `activo`) VALUES
('josbertjg@gmail.com', '', 'Josbert', 'Guedez', '', 'https://lh3.googleusercontent.com/a/ACg8ocIYxgSVKmpdVhUOFnSf7DM1UbzOGrdaaIBopvTOKnWhhNlccJxZ=s96-c', 1, 'gmail_oauth', 'SAWGS1', '2024-04-30 23:21:27', 1),
('josetimaure60@gmail.com', '', 'Jose', 'Timaure', '', 'https://lh3.googleusercontent.com/a/ACg8ocJRESfHpvaFUA8v242WUFwFuXql-rmQ7fr05Ga-JlrNKARYpGxSeg=s96-c', 1, 'gmail_oauth', 'CLWGS1', '2024-06-05 23:40:12', 1),
('workglobalserviceca@gmail.com', '', 'Josnel', 'Guedez', '', 'https://lh3.googleusercontent.com/a/ACg8ocJ7XYRMlybwZhYlo0ebVr57DV1ETJMQZnJR6vzAX3tkSr0YNQ=s96-c', 1, 'gmail_oauth', 'SAWGS1', '2024-05-01 05:59:41', 1);

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
-- Indices de la tabla `tbitacoras`
--
ALTER TABLE `tbitacoras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario` (`usuario`);

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
  ADD KEY `ordenesServicio` (`orden`);

--
-- Indices de la tabla `tfacturasobrecargos`
--
ALTER TABLE `tfacturasobrecargos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `factura` (`factura`),
  ADD KEY `sobrecargo` (`sobrecargo`);

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
-- Indices de la tabla `tordenes`
--
ALTER TABLE `tordenes`
  ADD PRIMARY KEY (`IdOrdenes`),
  ADD KEY `fumigador` (`fumigador`),
  ADD KEY `ubicacion` (`ubicacion`),
  ADD KEY `cliente` (`cliente`),
  ADD KEY `establecimiento` (`establecimiento`);

--
-- Indices de la tabla `tordenesservicios`
--
ALTER TABLE `tordenesservicios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ordenServicio` (`orden`),
  ADD KEY `servicio` (`servicio`);

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
-- AUTO_INCREMENT de la tabla `tbitacoras`
--
ALTER TABLE `tbitacoras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tfacturasobrecargos`
--
ALTER TABLE `tfacturasobrecargos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tnofiticaciones`
--
ALTER TABLE `tnofiticaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tordenesservicios`
--
ALTER TABLE `tordenesservicios`
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
-- Filtros para la tabla `tbitacoras`
--
ALTER TABLE `tbitacoras`
  ADD CONSTRAINT `tbitacoras_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `tusuarios` (`email`) ON DELETE CASCADE;

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
-- Filtros para la tabla `tfacturas`
--
ALTER TABLE `tfacturas`
  ADD CONSTRAINT `tfacturas_ibfk_1` FOREIGN KEY (`orden`) REFERENCES `tordenes` (`IdOrdenes`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tfacturasobrecargos`
--
ALTER TABLE `tfacturasobrecargos`
  ADD CONSTRAINT `tfacturasobrecargos_ibfk_1` FOREIGN KEY (`factura`) REFERENCES `tfacturas` (`idFactura`) ON DELETE CASCADE,
  ADD CONSTRAINT `tfacturasobrecargos_ibfk_2` FOREIGN KEY (`sobrecargo`) REFERENCES `tsobrecargos` (`idSobrecargo`) ON DELETE CASCADE;

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
-- Filtros para la tabla `tordenes`
--
ALTER TABLE `tordenes`
  ADD CONSTRAINT `tordenes_ibfk_1` FOREIGN KEY (`fumigador`) REFERENCES `tfumigadores` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tordenes_ibfk_3` FOREIGN KEY (`ubicacion`) REFERENCES `tubicaciones` (`idUbicacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tordenes_ibfk_4` FOREIGN KEY (`establecimiento`) REFERENCES `testablecimientos` (`idEstablecimientos`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tordenes_ibfk_5` FOREIGN KEY (`cliente`) REFERENCES `tusuarios` (`email`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tordenesservicios`
--
ALTER TABLE `tordenesservicios`
  ADD CONSTRAINT `tordenesservicios_ibfk_1` FOREIGN KEY (`orden`) REFERENCES `tordenes` (`IdOrdenes`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tordenesservicios_ibfk_2` FOREIGN KEY (`servicio`) REFERENCES `tservicios` (`idServicio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tpagodetalles`
--
ALTER TABLE `tpagodetalles`
  ADD CONSTRAINT `tpagodetalles_ibfk_1` FOREIGN KEY (`factura`) REFERENCES `tfacturas` (`idFactura`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tprecioservicios`
--
ALTER TABLE `tprecioservicios`
  ADD CONSTRAINT `tprecioservicios_ibfk_1` FOREIGN KEY (`establecimiento`) REFERENCES `testablecimientos` (`idEstablecimientos`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tprecioservicios_ibfk_2` FOREIGN KEY (`servicio`) REFERENCES `tservicios` (`idServicio`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tservicios`
--
ALTER TABLE `tservicios`
  ADD CONSTRAINT `tservicios_ibfk_1` FOREIGN KEY (`quimico`) REFERENCES `tquimicos` (`idQuimico`) ON DELETE CASCADE ON UPDATE CASCADE;

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
