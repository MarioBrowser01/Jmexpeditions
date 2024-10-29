-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-08-2024 a las 03:02:48
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `jmexpeditions`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destinos`
--

CREATE TABLE `destinos` (
  `id_destino` int(11) NOT NULL,
  `codigo_destino` varchar(10) NOT NULL,
  `nombre_destino` varchar(50) NOT NULL,
  `ubicacion_destino` varchar(100) NOT NULL,
  `region_destino` varchar(25) NOT NULL,
  `provincia_destino` varchar(50) DEFAULT NULL,
  `dias_destino` int(11) NOT NULL,
  `descripcion_destino` text DEFAULT NULL,
  `imagen1_destino` longblob NOT NULL,
  `imagen2_destino` longblob DEFAULT NULL,
  `imagen3_destino` longblob DEFAULT NULL,
  `parque_reserva_destino` varchar(100) DEFAULT NULL,
  `id_categoria` varchar(6) NOT NULL,
  `f_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `visible` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `destinos`
--

INSERT INTO `destinos` (`id_destino`, `codigo_destino`, `nombre_destino`, `ubicacion_destino`, `region_destino`, `provincia_destino`, `dias_destino`, `descripcion_destino`, `imagen1_destino`, `imagen2_destino`, `imagen3_destino`, `parque_reserva_destino`, `id_categoria`, `f_creacion`, `visible`) VALUES
(1, 'LAROCOBL69', 'Laguna Rocutuyoc', 'Cordillera Blanca', 'Ancash', 'Carhuaz', 1, 'Una caminata de 30 minutos rodeando toda la laguna de Rocotuyoc e inclusive llegando a la Laguna Congelada.', 0x494d472d32303232313131312d5741303030342e6a7067, 0x494d475f32303232313131305f3039303930305f42555253543030315f434f5645522e6a7067, 0x494d472d32303232313131312d5741303034332e6a7067, 'Parque Nacional Huascaran', '35', '2024-08-06 17:59:44', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `destinos`
--
ALTER TABLE `destinos`
  ADD PRIMARY KEY (`id_destino`),
  ADD UNIQUE KEY `codigo_destino` (`codigo_destino`),
  ADD KEY `fk_destino_categoria` (`id_categoria`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `destinos`
--
ALTER TABLE `destinos`
  MODIFY `id_destino` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
