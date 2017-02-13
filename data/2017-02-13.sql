-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.7.4-m14 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             8.0.0.4396
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura de base de datos para nomina_posada
CREATE DATABASE IF NOT EXISTS `nomina_posada` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `nomina_posada`;


-- Volcando estructura para tabla nomina_posada.cat_bancos
CREATE TABLE IF NOT EXISTS `cat_bancos` (
  `id_banco` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `txt_nombre` varchar(100) NOT NULL,
  `txt_descripcion` varchar(500) DEFAULT NULL,
  `b_habilitado` int(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_banco`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla nomina_posada.cat_bancos: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `cat_bancos` DISABLE KEYS */;
INSERT INTO `cat_bancos` (`id_banco`, `txt_nombre`, `txt_descripcion`, `b_habilitado`) VALUES
	(29, 'Santander', NULL, 1),
	(30, 'Banamex', NULL, 1),
	(31, 'Bancomer', NULL, 1),
	(32, 'BanCoppel', NULL, 1),
	(33, 'BANCO AZTECA', NULL, 1),
	(34, 'HSBC', NULL, 1),
	(35, 'BANORTE', NULL, 1);
/*!40000 ALTER TABLE `cat_bancos` ENABLE KEYS */;


-- Volcando estructura para tabla nomina_posada.cat_nominas
CREATE TABLE IF NOT EXISTS `cat_nominas` (
  `id_nomina` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `txt_nombre` varchar(100) NOT NULL,
  `txt_descripcion` varchar(500) DEFAULT NULL,
  `b_habilitado` int(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_nomina`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla nomina_posada.cat_nominas: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `cat_nominas` DISABLE KEYS */;
INSERT INTO `cat_nominas` (`id_nomina`, `txt_nombre`, `txt_descripcion`, `b_habilitado`) VALUES
	(14, 'TEATROS ', NULL, 1),
	(15, 'KIOSCOS', NULL, 1),
	(16, 'WTC', NULL, 1),
	(17, 'LOCACIONES', NULL, 1);
/*!40000 ALTER TABLE `cat_nominas` ENABLE KEYS */;


-- Volcando estructura para tabla nomina_posada.cat_sucursales
CREATE TABLE IF NOT EXISTS `cat_sucursales` (
  `id_sucursal` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `txt_nombre` varchar(100) NOT NULL,
  `txt_descripcion` varchar(500) DEFAULT NULL,
  `b_habilitado` int(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_sucursal`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla nomina_posada.cat_sucursales: ~20 rows (aproximadamente)
/*!40000 ALTER TABLE `cat_sucursales` DISABLE KEYS */;
INSERT INTO `cat_sucursales` (`id_sucursal`, `txt_nombre`, `txt_descripcion`, `b_habilitado`) VALUES
	(44, 'DIAS FIESTA', NULL, 1),
	(45, 'FICUE', NULL, 1),
	(46, 'FAMX', NULL, 1),
	(47, 'FARF', NULL, 1),
	(48, 'FAHG', NULL, 1),
	(49, 'FIPLA', NULL, 1),
	(50, 'FIQRO', NULL, 1),
	(51, 'FAGDL', NULL, 1),
	(52, 'FAGC', NULL, 1),
	(53, 'TELMEX/BASE DE DATOS', NULL, 1),
	(54, 'BASE  DE DATOS', NULL, 1),
	(55, 'TEATRO DIANA', NULL, 1),
	(56, 'WTC', NULL, 1),
	(57, 'Locaciones Temporales', NULL, 1),
	(58, 'Kidzania Cuicuilco', NULL, 1),
	(59, 'Incredible Pizza Monterrey', NULL, 1),
	(60, 'Kidzania Santa Fe', NULL, 1),
	(61, 'Show room Santa Fe', NULL, 1),
	(62, 'TEATROS ', NULL, 1),
	(63, 'ejecutiva de eventos', NULL, 1);
/*!40000 ALTER TABLE `cat_sucursales` ENABLE KEYS */;


-- Volcando estructura para tabla nomina_posada.cat_tipos_contratos
CREATE TABLE IF NOT EXISTS `cat_tipos_contratos` (
  `id_tipo_contrato` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `txt_nombre` varchar(100) NOT NULL,
  `txt_descripcion` varchar(500) DEFAULT NULL,
  `b_habilitado` int(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_tipo_contrato`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla nomina_posada.cat_tipos_contratos: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `cat_tipos_contratos` DISABLE KEYS */;
INSERT INTO `cat_tipos_contratos` (`id_tipo_contrato`, `txt_nombre`, `txt_descripcion`, `b_habilitado`) VALUES
	(19, 'B', NULL, 1),
	(20, 'C', NULL, 1),
	(21, 'A', NULL, 1),
	(22, 'D', NULL, 1),
	(23, 'E', NULL, 1);
/*!40000 ALTER TABLE `cat_tipos_contratos` ENABLE KEYS */;


-- Volcando estructura para tabla nomina_posada.ent_datos_bancarios
CREATE TABLE IF NOT EXISTS `ent_datos_bancarios` (
  `id_dato_bancario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_banco` int(10) unsigned DEFAULT NULL,
  `id_empleado` int(10) unsigned NOT NULL,
  `txt_numero_cuenta` text,
  `txt_clabe` text,
  `b_habilitado` int(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_dato_bancario`),
  KEY `FK_ent_datos_bancarios_cat_bancos` (`id_banco`),
  KEY `FK_ent_datos_bancarios_ent_empleados` (`id_empleado`),
  CONSTRAINT `FK_ent_datos_bancarios_ent_empleados` FOREIGN KEY (`id_empleado`) REFERENCES `ent_empleados` (`id_empleado`) ON DELETE CASCADE,
  CONSTRAINT `FK_ent_datos_bancarios_cat_bancos` FOREIGN KEY (`id_banco`) REFERENCES `cat_bancos` (`id_banco`)
) ENGINE=InnoDB AUTO_INCREMENT=1009 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla nomina_posada.ent_datos_bancarios: ~68 rows (aproximadamente)
/*!40000 ALTER TABLE `ent_datos_bancarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `ent_datos_bancarios` ENABLE KEYS */;


-- Volcando estructura para tabla nomina_posada.ent_empleados
CREATE TABLE IF NOT EXISTS `ent_empleados` (
  `id_empleado` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_sucursal` int(10) unsigned DEFAULT NULL,
  `id_tipo_contrato` int(10) unsigned DEFAULT NULL,
  `id_nomina` int(10) unsigned DEFAULT NULL,
  `txt_nombre` varchar(100) NOT NULL,
  `txt_usuario` varchar(100) DEFAULT NULL,
  `txt_password` varchar(100) DEFAULT NULL,
  `txt_observaciones` text,
  `txt_rfc` varchar(13) DEFAULT NULL,
  `num_empleado` int(10) unsigned DEFAULT NULL,
  `num_seguro_social` varchar(20) DEFAULT NULL,
  `fch_alta` timestamp NULL DEFAULT NULL,
  `fch_baja` timestamp NULL DEFAULT NULL,
  `b_habilitado` int(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_empleado`),
  KEY `FK_ent_empleados_cat_sucursales` (`id_sucursal`),
  KEY `FK_ent_empleados_cat_tipos_contratos` (`id_tipo_contrato`),
  KEY `FK_ent_empleados_cat_nominas` (`id_nomina`),
  CONSTRAINT `FK_ent_empleados_cat_nominas` FOREIGN KEY (`id_nomina`) REFERENCES `cat_nominas` (`id_nomina`),
  CONSTRAINT `FK_ent_empleados_cat_sucursales` FOREIGN KEY (`id_sucursal`) REFERENCES `cat_sucursales` (`id_sucursal`),
  CONSTRAINT `FK_ent_empleados_cat_tipos_contratos` FOREIGN KEY (`id_tipo_contrato`) REFERENCES `cat_tipos_contratos` (`id_tipo_contrato`)
) ENGINE=InnoDB AUTO_INCREMENT=878 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla nomina_posada.ent_empleados: ~68 rows (aproximadamente)
/*!40000 ALTER TABLE `ent_empleados` DISABLE KEYS */;
/*!40000 ALTER TABLE `ent_empleados` ENABLE KEYS */;


-- Volcando estructura para tabla nomina_posada.ent_empleados_contactos
CREATE TABLE IF NOT EXISTS `ent_empleados_contactos` (
  `id_empleado` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `txt_telefono_contacto` varchar(100) DEFAULT NULL,
  `txt_mail_contacto` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_empleado`),
  CONSTRAINT `FK_ent_empleados_contactos_ent_empleados` FOREIGN KEY (`id_empleado`) REFERENCES `ent_empleados` (`id_empleado`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=878 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla nomina_posada.ent_empleados_contactos: ~68 rows (aproximadamente)
/*!40000 ALTER TABLE `ent_empleados_contactos` DISABLE KEYS */;
/*!40000 ALTER TABLE `ent_empleados_contactos` ENABLE KEYS */;


-- Volcando estructura para tabla nomina_posada.mod_usuarios_cat_status_sesiones
CREATE TABLE IF NOT EXISTS `mod_usuarios_cat_status_sesiones` (
  `id_status` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `txt_nombre` varchar(50) NOT NULL COMMENT 'Estatus de la sesión',
  `txt_descripcion` varchar(500) DEFAULT NULL COMMENT 'Descripción del elemento',
  `b_habilitado` int(10) unsigned NOT NULL DEFAULT '1' COMMENT 'Booleano para saber si el registro esta habilitado',
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla nomina_posada.mod_usuarios_cat_status_sesiones: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `mod_usuarios_cat_status_sesiones` DISABLE KEYS */;
INSERT INTO `mod_usuarios_cat_status_sesiones` (`id_status`, `txt_nombre`, `txt_descripcion`, `b_habilitado`) VALUES
	(1, 'Sesión iniciada', 'Sesión se ha iniciado y se encuentra activa', 1),
	(2, 'Sesión finalizada', 'Sesión se ha finalizado correctamente', 1),
	(3, 'Sesión finalizada incorrectamente', 'Sesión se ha finalizado por tiempo de expiración u otro problema', 1);
/*!40000 ALTER TABLE `mod_usuarios_cat_status_sesiones` ENABLE KEYS */;


-- Volcando estructura para tabla nomina_posada.mod_usuarios_cat_status_usuarios
CREATE TABLE IF NOT EXISTS `mod_usuarios_cat_status_usuarios` (
  `id_status` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `txt_nombre` varchar(50) NOT NULL COMMENT 'Estatus del usuario',
  `txt_descripcion` varchar(500) DEFAULT NULL COMMENT 'Descripción del elemento',
  `b_habilitado` int(10) unsigned NOT NULL DEFAULT '1' COMMENT 'Booleano para saber si el registro esta habilitado',
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla nomina_posada.mod_usuarios_cat_status_usuarios: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `mod_usuarios_cat_status_usuarios` DISABLE KEYS */;
INSERT INTO `mod_usuarios_cat_status_usuarios` (`id_status`, `txt_nombre`, `txt_descripcion`, `b_habilitado`) VALUES
	(1, 'Pendiente activacion', 'Usuario se ha registrado pero aún no activa su cuenta', 1),
	(2, 'Usuario activado', 'Usuario ha activado su cuenta', 1),
	(3, 'Usuario bloqueado', 'Usuario bloqueado', 1);
/*!40000 ALTER TABLE `mod_usuarios_cat_status_usuarios` ENABLE KEYS */;


-- Volcando estructura para tabla nomina_posada.mod_usuarios_cat_tipos_usuarios
CREATE TABLE IF NOT EXISTS `mod_usuarios_cat_tipos_usuarios` (
  `id_tipo_usuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `txt_nombre` varchar(100) NOT NULL,
  `txt_descripcion` varchar(500) DEFAULT NULL,
  `b_habilitado` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla nomina_posada.mod_usuarios_cat_tipos_usuarios: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `mod_usuarios_cat_tipos_usuarios` DISABLE KEYS */;
INSERT INTO `mod_usuarios_cat_tipos_usuarios` (`id_tipo_usuario`, `txt_nombre`, `txt_descripcion`, `b_habilitado`) VALUES
	(3, 'Usuario Administrador', NULL, 1),
	(4, 'Usuario captura', NULL, 1);
/*!40000 ALTER TABLE `mod_usuarios_cat_tipos_usuarios` ENABLE KEYS */;


-- Volcando estructura para tabla nomina_posada.mod_usuarios_ent_sesiones
CREATE TABLE IF NOT EXISTS `mod_usuarios_ent_sesiones` (
  `id_sesion` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` int(10) unsigned NOT NULL COMMENT 'Id del usuario que inicio sesión',
  `id_status` int(10) unsigned NOT NULL DEFAULT '1' COMMENT 'Status de la sesión',
  `fch_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que el usuario inicio sesión',
  `fch_logout` timestamp NULL DEFAULT NULL COMMENT 'Fecha en la que el usuario finalizo la sesión',
  `num_minutos_sesion` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Minutos que duraro la sesión del usuario',
  `txt_ip` varchar(32) NOT NULL COMMENT 'Ip de donde se conecto el usuario',
  `txt_ip_logout` varchar(32) DEFAULT NULL COMMENT 'Ip de donde el usuario se desconecto',
  PRIMARY KEY (`id_sesion`),
  KEY `FK_ent_sesiones_cat_status_sesiones` (`id_status`),
  KEY `FK_ent_sesiones_ent_usuarios` (`id_usuario`),
  CONSTRAINT `FK_ent_sesiones_cat_status_sesiones` FOREIGN KEY (`id_status`) REFERENCES `mod_usuarios_cat_status_sesiones` (`id_status`),
  CONSTRAINT `FK_ent_sesiones_ent_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `mod_usuarios_ent_usuarios` (`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla nomina_posada.mod_usuarios_ent_sesiones: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `mod_usuarios_ent_sesiones` DISABLE KEYS */;
/*!40000 ALTER TABLE `mod_usuarios_ent_sesiones` ENABLE KEYS */;


-- Volcando estructura para tabla nomina_posada.mod_usuarios_ent_usuarios
CREATE TABLE IF NOT EXISTS `mod_usuarios_ent_usuarios` (
  `id_usuario` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_tipo_usuario` int(11) unsigned DEFAULT NULL,
  `txt_token` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `txt_username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `txt_apellido_paterno` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_apellido_materno` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `txt_password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `txt_password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txt_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fch_creacion` datetime DEFAULT NULL,
  `fch_actualizacion` datetime DEFAULT NULL,
  `id_status` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `username` (`txt_username`),
  UNIQUE KEY `email` (`txt_email`),
  UNIQUE KEY `txt_token` (`txt_token`),
  UNIQUE KEY `password_reset_token` (`txt_password_reset_token`),
  KEY `FK_ent_usuarios_cat_status_usuarios` (`id_status`),
  KEY `FK_mod_usuarios_ent_usuarios_mod_usuarios_cat_tipos_usuarios` (`id_tipo_usuario`),
  CONSTRAINT `FK_ent_usuarios_cat_status_usuarios` FOREIGN KEY (`id_status`) REFERENCES `mod_usuarios_cat_status_usuarios` (`id_status`) ON DELETE CASCADE,
  CONSTRAINT `FK_mod_usuarios_ent_usuarios_mod_usuarios_cat_tipos_usuarios` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `mod_usuarios_cat_tipos_usuarios` (`id_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla nomina_posada.mod_usuarios_ent_usuarios: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `mod_usuarios_ent_usuarios` DISABLE KEYS */;
INSERT INTO `mod_usuarios_ent_usuarios` (`id_usuario`, `id_tipo_usuario`, `txt_token`, `txt_username`, `txt_apellido_paterno`, `txt_apellido_materno`, `txt_auth_key`, `txt_password_hash`, `txt_password_reset_token`, `txt_email`, `fch_creacion`, `fch_actualizacion`, `id_status`) VALUES
	(18, 3, 'usr4b41842f47272f78d0b8dcff7b11f30257abb1fe02b62', 'humberto', 'Antonio', 'Marquez', 'HGYeSCW_BQp-CoB3tL0C2IHhXreFwdVC', '$2y$13$kNbIAJ8FG4jkyeuqtUcfA.CwK7k7oMxVDSyQiGQ0Y7o8h4zGWPVTe', NULL, '2GomDev@2gom.com.mx', '2016-08-10 18:00:14', NULL, 2);
/*!40000 ALTER TABLE `mod_usuarios_ent_usuarios` ENABLE KEYS */;


-- Volcando estructura para tabla nomina_posada.mod_usuarios_ent_usuarios_activacion
CREATE TABLE IF NOT EXISTS `mod_usuarios_ent_usuarios_activacion` (
  `id_usuario_activacion` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` int(10) unsigned NOT NULL,
  `txt_token` varchar(60) NOT NULL,
  `txt_ip_activacion` varchar(60) DEFAULT NULL,
  `fch_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fch_activacion` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_usuario_activacion`),
  UNIQUE KEY `txt_token` (`txt_token`),
  KEY `FK_ent_usuarios_activacion_ent_usuarios` (`id_usuario`),
  CONSTRAINT `FK_ent_usuarios_activacion_ent_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `mod_usuarios_ent_usuarios` (`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla nomina_posada.mod_usuarios_ent_usuarios_activacion: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `mod_usuarios_ent_usuarios_activacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `mod_usuarios_ent_usuarios_activacion` ENABLE KEYS */;


-- Volcando estructura para tabla nomina_posada.mod_usuarios_ent_usuarios_cambio_pass
CREATE TABLE IF NOT EXISTS `mod_usuarios_ent_usuarios_cambio_pass` (
  `id_usuario_cambio_pass` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` int(10) unsigned NOT NULL,
  `txt_token` varchar(60) NOT NULL COMMENT 'Token del registro',
  `txt_ip` varchar(20) NOT NULL COMMENT 'Ip del usuario donde pidio el cambio de pass',
  `txt_ip_cambio` varchar(20) DEFAULT NULL COMMENT 'Ip del usuario donde cambio el pass',
  `fch_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de creacion de registro',
  `fch_finalizacion` timestamp NULL DEFAULT NULL COMMENT 'Fecha de expiracion de la solicitud de cambio de pass',
  `fch_peticion_usada` timestamp NULL DEFAULT NULL COMMENT 'Fecha en la cual se utilizo la peticion',
  `b_usado` int(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Booleano para saber si el usuario ha usado la peticion',
  PRIMARY KEY (`id_usuario_cambio_pass`),
  KEY `FK_ent_usuarios_cambio_pass_ent_usuarios` (`id_usuario`),
  CONSTRAINT `FK_ent_usuarios_cambio_pass_ent_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `mod_usuarios_ent_usuarios` (`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla nomina_posada.mod_usuarios_ent_usuarios_cambio_pass: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `mod_usuarios_ent_usuarios_cambio_pass` DISABLE KEYS */;
/*!40000 ALTER TABLE `mod_usuarios_ent_usuarios_cambio_pass` ENABLE KEYS */;


-- Volcando estructura para tabla nomina_posada.mod_usuarios_ent_usuarios_facebook
CREATE TABLE IF NOT EXISTS `mod_usuarios_ent_usuarios_facebook` (
  `id_usuario_facebook` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` int(10) unsigned NOT NULL,
  `id_facebook` bigint(20) NOT NULL,
  `txt_url_photo` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id_usuario_facebook`),
  UNIQUE KEY `id_usuario` (`id_usuario`),
  UNIQUE KEY `id_facebook` (`id_facebook`),
  CONSTRAINT `FK_ent_usuarios_facebook_ent_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `mod_usuarios_ent_usuarios` (`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla nomina_posada.mod_usuarios_ent_usuarios_facebook: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `mod_usuarios_ent_usuarios_facebook` DISABLE KEYS */;
/*!40000 ALTER TABLE `mod_usuarios_ent_usuarios_facebook` ENABLE KEYS */;


-- Volcando estructura para vista nomina_posada.view_empleado_completo
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `view_empleado_completo` (
	`id_empleado` INT(10) UNSIGNED NOT NULL,
	`id_sucursal` INT(10) UNSIGNED NULL,
	`id_tipo_contrato` INT(10) UNSIGNED NULL,
	`id_nomina` INT(10) UNSIGNED NULL,
	`txt_nombre` VARCHAR(100) NOT NULL COLLATE 'utf8_general_ci',
	`txt_observaciones` TEXT NULL COLLATE 'utf8_general_ci',
	`txt_rfc` VARCHAR(13) NULL COLLATE 'utf8_general_ci',
	`num_empleado` INT(10) UNSIGNED NULL,
	`num_seguro_social` VARCHAR(20) NULL COLLATE 'utf8_general_ci',
	`fch_alta` TIMESTAMP NULL,
	`fch_baja` TIMESTAMP NULL,
	`b_habilitado` INT(1) UNSIGNED NOT NULL,
	`txt_telefono_contacto` VARCHAR(100) NULL COLLATE 'utf8_general_ci',
	`txt_mail_contacto` VARCHAR(100) NULL COLLATE 'utf8_general_ci',
	`id_dato_bancario` INT(10) UNSIGNED NULL,
	`dba_nombre` INT(10) UNSIGNED NULL,
	`txt_numero_cuenta` TEXT NULL COLLATE 'utf8_general_ci',
	`txt_clabe` TEXT NULL COLLATE 'utf8_general_ci',
	`decc_id_nomina` INT(10) UNSIGNED NULL,
	`decc_txt_concepto` VARCHAR(200) NULL COLLATE 'utf8_general_ci',
	`pagos_monto` DOUBLE NULL,
	`pex_id_nomina` INT(10) UNSIGNED NULL,
	`pex_txt_concepto` VARCHAR(200) NULL COLLATE 'utf8_general_ci',
	`extra_monto` DOUBLE NULL,
	`pem_id_banco` INT(10) UNSIGNED NULL,
	`pem_id_nomina` INT(10) UNSIGNED NULL,
	`pem_id_sucursal` INT(10) UNSIGNED NULL,
	`pem_tipo_dato` INT(10) UNSIGNED NULL,
	`fch_pago` TIMESTAMP NULL
) ENGINE=MyISAM;


-- Volcando estructura para vista nomina_posada.view_pagos
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `view_pagos` (
	`fch_pago` TIMESTAMP NOT NULL
) ENGINE=MyISAM;


-- Volcando estructura para tabla nomina_posada.wrk_deducciones_empleado
CREATE TABLE IF NOT EXISTS `wrk_deducciones_empleado` (
  `id_deduccion_empleado` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_empleado` int(10) unsigned NOT NULL,
  `id_nomina` int(10) unsigned NOT NULL,
  `txt_concepto` varchar(200) NOT NULL,
  `num_monto` double unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_deduccion_empleado`),
  KEY `FK_wrk_deducciones_empleado_ent_empleados` (`id_empleado`),
  KEY `FK_wrk_deducciones_empleado_cat_nominas` (`id_nomina`),
  CONSTRAINT `FK_wrk_deducciones_empleado_cat_nominas` FOREIGN KEY (`id_nomina`) REFERENCES `wrk_pagos_empleados` (`id_pago_empleado`) ON DELETE CASCADE,
  CONSTRAINT `FK_wrk_deducciones_empleado_ent_empleados` FOREIGN KEY (`id_empleado`) REFERENCES `ent_empleados` (`id_empleado`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=273 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla nomina_posada.wrk_deducciones_empleado: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wrk_deducciones_empleado` DISABLE KEYS */;
/*!40000 ALTER TABLE `wrk_deducciones_empleado` ENABLE KEYS */;


-- Volcando estructura para tabla nomina_posada.wrk_pagos_empleados
CREATE TABLE IF NOT EXISTS `wrk_pagos_empleados` (
  `id_pago_empleado` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_empleado` int(10) unsigned NOT NULL,
  `id_banco` int(10) unsigned DEFAULT NULL,
  `id_nomina` int(10) unsigned DEFAULT NULL,
  `id_sucursal` int(10) unsigned DEFAULT NULL,
  `id_tipo_contrato` int(10) unsigned DEFAULT NULL,
  `num_dias_trabajados` int(10) unsigned NOT NULL DEFAULT '0',
  `num_sueldo` double unsigned NOT NULL DEFAULT '0',
  `num_total_sueldo_fijo` double unsigned NOT NULL DEFAULT '0',
  `num_facturacion` double unsigned NOT NULL DEFAULT '0',
  `fch_pago` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_pago_empleado`),
  KEY `FK_wrk_pagos_empleados_cat_bancos` (`id_banco`),
  KEY `FK_wrk_pagos_empleados_cat_sucursales` (`id_sucursal`),
  KEY `FK_wrk_pagos_empleados_cat_tipos_contratos` (`id_tipo_contrato`),
  KEY `FK_wrk_pagos_empleados_cat_nominas` (`id_nomina`),
  KEY `FK_wrk_pagos_empleados_ent_empleados` (`id_empleado`),
  CONSTRAINT `FK_wrk_pagos_empleados_ent_empleados` FOREIGN KEY (`id_empleado`) REFERENCES `ent_empleados` (`id_empleado`) ON DELETE CASCADE,
  CONSTRAINT `FK_wrk_pagos_empleados_cat_bancos` FOREIGN KEY (`id_banco`) REFERENCES `cat_bancos` (`id_banco`),
  CONSTRAINT `FK_wrk_pagos_empleados_cat_nominas` FOREIGN KEY (`id_nomina`) REFERENCES `cat_nominas` (`id_nomina`),
  CONSTRAINT `FK_wrk_pagos_empleados_cat_sucursales` FOREIGN KEY (`id_sucursal`) REFERENCES `cat_sucursales` (`id_sucursal`),
  CONSTRAINT `FK_wrk_pagos_empleados_cat_tipos_contratos` FOREIGN KEY (`id_tipo_contrato`) REFERENCES `cat_tipos_contratos` (`id_tipo_contrato`)
) ENGINE=InnoDB AUTO_INCREMENT=744 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla nomina_posada.wrk_pagos_empleados: ~68 rows (aproximadamente)
/*!40000 ALTER TABLE `wrk_pagos_empleados` DISABLE KEYS */;
/*!40000 ALTER TABLE `wrk_pagos_empleados` ENABLE KEYS */;


-- Volcando estructura para tabla nomina_posada.wrk_pagos_extras
CREATE TABLE IF NOT EXISTS `wrk_pagos_extras` (
  `id_pago_extra` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_empleado` int(10) unsigned NOT NULL,
  `id_nomina` int(10) unsigned NOT NULL,
  `txt_concepto` varchar(200) NOT NULL,
  `num_monto` double unsigned NOT NULL DEFAULT '0',
  `b_deposito` int(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_pago_extra`),
  KEY `FK__ent_empleados` (`id_empleado`),
  KEY `FK__cat_nominas` (`id_nomina`),
  CONSTRAINT `FK__cat_nominas` FOREIGN KEY (`id_nomina`) REFERENCES `wrk_pagos_empleados` (`id_pago_empleado`) ON DELETE CASCADE,
  CONSTRAINT `FK__ent_empleados` FOREIGN KEY (`id_empleado`) REFERENCES `ent_empleados` (`id_empleado`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1247 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla nomina_posada.wrk_pagos_extras: ~204 rows (aproximadamente)
/*!40000 ALTER TABLE `wrk_pagos_extras` DISABLE KEYS */;
/*!40000 ALTER TABLE `wrk_pagos_extras` ENABLE KEYS */;


-- Volcando estructura para vista nomina_posada.view_empleado_completo
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `view_empleado_completo`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `nomina_posada`.`view_empleado_completo` AS select `em`.`id_empleado` AS `id_empleado`,`em`.`id_sucursal` AS `id_sucursal`,`em`.`id_tipo_contrato` AS `id_tipo_contrato`,`em`.`id_nomina` AS `id_nomina`,`em`.`txt_nombre` AS `txt_nombre`,`em`.`txt_observaciones` AS `txt_observaciones`,`em`.`txt_rfc` AS `txt_rfc`,`em`.`num_empleado` AS `num_empleado`,`em`.`num_seguro_social` AS `num_seguro_social`,`em`.`fch_alta` AS `fch_alta`,`em`.`fch_baja` AS `fch_baja`,`em`.`b_habilitado` AS `b_habilitado`,`cont`.`txt_telefono_contacto` AS `txt_telefono_contacto`,`cont`.`txt_mail_contacto` AS `txt_mail_contacto`,`dba`.`id_dato_bancario` AS `id_dato_bancario`,`dba`.`id_banco` AS `dba_nombre`,`dba`.`txt_numero_cuenta` AS `txt_numero_cuenta`,`dba`.`txt_clabe` AS `txt_clabe`,`decc`.`id_nomina` AS `decc_id_nomina`,`decc`.`txt_concepto` AS `decc_txt_concepto`,`decc`.`num_monto` AS `pagos_monto`,`pex`.`id_nomina` AS `pex_id_nomina`,`pex`.`txt_concepto` AS `pex_txt_concepto`,`pex`.`num_monto` AS `extra_monto`,`pem`.`id_banco` AS `pem_id_banco`,`pem`.`id_nomina` AS `pem_id_nomina`,`pem`.`id_sucursal` AS `pem_id_sucursal`,`pem`.`id_tipo_contrato` AS `pem_tipo_dato`,`pem`.`fch_pago` AS `fch_pago` from (((((`ent_empleados` `em` left join `ent_empleados_contactos` `cont` on((`cont`.`id_empleado` = `em`.`id_empleado`))) left join `ent_datos_bancarios` `dba` on(((`dba`.`id_empleado` = `em`.`id_empleado`) and (`dba`.`b_habilitado` = 1)))) left join `wrk_pagos_empleados` `pem` on((`pem`.`id_empleado` = `em`.`id_empleado`))) left join `wrk_deducciones_empleado` `decc` on((`decc`.`id_empleado` = `em`.`id_empleado`))) left join `wrk_pagos_extras` `pex` on(((`pex`.`id_empleado` = `em`.`id_empleado`) and (`pex`.`id_nomina` = `pem`.`id_pago_empleado`)))) ;


-- Volcando estructura para vista nomina_posada.view_pagos
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `view_pagos`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `nomina_posada`.`view_pagos` AS SELECT fch_pago FROM wrk_pagos_empleados
group by fch_pago ;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
