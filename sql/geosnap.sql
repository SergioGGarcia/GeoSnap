-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-06-2024 a las 16:23:36
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
-- Base de datos: `geosnap`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_publicacion` int(11) NOT NULL,
  `contenido` varchar(200) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id`, `id_usuario`, `id_publicacion`, `contenido`, `fecha`) VALUES
(58, 8, 28, 'Me encanta el retiro', '2024-06-12'),
(59, 8, 27, 'Mi museo preferido', '2024-06-12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_publicacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `likes`
--

INSERT INTO `likes` (`id`, `id_usuario`, `id_publicacion`) VALUES
(114, 13, 28),
(115, 13, 26),
(116, 13, 25),
(117, 13, 24),
(118, 13, 23),
(119, 9, 28),
(120, 9, 27),
(121, 8, 27),
(122, 8, 28);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicaciones`
--

CREATE TABLE `publicaciones` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `archivo` varchar(200) NOT NULL,
  `ubicacion` varchar(100) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `etiqueta` varchar(50) NOT NULL,
  `pais` varchar(50) NOT NULL,
  `fecha` date NOT NULL,
  `likes` int(11) NOT NULL,
  `num_comentarios` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `publicaciones`
--

INSERT INTO `publicaciones` (`id`, `id_usuario`, `archivo`, `ubicacion`, `descripcion`, `etiqueta`, `pais`, `fecha`, `likes`, `num_comentarios`) VALUES
(16, 9, 'FVBTLK2T75KLBIXLCDSTRQDMZM.jpg', 'Bar El Brillante Madrid', 'Este bar es una pasada, con una decoración muy futurista', 'bar', '', '2024-06-12', 0, 0),
(17, 9, 'Mulhacen.jpg.webp', 'Mulhacén Andalucía', 'Imagen que conseguí sacar del pico Mulhacén', 'montaña', '', '2024-06-12', 0, 0),
(18, 10, 'pico-del-teide-with-famous-roque-cinchado-rock-formation-tenerife-canary-islands-spain-stockpack-adobe-stock-1024x544.jpg.webp', 'Teide', 'Increíble imagen que le pude sacar al Teide!!', 'montaña', '', '2024-06-12', 0, 0),
(19, 10, 'cala-san-vicente-1501777019.jpg', 'Cala de San Vicente, Ibiza', 'Me encanta Ibiza', 'playa', '', '2024-06-12', 0, 0),
(20, 13, 'national-museum-of-roman-art-building-by-architect-rafael-news-photo-1653044407.jpg', 'Museo Nacional de Arte Romano, Mérida', 'Que pasada los romanos!', 'museo', '', '2024-06-12', 0, 0),
(21, 13, 'Ordesa-y-Monte-Perdido-9-1.jpg.webp', 'Monte Perdido, Huesca', 'Estas laderas me encantan', 'montaña', '', '2024-06-12', 0, 0),
(22, 12, '58.webp', 'La Catedral de Segovia', 'Es espectacular esta catedral', 'catedral', '', '2024-06-12', 0, 0),
(23, 12, 'illetes-formentera-1501777020.jpg', 'Ses Illetes, Formentera', 'Me encanta formentera', 'playa', '', '2024-06-12', 1, 0),
(24, 9, '138734.webp', 'Parque María Luisa, Sevilla', 'Increíble parque de Sevilla', 'parque', '', '2024-06-12', 1, 0),
(25, 10, '138737.webp', 'Parque de la Magdalena, Santander', 'Este parque es una locura', 'parque', '', '2024-06-12', 1, 0),
(26, 8, 'peñalara-1024x529.jpg.webp', 'La Peñalara, Madrid', 'Foto conseguida en Peñalara, en Madrid', 'montaña', '', '2024-06-12', 1, 0),
(27, 14, '10gettyimages-488945673.jpg', 'Museo Nacional del Prado, Madrid', 'El prado!!', 'museo', '', '2024-06-12', 2, 1),
(28, 13, '138736.webp', 'Parque de El Retiro, Madrid', 'El parque mas popular de Madrid', 'parque', '', '2024-06-12', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguidores`
--

CREATE TABLE `seguidores` (
  `identificador` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `id_usuario_seguidor` int(11) NOT NULL,
  `nombre_usuario_seguidor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `seguidores`
--

INSERT INTO `seguidores` (`identificador`, `id`, `nombre_usuario`, `id_usuario_seguidor`, `nombre_usuario_seguidor`) VALUES
(18, 8, 'alberto123', 13, 'maria123'),
(19, 10, 'antonio123', 13, 'maria123'),
(20, 13, 'maria123', 9, 'ana123'),
(21, 10, 'antonio123', 9, 'ana123'),
(22, 12, 'pepe123', 9, 'ana123'),
(23, 14, 'rodrigo123', 11, 'pedro123'),
(24, 13, 'maria123', 11, 'pedro123'),
(25, 9, 'ana123', 11, 'pedro123'),
(26, 8, 'alberto123', 11, 'pedro123'),
(27, 13, 'maria123', 8, 'alberto123'),
(28, 10, 'antonio123', 8, 'alberto123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguidos`
--

CREATE TABLE `seguidos` (
  `identificador` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `id_usuario_seguido` int(11) NOT NULL,
  `nombre_usuario_seguido` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `seguidos`
--

INSERT INTO `seguidos` (`identificador`, `id`, `nombre_usuario`, `id_usuario_seguido`, `nombre_usuario_seguido`) VALUES
(18, 13, 'maria123', 8, 'alberto123'),
(19, 13, 'maria123', 10, 'antonio123'),
(20, 9, 'ana123', 13, 'maria123'),
(21, 9, 'ana123', 10, 'antonio123'),
(22, 9, 'ana123', 12, 'pepe123'),
(23, 11, 'pedro123', 14, 'rodrigo123'),
(24, 11, 'pedro123', 13, 'maria123'),
(25, 11, 'pedro123', 9, 'ana123'),
(26, 11, 'pedro123', 8, 'alberto123'),
(27, 8, 'alberto123', 13, 'maria123'),
(28, 8, 'alberto123', 10, 'antonio123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contraseña` varchar(150) NOT NULL,
  `biografia` varchar(300) DEFAULT NULL,
  `foto_perfil` varchar(200) DEFAULT NULL,
  `tipo_usuario` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `nombre_usuario`, `email`, `contraseña`, `biografia`, `foto_perfil`, `tipo_usuario`) VALUES
(8, 'Alberto', 'Parra', 'alberto123', 'alberto@gmail.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 'Este es mi perfil de GeoSnap', '_92b67edc-2ddc-4b36-ad03-807fcb7fbd01.jpeg', 'admin'),
(9, 'Ana', 'Gonzalez', 'ana123', 'ana@gmail.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 'Es hora de descubrir mundo!!', 'portada-foto-perfil-redes-sociales-consejos-810x540.jpg', 'usuario'),
(10, 'Antonio', 'Alvarez', 'antonio123', 'antonio@gmail.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', NULL, '677442473_224809016_1706x1511.webp', 'usuario'),
(11, 'Pedro', 'García', 'pedro123', 'pedro@gmail.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', NULL, '569465-whatsapp-que-tus-contactos-ponen-rana-perfil.jpg', 'usuario'),
(12, 'Pepe', 'Gonzalez', 'pepe123', 'pepe@gmail.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', NULL, 'Foto-perfil-linkedin-retrato-cv_29-1-300x450.jpg', 'usuario'),
(13, 'María', 'Bravo', 'maria123', 'maria@gmail.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', NULL, 'fotor-03d1a91a0cec4542927f53c87e0599f6.webp', 'usuario'),
(14, 'Rodrigo', 'Peralta', 'rodrigo123', 'rodrigo@gmail.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', NULL, NULL, 'usuario');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_publicacion` (`id_publicacion`);

--
-- Indices de la tabla `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_publicacion` (`id_publicacion`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `seguidores`
--
ALTER TABLE `seguidores`
  ADD PRIMARY KEY (`identificador`),
  ADD KEY `id_usuario_seguidor` (`id_usuario_seguidor`),
  ADD KEY `seguidores_ibfk_2` (`id`),
  ADD KEY `seguidores_ibfk_3` (`nombre_usuario`),
  ADD KEY `seguidores_ibfk_4` (`nombre_usuario_seguidor`);

--
-- Indices de la tabla `seguidos`
--
ALTER TABLE `seguidos`
  ADD PRIMARY KEY (`identificador`),
  ADD KEY `id_usuario_seguido` (`id_usuario_seguido`),
  ADD KEY `seguidos_ibfk_1` (`id`),
  ADD KEY `nombre_usuario_seguido` (`nombre_usuario_seguido`) USING BTREE,
  ADD KEY `nombre_usuario` (`nombre_usuario`) USING BTREE;

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_usuario` (`nombre_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de la tabla `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `seguidores`
--
ALTER TABLE `seguidores`
  MODIFY `identificador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `seguidos`
--
ALTER TABLE `seguidos`
  MODIFY `identificador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`id_publicacion`) REFERENCES `publicaciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`id_publicacion`) REFERENCES `publicaciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD CONSTRAINT `publicaciones_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `seguidores`
--
ALTER TABLE `seguidores`
  ADD CONSTRAINT `seguidores_ibfk_1` FOREIGN KEY (`id_usuario_seguidor`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `seguidores_ibfk_2` FOREIGN KEY (`id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `seguidores_ibfk_3` FOREIGN KEY (`nombre_usuario`) REFERENCES `usuarios` (`nombre_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seguidores_ibfk_4` FOREIGN KEY (`nombre_usuario_seguidor`) REFERENCES `usuarios` (`nombre_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `seguidos`
--
ALTER TABLE `seguidos`
  ADD CONSTRAINT `seguidos_ibfk_1` FOREIGN KEY (`id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `seguidos_ibfk_2` FOREIGN KEY (`nombre_usuario`) REFERENCES `usuarios` (`nombre_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seguidos_ibfk_3` FOREIGN KEY (`id_usuario_seguido`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `seguidos_ibfk_4` FOREIGN KEY (`nombre_usuario_seguido`) REFERENCES `usuarios` (`nombre_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
