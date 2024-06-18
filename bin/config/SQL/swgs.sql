-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-06-2024 a las 05:54:37
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `swgs`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `taccesos`
--

CREATE TABLE `taccesos` (
  `idAcceso` varchar(40) COLLATE utf8mb4_spanish_ci NOT NULL,
  `rol` varchar(40) COLLATE utf8mb4_spanish_ci NOT NULL,
  `permiso` varchar(40) COLLATE utf8mb4_spanish_ci NOT NULL,
  `modulo` varchar(40) COLLATE utf8mb4_spanish_ci NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `taccesos`
--

INSERT INTO `taccesos` (`idAcceso`, `rol`, `permiso`, `modulo`, `status`) VALUES
('100878437622743040', 'SAWGS1', 'CREATEWGS', 'MQUIMICOSWGS', 1),
('100878437622743041', 'SAWGS1', 'CONSULTARWGS', 'MQUIMICOSWGS', 1),
('100878437622743042', 'SAWGS1', 'ELIMINARWGS', 'MQUIMICOSWGS', 1),
('100878437622743043', 'SAWGS1', 'MODIFICARWGS', 'MQUIMICOSWGS', 1),
('100878437622743044', 'SAWGS1', 'CREATEWGS', 'MUSUARIOSWGS', 1),
('100878437622743045', 'SAWGS1', 'CONSULTARWGS', 'MUSUARIOSWGS', 1),
('100878437622743046', 'SAWGS1', 'ELIMINARWGS', 'MUSUARIOSWGS', 1),
('100878437622743047', 'SAWGS1', 'MODIFICARWGS', 'MUSUARIOSWGS', 1),
('100878437622743048', 'SAWGS1', 'CONSULTARWGS', 'MSERVICIOSWGS', 1),
('100878437622743049', 'SAWGS1', 'CREATEWGS', 'MSERVICIOSWGS', 1),
('100878437622743050', 'SAWGS1', 'ELIMINARWGS', 'MSERVICIOSWGS', 1),
('100878437622743051', 'SAWGS1', 'MODIFICARWGS', 'MSERVICIOSWGS', 1),
('100878437622743052', 'SAWGS1', 'CONSULTARWGS', 'MBITACORAWGS', 1),
('100878437622743053', 'SAWGS1', 'CREATEWGS', 'MBITACORAWGS', 1),
('100878437622743054', 'SAWGS1', 'ELIMINARWGS', 'MBITACORAWGS', 1),
('100878437622743055', 'SAWGS1', 'MODIFICARWGS', 'MBITACORAWGS', 1),
('100878437622743056', 'SAWGS1', 'CONSULTARWGS', 'MESTABLECIMIENTOSWGS', 1),
('100878437622743057', 'SAWGS1', 'CREATEWGS', 'MESTABLECIMIENTOSWGS', 1),
('100878437622743058', 'SAWGS1', 'ELIMINARWGS', 'MESTABLECIMIENTOSWGS', 1),
('100878437622743059', 'SAWGS1', 'MODIFICARWGS', 'MESTABLECIMIENTOSWGS', 1),
('100878437622743060', 'SAWGS1', 'CONSULTARWGS', 'MMANTENIMIENTOWGS', 1),
('100878437622743061', 'SAWGS1', 'CREATEWGS', 'MMANTENIMIENTOWGS', 1),
('100878437622743062', 'SAWGS1', 'ELIMINARWGS', 'MMANTENIMIENTOWGS', 1),
('100878437622743063', 'SAWGS1', 'MODIFICARWGS', 'MMANTENIMIENTOWGS', 1),
('100878437622743064', 'SAWGS1', 'CONSULTARWGS', 'MNOTIFICACIONESWGS', 1),
('100878437622743065', 'SAWGS1', 'CREATEWGS', 'MNOTIFICACIONESWGS', 1),
('100878437622743066', 'SAWGS1', 'ELIMINARWGS', 'MNOTIFICACIONESWGS', 1),
('100878437622743067', 'SAWGS1', 'MODIFICARWGS', 'MNOTIFICACIONESWGS', 1),
('100878437622743068', 'SAWGS1', 'CONSULTARWGS', 'MORDENESDESERVICIOWGS', 1),
('100878437622743069', 'SAWGS1', 'CREATEWGS', 'MORDENESDESERVICIOWGS', 1),
('100878437622743070', 'SAWGS1', 'ELIMINARWGS', 'MORDENESDESERVICIOWGS', 1),
('100878437622743071', 'SAWGS1', 'MODIFICARWGS', 'MORDENESDESERVICIOWGS', 1),
('100878437622743072', 'SAWGS1', 'CONSULTARWGS', 'MPAGOSWGS', 1),
('100878437622743073', 'SAWGS1', 'CREATEWGS', 'MPAGOSWGS', 1),
('100878437622743074', 'SAWGS1', 'ELIMINARWGS', 'MPAGOSWGS', 1),
('100878437622743075', 'SAWGS1', 'MODIFICARWGS', 'MPAGOSWGS', 1),
('100878437622743080', 'SAWGS1', 'CONSULTARWGS', 'MREPORTESWGS', 1),
('100878437622743081', 'SAWGS1', 'CREATEWGS', 'MREPORTESWGS', 1),
('100878437622743082', 'SAWGS1', 'ELIMINARWGS', 'MREPORTESWGS', 1),
('100878437622743083', 'SAWGS1', 'MODIFICARWGS', 'MREPORTESWGS', 1),
('100878437622743084', 'SAWGS1', 'CONSULTARWGS', 'MROLESWGS', 1),
('100878437622743085', 'SAWGS1', 'CREATEWGS', 'MROLESWGS', 1),
('100878437622743086', 'SAWGS1', 'ELIMINARWGS', 'MROLESWGS', 1),
('100878437622743087', 'SAWGS1', 'MODIFICARWGS', 'MROLESWGS', 1),
('100878437622743088', 'SAWGS1', 'CONSULTARWGS', 'MSOBRECARGOSWGS', 1),
('100878437622743089', 'SAWGS1', 'CREATEWGS', 'MSOBRECARGOSWGS', 1),
('100878437622743090', 'SAWGS1', 'ELIMINARWGS', 'MSOBRECARGOSWGS', 1),
('100878437622743091', 'SAWGS1', 'MODIFICARWGS', 'MSOBRECARGOSWGS', 1),
('100878437622743092', 'SAWGS1', 'CONSULTARWGS', 'MTRABAJADORESWGS', 1),
('100878437622743093', 'SAWGS1', 'CREATEWGS', 'MTRABAJADORESWGS', 1),
('100878437622743094', 'SAWGS1', 'ELIMINARWGS', 'MTRABAJADORESWGS', 1),
('100878437622743095', 'SAWGS1', 'MODIFICARWGS', 'MTRABAJADORESWGS', 1),
('100878437622743096', 'SAWGS1', 'CONSULTARWGS', 'MUBICACIONESWGS', 1),
('100878437622743097', 'SAWGS1', 'CREATEWGS', 'MUBICACIONESWGS', 1),
('100878437622743098', 'SAWGS1', 'ELIMINARWGS', 'MUBICACIONESWGS', 1),
('100878437622743099', 'SAWGS1', 'MODIFICARWGS', 'MUBICACIONESWGS', 1),
('100878437622743100', 'SAWGS1', 'CONSULTARWGS', 'MPRECIOSWGS', 1),
('100878437622743101', 'SAWGS1', 'CREATEWGS', 'MPRECIOSWGS', 1),
('100878437622743102', 'SAWGS1', 'ELIMINARWGS', 'MPRECIOSWGS', 1),
('100878437622743103', 'SAWGS1', 'MODIFICARWGS', 'MPRECIOSWGS', 1),
('100880027079409665', 'CLWGS1', 'CONSULTARWGS', 'MSERVICIOSWGS', 1),
('100880027079409666', 'SAWGS1', 'CONSULTARWGS', 'MCONFIGURACIONWGS', 1),
('100880027079409667', 'SAWGS1', 'CREATEWGS', 'MCONFIGURACIONWGS', 1),
('100880027079409668', 'SAWGS1', 'ELIMINARWGS', 'MCONFIGURACIONWGS', 1),
('100880027079409669', 'SAWGS1', 'MODIFICARWGS', 'MCONFIGURACIONWGS', 1),
('100884284599959552', 'CLWGS1', 'CONSULTARWGS', 'MREALIZARORDENWGS', 1),
('100884284599959553', 'CLWGS1', 'CREATEWGS', 'MREALIZARORDENWGS', 1),
('100888792637898752', 'SAWGS1', 'CONSULTARWGS', 'MPERMISOSWGS', 1),
('100888792637898753', 'SAWGS1', 'CREATEWGS', 'MPERMISOSWGS', 1),
('100888792637898754', 'SAWGS1', 'ELIMINARWGS', 'MPERMISOSWGS', 1),
('100888792637898755', 'SAWGS1', 'MODIFICARWGS', 'MPERMISOSWGS', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbitacoras`
--

CREATE TABLE `tbitacoras` (
  `id` int(11) NOT NULL,
  `modulo` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL,
  `usuario` varchar(40) COLLATE utf8mb4_spanish_ci NOT NULL,
  `descripcion` varchar(500) COLLATE utf8mb4_spanish_ci NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tbitacoras`
--

INSERT INTO `tbitacoras` (`id`, `modulo`, `usuario`, `descripcion`, `fecha`) VALUES
(1, 'Iniciar Sesión', 'josetimaure60@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-06-09 10:16:50'),
(2, 'Iniciar Sesión', 'josetimaure60@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-06-09 13:06:40'),
(3, 'Iniciar Sesión', 'josetimaure60@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-06-09 13:08:46'),
(15, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-06-11 21:04:03'),
(16, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-06-11 21:08:16'),
(17, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-06-11 21:08:30'),
(18, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-06-11 22:46:15'),
(19, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-06-11 23:09:34'),
(20, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-06-11 23:34:06'),
(22, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-06-11 23:52:40'),
(24, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-06-11 23:55:23'),
(25, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-06-11 23:55:50'),
(26, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-06-11 23:56:46'),
(27, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-06-12 00:00:49'),
(28, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-06-12 00:01:59'),
(29, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-06-12 00:02:50'),
(31, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-06-12 00:09:19'),
(33, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-06-12 14:35:06'),
(34, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-06-12 14:42:05'),
(35, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-06-12 14:42:44'),
(37, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-06-13 12:01:51'),
(38, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-06-13 12:02:24'),
(39, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-06-13 12:04:12'),
(42, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-06-13 14:50:45'),
(43, 'Iniciar Sesión', 'luisanagimenez18@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-06-13 14:51:56'),
(45, 'Iniciar Sesión', 'josetimaure60@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-06-15 17:02:41'),
(46, 'registro', 'jentimo0205@gmail.com', 'Usario se ha registrado con Google al sistema', '2024-06-15 22:59:01'),
(47, 'Iniciar Sesión', 'josetimaure60@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-06-15 23:10:58'),
(48, 'Iniciar Sesión', 'josetimaure60@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-06-16 07:57:29'),
(49, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-06-17 16:57:46'),
(50, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-06-17 17:01:22'),
(58, 'registro', 'workglobalserviceca@gmail.com', 'Usario se ha registrado con Google al sistema', '2024-06-17 23:19:58'),
(59, 'Realizar Orden', 'workglobalserviceca@gmail.com', 'Ha realizado una nueva orden de servicio al fumigador de cedula: 28150010', '2024-06-17 23:40:35'),
(60, 'Realizar Orden', 'workglobalserviceca@gmail.com', 'Ha realizado una nueva orden de servicio al fumigador de cedula: 28150010', '2024-06-17 23:44:26'),
(61, 'Realizar Orden', 'workglobalserviceca@gmail.com', 'Ha realizado una nueva orden de servicio al fumigador de cedula: 28150010', '2024-06-17 23:48:33'),
(62, 'Realizar Orden', 'workglobalserviceca@gmail.com', 'Ha realizado una nueva orden de servicio al fumigador de cedula: 28150010', '2024-06-17 23:51:17'),
(63, 'Realizar Orden', 'workglobalserviceca@gmail.com', 'Ha realizado una nueva orden de servicio al fumigador de cedula: 28150010', '2024-06-17 23:51:55'),
(64, 'Realizar Orden', 'workglobalserviceca@gmail.com', 'Ha realizado una nueva orden de servicio al fumigador de cedula: 28150010', '2024-06-17 23:53:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmodulos`
--

CREATE TABLE `tmodulos` (
  `idModulo` varchar(40) COLLATE utf8mb4_spanish_ci NOT NULL,
  `nombre` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tmodulos`
--

INSERT INTO `tmodulos` (`idModulo`, `nombre`, `status`) VALUES
('MBITACORAWGS', 'Bitácora', 1),
('MCONFIGURACIONWGS', 'Configuracion', 1),
('MESTABLECIMIENTOSWGS', 'Establecimientos', 1),
('MMANTENIMIENTOWGS', 'Mantenimiento', 1),
('MNOTIFICACIONESWGS', 'Notificaciones', 1),
('MORDENESDESERVICIOWGS', 'Ordenes de Servicio', 1),
('MPAGOSWGS', 'Pagos', 1),
('MPERMISOSWGS', 'Permisos', 1),
('MPRECIOSWGS', 'Precios', 1),
('MQUIMICOSWGS', 'Quimicos', 1),
('MREALIZARORDENWGS', 'Realizar Orden', 1),
('MREPORTESWGS', 'Reportes', 1),
('MROLESWGS', 'Roles', 1),
('MSERVICIOSWGS', 'Servicios', 1),
('MSOBRECARGOSWGS', 'Sobrecargos', 1),
('MTRABAJADORESWGS', 'Trabajadores', 1),
('MUBICACIONESWGS', 'Ubicaciones', 1),
('MUSUARIOSWGS', 'Usuarios', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tnofiticaciones`
--

CREATE TABLE `tnofiticaciones` (
  `id` int(11) NOT NULL,
  `descripcion` longtext COLLATE utf8mb4_spanish_ci NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL,
  `usuario` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tpermisos`
--

CREATE TABLE `tpermisos` (
  `idPermiso` varchar(40) COLLATE utf8mb4_spanish_ci NOT NULL,
  `nombre` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tpermisos`
--

INSERT INTO `tpermisos` (`idPermiso`, `nombre`, `status`) VALUES
('CONSULTARWGS', 'Consultar', 1),
('CREATEWGS', 'Crear', 1),
('ELIMINARWGS', 'Eliminar', 1),
('MODIFICARWGS', 'Modificar', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `troles`
--

CREATE TABLE `troles` (
  `IdRol` varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL,
  `nombre` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL,
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
-- Estructura de tabla para la tabla `tusuarios`
--

CREATE TABLE `tusuarios` (
  `email` varchar(40) COLLATE utf8mb4_spanish_ci NOT NULL,
  `contraseña` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `apellido` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL,
  `fotoPerfil` varchar(500) COLLATE utf8mb4_spanish_ci NOT NULL,
  `emailVerificado` tinyint(1) NOT NULL DEFAULT 0,
  `oauth_type` enum('gmail_oauth','account_password','multi_oauth','') COLLATE utf8mb4_spanish_ci NOT NULL,
  `idRol` varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'CLWGS1',
  `creado` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tusuarios`
--

INSERT INTO `tusuarios` (`email`, `contraseña`, `nombre`, `apellido`, `telefono`, `fotoPerfil`, `emailVerificado`, `oauth_type`, `idRol`, `creado`, `activo`) VALUES
('jentimo0205@gmail.com', '', 'José', 'Timaure', '', 'assets/img/perfil/jentimo0205@gmail.com.jpg', 1, 'gmail_oauth', 'CLWGS1', '2024-06-16 02:59:01', 1),
('josbertjg@gmail.com', '', 'Josbert', 'Guedez', '', 'https://lh3.googleusercontent.com/a/ACg8ocIYxgSVKmpdVhUOFnSf7DM1UbzOGrdaaIBopvTOKnWhhNlccJxZ=s96-c', 1, 'gmail_oauth', 'FGWGS1', '2024-06-17 21:19:11', 1),
('josetimaure60@gmail.com', '', 'Jose', 'Timaure', '', 'https://lh3.googleusercontent.com/a/ACg8ocJRESfHpvaFUA8v242WUFwFuXql-rmQ7fr05Ga-JlrNKARYpGxSeg=s96-c', 1, 'gmail_oauth', 'SAWGS1', '2024-06-09 14:21:23', 1),
('luisanagimenez18@gmail.com', '', 'Luisana', 'Gimenez', '', 'assets/img/perfil/luisanagimenez18@gmail.com.jpg', 1, 'gmail_oauth', 'SAWGS1', '2024-06-13 18:51:42', 1),
('workglobalserviceca@gmail.com', '', 'Josnel', 'Guedez', '', 'assets/img/perfil/workglobalserviceca@gmail.com.jpg', 1, 'gmail_oauth', 'CLWGS1', '2024-06-18 03:19:58', 1);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vistapermisosadministrador`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vistapermisosadministrador` (
`Modulo` varchar(20)
,`Crear` bigint(4)
,`Consultar` bigint(4)
,`Eliminar` bigint(4)
,`Modificar` bigint(4)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vistapermisoscliente`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vistapermisoscliente` (
`Modulo` varchar(20)
,`Crear` bigint(4)
,`Consultar` bigint(4)
,`Eliminar` bigint(4)
,`Modificar` bigint(4)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vistapermisosfumigador`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vistapermisosfumigador` (
`Modulo` varchar(20)
,`Crear` bigint(4)
,`Consultar` bigint(4)
,`Eliminar` bigint(4)
,`Modificar` bigint(4)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vistapermisosadministrador`
--
DROP TABLE IF EXISTS `vistapermisosadministrador`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vistapermisosadministrador`  AS SELECT `tmodulos`.`nombre` AS `Modulo`, max(case when `taccesos`.`permiso` = 'CREATEWGS' then `taccesos`.`status` end) AS `Crear`, max(case when `taccesos`.`permiso` = 'CONSULTARWGS' then `taccesos`.`status` end) AS `Consultar`, max(case when `taccesos`.`permiso` = 'ELIMINARWGS' then `taccesos`.`status` end) AS `Eliminar`, max(case when `taccesos`.`permiso` = 'MODIFICARWGS' then `taccesos`.`status` end) AS `Modificar` FROM (`taccesos` join `tmodulos` on(`tmodulos`.`idModulo` = `taccesos`.`modulo`)) WHERE `taccesos`.`rol` = 'SAWGS1' GROUP BY `taccesos`.`modulo` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vistapermisoscliente`
--
DROP TABLE IF EXISTS `vistapermisoscliente`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vistapermisoscliente`  AS SELECT `tmodulos`.`nombre` AS `Modulo`, max(case when `taccesos`.`permiso` = 'CREATEWGS' then `taccesos`.`status` end) AS `Crear`, max(case when `taccesos`.`permiso` = 'CONSULTARWGS' then `taccesos`.`status` end) AS `Consultar`, max(case when `taccesos`.`permiso` = 'ELIMINARWGS' then `taccesos`.`status` end) AS `Eliminar`, max(case when `taccesos`.`permiso` = 'MODIFICARWGS' then `taccesos`.`status` end) AS `Modificar` FROM (`taccesos` join `tmodulos` on(`tmodulos`.`idModulo` = `taccesos`.`modulo`)) WHERE `taccesos`.`rol` = 'CLWGS1' GROUP BY `taccesos`.`modulo` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vistapermisosfumigador`
--
DROP TABLE IF EXISTS `vistapermisosfumigador`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vistapermisosfumigador`  AS SELECT `tmodulos`.`nombre` AS `Modulo`, max(case when `taccesos`.`permiso` = 'CREATEWGS' then `taccesos`.`status` else NULL end) AS `Crear`, max(case when `taccesos`.`permiso` = 'CONSULTARWGS' then `taccesos`.`status` else NULL end) AS `Consultar`, max(case when `taccesos`.`permiso` = 'ELIMINARWGS' then `taccesos`.`status` else NULL end) AS `Eliminar`, max(case when `taccesos`.`permiso` = 'MODIFICARWGS' then `taccesos`.`status` else NULL end) AS `Modificar` FROM (`tmodulos` left join `taccesos` on(`tmodulos`.`idModulo` = `taccesos`.`modulo` and `taccesos`.`rol` = 'FGWGS1')) GROUP BY `taccesos`.`modulo` ;

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
-- Indices de la tabla `tpermisos`
--
ALTER TABLE `tpermisos`
  ADD PRIMARY KEY (`idPermiso`);

--
-- Indices de la tabla `troles`
--
ALTER TABLE `troles`
  ADD PRIMARY KEY (`IdRol`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de la tabla `tnofiticaciones`
--
ALTER TABLE `tnofiticaciones`
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
-- Filtros para la tabla `tnofiticaciones`
--
ALTER TABLE `tnofiticaciones`
  ADD CONSTRAINT `tnofiticaciones_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `tusuarios` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tusuarios`
--
ALTER TABLE `tusuarios`
  ADD CONSTRAINT `tusuarios_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `troles` (`IdRol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
