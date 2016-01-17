-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generación: 02-12-2015 a las 13:11:54
-- Versión del servidor: 5.0.51
-- Versión de PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Base de datos: `arancel_online_bd`
-- 

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `arancel`
-- 

CREATE TABLE `arancel` (
  `id` int(11) NOT NULL auto_increment,
  `nombre` varchar(100) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `max` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- 
-- Volcar la base de datos para la tabla `arancel`
-- 

INSERT INTO `arancel` VALUES (2, 'Constancia de notas', 200.00, 0);
INSERT INTO `arancel` VALUES (3, 'Fondo negro', 100.00, 2);
INSERT INTO `arancel` VALUES (4, 'Constancia de egreso', 200.00, 2);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `bancos`
-- 

CREATE TABLE `bancos` (
  `id` int(11) NOT NULL auto_increment,
  `banco` varchar(45) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Volcar la base de datos para la tabla `bancos`
-- 

INSERT INTO `bancos` VALUES (1, 'BANCO BFC 3316');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `citas`
-- 

CREATE TABLE `citas` (
  `id` int(11) NOT NULL,
  `fecha_ini` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `id_tipo_solicitud` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `citas`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `configuraciones`
-- 

CREATE TABLE `configuraciones` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `vigencia_solicitud` int(10) unsigned default NULL,
  `dias_elaboracion` int(10) unsigned default NULL,
  `dias_firma` int(10) unsigned default NULL,
  `dias_entrega` int(10) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Volcar la base de datos para la tabla `configuraciones`
-- 

INSERT INTO `configuraciones` VALUES (1, 20, 5, 5, 10);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `estatus_solicitud`
-- 

CREATE TABLE `estatus_solicitud` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `estatus` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- 
-- Volcar la base de datos para la tabla `estatus_solicitud`
-- 

INSERT INTO `estatus_solicitud` VALUES (1, 'Solicitud Activa');
INSERT INTO `estatus_solicitud` VALUES (2, 'Solicitud Vencida');
INSERT INTO `estatus_solicitud` VALUES (3, 'Pagado');
INSERT INTO `estatus_solicitud` VALUES (4, 'Elaborado');
INSERT INTO `estatus_solicitud` VALUES (5, 'Firmado');
INSERT INTO `estatus_solicitud` VALUES (6, 'Entregado');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `pagos`
-- 

CREATE TABLE `pagos` (
  `id` int(11) NOT NULL auto_increment,
  `id_solicitud_arancel` int(11) NOT NULL,
  `id_bancos` int(11) NOT NULL,
  `monto` decimal(18,2) NOT NULL,
  `nro_deposito` varchar(45) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Volcar la base de datos para la tabla `pagos`
-- 

INSERT INTO `pagos` VALUES (1, 1, 1, 200.00, '5214589347569');
INSERT INTO `pagos` VALUES (2, 2, 1, 200.00, '875');
INSERT INTO `pagos` VALUES (3, 1, 1, 200.00, '54');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `sis_grupos`
-- 

CREATE TABLE `sis_grupos` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- Volcar la base de datos para la tabla `sis_grupos`
-- 

INSERT INTO `sis_grupos` VALUES (1, 'Super', 'Super Administradores del Sistema');
INSERT INTO `sis_grupos` VALUES (2, 'Administradores', 'Administradores del Sistema');
INSERT INTO `sis_grupos` VALUES (3, 'Solicitantes', 'Solicitantes');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `sis_main`
-- 

CREATE TABLE `sis_main` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `main_titulo` varchar(100) NOT NULL,
  `main` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- 
-- Volcar la base de datos para la tabla `sis_main`
-- 

INSERT INTO `sis_main` VALUES (4, 'Solicitudes', 'solicitudes');
INSERT INTO `sis_main` VALUES (5, 'Configuraciones', 'configuraciones');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `sis_modulos`
-- 

CREATE TABLE `sis_modulos` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `modulo` varchar(100) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

-- 
-- Volcar la base de datos para la tabla `sis_modulos`
-- 

INSERT INTO `sis_modulos` VALUES (1, 'sis_grupos', 'Grupos');
INSERT INTO `sis_modulos` VALUES (2, 'usuarios', 'Usuarios');
INSERT INTO `sis_modulos` VALUES (7, 'sis_modulos', 'Modulos del Sistema');
INSERT INTO `sis_modulos` VALUES (8, 'formularios', 'Formularios');
INSERT INTO `sis_modulos` VALUES (9, 'menu', 'Menu');
INSERT INTO `sis_modulos` VALUES (10, 'sis_tablas', 'Sis Tablas');
INSERT INTO `sis_modulos` VALUES (12, 'sis_main', 'Sis Main');
INSERT INTO `sis_modulos` VALUES (13, 'arancel', 'arancel');
INSERT INTO `sis_modulos` VALUES (14, 'bancos', 'bancos');
INSERT INTO `sis_modulos` VALUES (15, 'citas', 'citas');
INSERT INTO `sis_modulos` VALUES (16, 'configuraciones', 'configuraciones');
INSERT INTO `sis_modulos` VALUES (17, 'estatus_solicitud', 'estatus_solicitud');
INSERT INTO `sis_modulos` VALUES (18, 'pagos', 'pagos');
INSERT INTO `sis_modulos` VALUES (19, 'solicitud_arancel', 'solicitud_arancel');
INSERT INTO `sis_modulos` VALUES (20, 'solicitud_arancel_detalles', 'solicitud_arancel_detalles');
INSERT INTO `sis_modulos` VALUES (21, 'solicitud_arancel_estatus', 'solicitud_arancel_estatus');
INSERT INTO `sis_modulos` VALUES (22, 'tipo_solicitud', 'tipo_solicitud');
INSERT INTO `sis_modulos` VALUES (23, 'unidad_tributaria', 'unidad_tributaria');
INSERT INTO `sis_modulos` VALUES (24, 'vst_estudiantes_pyscde', 'vst_estudiantes_pyscde');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `sis_permisos`
-- 

CREATE TABLE `sis_permisos` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `id_grupos` int(10) unsigned NOT NULL,
  `id_modulos` int(10) unsigned NOT NULL,
  `seleccionar` int(10) unsigned NOT NULL,
  `insertar` int(10) unsigned NOT NULL,
  `actualizar` int(10) unsigned NOT NULL,
  `eliminar` int(10) unsigned NOT NULL,
  `ejecutar` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58 ;

-- 
-- Volcar la base de datos para la tabla `sis_permisos`
-- 

INSERT INTO `sis_permisos` VALUES (1, 1, 1, 1, 1, 1, 1, 1);
INSERT INTO `sis_permisos` VALUES (2, 1, 2, 1, 1, 1, 1, 1);
INSERT INTO `sis_permisos` VALUES (3, 1, 7, 1, 1, 1, 1, 1);
INSERT INTO `sis_permisos` VALUES (4, 1, 8, 1, 1, 1, 1, 1);
INSERT INTO `sis_permisos` VALUES (5, 1, 9, 1, 1, 1, 1, 1);
INSERT INTO `sis_permisos` VALUES (6, 1, 10, 1, 1, 1, 1, 1);
INSERT INTO `sis_permisos` VALUES (7, 1, 12, 1, 1, 1, 1, 1);
INSERT INTO `sis_permisos` VALUES (8, 2, 1, 0, 0, 0, 0, 0);
INSERT INTO `sis_permisos` VALUES (9, 2, 2, 0, 0, 0, 0, 0);
INSERT INTO `sis_permisos` VALUES (10, 2, 7, 0, 0, 0, 0, 0);
INSERT INTO `sis_permisos` VALUES (11, 2, 8, 0, 0, 0, 0, 0);
INSERT INTO `sis_permisos` VALUES (12, 2, 9, 0, 0, 0, 0, 0);
INSERT INTO `sis_permisos` VALUES (13, 2, 10, 0, 0, 0, 0, 0);
INSERT INTO `sis_permisos` VALUES (14, 2, 12, 0, 0, 0, 0, 0);
INSERT INTO `sis_permisos` VALUES (15, 1, 13, 1, 1, 1, 1, 1);
INSERT INTO `sis_permisos` VALUES (16, 1, 14, 1, 1, 1, 1, 1);
INSERT INTO `sis_permisos` VALUES (17, 1, 15, 1, 1, 1, 1, 1);
INSERT INTO `sis_permisos` VALUES (18, 1, 16, 1, 1, 1, 1, 1);
INSERT INTO `sis_permisos` VALUES (19, 1, 17, 1, 1, 1, 1, 1);
INSERT INTO `sis_permisos` VALUES (20, 1, 18, 1, 1, 1, 1, 1);
INSERT INTO `sis_permisos` VALUES (21, 1, 19, 1, 1, 1, 1, 1);
INSERT INTO `sis_permisos` VALUES (22, 1, 20, 1, 1, 1, 1, 1);
INSERT INTO `sis_permisos` VALUES (23, 1, 21, 1, 1, 1, 1, 1);
INSERT INTO `sis_permisos` VALUES (24, 1, 22, 1, 1, 1, 1, 1);
INSERT INTO `sis_permisos` VALUES (25, 1, 23, 1, 1, 1, 1, 1);
INSERT INTO `sis_permisos` VALUES (26, 1, 24, 1, 1, 1, 1, 1);
INSERT INTO `sis_permisos` VALUES (27, 2, 13, 1, 1, 1, 1, 1);
INSERT INTO `sis_permisos` VALUES (28, 2, 14, 1, 1, 1, 1, 1);
INSERT INTO `sis_permisos` VALUES (29, 2, 15, 1, 1, 1, 1, 1);
INSERT INTO `sis_permisos` VALUES (30, 2, 16, 1, 1, 1, 1, 1);
INSERT INTO `sis_permisos` VALUES (31, 2, 17, 1, 1, 1, 1, 1);
INSERT INTO `sis_permisos` VALUES (32, 2, 18, 1, 1, 1, 1, 1);
INSERT INTO `sis_permisos` VALUES (33, 2, 19, 1, 1, 1, 1, 1);
INSERT INTO `sis_permisos` VALUES (34, 2, 20, 1, 1, 1, 1, 1);
INSERT INTO `sis_permisos` VALUES (35, 2, 21, 1, 1, 1, 1, 1);
INSERT INTO `sis_permisos` VALUES (36, 2, 22, 1, 1, 1, 1, 1);
INSERT INTO `sis_permisos` VALUES (37, 2, 23, 1, 1, 1, 1, 1);
INSERT INTO `sis_permisos` VALUES (38, 2, 24, 1, 1, 1, 1, 1);
INSERT INTO `sis_permisos` VALUES (39, 3, 1, 0, 0, 0, 0, 0);
INSERT INTO `sis_permisos` VALUES (40, 3, 2, 0, 0, 0, 0, 0);
INSERT INTO `sis_permisos` VALUES (41, 3, 7, 0, 0, 0, 0, 0);
INSERT INTO `sis_permisos` VALUES (42, 3, 8, 0, 0, 0, 0, 0);
INSERT INTO `sis_permisos` VALUES (43, 3, 9, 0, 0, 0, 0, 0);
INSERT INTO `sis_permisos` VALUES (44, 3, 10, 0, 0, 0, 0, 0);
INSERT INTO `sis_permisos` VALUES (45, 3, 12, 0, 0, 0, 0, 0);
INSERT INTO `sis_permisos` VALUES (46, 3, 13, 0, 0, 0, 0, 0);
INSERT INTO `sis_permisos` VALUES (47, 3, 14, 0, 0, 0, 0, 0);
INSERT INTO `sis_permisos` VALUES (48, 3, 15, 0, 0, 0, 0, 0);
INSERT INTO `sis_permisos` VALUES (49, 3, 16, 0, 0, 0, 0, 0);
INSERT INTO `sis_permisos` VALUES (50, 3, 17, 0, 0, 0, 0, 0);
INSERT INTO `sis_permisos` VALUES (51, 3, 18, 0, 0, 0, 0, 0);
INSERT INTO `sis_permisos` VALUES (52, 3, 19, 1, 1, 1, 1, 1);
INSERT INTO `sis_permisos` VALUES (53, 3, 20, 1, 1, 1, 1, 1);
INSERT INTO `sis_permisos` VALUES (54, 3, 21, 0, 0, 0, 0, 0);
INSERT INTO `sis_permisos` VALUES (55, 3, 22, 0, 0, 0, 0, 0);
INSERT INTO `sis_permisos` VALUES (56, 3, 23, 0, 0, 0, 0, 0);
INSERT INTO `sis_permisos` VALUES (57, 3, 24, 1, 0, 0, 0, 0);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `sis_relaciones`
-- 

CREATE TABLE `sis_relaciones` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `id_sis_tablas` int(10) unsigned NOT NULL,
  `id_sis_tablas_relacion` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- 
-- Volcar la base de datos para la tabla `sis_relaciones`
-- 

INSERT INTO `sis_relaciones` VALUES (2, 12, 16);
INSERT INTO `sis_relaciones` VALUES (3, 14, 16);
INSERT INTO `sis_relaciones` VALUES (4, 14, 15);
INSERT INTO `sis_relaciones` VALUES (5, 17, 10);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `sis_tablas`
-- 

CREATE TABLE `sis_tablas` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `tabla` varchar(100) NOT NULL,
  `id_sis_main` int(10) unsigned NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

-- 
-- Volcar la base de datos para la tabla `sis_tablas`
-- 

INSERT INTO `sis_tablas` VALUES (8, 'arancel', 5, 'Arancel');
INSERT INTO `sis_tablas` VALUES (9, 'bancos', 5, 'Bancos');
INSERT INTO `sis_tablas` VALUES (10, 'citas', 4, 'Citas');
INSERT INTO `sis_tablas` VALUES (11, 'configuraciones', 5, 'Configuraciones');
INSERT INTO `sis_tablas` VALUES (12, 'estatus_solicitud', 5, 'Estatus Solicitud');
INSERT INTO `sis_tablas` VALUES (13, 'pagos', 5, 'Pagos');
INSERT INTO `sis_tablas` VALUES (14, 'solicitud_arancel', 4, 'Solicitud Arancel');
INSERT INTO `sis_tablas` VALUES (15, 'solicitud_arancel_detalles', 4, 'Solicitud Arancel Detalles');
INSERT INTO `sis_tablas` VALUES (16, 'solicitud_arancel_estatus', 4, 'Solicitud Arancel Estatus');
INSERT INTO `sis_tablas` VALUES (17, 'tipo_solicitud', 5, 'tipo_solicitud');
INSERT INTO `sis_tablas` VALUES (18, 'unidad_tributaria', 5, 'Unidad Tributaria');
INSERT INTO `sis_tablas` VALUES (19, 'vst_estudiantes_pyscde', 5, 'vst_estudiantes_pyscde');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `sis_usuarios`
-- 

CREATE TABLE `sis_usuarios` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `id_grupos` int(10) unsigned NOT NULL,
  `cedula` varchar(15) NOT NULL,
  `apellidos` varchar(60) NOT NULL,
  `nombres` varchar(60) NOT NULL,
  `login` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- 
-- Volcar la base de datos para la tabla `sis_usuarios`
-- 

INSERT INTO `sis_usuarios` VALUES (1, 1, '1', 'del Sistema', 'Super Administrador', 'root', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220');
INSERT INTO `sis_usuarios` VALUES (2, 2, '1', 'del Sistema', 'Administrador', 'admin', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220');
INSERT INTO `sis_usuarios` VALUES (3, 3, '1', '1', '1', '1', '82cc8f');
INSERT INTO `sis_usuarios` VALUES (4, 3, 'ed', 'ed', 'ed', 'edgaropalomaresm@gmail.com', '8e3e98');
INSERT INTO `sis_usuarios` VALUES (5, 3, '2', '2', '2', 'e@e', '286815');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `sis_views`
-- 

CREATE TABLE `sis_views` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `view` varchar(5000) default NULL,
  `encabezado` varchar(5000) default NULL,
  `campos` varchar(5000) default NULL,
  `cierre` varchar(5000) default NULL,
  `is_editada` tinyint(4) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

-- 
-- Volcar la base de datos para la tabla `sis_views`
-- 

INSERT INTO `sis_views` VALUES (1, 'vst_arancel', 'create or replace view vst_arancel as select ', 'arancel.id, arancel.nombre, arancel.monto, arancel.max', '  from arancel ;', 1);
INSERT INTO `sis_views` VALUES (2, 'bg_arancel', 'create or replace view bg_arancel as select ', 'arancel.id, arancel.nombre, arancel.monto, arancel.max', '  from arancel ;', 1);
INSERT INTO `sis_views` VALUES (3, 'b_arancel', 'create or replace view b_arancel as select ', 'arancel.id, arancel.nombre', '  from arancel ;', 1);
INSERT INTO `sis_views` VALUES (4, 'b_i_arancel', 'create or replace view b_i_arancel as select ', 'arancel.id, arancel.nombre', '  from arancel;', 1);
INSERT INTO `sis_views` VALUES (5, 's_id_arancel', 'create or replace view s_id_arancel as select ', 'arancel.id, arancel.nombre as descripcion', '  from arancel;', 1);
INSERT INTO `sis_views` VALUES (6, 'vst_bancos', 'create or replace view vst_bancos as select ', 'bancos.id, bancos.banco', '  from bancos ;', 1);
INSERT INTO `sis_views` VALUES (7, 'bg_bancos', 'create or replace view bg_bancos as select ', 'bancos.id, bancos.banco', '  from bancos ;', 1);
INSERT INTO `sis_views` VALUES (8, 'b_bancos', 'create or replace view b_bancos as select ', 'bancos.id, bancos.banco', '  from bancos ;', 1);
INSERT INTO `sis_views` VALUES (9, 'b_i_bancos', 'create or replace view b_i_bancos as select ', 'bancos.id, bancos.banco', '  from bancos;', 1);
INSERT INTO `sis_views` VALUES (10, 's_id_bancos', 'create or replace view s_id_bancos as select ', 'bancos.id, bancos.banco as descripcion', '  from bancos;', 1);
INSERT INTO `sis_views` VALUES (11, 'vst_citas', 'create or replace view vst_citas as select ', 'citas.id, citas.fecha_ini, citas.fecha_fin, citas.user_id, citas.id_tipo_solicitud, tipo_solicitud.solicitud', '  from citas  inner join tipo_solicitud as tipo_solicitud on tipo_solicitud.id=citas.id_tipo_solicitud ;', 1);
INSERT INTO `sis_views` VALUES (12, 'bg_citas', 'create or replace view bg_citas as select ', 'citas.id, citas.fecha_ini, citas.fecha_fin, citas.user_id, tipo_solicitud.solicitud', '  from citas  inner join tipo_solicitud as tipo_solicitud on tipo_solicitud.id=citas.id_tipo_solicitud ;', 1);
INSERT INTO `sis_views` VALUES (13, 'b_citas', 'create or replace view b_citas as select ', 'citas.id, citas.fecha_ini, citas.fecha_fin, tipo_solicitud.solicitud', '  from citas  inner join tipo_solicitud as tipo_solicitud on tipo_solicitud.id=citas.id_tipo_solicitud ;', 1);
INSERT INTO `sis_views` VALUES (14, 'b_i_citas', 'create or replace view b_i_citas as select ', 'citas.id, citas.fecha_ini, citas.fecha_fin, citas.user_id, citas.id_tipo_solicitud', '  from citas;', 1);
INSERT INTO `sis_views` VALUES (15, 's_id_citas', 'create or replace view s_id_citas as select ', 'citas.id, citas.id as descripcion', '  from citas;', 1);
INSERT INTO `sis_views` VALUES (16, 'vst_configuraciones', 'create or replace view vst_configuraciones as select ', 'configuraciones.id, configuraciones.vigencia_solicitud, configuraciones.dias_elaboracion, configuraciones.dias_firma, configuraciones.dias_entrega', '  from configuraciones ;', 1);
INSERT INTO `sis_views` VALUES (17, 'bg_configuraciones', 'create or replace view bg_configuraciones as select ', 'configuraciones.id, configuraciones.vigencia_solicitud, configuraciones.dias_elaboracion, configuraciones.dias_firma, configuraciones.dias_entrega', '  from configuraciones ;', 1);
INSERT INTO `sis_views` VALUES (18, 'b_configuraciones', 'create or replace view b_configuraciones as select ', 'configuraciones.id, configuraciones.vigencia_solicitud, configuraciones.dias_elaboracion, configuraciones.dias_firma, configuraciones.dias_entrega', '  from configuraciones ;', 1);
INSERT INTO `sis_views` VALUES (19, 'b_i_configuraciones', 'create or replace view b_i_configuraciones as select ', 'configuraciones.id', '  from configuraciones;', 1);
INSERT INTO `sis_views` VALUES (20, 's_id_configuraciones', 'create or replace view s_id_configuraciones as select ', 'configuraciones.id, configuraciones.vigencia_solicitud, configuraciones.dias_elaboracion, configuraciones.dias_firma, configuraciones.dias_entrega', '  from configuraciones;', 1);
INSERT INTO `sis_views` VALUES (21, 'vst_estatus_solicitud', 'create or replace view vst_estatus_solicitud as select ', 'estatus_solicitud.id, estatus_solicitud.estatus', '  from estatus_solicitud ;', 1);
INSERT INTO `sis_views` VALUES (22, 'bg_estatus_solicitud', 'create or replace view bg_estatus_solicitud as select ', 'estatus_solicitud.id, estatus_solicitud.estatus', '  from estatus_solicitud ;', 1);
INSERT INTO `sis_views` VALUES (23, 'b_estatus_solicitud', 'create or replace view b_estatus_solicitud as select ', 'estatus_solicitud.id, estatus_solicitud.estatus', '  from estatus_solicitud ;', 1);
INSERT INTO `sis_views` VALUES (24, 'b_i_estatus_solicitud', 'create or replace view b_i_estatus_solicitud as select ', 'estatus_solicitud.id, estatus_solicitud.estatus', '  from estatus_solicitud;', 1);
INSERT INTO `sis_views` VALUES (25, 's_id_estatus_solicitud', 'create or replace view s_id_estatus_solicitud as select ', 'estatus_solicitud.id, estatus_solicitud.estatus as descripcion', '  from estatus_solicitud;', 1);
INSERT INTO `sis_views` VALUES (26, 'vst_pagos', 'create or replace view vst_pagos as select ', 'pagos.id, pagos.id_solicitud_arancel, solicitud_arancel.nro_solicitud, solicitud_arancel.fecha, solicitud_arancel.user_id, pagos.id_bancos, bancos.banco, pagos.monto, pagos.nro_deposito', '  from pagos  inner join solicitud_arancel as solicitud_arancel on solicitud_arancel.id=pagos.id_solicitud_arancel  inner join bancos as bancos on bancos.id=pagos.id_bancos ;', 1);
INSERT INTO `sis_views` VALUES (27, 'bg_pagos', 'create or replace view bg_pagos as select ', 'pagos.id, solicitud_arancel.nro_solicitud, solicitud_arancel.fecha, solicitud_arancel.user_id, bancos.banco, pagos.monto, pagos.nro_deposito', '  from pagos  inner join solicitud_arancel as solicitud_arancel on solicitud_arancel.id=pagos.id_solicitud_arancel  inner join bancos as bancos on bancos.id=pagos.id_bancos ;', 1);
INSERT INTO `sis_views` VALUES (28, 'b_pagos', 'create or replace view b_pagos as select ', 'pagos.id, solicitud_arancel.nro_solicitud, pagos.nro_deposito', '  from pagos  inner join solicitud_arancel as solicitud_arancel on solicitud_arancel.id=pagos.id_solicitud_arancel  inner join bancos as bancos on bancos.id=pagos.id_bancos ;', 1);
INSERT INTO `sis_views` VALUES (29, 'b_i_pagos', 'create or replace view b_i_pagos as select ', 'pagos.id, pagos.id_solicitud_arancel', '  from pagos;', 1);
INSERT INTO `sis_views` VALUES (30, 's_id_pagos', 'create or replace view s_id_pagos as select ', 'pagos.id, pagos.id_solicitud_arancel, pagos.id_bancos, pagos.monto, pagos.nro_deposito', '  from pagos;', 1);
INSERT INTO `sis_views` VALUES (31, 'vst_solicitud_arancel', 'create or replace view vst_solicitud_arancel as select ', 'solicitud_arancel.id, solicitud_arancel.nro_solicitud, solicitud_arancel.fecha, solicitud_arancel.user_id', '  from solicitud_arancel ;', 1);
INSERT INTO `sis_views` VALUES (32, 'bg_solicitud_arancel', 'create or replace view bg_solicitud_arancel as select ', 'solicitud_arancel.id, solicitud_arancel.nro_solicitud, solicitud_arancel.fecha, solicitud_arancel.user_id', '  from solicitud_arancel ;', 1);
INSERT INTO `sis_views` VALUES (33, 'b_solicitud_arancel', 'create or replace view b_solicitud_arancel as select ', 'solicitud_arancel.id, solicitud_arancel.nro_solicitud, solicitud_arancel.fecha', '  from solicitud_arancel ;', 1);
INSERT INTO `sis_views` VALUES (34, 'b_i_solicitud_arancel', 'create or replace view b_i_solicitud_arancel as select ', 'solicitud_arancel.id, solicitud_arancel.nro_solicitud, solicitud_arancel.fecha, solicitud_arancel.user_id', '  from solicitud_arancel;', 1);
INSERT INTO `sis_views` VALUES (35, 's_id_solicitud_arancel', 'create or replace view s_id_solicitud_arancel as select ', 'solicitud_arancel.id, solicitud_arancel.nro_solicitud as descripcion', '  from solicitud_arancel;', 1);
INSERT INTO `sis_views` VALUES (36, 'vst_solicitud_arancel_detalles', 'create or replace view vst_solicitud_arancel_detalles as select ', 'solicitud_arancel_detalles.id, solicitud_arancel_detalles.id_solicitud_arancel, solicitud_arancel.nro_solicitud, solicitud_arancel.fecha, solicitud_arancel.user_id, solicitud_arancel_detalles.id_arancel, arancel.nombre, arancel.monto, arancel.max, solicitud_arancel_detalles.cantidad', '  from solicitud_arancel_detalles  inner join solicitud_arancel as solicitud_arancel on solicitud_arancel.id=solicitud_arancel_detalles.id_solicitud_arancel  inner join arancel as arancel on arancel.id=solicitud_arancel_detalles.id_arancel ;', 1);
INSERT INTO `sis_views` VALUES (37, 'bg_solicitud_arancel_detalles', 'create or replace view bg_solicitud_arancel_detalles as select ', 'solicitud_arancel_detalles.id, solicitud_arancel.nro_solicitud, solicitud_arancel.fecha, solicitud_arancel.user_id, arancel.nombre, arancel.monto, arancel.max, solicitud_arancel_detalles.cantidad', '  from solicitud_arancel_detalles  inner join solicitud_arancel as solicitud_arancel on solicitud_arancel.id=solicitud_arancel_detalles.id_solicitud_arancel  inner join arancel as arancel on arancel.id=solicitud_arancel_detalles.id_arancel ;', 1);
INSERT INTO `sis_views` VALUES (38, 'b_solicitud_arancel_detalles', 'create or replace view b_solicitud_arancel_detalles as select ', 'solicitud_arancel_detalles.id, solicitud_arancel.nro_solicitud, arancel.nombre', '  from solicitud_arancel_detalles  inner join solicitud_arancel as solicitud_arancel on solicitud_arancel.id=solicitud_arancel_detalles.id_solicitud_arancel  inner join arancel as arancel on arancel.id=solicitud_arancel_detalles.id_arancel ;', 1);
INSERT INTO `sis_views` VALUES (39, 'b_i_solicitud_arancel_detalles', 'create or replace view b_i_solicitud_arancel_detalles as select ', 'solicitud_arancel_detalles.id, solicitud_arancel_detalles.id_solicitud_arancel, solicitud_arancel_detalles.id_arancel', '  from solicitud_arancel_detalles;', 1);
INSERT INTO `sis_views` VALUES (40, 's_id_solicitud_arancel_detalles', 'create or replace view s_id_solicitud_arancel_detalles as select ', 'solicitud_arancel_detalles.id, solicitud_arancel_detalles.id as descripcion', '  from solicitud_arancel_detalles;', 1);
INSERT INTO `sis_views` VALUES (41, 'vst_solicitud_arancel_estatus', 'create or replace view vst_solicitud_arancel_estatus as select ', 'solicitud_arancel_estatus.id, solicitud_arancel_estatus.id_solicitud_arancel, solicitud_arancel.nro_solicitud, solicitud_arancel.fecha, solicitud_arancel.user_id, solicitud_arancel_estatus.fecha, solicitud_arancel_estatus.id_estatus_solicitud, estatus_solicitud.estatus', '  from solicitud_arancel_estatus  inner join solicitud_arancel as solicitud_arancel on solicitud_arancel.id=solicitud_arancel_estatus.id_solicitud_arancel  inner join estatus_solicitud as estatus_solicitud on estatus_solicitud.id=solicitud_arancel_estatus.id_estatus_solicitud ;', 1);
INSERT INTO `sis_views` VALUES (42, 'bg_solicitud_arancel_estatus', 'create or replace view bg_solicitud_arancel_estatus as select ', 'solicitud_arancel_estatus.id, solicitud_arancel.nro_solicitud, solicitud_arancel.fecha, solicitud_arancel.user_id, solicitud_arancel_estatus.fecha, estatus_solicitud.estatus', '  from solicitud_arancel_estatus  inner join solicitud_arancel as solicitud_arancel on solicitud_arancel.id=solicitud_arancel_estatus.id_solicitud_arancel  inner join estatus_solicitud as estatus_solicitud on estatus_solicitud.id=solicitud_arancel_estatus.id_estatus_solicitud ;', 1);
INSERT INTO `sis_views` VALUES (43, 'b_solicitud_arancel_estatus', 'create or replace view b_solicitud_arancel_estatus as select ', 'solicitud_arancel_estatus.id, solicitud_arancel.nro_solicitud', '  from solicitud_arancel_estatus  inner join solicitud_arancel as solicitud_arancel on solicitud_arancel.id=solicitud_arancel_estatus.id_solicitud_arancel  inner join estatus_solicitud as estatus_solicitud on estatus_solicitud.id=solicitud_arancel_estatus.id_estatus_solicitud ;', 1);
INSERT INTO `sis_views` VALUES (44, 'b_i_solicitud_arancel_estatus', 'create or replace view b_i_solicitud_arancel_estatus as select ', 'solicitud_arancel_estatus.id, solicitud_arancel_estatus.id_solicitud_arancel, solicitud_arancel_estatus.fecha, solicitud_arancel_estatus.id_estatus_solicitud', '  from solicitud_arancel_estatus;', 1);
INSERT INTO `sis_views` VALUES (45, 's_id_solicitud_arancel_estatus', 'create or replace view s_id_solicitud_arancel_estatus as select ', 'solicitud_arancel_estatus.id, solicitud_arancel_estatus.id_solicitud_arancel, solicitud_arancel_estatus.fecha, solicitud_arancel_estatus.id_estatus_solicitud', '  from solicitud_arancel_estatus;', 1);
INSERT INTO `sis_views` VALUES (46, 'vst_tipo_solicitud', 'create or replace view vst_tipo_solicitud as select ', 'tipo_solicitud.id, tipo_solicitud.solicitud', '  from tipo_solicitud ;', 1);
INSERT INTO `sis_views` VALUES (47, 'bg_tipo_solicitud', 'create or replace view bg_tipo_solicitud as select ', 'tipo_solicitud.id, tipo_solicitud.solicitud', '  from tipo_solicitud ;', 1);
INSERT INTO `sis_views` VALUES (48, 'b_tipo_solicitud', 'create or replace view b_tipo_solicitud as select ', 'tipo_solicitud.id, tipo_solicitud.solicitud', '  from tipo_solicitud ;', 1);
INSERT INTO `sis_views` VALUES (49, 'b_i_tipo_solicitud', 'create or replace view b_i_tipo_solicitud as select ', 'tipo_solicitud.id, tipo_solicitud.solicitud', '  from tipo_solicitud;', 1);
INSERT INTO `sis_views` VALUES (50, 's_id_tipo_solicitud', 'create or replace view s_id_tipo_solicitud as select ', 'tipo_solicitud.id, tipo_solicitud.solicitud as descripcion', '  from tipo_solicitud;', 1);
INSERT INTO `sis_views` VALUES (51, 'vst_unidad_tributaria', 'create or replace view vst_unidad_tributaria as select ', 'unidad_tributaria.id, unidad_tributaria.unidad, unidad_tributaria.fecha, unidad_tributaria.is_inactiva', '  from unidad_tributaria ;', 1);
INSERT INTO `sis_views` VALUES (52, 'bg_unidad_tributaria', 'create or replace view bg_unidad_tributaria as select ', 'unidad_tributaria.id, unidad_tributaria.unidad, unidad_tributaria.fecha, unidad_tributaria.is_inactiva', '  from unidad_tributaria ;', 1);
INSERT INTO `sis_views` VALUES (53, 'b_unidad_tributaria', 'create or replace view b_unidad_tributaria as select ', 'unidad_tributaria.id, unidad_tributaria.unidad', '  from unidad_tributaria ;', 1);
INSERT INTO `sis_views` VALUES (54, 'b_i_unidad_tributaria', 'create or replace view b_i_unidad_tributaria as select ', 'unidad_tributaria.id, unidad_tributaria.unidad', '  from unidad_tributaria;', 1);
INSERT INTO `sis_views` VALUES (55, 's_id_unidad_tributaria', 'create or replace view s_id_unidad_tributaria as select ', 'unidad_tributaria.id, unidad_tributaria.unidad as descripcion', '  from unidad_tributaria;', 1);
INSERT INTO `sis_views` VALUES (56, 'vst_vst_estudiantes_pyscde', 'create or replace view vst_vst_estudiantes_pyscde as select ', 'vst_estudiantes_pyscde.cedula, vst_estudiantes_pyscde.primer_apellido, vst_estudiantes_pyscde.segundo_apellido, vst_estudiantes_pyscde.primer_nombre, vst_estudiantes_pyscde.segundo_nombre, vst_estudiantes_pyscde.cod_carrera, vst_estudiantes_pyscde.carrera, vst_estudiantes_pyscde.cod_sede, vst_estudiantes_pyscde.sede, vst_estudiantes_pyscde.estatus', '  from vst_estudiantes_pyscde ;', 1);
INSERT INTO `sis_views` VALUES (57, 'bg_vst_estudiantes_pyscde', 'create or replace view bg_vst_estudiantes_pyscde as select ', 'vst_estudiantes_pyscde.cedula, vst_estudiantes_pyscde.primer_apellido, vst_estudiantes_pyscde.segundo_apellido, vst_estudiantes_pyscde.primer_nombre, vst_estudiantes_pyscde.segundo_nombre, vst_estudiantes_pyscde.cod_carrera, vst_estudiantes_pyscde.carrera, vst_estudiantes_pyscde.cod_sede, vst_estudiantes_pyscde.sede, vst_estudiantes_pyscde.estatus', '  from vst_estudiantes_pyscde ;', 1);
INSERT INTO `sis_views` VALUES (58, 'b_vst_estudiantes_pyscde', 'create or replace view b_vst_estudiantes_pyscde as select ', 'vst_estudiantes_pyscde.cedula, vst_estudiantes_pyscde.primer_apellido, vst_estudiantes_pyscde.segundo_apellido, vst_estudiantes_pyscde.primer_nombre, vst_estudiantes_pyscde.segundo_nombre, vst_estudiantes_pyscde.cod_carrera, vst_estudiantes_pyscde.carrera, vst_estudiantes_pyscde.cod_sede, vst_estudiantes_pyscde.sede, vst_estudiantes_pyscde.estatus', '  from vst_estudiantes_pyscde ;', 1);
INSERT INTO `sis_views` VALUES (59, 'b_i_vst_estudiantes_pyscde', 'create or replace view b_i_vst_estudiantes_pyscde as select ', 'vst_estudiantes_pyscde.cedula, vst_estudiantes_pyscde.primer_apellido, vst_estudiantes_pyscde.segundo_apellido, vst_estudiantes_pyscde.primer_nombre, vst_estudiantes_pyscde.segundo_nombre, vst_estudiantes_pyscde.cod_carrera, vst_estudiantes_pyscde.carrera, vst_estudiantes_pyscde.cod_sede, vst_estudiantes_pyscde.sede, vst_estudiantes_pyscde.estatus', '  from vst_estudiantes_pyscde;', 1);
INSERT INTO `sis_views` VALUES (60, 's_id_vst_estudiantes_pyscde', 'create or replace view s_id_vst_estudiantes_pyscde as select ', 'vst_estudiantes_pyscde.cedula, vst_estudiantes_pyscde.primer_apellido, vst_estudiantes_pyscde.segundo_apellido, vst_estudiantes_pyscde.primer_nombre, vst_estudiantes_pyscde.segundo_nombre, vst_estudiantes_pyscde.cod_carrera, vst_estudiantes_pyscde.carrera, vst_estudiantes_pyscde.cod_sede, vst_estudiantes_pyscde.sede, vst_estudiantes_pyscde.estatus', '  from vst_estudiantes_pyscde;', 1);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `solicitud_arancel`
-- 

CREATE TABLE `solicitud_arancel` (
  `id` int(11) NOT NULL auto_increment,
  `nro_solicitud` varchar(45) NOT NULL,
  `fecha` datetime NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Volcar la base de datos para la tabla `solicitud_arancel`
-- 

INSERT INTO `solicitud_arancel` VALUES (1, '20150000001', '2015-11-22 00:00:00', 1);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `solicitud_arancel_detalles`
-- 

CREATE TABLE `solicitud_arancel_detalles` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `id_solicitud_arancel` int(10) unsigned NOT NULL,
  `id_arancel` int(10) unsigned NOT NULL,
  `cantidad` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Volcar la base de datos para la tabla `solicitud_arancel_detalles`
-- 

INSERT INTO `solicitud_arancel_detalles` VALUES (1, 1, 2, 1);
INSERT INTO `solicitud_arancel_detalles` VALUES (2, 1, 3, 3);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `solicitud_arancel_estatus`
-- 

CREATE TABLE `solicitud_arancel_estatus` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `id_solicitud_arancel` int(10) unsigned NOT NULL,
  `fecha` datetime NOT NULL,
  `id_estatus_solicitud` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Volcar la base de datos para la tabla `solicitud_arancel_estatus`
-- 

INSERT INTO `solicitud_arancel_estatus` VALUES (1, 1, '2015-11-29 00:00:00', 1);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `tipo_solicitud`
-- 

CREATE TABLE `tipo_solicitud` (
  `id` int(11) NOT NULL auto_increment,
  `solicitud` varchar(45) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Volcar la base de datos para la tabla `tipo_solicitud`
-- 

INSERT INTO `tipo_solicitud` VALUES (1, 'NORMAL');
INSERT INTO `tipo_solicitud` VALUES (2, 'HABILIDADA');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `unidad_tributaria`
-- 

CREATE TABLE `unidad_tributaria` (
  `id` int(11) NOT NULL auto_increment,
  `unidad` decimal(18,2) NOT NULL,
  `fecha` date NOT NULL,
  `is_inactiva` tinyint(3) unsigned default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Volcar la base de datos para la tabla `unidad_tributaria`
-- 

INSERT INTO `unidad_tributaria` VALUES (1, 150.00, '2015-02-02', 0);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `vst_estudiantes_pyscde`
-- 

CREATE TABLE `vst_estudiantes_pyscde` (
  `cedula` varchar(45) default NULL,
  `primer_apellido` varchar(45) default NULL,
  `segundo_apellido` varchar(45) default NULL,
  `primer_nombre` varchar(45) default NULL,
  `segundo_nombre` varchar(45) default NULL,
  `cod_carrera` varchar(45) default NULL,
  `carrera` varchar(45) default NULL,
  `cod_sede` varchar(45) default NULL,
  `sede` varchar(45) default NULL,
  `estatus` int(10) unsigned default NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `vst_estudiantes_pyscde`
-- 

INSERT INTO `vst_estudiantes_pyscde` VALUES ('20869547', 'perez ', 'lovera', 'jesus', 'rafael', '601', 'ingenieria en informatica', '200', 'san juan de los morros', 0);
INSERT INTO `vst_estudiantes_pyscde` VALUES ('19876458', 'bustamante', 'hurtado', 'jose', 'manuel', '601', 'ingenieria en informatica', '200', 'san juan de los morros', 0);
INSERT INTO `vst_estudiantes_pyscde` VALUES ('20584213', 'amariscua', 'valera', 'antonio', 'jose', '601', 'ingenieria en informatica', '200', 'san juan de los morros', 1);
INSERT INTO `vst_estudiantes_pyscde` VALUES ('17854965', 'lopez', 'amador', 'rafael', 'antonio', '601', 'ingenieria en informatica', '200', 'san juan de los morros', 1);
INSERT INTO `vst_estudiantes_pyscde` VALUES ('25986014', 'blanco', 'gomez', 'maria', 'del carmen', '600', 'ingenieria agronomica', '200', 'san juan de los morros', 1);
INSERT INTO `vst_estudiantes_pyscde` VALUES ('19555326', 'da silva', 'rojas', 'gina', 'maria', '500', 'odontologia', '200', 'san juan de los morros', 1);
INSERT INTO `vst_estudiantes_pyscde` VALUES ('20325123', 'flores', 'nieves', 'cesar', 'augusto', '500', 'enfermeria', '200', 'san juan de los morros', 1);
INSERT INTO `vst_estudiantes_pyscde` VALUES ('19025653', 'acosta', 'hernandez', 'luis', 'antonio', '400', 'medicina', '200', 'san juan de los morros', 1);
INSERT INTO `vst_estudiantes_pyscde` VALUES ('19856589', 'hernandez', 'sumosa', 'maryeli', 'caridad', '100', 'administracion', '200', 'san juan de los morros', 1);
INSERT INTO `vst_estudiantes_pyscde` VALUES ('20215357', 'torres', 'perez', 'ricardo', NULL, '601', 'ingenieria en informatica', '200', 'san juan de los morros', 1);
