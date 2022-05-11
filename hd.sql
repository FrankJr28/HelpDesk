-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-02-2022 a las 17:48:03
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id_Admin` bigint(10) NOT NULL,
  `nombre_Admin` char(30) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `ap_Pat_Admin` char(30) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `ap_Mat_Admin` char(30) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `contra_Admin` varchar(30) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id_Admin`, `nombre_Admin`, `ap_Pat_Admin`, `ap_Mat_Admin`, `contra_Admin`) VALUES
(1000, 'Fernando David', 'Cosío', 'Galván', 'fer123'),
(1001, 'Rodrigo', 'Nery', 'Vizcaíno', 'rod123'),
(1010, 'Daniel', 'Olmedo', 'Vaca', 'dan123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conversacion`
--

CREATE TABLE `conversacion` (
  `folio_con` varchar(7) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `id_Per` bigint(10) NOT NULL,
  `mensaje_usuario` varchar(300) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `mensaje_per` varchar(300) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `fh_con` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `conversacion`
--

INSERT INTO `conversacion` (`folio_con`, `id_Per`, `mensaje_usuario`, `mensaje_per`, `fh_con`) VALUES
('2661031', 12, '', '', '2021-12-03 01:28:53'),
('2661031', 12, 'hola', '', '2021-12-03 01:28:57'),
('1471706', 13, '', '', '2021-12-31 14:08:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `correo`
--

CREATE TABLE `correo` (
  `id_Correo` bigint(10) NOT NULL,
  `correo` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `correo`
--

INSERT INTO `correo` (`id_Correo`, `correo`) VALUES
(1, 'diego.barajas@cusur.udg.mx'),
(2, 'diego.barajas@cusur.udg.mx'),
(3, 'diego.barajas@cusur.udg.mx'),
(4, 'diego.barajas@cusur.udg.mx'),
(5, 'franja10028@gmail.com'),
(6, 'diego.barajas@cusur.udg.mx'),
(7, 'java10028@gmail.com'),
(8, 'miguelPL845@gmail.com'),
(9, 'damiangf123@gmail'),
(10, ''),
(11, 'luismecastolo@gmail.com'),
(12, ''),
(13, ''),
(14, 'ignaciorusa@gmail.com'),
(15, 'gil@gmail.com'),
(16, ''),
(17, ''),
(18, ''),
(19, ''),
(20, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edificio`
--

CREATE TABLE `edificio` (
  `id_Edi` int(11) NOT NULL,
  `edificio` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `edificio`
--

INSERT INTO `edificio` (`id_Edi`, `edificio`) VALUES
(6, 'Edificio B1'),
(10, 'Edificio H'),
(11, 'Edificio G'),
(12, 'Edificio P'),
(13, 'Edificio Q1'),
(16, 'Edificio G'),
(17, 'Biblioteca'),
(18, 'Auditorio'),
(19, 'Edificio U');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `id_Per` bigint(10) NOT NULL,
  `nombre_Per` char(30) COLLATE utf8_spanish2_ci NOT NULL,
  `ap_Pat_Per` char(30) COLLATE utf8_spanish2_ci NOT NULL,
  `ap_Mat_Per` char(30) COLLATE utf8_spanish2_ci NOT NULL,
  `contra_Per` char(30) COLLATE utf8_spanish2_ci NOT NULL,
  `estado_Per` bit(1) NOT NULL DEFAULT b'0',
  `activo_Per` bit(1) NOT NULL DEFAULT b'1',
  `id_Correo` bigint(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`id_Per`, `nombre_Per`, `ap_Pat_Per`, `ap_Mat_Per`, `contra_Per`, `estado_Per`, `activo_Per`, `id_Correo`) VALUES
(9, 'Diego', 'Velasco', 'Fernández', 'die123', b'0', b'1', 5),
(11, 'Gerardo', 'Barajas', 'Bernal', 'ger123', b'0', b'1', 7),
(12, 'Miguel', 'Peréz', 'López', 'mig123', b'1', b'1', 8),
(13, 'Damián', 'Suriwi', 'miranda', 'dam123', b'1', b'1', 9),
(15, 'Luis', 'Mejia', 'Castolo', 'lui123', b'1', b'1', 11),
(17, 'Damián', '', '1000', 'fer123', b'0', b'0', 13),
(18, 'Ignacio', 'Ruíz', 'Santelmo', 'ign123', b'0', b'0', 14),
(19, 'Gilberto', 'Chavez', 'Magaña', 'gil123', b'0', b'1', 15),
(20, 'a', '', '', '', b'0', b'0', 16),
(21, 'b', '', '', '', b'0', b'1', 17),
(22, 'c', '', '', '', b'0', b'0', 18),
(23, 'd', '', '', '', b'0', b'0', 19),
(24, 'e', '', '', '', b'0', b'0', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `queysug`
--

CREATE TABLE `queysug` (
  `id_qs` bigint(12) NOT NULL,
  `id_tictok` int(11) NOT NULL,
  `calif` smallint(6) NOT NULL,
  `qsoc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `queysug`
--

INSERT INTO `queysug` (`id_qs`, `id_tictok`, `calif`, `qsoc`) VALUES
(3, 95, 10, 'Excelente servicio'),
(5, 129, 8, '7'),
(6, 130, 8, 'Bien, sólo tardaron demasiado en atenderme\r\n'),
(7, 131, 5, '5'),
(8, 133, 9, 'no em eleg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `id_Ser` int(8) NOT NULL,
  `nombre_Ser` char(50) COLLATE utf8_spanish2_ci NOT NULL,
  `tipo_Ser` char(30) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `descripcion_Ser` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket`
--

CREATE TABLE `ticket` (
  `id_Ser` int(8) DEFAULT NULL,
  `id_Per` bigint(10) DEFAULT NULL,
  `id_Usu` bigint(10) NOT NULL,
  `problema_tic` varchar(100) NOT NULL,
  `fh_tic` datetime NOT NULL DEFAULT current_timestamp(),
  `estado_tic` char(11) NOT NULL,
  `id_tic` int(11) NOT NULL,
  `id_Ubi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ticket`
--

INSERT INTO `ticket` (`id_Ser`, `id_Per`, `id_Usu`, `problema_tic`, `fh_tic`, `estado_tic`, `id_tic`, `id_Ubi`) VALUES
(NULL, 9, 218887444, 'no', '2021-11-06 14:29:41', 'Finalizado', 95, 18),
(NULL, 9, 218887444, '2', '2021-11-06 14:39:33', 'Pendiente', 102, 19),
(NULL, 9, 218887444, '34', '2021-11-06 14:41:04', 'Pendiente', 104, 18),
(NULL, 9, 218887444, '34', '2021-11-06 14:41:51', 'Pendiente', 105, 18),
(NULL, 9, 218887444, '8', '2021-11-06 14:45:11', 'Pendiente', 107, 19),
(NULL, NULL, 218887444, '8', '2021-11-06 14:45:17', 'Pendiente', 108, 19),
(NULL, NULL, 218887444, '8', '2021-11-06 14:46:18', 'Pendiente', 109, 19),
(NULL, NULL, 218887444, '8', '2021-11-06 14:49:01', 'Pendiente', 111, 19),
(NULL, NULL, 218887444, '1234', '2021-11-06 14:51:26', 'Pendiente', 112, 18),
(NULL, NULL, 218887444, '1234', '2021-11-06 14:54:06', 'Pendiente', 113, 25),
(NULL, NULL, 218887444, '1234', '2021-11-06 14:54:48', 'Pendiente', 114, 25),
(NULL, NULL, 218887444, '1234', '2021-11-06 14:55:20', 'Pendiente', 115, 25),
(NULL, NULL, 218887444, '1233', '2021-11-06 14:56:16', 'Pendiente', 116, 19),
(NULL, NULL, 218887444, '236522', '2021-11-06 15:07:05', 'Pendiente', 118, 19),
(NULL, NULL, 218887444, '2365998754', '2021-11-06 15:11:37', 'Pendiente', 119, 18),
(NULL, 9, 218887215, 'No jala Unity', '2021-11-06 17:08:24', 'Finalizado', 121, 18),
(NULL, NULL, 218887444, '1234', '2021-11-06 17:28:25', 'Pendiente', 122, 19),
(NULL, NULL, 218887444, '1254', '2021-11-06 17:31:20', 'Pendiente', 123, 18),
(NULL, NULL, 218887444, '1235', '2021-11-06 21:40:38', 'Pendiente', 124, 18),
(NULL, NULL, 218887444, '12345', '2021-11-06 21:52:27', 'Pendiente', 125, 19),
(NULL, NULL, 218887444, 'no ', '2021-11-08 11:06:31', 'Pendiente', 126, 18),
(NULL, 9, 218887444, 'No baja el protector', '2021-12-01 17:15:36', 'Finalizado', 129, 19),
(NULL, 9, 218887123, 'No sirve mi compu', '2021-12-02 12:37:42', 'Finalizado', 130, 20),
(NULL, 11, 218887447, 'no hay red', '2021-12-02 13:13:01', 'Finalizado', 131, 19),
(NULL, NULL, 218777458, 'hola', '2021-12-02 13:48:57', 'Pendiente', 132, 18),
(NULL, 11, 29020950, 'no hay red en la impresora', '2021-12-02 13:50:30', 'Atendiendo', 133, 20),
(NULL, NULL, 218887444, 'lLorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi nulla maiores accusantium blandi', '2021-12-09 14:55:40', 'Pendiente', 134, 18),
(NULL, NULL, 44100, '45', '2022-01-04 00:37:22', 'Pendiente', 135, 19),
(NULL, NULL, 44100, 'enero5', '2022-01-05 23:15:42', 'Pendiente', 136, 18),
(NULL, NULL, 44100, 'enero5', '2022-01-05 23:17:16', 'Pendiente', 137, 18),
(NULL, NULL, 44100, 'enero5', '2022-01-05 23:17:19', 'Pendiente', 138, 18),
(NULL, NULL, 44100, '1234', '2022-01-05 23:17:27', 'Pendiente', 139, 18),
(NULL, NULL, 44100, '1234', '2022-01-05 23:18:36', 'Pendiente', 140, 18),
(NULL, NULL, 44100, '1234', '2022-01-05 23:18:38', 'Pendiente', 141, 18),
(NULL, NULL, 44100, 'enero7', '2022-01-05 23:20:14', 'Pendiente', 142, 18),
(NULL, NULL, 21112223, '135', '2022-01-10 13:37:54', 'Pendiente', 145, 18),
(NULL, NULL, 4410033, '140', '2022-01-10 13:39:48', 'Pendiente', 146, 18),
(NULL, NULL, 218887446, '142', '2022-01-10 13:41:35', 'Pendiente', 147, 18),
(NULL, NULL, 56984235, '145', '2022-01-10 13:43:50', 'Pendiente', 148, 18),
(NULL, NULL, 218887444, '888', '2022-01-10 13:44:41', 'Pendiente', 149, 18),
(NULL, NULL, 218887444, '151\r\n', '2022-01-10 13:51:24', 'Pendiente', 150, 18),
(NULL, NULL, 44100, '158', '2022-01-10 17:18:40', 'Pendiente', 152, 18),
(NULL, NULL, 44100, '153\r\n', '2022-01-10 17:20:47', 'Pendiente', 153, 18),
(NULL, NULL, 44100, '254', '2022-01-10 17:23:23', 'Pendiente', 154, 18),
(NULL, NULL, 44100, '155', '2022-01-10 17:29:11', 'Pendiente', 155, 18),
(NULL, NULL, 218887444, '531', '2022-01-10 17:31:36', 'Pendiente', 156, 18),
(NULL, NULL, 44100, '173', '2022-01-10 18:04:44', 'Pendiente', 173, 18),
(NULL, NULL, 44100, '174', '2022-01-10 18:06:02', 'Pendiente', 174, 18),
(NULL, NULL, 44100, '124444', '2022-01-10 18:09:40', 'Pendiente', 175, 18),
(NULL, NULL, 44100, '176', '2022-01-11 00:08:46', 'Pendiente', 176, 18),
(NULL, NULL, 44100, '177', '2022-01-11 00:10:08', 'Pendiente', 177, 18),
(NULL, NULL, 44100, '1778', '2022-01-11 00:11:45', 'Pendiente', 178, 18),
(NULL, NULL, 44100, '180', '2022-01-11 00:16:47', 'Pendiente', 179, NULL),
(NULL, NULL, 44100, '180', '2022-01-11 00:16:49', 'Pendiente', 180, NULL),
(NULL, NULL, 44100, '181', '2022-01-11 00:17:02', 'Pendiente', 181, NULL),
(NULL, NULL, 44100, '340\r\n', '2022-01-13 15:40:36', 'Pendiente', 184, 18),
(NULL, NULL, 44100, 'Error en el sistema', '2022-01-19 10:30:37', 'Pendiente', 185, 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `toqys`
--

CREATE TABLE `toqys` (
  `id_tok` int(11) NOT NULL,
  `id_tic` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `toqys`
--

INSERT INTO `toqys` (`id_tok`, `id_tic`) VALUES
(2147483647, 115),
(49383, 116),
(545, 118),
(56451, 121),
(34610, 122),
(27158, 124),
(66348, 125),
(56143, 132),
(45136, 134),
(17301, 145),
(58670, 146),
(74565, 147),
(57165, 148),
(32187, 149),
(5557, 150),
(57586, 152),
(38512, 153),
(51274, 154),
(68313, 155),
(47959, 156),
(52776, 173),
(66652, 174),
(77696, 175),
(85923, 176),
(51968, 177),
(80777, 178),
(27796, 179),
(93498, 180),
(13689, 181),
(70967, 184),
(49358, 185);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacion`
--

CREATE TABLE `ubicacion` (
  `id_Ubi` int(11) NOT NULL,
  `ubicacion_des` text NOT NULL,
  `edificio_corresp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ubicacion`
--

INSERT INTO `ubicacion` (`id_Ubi`, `ubicacion_des`, `edificio_corresp`) VALUES
(18, 'Coordinación Telemática', 6),
(19, 'Dpto computación', 10),
(20, 'Clínica escuela', 12),
(21, 'H', 10),
(22, 'Consejo Estudiantil', 19),
(23, 'Auditorio', 18),
(24, 'Biologia', 11),
(25, 'Aula G2', 6),
(26, 'Aula G3', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_Usu` bigint(10) NOT NULL,
  `nombre_Usu` char(30) COLLATE utf8_spanish2_ci NOT NULL,
  `ap_Pat_Usu` char(30) COLLATE utf8_spanish2_ci NOT NULL,
  `ap_Mat_Usu` char(30) COLLATE utf8_spanish2_ci NOT NULL,
  `correo_Usu` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `activo_Usu` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_Usu`, `nombre_Usu`, `ap_Pat_Usu`, `ap_Mat_Usu`, `correo_Usu`, `activo_Usu`) VALUES
(0, '', '', '', '', b'1'),
(44100, 'Fernando', 'Cosio', 'Jr.', 'fernando.cosio@cusur.udg.mx', b'1'),
(2118971, 'Gerardo', 'Jimenez', 'Haro', 'franciscoj.vasquezjr@gmail.com', b'1'),
(4410033, 'Francisco Javier', 'Vasquez', 'Jr.', 'francisco.vasquezjr@alumnos.udg.mx', b'1'),
(21112223, 'Francisco Javier', 'Vasquez', 'Jr.', 'francisco.vasquezjr@alumnos.udg.mx', b'1'),
(21888744, 'Francisco', 'Vasquez', 'Jr', 'franciscoj.vasquezjr@gmail.com', b'1'),
(29020950, 'Fernando', 'cosio', 'galvan', 'fernando.cosio@cusur.udg.mx', b'1'),
(29029050, 'fer', 'cos', 'gal', 'fernando.cosio@cusur.udg.mx', b'1'),
(56984235, 'Francisco Javier', 'Vasquez', 'Jr.', 'francisco.vasquezjr@alumnos.udg.mx', b'1'),
(123456789, '\"Jos\\u00e9\"', 'Cruz', 'Baron', 'francisco.vasquez@alumnos.udg.mx', b'1'),
(215698745, 'Juan', 'Vela', 'Martínez', 'juan.vasque@alumnos.udg.mx', b'1'),
(216985474, 'José', 'Cruz', 'Velasco', 'jose.velasco@alumnos.udg.mx', b'1'),
(218777458, 'Francisco Javier', 'Vasquez', 'Jr', 'francisco.vasquezjr@alumnos.udg.mx', b'1'),
(218877444, '\"pruebauno\"', 'Cruz', 'Cruz', 'francisco.vasquez@alumnos.udg.mx', b'1'),
(218887123, 'Jose', 'Vasquez', 'Jr', 'francisco.vasquezjr@alumnos.udg.mx', b'1'),
(218887215, 'Brenda', 'Gallardo', 'Baron', 'franciscoj.vasquezjr@gmail.com', b'1'),
(218887239, 'Dami&aacute;n', 'Barboza', 'Garza', 'francisco.vasquez@alumnos.udg.mx', b'1'),
(218887442, 'Daniel', 'Contreras', 'Bernardino', 'daniel.contreras@alumnos.udg.mx', b'1'),
(218887443, 'Francisco', 'Vásquez and', 'Jr', 'francisco.vasquez@alumnos.udg.mx', b'1'),
(218887444, 'Fran', 'vas', 'jh', 'francisco.vasquezjr@alumnos.udg.mx', b'1'),
(218887446, 'Francisco Javier', 'Vasquez', 'Jr.', 'francisco.vasquezjr@alumnos.udg.mx', b'1'),
(218887447, 'Francisco Javier', 'Vasquez', 'Jr', 'francisco.vasquezjr@alumnos.udg.mx', b'1'),
(218887484, 'Francisc8', 'Vasquez', 'Jr', 'francisco.vasquezjr@alumnos.udg.mx', b'1'),
(218888888, '\"pruebados\"', 'Cruz', 'Cruz', 'francisco.vasquez@alumnos.udg.mx', b'1'),
(236669554, 'José', 'Cruz', 'Baron', 'josecb@alumnos.udg.mx', b'1'),
(269358471, 'pruebauno', 'd', 'erget', 'francisc@alumnos.udg.mx', b'1'),
(2569985412, 'Jose Miguel', 'Rodriguez', 'Hernandez', 'jose.rodriguez@alumnos.udg.mx', b'1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id_Admin`);

--
-- Indices de la tabla `conversacion`
--
ALTER TABLE `conversacion`
  ADD KEY `id_Per` (`id_Per`);

--
-- Indices de la tabla `correo`
--
ALTER TABLE `correo`
  ADD PRIMARY KEY (`id_Correo`);

--
-- Indices de la tabla `edificio`
--
ALTER TABLE `edificio`
  ADD PRIMARY KEY (`id_Edi`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`id_Per`),
  ADD KEY `id_Cor` (`id_Correo`);

--
-- Indices de la tabla `queysug`
--
ALTER TABLE `queysug`
  ADD PRIMARY KEY (`id_qs`),
  ADD KEY `id_tic_tok` (`id_tictok`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id_Ser`);

--
-- Indices de la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id_tic`),
  ADD KEY `id_Per` (`id_Per`),
  ADD KEY `id_Ser` (`id_Ser`),
  ADD KEY `id_Usu` (`id_Usu`),
  ADD KEY `id_Ubi` (`id_Ubi`);

--
-- Indices de la tabla `toqys`
--
ALTER TABLE `toqys`
  ADD PRIMARY KEY (`id_tok`),
  ADD KEY `id_ticket` (`id_tic`);

--
-- Indices de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  ADD PRIMARY KEY (`id_Ubi`),
  ADD KEY `id_Edi` (`edificio_corresp`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_Usu`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id_Admin` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1012;

--
-- AUTO_INCREMENT de la tabla `correo`
--
ALTER TABLE `correo`
  MODIFY `id_Correo` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `edificio`
--
ALTER TABLE `edificio`
  MODIFY `id_Edi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `id_Per` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `queysug`
--
ALTER TABLE `queysug`
  MODIFY `id_qs` bigint(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id_Ser` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id_tic` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  MODIFY `id_Ubi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `conversacion`
--
ALTER TABLE `conversacion`
  ADD CONSTRAINT `conversacion_ibfk_1` FOREIGN KEY (`id_Per`) REFERENCES `personal` (`id_Per`);

--
-- Filtros para la tabla `personal`
--
ALTER TABLE `personal`
  ADD CONSTRAINT `id_Cor` FOREIGN KEY (`id_Correo`) REFERENCES `correo` (`id_Correo`) ON DELETE SET NULL;

--
-- Filtros para la tabla `queysug`
--
ALTER TABLE `queysug`
  ADD CONSTRAINT `queysug_ibfk_1` FOREIGN KEY (`id_tictok`) REFERENCES `ticket` (`id_tic`);

--
-- Filtros para la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `id_Ubi` FOREIGN KEY (`id_Ubi`) REFERENCES `ubicacion` (`id_Ubi`) ON DELETE SET NULL,
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`id_Per`) REFERENCES `personal` (`id_Per`),
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`id_Ser`) REFERENCES `servicio` (`id_Ser`),
  ADD CONSTRAINT `ticket_ibfk_3` FOREIGN KEY (`id_Usu`) REFERENCES `usuario` (`id_Usu`);

--
-- Filtros para la tabla `toqys`
--
ALTER TABLE `toqys`
  ADD CONSTRAINT `id_tic` FOREIGN KEY (`id_tic`) REFERENCES `ticket` (`id_tic`) ON DELETE CASCADE,
  ADD CONSTRAINT `id_ticket` FOREIGN KEY (`id_tic`) REFERENCES `ticket` (`id_tic`) ON DELETE CASCADE,
  ADD CONSTRAINT `toqys_ibfk_1` FOREIGN KEY (`id_tic`) REFERENCES `ticket` (`id_tic`);

--
-- Filtros para la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  ADD CONSTRAINT `id_Edi` FOREIGN KEY (`edificio_corresp`) REFERENCES `edificio` (`id_Edi`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
