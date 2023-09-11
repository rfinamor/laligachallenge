-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-09-2023 a las 22:30:20
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
-- Base de datos: `laligatech_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `club`
--

CREATE TABLE `club` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `budget` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `club`
--

INSERT INTO `club` (`id`, `name`, `budget`) VALUES
(1, 'club primero', 50000),
(2, 'club segundo', 30000),
(3, 'club tercero', 20000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230909003834', '2023-09-09 00:39:32', 91);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `people`
--

CREATE TABLE `people` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `salary` decimal(15,0) NOT NULL,
  `type` varchar(10) DEFAULT NULL,
  `club_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `people`
--

INSERT INTO `people` (`id`, `name`, `last_name`, `age`, `salary`, `type`, `club_id`) VALUES
(1, 'ricardo', 'perez', 29, 100, 'player', 3),
(2, 'marcos', 'perezinsua', 29, 100, 'player', 1),
(3, 'ariel', 'prado', 29, 100, 'player', 3),
(4, 'rodrigo', 'serra', 29, 100, 'player', 1),
(5, 'rodrigo', 'andrade', 29, 100, 'player', 1),
(6, 'rodrigo', 'paez', 29, 100, 'trainer', 1),
(7, 'rodrigo', 'lopez', 20, 100, 'player', 1),
(8, 'mariano', 'lopez', 28, 100, 'player', 1),
(9, 'carlos', 'martinez', 28, 100, 'player', 1),
(10, 'rodrigo', 'pepito', 28, 100, 'player', 1),
(11, 'macarena', 'pepita', 28, 100, 'trainer', 1),
(12, 'carlos', 'pepin', 28, 100, 'trainer', 2),
(13, 'marcos', 'barsa', 22, 100, 'player', 2),
(14, 'marcos', 'barsa', 22, 100, 'player', 2),
(15, 'lautaro', 'kerchap', 22, 100, 'player', 2),
(16, 'gonzalo', 'bonini', 22, 100, 'player', 2),
(17, 'pablo', 'herrera', 22, 100, 'player', 2),
(18, 'lucas', 'perez', 22, 100, 'player', 2),
(19, 'juan', 'navarro', 22, 100, 'player', 2),
(20, 'angel', 'mendez', 22, 100, 'player', 2),
(21, 'martin', 'lambert', 22, 100, 'player', 2),
(22, 'rolando', 'oviedo', 22, 100, 'player', 2),
(23, 'marcos', 'barsa', 22, 100, 'player', 2),
(24, 'mateo', 'barsa', 22, 100, 'player', 2),
(25, 'gabriel', 'foces', 22, 100, 'player', 2),
(26, 'fabian', 'pena', 22, 100, 'player', 2),
(27, 'mateo', 'rodriguez', 22, 100, 'player', 2),
(28, 'alberto', 'antunez', 22, 100, 'player', 2),
(29, 'antonio', 'gonzalez', 22, 100, 'player', 2),
(30, 'luciano', 'esteche', 22, 100, 'player', 2),
(31, 'cesar', 'bal', 22, 100, 'player', 2),
(32, 'manuel', 'ubal', 22, 100, 'player', 2),
(33, 'francisco', 'ojeda', 22, 100, 'player', 2),
(34, 'david', 'gianturco', 22, 100, 'player', 2),
(35, 'manuel', 'pojeda', 22, 100, 'player', 2),
(36, 'emiliano', 'jope', 22, 100, 'player', 2),
(37, 'luis', 'carranza', 22, 100, 'player', 2),
(38, 'sergio', 'gairin', 22, 100, 'player', 2),
(39, 'marcelo', 'barsamian', 22, 100, 'player', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `club`
--
ALTER TABLE `club`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `people`
--
ALTER TABLE `people`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
