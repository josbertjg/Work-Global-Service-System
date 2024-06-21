-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-06-2024 a las 21:09:14
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
-- Estructura Stand-in para la vista `datosordenserviciocliente`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `datosordenserviciocliente` (
`Nro Orden` varchar(40)
,`Cliente` varchar(201)
,`Email` varchar(50)
,`Ubicacion` varchar(100)
,`Dia del Servicio` date
,`Hora` time
,`Fumigador` varchar(20)
,`Establecimiento` varchar(155)
,`Precio Inicial` double
,`Estado` enum('cancelada','agendada','Completada')
);

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
-- Estructura de tabla para la tabla `tclientes`
--

CREATE TABLE `tclientes` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tclientes`
--

INSERT INTO `tclientes` (`id`, `email`) VALUES
(13, 'AndreinaPTorres@gmail.com'),
(12, 'CamilaOropeza1089@gmail.com'),
(6, 'isabelmosquera@gmail.com'),
(1, 'jentimo0205@gmail.com'),
(10, 'KatherineLameda99@gmail.com'),
(11, 'mariaLameda18@gmail.com'),
(9, 'royferSuarez39@gmail.com'),
(8, 'SarahiTimaure@gmail.com'),
(14, 'tugo0220@gmail.com'),
(4, 'workglobalserviceca@gmail.com'),
(7, 'yadiraMosquera@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `testablecimientos`
--

CREATE TABLE `testablecimientos` (
  `idEstablecimientos` varchar(20) NOT NULL,
  `nombre` varchar(155) NOT NULL,
  `descripcion` longtext NOT NULL,
  `sizeE` float NOT NULL,
  `habilitado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `testablecimientos`
--

INSERT INTO `testablecimientos` (`idEstablecimientos`, `nombre`, `descripcion`, `sizeE`, `habilitado`) VALUES
('EAUTOSGRANDESWGS', 'Autos Grandes', 'Vehículos de mayor tamaño como por ejemplo: buses o camiones', 2, 1),
('EAUTOSWGS', 'Autos', 'Vehículos pequeños como por ejemplo: carros o camionetas.', 1, 1),
('ECASAGRANDEWGS', 'Casas Grandes', 'Casas o apartamentos grandes o de más de un piso.', 2, 1),
('ECASASWGS', 'Casas', 'Casas y apartamentos pequeños o de un solo piso.', 1, 1),
('EGALPONESGRANDESWGS', 'Galpones Grandes', 'Prueba de un insert con las validaciones de string listas para ser ejecutadas', 600, 1),
('EGALPONESWGS', 'Galpones', 'Galpones Industriales y almacenes update', 150, 1),
('ELOCALGRANDEWGS', 'Locales Grandes', 'Locales de un tamaño mayor o con más de un piso.', 2, 1),
('ELOCALWGS', 'Locales', 'Locales pequeños o de un solo piso.', 1, 1);

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

--
-- Volcado de datos para la tabla `tfacturas`
--

INSERT INTO `tfacturas` (`idFactura`, `orden`, `fecha`, `precioInicial`, `precioFinal`, `pagado`) VALUES
('FACT-00001', '240619-01', '2024-06-19 02:39:51', 110, 155, 0),
('FACT-00002', '240620-01', '2024-06-20 18:17:20', 55, 0, 0);

--
-- Disparadores `tfacturas`
--
DELIMITER $$
CREATE TRIGGER `ID_FACTURA` BEFORE INSERT ON `tfacturas` FOR EACH ROW BEGIN
    SET @CONTADOR = (SELECT COUNT(*) FROM tfacturas) + 1;
    SET NEW.idFactura = CONCAT('FACT-', LPAD(@CONTADOR, 5, '0'));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `P_INICIAL` BEFORE INSERT ON `tfacturas` FOR EACH ROW BEGIN
    DECLARE precioInicial DECIMAL(10,2);
    
    -- Calcula el precio inicial basado en las órdenes de servicio y los precios de servicio
   SELECT COALESCE(SUM(tprecioservicios.precio), 0) INTO precioInicial
FROM tordenesservicios
INNER JOIN tprecioservicios ON tordenesservicios.servicio = tprecioservicios.servicio
WHERE tordenesservicios.orden = NEW.orden
  AND tprecioservicios.establecimiento = (SELECT establecimiento FROM tordenes WHERE idOrdenes = NEW.orden);
    -- Asigna el precio inicial a la nueva factura antes de insertarla
    SET NEW.precioInicial = precioInicial;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tfacturasobrecargos`
--

CREATE TABLE `tfacturasobrecargos` (
  `id` int(11) NOT NULL,
  `factura` varchar(20) NOT NULL,
  `sobrecargo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tfacturasobrecargos`
--

INSERT INTO `tfacturasobrecargos` (`id`, `factura`, `sobrecargo`) VALUES
(2, 'FACT-00001', 'Sob-01');

--
-- Disparadores `tfacturasobrecargos`
--
DELIMITER $$
CREATE TRIGGER `PRECIO_FINAL` AFTER INSERT ON `tfacturasobrecargos` FOR EACH ROW BEGIN
    DECLARE totalSobrecargos DECIMAL(10,2);
    DECLARE precioInicialFactura DECIMAL(10,2);
    DECLARE precioFinal DECIMAL(10,2);
    SELECT precioInicial INTO precioInicialFactura FROM tfacturas WHERE idFactura =
    NEW.factura;
    SELECT SUM(precio) INTO totalSobrecargos FROM tsobrecargos
    INNER JOIN tfacturasobrecargos ON tsobrecargos.idSobrecargo = tfacturasobrecargos.sobrecargo
    WHERE tfacturasobrecargos.factura = NEW.factura;
    
    -- Calcula el precio final sumando el precio inicial y los sobrecargos
    SET precioFinal = precioInicialFactura + totalSobrecargos;
    
    -- Actualiza el precio final en la factura
    UPDATE tfacturas SET precioFinal = precioFinal WHERE idFactura = NEW.factura;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tfumigadores`
--

CREATE TABLE `tfumigadores` (
  `cedula` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `idUbicacion` varchar(100) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `imagenCedula` varchar(50) NOT NULL,
  `descripcion` varchar(1255) NOT NULL,
  `activo` tinyint(4) NOT NULL,
  `fechaValidado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tfumigadores`
--

INSERT INTO `tfumigadores` (`cedula`, `email`, `idUbicacion`, `fechaNacimiento`, `imagenCedula`, `descripcion`, `activo`, `fechaValidado`) VALUES
('123456789', 'tugo0220@gmail.com', 'Conjunto, 406, Cabudare 3023, Lara', '2004-01-02', '1234', 'Perfil de prueba del fumigador 1', 1, '2024-06-18'),
('28150010', 'josbertjg@gmail.com', '123', '2001-10-19', '123', 'Especialista en la exterminación de plagas y cualquier tipo de insectos que infesten su casa, con mas de 10 años de experiencia en el sector de eliminación y extinción de plagas', 1, '2024-01-16'),
('987654321', 'EmmaE@gmail.com', '10.076733403526658, -69.36812926153827', '2001-06-22', '23456', 'Descripcion de un Fumigador 2', 1, '2024-06-18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tordenes`
--

CREATE TABLE `tordenes` (
  `idOrdenes` varchar(40) NOT NULL,
  `fechaServicio` datetime NOT NULL,
  `cliente` int(11) NOT NULL,
  `fumigador` varchar(20) NOT NULL,
  `ubicacion` varchar(100) NOT NULL,
  `establecimiento` varchar(25) NOT NULL,
  `status` enum('cancelada','agendada','Completada') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tordenes`
--

INSERT INTO `tordenes` (`idOrdenes`, `fechaServicio`, `cliente`, `fumigador`, `ubicacion`, `establecimiento`, `status`) VALUES
('103ff04dbb', '2024-06-20 12:00:00', 4, '28150010', '123', 'ECASASWGS', 'cancelada'),
('142424c930', '2024-06-27 12:00:00', 4, '28150010', '123', 'ECASASWGS', 'cancelada'),
('20240625-1', '2024-06-25 12:00:00', 1, '28150010', '123', 'ECASASWGS', 'agendada'),
('20240625-2', '2024-06-25 16:00:00', 1, '28150010', '123', 'ECASASWGS', 'agendada'),
('20240627-2', '2024-06-27 08:00:00', 1, '28150010', '123', 'EAUTOSWGS', 'agendada'),
('20240627-3', '2024-06-27 08:00:00', 1, '28150010', '123', 'EAUTOSWGS', 'agendada'),
('20240628-2', '2024-06-28 16:00:00', 1, '28150010', '123', 'ECASASWGS', 'agendada'),
('240619-01', '2024-06-19 15:30:00', 13, '28150010', '123', 'ECASASWGS', 'cancelada'),
('240620-01', '2024-06-20 13:00:00', 13, '28150010', '2JXQ+WGF, Av. Los Horcones, Av. La Salle, Barquisimeto 3001, Lara', 'EAUTOSWGS', 'agendada'),
('240620-05', '2024-06-20 16:00:00', 12, '987654321', '2JXQ+WGF, Av. Los Horcones, Av. La Salle, Barquisimeto 3001, Lara', 'ECASASWGS', 'agendada'),
('240628-01', '2024-06-28 10:00:00', 12, '28150010', 'Conjunto, 406, Cabudare 3023, Lara', 'EGALPONESWGS', 'agendada'),
('240701-01', '2024-07-01 09:00:00', 13, '28150010', 'Conjunto, 406, Cabudare 3023, Lara', 'ECASASWGS', 'cancelada'),
('72d90b1186', '2024-06-21 16:00:00', 4, '28150010', '123', 'ECASASWGS', 'cancelada'),
('8e23daca9a', '2024-06-20 12:00:00', 4, '28150010', '123', 'ECASASWGS', 'cancelada'),
('fd4f34d60a', '2024-06-20 12:00:00', 4, '28150010', '123', 'ECASASWGS', 'cancelada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tordenesservicios`
--

CREATE TABLE `tordenesservicios` (
  `id` int(11) NOT NULL,
  `orden` varchar(20) NOT NULL,
  `servicio` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tordenesservicios`
--

INSERT INTO `tordenesservicios` (`id`, `orden`, `servicio`) VALUES
(1, '142424c930', 'SCUCARACHASWGS'),
(2, '142424c930', 'SCIENPIESWGS'),
(3, 'fd4f34d60a', 'SCUCARACHASWGS'),
(4, 'fd4f34d60a', 'SCIENPIESWGS'),
(5, '103ff04dbb', 'SCUCARACHASWGS'),
(6, '8e23daca9a', 'SCUCARACHASWGS'),
(7, '240701-01', 'SCUCARACHASWGS'),
(8, '240619-01', 'SCUCARACHASWGS'),
(9, '240619-01', 'SPULGASWGS'),
(10, '240620-01', 'SRATASWGS'),
(11, '240620-01', 'SCUCARACHASWGS'),
(12, '20240625-1', 'SCUCARACHASWGS'),
(13, '20240625-1', 'SPULGASWGS'),
(14, '20240625-2', 'SCUCARACHASWGS'),
(15, '20240625-2', 'SPULGASWGS'),
(16, '20240628-2', 'SPULGASWGS'),
(17, '20240628-2', 'SCUCARACHASWGS'),
(18, '20240627-2', 'SCUCARACHASWGS'),
(19, '20240627-2', 'SPULGASWGS'),
(20, '20240627-3', 'SCUCARACHASWGS'),
(21, '20240627-3', 'SPULGASWGS');

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
-- Estructura de tabla para la tabla `tprecioservicios`
--

CREATE TABLE `tprecioservicios` (
  `id` int(11) NOT NULL,
  `servicio` varchar(40) NOT NULL,
  `establecimiento` varchar(40) NOT NULL,
  `precio` float NOT NULL,
  `habilitado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tprecioservicios`
--

INSERT INTO `tprecioservicios` (`id`, `servicio`, `establecimiento`, `precio`, `habilitado`) VALUES
(1, 'SCUCARACHASWGS', 'ECASASWGS', 30, 1),
(2, 'SRATASWGS', 'ECASASWGS', 25, 1),
(3, 'STERMITASWGS', 'ECASASWGS', 60, 1),
(4, 'SPULGASWGS', 'ECASASWGS', 80, 1),
(5, 'SZANCUDOSWGS', 'ECASASWGS', 35, 1),
(6, 'SCIENPIESWGS', 'ECASASWGS', 70, 1),
(7, 'SCUCARACHASWGS', 'EAUTOSWGS', 25, 1),
(8, 'SRATASWGS', 'EAUTOSWGS', 30, 1),
(9, 'STERMITASWGS', 'EAUTOSWGS', 40, 1),
(10, 'SPULGASWGS', 'EAUTOSWGS', 50, 1);

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
('INPLCHPE15PR', 'Insecticida Plagatox Chiripas Pequeño 15', 'assets/img/uploads/images.jpg.jpg', 'Prueba de un update con solamente la imagen previa seleccionada', 1),
('INZA', 'Insecticida Zancudos123', 'assets/img/uploads/HE2d2zr6_400x400.jpeg.jpeg', 'Prueba de un Update no se porque a pura nunca le funciono(ejemplo de un update con imagen seleccionada)', 1),
('MA', 'Matagen1000', 'assets/img/uploads/WhatsApp Image 2024-04-08 at 1.26.59 PM.jpeg.jpeg', 'Matagen 1000 prueba de un insert al sistema', 1),
('MACU', 'Malevolo Cucarachon', 'assets/img/uploads/HE2d2zr6_400x400.jpeg.jpeg', 'El malevolo cucarachon se puso sentimental', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tservicios`
--

CREATE TABLE `tservicios` (
  `idServicio` varchar(20) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `quimico` varchar(20) NOT NULL,
  `descripcion` longtext NOT NULL,
  `fotoServicio` varchar(500) NOT NULL,
  `habilitado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tservicios`
--

INSERT INTO `tservicios` (`idServicio`, `nombre`, `quimico`, `descripcion`, `fotoServicio`, `habilitado`) VALUES
('SCIENPIESWGS', 'Bachacos, Gusanos, Culebras y Cien pies', 'INPLCHPE15PR', 'Servicio especializado en la eliminación de zancudos y mosquitos', 'assets/img/servicios/cienpies.svg', 1),
('SCUCARACHASWGS', 'Cucarachas, Chiripas y Hormigas', 'INPLCHPE15PR', 'Servicio especializado en la eliminación de Cucarachas, chiripas y hormigas', 'assets/img/servicios/cucarachas.svg', 1),
('SMADURISTASWGS', 'MADURISTAS', 'MACU', 'Prueba de un update desde el formulario el formulario en si', 'assets/img/servicios/images.jpeg.jpeg', 1),
('SPULGASWGS', 'Pulgas y Garrapatas', 'INPLCHPE15PR', 'Servicio especializado en la eliminación de pulgas y garrapatas', 'assets/img/servicios/pulgas.svg', 1),
('SRATASWGS', 'Ratas y Ratones', 'INPLCHPE15PR', 'Servicio especializado en la eliminación de ratas y ratones', 'assets/img/servicios/ratones.svg', 1),
('STERMITASWGS', 'Termitas y Comején', 'INPLCHPE15PR', 'Servicio especializado en la eliminación de termitas y comején', 'assets/img/servicios/termitas.svg', 1),
('SZANCUDOSWGS', 'Zancudos y Mosquitos', 'INPLCHPE15PR', 'Servicio especializado en la eliminación de zancudos y mosquitos', 'assets/img/servicios/zancudos.svg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tserviciosfumigador`
--

CREATE TABLE `tserviciosfumigador` (
  `id` int(11) NOT NULL,
  `idServicio` varchar(20) NOT NULL,
  `cedula` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tserviciosfumigador`
--

INSERT INTO `tserviciosfumigador` (`id`, `idServicio`, `cedula`) VALUES
(1, 'SCUCARACHASWGS', '28150010'),
(2, 'SCIENPIESWGS', '123456789'),
(3, 'SCUCARACHASWGS', '987654321'),
(4, 'SCIENPIESWGS', '987654321'),
(5, 'SZANCUDOSWGS', '987654321'),
(6, 'SPULGASWGS', '28150010');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tsobrecargos`
--

CREATE TABLE `tsobrecargos` (
  `idSobrecargo` varchar(20) NOT NULL,
  `precio` float NOT NULL,
  `descripcion` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tsobrecargos`
--

INSERT INTO `tsobrecargos` (`idSobrecargo`, `precio`, `descripcion`) VALUES
('Sob-01', 45, 'Uso de Doble quimico por infestancion mas grande de lo normal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tubicaciones`
--

CREATE TABLE `tubicaciones` (
  `idUbicacion` varchar(100) NOT NULL,
  `latitud` varchar(100) NOT NULL,
  `longitud` varchar(100) NOT NULL,
  `direccion` longtext NOT NULL,
  `ciudad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tubicaciones`
--

INSERT INTO `tubicaciones` (`idUbicacion`, `latitud`, `longitud`, `direccion`, `ciudad`) VALUES
('10.076733403526658, -69.36812926153827', '10.076733403526658', '-69.36812926153827', 'Urb Los Crepusculos, Sector 1 Calle 10', 214),
('123', '32132132', '32132131', 'una ubicacion', 4),
('2JXQ+WGF, Av. Los Horcones, Av. La Salle, Barquisimeto 3001, Lara', '10.051080773637668', '69.36265115270152', 'Universidad Politécnica Territorial Andres Eloy Blanco ', 212),
('2Q64+J69, Cabudare 3023, Lara', '10.011673028496663', '-69.24375564934013', 'Urb Los Bucares', 214),
('Conjunto, 406, Cabudare 3023, Lara', '10.013177240167913', '-69.243349112457', 'Conjunto Residencial 406 Cabudare', 214);

-- --------------------------------------------------------

--
-- Estructura para la vista `datosordenserviciocliente`
--
DROP TABLE IF EXISTS `datosordenserviciocliente`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `datosordenserviciocliente`  AS SELECT `tordenes`.`idOrdenes` AS `Nro Orden`, concat(`swgs`.`tusuarios`.`nombre`,' ',`swgs`.`tusuarios`.`apellido`) AS `Cliente`, `tclientes`.`email` AS `Email`, `tordenes`.`ubicacion` AS `Ubicacion`, cast(`tordenes`.`fechaServicio` as date) AS `Dia del Servicio`, cast(`tordenes`.`fechaServicio` as time) AS `Hora`, `tordenes`.`fumigador` AS `Fumigador`, `testablecimientos`.`nombre` AS `Establecimiento`, coalesce(sum(`tprecioservicios`.`precio`),0) AS `Precio Inicial`, `tordenes`.`status` AS `Estado` FROM (((((`tclientes` join `swgs`.`tusuarios` on(`tclientes`.`email` = `swgs`.`tusuarios`.`email`)) join `tordenes` on(`tclientes`.`id` = `tordenes`.`cliente`)) join `testablecimientos` on(`tordenes`.`establecimiento` = `testablecimientos`.`idEstablecimientos`)) left join `tordenesservicios` on(`tordenesservicios`.`orden` = `tordenes`.`idOrdenes`)) left join `tprecioservicios` on(`tordenesservicios`.`servicio` = `tprecioservicios`.`servicio`)) WHERE `tprecioservicios`.`establecimiento` = `tordenes`.`establecimiento` GROUP BY `tordenes`.`idOrdenes` ;

--
-- Índices para tablas volcadas
--

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
-- Indices de la tabla `tclientes`
--
ALTER TABLE `tclientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

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
  ADD KEY `tfumigadores_ibfk_2` (`idUbicacion`),
  ADD KEY `tfumigadores_ibfk_1` (`email`);

--
-- Indices de la tabla `tordenes`
--
ALTER TABLE `tordenes`
  ADD PRIMARY KEY (`idOrdenes`),
  ADD KEY `fumigador` (`fumigador`),
  ADD KEY `establecimiento` (`establecimiento`),
  ADD KEY `tordenes_ibfk_3` (`ubicacion`),
  ADD KEY `cliente` (`cliente`);

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
  ADD PRIMARY KEY (`idSobrecargo`);

--
-- Indices de la tabla `tubicaciones`
--
ALTER TABLE `tubicaciones`
  ADD PRIMARY KEY (`idUbicacion`),
  ADD KEY `ciudad` (`ciudad`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tciudades`
--
ALTER TABLE `tciudades`
  MODIFY `id_ciudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=523;

--
-- AUTO_INCREMENT de la tabla `tclientes`
--
ALTER TABLE `tclientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `testados`
--
ALTER TABLE `testados`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `tfacturasobrecargos`
--
ALTER TABLE `tfacturasobrecargos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tordenesservicios`
--
ALTER TABLE `tordenesservicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `tpagodetalles`
--
ALTER TABLE `tpagodetalles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tprecioservicios`
--
ALTER TABLE `tprecioservicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tserviciosfumigador`
--
ALTER TABLE `tserviciosfumigador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

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
-- Filtros para la tabla `tclientes`
--
ALTER TABLE `tclientes`
  ADD CONSTRAINT `tclientes_ibfk_1` FOREIGN KEY (`email`) REFERENCES `swgs`.`tusuarios` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tfacturas`
--
ALTER TABLE `tfacturas`
  ADD CONSTRAINT `tfacturas_ibfk_1` FOREIGN KEY (`orden`) REFERENCES `tordenes` (`idOrdenes`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `tfumigadores_ibfk_1` FOREIGN KEY (`email`) REFERENCES `swgs`.`tusuarios` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tfumigadores_ibfk_2` FOREIGN KEY (`idUbicacion`) REFERENCES `tubicaciones` (`idUbicacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tordenes`
--
ALTER TABLE `tordenes`
  ADD CONSTRAINT `tordenes_ibfk_1` FOREIGN KEY (`fumigador`) REFERENCES `tfumigadores` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tordenes_ibfk_3` FOREIGN KEY (`ubicacion`) REFERENCES `tubicaciones` (`idUbicacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tordenes_ibfk_4` FOREIGN KEY (`establecimiento`) REFERENCES `testablecimientos` (`idEstablecimientos`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tordenes_ibfk_5` FOREIGN KEY (`cliente`) REFERENCES `tclientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tordenesservicios`
--
ALTER TABLE `tordenesservicios`
  ADD CONSTRAINT `tordenesservicios_ibfk_1` FOREIGN KEY (`orden`) REFERENCES `tordenes` (`idOrdenes`) ON DELETE CASCADE ON UPDATE CASCADE,
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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
