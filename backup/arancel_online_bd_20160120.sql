-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-01-2016 a las 04:31:16
-- Versión del servidor: 5.6.26
-- Versión de PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `arancel_online`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arancel`
--

CREATE TABLE IF NOT EXISTS `arancel` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `max` int(10) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `arancel`
--

INSERT INTO `arancel` (`id`, `nombre`, `monto`, `max`) VALUES
(5, 'notas certificadas (papel de seguridad 300bsf)', '300.00', 2),
(6, 'notas certificadas (papel normal 150bsf)', '150.00', 0),
(7, 'acta de grado (papel de seguridad 450bsf)', '450.00', 0),
(8, 'acta de grado (papel normal 300bsf)', '300.00', 0),
(9, 'certificacion de programa (papel normal 150bsf)', '150.00', 0),
(10, 'convercion de notas (papel normal 300bsf)', '300.00', 0),
(11, 'convercion de notas (papel de seguridad 600bsf)', '600.00', 0),
(12, 'constancia de buena  conducta (papel normal 150bsf)', '150.00', 0),
(13, 'fondo negro (papel normal 300bsf)', '300.00', 0),
(14, 'fondo negro (papel seguridad 450bsf)', '450.00', 0),
(15, 'constancia de estudio (papel normal 300bsf)', '300.00', 0),
(16, 'constancia de estudio (papel seguridad 600bsf)', '600.00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bancos`
--

CREATE TABLE IF NOT EXISTS `bancos` (
  `id` int(11) NOT NULL,
  `banco` varchar(45) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `bancos`
--

INSERT INTO `bancos` (`id`, `banco`) VALUES
(1, 'BANCO BFC 3316');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas_entrega`
--

CREATE TABLE IF NOT EXISTS `citas_entrega` (
  `id` int(10) unsigned NOT NULL,
  `id_solicitud_arancel` int(10) unsigned NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `fecha_agenda` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas_solicitud`
--

CREATE TABLE IF NOT EXISTS `citas_solicitud` (
  `id` int(10) unsigned NOT NULL,
  `id_solicitud_arancel` int(10) unsigned NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `fecha_agenda` date NOT NULL,
  `is_cerrada` tinyint(3) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuraciones`
--

CREATE TABLE IF NOT EXISTS `configuraciones` (
  `id` int(10) unsigned NOT NULL,
  `vigencia_solicitud` int(10) unsigned DEFAULT NULL,
  `dias_elaboracion` int(10) unsigned DEFAULT NULL,
  `dias_firma` int(10) unsigned DEFAULT NULL,
  `dias_entrega` int(10) unsigned DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `configuraciones`
--

INSERT INTO `configuraciones` (`id`, `vigencia_solicitud`, `dias_elaboracion`, `dias_firma`, `dias_entrega`) VALUES
(1, 20, 5, 5, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `correlativos`
--

CREATE TABLE IF NOT EXISTS `correlativos` (
  `id` int(11) NOT NULL,
  `anho` int(11) NOT NULL,
  `nro_solicitud` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `correlativos`
--

INSERT INTO `correlativos` (`id`, `anho`, `nro_solicitud`) VALUES
(1, 2016, 73);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatus_solicitud`
--

CREATE TABLE IF NOT EXISTS `estatus_solicitud` (
  `id` int(10) unsigned NOT NULL,
  `estatus` varchar(100) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estatus_solicitud`
--

INSERT INTO `estatus_solicitud` (`id`, `estatus`) VALUES
(1, 'Solicitud Activa'),
(2, 'Solicitud Vencida'),
(3, 'Pagado'),
(4, 'Elaborado'),
(5, 'Firmado'),
(6, 'Entregado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote`
--

CREATE TABLE IF NOT EXISTS `lote` (
  `id` int(10) unsigned NOT NULL,
  `nro_lote` varchar(100) NOT NULL,
  `fecha` datetime NOT NULL,
  `id_estatus_solicitud` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote_solicitud_arancel_detalles`
--

CREATE TABLE IF NOT EXISTS `lote_solicitud_arancel_detalles` (
  `id` int(10) unsigned NOT NULL,
  `id_lote` int(10) unsigned NOT NULL,
  `id_solicitud_arancel_detalles` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE IF NOT EXISTS `pagos` (
  `id` int(11) NOT NULL,
  `id_solicitud_arancel` int(11) NOT NULL,
  `id_bancos` int(11) NOT NULL,
  `monto` decimal(18,2) NOT NULL,
  `nro_deposito` varchar(45) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id`, `id_solicitud_arancel`, `id_bancos`, `monto`, `nro_deposito`) VALUES
(1, 1, 1, '200.00', '5214589347569'),
(2, 2, 1, '200.00', '875'),
(3, 1, 1, '200.00', '54'),
(4, 16, 1, '2000.00', '54454'),
(5, 16, 1, '88.00', '77'),
(6, 53, 1, '250.00', '66'),
(7, 53, 1, '23.00', '32323'),
(8, 59, 1, '2500.00', '1234567890'),
(9, 26, 1, '25001.00', '12345678'),
(10, 26, 1, '444.00', '44444'),
(11, 26, 1, '5555.00', '896532'),
(12, 26, 1, '212.00', '2212'),
(13, 14, 1, '33.00', '3'),
(14, 14, 1, '22.00', '222'),
(15, 14, 1, '232.00', '2323'),
(16, 14, 1, '232.00', '2323'),
(17, 14, 1, '3.00', '33'),
(18, 14, 1, '44.00', '44'),
(19, 62, 1, '44.00', '44'),
(20, 62, 1, '33.00', '33'),
(21, 24, 1, '4444.00', '44'),
(22, 63, 1, '1200.00', '12345678'),
(23, 63, 1, '434.00', '344'),
(24, 63, 1, '434.00', '344'),
(25, 65, 1, '500.00', '4646456798'),
(26, 69, 1, '400.00', '54747655656'),
(27, 71, 1, '3000.00', '232323');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sis_grupos`
--

CREATE TABLE IF NOT EXISTS `sis_grupos` (
  `id` int(10) unsigned NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(200) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sis_grupos`
--

INSERT INTO `sis_grupos` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Super', 'Super Administradores del Sistema'),
(2, 'Administradores', 'Administradores del Sistema'),
(3, 'Solicitante', 'Solicitante');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sis_main`
--

CREATE TABLE IF NOT EXISTS `sis_main` (
  `id` int(10) unsigned NOT NULL,
  `main_titulo` varchar(100) NOT NULL,
  `main` varchar(100) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sis_main`
--

INSERT INTO `sis_main` (`id`, `main_titulo`, `main`) VALUES
(4, 'Solicitudes', 'solicitudes'),
(5, 'Configuraciones', 'configuraciones');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sis_modulos`
--

CREATE TABLE IF NOT EXISTS `sis_modulos` (
  `id` int(10) unsigned NOT NULL,
  `modulo` varchar(100) NOT NULL,
  `descripcion` varchar(200) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sis_modulos`
--

INSERT INTO `sis_modulos` (`id`, `modulo`, `descripcion`) VALUES
(1, 'sis_grupos', 'Grupos'),
(2, 'usuarios', 'Usuarios'),
(7, 'sis_modulos', 'Modulos del Sistema'),
(8, 'formularios', 'Formularios'),
(9, 'menu', 'Menu'),
(10, 'sis_tablas', 'Sis Tablas'),
(12, 'sis_main', 'Sis Main'),
(13, 'arancel', 'arancel'),
(14, 'bancos', 'bancos'),
(15, 'citas', 'citas'),
(16, 'configuraciones', 'configuraciones'),
(17, 'estatus_solicitud', 'estatus_solicitud'),
(18, 'pagos', 'pagos'),
(19, 'solicitud_arancel', 'solicitud_arancel'),
(20, 'solicitud_arancel_detalles', 'solicitud_arancel_detalles'),
(21, 'solicitud_arancel_estatus', 'solicitud_arancel_estatus'),
(22, 'tipo_solicitud', 'tipo_solicitud'),
(23, 'unidad_tributaria', 'unidad_tributaria'),
(24, 'vst_estudiantes_pyscde', 'vst_estudiantes_pyscde');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sis_permisos`
--

CREATE TABLE IF NOT EXISTS `sis_permisos` (
  `id` int(10) unsigned NOT NULL,
  `id_grupos` int(10) unsigned NOT NULL,
  `id_modulos` int(10) unsigned NOT NULL,
  `seleccionar` int(10) unsigned NOT NULL,
  `insertar` int(10) unsigned NOT NULL,
  `actualizar` int(10) unsigned NOT NULL,
  `eliminar` int(10) unsigned NOT NULL,
  `ejecutar` int(10) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sis_permisos`
--

INSERT INTO `sis_permisos` (`id`, `id_grupos`, `id_modulos`, `seleccionar`, `insertar`, `actualizar`, `eliminar`, `ejecutar`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1),
(2, 1, 2, 1, 1, 1, 1, 1),
(3, 1, 7, 1, 1, 1, 1, 1),
(4, 1, 8, 1, 1, 1, 1, 1),
(5, 1, 9, 1, 1, 1, 1, 1),
(6, 1, 10, 1, 1, 1, 1, 1),
(7, 1, 12, 1, 1, 1, 1, 1),
(8, 2, 1, 1, 1, 1, 1, 1),
(9, 2, 2, 1, 1, 1, 1, 1),
(10, 2, 7, 1, 1, 1, 1, 1),
(11, 2, 8, 1, 1, 1, 1, 1),
(12, 2, 9, 1, 1, 1, 1, 1),
(13, 2, 10, 1, 1, 1, 1, 1),
(14, 2, 12, 1, 1, 1, 1, 1),
(15, 1, 13, 1, 1, 1, 1, 1),
(16, 1, 14, 1, 1, 1, 1, 1),
(17, 1, 15, 1, 1, 1, 1, 1),
(18, 1, 16, 1, 1, 1, 1, 1),
(19, 1, 17, 1, 1, 1, 1, 1),
(20, 1, 18, 1, 1, 1, 1, 1),
(21, 1, 19, 1, 1, 1, 1, 1),
(22, 1, 20, 1, 1, 1, 1, 1),
(23, 1, 21, 1, 1, 1, 1, 1),
(24, 1, 22, 1, 1, 1, 1, 1),
(25, 1, 23, 1, 1, 1, 1, 1),
(26, 1, 24, 1, 1, 1, 1, 1),
(27, 2, 13, 1, 1, 1, 1, 1),
(28, 2, 14, 1, 1, 1, 1, 1),
(29, 2, 15, 1, 1, 1, 1, 1),
(30, 2, 16, 1, 1, 1, 1, 1),
(31, 2, 17, 1, 1, 1, 1, 1),
(32, 2, 18, 1, 1, 1, 1, 1),
(33, 2, 19, 1, 1, 1, 1, 1),
(34, 2, 20, 1, 1, 1, 1, 1),
(35, 2, 21, 1, 1, 1, 1, 1),
(36, 2, 22, 1, 1, 1, 1, 1),
(37, 2, 23, 1, 1, 1, 1, 1),
(38, 2, 24, 1, 1, 1, 1, 1),
(39, 3, 1, 0, 0, 0, 0, 0),
(40, 3, 2, 0, 0, 0, 0, 0),
(41, 3, 7, 0, 0, 0, 0, 0),
(42, 3, 8, 0, 0, 0, 0, 0),
(43, 3, 9, 0, 0, 0, 0, 0),
(44, 3, 10, 0, 0, 0, 0, 0),
(45, 3, 12, 0, 0, 0, 0, 0),
(46, 3, 13, 0, 0, 0, 0, 0),
(47, 3, 14, 0, 0, 0, 0, 0),
(48, 3, 15, 0, 0, 0, 0, 0),
(49, 3, 16, 0, 0, 0, 0, 0),
(50, 3, 17, 0, 0, 0, 0, 0),
(51, 3, 18, 1, 1, 1, 1, 1),
(52, 3, 19, 1, 1, 1, 1, 1),
(53, 3, 20, 1, 1, 1, 1, 1),
(54, 3, 21, 1, 1, 1, 1, 1),
(55, 3, 22, 0, 0, 0, 0, 0),
(56, 3, 23, 0, 0, 0, 0, 0),
(57, 3, 24, 1, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sis_relaciones`
--

CREATE TABLE IF NOT EXISTS `sis_relaciones` (
  `id` int(10) unsigned NOT NULL,
  `id_sis_tablas` int(10) unsigned NOT NULL,
  `id_sis_tablas_relacion` int(10) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sis_relaciones`
--

INSERT INTO `sis_relaciones` (`id`, `id_sis_tablas`, `id_sis_tablas_relacion`) VALUES
(2, 12, 16),
(3, 14, 16),
(4, 14, 15),
(5, 17, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sis_tablas`
--

CREATE TABLE IF NOT EXISTS `sis_tablas` (
  `id` int(10) unsigned NOT NULL,
  `tabla` varchar(100) NOT NULL,
  `id_sis_main` int(10) unsigned NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sis_tablas`
--

INSERT INTO `sis_tablas` (`id`, `tabla`, `id_sis_main`, `descripcion`) VALUES
(8, 'arancel', 5, 'Arancel'),
(9, 'bancos', 5, 'Bancos'),
(10, 'citas', 4, 'Citas'),
(11, 'configuraciones', 5, 'Configuraciones'),
(12, 'estatus_solicitud', 5, 'Estatus Solicitud'),
(13, 'pagos', 5, 'Pagos'),
(14, 'solicitud_arancel', 4, 'Solicitud Arancel'),
(15, 'solicitud_arancel_detalles', 4, 'Solicitud Arancel Detalles'),
(16, 'solicitud_arancel_estatus', 4, 'Solicitud Arancel Estatus'),
(17, 'tipo_solicitud', 5, 'tipo_solicitud'),
(18, 'unidad_tributaria', 5, 'Unidad Tributaria'),
(19, 'vst_estudiantes_pyscde', 5, 'vst_estudiantes_pyscde');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sis_usuarios`
--

CREATE TABLE IF NOT EXISTS `sis_usuarios` (
  `id` int(10) unsigned NOT NULL,
  `id_grupos` int(10) unsigned NOT NULL,
  `cedula` varchar(15) NOT NULL,
  `apellidos` varchar(60) NOT NULL,
  `nombres` varchar(60) NOT NULL,
  `login` varchar(60) NOT NULL,
  `telefono` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sis_usuarios`
--

INSERT INTO `sis_usuarios` (`id`, `id_grupos`, `cedula`, `apellidos`, `nombres`, `login`, `telefono`, `password`) VALUES
(1, 1, '1', 'del Sistema', 'Super Administrador', 'root', '', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(2, 2, '1', 'del Sistema', 'Administrador', 'admin', '', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(3, 3, 'ed', 'ed', 'ed', 'e@e', '', '1234'),
(4, 3, '20869547', 'PEREZ LOVERA', 'JESUS RAFAEL', 'r@p', '', '1234'),
(5, 3, '20215357', 'TORRES PEREZ', 'RICARDO ', 't@r', '', '1234'),
(6, 3, '19555326', 'DA SILVA ROJAS', 'GINA MARIA', 'g@m', '04143185777', 'd2150d'),
(7, 3, '20876170', 'VARGAS NIEVES', 'RONALD ALBERTO', 'r@v', '04169453387', '27697d');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sis_views`
--

CREATE TABLE IF NOT EXISTS `sis_views` (
  `id` int(10) unsigned NOT NULL,
  `view` varchar(5000) DEFAULT NULL,
  `encabezado` varchar(5000) DEFAULT NULL,
  `campos` varchar(5000) DEFAULT NULL,
  `cierre` varchar(5000) DEFAULT NULL,
  `is_editada` tinyint(4) DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sis_views`
--

INSERT INTO `sis_views` (`id`, `view`, `encabezado`, `campos`, `cierre`, `is_editada`) VALUES
(1, 'vst_arancel', 'create or replace view vst_arancel as select ', 'arancel.id, arancel.nombre, arancel.monto, arancel.max', '  from arancel ;', 1),
(2, 'bg_arancel', 'create or replace view bg_arancel as select ', 'arancel.id, arancel.nombre, arancel.monto, arancel.max', '  from arancel ;', 1),
(3, 'b_arancel', 'create or replace view b_arancel as select ', 'arancel.id, arancel.nombre', '  from arancel ;', 1),
(4, 'b_i_arancel', 'create or replace view b_i_arancel as select ', 'arancel.id, arancel.nombre', '  from arancel;', 1),
(5, 's_id_arancel', 'create or replace view s_id_arancel as select ', 'arancel.id, arancel.nombre as descripcion', '  from arancel;', 1),
(6, 'vst_bancos', 'create or replace view vst_bancos as select ', 'bancos.id, bancos.banco', '  from bancos ;', 1),
(7, 'bg_bancos', 'create or replace view bg_bancos as select ', 'bancos.id, bancos.banco', '  from bancos ;', 1),
(8, 'b_bancos', 'create or replace view b_bancos as select ', 'bancos.id, bancos.banco', '  from bancos ;', 1),
(9, 'b_i_bancos', 'create or replace view b_i_bancos as select ', 'bancos.id, bancos.banco', '  from bancos;', 1),
(10, 's_id_bancos', 'create or replace view s_id_bancos as select ', 'bancos.id, bancos.banco as descripcion', '  from bancos;', 1),
(11, 'vst_citas', 'create or replace view vst_citas as select ', 'citas.id, citas.fecha_ini, citas.fecha_fin, citas.user_id, citas.id_tipo_solicitud, tipo_solicitud.solicitud', '  from citas  inner join tipo_solicitud as tipo_solicitud on tipo_solicitud.id=citas.id_tipo_solicitud ;', 1),
(12, 'bg_citas', 'create or replace view bg_citas as select ', 'citas.id, citas.fecha_ini, citas.fecha_fin, citas.user_id, tipo_solicitud.solicitud', '  from citas  inner join tipo_solicitud as tipo_solicitud on tipo_solicitud.id=citas.id_tipo_solicitud ;', 1),
(13, 'b_citas', 'create or replace view b_citas as select ', 'citas.id, citas.fecha_ini, citas.fecha_fin, tipo_solicitud.solicitud', '  from citas  inner join tipo_solicitud as tipo_solicitud on tipo_solicitud.id=citas.id_tipo_solicitud ;', 1),
(14, 'b_i_citas', 'create or replace view b_i_citas as select ', 'citas.id, citas.fecha_ini, citas.fecha_fin, citas.user_id, citas.id_tipo_solicitud', '  from citas;', 1),
(15, 's_id_citas', 'create or replace view s_id_citas as select ', 'citas.id, citas.id as descripcion', '  from citas;', 1),
(16, 'vst_configuraciones', 'create or replace view vst_configuraciones as select ', 'configuraciones.id, configuraciones.vigencia_solicitud, configuraciones.dias_elaboracion, configuraciones.dias_firma, configuraciones.dias_entrega', '  from configuraciones ;', 1),
(17, 'bg_configuraciones', 'create or replace view bg_configuraciones as select ', 'configuraciones.id, configuraciones.vigencia_solicitud, configuraciones.dias_elaboracion, configuraciones.dias_firma, configuraciones.dias_entrega', '  from configuraciones ;', 1),
(18, 'b_configuraciones', 'create or replace view b_configuraciones as select ', 'configuraciones.id, configuraciones.vigencia_solicitud, configuraciones.dias_elaboracion, configuraciones.dias_firma, configuraciones.dias_entrega', '  from configuraciones ;', 1),
(19, 'b_i_configuraciones', 'create or replace view b_i_configuraciones as select ', 'configuraciones.id', '  from configuraciones;', 1),
(20, 's_id_configuraciones', 'create or replace view s_id_configuraciones as select ', 'configuraciones.id, configuraciones.vigencia_solicitud, configuraciones.dias_elaboracion, configuraciones.dias_firma, configuraciones.dias_entrega', '  from configuraciones;', 1),
(21, 'vst_estatus_solicitud', 'create or replace view vst_estatus_solicitud as select ', 'estatus_solicitud.id, estatus_solicitud.estatus', '  from estatus_solicitud ;', 1),
(22, 'bg_estatus_solicitud', 'create or replace view bg_estatus_solicitud as select ', 'estatus_solicitud.id, estatus_solicitud.estatus', '  from estatus_solicitud ;', 1),
(23, 'b_estatus_solicitud', 'create or replace view b_estatus_solicitud as select ', 'estatus_solicitud.id, estatus_solicitud.estatus', '  from estatus_solicitud ;', 1),
(24, 'b_i_estatus_solicitud', 'create or replace view b_i_estatus_solicitud as select ', 'estatus_solicitud.id, estatus_solicitud.estatus', '  from estatus_solicitud;', 1),
(25, 's_id_estatus_solicitud', 'create or replace view s_id_estatus_solicitud as select ', 'estatus_solicitud.id, estatus_solicitud.estatus as descripcion', '  from estatus_solicitud;', 1),
(26, 'vst_pagos', 'create or replace view vst_pagos as select ', 'pagos.id, pagos.id_solicitud_arancel, solicitud_arancel.nro_solicitud, solicitud_arancel.fecha, solicitud_arancel.user_id, pagos.id_bancos, bancos.banco, pagos.monto, pagos.nro_deposito', '  from pagos  inner join solicitud_arancel as solicitud_arancel on solicitud_arancel.id=pagos.id_solicitud_arancel  inner join bancos as bancos on bancos.id=pagos.id_bancos ;', 1),
(27, 'bg_pagos', 'create or replace view bg_pagos as select ', 'pagos.id, solicitud_arancel.nro_solicitud, solicitud_arancel.fecha, solicitud_arancel.user_id, bancos.banco, pagos.monto, pagos.nro_deposito', '  from pagos  inner join solicitud_arancel as solicitud_arancel on solicitud_arancel.id=pagos.id_solicitud_arancel  inner join bancos as bancos on bancos.id=pagos.id_bancos ;', 1),
(28, 'b_pagos', 'create or replace view b_pagos as select ', 'pagos.id, solicitud_arancel.nro_solicitud, pagos.nro_deposito', '  from pagos  inner join solicitud_arancel as solicitud_arancel on solicitud_arancel.id=pagos.id_solicitud_arancel  inner join bancos as bancos on bancos.id=pagos.id_bancos ;', 1),
(29, 'b_i_pagos', 'create or replace view b_i_pagos as select ', 'pagos.id, pagos.id_solicitud_arancel', '  from pagos;', 1),
(30, 's_id_pagos', 'create or replace view s_id_pagos as select ', 'pagos.id, pagos.id_solicitud_arancel, pagos.id_bancos, pagos.monto, pagos.nro_deposito', '  from pagos;', 1),
(31, 'vst_solicitud_arancel', 'create or replace view vst_solicitud_arancel as select ', 'solicitud_arancel.id, solicitud_arancel.nro_solicitud, solicitud_arancel.fecha, solicitud_arancel.user_id', '  from solicitud_arancel ;', 1),
(32, 'bg_solicitud_arancel', 'create or replace view bg_solicitud_arancel as select ', 'solicitud_arancel.id, solicitud_arancel.nro_solicitud, solicitud_arancel.fecha, solicitud_arancel.user_id', '  from solicitud_arancel ;', 1),
(33, 'b_solicitud_arancel', 'create or replace view b_solicitud_arancel as select ', 'solicitud_arancel.id, solicitud_arancel.nro_solicitud, solicitud_arancel.fecha', '  from solicitud_arancel ;', 1),
(34, 'b_i_solicitud_arancel', 'create or replace view b_i_solicitud_arancel as select ', 'solicitud_arancel.id, solicitud_arancel.nro_solicitud, solicitud_arancel.fecha, solicitud_arancel.user_id', '  from solicitud_arancel;', 1),
(35, 's_id_solicitud_arancel', 'create or replace view s_id_solicitud_arancel as select ', 'solicitud_arancel.id, solicitud_arancel.nro_solicitud as descripcion', '  from solicitud_arancel;', 1),
(36, 'vst_solicitud_arancel_detalles', 'create or replace view vst_solicitud_arancel_detalles as select ', 'solicitud_arancel_detalles.id, solicitud_arancel_detalles.id_solicitud_arancel, solicitud_arancel.nro_solicitud, solicitud_arancel.fecha, solicitud_arancel.user_id, solicitud_arancel_detalles.id_arancel, arancel.nombre, arancel.monto, arancel.max, solicitud_arancel_detalles.cantidad', '  from solicitud_arancel_detalles  inner join solicitud_arancel as solicitud_arancel on solicitud_arancel.id=solicitud_arancel_detalles.id_solicitud_arancel  inner join arancel as arancel on arancel.id=solicitud_arancel_detalles.id_arancel ;', 1),
(37, 'bg_solicitud_arancel_detalles', 'create or replace view bg_solicitud_arancel_detalles as select ', 'solicitud_arancel_detalles.id, solicitud_arancel.nro_solicitud, solicitud_arancel.fecha, solicitud_arancel.user_id, arancel.nombre, arancel.monto, arancel.max, solicitud_arancel_detalles.cantidad', '  from solicitud_arancel_detalles  inner join solicitud_arancel as solicitud_arancel on solicitud_arancel.id=solicitud_arancel_detalles.id_solicitud_arancel  inner join arancel as arancel on arancel.id=solicitud_arancel_detalles.id_arancel ;', 1),
(38, 'b_solicitud_arancel_detalles', 'create or replace view b_solicitud_arancel_detalles as select ', 'solicitud_arancel_detalles.id, solicitud_arancel.nro_solicitud, arancel.nombre', '  from solicitud_arancel_detalles  inner join solicitud_arancel as solicitud_arancel on solicitud_arancel.id=solicitud_arancel_detalles.id_solicitud_arancel  inner join arancel as arancel on arancel.id=solicitud_arancel_detalles.id_arancel ;', 1),
(39, 'b_i_solicitud_arancel_detalles', 'create or replace view b_i_solicitud_arancel_detalles as select ', 'solicitud_arancel_detalles.id, solicitud_arancel_detalles.id_solicitud_arancel, solicitud_arancel_detalles.id_arancel', '  from solicitud_arancel_detalles;', 1),
(40, 's_id_solicitud_arancel_detalles', 'create or replace view s_id_solicitud_arancel_detalles as select ', 'solicitud_arancel_detalles.id, solicitud_arancel_detalles.id as descripcion', '  from solicitud_arancel_detalles;', 1),
(41, 'vst_solicitud_arancel_estatus', 'create or replace view vst_solicitud_arancel_estatus as select ', 'solicitud_arancel_estatus.id, solicitud_arancel_estatus.id_solicitud_arancel, solicitud_arancel.nro_solicitud, solicitud_arancel.fecha, solicitud_arancel.user_id, solicitud_arancel_estatus.fecha, solicitud_arancel_estatus.id_estatus_solicitud, estatus_solicitud.estatus', '  from solicitud_arancel_estatus  inner join solicitud_arancel as solicitud_arancel on solicitud_arancel.id=solicitud_arancel_estatus.id_solicitud_arancel  inner join estatus_solicitud as estatus_solicitud on estatus_solicitud.id=solicitud_arancel_estatus.id_estatus_solicitud ;', 1),
(42, 'bg_solicitud_arancel_estatus', 'create or replace view bg_solicitud_arancel_estatus as select ', 'solicitud_arancel_estatus.id, solicitud_arancel.nro_solicitud, solicitud_arancel.fecha, solicitud_arancel.user_id, solicitud_arancel_estatus.fecha, estatus_solicitud.estatus', '  from solicitud_arancel_estatus  inner join solicitud_arancel as solicitud_arancel on solicitud_arancel.id=solicitud_arancel_estatus.id_solicitud_arancel  inner join estatus_solicitud as estatus_solicitud on estatus_solicitud.id=solicitud_arancel_estatus.id_estatus_solicitud ;', 1),
(43, 'b_solicitud_arancel_estatus', 'create or replace view b_solicitud_arancel_estatus as select ', 'solicitud_arancel_estatus.id, solicitud_arancel.nro_solicitud', '  from solicitud_arancel_estatus  inner join solicitud_arancel as solicitud_arancel on solicitud_arancel.id=solicitud_arancel_estatus.id_solicitud_arancel  inner join estatus_solicitud as estatus_solicitud on estatus_solicitud.id=solicitud_arancel_estatus.id_estatus_solicitud ;', 1),
(44, 'b_i_solicitud_arancel_estatus', 'create or replace view b_i_solicitud_arancel_estatus as select ', 'solicitud_arancel_estatus.id, solicitud_arancel_estatus.id_solicitud_arancel, solicitud_arancel_estatus.fecha, solicitud_arancel_estatus.id_estatus_solicitud', '  from solicitud_arancel_estatus;', 1),
(45, 's_id_solicitud_arancel_estatus', 'create or replace view s_id_solicitud_arancel_estatus as select ', 'solicitud_arancel_estatus.id, solicitud_arancel_estatus.id_solicitud_arancel, solicitud_arancel_estatus.fecha, solicitud_arancel_estatus.id_estatus_solicitud', '  from solicitud_arancel_estatus;', 1),
(46, 'vst_tipo_solicitud', 'create or replace view vst_tipo_solicitud as select ', 'tipo_solicitud.id, tipo_solicitud.solicitud', '  from tipo_solicitud ;', 1),
(47, 'bg_tipo_solicitud', 'create or replace view bg_tipo_solicitud as select ', 'tipo_solicitud.id, tipo_solicitud.solicitud', '  from tipo_solicitud ;', 1),
(48, 'b_tipo_solicitud', 'create or replace view b_tipo_solicitud as select ', 'tipo_solicitud.id, tipo_solicitud.solicitud', '  from tipo_solicitud ;', 1),
(49, 'b_i_tipo_solicitud', 'create or replace view b_i_tipo_solicitud as select ', 'tipo_solicitud.id, tipo_solicitud.solicitud', '  from tipo_solicitud;', 1),
(50, 's_id_tipo_solicitud', 'create or replace view s_id_tipo_solicitud as select ', 'tipo_solicitud.id, tipo_solicitud.solicitud as descripcion', '  from tipo_solicitud;', 1),
(51, 'vst_unidad_tributaria', 'create or replace view vst_unidad_tributaria as select ', 'unidad_tributaria.id, unidad_tributaria.unidad, unidad_tributaria.fecha, unidad_tributaria.is_inactiva', '  from unidad_tributaria ;', 1),
(52, 'bg_unidad_tributaria', 'create or replace view bg_unidad_tributaria as select ', 'unidad_tributaria.id, unidad_tributaria.unidad, unidad_tributaria.fecha, unidad_tributaria.is_inactiva', '  from unidad_tributaria ;', 1),
(53, 'b_unidad_tributaria', 'create or replace view b_unidad_tributaria as select ', 'unidad_tributaria.id, unidad_tributaria.unidad', '  from unidad_tributaria ;', 1),
(54, 'b_i_unidad_tributaria', 'create or replace view b_i_unidad_tributaria as select ', 'unidad_tributaria.id, unidad_tributaria.unidad', '  from unidad_tributaria;', 1),
(55, 's_id_unidad_tributaria', 'create or replace view s_id_unidad_tributaria as select ', 'unidad_tributaria.id, unidad_tributaria.unidad as descripcion', '  from unidad_tributaria;', 1),
(56, 'vst_vst_estudiantes_pyscde', 'create or replace view vst_vst_estudiantes_pyscde as select ', 'vst_estudiantes_pyscde.cedula, vst_estudiantes_pyscde.primer_apellido, vst_estudiantes_pyscde.segundo_apellido, vst_estudiantes_pyscde.primer_nombre, vst_estudiantes_pyscde.segundo_nombre, vst_estudiantes_pyscde.cod_carrera, vst_estudiantes_pyscde.carrera, vst_estudiantes_pyscde.cod_sede, vst_estudiantes_pyscde.sede, vst_estudiantes_pyscde.estatus', '  from vst_estudiantes_pyscde ;', 1),
(57, 'bg_vst_estudiantes_pyscde', 'create or replace view bg_vst_estudiantes_pyscde as select ', 'vst_estudiantes_pyscde.cedula, vst_estudiantes_pyscde.primer_apellido, vst_estudiantes_pyscde.segundo_apellido, vst_estudiantes_pyscde.primer_nombre, vst_estudiantes_pyscde.segundo_nombre, vst_estudiantes_pyscde.cod_carrera, vst_estudiantes_pyscde.carrera, vst_estudiantes_pyscde.cod_sede, vst_estudiantes_pyscde.sede, vst_estudiantes_pyscde.estatus', '  from vst_estudiantes_pyscde ;', 1),
(58, 'b_vst_estudiantes_pyscde', 'create or replace view b_vst_estudiantes_pyscde as select ', 'vst_estudiantes_pyscde.cedula, vst_estudiantes_pyscde.primer_apellido, vst_estudiantes_pyscde.segundo_apellido, vst_estudiantes_pyscde.primer_nombre, vst_estudiantes_pyscde.segundo_nombre, vst_estudiantes_pyscde.cod_carrera, vst_estudiantes_pyscde.carrera, vst_estudiantes_pyscde.cod_sede, vst_estudiantes_pyscde.sede, vst_estudiantes_pyscde.estatus', '  from vst_estudiantes_pyscde ;', 1),
(59, 'b_i_vst_estudiantes_pyscde', 'create or replace view b_i_vst_estudiantes_pyscde as select ', 'vst_estudiantes_pyscde.cedula, vst_estudiantes_pyscde.primer_apellido, vst_estudiantes_pyscde.segundo_apellido, vst_estudiantes_pyscde.primer_nombre, vst_estudiantes_pyscde.segundo_nombre, vst_estudiantes_pyscde.cod_carrera, vst_estudiantes_pyscde.carrera, vst_estudiantes_pyscde.cod_sede, vst_estudiantes_pyscde.sede, vst_estudiantes_pyscde.estatus', '  from vst_estudiantes_pyscde;', 1),
(60, 's_id_vst_estudiantes_pyscde', 'create or replace view s_id_vst_estudiantes_pyscde as select ', 'vst_estudiantes_pyscde.cedula, vst_estudiantes_pyscde.primer_apellido, vst_estudiantes_pyscde.segundo_apellido, vst_estudiantes_pyscde.primer_nombre, vst_estudiantes_pyscde.segundo_nombre, vst_estudiantes_pyscde.cod_carrera, vst_estudiantes_pyscde.carrera, vst_estudiantes_pyscde.cod_sede, vst_estudiantes_pyscde.sede, vst_estudiantes_pyscde.estatus', '  from vst_estudiantes_pyscde;', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_arancel`
--

CREATE TABLE IF NOT EXISTS `solicitud_arancel` (
  `id` int(11) NOT NULL,
  `nro_solicitud` varchar(45) NOT NULL,
  `fecha` datetime NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `id_carrera_sedes` int(10) unsigned NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `solicitud_arancel`
--

INSERT INTO `solicitud_arancel` (`id`, `nro_solicitud`, `fecha`, `user_id`, `id_carrera_sedes`, `estatus`) VALUES
(73, '201673', '2016-01-18 03:17:17', 7, 0, 0),
(72, '201672', '2016-01-18 03:15:57', 7, 0, 0),
(71, '201671', '2016-01-18 03:13:08', 7, 0, 0),
(70, '201670', '2016-01-18 10:28:49', 4, 1, 0),
(69, '201669', '2016-01-18 10:21:55', 7, 0, 0),
(68, '201668', '2016-01-18 10:21:32', 7, 0, 0),
(67, '201667', '2016-01-18 10:14:10', 7, 1, 0),
(66, '201666', '2016-01-18 09:17:22', 6, 0, 0),
(40, '201632', '2016-01-14 03:09:59', 4, 0, 0),
(41, '201633', '2016-01-14 03:16:48', 4, 0, 0),
(42, '201634', '2016-01-14 03:24:26', 4, 0, 0),
(43, '201635', '2016-01-14 03:24:44', 4, 0, 0),
(44, '201636', '2016-01-15 01:00:24', 6, 0, 0),
(45, '201637', '2016-01-15 01:53:24', 6, 0, 0),
(2, '', '0000-00-00 00:00:00', 0, 0, 1),
(46, '201638', '2016-01-15 02:04:25', 6, 0, 0),
(47, '201639', '2016-01-15 02:19:28', 6, 0, 0),
(48, '201640', '2016-01-15 02:20:36', 6, 0, 0),
(49, '201641', '2016-01-15 03:46:16', 6, 0, 0),
(50, '201642', '2016-01-17 08:17:43', 5, 0, 0),
(51, '201643', '2016-01-17 08:51:00', 5, 0, 0),
(52, '201644', '2016-01-17 08:56:29', 5, 0, 0),
(53, '201645', '2016-01-17 08:56:39', 5, 0, 0),
(54, '201646', '2016-01-17 08:56:46', 5, 0, 0),
(55, '201647', '2016-01-17 09:04:26', 5, 0, 0),
(56, '201648', '2016-01-17 09:04:27', 5, 0, 0),
(57, '201649', '2016-01-17 09:04:29', 5, 0, 0),
(58, '201650', '2016-01-17 09:04:31', 5, 0, 0),
(59, '201653', '2016-01-17 04:52:31', 4, 0, 0),
(60, '201654', '2016-01-17 10:08:43', 4, 0, 0),
(61, '201655', '2016-01-17 10:09:31', 4, 0, 0),
(62, '201657', '2016-01-17 11:17:58', 4, 2, 0),
(63, '201658', '2016-01-18 07:14:54', 6, 0, 0),
(64, '201664', '2016-01-18 08:52:57', 4, 2, 0),
(65, '201665', '2016-01-18 08:54:48', 6, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_arancel_detalles`
--

CREATE TABLE IF NOT EXISTS `solicitud_arancel_detalles` (
  `id` int(10) unsigned NOT NULL,
  `id_solicitud_arancel` int(10) unsigned NOT NULL,
  `id_arancel` int(10) unsigned NOT NULL,
  `cantidad` int(10) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `solicitud_arancel_detalles`
--

INSERT INTO `solicitud_arancel_detalles` (`id`, `id_solicitud_arancel`, `id_arancel`, `cantidad`) VALUES
(4, 20, 3, 3),
(3, 20, 2, 10),
(5, 22, 4, 1),
(6, 22, 3, 10),
(8, 23, 4, 44),
(9, 27, 3, 5),
(10, 32, 3, 1),
(11, 34, 2, 6),
(12, 41, 2, 1),
(13, 44, 2, 1),
(14, 45, 2, 5),
(15, 46, 4, 4),
(16, 46, 3, 1),
(17, 50, 3, 1),
(18, 50, 2, 1),
(19, 58, 2, 2),
(20, 59, 3, 4),
(28, 66, 12, 2),
(27, 66, 11, 1),
(26, 65, 3, 1),
(25, 65, 2, 2),
(29, 66, 14, 1),
(30, 67, 7, 1),
(31, 67, 9, 1),
(32, 68, 6, 5),
(33, 69, 8, 2),
(34, 69, 8, 1),
(35, 71, 5, 10),
(36, 70, 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_arancel_estatus`
--

CREATE TABLE IF NOT EXISTS `solicitud_arancel_estatus` (
  `id` int(10) unsigned NOT NULL,
  `id_solicitud_arancel` int(10) unsigned NOT NULL,
  `fecha` datetime NOT NULL,
  `id_estatus_solicitud` int(10) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `solicitud_arancel_estatus`
--

INSERT INTO `solicitud_arancel_estatus` (`id`, `id_solicitud_arancel`, `fecha`, `id_estatus_solicitud`) VALUES
(1, 1, '2015-11-29 00:00:00', 1),
(2, 34, '2016-01-14 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_solicitud`
--

CREATE TABLE IF NOT EXISTS `tipo_solicitud` (
  `id` int(11) NOT NULL,
  `solicitud` varchar(45) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_solicitud`
--

INSERT INTO `tipo_solicitud` (`id`, `solicitud`) VALUES
(1, 'NORMAL'),
(2, 'HABILIDADA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad_tributaria`
--

CREATE TABLE IF NOT EXISTS `unidad_tributaria` (
  `id` int(11) NOT NULL,
  `unidad` decimal(18,2) NOT NULL,
  `fecha` date NOT NULL,
  `is_inactiva` tinyint(3) unsigned DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `unidad_tributaria`
--

INSERT INTO `unidad_tributaria` (`id`, `unidad`, `fecha`, `is_inactiva`) VALUES
(1, '150.00', '2015-02-02', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vst_estudiantes_pyscde`
--

CREATE TABLE IF NOT EXISTS `vst_estudiantes_pyscde` (
  `cedula` varchar(45) DEFAULT NULL,
  `primer_apellido` varchar(45) DEFAULT NULL,
  `segundo_apellido` varchar(45) DEFAULT NULL,
  `primer_nombre` varchar(45) DEFAULT NULL,
  `segundo_nombre` varchar(45) DEFAULT NULL,
  `cod_carrera` varchar(45) DEFAULT NULL,
  `carrera` varchar(45) DEFAULT NULL,
  `cod_sede` varchar(45) DEFAULT NULL,
  `sede` varchar(45) DEFAULT NULL,
  `estatus` int(10) unsigned DEFAULT NULL,
  `id_carrera_sedes` int(10) unsigned DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vst_estudiantes_pyscde`
--

INSERT INTO `vst_estudiantes_pyscde` (`cedula`, `primer_apellido`, `segundo_apellido`, `primer_nombre`, `segundo_nombre`, `cod_carrera`, `carrera`, `cod_sede`, `sede`, `estatus`, `id_carrera_sedes`) VALUES
('20869547', 'perez ', 'lovera', 'jesus', 'rafael', '601', 'ingenieria en informatica', '200', 'san juan de los morros', 0, 1),
('19876458', 'bustamante', 'hurtado', 'jose', 'manuel', '601', 'ingenieria en informatica', '200', 'san juan de los morros', 0, 1),
('20584213', 'amariscua', 'valera', 'antonio', 'jose', '601', 'ingenieria en informatica', '200', 'san juan de los morros', 1, 1),
('17854965', 'lopez', 'amador', 'rafael', 'antonio', '601', 'ingenieria en informatica', '200', 'san juan de los morros', 1, 1),
('25986014', 'blanco', 'gomez', 'maria', 'del carmen', '600', 'ingenieria agronomica', '200', 'san juan de los morros', 1, 1),
('19555326', 'da silva', 'rojas', 'gina', 'maria', '500', 'odontologia', '200', 'san juan de los morros', 1, 1),
('20325123', 'flores', 'nieves', 'cesar', 'augusto', '500', 'enfermeria', '200', 'san juan de los morros', 1, 1),
('19025653', 'acosta', 'hernandez', 'luis', 'antonio', '400', 'medicina', '200', 'san juan de los morros', 1, 1),
('19856589', 'hernandez', 'sumosa', 'maryeli', 'caridad', '100', 'administracion', '200', 'san juan de los morros', 1, 1),
('20215357', 'torres', 'perez', 'ricardo', NULL, '601', 'ingenieria en informatica', '200', 'san juan de los morros', 1, 1),
('20869547', 'perez', 'lovera', 'jesus', 'rafael', '500', 'odontologia', '200', 'san juan de los morros', 0, 1),
('20876170', 'vargas', 'nieves', 'ronald', 'alberto', '601', 'ingenieria en informatica', '200', 'san juan de los morros', 0, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `arancel`
--
ALTER TABLE `arancel`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `bancos`
--
ALTER TABLE `bancos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `citas_entrega`
--
ALTER TABLE `citas_entrega`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `citas_solicitud`
--
ALTER TABLE `citas_solicitud`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `configuraciones`
--
ALTER TABLE `configuraciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `correlativos`
--
ALTER TABLE `correlativos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estatus_solicitud`
--
ALTER TABLE `estatus_solicitud`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lote`
--
ALTER TABLE `lote`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lote_solicitud_arancel_detalles`
--
ALTER TABLE `lote_solicitud_arancel_detalles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sis_grupos`
--
ALTER TABLE `sis_grupos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sis_main`
--
ALTER TABLE `sis_main`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sis_modulos`
--
ALTER TABLE `sis_modulos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sis_permisos`
--
ALTER TABLE `sis_permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sis_relaciones`
--
ALTER TABLE `sis_relaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sis_tablas`
--
ALTER TABLE `sis_tablas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sis_usuarios`
--
ALTER TABLE `sis_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sis_views`
--
ALTER TABLE `sis_views`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `solicitud_arancel`
--
ALTER TABLE `solicitud_arancel`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `solicitud_arancel_detalles`
--
ALTER TABLE `solicitud_arancel_detalles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `solicitud_arancel_estatus`
--
ALTER TABLE `solicitud_arancel_estatus`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_solicitud`
--
ALTER TABLE `tipo_solicitud`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `unidad_tributaria`
--
ALTER TABLE `unidad_tributaria`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `arancel`
--
ALTER TABLE `arancel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `bancos`
--
ALTER TABLE `bancos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `citas_entrega`
--
ALTER TABLE `citas_entrega`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `citas_solicitud`
--
ALTER TABLE `citas_solicitud`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `configuraciones`
--
ALTER TABLE `configuraciones`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `correlativos`
--
ALTER TABLE `correlativos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `estatus_solicitud`
--
ALTER TABLE `estatus_solicitud`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `lote`
--
ALTER TABLE `lote`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `lote_solicitud_arancel_detalles`
--
ALTER TABLE `lote_solicitud_arancel_detalles`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT de la tabla `sis_grupos`
--
ALTER TABLE `sis_grupos`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `sis_main`
--
ALTER TABLE `sis_main`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `sis_modulos`
--
ALTER TABLE `sis_modulos`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `sis_permisos`
--
ALTER TABLE `sis_permisos`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT de la tabla `sis_relaciones`
--
ALTER TABLE `sis_relaciones`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `sis_tablas`
--
ALTER TABLE `sis_tablas`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `sis_usuarios`
--
ALTER TABLE `sis_usuarios`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `sis_views`
--
ALTER TABLE `sis_views`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT de la tabla `solicitud_arancel`
--
ALTER TABLE `solicitud_arancel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT de la tabla `solicitud_arancel_detalles`
--
ALTER TABLE `solicitud_arancel_detalles`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT de la tabla `solicitud_arancel_estatus`
--
ALTER TABLE `solicitud_arancel_estatus`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tipo_solicitud`
--
ALTER TABLE `tipo_solicitud`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `unidad_tributaria`
--
ALTER TABLE `unidad_tributaria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
