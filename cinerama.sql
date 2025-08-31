-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-08-2025 a las 17:19:16
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cinerama`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `color` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `color`) VALUES
(2, 'Nacional', '#293E5A'),
(3, 'Cultura', '#0DCAF0'),
(4, 'Deportes', '#FFC107'),
(6, 'Internacional', '#198754'),
(8, 'Tecnología', '#27F5CC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `noticia_id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `comentario` text NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id`, `noticia_id`, `usuario_id`, `comentario`, `fecha`) VALUES
(1, 20, 1, 'no me cae el amigo del camacho ', '2025-08-30 13:41:32'),
(2, 20, 1, 'no me cae el amigo del camacho ', '2025-08-30 13:41:32'),
(3, 20, 1, 'apoyo a cuellar', '2025-08-30 13:46:20'),
(4, 20, 1, 'apoyo a cuellar', '2025-08-30 13:46:20'),
(5, 20, 1, 'yo apoyo a camacho', '2025-08-30 13:49:16'),
(6, 20, 1, 'yo apoyo a camacho', '2025-08-30 13:49:16'),
(7, 23, 1, 'me gusta la robotica', '2025-08-31 10:52:48'),
(8, 23, 1, 'me gusta la robotica', '2025-08-31 10:52:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destacados`
--

CREATE TABLE `destacados` (
  `id` int(11) NOT NULL,
  `noticia_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `destacados`
--

INSERT INTO `destacados` (`id`, `noticia_id`, `usuario_id`, `fecha`) VALUES
(1, 12, 1, '2025-08-30 13:36:47'),
(2, 20, 1, '2025-08-30 13:41:46'),
(3, 20, 1, '2025-08-30 13:41:46'),
(4, 21, 1, '2025-08-30 15:54:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadisticas`
--

CREATE TABLE `estadisticas` (
  `id` int(11) NOT NULL,
  `noticia_id` int(11) NOT NULL,
  `visitas` int(11) NOT NULL DEFAULT 0,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `url` varchar(100) NOT NULL,
  `icono` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`id`, `nombre`, `url`, `icono`) VALUES
(1, 'Dashboard', 'dashboard.php', 'fa-home'),
(2, 'Usuarios', 'usuarios.php', 'fa-users'),
(3, 'Noticias', 'noticias.php', 'fa-newspaper'),
(4, 'Suscripciones', 'suscripciones.php', 'fa-envelope'),
(5, 'Publicidad', 'publicidad.php', 'fa-bullhorn'),
(6, 'Categorías', 'categorias.php', 'fa-list'),
(7, 'Strimer', 'strimer.php', 'fa-video'),
(8, 'Comentarios', 'comentarios.php', 'fa-comments'),
(9, 'Estadísticas', 'estadisticas.php', 'fa-chart-bar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `id` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `resumen` varchar(255) DEFAULT NULL,
  `contenido` text NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`id`, `titulo`, `resumen`, `contenido`, `categoria_id`, `usuario_id`, `fecha`, `imagen`) VALUES
(6, 'Bonanza gira en Marzo', NULL, 'hgfddsfsfdafdfadfadfadfadfdasfafdadfa', 3, 1, '2025-08-30 10:38:35', NULL),
(7, 'Elecciones', NULL, 'es el nuevo cantidato', 2, 1, '2025-08-30 10:54:34', ''),
(8, 'Capitan lara ', NULL, 'dfasdfasdfadfadf', 6, 1, '2025-08-30 10:55:10', 'noticia_68b310ceeda8d.jpg'),
(10, 'escadez', NULL, 'dfadfadfadfadsfsdfadfa', 4, 1, '2025-08-30 11:01:20', ''),
(11, 'amor', NULL, 'adsfgdhjklñlkjhgfdsa', 3, 1, '2025-08-30 11:01:59', 'noticia_68b3126709819.jpeg'),
(12, 'Robo', NULL, 'hoy dia', 2, 1, '2025-08-30 11:05:18', 'noticia_68b3132ebc8d2.png'),
(15, 'tuto quiroga', NULL, '12312312312', 2, 1, '2025-08-30 11:14:13', 'noticia_68b31545bb7b9.jpg'),
(16, 'evo', NULL, '98765432', 2, 1, '2025-08-30 11:14:54', 'noticia_68b3156e4b552.jpg'),
(17, 'escadez', NULL, 'qweqweq', 3, 1, '2025-08-30 11:19:34', 'noticia_68b3168654729.jpg'),
(18, 'Tuto quiere ganar las elecciones', 'sera posible que el gane?', 'fadfadfadfafadfadfadfadfadsfadfadfadfadfadfas', 2, 1, '2025-08-30 11:36:18', 'noticia_68b31a72c49d4.jpg'),
(19, 'Bolivar esta a punto de Tocar la Gloria en la sudamericana', 'La academia realiza un esfuerzo para ganar en la sudamericana para ello necesita ganar ante un brasil.', 'La academia esta apunto de ganar la copa sudamericana y también realiza trabajos en el campo ', 4, 1, '2025-08-30 11:47:59', 'noticia_68b31d2fc4823.jpg'),
(20, 'Cuéllar cuestiona lealtad de Camacho y lo acusa de traición y mala gestión en Santa Cruz', 'El diputado del MAS, Rolando Cuéllar, puso en duda la lealtad del gobernador cruceño Luis Fernando Camacho, quien reasumió sus funciones tras ser liberado luego de permanecer más de tres años con detención preventiva en el penal de Chonchocoro por el caso', 'El diputado del MAS, Rolando Cuéllar, puso en duda la lealtad del gobernador cruceño Luis Fernando Camacho, quien reasumió sus funciones tras ser liberado luego de permanecer más de tres años con detención preventiva en el penal de Chonchocoro por el caso denominado Golpe I.\r\n\r\nAunque el gobernador fue recibido con una masiva concentración en Santa Cruz y ratificó su compromiso con la región, el legislador lo acusó de traicionar a sus aliados y de haber fracasado políticamente.\r\n\r\nCuéllar recordó que Camacho grabó de manera oculta a su entonces compañero de fórmula, Marco Pumari, acción que, según dijo, lo despojó de su proyección política.\r\n\r\nTambién cuestionó la incorporación del peruano Walter Chávez -exasesor de Evo Morales- como estratega político en la Gobernación, a quien atribuyó un manejo \"a su antojo\" durante los dos primeros años de gestión.\r\n\r\n\"Vos tenés un pacto con Evo Morales y entregaste a los cruceños al Chapare\", afirmó el parlamentario.\r\n\r\nEl diputado sostuvo que Camacho no logró consolidarse como líder nacional tras obtener solo un 14% de respaldo en las elecciones presidenciales y aseguró que su gestión departamental estuvo marcada por \"pobreza, desempleo, corrupción y falta de proyectos de impacto\".\r\n\r\n\"Lo único que ofreciste fueron paros y confrontación, mientras bloqueabas el desarrollo de los cruceños\", añadió.\r\n\r\nRespecto al anuncio de una eventual Re postulación de Camacho a la Gobernación en 2026, Cuéllar consideró que carece de respaldo ciudadano. \"Santa Cruz no olvida ni perdona. Lo que vos no hiciste, nosotros lo haremos cuando asumamos el 4 de mayo de 2026 como Gobernador del pueblo cruceño\", sentenció.', 2, 1, '2025-08-30 13:31:30', 'noticia_68b3357288f15.jpg'),
(21, 'Lara molesto con doria y claure', 'Edman Lara, dio a conocer en sus redes, que fotografía de Rodrigo Paz con gente de Doria Medina y Claure', 'Edman Lara, dio a conocer en sus redes, que fotografía de Rodrigo Paz con gente de Doria Medina y Claure sea algo casual, porque el no permitirá que se aprovechen de todo este caminar con el pueblo, aseveraba Lara.', 2, 1, '2025-08-30 15:46:41', 'noticia_68b3552132ce8.png'),
(22, 'Jugada magistral de damas', 'En Bolivia, como en la gran mayoría de sus vecinos latinoamericanos, ', 'En Bolivia, como en la gran mayoría de sus vecinos latinoamericanos, el fútbol sigue siendo el deporte por excelencia. Los partidos entre diferentes clubes los domingos, en la calle con los amigos o en los campos de las aldeas remotas, el fútbol está omnipresente en la vida cotidiana de los bolivianos.', 4, 1, '2025-08-30 15:48:32', 'noticia_68b35590ef5b5.jpg'),
(23, 'Robot de vigilancia: ¿el futuro de la seguridad empresarial?', 'Un robot de vigilancia es una máquina que realiza tareas de seguridad de manera autónoma.', 'El sector de la seguridad privada empresarial está experimentando desde hace algunos años un importante crecimiento y una transformación tecnológica imparable. \r\n\r\nAl valor del personal de seguridad humano, se suman cada vez en mayor medida sistemas de seguridad novedosos como los robots de vigilancia, pero también la inteligencia artificial, análisis de Big Data o sensores de última generación, con el fin de salvaguardar de manera efectiva y precisa a personas, infraestructuras y activos de cualquier tipo.\r\n\r\nLa demanda por esta seguridad híbrida es cada vez mayor en todo tipo de empresas y eventos,dando un paso hacia el futuro, que está cada vez más cerca.\r\n\r\nEn Prosegur Security estamos a la vanguardia de la innovación en sistemas de seguridad. Todos los desarrollamos con tecnología punta en el sector, y tenemos una visión integral de la seguridad empresarial que adaptamos a las necesidades específicas de nuestros clientes. Control de accesos, detección de fuego, sistemas anti-intrusión o robótica son solo algunas de nuestras apuestas para mantenerte a ti, tu empresa y empleados seguros.', 8, 1, '2025-08-30 16:25:13', 'noticia_68b35e2934363.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia_tag`
--

CREATE TABLE `noticia_tag` (
  `id` int(11) NOT NULL,
  `noticia_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicidad`
--

CREATE TABLE `publicidad` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `espacio` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `publicidad`
--

INSERT INTO `publicidad` (`id`, `nombre`, `imagen`, `link`, `espacio`) VALUES
(7, 'Organo Electoral', 'carrusel_68b32f7489c7e.png', 'https://www.oep.org.bo/', 'carrusel'),
(8, 'Organo Electoral', 'carrusel_68b32f8daa94c.png', 'https://www.oep.org.bo/', 'carrusel');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Editor'),
(3, 'Suscriptor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_menu`
--

CREATE TABLE `rol_menu` (
  `id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `rol_menu`
--

INSERT INTO `rol_menu` (`id`, `rol_id`, `menu_id`) VALUES
(45, 1, 1),
(46, 1, 2),
(47, 1, 3),
(48, 1, 4),
(49, 1, 5),
(50, 1, 6),
(51, 1, 7),
(52, 1, 8),
(53, 1, 9),
(54, 2, 3),
(55, 2, 4),
(56, 2, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_permiso`
--

CREATE TABLE `rol_permiso` (
  `id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `permiso_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `strimer`
--

CREATE TABLE `strimer` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `link` varchar(255) NOT NULL,
  `estado` enum('activo','inactivo') NOT NULL DEFAULT 'inactivo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suscripciones`
--

CREATE TABLE `suscripciones` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `password`, `rol_id`) VALUES
(1, 'wilson', 'admin@cinerama.com', '$2y$10$ZUYZ5aiv9BvpHIDNI2JZxeuk2kwY6ytJNMPndzW8EoO0zSBIhG9FC', 1),
(6, 'wil', 'wil@gmail.com', '$2y$10$ZPKjfeZrRtwciya.48WOt.D82iK2SWnxXF/VmRKmSQGaPfu3JHDLO', 2),
(18, 'ruben', 'ruben@gmail.com', '$2y$10$TJ2icUcPCE6rXqy6b8R8muqCijBcc2TDfY3XNvAYgCYIPxKakK4Ke', 3),
(32, 'andres', 'andres@gmail.com', '$2y$10$MWV30qy3CsFKaFSlswi3a.ZJV8kXJtT3LR.CuT5u6guJIxb9fNiOW', 2),
(34, 'sandro', 'sandro@gmail.com', '$2y$10$raReAkT8FcZuBWKxlvD8xuy.kFREGFmXJtUVgl2PUveliBcYwnsyy', 3),
(81, 'q', 'q@gmail.com', '$2y$10$hqtLmOl3HR7AxPFyofdNXu1K8dKLWxyhXY4rOygF8xMJr8yCfVwKi', 3),
(85, 'a', 'a@gmail.com', '$2y$10$Svvli5Pe/KwXKtBqPdPMIe4a/T9wZV37Ha2RMObS2CotkIslYaZ4O', 3),
(86, 'w', 'w@gmail.com', '$2y$10$NzQVIHSanOb91/ptLny9g.wIP.Azn6wjuG7d6VG8oX/NXVcuNsk9y', 3),
(87, 'ne', 'ne@gmail.com', '$2y$10$b1WYpypVkbR0Y7Z8.MGh2OJs72OdJAS7gt/ciO0jZYA2b/7YxpLRu', 3),
(88, 's', 's@gmail.com', '$2y$10$3hh0lwdS6sJk/DdkEONSCuZayt5B85Fm/xFzAOybDg87E2PK2xBt6', 3),
(89, 'd', 'd@gmail.com', '$2y$10$DJlIBvDI0eclWNAjR5BNgekV4zq.qlkaZzxMTpdLphFYcndqUlSgS', 3),
(90, 'f', 'f@gmail.com', '$2y$10$YRdERV2htoxIjnpF3GFrj.sh64nkr.eSUe9qct5UAHV21eqH0cc3.', 3),
(91, 'g', 'g@gmail.com', '$2y$10$49vVR34T2z3GIxQ1lZYOLOwd4Bdj.0U4lj3b6iDFtJ34fAB2UNLS6', 3),
(92, 'x', 'x@gmail.com', '$2y$10$kru8q9D.WDGMI6DZg0g3DOfq8yLTg..tuYOjnMW5N/6EFygHMEVhe', 3),
(109, 'Carlos Ponce Quinteros', 'carlosponce@cinerama.com', '$2y$10$0IvaLs3sP7yVZk2tFtboluQBSZnA1GjKE0TigIzxRZ75/RdsPsDPe', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `noticia_id` (`noticia_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `destacados`
--
ALTER TABLE `destacados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `noticia_id` (`noticia_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `estadisticas`
--
ALTER TABLE `estadisticas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `noticia_id` (`noticia_id`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `noticia_tag`
--
ALTER TABLE `noticia_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `noticia_id` (`noticia_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `publicidad`
--
ALTER TABLE `publicidad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rol_menu`
--
ALTER TABLE `rol_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rol_id` (`rol_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indices de la tabla `rol_permiso`
--
ALTER TABLE `rol_permiso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rol_id` (`rol_id`),
  ADD KEY `permiso_id` (`permiso_id`);

--
-- Indices de la tabla `strimer`
--
ALTER TABLE `strimer`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `suscripciones`
--
ALTER TABLE `suscripciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `rol_id` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `destacados`
--
ALTER TABLE `destacados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `estadisticas`
--
ALTER TABLE `estadisticas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `noticia_tag`
--
ALTER TABLE `noticia_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `publicidad`
--
ALTER TABLE `publicidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `rol_menu`
--
ALTER TABLE `rol_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `rol_permiso`
--
ALTER TABLE `rol_permiso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `strimer`
--
ALTER TABLE `strimer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `suscripciones`
--
ALTER TABLE `suscripciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`noticia_id`) REFERENCES `noticias` (`id`),
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `destacados`
--
ALTER TABLE `destacados`
  ADD CONSTRAINT `destacados_noticia_fk` FOREIGN KEY (`noticia_id`) REFERENCES `noticias` (`id`),
  ADD CONSTRAINT `destacados_usuario_fk` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `estadisticas`
--
ALTER TABLE `estadisticas`
  ADD CONSTRAINT `estadisticas_ibfk_1` FOREIGN KEY (`noticia_id`) REFERENCES `noticias` (`id`);

--
-- Filtros para la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD CONSTRAINT `noticias_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `noticias_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `noticia_tag`
--
ALTER TABLE `noticia_tag`
  ADD CONSTRAINT `noticia_tag_ibfk_1` FOREIGN KEY (`noticia_id`) REFERENCES `noticias` (`id`),
  ADD CONSTRAINT `noticia_tag_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`);

--
-- Filtros para la tabla `rol_menu`
--
ALTER TABLE `rol_menu`
  ADD CONSTRAINT `rol_menu_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `rol_menu_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`);

--
-- Filtros para la tabla `rol_permiso`
--
ALTER TABLE `rol_permiso`
  ADD CONSTRAINT `rol_permiso_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `rol_permiso_ibfk_2` FOREIGN KEY (`permiso_id`) REFERENCES `permisos` (`id`);

--
-- Filtros para la tabla `suscripciones`
--
ALTER TABLE `suscripciones`
  ADD CONSTRAINT `suscripciones_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
