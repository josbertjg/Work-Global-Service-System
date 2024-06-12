-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-06-2024 a las 13:05:03
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
  `idAcceso` varchar(40) NOT NULL,
  `rol` varchar(40) NOT NULL,
  `permiso` varchar(40) NOT NULL,
  `modulo` varchar(40) NOT NULL,
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
('100878437622743103', 'SAWGS1', 'MODIFICARWGS', 'MPRECIOSWGS', 1);

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

--
-- Volcado de datos para la tabla `tbitacoras`
--

INSERT INTO `tbitacoras` (`id`, `modulo`, `usuario`, `descripcion`, `fecha`) VALUES
(1, 'Iniciar Sesión', 'josetimaure60@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-06-09 10:16:50'),
(2, 'Iniciar Sesión', 'josetimaure60@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-06-09 13:06:40'),
(3, 'Iniciar Sesión', 'josetimaure60@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-06-09 13:08:46'),
(4, 'Iniciar Sesión', 'josetimaure60@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-06-09 16:28:13'),
(5, 'Iniciar Sesión', 'josetimaure60@gmail.com', 'Inicio sesión en el sistema con GMAIL.', '2024-06-10 06:07:07');

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
  `id_ciudad` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `ciudad` varchar(200) NOT NULL,
  `capital` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tciudades`
--

INSERT INTO `tciudades` (`id_ciudad`, `id_estado`, `ciudad`, `capital`) VALUES
(1, 1, 'Maroa', 0),
(2, 1, 'Puerto Ayacucho', 1),
(3, 1, 'San Fernando de Atabapo', 0),
(4, 2, 'Anaco', 0),
(5, 2, 'Aragua de Barcelona', 0),
(6, 2, 'Barcelona', 1),
(7, 2, 'Boca de Uchire', 0),
(8, 2, 'Cantaura', 0),
(9, 2, 'Clarines', 0),
(10, 2, 'El Chaparro', 0),
(11, 2, 'El Pao Anzoátegui', 0),
(12, 2, 'El Tigre', 0),
(13, 2, 'El Tigrito', 0),
(14, 2, 'Guanape', 0),
(15, 2, 'Guanta', 0),
(16, 2, 'Lechería', 0),
(17, 2, 'Onoto', 0),
(18, 2, 'Pariaguán', 0),
(19, 2, 'Píritu', 0),
(20, 2, 'Puerto La Cruz', 0),
(21, 2, 'Puerto Píritu', 0),
(22, 2, 'Sabana de Uchire', 0),
(23, 2, 'San Mateo Anzoátegui', 0),
(24, 2, 'San Pablo Anzoátegui', 0),
(25, 2, 'San Tomé', 0),
(26, 2, 'Santa Ana de Anzoátegui', 0),
(27, 2, 'Santa Fe Anzoátegui', 0),
(28, 2, 'Santa Rosa', 0),
(29, 2, 'Soledad', 0),
(30, 2, 'Urica', 0),
(31, 2, 'Valle de Guanape', 0),
(43, 3, 'Achaguas', 0),
(44, 3, 'Biruaca', 0),
(45, 3, 'Bruzual', 0),
(46, 3, 'El Amparo', 0),
(47, 3, 'El Nula', 0),
(48, 3, 'Elorza', 0),
(49, 3, 'Guasdualito', 0),
(50, 3, 'Mantecal', 0),
(51, 3, 'Puerto Páez', 0),
(52, 3, 'San Fernando de Apure', 1),
(53, 3, 'San Juan de Payara', 0),
(54, 4, 'Barbacoas', 0),
(55, 4, 'Cagua', 0),
(56, 4, 'Camatagua', 0),
(58, 4, 'Choroní', 0),
(59, 4, 'Colonia Tovar', 0),
(60, 4, 'El Consejo', 0),
(61, 4, 'La Victoria', 0),
(62, 4, 'Las Tejerías', 0),
(63, 4, 'Magdaleno', 0),
(64, 4, 'Maracay', 1),
(65, 4, 'Ocumare de La Costa', 0),
(66, 4, 'Palo Negro', 0),
(67, 4, 'San Casimiro', 0),
(68, 4, 'San Mateo', 0),
(69, 4, 'San Sebastián', 0),
(70, 4, 'Santa Cruz de Aragua', 0),
(71, 4, 'Tocorón', 0),
(72, 4, 'Turmero', 0),
(73, 4, 'Villa de Cura', 0),
(74, 4, 'Zuata', 0),
(75, 5, 'Barinas', 1),
(76, 5, 'Barinitas', 0),
(77, 5, 'Barrancas', 0),
(78, 5, 'Calderas', 0),
(79, 5, 'Capitanejo', 0),
(80, 5, 'Ciudad Bolivia', 0),
(81, 5, 'El Cantón', 0),
(82, 5, 'Las Veguitas', 0),
(83, 5, 'Libertad de Barinas', 0),
(84, 5, 'Sabaneta', 0),
(85, 5, 'Santa Bárbara de Barinas', 0),
(86, 5, 'Socopó', 0),
(87, 6, 'Caicara del Orinoco', 0),
(88, 6, 'Canaima', 0),
(89, 6, 'Ciudad Bolívar', 1),
(90, 6, 'Ciudad Piar', 0),
(91, 6, 'El Callao', 0),
(92, 6, 'El Dorado', 0),
(93, 6, 'El Manteco', 0),
(94, 6, 'El Palmar', 0),
(95, 6, 'El Pao', 0),
(96, 6, 'Guasipati', 0),
(97, 6, 'Guri', 0),
(98, 6, 'La Paragua', 0),
(99, 6, 'Matanzas', 0),
(100, 6, 'Puerto Ordaz', 0),
(101, 6, 'San Félix', 0),
(102, 6, 'Santa Elena de Uairén', 0),
(103, 6, 'Tumeremo', 0),
(104, 6, 'Unare', 0),
(105, 6, 'Upata', 0),
(106, 7, 'Bejuma', 0),
(107, 7, 'Belén', 0),
(108, 7, 'Campo de Carabobo', 0),
(109, 7, 'Canoabo', 0),
(110, 7, 'Central Tacarigua', 0),
(111, 7, 'Chirgua', 0),
(112, 7, 'Ciudad Alianza', 0),
(113, 7, 'El Palito', 0),
(114, 7, 'Guacara', 0),
(115, 7, 'Guigue', 0),
(116, 7, 'Las Trincheras', 0),
(117, 7, 'Los Guayos', 0),
(118, 7, 'Mariara', 0),
(119, 7, 'Miranda', 0),
(120, 7, 'Montalbán', 0),
(121, 7, 'Morón', 0),
(122, 7, 'Naguanagua', 0),
(123, 7, 'Puerto Cabello', 0),
(124, 7, 'San Joaquín', 0),
(125, 7, 'Tocuyito', 0),
(126, 7, 'Urama', 0),
(127, 7, 'Valencia', 1),
(128, 7, 'Vigirimita', 0),
(129, 8, 'Aguirre', 0),
(130, 8, 'Apartaderos Cojedes', 0),
(131, 8, 'Arismendi', 0),
(132, 8, 'Camuriquito', 0),
(133, 8, 'El Baúl', 0),
(134, 8, 'El Limón', 0),
(135, 8, 'El Pao Cojedes', 0),
(136, 8, 'El Socorro', 0),
(137, 8, 'La Aguadita', 0),
(138, 8, 'Las Vegas', 0),
(139, 8, 'Libertad de Cojedes', 0),
(140, 8, 'Mapuey', 0),
(141, 8, 'Piñedo', 0),
(142, 8, 'Samancito', 0),
(143, 8, 'San Carlos', 1),
(144, 8, 'Sucre', 0),
(145, 8, 'Tinaco', 0),
(146, 8, 'Tinaquillo', 0),
(147, 8, 'Vallecito', 0),
(148, 9, 'Tucupita', 1),
(149, 24, 'Caracas', 1),
(150, 24, 'El Junquito', 0),
(151, 10, 'Adícora', 0),
(152, 10, 'Boca de Aroa', 0),
(153, 10, 'Cabure', 0),
(154, 10, 'Capadare', 0),
(155, 10, 'Capatárida', 0),
(156, 10, 'Chichiriviche', 0),
(157, 10, 'Churuguara', 0),
(158, 10, 'Coro', 1),
(159, 10, 'Cumarebo', 0),
(160, 10, 'Dabajuro', 0),
(161, 10, 'Judibana', 0),
(162, 10, 'La Cruz de Taratara', 0),
(163, 10, 'La Vela de Coro', 0),
(164, 10, 'Los Taques', 0),
(165, 10, 'Maparari', 0),
(166, 10, 'Mene de Mauroa', 0),
(167, 10, 'Mirimire', 0),
(168, 10, 'Pedregal', 0),
(169, 10, 'Píritu Falcón', 0),
(170, 10, 'Pueblo Nuevo Falcón', 0),
(171, 10, 'Puerto Cumarebo', 0),
(172, 10, 'Punta Cardón', 0),
(173, 10, 'Punto Fijo', 0),
(174, 10, 'San Juan de Los Cayos', 0),
(175, 10, 'San Luis', 0),
(176, 10, 'Santa Ana Falcón', 0),
(177, 10, 'Santa Cruz De Bucaral', 0),
(178, 10, 'Tocopero', 0),
(179, 10, 'Tocuyo de La Costa', 0),
(180, 10, 'Tucacas', 0),
(181, 10, 'Yaracal', 0),
(182, 11, 'Altagracia de Orituco', 0),
(183, 11, 'Cabruta', 0),
(184, 11, 'Calabozo', 0),
(185, 11, 'Camaguán', 0),
(196, 11, 'Chaguaramas Guárico', 0),
(197, 11, 'El Socorro', 0),
(198, 11, 'El Sombrero', 0),
(199, 11, 'Las Mercedes de Los Llanos', 0),
(200, 11, 'Lezama', 0),
(201, 11, 'Onoto', 0),
(202, 11, 'Ortíz', 0),
(203, 11, 'San José de Guaribe', 0),
(204, 11, 'San Juan de Los Morros', 1),
(205, 11, 'San Rafael de Laya', 0),
(206, 11, 'Santa María de Ipire', 0),
(207, 11, 'Tucupido', 0),
(208, 11, 'Valle de La Pascua', 0),
(209, 11, 'Zaraza', 0),
(210, 12, 'Aguada Grande', 0),
(211, 12, 'Atarigua', 0),
(212, 12, 'Barquisimeto', 1),
(213, 12, 'Bobare', 0),
(214, 12, 'Cabudare', 0),
(215, 12, 'Carora', 0),
(216, 12, 'Cubiro', 0),
(217, 12, 'Cují', 0),
(218, 12, 'Duaca', 0),
(219, 12, 'El Manzano', 0),
(220, 12, 'El Tocuyo', 0),
(221, 12, 'Guaríco', 0),
(222, 12, 'Humocaro Alto', 0),
(223, 12, 'Humocaro Bajo', 0),
(224, 12, 'La Miel', 0),
(225, 12, 'Moroturo', 0),
(226, 12, 'Quíbor', 0),
(227, 12, 'Río Claro', 0),
(228, 12, 'Sanare', 0),
(229, 12, 'Santa Inés', 0),
(230, 12, 'Sarare', 0),
(231, 12, 'Siquisique', 0),
(232, 12, 'Tintorero', 0),
(233, 13, 'Apartaderos Mérida', 0),
(234, 13, 'Arapuey', 0),
(235, 13, 'Bailadores', 0),
(236, 13, 'Caja Seca', 0),
(237, 13, 'Canaguá', 0),
(238, 13, 'Chachopo', 0),
(239, 13, 'Chiguara', 0),
(240, 13, 'Ejido', 0),
(241, 13, 'El Vigía', 0),
(242, 13, 'La Azulita', 0),
(243, 13, 'La Playa', 0),
(244, 13, 'Lagunillas Mérida', 0),
(245, 13, 'Mérida', 1),
(246, 13, 'Mesa de Bolívar', 0),
(247, 13, 'Mucuchíes', 0),
(248, 13, 'Mucujepe', 0),
(249, 13, 'Mucuruba', 0),
(250, 13, 'Nueva Bolivia', 0),
(251, 13, 'Palmarito', 0),
(252, 13, 'Pueblo Llano', 0),
(253, 13, 'Santa Cruz de Mora', 0),
(254, 13, 'Santa Elena de Arenales', 0),
(255, 13, 'Santo Domingo', 0),
(256, 13, 'Tabáy', 0),
(257, 13, 'Timotes', 0),
(258, 13, 'Torondoy', 0),
(259, 13, 'Tovar', 0),
(260, 13, 'Tucani', 0),
(261, 13, 'Zea', 0),
(262, 14, 'Araguita', 0),
(263, 14, 'Carrizal', 0),
(264, 14, 'Caucagua', 0),
(265, 14, 'Chaguaramas Miranda', 0),
(266, 14, 'Charallave', 0),
(267, 14, 'Chirimena', 0),
(268, 14, 'Chuspa', 0),
(269, 14, 'Cúa', 0),
(270, 14, 'Cupira', 0),
(271, 14, 'Curiepe', 0),
(272, 14, 'El Guapo', 0),
(273, 14, 'El Jarillo', 0),
(274, 14, 'Filas de Mariche', 0),
(275, 14, 'Guarenas', 0),
(276, 14, 'Guatire', 0),
(277, 14, 'Higuerote', 0),
(278, 14, 'Los Anaucos', 0),
(279, 14, 'Los Teques', 1),
(280, 14, 'Ocumare del Tuy', 0),
(281, 14, 'Panaquire', 0),
(282, 14, 'Paracotos', 0),
(283, 14, 'Río Chico', 0),
(284, 14, 'San Antonio de Los Altos', 0),
(285, 14, 'San Diego de Los Altos', 0),
(286, 14, 'San Fernando del Guapo', 0),
(287, 14, 'San Francisco de Yare', 0),
(288, 14, 'San José de Los Altos', 0),
(289, 14, 'San José de Río Chico', 0),
(290, 14, 'San Pedro de Los Altos', 0),
(291, 14, 'Santa Lucía', 0),
(292, 14, 'Santa Teresa', 0),
(293, 14, 'Tacarigua de La Laguna', 0),
(294, 14, 'Tacarigua de Mamporal', 0),
(295, 14, 'Tácata', 0),
(296, 14, 'Turumo', 0),
(297, 15, 'Aguasay', 0),
(298, 15, 'Aragua de Maturín', 0),
(299, 15, 'Barrancas del Orinoco', 0),
(300, 15, 'Caicara de Maturín', 0),
(301, 15, 'Caripe', 0),
(302, 15, 'Caripito', 0),
(303, 15, 'Chaguaramal', 0),
(305, 15, 'Chaguaramas Monagas', 0),
(307, 15, 'El Furrial', 0),
(308, 15, 'El Tejero', 0),
(309, 15, 'Jusepín', 0),
(310, 15, 'La Toscana', 0),
(311, 15, 'Maturín', 1),
(312, 15, 'Miraflores', 0),
(313, 15, 'Punta de Mata', 0),
(314, 15, 'Quiriquire', 0),
(315, 15, 'San Antonio de Maturín', 0),
(316, 15, 'San Vicente Monagas', 0),
(317, 15, 'Santa Bárbara', 0),
(318, 15, 'Temblador', 0),
(319, 15, 'Teresen', 0),
(320, 15, 'Uracoa', 0),
(321, 16, 'Altagracia', 0),
(322, 16, 'Boca de Pozo', 0),
(323, 16, 'Boca de Río', 0),
(324, 16, 'El Espinal', 0),
(325, 16, 'El Valle del Espíritu Santo', 0),
(326, 16, 'El Yaque', 0),
(327, 16, 'Juangriego', 0),
(328, 16, 'La Asunción', 1),
(329, 16, 'La Guardia', 0),
(330, 16, 'Pampatar', 0),
(331, 16, 'Porlamar', 0),
(332, 16, 'Puerto Fermín', 0),
(333, 16, 'Punta de Piedras', 0),
(334, 16, 'San Francisco de Macanao', 0),
(335, 16, 'San Juan Bautista', 0),
(336, 16, 'San Pedro de Coche', 0),
(337, 16, 'Santa Ana de Nueva Esparta', 0),
(338, 16, 'Villa Rosa', 0),
(339, 17, 'Acarigua', 0),
(340, 17, 'Agua Blanca', 0),
(341, 17, 'Araure', 0),
(342, 17, 'Biscucuy', 0),
(343, 17, 'Boconoito', 0),
(344, 17, 'Campo Elías', 0),
(345, 17, 'Chabasquén', 0),
(346, 17, 'Guanare', 1),
(347, 17, 'Guanarito', 0),
(348, 17, 'La Aparición', 0),
(349, 17, 'La Misión', 0),
(350, 17, 'Mesa de Cavacas', 0),
(351, 17, 'Ospino', 0),
(352, 17, 'Papelón', 0),
(353, 17, 'Payara', 0),
(354, 17, 'Pimpinela', 0),
(355, 17, 'Píritu de Portuguesa', 0),
(356, 17, 'San Rafael de Onoto', 0),
(357, 17, 'Santa Rosalía', 0),
(358, 17, 'Turén', 0),
(359, 18, 'Altos de Sucre', 0),
(360, 18, 'Araya', 0),
(361, 18, 'Cariaco', 0),
(362, 18, 'Carúpano', 0),
(363, 18, 'Casanay', 0),
(364, 18, 'Cumaná', 1),
(365, 18, 'Cumanacoa', 0),
(366, 18, 'El Morro Puerto Santo', 0),
(367, 18, 'El Pilar', 0),
(368, 18, 'El Poblado', 0),
(369, 18, 'Guaca', 0),
(370, 18, 'Guiria', 0),
(371, 18, 'Irapa', 0),
(372, 18, 'Manicuare', 0),
(373, 18, 'Mariguitar', 0),
(374, 18, 'Río Caribe', 0),
(375, 18, 'San Antonio del Golfo', 0),
(376, 18, 'San José de Aerocuar', 0),
(377, 18, 'San Vicente de Sucre', 0),
(378, 18, 'Santa Fe de Sucre', 0),
(379, 18, 'Tunapuy', 0),
(380, 18, 'Yaguaraparo', 0),
(381, 18, 'Yoco', 0),
(382, 19, 'Abejales', 0),
(383, 19, 'Borota', 0),
(384, 19, 'Bramon', 0),
(385, 19, 'Capacho', 0),
(386, 19, 'Colón', 0),
(387, 19, 'Coloncito', 0),
(388, 19, 'Cordero', 0),
(389, 19, 'El Cobre', 0),
(390, 19, 'El Pinal', 0),
(391, 19, 'Independencia', 0),
(392, 19, 'La Fría', 0),
(393, 19, 'La Grita', 0),
(394, 19, 'La Pedrera', 0),
(395, 19, 'La Tendida', 0),
(396, 19, 'Las Delicias', 0),
(397, 19, 'Las Hernández', 0),
(398, 19, 'Lobatera', 0),
(399, 19, 'Michelena', 0),
(400, 19, 'Palmira', 0),
(401, 19, 'Pregonero', 0),
(402, 19, 'Queniquea', 0),
(403, 19, 'Rubio', 0),
(404, 19, 'San Antonio del Tachira', 0),
(405, 19, 'San Cristobal', 1),
(406, 19, 'San José de Bolívar', 0),
(407, 19, 'San Josecito', 0),
(408, 19, 'San Pedro del Río', 0),
(409, 19, 'Santa Ana Táchira', 0),
(410, 19, 'Seboruco', 0),
(411, 19, 'Táriba', 0),
(412, 19, 'Umuquena', 0),
(413, 19, 'Ureña', 0),
(414, 20, 'Batatal', 0),
(415, 20, 'Betijoque', 0),
(416, 20, 'Boconó', 0),
(417, 20, 'Carache', 0),
(418, 20, 'Chejende', 0),
(419, 20, 'Cuicas', 0),
(420, 20, 'El Dividive', 0),
(421, 20, 'El Jaguito', 0),
(422, 20, 'Escuque', 0),
(423, 20, 'Isnotú', 0),
(424, 20, 'Jajó', 0),
(425, 20, 'La Ceiba', 0),
(426, 20, 'La Concepción de Trujllo', 0),
(427, 20, 'La Mesa de Esnujaque', 0),
(428, 20, 'La Puerta', 0),
(429, 20, 'La Quebrada', 0),
(430, 20, 'Mendoza Fría', 0),
(431, 20, 'Meseta de Chimpire', 0),
(432, 20, 'Monay', 0),
(433, 20, 'Motatán', 0),
(434, 20, 'Pampán', 0),
(435, 20, 'Pampanito', 0),
(436, 20, 'Sabana de Mendoza', 0),
(437, 20, 'San Lázaro', 0),
(438, 20, 'Santa Ana de Trujillo', 0),
(439, 20, 'Tostós', 0),
(440, 20, 'Trujillo', 1),
(441, 20, 'Valera', 0),
(442, 21, 'Carayaca', 0),
(443, 21, 'Litoral', 0),
(444, 25, 'Archipiélago Los Roques', 0),
(445, 22, 'Aroa', 0),
(446, 22, 'Boraure', 0),
(447, 22, 'Campo Elías de Yaracuy', 0),
(448, 22, 'Chivacoa', 0),
(449, 22, 'Cocorote', 0),
(450, 22, 'Farriar', 0),
(451, 22, 'Guama', 0),
(452, 22, 'Marín', 0),
(453, 22, 'Nirgua', 0),
(454, 22, 'Sabana de Parra', 0),
(455, 22, 'Salom', 0),
(456, 22, 'San Felipe', 1),
(457, 22, 'San Pablo de Yaracuy', 0),
(458, 22, 'Urachiche', 0),
(459, 22, 'Yaritagua', 0),
(460, 22, 'Yumare', 0),
(461, 23, 'Bachaquero', 0),
(462, 23, 'Bobures', 0),
(463, 23, 'Cabimas', 0),
(464, 23, 'Campo Concepción', 0),
(465, 23, 'Campo Mara', 0),
(466, 23, 'Campo Rojo', 0),
(467, 23, 'Carrasquero', 0),
(468, 23, 'Casigua', 0),
(469, 23, 'Chiquinquirá', 0),
(470, 23, 'Ciudad Ojeda', 0),
(471, 23, 'El Batey', 0),
(472, 23, 'El Carmelo', 0),
(473, 23, 'El Chivo', 0),
(474, 23, 'El Guayabo', 0),
(475, 23, 'El Mene', 0),
(476, 23, 'El Venado', 0),
(477, 23, 'Encontrados', 0),
(478, 23, 'Gibraltar', 0),
(479, 23, 'Isla de Toas', 0),
(480, 23, 'La Concepción del Zulia', 0),
(481, 23, 'La Paz', 0),
(482, 23, 'La Sierrita', 0),
(483, 23, 'Lagunillas del Zulia', 0),
(484, 23, 'Las Piedras de Perijá', 0),
(485, 23, 'Los Cortijos', 0),
(486, 23, 'Machiques', 0),
(487, 23, 'Maracaibo', 1),
(488, 23, 'Mene Grande', 0),
(489, 23, 'Palmarejo', 0),
(490, 23, 'Paraguaipoa', 0),
(491, 23, 'Potrerito', 0),
(492, 23, 'Pueblo Nuevo del Zulia', 0),
(493, 23, 'Puertos de Altagracia', 0),
(494, 23, 'Punta Gorda', 0),
(495, 23, 'Sabaneta de Palma', 0),
(496, 23, 'San Francisco', 0),
(497, 23, 'San José de Perijá', 0),
(498, 23, 'San Rafael del Moján', 0),
(499, 23, 'San Timoteo', 0),
(500, 23, 'Santa Bárbara Del Zulia', 0),
(501, 23, 'Santa Cruz de Mara', 0),
(502, 23, 'Santa Cruz del Zulia', 0),
(503, 23, 'Santa Rita', 0),
(504, 23, 'Sinamaica', 0),
(505, 23, 'Tamare', 0),
(506, 23, 'Tía Juana', 0),
(507, 23, 'Villa del Rosario', 0),
(508, 21, 'La Guaira', 1),
(509, 21, 'Catia La Mar', 0),
(510, 21, 'Macuto', 0),
(511, 21, 'Naiguatá', 0),
(512, 25, 'Archipiélago Los Monjes', 0),
(513, 25, 'Isla La Tortuga y Cayos adyacentes', 0),
(514, 25, 'Isla La Sola', 0),
(515, 25, 'Islas Los Testigos', 0),
(516, 25, 'Islas Los Frailes', 0),
(517, 25, 'Isla La Orchila', 0),
(518, 25, 'Archipiélago Las Aves', 0),
(519, 25, 'Isla de Aves', 0),
(520, 25, 'Isla La Blanquilla', 0),
(521, 25, 'Isla de Patos', 0),
(522, 25, 'Islas Los Hermanos', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `testablecimientos`
--

CREATE TABLE `testablecimientos` (
  `idEstablecimientos` varchar(20) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` longtext NOT NULL,
  `sizeE` float NOT NULL,
  `habilitado` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `testablecimientos`
--

INSERT INTO `testablecimientos` (`idEstablecimientos`, `nombre`, `descripcion`, `sizeE`, `habilitado`) VALUES
('ESTCYA', 'Casas y Apartamentos', 'Casas y Apartamentos de un máximo de 120 mts2 update', 120.5, 1),
('ESTVP', 'Vehiculos Pequeños', 'carros, camionetas, vehiculos que no excedan los 4 metros cuadrados', 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `testados`
--

CREATE TABLE `testados` (
  `id_estado` int(11) NOT NULL,
  `estado` varchar(250) NOT NULL,
  `iso_3166-2` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `testados`
--

INSERT INTO `testados` (`id_estado`, `estado`, `iso_3166-2`) VALUES
(1, 'Amazonas', 'VE-X'),
(2, 'Anzoátegui', 'VE-B'),
(3, 'Apure', 'VE-C'),
(4, 'Aragua', 'VE-D'),
(5, 'Barinas', 'VE-E'),
(6, 'Bolívar', 'VE-F'),
(7, 'Carabobo', 'VE-G'),
(8, 'Cojedes', 'VE-H'),
(9, 'Delta Amacuro', 'VE-Y'),
(10, 'Falcón', 'VE-I'),
(11, 'Guárico', 'VE-J'),
(12, 'Lara', 'VE-K'),
(13, 'Mérida', 'VE-L'),
(14, 'Miranda', 'VE-M'),
(15, 'Monagas', 'VE-N'),
(16, 'Nueva Esparta', 'VE-O'),
(17, 'Portuguesa', 'VE-P'),
(18, 'Sucre', 'VE-R'),
(19, 'Táchira', 'VE-S'),
(20, 'Trujillo', 'VE-T'),
(21, 'La Guaira', 'VE-W'),
(22, 'Yaracuy', 'VE-U'),
(23, 'Zulia', 'VE-V'),
(24, 'Distrito Capital', 'VE-A'),
(25, 'Dependencias Federales', 'VE-Z');

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
  `idModulo` varchar(40) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tmodulos`
--

INSERT INTO `tmodulos` (`idModulo`, `nombre`, `status`) VALUES
('MBITACORAWGS', 'Bitácora', 1),
('MESTABLECIMIENTOSWGS', 'Establecimientos', 1),
('MMANTENIMIENTOWGS', 'Mantenimiento', 1),
('MNOTIFICACIONESWGS', 'Notificaciones', 1),
('MORDENESDESERVICIOWGS', 'Ordenes de Servicio', 1),
('MPAGOSWGS', 'Pagos', 1),
('MPRECIOSWGS', 'Precios', 1),
('MQUIMICOSWGS', 'Quimicos', 1),
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
  `idPermiso` varchar(40) NOT NULL,
  `nombre` varchar(20) NOT NULL,
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
-- Estructura de tabla para la tabla `tprecioservicios`
--

CREATE TABLE `tprecioservicios` (
  `id` int(11) NOT NULL,
  `servicio` varchar(20) NOT NULL,
  `establecimiento` varchar(20) NOT NULL,
  `precio` float NOT NULL,
  `habilitado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tprecioservicios`
--

INSERT INTO `tprecioservicios` (`id`, `servicio`, `establecimiento`, `precio`, `habilitado`) VALUES
(1, 'SERVCYC', 'ESTVP', 45, 1),
(2, 'SERVCYC', 'ESTCYA', 75, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tquimicos`
--

CREATE TABLE `tquimicos` (
  `idQuimico` varchar(20) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `foto` varchar(1000) NOT NULL,
  `descripcion` longtext NOT NULL,
  `habilitado` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tquimicos`
--

INSERT INTO `tquimicos` (`idQuimico`, `nombre`, `foto`, `descripcion`, `habilitado`) VALUES
('AS', 'asdasdasdasd', 'assets/img/uploads/C.U 04.drawio (1).png.png', 'adasdasdasdasdasdasdasdasdasdasd prueba update', 1),
('QU', 'QuimicoPrueba1', 'assets/img/uploads/.', 'asdasdasdasdasdasdasdasdasdasd', 1),
('RAPLP', 'Raticida Plagatox P', 'assets/img/uploads/.', 'Prueba prueba prueba prueba ', 1);

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
  `nombre` varchar(45) NOT NULL,
  `quimico` varchar(20) NOT NULL,
  `descripcion` longtext NOT NULL,
  `habilitado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tservicios`
--

INSERT INTO `tservicios` (`idServicio`, `nombre`, `quimico`, `descripcion`, `habilitado`) VALUES
('SERVCYC', 'Chiripas y Cucaracha', 'RAPLP', 'Prueba Prueba 01 de datos ', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tserviciosfumigador`
--

CREATE TABLE `tserviciosfumigador` (
  `id` int(11) NOT NULL,
  `idServicio` varchar(20) NOT NULL,
  `cedula` varchar(20) NOT NULL
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
  `ciudad` int(11) NOT NULL
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
('josetimaure60@gmail.com', '', 'Jose', 'Timaure', '', 'https://lh3.googleusercontent.com/a/ACg8ocJRESfHpvaFUA8v242WUFwFuXql-rmQ7fr05Ga-JlrNKARYpGxSeg=s96-c', 1, 'gmail_oauth', 'SAWGS1', '2024-06-09 14:21:23', 1),
('workglobalserviceca@gmail.com', '', 'Josnel', 'Guedez', '', 'https://lh3.googleusercontent.com/a/ACg8ocJ7XYRMlybwZhYlo0ebVr57DV1ETJMQZnJR6vzAX3tkSr0YNQ=s96-c', 1, 'gmail_oauth', 'SAWGS1', '2024-05-01 05:59:41', 1);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vistapermisosadministrador`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vistapermisosadministrador` (
`Modulo` varchar(20)
,`Crear` tinyint(4)
,`Consultar` tinyint(4)
,`Eliminar` tinyint(4)
,`Modificar` tinyint(4)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vistapermisosadministrador`
--
DROP TABLE IF EXISTS `vistapermisosadministrador`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vistapermisosadministrador`  AS SELECT `tmodulos`.`nombre` AS `Modulo`, (select `taccesos`.`status` from `taccesos` where `taccesos`.`modulo` = `tmodulos`.`idModulo` and `taccesos`.`permiso` = 'CREATEWGS') AS `Crear`, (select `taccesos`.`status` from `taccesos` where `taccesos`.`modulo` = `tmodulos`.`idModulo` and `taccesos`.`permiso` = 'CONSULTARWGS') AS `Consultar`, (select `taccesos`.`status` from `taccesos` where `taccesos`.`modulo` = `tmodulos`.`idModulo` and `taccesos`.`permiso` = 'ELIMINARWGS') AS `Eliminar`, (select `taccesos`.`status` from `taccesos` where `taccesos`.`modulo` = `tmodulos`.`idModulo` and `taccesos`.`permiso` = 'MODIFICARWGS') AS `Modificar` FROM (`taccesos` join `tmodulos` on(`tmodulos`.`idModulo` = `taccesos`.`modulo`)) WHERE `taccesos`.`rol` = 'SAWGS1' GROUP BY `taccesos`.`modulo` ;

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
  ADD PRIMARY KEY (`id_ciudad`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indices de la tabla `testablecimientos`
--
ALTER TABLE `testablecimientos`
  ADD PRIMARY KEY (`idEstablecimientos`);

--
-- Indices de la tabla `testados`
--
ALTER TABLE `testados`
  ADD PRIMARY KEY (`id_estado`);

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
  ADD KEY `email` (`email`);

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
-- Indices de la tabla `tserviciosfumigador`
--
ALTER TABLE `tserviciosfumigador`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idServicio` (`idServicio`),
  ADD KEY `cedula` (`cedula`);

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
  ADD KEY `ciudad` (`ciudad`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tciudades`
--
ALTER TABLE `tciudades`
  MODIFY `id_ciudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=523;

--
-- AUTO_INCREMENT de la tabla `testados`
--
ALTER TABLE `testados`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  ADD CONSTRAINT `tciudades_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `testados` (`id_estado`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Filtros para la tabla `tserviciosfumigador`
--
ALTER TABLE `tserviciosfumigador`
  ADD CONSTRAINT `tserviciosfumigador_ibfk_1` FOREIGN KEY (`idServicio`) REFERENCES `tservicios` (`idServicio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tserviciosfumigador_ibfk_2` FOREIGN KEY (`cedula`) REFERENCES `tfumigadores` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tubicaciones`
--
ALTER TABLE `tubicaciones`
  ADD CONSTRAINT `tubicaciones_ibfk_1` FOREIGN KEY (`ciudad`) REFERENCES `tciudades` (`id_ciudad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tusuarios`
--
ALTER TABLE `tusuarios`
  ADD CONSTRAINT `tusuarios_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `troles` (`IdRol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
