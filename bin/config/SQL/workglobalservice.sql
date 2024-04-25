-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-04-2024 a las 12:54:05
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
-- Estructura de tabla para la tabla `banco`
--

CREATE TABLE `banco` (
  `IdBanco` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `idCiudad` varchar(25) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `estado` varchar(25) NOT NULL,
  `creado` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `idEstado` varchar(25) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `pais` varchar(25) NOT NULL,
  `creado` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `idFactura` varchar(25) NOT NULL,
  `idOrden` varchar(25) NOT NULL,
  `fecha` date NOT NULL,
  `precioFinal` float NOT NULL,
  `pagado` tinyint(1) NOT NULL,
  `tipoPago` varchar(25) NOT NULL,
  `referencia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fumigador`
--

CREATE TABLE `fumigador` (
  `cedula` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `telefono` varchar(25) NOT NULL,
  `inicioHora` time NOT NULL,
  `finHora` time NOT NULL,
  `idUbicacion` varchar(25) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `fotoPerfil` mediumblob NOT NULL,
  `imagenCedula` mediumblob NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `fechaValidado` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `idModulo` varchar(25) NOT NULL,
  `acceso` tinyint(1) NOT NULL,
  `tipoPermiso` varchar(25) NOT NULL,
  `rol` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenservicio`
--

CREATE TABLE `ordenservicio` (
  `idOrden` varchar(25) NOT NULL,
  `usuario` varchar(40) NOT NULL,
  `fumigador` varchar(40) NOT NULL,
  `fechaServicio` date NOT NULL,
  `sobrecargo` float NOT NULL,
  `descripcionSobrecargo` longtext NOT NULL,
  `Ubicacion` varchar(25) NOT NULL,
  `vivienda` varchar(25) NOT NULL,
  `creado` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagomovil`
--

CREATE TABLE `pagomovil` (
  `idPago` varchar(25) NOT NULL,
  `banco` int(11) NOT NULL,
  `referencia` int(11) NOT NULL,
  `cedulaTitular` varchar(25) NOT NULL,
  `fecha` date NOT NULL,
  `comprobado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `idPais` varchar(25) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `creado` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `quimicos`
--

CREATE TABLE `quimicos` (
  `idQuimico` varchar(25) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `descripcion` longtext NOT NULL,
  `creado` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `IdRol` varchar(25) NOT NULL,
  `rol` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `idServicio` varchar(25) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `precio` float NOT NULL,
  `descripcion` longtext NOT NULL,
  `idQuimico` varchar(25) NOT NULL,
  `creado` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `habilitado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio/ordenservicio`
--

CREATE TABLE `servicio/ordenservicio` (
  `id` int(11) NOT NULL,
  `idservicio` varchar(25) NOT NULL,
  `idOrdenServicio` varchar(25) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacion`
--

CREATE TABLE `ubicacion` (
  `idUbicacion` varchar(25) NOT NULL,
  `latitud` varchar(25) NOT NULL,
  `altitud` varchar(25) NOT NULL,
  `direccion` longtext NOT NULL,
  `ciudad` varchar(25) NOT NULL,
  `creado` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `email` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `apellido` varchar(40) NOT NULL,
  `idRol` varchar(40) NOT NULL,
  `creado` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vivienda`
--

CREATE TABLE `vivienda` (
  `idVivienda` varchar(25) NOT NULL,
  `precioBase` float NOT NULL,
  `descripcion` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `banco`
--
ALTER TABLE `banco`
  ADD PRIMARY KEY (`IdBanco`);

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`idCiudad`),
  ADD KEY `estado` (`estado`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`idEstado`),
  ADD KEY `pais` (`pais`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`idFactura`),
  ADD KEY `idOrden` (`idOrden`,`referencia`),
  ADD KEY `referencia` (`referencia`);

--
-- Indices de la tabla `fumigador`
--
ALTER TABLE `fumigador`
  ADD PRIMARY KEY (`cedula`),
  ADD KEY `email` (`email`,`idUbicacion`),
  ADD KEY `idUbicacion` (`idUbicacion`);

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD KEY `rol` (`rol`);

--
-- Indices de la tabla `ordenservicio`
--
ALTER TABLE `ordenservicio`
  ADD PRIMARY KEY (`idOrden`),
  ADD KEY `usuario` (`usuario`,`fumigador`,`Ubicacion`,`vivienda`),
  ADD KEY `fumigador` (`fumigador`),
  ADD KEY `vivienda` (`vivienda`),
  ADD KEY `Ubicacion` (`Ubicacion`);

--
-- Indices de la tabla `pagomovil`
--
ALTER TABLE `pagomovil`
  ADD PRIMARY KEY (`idPago`),
  ADD UNIQUE KEY `referencia` (`referencia`),
  ADD KEY `banco` (`banco`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`idPais`);

--
-- Indices de la tabla `quimicos`
--
ALTER TABLE `quimicos`
  ADD PRIMARY KEY (`idQuimico`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`IdRol`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`idServicio`),
  ADD KEY `idQuimico` (`idQuimico`);

--
-- Indices de la tabla `servicio/ordenservicio`
--
ALTER TABLE `servicio/ordenservicio`
  ADD KEY `id` (`id`),
  ADD KEY `idservicio` (`idservicio`,`idOrdenServicio`),
  ADD KEY `idOrdenServicio` (`idOrdenServicio`);

--
-- Indices de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  ADD PRIMARY KEY (`idUbicacion`),
  ADD KEY `ciudad` (`ciudad`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`email`),
  ADD KEY `idRol` (`idRol`);

--
-- Indices de la tabla `vivienda`
--
ALTER TABLE `vivienda`
  ADD PRIMARY KEY (`idVivienda`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `servicio/ordenservicio`
--
ALTER TABLE `servicio/ordenservicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD CONSTRAINT `ciudad_ibfk_1` FOREIGN KEY (`estado`) REFERENCES `estado` (`idEstado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`referencia`) REFERENCES `pagomovil` (`referencia`),
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`idOrden`) REFERENCES `ordenservicio` (`idOrden`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `fumigador`
--
ALTER TABLE `fumigador`
  ADD CONSTRAINT `fumigador_ibfk_1` FOREIGN KEY (`email`) REFERENCES `usuario` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fumigador_ibfk_2` FOREIGN KEY (`idUbicacion`) REFERENCES `ubicacion` (`idUbicacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD CONSTRAINT `modulo_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `rol` (`IdRol`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ordenservicio`
--
ALTER TABLE `ordenservicio`
  ADD CONSTRAINT `ordenservicio_ibfk_1` FOREIGN KEY (`fumigador`) REFERENCES `fumigador` (`email`),
  ADD CONSTRAINT `ordenservicio_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`email`),
  ADD CONSTRAINT `ordenservicio_ibfk_3` FOREIGN KEY (`vivienda`) REFERENCES `vivienda` (`idVivienda`),
  ADD CONSTRAINT `ordenservicio_ibfk_4` FOREIGN KEY (`Ubicacion`) REFERENCES `ubicacion` (`idUbicacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pagomovil`
--
ALTER TABLE `pagomovil`
  ADD CONSTRAINT `pagomovil_ibfk_1` FOREIGN KEY (`banco`) REFERENCES `banco` (`IdBanco`);

--
-- Filtros para la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD CONSTRAINT `servicio_ibfk_1` FOREIGN KEY (`idQuimico`) REFERENCES `quimicos` (`idQuimico`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `servicio/ordenservicio`
--
ALTER TABLE `servicio/ordenservicio`
  ADD CONSTRAINT `servicio/ordenservicio_ibfk_1` FOREIGN KEY (`idservicio`) REFERENCES `servicio` (`idServicio`),
  ADD CONSTRAINT `servicio/ordenservicio_ibfk_2` FOREIGN KEY (`idOrdenServicio`) REFERENCES `ordenservicio` (`idOrden`);

--
-- Filtros para la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  ADD CONSTRAINT `ubicacion_ibfk_1` FOREIGN KEY (`ciudad`) REFERENCES `ciudad` (`idCiudad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `rol` (`IdRol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
