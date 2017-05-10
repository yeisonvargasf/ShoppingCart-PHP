-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 10-05-2017 a las 06:13:11
-- Versión del servidor: 5.5.54-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `shopping_php`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart_product`
--

CREATE TABLE IF NOT EXISTS `cart_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product` int(11) NOT NULL,
  `cart` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Volcado de datos para la tabla `cart_product`
--

INSERT INTO `cart_product` (`id`, `product`, `cart`, `quantity`) VALUES
(1, 6, 1, 6),
(25, 7, 1, 2),
(26, 10, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `price` decimal(45,0) NOT NULL,
  `stock` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `stock`) VALUES
(6, 'Sony Xperia Z5 Premium Dual Sim International Version', 444, 11),
(7, 'LG Stylus 2 GSM Factory Unlocked International Model- Brown', 179, 36),
(8, 'BlackBerry Z30 16GB GSM 4G LTE Smartphone (Unlocked), Black', 137, 68),
(9, 'HTC One X9 International Version (Silver)', 299, 17),
(10, 'BLU Z3 M Z110X GSM Phone (Unlocked)', 15, 10),
(11, 'LG Nexus 5X H790 32GB GSM/CDMA Smartphone (Unlocked)', 326, 41),
(13, 'Samsung Galaxy Alpha G850a Smartphone (Unlocked)', 164, 34),
(14, 'Huawei P8 lite 16GB White International Dual Sim ALE-L21', 170, 28),
(15, 'Galaxy S7 Dual Sim 32GB GSM International Version (Unlocked), Pink', 535, 14),
(16, 'Sony Xperia XA 16GB 5-inch Smartphone, Unlocked - White', 199, 91),
(17, 'Samsung Galaxy Note 4 N910A Smartphone (Unlocked)', 298, 39),
(18, 'BLU Dash JR W D141w GSM Dual-SIM Android Smartphone (Unlocked)', 28, 95),
(19, 'Apple iPhone 5C 16GB GSM Smartphone (Unlocked)', 127, 44),
(20, 'Samsung Galaxy S6, 32GB Verizon CDMA - Black Sapphire', 249, 95),
(21, 'Apple iPhone 4s 8GB Unlocked Smartphone w/ 8MP Camera, White', 54, 22),
(22, 'Samsung Galaxy S4 I337 16GB Smartphone (Unlocked), Black', 142, 95),
(23, 'Motorola Moto G4 16GB Smartphone (Unlocked), Black', 178, 22),
(24, 'Apple iPhone 5s 16GB Smartphone (Unlocked), Gold', 117, 73),
(25, 'Samsung Galaxy S7 edge 32GB Smartphone GSM (Unlocked)', 529, 61),
(26, 'Apple iPhone 5S 16GB GSM Smartphone (Unlocked)', 150, 2),
(27, 'Apple iPhone 6 Plus 16GB Smartphone (Unlocked)', 303, 34),
(28, 'HUAWEI P8 Lite ALE-L04 16GB 4G LTE Smartphone (Unlocked)', 159, 90),
(29, 'Apple iPhone 5s 16GB Smartphone (Unlocked), Gray', 115, 54),
(30, 'Samsung Galaxy S5 G900V 16GB Smartphone (Unlocked)', 125, 32),
(31, 'Apple iPhone 5s 16GB Smartphone (Unlocked), White/Silver', 113, 70);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
