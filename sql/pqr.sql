-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-02-2023 a las 21:02:54
-- Versión del servidor: 10.4.16-MariaDB
-- Versión de PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pqr`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion`
--

CREATE TABLE `calificacion` (
  `id_calificacion` int(11) NOT NULL,
  `descripcion_calificacion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `calificacion`
--

INSERT INTO `calificacion` (`id_calificacion`, `descripcion_calificacion`) VALUES
(1, 'Buena'),
(2, 'Mala'),
(3, 'Referenciado por otra persona'),
(4, 'Por radio'),
(5, 'Por redes sociales'),
(6, 'Muy Buena'),
(7, 'por reconocimento de la IPS'),
(8, 'Si'),
(9, 'No'),
(10, 'Regular'),
(11, 'Muy Mala'),
(12, 'Definitivamente Si'),
(13, 'Probablemente Si'),
(14, 'Definitivamente No'),
(15, 'Probablemente No');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `id_contacto` int(11) NOT NULL,
  `descripcion_contacto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuesta`
--

CREATE TABLE `encuesta` (
  `id_encuesta` int(11) NOT NULL,
  `descripcion` varchar(300) DEFAULT NULL,
  `fecha_encuesta` date DEFAULT NULL,
  `hora_encuesta` time DEFAULT NULL,
  `estado` enum('Activa') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `encuesta`
--

INSERT INTO `encuesta` (`id_encuesta`, `descripcion`, `fecha_encuesta`, `hora_encuesta`, `estado`) VALUES
(22, 'De Satisfaccion', '2018-08-04', '21:55:40', 'Activa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id_estado` int(11) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id_estado`, `descripcion`) VALUES
(1, 'ENVIADA'),
(2, 'EN TRAMITE'),
(3, 'RESUELTA'),
(4, 'TERMINADA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificacion`
--

CREATE TABLE `notificacion` (
  `id_notificacion` int(11) NOT NULL,
  `id_solicitud` int(11) DEFAULT NULL,
  `fecha_notificacion` date DEFAULT NULL,
  `descripcion_notificacion` varchar(100) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opcion`
--

CREATE TABLE `opcion` (
  `id_opcion` int(11) NOT NULL,
  `id_calificacion` int(11) DEFAULT NULL,
  `id_pregunta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `opcion`
--

INSERT INTO `opcion` (`id_opcion`, `id_calificacion`, `id_pregunta`) VALUES
(1, 1, 2),
(2, 2, 2),
(3, 1, 3),
(4, 2, 3),
(5, 1, 4),
(6, 2, 4),
(7, 2, 6),
(8, 1, 6),
(9, 3, 7),
(10, 4, 7),
(11, 5, 7),
(12, 7, 7),
(13, 1, 8),
(14, 2, 8),
(15, 8, 5),
(16, 9, 5),
(17, 6, 9),
(18, 1, 9),
(19, 10, 9),
(20, 2, 9),
(21, 11, 9),
(22, 12, 10),
(23, 13, 10),
(24, 14, 10),
(25, 15, 10),
(28, 1, 2),
(29, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `id_preguntas` int(11) NOT NULL,
  `id_encuesta` int(11) DEFAULT NULL,
  `des` varchar(3000) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  `tipo` enum('con respuesta predefinida','con respuesta libre') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id_preguntas`, `id_encuesta`, `des`, `orden`, `tipo`) VALUES
(2, 22, 'La atencion recibida por los funcionarios fue ?', 1, 'con respuesta predefinida'),
(3, 22, 'La atencion recibida por el personal fue ?', 3, 'con respuesta predefinida'),
(4, 22, 'PresentaciÃ³n del personal es ?', 4, 'con respuesta predefinida'),
(5, 22, 'Fue atendido a la hora de la cita ?', 5, 'con respuesta predefinida'),
(6, 22, 'La informaciÃ³n recibida por el odontologo fue ? ', 6, 'con respuesta predefinida'),
(7, 22, 'CÃ³mo nos contactÃ³ ?', 7, 'con respuesta predefinida'),
(8, 22, 'La atenciÃ³n recibida por recepciÃ³n fue ?', 2, 'con respuesta predefinida'),
(9, 22, 'Como callificaria su experiencia global respecto a los Servicios de Salud, que ha recibido a traves de ODONTOCAUCA ?', 8, 'con respuesta predefinida'),
(10, 22, 'RecomendarÃ­a a ODONTOCAUCA a su familia y amigos ?', 9, 'con respuesta predefinida'),
(11, 22, 'Como cree usted que podrÃ­amos mejorar nuestro servicio ? ', 10, 'con respuesta libre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas_encuesta`
--

CREATE TABLE `preguntas_encuesta` (
  `id_preguntas_encuesta` int(11) NOT NULL,
  `id_encuesta` int(11) DEFAULT NULL,
  `id_preguntas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta`
--

CREATE TABLE `respuesta` (
  `id_respueta` int(11) NOT NULL,
  `id_opcion` int(11) NOT NULL,
  `id_users` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestalibre`
--

CREATE TABLE `respuestalibre` (
  `id_respuesta_libre` int(11) NOT NULL,
  `id_users` int(11) DEFAULT NULL,
  `texto` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimiento_solicitud`
--

CREATE TABLE `seguimiento_solicitud` (
  `id_seguimiento` int(11) NOT NULL,
  `id_solicitud` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` varchar(50) DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL,
  `descripcion_estado` text DEFAULT NULL,
  `para_notificacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `seguimiento_solicitud`
--

INSERT INTO `seguimiento_solicitud` (`id_seguimiento`, `id_solicitud`, `fecha`, `hora`, `id_estado`, `descripcion_estado`, `para_notificacion`) VALUES
(1, 19, '2023-01-06', '09:57 AM', 1, 'La solicitud fue recibida con exito, pronto recibira respuesta.', -1),
(2, 19, '2023-01-06', '10:00 AM', 2, 'se dio inicio a la queja', -1),
(3, 19, '2023-01-06', '10:01 AM', 2, 'necesito que se solucionne pronto', 1),
(4, 19, '2023-01-06', '10:02 AM', 3, 'se soluciono', 1),
(5, 19, '2023-01-06', '10:03 AM', 2, 'aun estoy inconform', 1),
(6, 19, '2023-01-06', '10:03 AM', 3, 'ahora si se soluciono', 1),
(7, 19, '2023-01-06', '10:04 AM', 4, 'listo', 1);

--
-- Disparadores `seguimiento_solicitud`
--
DELIMITER $$
CREATE TRIGGER `cambia_estado_solicitud` BEFORE INSERT ON `seguimiento_solicitud` FOR EACH ROW BEGIN
SET @con = (SELECT count(id_solicitud)
				FROM seguimiento_solicitud 
                	WHERE id_solicitud = NEW.id_solicitud);

IF(@con > 1) THEN
        SET NEW.para_notificacion = 1;
        UPDATE `solicitud` SET estado_solicitud = 'Espera' WHERE id_solicitud = NEW.id_solicitud;
    ELSE
         SET NEW.para_notificacion = -1;
    END IF;
        
IF NEW.id_estado = 3 THEN
       UPDATE `solicitud` SET estado_solicitud = 'Espera' WHERE id_solicitud = NEW.id_solicitud;
    END IF;
IF NEW.id_estado = 4 THEN
       UPDATE `solicitud` SET estado_solicitud = 'Inactiva' WHERE id_solicitud = NEW.id_solicitud;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

CREATE TABLE `solicitud` (
  `id_solicitud` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `id_tiposolicitud` int(11) DEFAULT NULL,
  `sufijo_solicitud` varchar(48) DEFAULT NULL,
  `descripcion_solicitud` varchar(10000) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `estado_solicitud` enum('Activa','Inactiva','Espera') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `solicitud`
--

INSERT INTO `solicitud` (`id_solicitud`, `user_id`, `id_tiposolicitud`, `sufijo_solicitud`, `descripcion_solicitud`, `fecha`, `estado_solicitud`) VALUES
(19, 92, 2, NULL, 'prueba de una queja', '2023-01-06', 'Inactiva');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_documentos`
--

CREATE TABLE `tbl_documentos` (
  `id_documento` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(150) DEFAULT NULL,
  `descripcion` mediumtext DEFAULT NULL,
  `tamanio` int(10) UNSIGNED DEFAULT NULL,
  `tipo` varchar(150) DEFAULT NULL,
  `nombre_archivo` varchar(255) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_solicitud` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_solicitud`
--

CREATE TABLE `tipo_solicitud` (
  `id_tiposolicitud` int(11) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_solicitud`
--

INSERT INTO `tipo_solicitud` (`id_tiposolicitud`, `descripcion`) VALUES
(1, 'PETICION'),
(2, 'QUEJA'),
(3, 'RECLAMO'),
(4, 'VIVENCIA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL COMMENT 'auto incrementing user_id of each user, unique index',
  `firstname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `user_password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
  `date_added` datetime NOT NULL,
  `perfil` enum('Administrador','Gerente','Empleado') COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `identificacion` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `user_name`, `user_password_hash`, `user_email`, `date_added`, `perfil`, `direccion`, `telefono`, `identificacion`) VALUES
(1, 'Administrador', 'Sistema', 'admin', '$2y$10$MPVHzZ2ZPOWmtUUGCq3RXu31OTB.jo7M9LZ7PmPQYmgETSNn19ejO', 'prueba@gmail.com', '2016-05-21 15:06:00', 'Administrador', NULL, NULL, NULL),
(92, 'juan', 'andres', 'juan', '$2y$10$7c/oSWg52JhHyfct59thwOgG5ftOtwQxZ13khKFv/RRHMkuqLsqhe', 'ddddej@gmail.com', '2023-01-06 15:56:29', 'Empleado', NULL, NULL, NULL),
(102, 'Andres', 'Damian', 'admin1235', '$2y$10$VYuVFTvS6yrkK7.rNTz.1.tuxY4qvE4pD82W3ce5e/AfGI8Tvq2ou', 'ddddejllll@gmail.com', '2023-01-19 16:33:10', 'Empleado', 'CARRERA 12 N 23 117 Jorge Eliecer Gaitán', '3168270783', '23456'),
(103, 'Andres', 'Damian', 'admin1111', '$2y$10$VSStDiqdbdVPIgBntpR4deKllbtBWhOwachpG.sbgoqBpF5vWUDFu', 'juanandres12101112018@gmail.com', '2023-01-19 16:33:50', 'Empleado', 'CARRERA 12 N 23 117 Jorge Eliecer Gaitán', '3168270783', '123'),
(104, 'Andres', 'Damian', 'adminiii', '$2y$10$6fWn4GWMgN3pYawEHxsVaeJ/AzxqeG5rvgnv4aM3R4zI9yIHztI8O', 'osiiiiio@gmail.com', '2023-01-19 16:34:37', 'Empleado', 'CARRERA 12 N 23 117 Jorge Eliecer Gaitán', '3168270783', '123'),
(105, 'Andres', 'Damian', 'adminyyyy', '$2y$10$RsET990KpCoKUmOi4kI.Yu8qK8MUZDYUXJrG6qOSZ7/j0R9QqB7wi', 'juanandres12yyyyy1020555@gmail.com', '2023-01-19 16:36:44', 'Empleado', 'CARRERA 12 N 23 117 Jorge Eliecer Gaitán', '3168270783', '123'),
(106, 'Andres', 'Damian', 'admin7777', '$2y$10$aHIm.xFSRgd4mtCRcJWadedHqpDQsMhDmw6/VY2n9f2VBQ80SeC3y', 'juanandres1244441020@gmail.com', '2023-01-19 16:37:33', 'Empleado', 'CARRERA 12 N 23 117 Jorge Eliecer Gaitán', '3168270783', '00000'),
(107, 'Andres', 'Damian', 'admin55555', '$2y$10$DbMiFyp6WbklrbGBV4pOgOwXaoVxV1mKbtLPHaIw6xl3GyIBGp9J2', 'juanandres121555555020@gmail.com', '2023-01-19 16:38:16', 'Empleado', 'CARRERA 12 N 23 117 Jorge Eliecer Gaitán', '3168270783', '12345');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD PRIMARY KEY (`id_calificacion`);

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`id_contacto`);

--
-- Indices de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  ADD PRIMARY KEY (`id_encuesta`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `notificacion`
--
ALTER TABLE `notificacion`
  ADD PRIMARY KEY (`id_notificacion`),
  ADD KEY `idx_notificacion_fk_idx` (`id_solicitud`);

--
-- Indices de la tabla `opcion`
--
ALTER TABLE `opcion`
  ADD PRIMARY KEY (`id_opcion`),
  ADD KEY `id_calificacion` (`id_calificacion`),
  ADD KEY `opcion_ibfk_2` (`id_pregunta`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id_preguntas`),
  ADD KEY `id_encuesta` (`id_encuesta`);

--
-- Indices de la tabla `preguntas_encuesta`
--
ALTER TABLE `preguntas_encuesta`
  ADD PRIMARY KEY (`id_preguntas_encuesta`),
  ADD KEY `fkidx_encuesta_idx` (`id_encuesta`),
  ADD KEY `fkidx_preguntas_idx` (`id_preguntas`);

--
-- Indices de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD PRIMARY KEY (`id_respueta`),
  ADD KEY `id_opcion` (`id_opcion`),
  ADD KEY `id_users` (`id_users`);

--
-- Indices de la tabla `respuestalibre`
--
ALTER TABLE `respuestalibre`
  ADD PRIMARY KEY (`id_respuesta_libre`),
  ADD KEY `id_users` (`id_users`);

--
-- Indices de la tabla `seguimiento_solicitud`
--
ALTER TABLE `seguimiento_solicitud`
  ADD PRIMARY KEY (`id_seguimiento`),
  ADD KEY `idx_solicitud_fk_idx` (`id_solicitud`),
  ADD KEY `idx_estado_fk_idx` (`id_estado`);

--
-- Indices de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD PRIMARY KEY (`id_solicitud`),
  ADD KEY `id_user_idx_idx` (`user_id`),
  ADD KEY `id_tiposolicitud_idx_idx` (`id_tiposolicitud`);

--
-- Indices de la tabla `tbl_documentos`
--
ALTER TABLE `tbl_documentos`
  ADD PRIMARY KEY (`id_documento`),
  ADD KEY `idx_user_rot_idx` (`id_usuario`),
  ADD KEY `idx_solicitud_rot_idx` (`id_solicitud`);

--
-- Indices de la tabla `tipo_solicitud`
--
ALTER TABLE `tipo_solicitud`
  ADD PRIMARY KEY (`id_tiposolicitud`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  MODIFY `id_calificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `id_contacto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  MODIFY `id_encuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `notificacion`
--
ALTER TABLE `notificacion`
  MODIFY `id_notificacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `opcion`
--
ALTER TABLE `opcion`
  MODIFY `id_opcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `id_preguntas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `preguntas_encuesta`
--
ALTER TABLE `preguntas_encuesta`
  MODIFY `id_preguntas_encuesta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  MODIFY `id_respueta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `respuestalibre`
--
ALTER TABLE `respuestalibre`
  MODIFY `id_respuesta_libre` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `seguimiento_solicitud`
--
ALTER TABLE `seguimiento_solicitud`
  MODIFY `id_seguimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  MODIFY `id_solicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `tbl_documentos`
--
ALTER TABLE `tbl_documentos`
  MODIFY `id_documento` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_solicitud`
--
ALTER TABLE `tipo_solicitud`
  MODIFY `id_tiposolicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index', AUTO_INCREMENT=108;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `notificacion`
--
ALTER TABLE `notificacion`
  ADD CONSTRAINT `idx_notificacion_fk` FOREIGN KEY (`id_solicitud`) REFERENCES `solicitud` (`id_solicitud`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `opcion`
--
ALTER TABLE `opcion`
  ADD CONSTRAINT `opcion_ibfk_1` FOREIGN KEY (`id_calificacion`) REFERENCES `calificacion` (`id_calificacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `opcion_ibfk_2` FOREIGN KEY (`id_pregunta`) REFERENCES `preguntas` (`id_preguntas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD CONSTRAINT `preguntas_ibfk_1` FOREIGN KEY (`id_encuesta`) REFERENCES `encuesta` (`id_encuesta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `preguntas_encuesta`
--
ALTER TABLE `preguntas_encuesta`
  ADD CONSTRAINT `fkidx_encuesta` FOREIGN KEY (`id_encuesta`) REFERENCES `encuesta` (`id_encuesta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkidx_preguntas` FOREIGN KEY (`id_preguntas`) REFERENCES `preguntas` (`id_preguntas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD CONSTRAINT `respuesta_ibfk_1` FOREIGN KEY (`id_opcion`) REFERENCES `opcion` (`id_opcion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `respuesta_ibfk_2` FOREIGN KEY (`id_users`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `respuestalibre`
--
ALTER TABLE `respuestalibre`
  ADD CONSTRAINT `respuestalibre_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `seguimiento_solicitud`
--
ALTER TABLE `seguimiento_solicitud`
  ADD CONSTRAINT `idx_estado_fk` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idx_solicitud_fk` FOREIGN KEY (`id_solicitud`) REFERENCES `solicitud` (`id_solicitud`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD CONSTRAINT `id_tiposolicitud_idx` FOREIGN KEY (`id_tiposolicitud`) REFERENCES `tipo_solicitud` (`id_tiposolicitud`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_user_idx` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_documentos`
--
ALTER TABLE `tbl_documentos`
  ADD CONSTRAINT `idx_solicitud_rot` FOREIGN KEY (`id_solicitud`) REFERENCES `solicitud` (`id_solicitud`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idx_user_rot` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

ALTER TABLE `users` CHANGE `perfil` `perfil` ENUM('Administrador','Gerente','Empleado','Usuario') CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
