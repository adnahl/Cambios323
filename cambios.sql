-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-03-2022 a las 00:38:56
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `test`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas_guardadas`
--

CREATE TABLE `cuentas_guardadas` (
  `id` int(11) NOT NULL,
  `user_email` varchar(128) NOT NULL,
  `name_type` tinyint(4) NOT NULL,
  `name` varchar(128) NOT NULL,
  `doc_type` tinyint(4) NOT NULL,
  `doc_number` varchar(64) NOT NULL,
  `bank` tinyint(4) NOT NULL,
  `acc_type` tinyint(4) NOT NULL COMMENT 'Tipo de cuenta',
  `acc_number` varchar(128) NOT NULL COMMENT 'Numero de cuenta',
  `comment` varchar(4096) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes`
--

CREATE TABLE `ordenes` (
  `id` int(11) NOT NULL,
  `user_email` varchar(128) NOT NULL,
  `name_type` tinyint(4) NOT NULL,
  `name` varchar(128) NOT NULL,
  `doc_type` tinyint(4) NOT NULL,
  `doc_number` varchar(64) NOT NULL,
  `bank` tinyint(4) NOT NULL,
  `acc_type` tinyint(4) NOT NULL COMMENT 'Tipo de cuenta',
  `acc_number` varchar(128) NOT NULL COMMENT 'Numero de cuenta',
  `amount` float NOT NULL,
  `tiempo` varchar(128) NOT NULL,
  `comment` varchar(4096) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(5) UNSIGNED NOT NULL,
  `Name` text NOT NULL,
  `Username` varchar(68) NOT NULL,
  `Email` text NOT NULL,
  `Password` text NOT NULL,
  `Hash` text NOT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT 0,
  `Img_perfil` varchar(1024) NOT NULL,
  `Phone` varchar(24) DEFAULT NULL,
  `Instagram` varchar(64) DEFAULT NULL,
  `Telegram` varchar(64) DEFAULT NULL,
  `Whatsapp` varchar(24) DEFAULT NULL,
  `IP` text DEFAULT NULL,
  `New_email_temp` varchar(254) DEFAULT NULL,
  `New_password` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='usuarios';


--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cuentas_guardadas`
--
ALTER TABLE `cuentas_guardadas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cuentas_guardadas`
--
ALTER TABLE `cuentas_guardadas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
