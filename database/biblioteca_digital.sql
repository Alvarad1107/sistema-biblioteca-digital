-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-06-2026 a las 06:04:06
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
-- Base de datos: `biblioteca_digital`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Novela Literaria', 'Obras literarias narrativas extensas que cuentan una historia de ficción, incluyendo subgéneros como el realismo mágico y la novela psicológica.'),
(2, 'Cuento y Relato', 'Narraciones breves y concisas, que agrupan antologías, mitología folclórica, leyendas y cuentos tradicionales.'),
(3, 'Ensayo y Crónica', 'Textos en prosa que analizan, interpretan o documentan temas específicos desde una perspectiva crítica, literaria, filosófica o periodística.'),
(4, 'Poesía y Lírica', 'Obras escritas en verso o prosa poética enfocadas en la expresión profunda de sentimientos, emociones y estética del lenguaje.'),
(5, 'Teatro y Drama', 'Obras literarias concebidas y estructuradas a través de diálogos para ser representadas escénicamente frente a un público.'),
(6, 'Literatura Histórica y Testimonial', 'Obras narrativas que relatan, documentan o se basan en hechos históricos reales, conflictos sociopolíticos y vivencias de época.'),
(7, 'Referencia y Lingüística', 'Materiales de consulta técnica, como diccionarios, enciclopedias y manuales, destinados al estudio y comprensión del lenguaje.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_prestamo`
--

CREATE TABLE `detalle_prestamo` (
  `id` int(11) NOT NULL,
  `id_prestamo` int(11) NOT NULL,
  `id_libro` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_prestamo`
--

INSERT INTO `detalle_prestamo` (`id`, `id_prestamo`, `id_libro`, `cantidad`) VALUES
(10, 8, 8, 1),
(11, 8, 26, 1),
(12, 9, 13, 1),
(13, 10, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `id` int(11) NOT NULL,
  `carnet` varchar(50) NOT NULL,
  `nombre_completo` varchar(150) NOT NULL,
  `correo` varchar(150) NOT NULL,
  `carrera` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`id`, `carnet`, `nombre_completo`, `correo`, `carrera`, `telefono`) VALUES
(1, 'MS230015', 'Mateo Silva Morales', 'msilva.23@universidad.edu.sv', 'Ingeniería en Sistemas Informáticos', '7543-9812'),
(2, 'RP210452', 'Rosa Pérez Gonzáles', 'rperez.21@universidad.edu.sv', 'Licenciatura en Administración de Empresas', '6211-4478'),
(3, 'CM220189', 'Carlos Mendoza Ruiz', 'cmendoza.22@universidad.edu.sv', 'Diseño Gráfico', '7890-1234'),
(4, 'AA22011', 'Andrea Alejandra Arias', 'a.arias@estudiantes.edu.sv', 'Ingeniería de Sistemas', '7123-4567'),
(5, 'BM21045', 'Bryan Mauricio Benítez', 'b.benitez@estudiantes.edu.sv', 'Licenciatura en Administración', '7890-1234'),
(6, 'CR20088', 'David Gerardo Domínguez', 'd.dominguez@estudiantes.edu.sv', 'Ingeniería Industrial', '7555-4321'),
(7, 'EL22034', 'Elena Lisseth Escobar', 'e.escobar@estudiantes.edu.sv', 'Licenciatura en Idiomas', '6001-2233'),
(8, 'FM21099', 'Fernando Miguel Flores', 'f.flores@estudiantes.edu.sv', 'Licenciatura en Contaduría', '7999-8877');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `autor` varchar(150) NOT NULL,
  `editorial` varchar(100) DEFAULT NULL,
  `anio_publicacion` int(11) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `estado` enum('disponible','prestado','reservado') NOT NULL DEFAULT 'disponible'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id`, `categoria_id`, `codigo`, `titulo`, `autor`, `editorial`, `anio_publicacion`, `stock`, `estado`) VALUES
(1, 1, 'LIB0001', 'Agua para chocolate', 'Laura Esquivel', 'Editorial Grijalbo / Planeta', 1989, 10, 'disponible'),
(2, 1, 'LIB0002', 'Adiós Job ', 'Emma Dolujanoff', 'Fondo de Cultura Económica (FCE)', 1961, 9, 'disponible'),
(3, 1, 'LIB0003', 'Al filo del agua', 'Agustín Yáñez', 'Editorial Porrúa', 1947, 10, 'disponible'),
(4, 2, 'LIB0004', 'Antonia', 'Ignacio Manuel Altamirano', 'Editorial Porrúa', 1871, 10, 'disponible'),
(5, 1, 'LIB0005', 'Heart of Aztlán (Corazón de Aztlán)', 'Rudolfo Anaya', 'Editorial Justa Publications', 1976, 10, 'disponible'),
(6, 1, 'LIB0006', 'La región más transparente', 'Carlos Fuentes', 'Fondo de Cultura Económica (FCE)', 1958, 10, 'disponible'),
(7, 1, 'LIB0007', 'Juventud en éxtasis', 'Carlos Cuauhtémoc Sánchez', 'Ediciones Selectas Diamante', 1994, 10, 'disponible'),
(8, 1, 'LIB0008', 'Soy de aquí y soy de allá', 'Santiago Genovés', 'UNAM', 1994, 9, 'disponible'),
(9, 1, 'LIB0009', 'El amor y la amistad en el México', 'Salvador Reyes Nevares', 'Fondo de Cultura Económica (FCE)', 1952, 10, 'disponible'),
(10, 1, 'LIB0010', 'El águila y la serpiente', 'Martín Luis Guzmán', 'Espasa-Calpe', 1928, 10, 'disponible'),
(11, 4, 'LIB0011', 'Leyendas Mexicanas', 'Artemio de Valle Arizpe', 'Editorial Porrúa', 1943, 10, 'disponible'),
(12, 1, 'LIB0012', 'El Periquillo Sarniento', 'José Joaquín Fernández de Lizardi', 'Editorial Porrúa', 1816, 10, 'disponible'),
(13, 1, 'LIB0013', 'Voz adolorida', 'Vicente Leñero', 'Siglo XXI Editores', 1961, 9, 'disponible'),
(14, 1, 'LIB0014', 'Los de abajo', 'Mariano Azuela', 'Fondo de Cultura Económica (FCE)', 1915, 10, 'disponible'),
(15, 6, 'LIB0015', 'Matacandela', 'Manou Dornbierer', 'Editorial Diana', 1987, 10, 'disponible'),
(16, 1, 'LIB0016', 'Retrato hablado', 'Manou Dornbierer', 'Editorial Diana', 1976, 10, 'disponible'),
(17, 5, 'LIB0017', 'Oda al Ciudadano General Francisco Morazán', 'Miguel Álvarez Castro', 'Imprenta Nacional', 1942, 10, 'disponible'),
(18, 5, 'LIB0018', 'Campanario', 'Ricardo Triagueros de León', 'Ministerio de Cultura', 1941, 10, 'disponible'),
(19, 1, 'LIB0019', 'La Muerte de la Tórtola', 'José María Peralta Lagos', 'Dirección de Publicaciones (DPI)', 1932, 10, 'disponible'),
(20, 5, 'LIB0020', 'Pascuas de oro', 'Vicente Rosales y Rosales', 'Ministerio de Instrucción Pública', 1947, 10, 'disponible'),
(21, 4, 'LIB0021', 'A la Salida del vapor', 'Juan José Cañas', 'Imprenta Nacional', 1850, 10, 'disponible'),
(22, 4, 'LIB0022', 'Cuentos de barro', 'Salvador Salazar Arrué', 'UCA Editores', 1933, 10, 'disponible'),
(23, 4, 'LIB0023', 'Mitología de Cuscatlán', 'Miguel Ángel Espino', 'Ministerio de Instrucción Pública', 1919, 10, 'disponible'),
(24, 1, 'LIB0024', 'El Asco', 'Horacio Castellanos Moya', 'Tusquets Editores', 1997, 10, 'disponible'),
(25, 2, 'LIB0025', 'A-B-Sudario', 'Jacinta Escudos', 'Alfaguara', 2023, 10, 'disponible'),
(26, 7, 'LIB0026', 'Un dia en la vida', 'Manlio Argueta', 'UCA Editores', 1980, 9, 'disponible'),
(27, 2, 'LIB0027', 'Una grieta en el agua', 'David Escobar Galindo', 'Dirección de Publicaciones (DPI)', 1972, 10, 'disponible'),
(28, 7, 'LIB0028', 'Dolor de Patria', 'José Rutilio Quezada', 'UCA Editores', 1984, 10, 'disponible'),
(29, 2, 'LIB0029', 'Los Cisnes', 'Carlos Anchetta', 'Dirección de Publicaciones (DPI)', 2013, 10, 'disponible'),
(30, 6, 'LIB0030', 'Luz negra', 'Álvaro Menen Desleal', 'Ministerio de Cultura / DPI', 1962, 10, 'disponible'),
(31, 5, 'LIB0031', 'Poemas', 'Alfonso Quijada Urías', 'Editorial UniversitariaEditorial Universitaria (UES)', 1967, 10, 'disponible'),
(32, 7, 'LIB0032', 'Disparo en la catedral', 'Mario Bencastro', 'Editorial Diana', 1984, 10, 'disponible'),
(33, 5, 'LIB0033', 'Vitrales', 'Álvaro Darío Lara', 'Dirección de Publicaciones (DPI)', 1987, 10, 'disponible'),
(34, 5, 'LIB0034', 'Confesiones a Marcia', 'Rafael Mendoza', 'Dirección de Publicaciones (DPI)', 1970, 10, 'disponible'),
(35, 1, 'LIB0035', 'Equis o la pequeña historia de gran amor', 'Ricardo Lindo', 'Dirección de Publicaciones (DPI)', 1976, 10, 'disponible'),
(36, 7, 'LIB0036', 'Real Diccionario de al Vigar Lengua Guanaca', 'Joaquín Meza', 'Editorial Carlos Romero', 2009, 10, 'disponible'),
(37, 2, 'LIB0037', 'El Corneta', 'Roberto Castillo', 'Editorial Guaymuras', 1981, 10, 'disponible'),
(38, 2, 'LIB0038', 'El rostro en el espejo', 'Carmen González Huguet', 'Dirección de Publicaciones (DPI)', 2005, 10, 'disponible'),
(39, 7, 'LIB0039', 'Soldado en Combate', 'Carlos Balmore Fuentes', 'Edición Independiente / UCA', 2015, 10, 'disponible'),
(40, 3, 'LIB0040', 'El Salvador de 1970 a 1990: política, economía y sociedad', 'Luis Armando Gonzáles', 'UCA Editores', 1999, 10, 'disponible');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `estudiante_id` int(11) NOT NULL,
  `fecha_prestamo` date NOT NULL,
  `fecha_devolucion_prevista` date NOT NULL,
  `fecha_devolucion_real` date DEFAULT NULL,
  `estado` enum('activo','devuelto','atrasado') NOT NULL DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `prestamos`
--

INSERT INTO `prestamos` (`id`, `usuario_id`, `estudiante_id`, `fecha_prestamo`, `fecha_devolucion_prevista`, `fecha_devolucion_real`, `estado`) VALUES
(8, 5, 7, '2026-06-20', '2026-06-23', NULL, 'atrasado'),
(9, 1, 3, '2026-06-20', '2026-06-25', NULL, 'activo'),
(10, 2, 2, '2026-06-20', '2026-06-27', NULL, 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre_completo` varchar(150) NOT NULL,
  `correo` varchar(150) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `nivel_acceso` enum('Administrador','Bibliotecario','Supervisor') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_completo`, `correo`, `clave`, `nivel_acceso`) VALUES
(1, 'María Fernanda López', 'maria@biblioteca.com', 'MariaSup26', 'Supervisor'),
(2, 'Roberto Gómez', 'roberto@biblioteca.com', 'RobertoBib26', 'Bibliotecario'),
(3, 'Carlos Alberto Martínez', 'carlos@biblioteca.com', 'CarlosBib26', 'Bibliotecario'),
(4, 'Lucía Fernández', 'lucia@biblioteca.com', 'LuciaBib26', 'Bibliotecario'),
(5, 'Elena Vásquez', 'elena@biblioteca.com', 'Biblio_Admin2026', 'Administrador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_prestamo`
--
ALTER TABLE `detalle_prestamo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_prestamo` (`id_prestamo`),
  ADD KEY `id_libro` (`id_libro`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `carnet` (`carnet`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `estudiante_id` (`estudiante_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `detalle_prestamo`
--
ALTER TABLE `detalle_prestamo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_prestamo`
--
ALTER TABLE `detalle_prestamo`
  ADD CONSTRAINT `detalle_prestamo_ibfk_1` FOREIGN KEY (`id_prestamo`) REFERENCES `prestamos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detalle_prestamo_ibfk_2` FOREIGN KEY (`id_libro`) REFERENCES `libros` (`id`);

--
-- Filtros para la tabla `libros`
--
ALTER TABLE `libros`
  ADD CONSTRAINT `libros_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `prestamos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `prestamos_ibfk_2` FOREIGN KEY (`estudiante_id`) REFERENCES `estudiantes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
