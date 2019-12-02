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

--
-- Volcado de datos para la tabla `ads`
--

INSERT INTO `ads` (`ad_id`, `email`, `title`, `category`, `text`, `price`, `city`, `date`) VALUES
(1, 'admin@admin.eus', 'Portatila', 'Informatika', 'Se venden portÃ¡tiles: HP Compaq nx 7400 CaracterÃ­sticas: Intel Core duo, 2gb RAM 120gb hdd, Windows 7 y paquete Office, PANTALLA DE 15,3 PULGADAS. 2 unidades Toshiba tecra a10- 1cl Intel centrino inside, 2gb de RAM, 120gb hdd, Windows 7 y paquete Office Pantalla de 15,3 pulgadas. 16 unidades. Todos con su cargador, baterÃ­a nueva y ratÃ³n. Precio 140â‚¬ negociables por lote.', 600, 'Zarautz', '2019-11-30 13:22:26'),
(2, 'admin@admin.eus', 'Server TTT/Murder/PropHunt', 'Informatika', 'Hire gmod zerbitzaria montaukoiart ordaintze badiak', 50, 'Donosti', '2019-11-30 13:29:50'),
(3, 'admin@admin.eus', 'Arropa zaharra', 'Moda', 'Amonan arropa saÃ±lgai', 1, 'Azpeitia', '2019-11-30 13:32:21'),
(4, 'admin@admin.eus', 'Lorem Ipsum', 'Heziketa', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\r\n\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 40, 'Baracaldo', '2019-11-30 13:55:12'),
(6, 'admin@admin.eus', 'VENDO OPEL CORSA NUEVO!!!!!!!!!!!!', 'Ibilgailuak', 'Vendo renault megane motor diÃ©sel 1. 9dci 130cv con cambio manual de 6 velocidades de mediados del 2009 de los Ãºltimos de esa carrocerÃ­a con 160. 000kms reales todas las revisiones pasadas en concesionario renault un solo propietario con cierre con mando eleva lunas elÃ©ctricos direcciÃ³n asistida espejos elÃ©ctricos plegables climatizador ordenador de abordo radio cd con mandos al volante control de velocidad de crucero frenos abs con control de tracciÃ³n llantas de aleaciÃ³n sensor de luces y lluviaapoyabrazos central asientos de cuero con anclaje isÃ³fix etc. . . coche en muy buen estado general motor potente y econÃ³mico libro de mantenimiento en concesionario renault se aceptarÃ­a prueba mecÃ¡nica en taller oficial o de confianza el coche se encuentra en almoradÃ­ se puede ver y probar. Color GRIS', 10000, 'Gasteiz', '2019-11-30 14:28:22'),
(7, 'admin@admin.eus', 'wallpaper', 'Zaletasunak', 'Zure ordenagailurako wallpaper-a saltzen det, Prezio ezinhobea', 20, 'Getaria', '2019-11-30 17:52:32'),
(10, 'juletxara@gmail.com', 'aadwdaw', 'Ibilgailuak', 'wdadwdwdwa', 3, 'Azpeitia', '2019-12-01 19:26:08'),
(11, 'azpema@gmail.com', 'Zure GrAL lana egingo dut', 'Negozioak', 'Ba hoi, nei ordaindu ta gradu amaierako lana ingo diat (Eztiat aprobaua aseguratzen, hik ikusi)', 200, 'Zarautz', '2019-12-02 18:45:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `locations`
--

DROP TABLE IF EXISTS `locations`;
CREATE TABLE IF NOT EXISTS `locations` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(100) NOT NULL,
  `region` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
('admin@admin.eus', '$2y$10$SmGo5zQqTIS6FU9WoSIaR.ILtJhwXGpeNagejvHrKDVIu4rYEY2Va', 'Markel', 'Azpeitia', 'Loiti', 688659089, 0, 1),
('admin@ehu.es', '$2y$10$ziDD6N8eWNPG/iWMkCJjZeIP/mY3fv66AgQMJVf97LhuMqKHYVvSm', 'Admin', 'Admin', 'Admin', 123456789, 0, 1),
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
