-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 02-12-2019 a las 18:58:27
-- Versión del servidor: 5.7.26
-- Versión de PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ads`
--

DROP TABLE IF EXISTS `ads`;
CREATE TABLE IF NOT EXISTS `ads` (
  `ad_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `text` varchar(10000) NOT NULL,
  `price` float NOT NULL,
  `city` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`ad_id`),
  KEY `FK_ADS_USERS` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `surname1` varchar(100) NOT NULL,
  `surname2` varchar(100) NOT NULL,
  `telephone` int(11) NOT NULL,
  `banned` int(11) NOT NULL,
  `admin` int(11) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`email`, `password`, `name`, `surname1`, `surname2`, `telephone`, `banned`, `admin`) VALUES
('admin@iragarkiak.eus', '$2y$10$ziDD6N8eWNPG/iWMkCJjZeIP/mY3fv66AgQMJVf97LhuMqKHYVvSm', 'Admin', 'Admin', 'Admin', 123456789, 0, 1),
('azpema@gmail.com', '$2y$10$on14a.lzABcV7JJ/NU9ESu.vC9EOSDUdlvmEyPq3RZMzkhMKL8WRe', 'Agaputo', 'Disousa', 'EZTIATJARRINAHI', 555444333, 0, 0),
('juletxara@gmail.com', '$2y$10$2.e.tniUkw.Qw2WivXnFAevC10UKGkt39v6NycosqH0YVPSxbcetq', 'Julen', 'Etxaniz', 'Aragoneses', 665718477, 0, 0);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ads`
--
ALTER TABLE `ads`
  ADD CONSTRAINT `FK_ADS_USERS` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
