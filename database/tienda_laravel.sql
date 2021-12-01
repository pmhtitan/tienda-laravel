-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 01-12-2021 a las 22:07:31
-- Versión del servidor: 5.7.26
-- Versión de PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda_laravel`
--
CREATE DATABASE IF NOT EXISTS `tienda_laravel` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `tienda_laravel`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

DROP TABLE IF EXISTS `carrito`;
CREATE TABLE IF NOT EXISTS `carrito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `subtotal` double DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_77E6BED5DB38439E` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`id`, `usuario_id`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 1, 166, '2020-12-19 00:00:00', '2021-02-22 17:09:01'),
(2, 2, 34, '2020-12-30 19:42:26', '2020-12-30 19:42:32'),
(3, 3, 536, '2021-01-06 16:12:53', '2021-10-24 18:02:16'),
(4, 8, 25, '2021-01-12 18:24:45', '2021-01-12 18:24:45'),
(5, 4, 77, '2021-01-25 20:16:22', '2021-07-12 15:58:16'),
(6, 10, 0, '2021-01-29 16:10:35', '2021-01-29 16:25:52'),
(7, 11, 0, '2021-01-29 16:26:46', '2021-01-29 16:27:57'),
(8, 12, 0, '2021-01-29 16:28:39', '2021-01-29 16:30:11'),
(9, 13, 0, '2021-02-13 17:02:46', '2021-02-13 17:07:53'),
(10, 14, 0, '2021-02-17 16:14:34', '2021-02-17 16:15:01'),
(11, 15, 411, '2021-02-22 17:12:33', '2021-02-25 17:43:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'sudaderas', '2020-12-02 00:00:00', '2020-12-02 00:00:00'),
(2, 'pantalones', '2020-12-02 00:00:00', '2020-12-02 00:00:00'),
(3, 'zapatillas', '2020-12-14 16:19:53', '2020-12-14 16:19:53'),
(4, 'abrigos', '2020-12-14 16:44:09', '2020-12-14 17:12:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_facturacion`
--

DROP TABLE IF EXISTS `datos_facturacion`;
CREATE TABLE IF NOT EXISTS `datos_facturacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` int(11) NOT NULL,
  `provincia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `localidad` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigo_postal` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F03143BDDB38439E` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `datos_facturacion`
--

INSERT INTO `datos_facturacion` (`id`, `usuario_id`, `nombre`, `email`, `telefono`, `provincia`, `localidad`, `direccion`, `codigo_postal`, `created_at`, `updated_at`) VALUES
(3, 1, 'Juan juanoteess', 'juan@hotler.com', 212453255, 'Bulta', 'Bulta', 'Halla 14', 45353, '2020-12-17 14:31:58', '2021-01-02 16:21:03'),
(4, 4, 'Paco asecas', 'adam@hotler.com', 56765554, 'Valladolid', 'Tudela de Duero', 'C/ Carraportillo nº12', 47320, '2020-12-17 15:55:40', '2021-03-02 16:10:03'),
(7, 7, 'Señor de Incognito', 'incognite@hotmail.com', 21245325, 'Badajoz', 'Jordania', 'C/  Alalú N º 55', 66332, '2021-01-02 17:04:01', '2021-01-02 17:04:01'),
(8, 8, 'aaaa', 'phd@gmail.com', 33333333, 'ssddddf', 'xsddfff', 'ccfttttr', 56754, '2021-01-12 18:26:17', '2021-01-12 18:26:17'),
(9, 9, 'Marilu', 'marilu@hotmail.com', 6543434, 'Teruel', 'Madalonga', 'C / Albetres Nº 23', 65333, '2021-01-25 20:13:59', '2021-01-25 20:13:59'),
(10, 10, 'Manuel Sevilla', 'Manu89@hotmail.com', 685998851, 'Valladolid', 'Valladolid', 'Arroyo de la Encomienda Nº21', 47564, '2021-01-29 16:24:20', '2021-01-29 16:24:20'),
(11, 11, 'Balú', 'balu-music@gmail.com', 65334322, 'Maniac', 'Arcadia', 'C / Angustias de la Dóbeda Piso Bajo Nº 45', 86554, '2021-01-29 16:27:57', '2021-01-29 16:27:57'),
(12, 12, 'Agatha de la prada', 'aggi64@gmail.com', 667543456, 'Pamplona', 'Duramiel', 'C / Duramiel de la bahía 44', 54324, '2021-01-29 16:29:39', '2021-01-29 16:29:39'),
(13, 13, 'Padme', 'padme@gmail.com', 657986644, 'Sevilla', 'Lora Del Rio', 'Calle Sta. María n8, c', 41440, '2021-02-13 17:07:53', '2021-02-13 17:07:53'),
(14, 14, 'Chandrian', 'chandrian@gmail.com', 688563428, 'Cáceres', 'Santa Ana', 'C / Médula Ósea nº 16 Bajo C', 18745, '2021-02-17 16:14:12', '2021-02-17 16:14:12'),
(15, 15, 'Gabriela Alonso Díez', 'gabiidiez@hotmail.com', 655437291, 'Sevilla', 'Arconcón de la prava', 'c/baltasar numero 13', 28765, '2021-02-23 14:07:34', '2021-02-23 14:07:34'),
(16, 16, 'Fan de Akatsuki', 'akatskukifan96@hotmail.com', 685542234, 'Madrid', 'Alcorcón', 'C / Matusalén Piso bajo B 12º', 48665, '2021-02-24 17:54:17', '2021-02-24 17:54:17'),
(17, 17, 'Fan de Akatsuki', 'akatskukifan96@hotmail.com', 685542234, 'Madrid', 'Alcorcón', 'C / Matusalén Piso bajo B 12º', 48665, '2021-02-24 17:55:15', '2021-02-24 17:55:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_pedidos`
--

DROP TABLE IF EXISTS `historial_pedidos`;
CREATE TABLE IF NOT EXISTS `historial_pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `coste` double NOT NULL,
  `estado` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` int(11) NOT NULL,
  `provincia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `localidad` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigo_postal` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_HistorialUsuario` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `historial_pedidos`
--

INSERT INTO `historial_pedidos` (`id`, `usuario_id`, `coste`, `estado`, `username`, `email`, `telefono`, `provincia`, `localidad`, `direccion`, `codigo_postal`, `created_at`, `updated_at`) VALUES
(1, 9, 242.76, 'pendiente', 'Marilu', 'marilu@hotmail.com', 6543435, 'Teruel', 'Madalonga', 'C / Albetres Nº 24', 65334, '2021-01-25 20:13:59', '2021-03-01 16:43:23'),
(2, 4, 126.75, 'enviado', 'Paco asecas', 'adam@hotler.com', 567655545, 'Valladolid', 'Valll', 'Calle Calalmidad', 45332, '2021-01-25 20:17:02', '2021-01-29 16:36:41'),
(3, 4, 58.75, 'enviado', 'Paco asecas', 'adam@hotler.com', 567655545, 'Valladolid', 'Tudela de Duero', 'C/ Carraportillo nº12', 47320, '2021-01-27 17:48:43', '2021-01-29 16:36:38'),
(4, 10, 67.75, 'confirmado', 'Manuel Sevilla', 'Manu89@hotmail.com', 685998851, 'Valladolid', 'Valladolid', 'Arroyo de la Encomienda Nº21', 47564, '2021-01-29 16:24:20', '2021-01-29 16:35:56'),
(5, 10, 114.75, 'confirmado', 'Manuel Sevilla', 'Manu89@hotmail.com', 685998851, 'Valladolid', 'Valladolid', 'Arroyo de la Encomienda Nº21', 47564, '2021-01-29 16:25:52', '2021-01-29 16:35:59'),
(6, 11, 31.75, 'confirmado', 'Balú', 'balu-music@gmail.com', 65334322, 'Maniac', 'Arcadia', 'C / Angustias de la Dóbeda Piso Bajo Nº 45', 86554, '2021-01-29 16:27:57', '2021-01-29 16:35:54'),
(7, 12, 149.75, 'pendiente', 'Agatha de la prada', 'aggi64@gmail.com', 667543456, 'Pamplona', 'Duramiel', 'C / Duramiel de la bahía 44', 54324, '2021-01-29 16:29:39', '2021-01-29 16:35:51'),
(8, 12, 95.75, 'pendiente', 'Agatha de la prada', 'aggi64@gmail.com', 667543456, 'Pamplona', 'Duramiel', 'C / Duramiel de la bahía 44', 54324, '2021-01-29 16:29:53', '2021-02-03 17:59:07'),
(9, 12, 47.75, 'pendiente', 'Agatha de la prada', 'aggi64@gmail.com', 667543456, 'Pamplona', 'Duramiel', 'C / Duramiel de la bahía 44', 54324, '2021-01-29 16:30:11', '2021-02-03 17:59:05'),
(10, 13, 84.75, 'pendiente', 'Padme', 'padme@gmail.com', 657986644, 'Sevilla', 'Lora Del Rio', 'Calle Sta. María n8, c', 41440, '2021-02-13 17:07:53', '2021-02-13 17:07:53'),
(11, 14, 160.75, 'enviado', 'Chandrian', 'chandrian@gmail.com', 688563428, 'Cáceres', 'Santa Ana', 'C / Médula Ósea nº 16 Bajo C', 18745, '2021-02-17 16:14:40', '2021-02-17 16:16:13'),
(12, 14, 58.75, 'enviado', 'Chandrian', 'chandrian@gmail.com', 688563428, 'Cáceres', 'Santa Ana', 'C / Médula Ósea nº 16 Bajo C', 18745, '2021-02-17 16:14:51', '2021-02-17 16:16:10'),
(13, 14, 66.75, 'confirmado', 'Chandrian', 'chandrian@gmail.com', 688563428, 'Cáceres', 'Santa Ana', 'C / Médula Ósea nº 16 Bajo C', 18745, '2021-02-17 16:15:01', '2021-02-17 16:16:08'),
(14, 15, 391.75, 'pendiente', 'Gabriela Alonso Díez', 'gabiidiez@hotmail.com', 655437291, 'Sevilla', 'Arconcón de la prava', 'c/baltasar numero 13', 28765, '2021-02-23 14:07:34', '2021-02-23 14:07:34'),
(15, 15, 294.75, 'pendiente', 'Gabriela Alonso Díez', 'gabiidiez@hotmail.com', 655437291, 'Sevilla', 'Arconcón de la prava', 'c/baltasar numero 13', 28765, '2021-02-23 15:26:08', '2021-02-23 15:26:08'),
(16, 15, 162.75, 'pendiente', 'Gabriela Alonso Díez', 'gabiidiez@hotmail.com', 655437291, 'Sevilla', 'Arconcón de la prava', 'c/baltasar numero 13', 28765, '2021-02-23 15:32:59', '2021-02-23 15:32:59'),
(17, 16, 110.75, 'pendiente', 'Fan de Akatsuki', 'akatskukifan96@hotmail.com', 685542234, 'Madrid', 'Alcorcón', 'C / Matusalén Piso bajo B 12º', 48665, '2021-02-24 17:54:17', '2021-02-24 17:54:17'),
(18, 17, 110.75, 'pendiente', 'Fan de Akatsuki', 'akatskukifan96@hotmail.com', 685542234, 'Madrid', 'Alcorcón', 'C / Matusalén Piso bajo B 12º', 48665, '2021-02-24 17:55:15', '2021-02-24 17:55:15'),
(19, 15, 143.75, 'pendiente', 'Gabriela Alonso Díez', 'gabiidiez@hotmail.com', 655437291, 'Sevilla', 'Arconcón de la prava', 'c/baltasar numero 13', 28765, '2021-02-25 16:49:26', '2021-02-25 16:49:26'),
(20, 4, 335.75, 'pendiente', 'Paco asecas', 'adam@hotler.com', 56765554, 'Valladolid', 'Tudela de Duero', 'C/ Carraportillo nº12', 47320, '2021-03-02 16:10:03', '2021-10-04 11:46:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes_prod`
--

DROP TABLE IF EXISTS `imagenes_prod`;
CREATE TABLE IF NOT EXISTS `imagenes_prod` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_imagenes_prod` (`producto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `imagenes_prod`
--

INSERT INTO `imagenes_prod` (`id`, `producto_id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 17, '1612632527abrigo-hummel-hmlnorth-hybrid-jacket.jpg', '2021-02-06 17:28:47', '2021-02-06 17:28:47'),
(2, 17, '1612632527abrigo-camuflaje1.png', '2021-02-06 17:28:47', '2021-02-06 17:28:47'),
(3, 16, '1612886065nike-sportswear-club-hoodie-regular.jpg', '2021-02-09 15:54:25', '2021-02-09 15:54:25'),
(4, 16, '1612886164nike-sportswear-club-hoodie-regular.jpg', '2021-02-09 15:56:04', '2021-02-09 15:56:04'),
(6, 14, '1612886410sudadera-nike-dry-training-roja.jpg', '2021-02-09 16:00:10', '2021-02-09 16:00:10'),
(7, 14, '1612886410camiseta-naruto1.png', '2021-02-09 16:00:10', '2021-02-09 16:00:10'),
(10, 15, '1613065739kids_lake_blue_zip_hoodie_front_1024x1024.png', '2021-02-11 17:05:32', '2021-02-11 17:48:59'),
(11, 15, '1613063132bsi_quee211.jpg', '2021-02-11 17:05:32', '2021-02-11 17:05:32'),
(12, 3, '1613398941zapatilla-calle-adidas.jpg', '2021-02-15 14:22:21', '2021-02-15 14:22:21'),
(13, 18, '1613578317abrigo-fashion2-removebg-preview.png', '2021-02-17 16:04:01', '2021-02-17 16:11:57'),
(14, 18, '1613578326abrigo-fashion3-removebg-preview.png', '2021-02-17 16:04:01', '2021-02-17 16:12:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas_carrito`
--

DROP TABLE IF EXISTS `lineas_carrito`;
CREATE TABLE IF NOT EXISTS `lineas_carrito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `carrito_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `talla_id` int(11) DEFAULT NULL,
  `precio` double NOT NULL,
  `unidades` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8F922286DE2CF6E7` (`carrito_id`),
  KEY `IDX_8F9222867645698E` (`producto_id`),
  KEY `fk_talla_ln_carrito` (`talla_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `lineas_carrito`
--

INSERT INTO `lineas_carrito` (`id`, `carrito_id`, `producto_id`, `talla_id`, `precio`, `unidades`, `created_at`, `updated_at`) VALUES
(5, 11, 18, 1, 77, 2, '2021-02-25 17:21:59', '2021-02-25 17:26:31'),
(7, 11, 14, 1, 52, 3, '2021-02-25 17:22:15', '2021-02-25 17:22:17'),
(8, 11, 3, NULL, 45, 1, '2021-02-25 17:31:07', '2021-02-25 17:31:07'),
(9, 11, 6, NULL, 56, 1, '2021-02-25 17:43:32', '2021-02-25 17:43:32'),
(13, 5, 18, 1, 77, 1, '2021-07-12 15:58:09', '2021-07-12 15:58:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas_historial`
--

DROP TABLE IF EXISTS `lineas_historial`;
CREATE TABLE IF NOT EXISTS `lineas_historial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `historial_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio` double NOT NULL,
  `talla` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unidades` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_lineasHistorial` (`historial_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `lineas_historial`
--

INSERT INTO `lineas_historial` (`id`, `historial_id`, `nombre`, `precio`, `talla`, `unidades`, `created_at`, `updated_at`) VALUES
(1, 1, 'BM mu hoodie', 39, NULL, 2, '2021-01-25 20:13:59', '2021-01-25 20:13:59'),
(2, 1, 'Naruto Akatsuki', 52, NULL, 1, '2021-01-25 20:13:59', '2021-01-25 20:13:59'),
(3, 1, 'Nike S', 36, NULL, 3, '2021-01-25 20:13:59', '2021-01-25 20:13:59'),
(4, 2, 'Nike S', 36, NULL, 1, '2021-01-25 20:17:02', '2021-01-25 20:17:02'),
(5, 2, 'Running Fast LightVolt V1', 42, NULL, 2, '2021-01-25 20:17:02', '2021-01-25 20:17:02'),
(6, 3, 'Naruto Akatsuki', 52, NULL, 1, '2021-01-27 17:48:43', '2021-01-27 17:48:43'),
(7, 4, 'Pantalon magico', 22, NULL, 1, '2021-01-29 16:24:20', '2021-01-29 16:24:20'),
(8, 4, 'BM mu hoodie', 39, NULL, 1, '2021-01-29 16:24:20', '2021-01-29 16:24:20'),
(9, 5, 'Nike S', 36, NULL, 3, '2021-01-29 16:25:52', '2021-01-29 16:25:52'),
(10, 6, 'Hoodie Deborah Styless', 25, NULL, 1, '2021-01-29 16:27:57', '2021-01-29 16:27:57'),
(11, 7, 'Adidas Pro Soccer', 45, NULL, 1, '2021-01-29 16:29:39', '2021-01-29 16:29:39'),
(12, 7, 'Running Fast LightVolt V2', 56, NULL, 1, '2021-01-29 16:29:39', '2021-01-29 16:29:39'),
(13, 7, 'Running Fast LightVolt V1', 42, NULL, 1, '2021-01-29 16:29:40', '2021-01-29 16:29:40'),
(14, 8, 'Windfury XL', 89, NULL, 1, '2021-01-29 16:29:53', '2021-01-29 16:29:53'),
(15, 9, 'Vintage Three-time', 41, NULL, 1, '2021-01-29 16:30:11', '2021-01-29 16:30:11'),
(16, 10, 'Running Fast LightVolt V2', 56, NULL, 1, '2021-02-13 17:07:53', '2021-02-13 17:07:53'),
(17, 10, 'Pantalon magico', 22, NULL, 1, '2021-02-13 17:07:53', '2021-02-13 17:07:53'),
(18, 11, 'Abrigo fashion shop', 77, NULL, 2, '2021-02-17 16:14:40', '2021-02-17 16:14:40'),
(19, 12, 'Naruto Akatsuki', 52, NULL, 1, '2021-02-17 16:14:51', '2021-02-17 16:14:51'),
(20, 13, 'Zoro One Piece L', 60, NULL, 1, '2021-02-17 16:15:01', '2021-02-17 16:15:01'),
(21, 14, 'Abrigo fashion shop', 77, 'XL', 4, '2021-02-23 14:07:34', '2021-02-23 14:07:34'),
(22, 14, 'Abrigo fashion shop', 77, 'S', 1, '2021-02-23 14:07:34', '2021-02-23 14:07:34'),
(23, 15, 'Abrigo Belga Ürmlentosch', 96, 'XL', 1, '2021-02-23 15:26:08', '2021-02-23 15:26:08'),
(24, 15, 'Abrigo Belga Ürmlentosch', 96, 'XXL', 2, '2021-02-23 15:26:08', '2021-02-23 15:26:08'),
(25, 16, 'BM mu hoodie', 39, 'S', 3, '2021-02-23 15:32:59', '2021-02-23 15:32:59'),
(26, 16, 'BM mu hoodie', 39, 'L', 1, '2021-02-23 15:32:59', '2021-02-23 15:32:59'),
(27, 17, 'Naruto Akatsuki', 52, 'S', 1, '2021-02-24 17:54:17', '2021-02-24 17:54:17'),
(28, 17, 'Naruto Akatsuki', 52, 'L', 1, '2021-02-24 17:54:17', '2021-02-24 17:54:17'),
(29, 18, 'Naruto Akatsuki', 52, 'S', 1, '2021-02-24 17:55:15', '2021-02-24 17:55:15'),
(30, 18, 'Naruto Akatsuki', 52, 'L', 1, '2021-02-24 17:55:15', '2021-02-24 17:55:15'),
(31, 19, 'Adidas Pro Soccer', 45, '36', 1, '2021-02-25 16:49:26', '2021-02-25 16:49:26'),
(32, 19, 'Running Fast LightVolt V2', 56, '40', 1, '2021-02-25 16:49:26', '2021-02-25 16:49:26'),
(33, 19, 'Nike S', 36, 'S', 1, '2021-02-25 16:49:26', '2021-02-25 16:49:26'),
(34, 20, 'Abrigo fashion shop', 77, 'S', 1, '2021-03-02 16:10:03', '2021-03-02 16:10:03'),
(35, 20, 'Abrigo Belga Ürmlentosch', 96, 'XXL', 1, '2021-03-02 16:10:03', '2021-03-02 16:10:03'),
(36, 20, 'Sailor World Collection', 78, 'XL', 2, '2021-03-02 16:10:03', '2021-03-02 16:10:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas_pedidos`
--

DROP TABLE IF EXISTS `lineas_pedidos`;
CREATE TABLE IF NOT EXISTS `lineas_pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pedido_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `talla_id` int(11) DEFAULT NULL,
  `unidades` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9F6250F94854653A` (`pedido_id`),
  KEY `IDX_9F6250F97645698E` (`producto_id`),
  KEY `fk_talla_ln_pedido` (`talla_id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `lineas_pedidos`
--

INSERT INTO `lineas_pedidos` (`id`, `pedido_id`, `producto_id`, `talla_id`, `unidades`, `created_at`, `updated_at`) VALUES
(14, 15, 1, NULL, 4, '2021-01-02 16:21:03', '2021-01-02 16:21:03'),
(15, 15, 3, NULL, 1, '2021-01-02 16:21:04', '2021-01-02 16:21:04'),
(18, 18, 4, NULL, 2, '2021-01-02 17:04:01', '2021-01-02 17:04:01'),
(19, 18, 7, NULL, 1, '2021-01-02 17:04:01', '2021-01-02 17:04:01'),
(20, 19, 16, NULL, 2, '2021-01-25 20:13:59', '2021-01-25 20:13:59'),
(21, 19, 14, NULL, 1, '2021-01-25 20:13:59', '2021-01-25 20:13:59'),
(22, 19, 11, NULL, 3, '2021-01-25 20:13:59', '2021-01-25 20:13:59'),
(23, 15, 11, NULL, 1, '2021-01-25 20:17:02', '2021-01-25 20:17:02'),
(24, 15, 8, NULL, 2, '2021-01-25 20:17:02', '2021-01-25 20:17:02'),
(25, 15, 14, NULL, 1, '2021-01-27 17:48:43', '2021-01-27 17:48:43'),
(26, 15, 1, NULL, 1, '2021-01-29 16:24:20', '2021-01-29 16:24:20'),
(27, 15, 16, NULL, 1, '2021-01-29 16:24:20', '2021-01-29 16:24:20'),
(28, 15, 11, NULL, 3, '2021-01-29 16:25:52', '2021-01-29 16:25:52'),
(29, 15, 2, NULL, 1, '2021-01-29 16:27:57', '2021-01-29 16:27:57'),
(30, 15, 3, NULL, 1, '2021-01-29 16:29:39', '2021-01-29 16:29:39'),
(31, 15, 6, NULL, 1, '2021-01-29 16:29:39', '2021-01-29 16:29:39'),
(32, 15, 8, NULL, 1, '2021-01-29 16:29:39', '2021-01-29 16:29:39'),
(33, 15, 5, NULL, 1, '2021-01-29 16:29:53', '2021-01-29 16:29:53'),
(34, 15, 10, NULL, 1, '2021-01-29 16:30:11', '2021-01-29 16:30:11'),
(35, 15, 6, NULL, 1, '2021-02-13 17:07:53', '2021-02-13 17:07:53'),
(36, 15, 1, NULL, 1, '2021-02-13 17:07:53', '2021-02-13 17:07:53'),
(37, 15, 18, NULL, 2, '2021-02-17 16:14:40', '2021-02-17 16:14:40'),
(38, 15, 14, NULL, 1, '2021-02-17 16:14:51', '2021-02-17 16:14:51'),
(39, 15, 9, NULL, 1, '2021-02-17 16:15:01', '2021-02-17 16:15:01'),
(40, 15, 18, 3, 4, '2021-02-23 14:07:34', '2021-02-23 14:07:34'),
(41, 15, 18, 1, 1, '2021-02-23 14:07:34', '2021-02-23 14:07:34'),
(42, 15, 17, 3, 1, '2021-02-23 15:26:08', '2021-02-23 15:26:08'),
(43, 15, 17, 4, 2, '2021-02-23 15:26:08', '2021-02-23 15:26:08'),
(44, 15, 16, 1, 3, '2021-02-23 15:32:59', '2021-02-23 15:32:59'),
(45, 15, 16, 2, 1, '2021-02-23 15:32:59', '2021-02-23 15:32:59'),
(46, 35, 14, 1, 1, '2021-02-24 17:54:17', '2021-02-24 17:54:17'),
(47, 35, 14, 2, 1, '2021-02-24 17:54:17', '2021-02-24 17:54:17'),
(48, 36, 14, 1, 1, '2021-02-24 17:55:15', '2021-02-24 17:55:15'),
(49, 36, 14, 2, 1, '2021-02-24 17:55:15', '2021-02-24 17:55:15'),
(50, 15, 3, 6, 1, '2021-02-25 16:49:26', '2021-02-25 16:49:26'),
(51, 15, 6, 8, 1, '2021-02-25 16:49:26', '2021-02-25 16:49:26'),
(52, 15, 11, 1, 1, '2021-02-25 16:49:26', '2021-02-25 16:49:26'),
(53, 15, 18, 1, 1, '2021-03-02 16:10:03', '2021-03-02 16:10:03'),
(54, 15, 17, 4, 1, '2021-03-02 16:10:03', '2021-03-02 16:10:03'),
(55, 15, 15, 3, 2, '2021-03-02 16:10:03', '2021-03-02 16:10:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 2),
(3, '2019_08_19_000000_create_failed_jobs_table', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('pmhtitan@gmail.com', '$2y$10$tA3WFFFNqYvz0gQxkY9GteMTe1jTLMBW.4WCG0VYLoTkxjRk7gjVG', '2020-11-30 15:59:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

DROP TABLE IF EXISTS `pedido`;
CREATE TABLE IF NOT EXISTS `pedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `coste` double NOT NULL,
  `estado` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C4EC16CEDB38439E` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id`, `usuario_id`, `coste`, `estado`, `created_at`, `updated_at`) VALUES
(15, 1, 139.75, 'pendiente', '2021-01-02 16:21:03', '2021-01-02 16:21:03'),
(18, 7, 119.75, 'pendiente', '2021-01-02 17:04:01', '2021-01-02 17:04:01'),
(19, 9, 244.75, 'pendiente', '2021-01-25 20:13:59', '2021-01-25 20:13:59'),
(20, 4, 126.75, 'pendiente', '2021-01-25 20:17:02', '2021-01-25 20:17:02'),
(21, 4, 58.75, 'pendiente', '2021-01-27 17:48:43', '2021-01-27 17:48:43'),
(22, 10, 67.75, 'pendiente', '2021-01-29 16:24:20', '2021-01-29 16:24:20'),
(23, 10, 114.75, 'pendiente', '2021-01-29 16:25:52', '2021-01-29 16:25:52'),
(24, 11, 31.75, 'pendiente', '2021-01-29 16:27:57', '2021-01-29 16:27:57'),
(25, 12, 149.75, 'pendiente', '2021-01-29 16:29:39', '2021-01-29 16:29:39'),
(26, 12, 95.75, 'pendiente', '2021-01-29 16:29:53', '2021-01-29 16:29:53'),
(27, 12, 47.75, 'pendiente', '2021-01-29 16:30:11', '2021-01-29 16:30:11'),
(28, 13, 84.75, 'pendiente', '2021-02-13 17:07:53', '2021-02-13 17:07:53'),
(29, 14, 160.75, 'pendiente', '2021-02-17 16:14:40', '2021-02-17 16:14:40'),
(30, 14, 58.75, 'pendiente', '2021-02-17 16:14:51', '2021-02-17 16:14:51'),
(31, 14, 66.75, 'pendiente', '2021-02-17 16:15:01', '2021-02-17 16:15:01'),
(32, 15, 391.75, 'pendiente', '2021-02-23 14:07:34', '2021-02-23 14:07:34'),
(33, 15, 294.75, 'pendiente', '2021-02-23 15:26:08', '2021-02-23 15:26:08'),
(34, 15, 162.75, 'pendiente', '2021-02-23 15:32:59', '2021-02-23 15:32:59'),
(35, 16, 110.75, 'pendiente', '2021-02-24 17:54:17', '2021-02-24 17:54:17'),
(36, 17, 110.75, 'pendiente', '2021-02-24 17:55:15', '2021-02-24 17:55:15'),
(37, 15, 143.75, 'pendiente', '2021-02-25 16:49:26', '2021-02-25 16:49:26'),
(38, 4, 335.75, 'pendiente', '2021-03-02 16:10:03', '2021-03-02 16:10:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio` double NOT NULL,
  `stock` int(11) NOT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A7BB06153397707A` (`categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `categoria_id`, `nombre`, `descripcion`, `precio`, `stock`, `imagen`, `created_at`, `updated_at`) VALUES
(1, 2, 'Pantalon magico', 'es muy magico', 22, 44, '1607544385Sport-Patantalon-Agosto.jpg', '2020-12-03 16:23:03', '2020-12-09 20:12:34'),
(2, 1, 'Hoodie Deborah Styless', 'Halloween Collection Deborah Style. Tamaño S - L - XL. Color blanco - rosa - morado', 25, 40, '1607012751northern-lights-hoodie.jpg', '2020-12-03 16:25:51', '2020-12-10 22:51:09'),
(3, 3, 'Adidas Pro Soccer', 'Talla 38-40-42-44. Stock hasta fin de existencias.\r\nColección otoño 2020 Adidas TM.', 45, 120, '1607963154zapatilla-calle-adidas.jpg', '2020-12-14 16:25:54', '2020-12-14 16:25:54'),
(4, 1, 'Gaza Collection 2020 Plus', 'Llega la colección de Gaza 2020, con sus novedosas sudaderas sintéticas con poliéster.', 34, 20, '1607963424s-l300.jpg', '2020-12-14 16:30:24', '2020-12-14 16:30:24'),
(5, 4, 'Windfury XL', 'Cortavientos de marca Windfury. Talla única XL.', 89, 60, '1607964282E1512_ORLC_S.jpg', '2020-12-14 16:44:42', '2020-12-14 16:44:42'),
(6, 3, 'Running Fast LightVolt V2', 'Modelo V2. Tallas 38-40-42', 56, 50, '1608044220asics-pink.jpg', '2020-12-14 16:47:20', '2020-12-15 14:57:00'),
(7, 1, 'Lakers 23', 'Sudadera de los Lakers 23 del partido de Benenton vs los Lakers en Miami.', 45, 20, '1607964735sudadera-lebron-james-lakers-hoodie.jpg', '2020-12-14 16:52:15', '2020-12-14 16:52:15'),
(8, 3, 'Running Fast LightVolt V1', 'Primera versión de las Running Fasto', 42, 25, '1608044206nike-30-fusion.jpg', '2020-12-14 16:53:02', '2020-12-15 14:56:46'),
(9, 1, 'Zoro One Piece L', 'Talla única L. Colleción One Piece. Personaje Roronoa Zoro', 60, 20, '1607964846sudadera-zorro.jpg', '2020-12-14 16:54:06', '2020-12-14 16:54:06'),
(10, 1, 'Vintage Three-time', 'Hoodie Vintage Vintage Three-time. XL-L', 41, 60, '1610133191nike-sportswear-club-hoodie-regular.jpg', '2021-01-08 19:13:11', '2021-01-08 19:13:11'),
(11, 1, 'Nike S', 'Sudadera Nike S 2020 Collection', 36, 50, '1610133693sudadera-nike-dry-training-roja.jpg', '2021-01-08 19:21:33', '2021-01-08 19:21:33'),
(12, 1, 'Blanca XL', 'Sudadera Blanca XL', 45, 60, '1610133729DORA-SUDADERA-BLANCA.png', '2021-01-08 19:22:09', '2021-01-08 19:22:09'),
(14, 1, 'Naruto Akatsuki', 'Sudadera de Anime Naruto - Akatsuki. Edición limitada. Tallas S, L y XL', 52, 35, '1610133863naruto-hoodie2.jpg', '2021-01-08 19:24:23', '2021-01-08 19:24:23'),
(15, 1, 'Sailor World Collection', 'Sudadera Sailor World Collection. Colección de primavera - otoño 2020.', 78, 70, '1610133903my-work-black-hoodie-front_2.png', '2021-01-08 19:25:03', '2021-01-08 19:25:03'),
(16, 1, 'BM mu hoodie', 'Sudadera BM mu. Tallas S - L.', 39, 40, '1610134059bm_mu_favorite_po_hoodie_m_black.png', '2021-01-08 19:27:39', '2021-01-08 19:27:39'),
(17, 4, 'Abrigo Belga Ürmlentosch', 'Piel de poliéster, cuidado sintético, te protegerá de los inviernos más duros.', 96, 40, '1612632527abrigo-hmlvega-coat.jpg', '2021-02-06 17:28:47', '2021-02-06 17:28:47'),
(18, 4, 'Abrigo fashion shop', 'Diferentes colores. Nueva colección. Últimos modelos!', 77, 30, '1613578306abrigo-fashion1-removebg-preview.png', '2021-02-17 16:04:01', '2021-02-17 16:11:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `talla`
--

DROP TABLE IF EXISTS `talla`;
CREATE TABLE IF NOT EXISTS `talla` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `talla`
--

INSERT INTO `talla` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'S', '2021-01-15 00:00:00', '2021-01-30 16:29:26'),
(2, 'L', '2021-01-15 00:00:00', '2021-01-15 00:00:00'),
(3, 'XL', '2021-01-15 00:00:00', '2021-01-15 00:00:00'),
(4, 'XXL', '2021-01-15 00:00:00', '2021-01-15 00:00:00'),
(5, '34', '2021-01-15 00:00:00', '2021-01-15 00:00:00'),
(6, '36', '2021-01-15 00:00:00', '2021-01-15 00:00:00'),
(7, '38', '2021-01-15 00:00:00', '2021-01-15 00:00:00'),
(8, '40', '2021-01-15 00:00:00', '2021-01-15 00:00:00'),
(9, '42', '2021-01-15 00:00:00', '2021-01-15 00:00:00'),
(10, '44', '2021-01-15 00:00:00', '2021-01-15 00:00:00'),
(13, '46', '2021-01-30 16:38:07', '2021-01-30 16:38:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tallas_producto`
--

DROP TABLE IF EXISTS `tallas_producto`;
CREATE TABLE IF NOT EXISTS `tallas_producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) DEFAULT NULL,
  `talla_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8F922286DE2CFSSS` (`producto_id`),
  KEY `fk_producto_talla` (`talla_id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tallas_producto`
--

INSERT INTO `tallas_producto` (`id`, `producto_id`, `talla_id`, `created_at`, `updated_at`) VALUES
(9, 1, 1, '2021-01-24 13:46:09', '2021-01-24 13:46:09'),
(10, 1, 2, '2021-01-24 13:46:09', '2021-01-24 13:46:09'),
(11, 2, 3, '2021-01-24 13:49:09', '2021-01-24 13:49:09'),
(19, 4, 2, '2021-01-24 13:49:37', '2021-01-24 13:49:37'),
(20, 4, 3, '2021-01-24 13:49:37', '2021-01-24 13:49:37'),
(23, 6, 7, '2021-01-24 13:50:01', '2021-01-24 13:50:01'),
(24, 6, 8, '2021-01-24 13:50:01', '2021-01-24 13:50:01'),
(25, 6, 9, '2021-01-24 13:50:01', '2021-01-24 13:50:01'),
(26, 7, 1, '2021-01-24 13:50:11', '2021-01-24 13:50:11'),
(27, 7, 2, '2021-01-24 13:50:11', '2021-01-24 13:50:11'),
(28, 7, 3, '2021-01-24 13:50:11', '2021-01-24 13:50:11'),
(30, 5, 3, '2021-01-24 14:05:49', '2021-01-24 14:05:49'),
(31, 8, 6, '2021-01-25 16:47:38', '2021-01-25 16:47:38'),
(32, 8, 7, '2021-01-25 16:47:38', '2021-01-25 16:47:38'),
(33, 8, 8, '2021-01-25 16:47:38', '2021-01-25 16:47:38'),
(34, 9, 2, '2021-01-25 16:47:46', '2021-01-25 16:47:46'),
(35, 10, 2, '2021-01-25 16:47:54', '2021-01-25 16:47:54'),
(36, 10, 3, '2021-01-25 16:47:54', '2021-01-25 16:47:54'),
(37, 11, 1, '2021-01-25 16:48:01', '2021-01-25 16:48:01'),
(38, 11, 2, '2021-01-25 16:48:01', '2021-01-25 16:48:01'),
(39, 11, 3, '2021-01-25 16:48:01', '2021-01-25 16:48:01'),
(40, 11, 4, '2021-01-25 16:48:01', '2021-01-25 16:48:01'),
(41, 14, 1, '2021-01-25 16:48:08', '2021-01-25 16:48:08'),
(42, 14, 2, '2021-01-25 16:48:08', '2021-01-25 16:48:08'),
(43, 14, 3, '2021-01-25 16:48:08', '2021-01-25 16:48:08'),
(44, 15, 2, '2021-01-25 16:48:13', '2021-01-25 16:48:13'),
(45, 15, 3, '2021-01-25 16:48:13', '2021-01-25 16:48:13'),
(46, 16, 1, '2021-01-25 16:48:18', '2021-01-25 16:48:18'),
(47, 16, 2, '2021-01-25 16:48:18', '2021-01-25 16:48:18'),
(48, 17, 3, '2021-02-06 17:28:47', '2021-02-06 17:28:47'),
(49, 17, 4, '2021-02-06 17:28:47', '2021-02-06 17:28:47'),
(50, 3, 6, '2021-02-15 14:22:04', '2021-02-15 14:22:04'),
(51, 3, 7, '2021-02-15 14:22:04', '2021-02-15 14:22:04'),
(52, 3, 8, '2021-02-15 14:22:04', '2021-02-15 14:22:04'),
(53, 3, 9, '2021-02-15 14:22:04', '2021-02-15 14:22:04'),
(54, 3, 10, '2021-02-15 14:22:04', '2021-02-15 14:22:04'),
(55, 3, 13, '2021-02-15 14:22:04', '2021-02-15 14:22:04'),
(59, 18, 1, '2021-02-17 16:11:47', '2021-02-17 16:11:47'),
(60, 18, 2, '2021-02-17 16:11:47', '2021-02-17 16:11:47'),
(61, 18, 3, '2021-02-17 16:11:47', '2021-02-17 16:11:47'),
(64, 12, 3, '2021-03-01 13:41:00', '2021-03-01 13:41:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `roles` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `session_user` tinyint(1) NOT NULL COMMENT '1=True | 0=False',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `email`, `roles`, `password`, `name`, `created_at`, `updated_at`, `remember_token`, `session_user`, `email_verified_at`) VALUES
(1, 'juan@hotmail.com', 'user', '$2y$10$RAKVoByfXiGOSb0TgmvEWukqsaXjCzNrEV9z9eWrL0xGcGHGfgy9a', 'Juan', '2020-11-30 16:55:30', '2020-11-30 16:55:30', NULL, 0, NULL),
(2, 'pmhtitan@gmail.com', 'user', '$2y$10$dT9wwKbpacDJUIMP2Mn3eOAO0le9MiygNIbG.4nmN0u/vo0LWwgPW', 'pmh', '2020-11-30 16:59:10', '2020-11-30 16:59:10', NULL, 0, NULL),
(3, 'admin@admin.com', 'admin', '$2y$10$WYGGlQcK5JNT8L.aHNe1Q.UX.XNya8LFttXKAa3OQKadDpWoJJKS2', 'admin', '2020-12-02 16:10:48', '2020-12-02 16:10:48', NULL, 0, NULL),
(4, 'paco@gmail.com', 'user', '$2y$10$Kn9Y6fiUQfyHAUCKjcP6LeNRlLmKYHf4.GMzt6z3UEWYBVaR4ButG', 'paco', '2020-12-17 15:51:44', '2020-12-17 15:51:44', 'ot2ieYaDtRR92P0Eu5l6MAqHaS49LMrDSyrrF9euEkbZuSoTQs8KkNhYiLoV', 0, NULL),
(7, NULL, NULL, NULL, 'Señor de Incognito', '2021-01-02 17:04:01', '2021-01-02 17:04:01', NULL, 1, NULL),
(8, 'phd@gmail.com', 'user', '$2y$10$rdkzV5iJnzW2xr7JjqkWlOVteYFtBYMQLO4uhnl2ONh875faoKU6e', 'piluca', '2021-01-12 18:22:57', '2021-01-12 18:22:57', NULL, 0, NULL),
(9, NULL, NULL, NULL, 'Marilu', '2021-01-25 20:13:59', '2021-01-25 20:13:59', NULL, 1, NULL),
(10, 'Manu89@hotmail.com', 'user', '$2y$10$PvFi2isd689.23TdCCMcKe/JrIHgfUCy9EPKDuvnmaOCa5yJiNZea', 'Manuel Sevilla', '2021-01-29 16:09:50', '2021-01-29 16:09:50', NULL, 0, NULL),
(11, 'balu-music@gmail.com', 'user', '$2y$10$fXmflDmdGOY2gaFTdrlrzeWnilqIYxMGCnOH5/VhibHzw32/7VBJO', 'balu', '2021-01-29 16:26:40', '2021-01-29 16:26:40', NULL, 0, NULL),
(12, 'aggi65@gmail.com', 'user', '$2y$10$VWa20BlS52VSF13G6B99oeMupvhe5oYz6HwlQVbsxP8YVCgB8Mjl.', 'Agatha', '2021-01-29 16:28:32', '2021-01-29 16:28:32', NULL, 0, NULL),
(13, 'padme@gmail.com', 'user', '$2y$10$2Nsm8i0Vd.RdvgyKlDO2M.FsG0LC3YnYAcp.OcmyGiW8DBIAQt5Ti', 'Padme', '2021-02-13 17:01:47', '2021-02-13 17:01:47', NULL, 0, NULL),
(14, 'chandrian@gmail.com', 'user', '$2y$10$.4IPxLqPDYUy4IZJVWPjVe3wCaJr.TCvR5ZCggvETN//60qGyBy7q', 'Chandrian', '2021-02-17 16:13:08', '2021-02-17 16:13:08', NULL, 0, NULL),
(15, 'gabriela@hotmail.com', 'user', '$2y$10$84JAwoc/JDJcazyO4rArvuQqcnBJHNnGCbffgzsDIo72YGEDIbJmK', 'Gabriela', '2021-02-22 17:12:27', '2021-02-22 17:12:27', NULL, 0, NULL),
(16, NULL, NULL, NULL, 'Fan de Akatsuki', '2021-02-24 17:54:17', '2021-02-24 17:54:17', NULL, 1, NULL),
(17, NULL, NULL, NULL, 'Fan de Akatsuki', '2021-02-24 17:55:15', '2021-02-24 17:55:15', NULL, 1, NULL);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `FK_77E6BED5DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `datos_facturacion`
--
ALTER TABLE `datos_facturacion`
  ADD CONSTRAINT `FK_F03143BDDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `historial_pedidos`
--
ALTER TABLE `historial_pedidos`
  ADD CONSTRAINT `fk_HistorialUsuario` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `imagenes_prod`
--
ALTER TABLE `imagenes_prod`
  ADD CONSTRAINT `fk_imagenes_prod` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`);

--
-- Filtros para la tabla `lineas_carrito`
--
ALTER TABLE `lineas_carrito`
  ADD CONSTRAINT `FK_8F9222867645698E` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`),
  ADD CONSTRAINT `FK_8F922286DE2CF6E7` FOREIGN KEY (`carrito_id`) REFERENCES `carrito` (`id`),
  ADD CONSTRAINT `fk_talla_ln_carrito` FOREIGN KEY (`talla_id`) REFERENCES `talla` (`id`);

--
-- Filtros para la tabla `lineas_historial`
--
ALTER TABLE `lineas_historial`
  ADD CONSTRAINT `fk_lineasHistorial` FOREIGN KEY (`historial_id`) REFERENCES `historial_pedidos` (`id`);

--
-- Filtros para la tabla `lineas_pedidos`
--
ALTER TABLE `lineas_pedidos`
  ADD CONSTRAINT `FK_9F6250F94854653A` FOREIGN KEY (`pedido_id`) REFERENCES `pedido` (`id`),
  ADD CONSTRAINT `FK_9F6250F97645698E` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`),
  ADD CONSTRAINT `fk_talla_ln_pedido` FOREIGN KEY (`talla_id`) REFERENCES `talla` (`id`);

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `FK_C4EC16CEDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `FK_A7BB06153397707A` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`);

--
-- Filtros para la tabla `tallas_producto`
--
ALTER TABLE `tallas_producto`
  ADD CONSTRAINT `fk_producto_talla` FOREIGN KEY (`talla_id`) REFERENCES `talla` (`id`),
  ADD CONSTRAINT `fk_talla_producto` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
