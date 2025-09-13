-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-09-2025 a las 05:23:08
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
(8, 'Tecnología', '#27F5CC'),
(9, 'Politica', '#472d53');

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
(8, 23, 1, 'me gusta la robotica', '2025-08-31 10:52:52'),
(9, 21, 1, 'hola', '2025-08-31 11:32:45'),
(10, 21, 174, 'Asi siempre es', '2025-09-04 17:49:30'),
(11, 28, 158, 'Sera que este finjiendo?', '2025-09-04 19:27:51');

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
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `puntos` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`id`, `nombre`, `puntos`) VALUES
(1, 'Bolivar', 37),
(2, 'Strongest', 43),
(3, 'Always Ready', 40),
(4, 'Booming', 34),
(5, 'Gualberto Villaroel San José', 26),
(6, 'Guabirá', 25),
(7, 'San Antonio Bulo Bulo', 24),
(8, 'Independiente Petrolero', 21),
(9, 'Nacional Potosí', 20),
(10, 'Real Oruro', 20),
(11, 'Universitario de Vinto', 20),
(12, 'Real Tomayapo', 20),
(13, 'Oriente Petrolero', 20),
(14, 'ABB', 18),
(15, 'Wistermann', 7),
(16, 'Aurora', 0);

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
(8, 'Capitan lara ', NULL, 'dfasdfasdfadfadf', 6, 1, '2025-08-30 10:55:10', 'noticia_68b310ceeda8d.jpg'),
(10, 'escadez', NULL, 'dfadfadfadfadsfsdfadfa', 4, 1, '2025-08-30 11:01:20', ''),
(11, 'amor', NULL, 'adsfgdhjklñlkjhgfdsa', 3, 1, '2025-08-30 11:01:59', 'noticia_68b3126709819.jpeg'),
(12, 'Robo', NULL, 'hoy dia', 2, 1, '2025-08-30 11:05:18', 'noticia_68b3132ebc8d2.png'),
(15, 'tuto quiroga', NULL, '12312312312', 2, 1, '2025-08-30 11:14:13', 'noticia_68b31545bb7b9.jpg'),
(16, 'evo', NULL, '98765432', 2, 1, '2025-08-30 11:14:54', 'noticia_68b3156e4b552.jpg'),
(18, 'Tuto quiere ganar las elecciones', 'sera posible que el gane?', 'fadfadfadfafadfadfadfadfadsfadfadfadfadfadfas', 2, 1, '2025-08-30 11:36:18', 'noticia_68b31a72c49d4.jpg'),
(19, 'Bolivar esta a punto de Tocar la Gloria en la sudamericana', 'La academia realiza un esfuerzo para ganar en la sudamericana para ello necesita ganar ante un brasil.', 'La academia esta apunto de ganar la copa sudamericana y también realiza trabajos en el campo ', 4, 1, '2025-08-30 11:47:59', 'noticia_68b31d2fc4823.jpg'),
(20, 'Cuéllar cuestiona lealtad de Camacho y lo acusa de traición y mala gestión en Santa Cruz', 'El diputado del MAS, Rolando Cuéllar, puso en duda la lealtad del gobernador cruceño Luis Fernando Camacho, quien reasumió sus funciones tras ser liberado luego de permanecer más de tres años con detención preventiva en el penal de Chonchocoro por el caso', 'El diputado del MAS, Rolando Cuéllar, puso en duda la lealtad del gobernador cruceño Luis Fernando Camacho, quien reasumió sus funciones tras ser liberado luego de permanecer más de tres años con detención preventiva en el penal de Chonchocoro por el caso denominado Golpe I.\r\n\r\nAunque el gobernador fue recibido con una masiva concentración en Santa Cruz y ratificó su compromiso con la región, el legislador lo acusó de traicionar a sus aliados y de haber fracasado políticamente.\r\n\r\nCuéllar recordó que Camacho grabó de manera oculta a su entonces compañero de fórmula, Marco Pumari, acción que, según dijo, lo despojó de su proyección política.\r\n\r\nTambién cuestionó la incorporación del peruano Walter Chávez -exasesor de Evo Morales- como estratega político en la Gobernación, a quien atribuyó un manejo \"a su antojo\" durante los dos primeros años de gestión.\r\n\r\n\"Vos tenés un pacto con Evo Morales y entregaste a los cruceños al Chapare\", afirmó el parlamentario.\r\n\r\nEl diputado sostuvo que Camacho no logró consolidarse como líder nacional tras obtener solo un 14% de respaldo en las elecciones presidenciales y aseguró que su gestión departamental estuvo marcada por \"pobreza, desempleo, corrupción y falta de proyectos de impacto\".\r\n\r\n\"Lo único que ofreciste fueron paros y confrontación, mientras bloqueabas el desarrollo de los cruceños\", añadió.\r\n\r\nRespecto al anuncio de una eventual Re postulación de Camacho a la Gobernación en 2026, Cuéllar consideró que carece de respaldo ciudadano. \"Santa Cruz no olvida ni perdona. Lo que vos no hiciste, nosotros lo haremos cuando asumamos el 4 de mayo de 2026 como Gobernador del pueblo cruceño\", sentenció.', 2, 1, '2025-08-30 13:31:30', 'noticia_68b3357288f15.jpg'),
(21, 'Lara molesto con doria y claure', 'Edman Lara, dio a conocer en sus redes, que fotografía de Rodrigo Paz con gente de Doria Medina y Claure', 'Edman Lara, dio a conocer en sus redes, que fotografía de Rodrigo Paz con gente de Doria Medina y Claure sea algo casual, porque el no permitirá que se aprovechen de todo este caminar con el pueblo, aseveraba Lara.', 2, 1, '2025-08-30 15:46:41', 'noticia_68b3552132ce8.png'),
(22, 'Jugada magistral de damas', 'En Bolivia, como en la gran mayoría de sus vecinos latinoamericanos, ', 'En Bolivia, como en la gran mayoría de sus vecinos latinoamericanos, el fútbol sigue siendo el deporte por excelencia. Los partidos entre diferentes clubes los domingos, en la calle con los amigos o en los campos de las aldeas remotas, el fútbol está omnipresente en la vida cotidiana de los bolivianos.', 4, 1, '2025-08-30 15:48:32', 'noticia_68b35590ef5b5.jpg'),
(23, 'Robot de vigilancia: ¿el futuro de la seguridad empresarial?', 'Un robot de vigilancia es una máquina que realiza tareas de seguridad de manera autónoma.', 'El sector de la seguridad privada empresarial está experimentando desde hace algunos años un importante crecimiento y una transformación tecnológica imparable. \r\n\r\nAl valor del personal de seguridad humano, se suman cada vez en mayor medida sistemas de seguridad novedosos como los robots de vigilancia, pero también la inteligencia artificial, análisis de Big Data o sensores de última generación, con el fin de salvaguardar de manera efectiva y precisa a personas, infraestructuras y activos de cualquier tipo.\r\n\r\nLa demanda por esta seguridad híbrida es cada vez mayor en todo tipo de empresas y eventos,dando un paso hacia el futuro, que está cada vez más cerca.\r\n\r\nEn Prosegur Security estamos a la vanguardia de la innovación en sistemas de seguridad. Todos los desarrollamos con tecnología punta en el sector, y tenemos una visión integral de la seguridad empresarial que adaptamos a las necesidades específicas de nuestros clientes. Control de accesos, detección de fuego, sistemas anti-intrusión o robótica son solo algunas de nuestras apuestas para mantenerte a ti, tu empresa y empleados seguros.', 8, 1, '2025-08-30 16:25:13', 'noticia_68b35e2934363.jpg'),
(24, 'Segunda vuelta: \"(Lara) en estos últimos 20 días (ha tenido) 20 lapsus\"', 'El balotaje está previsto para el próximo 19 de octubre, entre el Partido Demócrata Cristiano que postula a Rodrigo Paz, a la presidencia y Alianza Libre que propone a Jorge Tuto Quiroga, al mismo cargo.', 'El candidato a la Vicepresidencia del Estado por Alianza Libre, Juan Pablo Velasco, calificó de \'lapsus\' las declaraciones de su contendiente, Edman Lara, del Partido Demócrata Cristiano (PDC). Haciendo clara referencia a las palabras vertidas por el candidato en diferentes escenarios. Asimismo, Velasco adelantó que si ganan el balotaje, reforzarán las relaciones internacionales con Estados Unidos, antes que con Irán. \r\n\r\n\"Yo tengo recomendaciones para él (Edman Lara). Yo creo que no debe ser una mala persona. Yo creo que se ha equivocado al insultar a Tuto Quiroga. Se ha equivocado al difamarme a mí. Se ha equivocado al decirme que me tienen que investigar. Se ha equivocado al decir que quiere meter presos a todos. Se ha equivocado al decir que no confía en la gente que está detrás de él. Se ha equivocado durante estos últimos 20 días\", apuntó Velasco la noche de este miércoles en el programa YO ELIJO, de EL DEBER.\r\n\r\nEntonces, continuó el vicepresidenciable, \"hay que tranquilizarse, debatamos ideas, hablemos de los problemas de la gente. Yo estoy seguro que lo que ha tenido él en estos últimos 20 días son 20 lapsus. No creo que sea una persona así\".\r\n\r\nEs más, Velasco agregó: \"no creo que sea una persona tan agresiva. No creo que sea una persona que parece que tiene un rencor hacia algunos bolivianos. Y debatamos ideas, hablemos de los problemas que tiene la gente\". Inclusive consideró que \"podemos tener una linda charla con él. Lo respeto y entiendo que se ha ganado este lugar. Y entiendo también que como a él le ha debido, como a nosotros, costar mucho esfuerzo, trabajo y sacrificio, no es fácil estar en una segunda vuelta\".', 2, 1, '2025-09-03 23:37:18', 'noticia_68b9096e60e49.jpg'),
(25, 'De la cárcel de EEUU a una celda de Bolivia: Murillo, las tres sentencias y los más de 20 procesos en su contra', 'La exautoridad llegó al país a las 04:30 de este jueves, procedente de EEUU, donde cumplió una sentencia por lavado de activos y soborno en un caso vinculado con la compra de gases que también se investigó en Bolivia y por el cual ya tiene una sentencia.', 'El exministro de Gobierno del periodo de transición, Arturo Murillo, ya está en Bolivia, donde cuenta con dos sentencias, pero además enfrenta otros procesos que están vinculados con casos de corrupción y los hechos vinculados con la crisis de 2019.\r\n\r\nLa exautoridad llegó al país a las 04:30 de este jueves, procedente de EEUU, donde cumplió una sentencia por lavado de activos y soborno en un caso vinculado con la compra de gases lacrimógenos que también se investigó en Bolivia y por el cual ya tiene una sentencia.\r\n\r\nMIRA AQUÍ: Arturo Murillo llega a Bolivia, es aprehendido y la Procuraduría solicita sea encarcelado en Chonchocoro\r\n\r\nTras su arribo al Aeropuerto Internacional de Viru Viru, en Santa Cruz, fue aprehendido por la Policía, que lo trasladará cerca del mediodía hasta La Paz, donde será puesto a disposición de las autoridades judiciales, informó el ministro de Gobierno, Roberto Ríos.\r\n\r\nSentencias y procesos\r\n\r\nMurillo ya tiene dos sentencias ejecutoriadas en Bolivia. La primera condena es por el caso “gases lacrimógenos”, en el que fue sentenciado a ocho años de prisión por la compra con “sobreprecio” de material antidisturbios en medio de la crisis de 2019.\r\n\r\nPor este “negociado” fue detenido y encarcelado en Estados Unidos, acusado “por cargos penales relacionados con su supuesta participación en un esquema de soborno y lavado de dinero”.', 2, 1, '2025-09-04 08:28:23', 'noticia_68b985e7f319a.webp'),
(26, 'La Verde definió su equipo para buscar un resultado histórico ante Colombia en Barranquilla', 'La selección boliviana cerró prácticas este miércoles por la noche en el estadio Metropolitano, donde el cuerpo técnico definió el onceno titular para enfrentarse al combinado cafetalero.', 'La selección boliviana tuvo su último entrenamiento y quedó lista para enfrentarse a Colombia, este jueves por la penúltima fecha de las Eliminatorias. El DT Óscar Villegas definió el onceno titular en busca de un resultado histórico en Barranquilla.\r\n\r\nEl combinado nacional llegó al estadio Metropolitano cerca de las 18:30 para la práctica, donde los jugadores hicieron un trabajo táctico y el técnico cochabambino aprovechó para delinear el onceno titular.\r\nEl entrenamiento fue a puerta cerrada para la prensa. Tras una exigente jornada de trabajo, los jugadores abandonaron el escenario deportivo cerca de las 20:30 y los futbolistas que hablaron con la prensa fueron Moisés Villarroel, Carmelo Algarañaz y Carlos Lampe.\r\n\r\n“Tuvimos buena práctica, está linda la cancha y vamos a aprovechar eso. Tenemos que competir, lo primordial será el orden táctico, estar bien en todas las líneas”, manifestó Algarañaz.\r\nSegún los reportes desde Barranquilla, el DT Villegas no cambiará el sistema de juego, usando el habitual 4-2-3-1 con un solo atacante y tres volantes ofensivos para tratar de generar juego.\r\n\r\nEn el arco, todo apunta que el titular será Carlos Lampe por encima de Guillermo Viscarra, este último que se retiró del estadio Metropolitano sin dar declaraciones y con cara de ‘pocos amigos’.\r\n\r\nMientras que el resto del equipo estará compuesto por Diego Medina, Luis Haquin, Efraín Morales, José Sagredo; Héctor Cuéllar, Gabriel Villamil, Robson Matheus o Moisés Villarroel, Miguelito, Roberto Fernández y Carmelo Algarañaz.', 4, 1, '2025-09-04 08:30:57', 'noticia_68b98681be921.webp'),
(27, 'Balacera en Warnes: Delincuentes arremeten contra policías que buscaban los restos de Lorgio Saucedo', 'Según los datos preliminares del caso, el operativo policial buscaba dar con el cuerpo de Lorgio Saucedo Méndez, un hombre que fue asesinado en un caso que aún se investiga y del que ya hay cuatro personas aprehendidas', 'Un fuerte contingente policial llegó este jueves a un hangar en una zona boscosa del municipio cruceño de Warnes, como parte de un operativo de búsqueda del cuerpo de Lorgio Saucedo Méndez, un hombre que fue asesinado en un caso que aún es investigado y del que ya hay cuatro personas aprehendidas.\r\n\r\nDe manera preliminar, se conoce que cuando los uniformados intentaron ingresar al lugar, sujetos armados abrieron fuego contra los efectivos para frenar su avance.\r\nDespués de esta balacera, se realizaron sobrevuelos en la zona y los agentes fuertemente armados lograron tomar el control del interior del hangar. Sin embargo, se desconoce aún el resultado final de la intervención y si hubo detenidos o heridos.\r\n\r\nUn grupo de agentes de la División de Análisis Criminal e Inteligencia (DACI) se encuentra en el lugar trabajando para identificar a los responsables de la balacera y determinar las circunstancias exactas del incidente.', 2, 1, '2025-09-04 10:39:09', 'noticia_68b9a48dab31f.webp'),
(28, 'Murillo padece hipertensión arterial y una crisis de ansiedad, informa el Gobierno', 'A su llegada a Bolivia, el exministro Arturo Murillo ha sido diagnosticado con condiciones de salud, por las cuales recibió atención en el aeropuerto de Viru...', 'A su llegada a Bolivia, el exministro Arturo Murillo ha sido diagnosticado con condiciones de salud, por las cuales recibió atención en el aeropuerto de Viru Viru.\r\n\r\nEl ministro de Gobierno, Roberto Ríos, precisó que Murillo padece un cuadro hipertensión arterial, por el cual recibe medicación, pero también estaría pasando por una crisis ansiosa.\r\n\r\n\"El plantel médico está realizando todas las actuaciones correspondientes para poder garantizar el estado de salud estable del señor Arturo Murillo\", dijo Ríos en Viru Viru.\r\n\r\nEl exministro llegó en la madrugada a Santa Cruz, tras ser deportado desde Estados Unidos, donde cumplió una condena por lavado de dinero proveniente de la corrupción.', 2, 1, '2025-09-04 12:24:38', 'noticia_68b9bd46546e3.jpg'),
(29, 'Bolivia y su reto histórico: así será el repechaje rumbo al Mundial 2026', 'La Selección Boliviana logró un hito inédito al asegurar su presencia en el repechaje intercontinental para la Copa del Mundo 2026. La ‘Verde’ venció 1-0 a Brasil en El Alto y ahora sueña con uno de los dos boletos disponibles que se definirán en México.', 'La noche del martes quedará grabada en la memoria del fútbol boliviano. En el estadio Municipal de El Alto, la Selección Nacional derrotó 1-0 a Brasil y selló su clasificación al repechaje intercontinental rumbo al Mundial 2026, un logro histórico para el país.\r\n\r\nCon este resultado, la ‘Verde’, que ocupa el puesto 78 en el ranking FIFA, sumó 20 puntos y terminó séptima en las Eliminatorias Sudamericanas. La otra cara de la jornada la vivió Venezuela, que quedó fuera tras caer 3-6 frente a Colombia en la última fecha.\r\n\r\nEl repechaje se disputará del 24 al 31 de marzo de 2026 en Monterrey y Guadalajara, México, en un formato novedoso de liguilla. Participarán seis equipos: Bolivia como representante de CONMEBOL, dos selecciones de CONCACAF, una de Asia (AFC), una de África (CAF) y una de Oceanía (OFC). De este último bloque, Nueva Caledonia ya está confirmada, actualmente en el puesto 152 del ranking FIFA.\r\n\r\nLos seis equipos se dividirán en dos grupos de tres. Los cuatro peores ubicados en el ranking FIFA disputarán semifinales a partido único; los ganadores se medirán en la final contra el cabeza de serie de su grupo. Los dos vencedores de esas finales se quedarán con los últimos boletos mundialistas.\r\n\r\nEn total, se jugarán cuatro partidos: dos semifinales y dos finales, todos en suelo mexicano, una de las sedes del próximo Mundial.', 4, 1, '2025-09-10 10:34:12', 'noticia_68c18c64796cb.jpeg');

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
(8, 'Organo Electoral', 'carrusel_68b32f8daa94c.png', 'https://www.oep.org.bo/', 'carrusel'),
(12, 'Bolivar', 'publicidad_68c4653cd60d9.jpg', 'https://cineramatv.com/', 'carrusel'),
(13, 'Booming', 'publicidad_68c4669aa51ea.jpg', 'https://cineramatv.com/', 'carrusel');

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
(32, 'andres', 'andres@gmail.com', '$2y$10$MWV30qy3CsFKaFSlswi3a.ZJV8kXJtT3LR.CuT5u6guJIxb9fNiOW', 2),
(109, 'Carlos Ponce Quinteros', 'carlosponce@cinerama.com', '$2y$10$0IvaLs3sP7yVZk2tFtboluQBSZnA1GjKE0TigIzxRZ75/RdsPsDPe', 1),
(158, 'gogo', 'gogo@gmail.com', '$2y$10$JCy/ba0TkbngmnGwT2h9M.29eq76AkHfiBSDPjT2GEGFRJSCsx232', 3),
(173, 'javi', 'javi@gmail.com', '$2y$10$ssJIIcsCjq5fSjRSzoA5w.mfRslxeKqXCPDdsc4UHl7quCMVTBGPe', 3),
(174, 'durne', 'durne@gmail.com', '$2y$10$K.CxoE0v3/8E2wVIFLh6R.p9YrOuFDS8DHqG9hiS25D6YhU2Y7hVu', 3),
(175, 'yeni', 'yeni@gmail.com', '$2y$10$uepRFVg98jSIPE1sodiYXuLFZ0SyKr1yURwZZ1XoDOarUPGgOzVZm', 3),
(176, 'mallcu', 'mallcu@gmail.com', '$2y$10$tyIWtVzC10U/o67Ajhyi1.XGm4i3zCkCkW.JIiqnjSyStQ2RgMUIq', 3),
(178, 'Paola Alvarez', 'paolaalvarez@cinerama.com', '$2y$10$aAlpNg9ejiK29BGfLZY/fepilVyoBF8d/UJOc5K1cjG72od8wJToy', 3),
(179, 'Lorena ayala poma', 'lorena@gmail.com', '$2y$10$azkjUyaMvc7uTXsOInl2gOEyQ.N/a1Hk909O0c7YnYmitvSrdvpdi', 3),
(180, 'lore', 'lore@gmail.com', '$2y$10$a88JWmkrjQB9iF.qh9BQ9e2CSzbDDpqo7QYwVUxUwelzzKqxU07xq', 3),
(181, 'ramiro', 'ramiro@gmail.com', '$2y$10$Vop0i5IwovGm7W7ABiGozOT0UxCdafn1TdEAtAEGWrAUOhRtEzq3O', 3),
(182, 'aron', 'aron@gmail.com', '$2y$10$AvePbNebefre3tic37VD8OaTbQiIcdypcoY/ICiQqkNsViJKJBB66', 3),
(183, 'silvia', 'silvia@gmail.com', '$2y$10$otxZtH7UdWLHU4bfoKtSYefACgiEY0HxylHAtwQtXhMd/3uOEYKI.', 3),
(184, 'prueba', 'prueba@gmail.com', '$2y$10$l1DtYeakpbkdIxpKT7Z24ups/X3u2hYXnHUHwKurCV/j2IWABedHG', 3),
(185, 'prueba2', 'prueba2@gmail.com', '$2y$10$zBbsvPJta8LU86DfUisrbunngZw4H0UgUmZs6IVbyyPaDKE1CGIAu', 3),
(186, 'prueba3', 'prueba3@gmail.com', '$2y$10$N6lfQP.EX10SnsuYEqhwDOtXjMA/S.qdxzhyeJvpzmd3fKPrpef8.', 3),
(187, 'kim', 'kim@gmail.com', '$2y$10$QAP94bNigEiHjVqs/RJsieKXa9FZL4SdpeyaT7COyrcnunDfuSQam', 3);

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
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `destacados`
--
ALTER TABLE `destacados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;

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
