-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-07-2024 a las 04:21:39
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
('100884284599959552', 'CLWGS1', 'CONSULTARWGS', 'MREALIZARORDENWGS', 1),
('100884284599959553', 'CLWGS1', 'CREATEWGS', 'MREALIZARORDENWGS', 1),
('100888792637898752', 'SAWGS1', 'CONSULTARWGS', 'MPERMISOSWGS', 1),
('100888792637898753', 'SAWGS1', 'CREATEWGS', 'MPERMISOSWGS', 1),
('100888792637898754', 'SAWGS1', 'ELIMINARWGS', 'MPERMISOSWGS', 1),
('100888792637898755', 'SAWGS1', 'MODIFICARWGS', 'MPERMISOSWGS', 1),
('100892973369131008', 'FGWGS1', 'CONSULTARWGS', 'MSERVICIOSWGS', 1),
('100892973369131009', 'FGWGS1', 'CONSULTARWGS', 'MPRECIOSWGS', 1),
('100925140560248832', 'SAWGS1', 'CREATEWGS', 'MFACTURASWGS', 1),
('100925140560248833', 'SAWGS1', 'CONSULTARWGS', 'MFACTURASWGS', 1),
('100925140560248834', 'SAWGS1', 'MODIFICARWGS', 'MFACTURASWGS', 1),
('100925140560248835', 'SAWGS1', 'ELIMINARWGS', 'MFACTURASWGS', 1),
('100925140560248836', 'SAWGS1', 'CREATEWGS', 'MORDENESWGS', 1),
('100925140560248837', 'SAWGS1', 'CONSULTARWGS', 'MORDENESWGS', 1),
('100925140560248838', 'SAWGS1', 'ELIMINARWGS', 'MORDENESWGS', 1),
('100925140560248839', 'SAWGS1', 'MODIFICARWGS', 'MORDENESWGS', 1),
('100925140560248840', 'FGWGS1', 'CONSULTARWGS', 'MMISORDENESWGS', 1),
('100925140560248841', 'FGWGS1', 'MODIFICARWGS', 'MMISORDENESWGS', 1),
('100925140560248842', 'CLWGS1', 'CONSULTARWGS', 'MMISORDENESWGS', 1),
('100925140560248843', 'CLWGS1', 'MODIFICARWGS', 'MMISORDENESWGS', 1),
('100933536986431488', 'FGWGS1', 'CONSULTARWGS', 'MCALENDARIOWGS', 1),
('100933536986431489', 'FGWGS1', 'CREATEWGS', 'MCALENDARIOWGS', 1),
('100933536986431490', 'FGWGS1', 'ELIMINARWGS', 'MCALENDARIOWGS', 1),
('100933536986431491', 'FGWGS1', 'MODIFICARWGS', 'MCALENDARIOWGS', 1),
('100935092687339528', 'FGWGS1', 'CONSULTARWGS', 'MMISSERVICIOSWGS', 1),
('100935092687339530', 'FGWGS1', 'CREATEWGS', 'MMISSERVICIOSWGS', 1),
('100935092687339531', 'FGWGS1', 'ELIMINARWGS', 'MMISSERVICIOSWGS', 1);

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
(107, 'registro', 'josetimaure60@gmail.com', 'Usario se ha registrado con Google al sistema', '2024-07-11 07:54:07'),
(109, 'registro', 'jentimo0205@gmail.com', 'Usario se ha registrado con Google al sistema', '2024-07-11 07:55:41'),
(115, 'Registro', 'Josetimaure40@gmail.com', 'Se ha registrado con usuario y contraseña.', '2024-07-11 08:56:55'),
(116, 'Iniciar Sesión', 'Josetimaure40@gmail.com', 'Inicio sesión en el sistema con usuario y contraseña', '2024-07-11 08:56:57'),
(117, 'Iniciar Sesión', 'Josetimaure40@gmail.com', 'Inicio sesión en el sistema con usuario y contraseña', '2024-07-11 22:49:48'),
(118, 'Iniciar Sesión', 'josetimaure60@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-11 22:51:44'),
(119, 'Iniciar Sesión', 'Josetimaure40@gmail.com', 'Inicio sesión en el sistema con usuario y contraseña', '2024-07-11 23:15:51'),
(120, 'Iniciar Sesión', 'jentimo0205@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-11 23:16:01'),
(121, 'Realizar Orden', 'jentimo0205@gmail.com', 'Ha realizado una nueva orden de servicio al fumigador de cedula: 28276746', '2024-07-11 23:34:31'),
(122, 'Iniciar Sesión', 'josetimaure60@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-11 23:37:39'),
(123, 'Iniciar Sesión', 'jentimo0205@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-12 12:48:06'),
(124, 'Realizar Orden', 'jentimo0205@gmail.com', 'Ha realizado una nueva orden de servicio al fumigador de cedula: 28276746', '2024-07-12 12:50:51'),
(125, 'Realizar Orden', 'jentimo0205@gmail.com', 'Ha realizado una nueva orden de servicio al fumigador de cedula: 28276746', '2024-07-12 12:51:05'),
(126, 'Realizar Orden', 'jentimo0205@gmail.com', 'Ha realizado una nueva orden de servicio al fumigador de cedula: 28276746', '2024-07-12 12:51:52'),
(127, 'Realizar Orden', 'jentimo0205@gmail.com', 'Ha realizado una nueva orden de servicio al fumigador de cedula: 28276746', '2024-07-12 13:21:33'),
(128, 'Realizar Orden', 'jentimo0205@gmail.com', 'Ha realizado una nueva orden de servicio al fumigador de cedula: 28276746', '2024-07-12 13:21:58'),
(129, 'registro', 'workglobalserviceca@gmail.com', 'Usario se ha registrado con Google al sistema', '2024-07-12 19:13:31'),
(130, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-13 10:24:46'),
(131, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-13 10:30:35'),
(132, 'registro', 'josbertjg@gmail.com', 'Usario se ha registrado con Google al sistema', '2024-07-13 10:32:12'),
(133, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-13 10:33:16'),
(134, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-13 10:33:54'),
(135, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-13 10:35:54'),
(136, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-13 10:50:28'),
(137, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-13 10:51:12'),
(138, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-13 10:54:22'),
(139, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-13 10:55:41'),
(140, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-13 10:56:09'),
(141, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-13 10:58:23'),
(142, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-13 11:02:00'),
(143, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-13 11:03:02'),
(144, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-13 11:12:01'),
(145, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-13 11:16:20'),
(146, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-13 11:18:45'),
(147, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-13 11:23:26'),
(148, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-13 11:24:04'),
(149, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-13 11:24:49'),
(150, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-13 11:30:03'),
(151, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-13 11:30:44'),
(152, 'Realizar Orden', 'workglobalserviceca@gmail.com', 'Ha realizado una nueva orden de servicio al fumigador de cedula: 28150011', '2024-07-13 12:12:41'),
(153, 'Realizar Orden', 'workglobalserviceca@gmail.com', 'Ha realizado una nueva orden de servicio al fumigador de cedula: 28150011', '2024-07-13 12:13:42'),
(154, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-13 12:40:57'),
(155, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-13 12:41:27'),
(156, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-13 12:46:15'),
(157, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-13 13:15:25'),
(158, 'Realizar Orden', 'workglobalserviceca@gmail.com', 'Ha realizado una nueva orden de servicio al fumigador de cedula: 28150011', '2024-07-13 13:16:41'),
(159, 'registro', 'josbelyguedezz@gmail.com', 'Usario se ha registrado con Google al sistema', '2024-07-13 13:31:13'),
(160, 'Iniciar Sesión', 'josbelyguedezz@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-13 13:31:50'),
(161, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-14 14:57:12'),
(162, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-15 11:44:23'),
(163, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-15 16:11:11'),
(164, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-16 10:47:27'),
(165, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-16 10:52:53'),
(166, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-16 12:48:28'),
(167, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-16 12:54:23'),
(168, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-16 12:56:27'),
(169, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-16 12:56:50'),
(170, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-16 12:57:17'),
(171, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-16 12:59:05'),
(172, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-16 13:30:53'),
(173, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-16 13:46:42'),
(174, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-16 13:47:42'),
(175, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-16 13:48:39'),
(176, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-16 13:50:11'),
(177, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-16 13:55:03'),
(178, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-16 14:00:20'),
(179, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-16 14:00:38'),
(180, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-16 14:02:42'),
(181, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-16 14:06:28'),
(182, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-16 14:06:37'),
(183, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-16 14:06:47'),
(184, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-16 14:06:56'),
(185, 'Iniciar Sesión', 'josbelyguedezz@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-16 14:20:51'),
(186, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-16 14:25:35'),
(187, 'Iniciar Sesión', 'josbelyguedezz@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-16 14:53:21'),
(188, 'Iniciar Sesión', 'josbelyguedezz@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-16 14:57:02'),
(189, 'Iniciar Sesión', 'josbelyguedezz@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-16 14:58:35'),
(190, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-16 15:00:02'),
(191, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-16 15:02:25'),
(192, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-16 16:33:33'),
(193, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-16 16:33:45'),
(194, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-16 18:45:42'),
(195, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-16 18:46:18'),
(196, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-16 21:41:44'),
(197, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-16 21:43:00'),
(198, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-16 22:08:08'),
(199, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-16 22:11:08'),
(200, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-16 22:11:31'),
(201, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-17 02:07:09'),
(202, 'Realizar Orden', 'workglobalserviceca@gmail.com', 'Ha realizado una nueva orden de servicio al fumigador de cedula: 28150010', '2024-07-17 03:08:43'),
(203, 'Realizar Orden', 'workglobalserviceca@gmail.com', 'Ha realizado una nueva orden de servicio al fumigador de cedula: 28150010', '2024-07-17 03:27:30'),
(204, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-17 03:27:50'),
(205, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-17 04:06:22'),
(206, 'Realizar Orden', 'workglobalserviceca@gmail.com', 'Ha realizado una nueva orden de servicio al fumigador de cedula: 28150010', '2024-07-17 04:22:06'),
(207, 'Realizar Orden', 'workglobalserviceca@gmail.com', 'Ha realizado una nueva orden de servicio al fumigador de cedula: 28150010', '2024-07-17 04:23:57'),
(208, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-17 04:24:36'),
(209, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-17 04:25:17'),
(210, 'Realizar Orden', 'workglobalserviceca@gmail.com', 'Ha realizado una nueva orden de servicio al fumigador de cedula: 28150010', '2024-07-17 04:25:37'),
(211, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-17 12:20:09'),
(212, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-17 12:27:10'),
(213, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-17 12:27:18'),
(214, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-17 12:27:28'),
(215, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-17 12:27:49'),
(216, 'Realizar Orden', 'workglobalserviceca@gmail.com', 'Ha realizado una nueva orden de servicio al fumigador de cedula: 28150010', '2024-07-17 12:31:34'),
(217, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-17 12:32:46'),
(218, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-17 12:33:55'),
(219, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-17 12:34:47'),
(220, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-17 13:35:14'),
(221, 'Realizar Orden', 'workglobalserviceca@gmail.com', 'Ha realizado una nueva orden de servicio al fumigador de cedula: 28150010', '2024-07-17 13:35:49'),
(222, 'Realizar Orden', 'workglobalserviceca@gmail.com', 'Ha realizado una nueva orden de servicio al fumigador de cedula: 28150010', '2024-07-17 13:35:59'),
(223, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-17 13:36:15'),
(224, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-17 13:37:43'),
(225, 'Realizar Orden', 'workglobalserviceca@gmail.com', 'Ha realizado una nueva orden de servicio al fumigador de cedula: 28150010', '2024-07-17 13:38:11'),
(226, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-17 13:38:40'),
(227, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-17 13:39:41'),
(228, 'Realizar Orden', 'workglobalserviceca@gmail.com', 'Ha realizado una nueva orden de servicio al fumigador de cedula: 28150010', '2024-07-17 14:19:46'),
(229, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-17 14:20:04'),
(230, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-17 14:20:22'),
(231, 'Iniciar Sesión', 'josbelyguedezz@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-17 14:56:02'),
(232, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-17 15:14:51'),
(233, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-17 16:52:54'),
(234, 'Realizar Orden', 'workglobalserviceca@gmail.com', 'Ha realizado una nueva orden de servicio al fumigador de cedula: 28150010', '2024-07-17 16:53:41'),
(235, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-17 16:54:23'),
(236, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-17 17:37:21'),
(237, 'Realizar Orden', 'workglobalserviceca@gmail.com', 'Ha realizado una nueva orden de servicio al fumigador de cedula: 28150010', '2024-07-17 17:37:38'),
(238, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-17 17:37:46'),
(239, 'Iniciar Sesión', 'workglobalserviceca@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-17 21:18:12'),
(240, 'Iniciar Sesión', 'josbertjg@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-17 22:16:44'),
(241, 'Iniciar Sesión', 'josbelyguedezz@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-07-17 22:17:41');

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
('MCALENDARIOWGS', 'Calendario', 1),
('MESTABLECIMIENTOSWGS', 'Establecimientos', 1),
('MFACTURASWGS', 'Facturas', 1),
('MMANTENIMIENTOWGS', 'Mantenimiento', 1),
('MMISORDENESWGS', 'MisOrdenes', 1),
('MMISSERVICIOSWGS', 'Mis Servicios', 1),
('MNOTIFICACIONESWGS', 'Notificaciones', 1),
('MORDENESDESERVICIOWGS', 'Ordenes de Servicio', 1),
('MORDENESWGS', 'Ordenes', 1),
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
('jentimo0205@gmail.com', '', 'José', 'Timaure', '', 'assets/img/perfil/jentimo0205@gmail.com.jpg', 1, 'gmail_oauth', 'CLWGS1', '2024-07-11 11:55:41', 1),
('josbelyguedezz@gmail.com', '', 'josbely', 'guédez', '', 'assets/img/perfil/josbelyguedezz@gmail.com.jpg', 1, 'gmail_oauth', 'SAWGS1', '2024-07-13 17:31:31', 1),
('josbertjg@gmail.com', '', 'Josbert', 'Guedez', '', 'assets/img/perfil/josbertjg@gmail.com.jpg', 1, 'gmail_oauth', 'FGWGS1', '2024-07-16 17:59:27', 1),
('Josetimaure40@gmail.com', '$2y$10$0HzkLQJ40P/AB3nur4MGCuBzj1QM4Ycpb6ZSDTdkHJTWRN4JVhLzW', 'Jose', 'Timaure', '04145399966', '', 1, 'account_password', 'FGWGS1', '2024-07-11 19:37:13', 1),
('josetimaure60@gmail.com', '', 'Jose', 'Timaure', '', 'assets/img/perfil/josetimaure60@gmail.com.jpg', 1, 'gmail_oauth', 'SAWGS1', '2024-07-11 11:54:48', 1),
('workglobalserviceca@gmail.com', '', 'Josnel', 'Guedez', '', 'assets/img/perfil/workglobalserviceca@gmail.com.jpg', 1, 'gmail_oauth', 'CLWGS1', '2024-07-12 23:13:31', 1);

--
-- Disparadores `tusuarios`
--
DELIMITER $$
CREATE TRIGGER `insertarCliente` AFTER INSERT ON `tusuarios` FOR EACH ROW BEGIN
    IF NEW.IdRol = 'CLWGS1' THEN
        INSERT INTO workglobalservice.tclientes (id,email) VALUES (NULL,NEW.email);
    END IF;
END
$$
DELIMITER ;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=242;

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
