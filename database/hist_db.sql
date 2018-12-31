-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-12-2018 a las 06:02:09
-- Versión del servidor: 5.5.36
-- Versión de PHP: 5.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `hist_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_u_administrativas`
--

DROP TABLE IF EXISTS `cat_u_administrativas`;
CREATE TABLE IF NOT EXISTS `cat_u_administrativas` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `VC_NOMBRE` text NOT NULL,
  `DIRECCION` text,
  `TELEFONO` varchar(255) DEFAULT NULL,
  `ES_INSTITUCION` int(11) DEFAULT NULL,
  `USU_CREA` varchar(40) DEFAULT NULL,
  `FCH_CREA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ID_UA_AGENDA_DIGITAL` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos_grupos`
--

DROP TABLE IF EXISTS `contactos_grupos`;
CREATE TABLE IF NOT EXISTS `contactos_grupos` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CONTACTO_ID` int(11) DEFAULT NULL,
  `GRUPO_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `contactos_grupos`
--

INSERT INTO `contactos_grupos` (`ID`, `CONTACTO_ID`, `GRUPO_ID`) VALUES
(2, 1, 1),
(3, 1, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto_u_administrativa`
--

DROP TABLE IF EXISTS `contacto_u_administrativa`;
CREATE TABLE IF NOT EXISTS `contacto_u_administrativa` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `VC_NOMBRE` varchar(255) NOT NULL,
  `VC_APELLIDO_PAT` varchar(255) NOT NULL,
  `VC_APELLIDO_MAT` varchar(255) DEFAULT NULL,
  `ID_U_ADMINISTRATIVA` int(11) NOT NULL,
  `VC_CARGO` varchar(255) DEFAULT NULL,
  `VC_TELEFONO` varchar(255) DEFAULT NULL,
  `VC_EXTENSION` varchar(100) DEFAULT NULL,
  `VC_CORREO` varchar(255) NOT NULL,
  `VC_CORREO_EXT` varchar(255) DEFAULT NULL,
  `VC_PSWD` varchar(255) NOT NULL,
  `VC_ESTATUS` varchar(1) DEFAULT NULL,
  `FCH_ALTA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `FCH_ACTIVACION` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `FCH_BAJA` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `USU_BAJA` varchar(40) DEFAULT NULL,
  `ID_PERFIL` int(11) NOT NULL,
  `ACTIVATION_CODE` varchar(40) DEFAULT NULL,
  `SALT` varchar(255) DEFAULT NULL,
  `FORGOTTEN_PASSWORD_CODE` varchar(40) DEFAULT NULL,
  `FORGOTTEN_PASSWORD_TIME` int(10) unsigned DEFAULT NULL,
  `REMEMBER_CODE` varchar(40) DEFAULT NULL,
  `LAST_LOGIN` int(10) unsigned DEFAULT NULL,
  `IP_ADDRESS` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `contacto_u_administrativa`
--

INSERT INTO `contacto_u_administrativa` (`ID`, `VC_NOMBRE`, `VC_APELLIDO_PAT`, `VC_APELLIDO_MAT`, `ID_U_ADMINISTRATIVA`, `VC_CARGO`, `VC_TELEFONO`, `VC_EXTENSION`, `VC_CORREO`, `VC_CORREO_EXT`, `VC_PSWD`, `VC_ESTATUS`, `FCH_ALTA`, `FCH_ACTIVACION`, `FCH_BAJA`, `USU_BAJA`, `ID_PERFIL`, `ACTIVATION_CODE`, `SALT`, `FORGOTTEN_PASSWORD_CODE`, `FORGOTTEN_PASSWORD_TIME`, `REMEMBER_CODE`, `LAST_LOGIN`, `IP_ADDRESS`) VALUES
(1, 'Administrador', 'Solicitud', 'Desarrollo', 0, 'Administrador', '41550200', '9333', 'admin@ipstori.com.mx', '', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '1', '2018-12-31 04:53:45', '2017-06-23 21:19:07', '0000-00-00 00:00:00', NULL, 1, NULL, NULL, NULL, NULL, 'SPCBHXUP302ylssxnEdrH.', 1546232025, NULL),
(10, 'Alberto ', 'Olivares', '', 21, '', '41550200', '9333', 'aolivares@cultura.gob.mx', '', '$2y$08$dq91fgz0oM3ZoHf7fg6XweMJ26k5OqZC5tA2jyMlVzU76Ieu.vVoS', '1', '2018-10-29 23:55:57', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 0, NULL, NULL, NULL, NULL, 'ewUntJ0MBKe.lu7xD/z3nO', 1540835757, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

DROP TABLE IF EXISTS `grupos`;
CREATE TABLE IF NOT EXISTS `grupos` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(255) NOT NULL,
  `DESCRIPCION` text,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`ID`, `NOMBRE`, `DESCRIPCION`) VALUES
(1, 'admin', 'Administrador'),
(2, 'Registrado', 'Estatus inicial'),
(3, 'Capturista', 'Capturista'),
(4, 'Sub_admin', 'El subadmin de la plataforma'),
(5, 'historias', 'Acceso a edición de historías');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips_avatar`
--

DROP TABLE IF EXISTS `ips_avatar`;
CREATE TABLE IF NOT EXISTS `ips_avatar` (
  `id_avatar` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_avatar` varchar(255) NOT NULL,
  `imagen_avatar` text NOT NULL,
  `fecha_alta` timestamp NULL DEFAULT NULL,
  `usuario_alta` varchar(45) DEFAULT NULL,
  `fecha_modifica` timestamp NULL DEFAULT NULL,
  `usuario_modifica` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_avatar`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips_bancos`
--

DROP TABLE IF EXISTS `ips_bancos`;
CREATE TABLE IF NOT EXISTS `ips_bancos` (
  `id_banco` int(11) NOT NULL AUTO_INCREMENT,
  `banco` varchar(255) NOT NULL,
  PRIMARY KEY (`id_banco`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips_calificaciones`
--

DROP TABLE IF EXISTS `ips_calificaciones`;
CREATE TABLE IF NOT EXISTS `ips_calificaciones` (
  `id_calif` int(11) NOT NULL AUTO_INCREMENT,
  `calificacion` int(11) NOT NULL,
  `id_hist` int(11) NOT NULL,
  `comentario` text,
  `fecha_registro` timestamp NULL DEFAULT NULL,
  `id_register` int(11) DEFAULT NULL,
  `es_lector` int(11) DEFAULT NULL,
  `es_autor` int(11) DEFAULT NULL,
  `es_mediador` int(11) DEFAULT NULL,
  `mostrar_comentario` int(11) NOT NULL,
  `fecha_autorizacion` timestamp NULL DEFAULT NULL,
  `usuario_autorizacion` varchar(45) DEFAULT NULL,
  `razones_comentario` text,
  `enviar_correo_autor` int(11) DEFAULT NULL,
  `tipo_comentario` char(1) DEFAULT NULL,
  PRIMARY KEY (`id_calif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips_categorias`
--

DROP TABLE IF EXISTS `ips_categorias`;
CREATE TABLE IF NOT EXISTS `ips_categorias` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(510) NOT NULL,
  `descripcion` text,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `ips_categorias`
--

INSERT INTO `ips_categorias` (`id_categoria`, `categoria`, `descripcion`) VALUES
(1, 'Histórico', NULL),
(2, 'Romance', NULL),
(3, 'Aventura', NULL),
(4, 'Ficción', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips_categorias_x_series`
--

DROP TABLE IF EXISTS `ips_categorias_x_series`;
CREATE TABLE IF NOT EXISTS `ips_categorias_x_series` (
  `ips_categorias_id_categoria` int(11) NOT NULL,
  `ips_series_id_serie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ips_categorias_x_series`
--

INSERT INTO `ips_categorias_x_series` (`ips_categorias_id_categoria`, `ips_series_id_serie`) VALUES
(2, 1),
(4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips_ciudades`
--

DROP TABLE IF EXISTS `ips_ciudades`;
CREATE TABLE IF NOT EXISTS `ips_ciudades` (
  `id_ciudad` int(11) NOT NULL,
  `ciudad` varchar(510) NOT NULL,
  `id_estado` int(11) NOT NULL,
  PRIMARY KEY (`id_ciudad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips_datos_bancarios`
--

DROP TABLE IF EXISTS `ips_datos_bancarios`;
CREATE TABLE IF NOT EXISTS `ips_datos_bancarios` (
  `id_dato_bancario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_titular_banco` varchar(255) DEFAULT NULL,
  `cuenta_banco` int(11) DEFAULT NULL,
  `clabe_banco` int(11) DEFAULT NULL,
  `numero_tarjeta_banco` int(11) DEFAULT NULL,
  `id_register` int(11) NOT NULL,
  `id_banco` int(11) NOT NULL,
  `sucursal_banco` varchar(255) DEFAULT NULL,
  `numero_cliente_banco` int(11) DEFAULT NULL,
  `fecha_alta` timestamp NULL DEFAULT NULL,
  `usuario_alta` varchar(45) DEFAULT NULL,
  `fecha_modifica` timestamp NULL DEFAULT NULL,
  `usuario_modifica` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_dato_bancario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips_duraciones_suscripciones`
--

DROP TABLE IF EXISTS `ips_duraciones_suscripciones`;
CREATE TABLE IF NOT EXISTS `ips_duraciones_suscripciones` (
  `id_duracion_suscr` int(11) NOT NULL AUTO_INCREMENT,
  `duracion_suscr` varchar(255) NOT NULL,
  PRIMARY KEY (`id_duracion_suscr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips_estados`
--

DROP TABLE IF EXISTS `ips_estados`;
CREATE TABLE IF NOT EXISTS `ips_estados` (
  `id_estado` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(150) NOT NULL,
  `id_pais` int(11) NOT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips_estatus_hist`
--

DROP TABLE IF EXISTS `ips_estatus_hist`;
CREATE TABLE IF NOT EXISTS `ips_estatus_hist` (
  `id_estatus_hist` int(11) NOT NULL AUTO_INCREMENT,
  `estatus_hist` varchar(255) NOT NULL,
  PRIMARY KEY (`id_estatus_hist`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips_estatus_suscripciones`
--

DROP TABLE IF EXISTS `ips_estatus_suscripciones`;
CREATE TABLE IF NOT EXISTS `ips_estatus_suscripciones` (
  `id_estatus_susc` int(11) NOT NULL AUTO_INCREMENT,
  `estatus_suscripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`id_estatus_susc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips_faq`
--

DROP TABLE IF EXISTS `ips_faq`;
CREATE TABLE IF NOT EXISTS `ips_faq` (
  `id_faq` int(11) NOT NULL AUTO_INCREMENT,
  `titulo_faq` varchar(510) NOT NULL,
  `descripcion_faq` text,
  `fecha_alta` timestamp NULL DEFAULT NULL,
  `usuario_alta` varchar(45) DEFAULT NULL,
  `fecha_modifica` timestamp NULL DEFAULT NULL,
  `usuario_modifica` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_faq`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips_fiscal`
--

DROP TABLE IF EXISTS `ips_fiscal`;
CREATE TABLE IF NOT EXISTS `ips_fiscal` (
  `id_fiscal` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipo_persona` char(1) NOT NULL,
  `rfc_fiscal` varchar(13) NOT NULL,
  `razon_social` varchar(510) NOT NULL,
  `domiclio_fiscal` text,
  `cif_archivo` text,
  `id_register` int(11) NOT NULL,
  `fecha_alta` timestamp NULL DEFAULT NULL,
  `usuario_alta` varchar(45) DEFAULT NULL,
  `fecha_modifica` timestamp NULL DEFAULT NULL,
  `usuario_modifica` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_fiscal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips_forma_pago`
--

DROP TABLE IF EXISTS `ips_forma_pago`;
CREATE TABLE IF NOT EXISTS `ips_forma_pago` (
  `id_forma_pago` int(11) NOT NULL AUTO_INCREMENT,
  `forma_pago` varchar(45) NOT NULL,
  PRIMARY KEY (`id_forma_pago`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips_historias`
--

DROP TABLE IF EXISTS `ips_historias`;
CREATE TABLE IF NOT EXISTS `ips_historias` (
  `id_hist` int(11) NOT NULL AUTO_INCREMENT,
  `titulo_hist` varchar(510) NOT NULL,
  `duracion_hist` varchar(255) DEFAULT NULL,
  `copy_hist` varchar(255) DEFAULT NULL,
  `historia` text,
  `portada_bg` text,
  `portada_sm` text,
  `teaser_audio` text,
  `archivo_audio` text,
  `duracion_audio` varchar(255) DEFAULT NULL,
  `id_estatus_hist` int(11) NOT NULL,
  `id_register` int(11) NOT NULL,
  `id_tiempo` int(11) DEFAULT NULL,
  `id_serie` int(11) DEFAULT NULL,
  `hashtag_hist` varchar(150) DEFAULT NULL,
  `fecha_inicio_hist` datetime DEFAULT NULL,
  `fecha_fin_hist` datetime DEFAULT NULL,
  `fecha_captura_hist` timestamp NULL DEFAULT NULL,
  `fecha_publicacion_hist` timestamp NULL DEFAULT NULL,
  `usuario_publica_hist` varchar(45) DEFAULT NULL,
  `id_modifica_register` int(11) NOT NULL,
  `fch_modifica_register` int(11) NOT NULL,
  `id_elimina_register` int(11) NOT NULL,
  `fch_elimina_register` int(11) NOT NULL,
  `fecha_terminacion_contrato_hist` timestamp NULL DEFAULT NULL,
  `usuario_terminacion_hist` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_hist`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `ips_historias`
--

INSERT INTO `ips_historias` (`id_hist`, `titulo_hist`, `duracion_hist`, `copy_hist`, `historia`, `portada_bg`, `portada_sm`, `teaser_audio`, `archivo_audio`, `duracion_audio`, `id_estatus_hist`, `id_register`, `id_tiempo`, `id_serie`, `hashtag_hist`, `fecha_inicio_hist`, `fecha_fin_hist`, `fecha_captura_hist`, `fecha_publicacion_hist`, `usuario_publica_hist`, `id_modifica_register`, `fch_modifica_register`, `id_elimina_register`, `fch_elimina_register`, `fecha_terminacion_contrato_hist`, `usuario_terminacion_hist`) VALUES
(1, 'El título es ...', '--', 'La historia es sobre', '<p>comienza en..ttuuuuuu</p>', NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, 0, '', '2018-12-31 00:00:00', '2018-12-31 00:00:00', '2018-12-27 22:45:28', NULL, NULL, 1, 2018, 0, 0, NULL, NULL),
(2, 'Segunda historia', '2', 'la segunda historia es de...', '<p>lahistoria comienza en..</p>', 'perros4 (6).jpg', 'perros3 (4).jpg', NULL, NULL, NULL, 0, 1, NULL, 0, 'gato', '2018-12-30 00:00:00', '2018-12-31 00:00:00', '2018-12-27 22:48:01', NULL, NULL, 1, 2018, 0, 0, NULL, NULL),
(3, 'historia tres', '2', 'la historia es de..', '<p>la historia es de..buuuu espantos..</p>', 'perros 2 (1).jpg', 'bacheo.jpg', 'AHORROS CHONCHOSCHEDRAUISPOT RADIO (3).mp3', 'Pedigree me toca sobre Mexico (5).mp3', NULL, 1, 1, NULL, 1, 'tercer', '2018-12-31 00:00:00', '2018-12-31 00:00:00', '2018-12-28 05:06:43', '2018-12-29 04:01:30', '1', 1, 2018, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips_historias_logs`
--

DROP TABLE IF EXISTS `ips_historias_logs`;
CREATE TABLE IF NOT EXISTS `ips_historias_logs` (
  `id_hist_log` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_hist` int(11) NOT NULL,
  `titulo_hist` varchar(510) NOT NULL,
  `duracion_hist` varchar(255) DEFAULT NULL,
  `copy_hist` varchar(255) DEFAULT NULL,
  `historia` text,
  `portada_bg` text,
  `portada_sm` text,
  `teaser_audio` text,
  `archivo_audio` text,
  `duracion_audio` varchar(255) DEFAULT NULL,
  `id_estatus_hist` int(11) NOT NULL,
  `id_register` int(11) NOT NULL,
  `id_tiempo` int(11) DEFAULT NULL,
  `id_serie` int(11) DEFAULT NULL,
  `hashtag_hist` varchar(150) DEFAULT NULL,
  `fecha_inicio_hist` datetime DEFAULT NULL,
  `fecha_fin_hist` datetime DEFAULT NULL,
  `fecha_captura_hist` timestamp NULL DEFAULT NULL,
  `fecha_publicacion_hist` timestamp NULL DEFAULT NULL,
  `usuario_publica_hist` varchar(45) DEFAULT NULL,
  `fecha_terminacion_contrato_hist` timestamp NULL DEFAULT NULL,
  `usuario_terminacion_hist` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_hist_log`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips_historias_x_categorias`
--

DROP TABLE IF EXISTS `ips_historias_x_categorias`;
CREATE TABLE IF NOT EXISTS `ips_historias_x_categorias` (
  `id_categoria` int(11) NOT NULL,
  `id_hist` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ips_historias_x_categorias`
--

INSERT INTO `ips_historias_x_categorias` (`id_categoria`, `id_hist`) VALUES
(2, 2),
(3, 2),
(4, 2),
(1, 3),
(4, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips_historias_x_readlist`
--

DROP TABLE IF EXISTS `ips_historias_x_readlist`;
CREATE TABLE IF NOT EXISTS `ips_historias_x_readlist` (
  `id_hist` int(11) NOT NULL,
  `id_readlist` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ips_historias_x_readlist`
--

INSERT INTO `ips_historias_x_readlist` (`id_hist`, `id_readlist`) VALUES
(3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips_legales`
--

DROP TABLE IF EXISTS `ips_legales`;
CREATE TABLE IF NOT EXISTS `ips_legales` (
  `id_legal` int(11) NOT NULL AUTO_INCREMENT,
  `titulo_legal` varchar(510) NOT NULL,
  `descripcion_legal` text,
  `fecha_alta` timestamp NULL DEFAULT NULL,
  `usuario_alta` varchar(45) DEFAULT NULL,
  `fecha_modifica` timestamp NULL DEFAULT NULL,
  `usuario_modifica` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_legal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips_mis_historias`
--

DROP TABLE IF EXISTS `ips_mis_historias`;
CREATE TABLE IF NOT EXISTS `ips_mis_historias` (
  `id_mi_hist` int(11) NOT NULL AUTO_INCREMENT,
  `id_register` int(11) NOT NULL,
  `id_hist` int(11) NOT NULL,
  `estatus_hist` char(1) NOT NULL,
  `fecha_registro` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_mi_hist`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips_notificaciones`
--

DROP TABLE IF EXISTS `ips_notificaciones`;
CREATE TABLE IF NOT EXISTS `ips_notificaciones` (
  `id_notif` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_hora_notif` datetime NOT NULL,
  `titulo_notif` varchar(510) NOT NULL,
  `descripcion_notif` text,
  `estatus_notif` varchar(45) DEFAULT NULL,
  `imagen_notif` text,
  `id_tipo_notif` int(11) NOT NULL,
  `id_register` int(11) DEFAULT NULL,
  `id_suscripcion` int(11) DEFAULT NULL,
  `fecha_alta` timestamp NULL DEFAULT NULL,
  `usuario_alta` varchar(45) DEFAULT NULL,
  `fecha_modifica` timestamp NULL DEFAULT NULL,
  `usuario_modifica` varchar(45) DEFAULT NULL,
  `total_envios` int(11) DEFAULT NULL,
  `fecha_total` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_notif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips_notificaciones_tipos`
--

DROP TABLE IF EXISTS `ips_notificaciones_tipos`;
CREATE TABLE IF NOT EXISTS `ips_notificaciones_tipos` (
  `id_tipo_notif` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_notif` varchar(150) NOT NULL,
  PRIMARY KEY (`id_tipo_notif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips_notificaciones_x_categorias`
--

DROP TABLE IF EXISTS `ips_notificaciones_x_categorias`;
CREATE TABLE IF NOT EXISTS `ips_notificaciones_x_categorias` (
  `id_notif` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips_paises`
--

DROP TABLE IF EXISTS `ips_paises`;
CREATE TABLE IF NOT EXISTS `ips_paises` (
  `id_pais` int(11) NOT NULL AUTO_INCREMENT,
  `pais` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_pais`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips_profiles_users`
--

DROP TABLE IF EXISTS `ips_profiles_users`;
CREATE TABLE IF NOT EXISTS `ips_profiles_users` (
  `id_profile_user` int(11) NOT NULL AUTO_INCREMENT,
  `profile_user` varchar(150) NOT NULL,
  PRIMARY KEY (`id_profile_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips_publicidad`
--

DROP TABLE IF EXISTS `ips_publicidad`;
CREATE TABLE IF NOT EXISTS `ips_publicidad` (
  `id_publicidad` int(11) NOT NULL AUTO_INCREMENT,
  `titulo_publicidad` varchar(510) NOT NULL,
  `banner_publicidad` text,
  `estatus_publicidad` int(11) NOT NULL,
  `fecha_inicio_publicidad` datetime NOT NULL,
  `fecha_fin_publicidad` datetime NOT NULL,
  `orden` int(11) DEFAULT NULL,
  `id_seccion` int(11) NOT NULL,
  PRIMARY KEY (`id_publicidad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips_readlist`
--

DROP TABLE IF EXISTS `ips_readlist`;
CREATE TABLE IF NOT EXISTS `ips_readlist` (
  `id_readlist` int(11) NOT NULL AUTO_INCREMENT,
  `titulo_readlist` varchar(510) NOT NULL,
  `portada_readlist_bg` text,
  `portada_readlist_sm` text,
  `es_permanente_readlist` int(1) NOT NULL,
  `estatus_readlist` int(1) NOT NULL,
  `fecha_inicio_readlist` datetime DEFAULT NULL,
  `fecha_fin_readlist` datetime DEFAULT NULL,
  `copy_readlist` varchar(510) DEFAULT NULL,
  `hashtag_readlist` varchar(150) DEFAULT NULL,
  `fecha_alta` timestamp NULL DEFAULT NULL,
  `usuario_alta` varchar(45) DEFAULT NULL,
  `fecha_modifica` timestamp NULL DEFAULT NULL,
  `usuario_modifica` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_readlist`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `ips_readlist`
--

INSERT INTO `ips_readlist` (`id_readlist`, `titulo_readlist`, `portada_readlist_bg`, `portada_readlist_sm`, `es_permanente_readlist`, `estatus_readlist`, `fecha_inicio_readlist`, `fecha_fin_readlist`, `copy_readlist`, `hashtag_readlist`, `fecha_alta`, `usuario_alta`, `fecha_modifica`, `usuario_modifica`) VALUES
(1, 'readlist uno', 'perros.jpg', 'perros 2.jpg', 0, 1, '2018-12-29 00:00:00', '2018-12-31 00:00:00', 'la readlist uno', 'read', '2018-12-30 10:48:32', '1', '2018-12-31 11:39:59', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips_recomendaciones`
--

DROP TABLE IF EXISTS `ips_recomendaciones`;
CREATE TABLE IF NOT EXISTS `ips_recomendaciones` (
  `id_recom` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_registro` timestamp NULL DEFAULT NULL,
  `fecha_inicio_recom` datetime NOT NULL,
  `fecha_fin_recom` datetime NOT NULL,
  `estatus_recom` int(1) NOT NULL,
  `orden` int(11) DEFAULT NULL,
  `id_hist` int(11) NOT NULL,
  PRIMARY KEY (`id_recom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips_recomendaciones_x_categorias`
--

DROP TABLE IF EXISTS `ips_recomendaciones_x_categorias`;
CREATE TABLE IF NOT EXISTS `ips_recomendaciones_x_categorias` (
  `id_categoria` int(11) NOT NULL,
  `id_recom` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips_register`
--

DROP TABLE IF EXISTS `ips_register`;
CREATE TABLE IF NOT EXISTS `ips_register` (
  `id_register` int(11) NOT NULL AUTO_INCREMENT,
  `email_register` varchar(510) NOT NULL,
  `password_register` varchar(45) NOT NULL,
  `ap_paterno_register` varchar(150) NOT NULL,
  `ap_materno_register` varchar(150) DEFAULT NULL,
  `nombre_register` varchar(150) NOT NULL,
  `fch_nacimiento_register` date DEFAULT NULL,
  `genero_register` char(1) DEFAULT NULL,
  `pseudonimo_register` varchar(150) DEFAULT NULL,
  `con_avatar_register` int(11) NOT NULL,
  `id_avatar` int(11) DEFAULT NULL,
  `foto_register` text,
  `estatus_register` int(1) NOT NULL,
  `es_lector_register` int(1) DEFAULT NULL,
  `es_autor_register` int(1) DEFAULT NULL,
  `id_pais` int(11) DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL,
  `id_ciudad` int(11) DEFAULT NULL,
  `minibio_register` varchar(255) DEFAULT NULL,
  `semblanza_register` text,
  `numero_contrato_register` varchar(255) DEFAULT NULL,
  `comentarios_register` text,
  `fecha_alta` timestamp NULL DEFAULT NULL,
  `usuario_alta` varchar(45) DEFAULT NULL,
  `fecha_modifica` timestamp NULL DEFAULT NULL,
  `usuario_modifica` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_register`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips_register_logs`
--

DROP TABLE IF EXISTS `ips_register_logs`;
CREATE TABLE IF NOT EXISTS `ips_register_logs` (
  `id_register_log` int(11) NOT NULL AUTO_INCREMENT,
  `id_register` int(11) NOT NULL,
  `fecha_hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_register_log`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips_secciones`
--

DROP TABLE IF EXISTS `ips_secciones`;
CREATE TABLE IF NOT EXISTS `ips_secciones` (
  `id_seccion` int(11) NOT NULL AUTO_INCREMENT,
  `seccion` varchar(255) NOT NULL,
  PRIMARY KEY (`id_seccion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips_secciones_x_recomendaciones`
--

DROP TABLE IF EXISTS `ips_secciones_x_recomendaciones`;
CREATE TABLE IF NOT EXISTS `ips_secciones_x_recomendaciones` (
  `id_seccion` int(11) NOT NULL,
  `id_recom` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips_series`
--

DROP TABLE IF EXISTS `ips_series`;
CREATE TABLE IF NOT EXISTS `ips_series` (
  `id_serie` int(11) NOT NULL AUTO_INCREMENT,
  `titulo_serie` varchar(510) NOT NULL,
  `estatus_serie` int(11) NOT NULL,
  `fecha_alta` timestamp NULL DEFAULT NULL,
  `portada_serie_bg` text,
  `portada_serie_sm` text,
  `fecha_inicio_serie` datetime DEFAULT NULL,
  `fecha_fin_serie` datetime DEFAULT NULL,
  `copy_serie` varchar(255) DEFAULT NULL,
  `hashtag_serie` varchar(150) DEFAULT NULL,
  `usuario_alta` varchar(45) DEFAULT NULL,
  `fecha_modifica` timestamp NULL DEFAULT NULL,
  `usuario_modifica` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_serie`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `ips_series`
--

INSERT INTO `ips_series` (`id_serie`, `titulo_serie`, `estatus_serie`, `fecha_alta`, `portada_serie_bg`, `portada_serie_sm`, `fecha_inicio_serie`, `fecha_fin_serie`, `copy_serie`, `hashtag_serie`, `usuario_alta`, `fecha_modifica`, `usuario_modifica`) VALUES
(1, 'serie uno', 1, '2018-12-29 09:23:28', 'perros4.jpg', 'bcheo 2.jpg', '2018-12-31 00:00:00', '2018-12-31 00:00:00', 'la serie es de..', 'unaserie', '1', '2018-12-29 04:00:55', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips_suscripciones`
--

DROP TABLE IF EXISTS `ips_suscripciones`;
CREATE TABLE IF NOT EXISTS `ips_suscripciones` (
  `id_suscripcion` int(11) NOT NULL AUTO_INCREMENT,
  `titulo_suscripcion` varchar(510) NOT NULL,
  `descripcion_suscripcion` text,
  `tipo_suscripcion` char(1) DEFAULT NULL,
  `precio_suscripcion` float NOT NULL,
  `estatus_suscripcion` int(1) NOT NULL,
  `num_historias_suscripcion` int(11) DEFAULT NULL,
  `id_duracion_suscr` int(11) DEFAULT NULL,
  `orden_suscripcion` int(11) DEFAULT NULL,
  `fecha_alta` timestamp NULL DEFAULT NULL,
  `usuario_alta` varchar(45) DEFAULT NULL,
  `fecha_modifica` timestamp NULL DEFAULT NULL,
  `usuario_modifica` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_suscripcion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips_suscripciones_historias`
--

DROP TABLE IF EXISTS `ips_suscripciones_historias`;
CREATE TABLE IF NOT EXISTS `ips_suscripciones_historias` (
  `id_suschist` int(11) NOT NULL AUTO_INCREMENT,
  `id_suscreg` int(11) NOT NULL,
  `id_hist` int(11) NOT NULL,
  `id_register` int(11) NOT NULL,
  `regalia_pct` float DEFAULT NULL,
  `regalia_valor` float DEFAULT NULL,
  `fecha_registro` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_suschist`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips_suscripciones_register`
--

DROP TABLE IF EXISTS `ips_suscripciones_register`;
CREATE TABLE IF NOT EXISTS `ips_suscripciones_register` (
  `id_suscreg` int(11) NOT NULL AUTO_INCREMENT,
  `id_register` int(11) NOT NULL,
  `id_suscripcion` int(11) NOT NULL,
  `id_estatus_susc` int(11) NOT NULL,
  `fecha_inicio_suscreg` datetime NOT NULL,
  `fecha_fin_suscreg` datetime NOT NULL,
  `num_historias_suscreg` int(11) DEFAULT NULL,
  `fecha_suscripcion` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_suscreg`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips_suscripciones_transacciones`
--

DROP TABLE IF EXISTS `ips_suscripciones_transacciones`;
CREATE TABLE IF NOT EXISTS `ips_suscripciones_transacciones` (
  `id_trans` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_hora_trans` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `estatus_trans` char(1) NOT NULL,
  `num_trans` varchar(255) DEFAULT NULL,
  `monto_trans` float NOT NULL,
  `plataforma` char(1) NOT NULL,
  `id_suscreg` int(11) NOT NULL,
  `id_forma_pago` int(11) NOT NULL,
  PRIMARY KEY (`id_trans`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips_tiempo`
--

DROP TABLE IF EXISTS `ips_tiempo`;
CREATE TABLE IF NOT EXISTS `ips_tiempo` (
  `id_tiempo` int(11) NOT NULL AUTO_INCREMENT,
  `tiempo` varchar(45) NOT NULL,
  PRIMARY KEY (`id_tiempo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `ips_tiempo`
--

INSERT INTO `ips_tiempo` (`id_tiempo`, `tiempo`) VALUES
(1, '10 minutos'),
(2, '20 minutos'),
(3, '30 minutos'),
(4, '45 minutos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips_topics_register`
--

DROP TABLE IF EXISTS `ips_topics_register`;
CREATE TABLE IF NOT EXISTS `ips_topics_register` (
  `id_topic_register` int(11) NOT NULL AUTO_INCREMENT,
  `id_register` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  PRIMARY KEY (`id_topic_register`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips_users`
--

DROP TABLE IF EXISTS `ips_users`;
CREATE TABLE IF NOT EXISTS `ips_users` (
  `login_user` varchar(45) NOT NULL,
  `email_user` varchar(510) NOT NULL,
  `password_user` varchar(45) NOT NULL,
  `ap_paterno_user` varchar(150) NOT NULL,
  `ap_materno_user` varchar(150) DEFAULT NULL,
  `nombre_user` varchar(150) NOT NULL,
  `foto_user` text,
  `fch_nacimiento_user` date DEFAULT NULL,
  `estatus_user` int(1) NOT NULL,
  `id_profile_user` int(11) NOT NULL,
  `fecha_alta` timestamp NULL DEFAULT NULL,
  `usuario_alta` varchar(45) DEFAULT NULL,
  `fecha_modifica` timestamp NULL DEFAULT NULL,
  `usuario_modifica` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`login_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips_user_logs`
--

DROP TABLE IF EXISTS `ips_user_logs`;
CREATE TABLE IF NOT EXISTS `ips_user_logs` (
  `id_user_log` int(11) NOT NULL AUTO_INCREMENT,
  `login_user` varchar(45) NOT NULL,
  `fecha_hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user_log`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips_uso_cfdi`
--

DROP TABLE IF EXISTS `ips_uso_cfdi`;
CREATE TABLE IF NOT EXISTS `ips_uso_cfdi` (
  `id_cfdi` int(11) NOT NULL AUTO_INCREMENT,
  `clave_cfdi` varchar(45) NOT NULL,
  `cfdi` varchar(255) NOT NULL,
  PRIMARY KEY (`id_cfdi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sugerencias`
--

DROP TABLE IF EXISTS `sugerencias`;
CREATE TABLE IF NOT EXISTS `sugerencias` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TITULO` varchar(255) NOT NULL,
  `RESUMEN` text NOT NULL,
  `DESCRIPCION` text NOT NULL,
  `FUENTE` varchar(255) NOT NULL,
  `SLUG` varchar(255) DEFAULT NULL,
  `ESTATUS` char(1) DEFAULT NULL,
  `FECHA` datetime DEFAULT NULL,
  `URL` varchar(255) DEFAULT NULL,
  `IMAGEN` text,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
