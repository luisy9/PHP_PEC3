-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-12-2023 a las 16:28:42
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
-- Base de datos: `luis_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos_culturales`
--

CREATE TABLE `eventos_culturales` (
  `id` int(99) NOT NULL,
  `nombre_del_evento` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `ubicacion` varchar(255) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `categoría` varchar(255) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT curdate(),
  `hora` timestamp NOT NULL DEFAULT curtime()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `eventos_culturales`
--

INSERT INTO `eventos_culturales` (`id`, `nombre_del_evento`, `descripcion`, `ubicacion`, `imagen`, `categoría`, `fecha`, `hora`) VALUES
(1, 'Concierto de Jazz en el Parque', 'Un relajante concierto de jazz al aire libre.', 'Parque Centra', 'jazz.png', 'Música', '2023-01-14 23:00:00', '2023-11-02 09:12:14'),
(2, 'Exhibición de Arte Moderno', 'Una colección única de obras de artistas contemporáneos.', 'Galería de Arte Urbano', 'arte_moderno.png', 'Arte', '2023-02-04 23:00:00', '0000-00-00 00:00:00'),
(4, 'Festival Gastronómico', 'Degustación de platos gourmet de chefs locales.', 'Plaza de la Ciudad', 'gastronomia.png', 'Gastronomía', '2023-03-19 23:00:00', '2023-11-24 09:26:50'),
(5, 'Representación Teatral Clásica', 'Una actuación de una obra clásica de teatro.', 'Teatro Municipal', 'teatro.png', 'Teatro', '2023-04-09 22:00:00', '2023-11-24 16:00:00'),
(9, 'Feria del Libro', 'Celebración de la literatura con presentaciones y firmas de libros.', 'Plaza de la Biblioteca', 'biblioteca.png', 'Literatura', '2023-05-14 22:00:00', '2023-11-24 09:00:00'),
(10, 'Recital de Ballet', 'Espectáculo elegante de danza clásica y contemporánea.', 'Teatro de Danza', 'teatroDanza.png', 'Cultural Alternativo', '2023-06-24 22:00:00', '2023-11-24 09:27:33'),
(11, 'Noche de Cine al Aire Libre', 'Proyección de películas clásicas bajo las estrellas.', 'Parque de Cine', 'cine.png', 'Cine', '2023-07-11 22:00:00', '2023-11-24 21:00:22'),
(12, 'Festival de Música Indie\"', 'Actuaciones de bandas emergentes de música indie.', 'Cultural Alternativo', 'alternativo.png', 'Cultural Alternativo', '2023-08-29 22:00:00', '2023-11-24 20:15:00'),
(13, 'Festival de Fotografía Urbana', 'Exposición de fotografías que capturan la esencia de la vida urbana en la ciudad.', 'Galería de Fotografía Moderna', 'fotografia_moderna.png', 'Fotografía', '2023-09-07 22:00:00', '2023-11-24 14:27:55'),
(14, 'Noche de Comedia en Vivo', 'Una noche llena de risas con actuaciones en vivo de comediantes locales e invitados especiales.', 'Teatro de la Comedia', 'invitados.png', 'Comedia', '2023-10-11 22:00:00', '2023-11-24 18:28:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tu_tabla`
--

CREATE TABLE `tu_tabla` (
  `id` int(11) NOT NULL,
  `fecha` date DEFAULT curdate(),
  `hora` time DEFAULT curtime()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `eventos_culturales`
--
ALTER TABLE `eventos_culturales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tu_tabla`
--
ALTER TABLE `tu_tabla`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `eventos_culturales`
--
ALTER TABLE `eventos_culturales`
  MODIFY `id` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
