-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-11-2024 a las 01:53:32
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
-- Estructura de tabla para la tabla `bachup_categorias`
--

CREATE TABLE `bachup_categorias` (
  `id` int(11) NOT NULL,
  `codigo` varchar(8) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `cod_categoria` varchar(6) NOT NULL,
  `nombre_categoria` varchar(50) NOT NULL,
  `descripcion_categoria` varchar(200) NOT NULL,
  `f_creacion` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `cod_categoria`, `nombre_categoria`, `descripcion_categoria`, `f_creacion`) VALUES
(1, 'CA001', 'Turismo natural', 'Lugares donde el entorno natural es la atracción principal', '2024-08-05 19:46:09'),
(2, 'CA002', 'Andinismo', 'Escalada montañas, caminatas por montañas.', '2024-08-05 19:57:05'),
(3, 'CA003', 'Turismo cultural', 'Restos arqueológicas, construcciones antiguas, ruinas. ', '2024-08-05 19:59:26'),
(4, 'CA004', 'Turismo vivencial ', 'Visitas a comunidades o poblaciones costumbristas, valorando las culturas y promoviendo dichas costumbres.', '2024-08-05 20:07:59'),
(5, 'CA005', 'Cultural', 'Restos arqueológicos y museos', '2024-08-27 10:29:19'),
(6, 'CA006', 'Trekking', 'Caminatas por senderos de naturaleza.', '2024-08-27 10:31:41'),
(7, 'CA007', 'Volcanes', 'Montañas en lugares situado sobre la superficie terrestre en el que se produce la expulsión de material magmático, ', '2024-08-27 10:33:47'),
(8, 'CA008', 'Ecoturismo', 'Forma de turismo orientada a la conservación y sostenibilidad', '2024-08-27 10:41:46'),
(9, 'CA0009', 'Lagunas', 'Acumulación de agua dulce bajo las cordilleras', '2024-11-05 13:05:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_paquetes`
--

CREATE TABLE `categorias_paquetes` (
  `id_categoria` int(11) NOT NULL,
  `id_paquete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre_cliente` varchar(255) DEFAULT NULL,
  `email_cliente` varchar(255) DEFAULT NULL,
  `telefono_cliente` varchar(20) DEFAULT NULL,
  `direccion_cliente` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id_departamento` int(11) NOT NULL,
  `nombre_departamento` varchar(255) NOT NULL,
  `id_pais` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id_departamento`, `nombre_departamento`, `id_pais`) VALUES
(1, 'Ancash', 1),
(2, 'Cusco', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destinos`
--

CREATE TABLE `destinos` (
  `id_destino` int(11) NOT NULL,
  `codigo_destino` varchar(10) NOT NULL,
  `nombre_destino` varchar(50) NOT NULL,
  `ubicacion_destino` varchar(100) NOT NULL,
  `id_departamento` int(11) DEFAULT NULL,
  `id_provincia` int(11) DEFAULT NULL,
  `descripcion_destino` text DEFAULT NULL,
  `imagen1_destino` longblob NOT NULL,
  `imagen2_destino` longblob DEFAULT NULL,
  `imagen3_destino` longblob DEFAULT NULL,
  `parque_reserva_destino` varchar(100) DEFAULT NULL,
  `id_categoria` varchar(6) NOT NULL,
  `f_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `visible` tinyint(1) DEFAULT 1,
  `altitud_destino` float DEFAULT NULL,
  `id_pais` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `destinos`
--

INSERT INTO `destinos` (`id_destino`, `codigo_destino`, `nombre_destino`, `ubicacion_destino`, `id_departamento`, `id_provincia`, `descripcion_destino`, `imagen1_destino`, `imagen2_destino`, `imagen3_destino`, `parque_reserva_destino`, `id_categoria`, `f_creacion`, `visible`, `altitud_destino`, `id_pais`) VALUES
(1, 'LAROCOBL69', 'Laguna Rocotuyoc', 'Cordillera Blanca', 1, 6, 'Una caminata de 30 minutos rodeando toda la laguna de Rocotuyoc e inclusive llegando a visitar a la Laguna Congelada', 0x4453434e333833332e4a5047, 0x4453434e333835382e4a5047, 0x464844303031322e4a5047, 'Parque Nacional Huascaran.', '35', '2024-08-06 17:59:44', 1, 4550, 1),
(2, 'LALLCOBL00', 'Laguna Llanganuco', 'Cordillera Blanca', 1, 20, 'Caminata breve de 15 minutos desde la parada', 0x313931302e4a5047, 0x494d475f32303231313131315f3130343134302e6a7067, 0x313933312e4a5047, 'Parque Nacional Huascaran', '35', '2024-08-09 11:15:07', 1, 3850, 1),
(3, 'LAJACOHU49', 'Laguna Jahuacocha', 'Cordillera Huayhuash', 1, 5, 'Esta laguna de aguas cristalinas, ofrece vistas espectaculares de las paredes occidentales de los picos de la cordillera', 0x444a495f303035392e4a5047, 0x31332d303520526f6e646f79204a6972697368616e63612079205965727570616ac3a12e6a7067, 0x576861747341707020496d61676520323032332d30392d313920617420332e34392e343020504d202833292e6a706567, 'Comunidad Pacllon', '35', '2024-08-16 10:56:14', 1, 4053, 1),
(4, 'LACOCOBL46', 'Laguna Congelada', 'Cordillera Blanca', 1, 6, 'La laguna congelada esta detrás de la laguna congelada', 0x4453434e393632302e4a5047, 0x4453434e393632392e4a5047, 0x4453434e393630392e4a5047, 'Parque Nacional Huascaran', '35', '2024-08-23 09:15:11', 1, 4520, 1),
(5, 'LA69COBL93', 'Laguna 69', 'Cordillera Blanca', 1, 20, 'La Laguna 69, situada en el Parque Nacional Huascarán, es un impresionante espejo de agua turquesa ubicado a 4,600 metros sobre el nivel del mar. Rodeada de imponentes picos nevados y alimentada por el deshielo de los glaciares, es un destino popular para senderistas que buscan paisajes naturales de ensueño en la Cordillera Blanca.', 0x3939382e6a7067, 0x696d6167652e706e67, 0x62623339333061376264373632313461656237663133303838653963373534302e6a7067, 'Parque Nacional Huascaran', '35', '2024-09-04 17:14:20', 1, 4604, 1),
(9, 'CASACADE26', 'Campo Santo', 'Callejón de Huaylas', 1, 20, 'El Campo Santo que se encuentra ubicado en la ciudad de Yungay, uno de los pueblos mas prósperos del Callejón de Huaylas. ', 0x494d472d32303138303731362d5741303032322e6a7067, NULL, NULL, 'Ninguna', '51', '2024-09-23 12:49:39', 1, 2548, 1),
(10, 'LAPACOBL76', 'Laguna Paron', 'Cordillera Blanca', 1, 20, 'La laguna mas popular del callejon de Huaylas', 0x313636343637333037353038342e6a7067, 0x323035382e4a5047, 0x494d475f32303232313032345f3133323433355f42555253543030322e6a7067, 'Parque Nacional Huascaran', '35', '2024-09-28 13:36:18', 1, 0, 1),
(11, 'PIMACOBL68', 'Pico Mateo', 'Cordillera Blanca', 1, 6, 'Escalada al nevado mateo', 0x313636313633353236383133352e6a7067, 0x494d472d32303232303931342d5741303032362e6a7067, 0x313636313633353236393430382e6a7067, 'Parque Nacional Huascaran', '36', '2024-09-30 18:26:28', 1, 5150, 1),
(12, 'CIDECADE26', 'Ciudad de Carhuaz', 'Callejón de Huaylas', 1, 6, 'La ciudad de carhuaz es mayormente caracterizado por la dulzura de sus helados artesanales de sabores inolvidables. Está ubicado a 40 min, al norte de Huaraz.', 0x3131383736383039385f3630333831373437363935353535325f363335303736323834373937343839323534335f6e2e706e67, 0x6361726875617a2d65313633313035373133393833302e6a7067, NULL, 'Ninguna', '40', '2024-10-01 16:31:04', 1, 2648, 1),
(13, 'CIDECADE81', 'Ciudad de Caraz', 'Callejón de Huaylas', 1, 12, 'A esta ciudad se le conoce como \"Caraz Dulzura\" por sus deliciosos postres realizados a base de leche como el \"manjarblanco\", la \"cuarteada\", \"pasteles\", \"pastelillos\" y los \"Helados\". Asimismo podemos encontrar platos típicos de fondo como el picante de cuy, los Chicharrones, el Tamal, el charqui y la llunca de gallina.', 0x4f49502e6a7067, 0x4f4950202831292e6a7067, NULL, 'Ninguna', '40', '2024-10-01 16:59:27', 1, 2256, 1),
(14, 'CAPACOBL54', 'Catarata Pacharuri', 'Cordillera Blanca', 1, 6, 'Vista a una hermosa catarata originaria del deshielo del Nevado...', 0x4453434e333838362e4a5047, 0x4453434e333930302e4a5047, 0x4453434e333839342e4a5047, 'Parque Nacional Huascaran', '35', '2024-10-14 18:52:27', 1, 0, 1),
(15, 'DIDEPLAZ41', 'Distrito de Pacllon ', 'Plaza', 1, 5, 'Pueblo pintoresco que da muestra su cultura y arte en sus calles', 0x32303234303333315f3136313332302e6a7067, 0x4453434e393135362e4a5047, 0x32303234303430355f3130313232352e6a7067, 'Ninguna', '40', '2024-10-14 19:23:41', 1, 0, 1),
(16, 'RODECOHU16', 'Rodeo', 'Cordillera Huayhuash', 1, 5, 'Restos deconstrucciones con piedras', 0x50313034303630322e4a5047, 0x50313034303630352e4a5047, 0x50313034303630312e4a5047, 'Reserva comunal Pacllon', '37', '2024-10-14 19:36:19', 1, 3450, 1),
(17, 'LALLCADE76', 'Laguna Llaca', 'Callejón de Huaylas', 1, 1, 'La laguna se emplaza en una hoyada teniendo como marco elevaciones rocosas que se yerguen a ambos lados como producto de la acumulación de material aluvial. Desde el campamento base se puede realizar el ascenso a importantes cumbres de la Cordillera Blanca como el Vallunaraju (5686 m), el Ranrapalca (6162 m) y el Ocshapalca (5881 m s.n.m.). Sus aguas de color verde turquesa, provienen del subsuelo y de los deshielos de los nevados próximos. Es la laguna más cercana a la ciudad de Huaraz a la que se accede con vehículo para el desarrollo del turismo convencional, asimismo es un lugar estratégico que permite observar el proceso de deglaciación a consecuencia de los efectos del cambio climático.', 0x4453434e393232352e4a5047, 0x4453434e393232312e4a5047, 0x4453434e393232302e4a5047, 'Parque Nacional Huascaran', '9', '2024-11-05 13:08:47', 1, 4474, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `id` varchar(11) NOT NULL,
  `nombre_empresa` varchar(50) NOT NULL,
  `correo_empresa` text NOT NULL,
  `telefono_empresa` varchar(10) NOT NULL,
  `logo_empresa` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `id_horario` int(11) NOT NULL,
  `id_paquete` int(11) DEFAULT NULL,
  `dia` int(11) DEFAULT NULL,
  `hora_salida` time DEFAULT NULL,
  `hora_retorno` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes_destinos`
--

CREATE TABLE `imagenes_destinos` (
  `id_imagen` int(11) NOT NULL,
  `id_destino` int(11) DEFAULT NULL,
  `url_imagen` varchar(255) DEFAULT NULL,
  `descripcion_imagen` text DEFAULT NULL,
  `f_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `f_editado` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `imagenes_destinos`
--

INSERT INTO `imagenes_destinos` (`id_imagen`, `id_destino`, `url_imagen`, `descripcion_imagen`, `f_creacion`, `f_editado`) VALUES
(1, 3, 'Imagen10 - copia.jpg', 'vista de quebrada', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 3, 'Imagen7 - copia.jpg', 'Rodeo (full day)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 3, 'DSCN8880.JPG', 'En la boca de la laguna Jahuacocha.', '0000-00-00 00:00:00', '2024-10-01 19:24:38'),
(5, 2, 'montana-laguna-llanganuco.jpg', 'Desde la quebrada.', '2024-08-28 23:31:24', '0000-00-00 00:00:00'),
(7, 4, 'Imagen de WhatsApp 2024-08-09 a las 21.43.37_173d392e.jpg', '', '2024-08-28 23:31:58', '0000-00-00 00:00:00'),
(10, 2, '9c.jpg', '', '2024-08-28 23:33:29', '0000-00-00 00:00:00'),
(11, 1, 'laguna-rocotuyoc-laguna-congelada.jpg', 'Vista desde la entrada.', '2024-08-28 23:33:47', '2024-09-23 16:16:53'),
(12, 3, 'DSCN8971 (1).JPG', 'Caminata a la laguna.', '2024-09-03 11:42:07', '2024-09-03 11:43:18'),
(13, 5, '69.jpg', 'vista con el nevado', '2024-09-04 21:44:58', '0000-00-00 00:00:00'),
(14, 5, 'laguna69-in-huaraz-1.jpg', 'Vista desde el camino', '2024-09-04 21:45:23', '0000-00-00 00:00:00'),
(15, 5, 'LAGUNA-69-1.jpg', 'Vista panoramica de la laguna', '2024-09-04 21:45:46', '0000-00-00 00:00:00'),
(16, 3, 'DSCN8889.JPG', 'pampa vista a jerupaja', '2024-09-11 15:23:11', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `itinerarios`
--

CREATE TABLE `itinerarios` (
  `id_itinerario` int(11) NOT NULL,
  `id_paquete` int(11) DEFAULT NULL,
  `id_destino` int(11) DEFAULT NULL,
  `orden_itinerario` int(11) DEFAULT NULL,
  `hora_salida` time DEFAULT NULL,
  `tipo_destino` varchar(24) NOT NULL,
  `descripcion_actividad` text DEFAULT NULL,
  `f_creacion` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `itinerarios`
--

INSERT INTO `itinerarios` (`id_itinerario`, `id_paquete`, `id_destino`, `orden_itinerario`, `hora_salida`, `tipo_destino`, `descripcion_actividad`, `f_creacion`) VALUES
(1, 1, 5, 1, '08:30:00', 'Final', 'Avistamiento y caminata alrededor de la laguna 69', '2024-09-04'),
(3, 4, 9, 1, '01:00:00', 'Final', 'Destino final', '2024-09-23'),
(4, 2, 2, 1, '08:00:00', 'Final', 'Se da un paseo por la quebrada de llanganuco', '2024-10-01'),
(5, 2, 12, 2, '10:00:00', 'Transitorio', 'Se da una parada breve en la plazuela de Carhuaz a degustar los helados ', '2024-10-01'),
(6, 12, 1, 1, '09:30:00', 'Final', 'Vista de la laguna de Rocotuyoc se bordea a la laguna por un aproximado de 30 minutos llegando asi a una de las lagunas majestuosas con pedazos de hielo desprendido llamado laguna congelada', '2024-10-14'),
(7, 12, 14, 2, '00:00:00', 'Transitorio', 'Parada en la catarata donde también se puede visualizar dibujos rupestres en las piedras', '2024-10-14'),
(8, 3, 3, 1, '05:00:00', 'Final', 'Iniciamos el recorrido desde Rondoy', '2024-10-14'),
(9, 13, 11, 1, '06:00:00', 'Final', 'Escalamos al nevado Mateo con todos los implementos posibles', '2024-10-14'),
(10, 3, 15, 4, '00:00:00', 'Transitorio', 'Visita a la localidad pintoresca del corazon de Huayhuash el distrito de Pacllon', '2024-10-14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `id_pais` int(11) NOT NULL,
  `nombre_pais` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`id_pais`, `nombre_pais`) VALUES
(1, 'Perú'),
(2, 'Colombia'),
(3, 'Bolivia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquetes`
--

CREATE TABLE `paquetes` (
  `id_paquete` int(11) NOT NULL,
  `nombre_paquete` varchar(255) DEFAULT NULL,
  `descripcion_paquete` text DEFAULT NULL,
  `duracion_paquete` int(11) DEFAULT NULL,
  `precio_paquete` decimal(10,2) DEFAULT NULL,
  `disponibilidad_paquete` tinyint(1) DEFAULT NULL,
  `f_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `tipo_paquete` enum('FullDay','Varios días') NOT NULL,
  `f_actualizacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `noches_paquete` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paquetes`
--

INSERT INTO `paquetes` (`id_paquete`, `nombre_paquete`, `descripcion_paquete`, `duracion_paquete`, `precio_paquete`, `disponibilidad_paquete`, `f_creacion`, `tipo_paquete`, `f_actualizacion`, `noches_paquete`) VALUES
(1, 'Aventura a la laguna 69', 'Un emocionante recorrido por las maravillas naturales y culturales de Áncash...', 1, 70.00, 1, '2024-09-04 16:56:32', 'FullDay', '0000-00-00 00:00:00', 0),
(2, 'Aventura a la laguna Llanganuco', 'Un emocionante recorrido por las maravillas naturales y culturales de Áncash pasando por Yungay', 1, 60.00, 1, '2024-09-04 16:58:59', 'FullDay', '0000-00-00 00:00:00', 0),
(3, 'Aventura a la laguna Jahuacocha', 'Un emocionante recorrido por las maravillas naturales y culturales de Bolognesi en la cordillera Huayhuash pasando por Chiquian espejito del cielo', 1, 300.00, 1, '2024-09-04 17:01:30', 'FullDay', '0000-00-00 00:00:00', 0),
(4, 'Aventura a campo santos', 'Caminata por ciudad sepultada de Yungay con el nombre de campo santos', 1, 40.00, 1, '2024-09-23 12:49:26', 'FullDay', '0000-00-00 00:00:00', 0),
(12, 'Aventura a Rocotuyoc', 'Llegada hasta la laguna congelada', 1, 60.00, 1, '2024-09-30 18:46:46', 'FullDay', '2024-09-30 23:46:46', 0),
(13, 'Escalada a Pico Mateo', 'Es un tour que conlleva trekking hasta pisar hielo', 1, 250.00, 0, '2024-09-30 19:06:36', 'FullDay', '2024-10-01 00:06:36', 0),
(15, 'Expedición a Paron', 'Una de las lagunas mas majestuosas de la región Ancash', 1, 60.00, 1, '2024-10-01 19:17:43', 'FullDay', '2024-10-02 00:17:43', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquetes_servicios_incluidos`
--

CREATE TABLE `paquetes_servicios_incluidos` (
  `id_paquete` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquetes_servicios_no_incluidos`
--

CREATE TABLE `paquetes_servicios_no_incluidos` (
  `id_paquete` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE `provincias` (
  `id_provincia` int(11) NOT NULL,
  `nombre_provincia` varchar(255) NOT NULL,
  `id_departamento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`id_provincia`, `nombre_provincia`, `id_departamento`) VALUES
(1, 'Huaraz', 1),
(2, 'Aija', 1),
(3, 'Antonio Raymondi', 1),
(4, 'Asunción', 1),
(5, 'Bolognesi', 1),
(6, 'Carhuaz', 1),
(7, 'Carlos Fermín Fitzcarrald', 1),
(8, 'Casma', 1),
(9, 'Corongo', 1),
(10, 'Huari', 1),
(11, 'Huarmey', 1),
(12, 'Huaylas', 1),
(13, 'Mariscal Luzuriaga', 1),
(14, 'Ocros', 1),
(15, 'Pallasca', 1),
(16, 'Pomabamba', 1),
(17, 'Recuay', 1),
(18, 'Santa', 1),
(19, 'Sihuas', 1),
(20, 'Yungay', 1),
(21, 'Cusco', 2),
(22, 'Acomayo', 2),
(23, 'Anta', 2),
(24, 'Calca', 2),
(25, 'Canas', 2),
(26, 'Canchis', 2),
(27, 'Chumbivilcas', 2),
(28, 'Espinar', 2),
(29, 'La Convención', 2),
(30, 'Paruro', 2),
(31, 'Paucartambo', 2),
(32, 'Quispicanchi', 2),
(33, 'Urubamba', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id_reserva` int(11) NOT NULL,
  `id_paquete` int(11) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `fecha_reserva` date DEFAULT NULL,
  `estado_reserva` varchar(20) DEFAULT NULL,
  `cantidad_personas` int(11) DEFAULT NULL,
  `precio_total` decimal(10,2) DEFAULT NULL,
  `f_creacion` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id_servicio` int(11) NOT NULL,
  `nombre_servicio` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id_servicio`, `nombre_servicio`) VALUES
(1, 'Alimentación'),
(2, 'Transporte'),
(3, 'Recogida de alojamiento'),
(4, 'Almuerzo'),
(5, 'Entrada a Parque Nacional Huascaran'),
(6, 'Guía de turismo'),
(7, 'Guía de montaña'),
(8, 'Equipo de primeros auxilios'),
(9, 'Propinas'),
(10, 'Ingreso de ticket a lugares turísticos');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`),
  ADD UNIQUE KEY `cod_categoria` (`cod_categoria`);

--
-- Indices de la tabla `categorias_paquetes`
--
ALTER TABLE `categorias_paquetes`
  ADD PRIMARY KEY (`id_categoria`,`id_paquete`),
  ADD KEY `id_paquete` (`id_paquete`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id_departamento`),
  ADD KEY `fk_pais` (`id_pais`);

--
-- Indices de la tabla `destinos`
--
ALTER TABLE `destinos`
  ADD PRIMARY KEY (`id_destino`),
  ADD UNIQUE KEY `codigo_destino` (`codigo_destino`),
  ADD KEY `fk_destino_categoria` (`id_categoria`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id_horario`),
  ADD KEY `id_paquete` (`id_paquete`);

--
-- Indices de la tabla `imagenes_destinos`
--
ALTER TABLE `imagenes_destinos`
  ADD PRIMARY KEY (`id_imagen`),
  ADD KEY `id_destino` (`id_destino`);

--
-- Indices de la tabla `itinerarios`
--
ALTER TABLE `itinerarios`
  ADD PRIMARY KEY (`id_itinerario`),
  ADD KEY `id_paquete` (`id_paquete`),
  ADD KEY `id_destino` (`id_destino`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`id_pais`);

--
-- Indices de la tabla `paquetes`
--
ALTER TABLE `paquetes`
  ADD PRIMARY KEY (`id_paquete`);

--
-- Indices de la tabla `paquetes_servicios_incluidos`
--
ALTER TABLE `paquetes_servicios_incluidos`
  ADD KEY `id_paquete` (`id_paquete`),
  ADD KEY `id_servicio` (`id_servicio`);

--
-- Indices de la tabla `paquetes_servicios_no_incluidos`
--
ALTER TABLE `paquetes_servicios_no_incluidos`
  ADD PRIMARY KEY (`id_paquete`,`id_servicio`),
  ADD KEY `id_servicio` (`id_servicio`);

--
-- Indices de la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`id_provincia`),
  ADD KEY `id_departamento` (`id_departamento`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `id_paquete` (`id_paquete`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id_servicio`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id_departamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `destinos`
--
ALTER TABLE `destinos`
  MODIFY `id_destino` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id_horario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `imagenes_destinos`
--
ALTER TABLE `imagenes_destinos`
  MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `itinerarios`
--
ALTER TABLE `itinerarios`
  MODIFY `id_itinerario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `id_pais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `paquetes`
--
ALTER TABLE `paquetes`
  MODIFY `id_paquete` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `provincias`
--
ALTER TABLE `provincias`
  MODIFY `id_provincia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categorias_paquetes`
--
ALTER TABLE `categorias_paquetes`
  ADD CONSTRAINT `categorias_paquetes_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`),
  ADD CONSTRAINT `categorias_paquetes_ibfk_2` FOREIGN KEY (`id_paquete`) REFERENCES `paquetes` (`id_paquete`);

--
-- Filtros para la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD CONSTRAINT `fk_pais` FOREIGN KEY (`id_pais`) REFERENCES `paises` (`id_pais`);

--
-- Filtros para la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD CONSTRAINT `horarios_ibfk_1` FOREIGN KEY (`id_paquete`) REFERENCES `paquetes` (`id_paquete`);

--
-- Filtros para la tabla `imagenes_destinos`
--
ALTER TABLE `imagenes_destinos`
  ADD CONSTRAINT `imagenes_destinos_ibfk_1` FOREIGN KEY (`id_destino`) REFERENCES `destinos` (`id_destino`);

--
-- Filtros para la tabla `itinerarios`
--
ALTER TABLE `itinerarios`
  ADD CONSTRAINT `itinerarios_ibfk_1` FOREIGN KEY (`id_paquete`) REFERENCES `paquetes` (`id_paquete`),
  ADD CONSTRAINT `itinerarios_ibfk_2` FOREIGN KEY (`id_destino`) REFERENCES `destinos` (`id_destino`);

--
-- Filtros para la tabla `paquetes_servicios_incluidos`
--
ALTER TABLE `paquetes_servicios_incluidos`
  ADD CONSTRAINT `paquetes_servicios_incluidos_ibfk_1` FOREIGN KEY (`id_paquete`) REFERENCES `paquetes` (`id_paquete`) ON DELETE CASCADE,
  ADD CONSTRAINT `paquetes_servicios_incluidos_ibfk_2` FOREIGN KEY (`id_servicio`) REFERENCES `servicios` (`id_servicio`) ON DELETE CASCADE;

--
-- Filtros para la tabla `paquetes_servicios_no_incluidos`
--
ALTER TABLE `paquetes_servicios_no_incluidos`
  ADD CONSTRAINT `paquetes_servicios_no_incluidos_ibfk_1` FOREIGN KEY (`id_paquete`) REFERENCES `paquetes` (`id_paquete`),
  ADD CONSTRAINT `paquetes_servicios_no_incluidos_ibfk_2` FOREIGN KEY (`id_servicio`) REFERENCES `servicios` (`id_servicio`);

--
-- Filtros para la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD CONSTRAINT `provincias_ibfk_1` FOREIGN KEY (`id_departamento`) REFERENCES `departamentos` (`id_departamento`);

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`id_paquete`) REFERENCES `paquetes` (`id_paquete`),
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
