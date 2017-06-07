/*
Navicat MySQL Data Transfer

Source Server         : LOCAL - MAQUINA DESARROLLO
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : tarjetas

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-02-22 16:50:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for afiliados
-- ----------------------------
DROP TABLE IF EXISTS `afiliados`;
CREATE TABLE `afiliados` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `clientes_id` int(10) unsigned NOT NULL,
  `empresa` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `producto_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `propuesta` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `apellido_paterno` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `apellido_materno` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nombre_uno` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nombre_dos` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sexo_id` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `ff_nacimiento` date NOT NULL,
  `documento_id` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `nro_documento` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `co_afiliado` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `categoria_id` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `ff_venta` date NOT NULL,
  `ff_afiliacion` date NOT NULL,
  `programa_id` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `edad` int(11) NOT NULL,
  `fumadore_id` int(11) NOT NULL,
  `tarifa` int(20) NOT NULL,
  `direccion` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `ubigeo_id` int(10) unsigned NOT NULL,
  `co_postal` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `celular` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `correo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prov_id` int(10) unsigned NOT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `dpto_id` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `tipopago_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `afiliados_producto_id_foreign` (`producto_id`),
  KEY `afiliados_sexo_id_foreign` (`sexo_id`),
  KEY `afiliados_documento_id_foreign` (`documento_id`),
  KEY `afiliados_categoria_id_foreign` (`categoria_id`),
  KEY `afiliados_programa_id_foreign` (`programa_id`),
  KEY `afiliados_fumadore_id_foreign` (`fumadore_id`),
  KEY `afiliados_ubigeo_id_foreign` (`ubigeo_id`),
  KEY `afiliados_status_id_foreign` (`status_id`),
  KEY `afiliados_clientes_id_foreign` (`clientes_id`),
  KEY `afiliados_dpto_id_foreign` (`dpto_id`),
  KEY `afiliados_prov_id_foreign` (`prov_id`),
  KEY `afiliados_tipopago_id_foreign` (`tipopago_id`),
  CONSTRAINT `afiliados_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`),
  CONSTRAINT `afiliados_clientes_id_foreign` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`id`),
  CONSTRAINT `afiliados_documento_id_foreign` FOREIGN KEY (`documento_id`) REFERENCES `documentos` (`id`),
  CONSTRAINT `afiliados_dpto_id_foreign` FOREIGN KEY (`dpto_id`) REFERENCES `dptos` (`id`),
  CONSTRAINT `afiliados_fumadore_id_foreign` FOREIGN KEY (`fumadore_id`) REFERENCES `fumadores` (`id`),
  CONSTRAINT `afiliados_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`),
  CONSTRAINT `afiliados_programa_id_foreign` FOREIGN KEY (`programa_id`) REFERENCES `programas` (`id`),
  CONSTRAINT `afiliados_prov_id_foreign` FOREIGN KEY (`prov_id`) REFERENCES `provs` (`id`),
  CONSTRAINT `afiliados_sexo_id_foreign` FOREIGN KEY (`sexo_id`) REFERENCES `sexos` (`id`),
  CONSTRAINT `afiliados_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  CONSTRAINT `afiliados_tipopago_id_foreign` FOREIGN KEY (`tipopago_id`) REFERENCES `tipopagos` (`id`),
  CONSTRAINT `afiliados_ubigeo_id_foreign` FOREIGN KEY (`ubigeo_id`) REFERENCES `ubigeos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of afiliados
-- ----------------------------

-- ----------------------------
-- Table structure for agencias
-- ----------------------------
DROP TABLE IF EXISTS `agencias`;
CREATE TABLE `agencias` (
  `id` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `nb_agencia` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `agencias_status_id_foreign` (`status_id`),
  CONSTRAINT `agencias_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of agencias
-- ----------------------------
INSERT INTO `agencias` VALUES ('111111', 'agencia 1', '1', '2017-02-02 13:32:55', null);
INSERT INTO `agencias` VALUES ('222222', 'agencia 2', '1', '2017-02-02 13:32:58', null);

-- ----------------------------
-- Table structure for agendamientos
-- ----------------------------
DROP TABLE IF EXISTS `agendamientos`;
CREATE TABLE `agendamientos` (
  `id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nro` int(11) NOT NULL,
  `ff_agendado` date NOT NULL,
  `hh_agendado` time NOT NULL,
  `ff_hh_agendado` datetime NOT NULL,
  `clientes_id` int(10) unsigned NOT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `agendamientos_clientes_id_foreign` (`clientes_id`),
  KEY `agendamientos_status_id_foreign` (`status_id`),
  CONSTRAINT `agendamientos_clientes_id_foreign` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`id`),
  CONSTRAINT `agendamientos_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of agendamientos
-- ----------------------------
INSERT INTO `agendamientos` VALUES ('011111111', '1', '2017-03-03', '01:07:33', '2017-03-03 01:07:36', '17', '1', '2017-02-08 05:50:32', '2017-02-08 05:50:32');
INSERT INTO `agendamientos` VALUES ('0212323', '1', '2017-02-08', '05:00:00', '2017-02-08 05:00:00', '66', '1', '2017-02-03 06:04:46', '2017-02-03 06:04:46');
INSERT INTO `agendamientos` VALUES ('02123473517', '1', '2017-02-04', '15:30:00', '2017-02-04 15:30:00', '67', '1', '2017-02-03 05:21:50', '2017-02-03 05:21:50');
INSERT INTO `agendamientos` VALUES ('02123483748', '1', '2017-02-23', '20:30:00', '2017-02-23 20:30:00', '71', '1', '2017-02-03 09:16:58', '2017-02-03 09:16:58');
INSERT INTO `agendamientos` VALUES ('992773354', '1', '2017-02-09', '05:15:00', '2017-02-09 05:15:00', '67', '1', '2017-02-03 09:29:01', '2017-02-03 09:29:01');
INSERT INTO `agendamientos` VALUES ('997340043', '2', '2017-03-01', '01:00:00', '2017-03-01 01:00:00', '17', '1', '2017-02-08 04:50:32', '2017-02-08 05:04:29');

-- ----------------------------
-- Table structure for aperturas
-- ----------------------------
DROP TABLE IF EXISTS `aperturas`;
CREATE TABLE `aperturas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `toque_apertura` int(11) NOT NULL,
  `tpfnivel1_id` int(10) unsigned NOT NULL,
  `tpfnivel2_id` int(10) unsigned DEFAULT NULL,
  `tpfnivel3_id` int(10) unsigned DEFAULT NULL,
  `tpfnivel4_id` int(10) unsigned DEFAULT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `aperturas_tpfnivel1_id_foreign` (`tpfnivel1_id`),
  KEY `aperturas_tpfnivel2_id_foreign` (`tpfnivel2_id`),
  KEY `aperturas_tpfnivel3_id_foreign` (`tpfnivel3_id`),
  KEY `aperturas_tpfnivel4_id_foreign` (`tpfnivel4_id`),
  KEY `aperturas_status_id_foreign` (`status_id`),
  CONSTRAINT `aperturas_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  CONSTRAINT `aperturas_tpfnivel1_id_foreign` FOREIGN KEY (`tpfnivel1_id`) REFERENCES `tpfnivel1` (`id`),
  CONSTRAINT `aperturas_tpfnivel2_id_foreign` FOREIGN KEY (`tpfnivel2_id`) REFERENCES `tpfnivel2` (`id`),
  CONSTRAINT `aperturas_tpfnivel3_id_foreign` FOREIGN KEY (`tpfnivel3_id`) REFERENCES `tpfnivel3` (`id`),
  CONSTRAINT `aperturas_tpfnivel4_id_foreign` FOREIGN KEY (`tpfnivel4_id`) REFERENCES `tpfnivel4` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of aperturas
-- ----------------------------
INSERT INTO `aperturas` VALUES ('1', '4', '1', '1', '1', null, '1', '2017-01-30 20:56:28', '2017-01-30 20:56:30');

-- ----------------------------
-- Table structure for categorias
-- ----------------------------
DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
  `id` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `nb_categoria` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categorias_status_id_foreign` (`status_id`),
  CONSTRAINT `categorias_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of categorias
-- ----------------------------
INSERT INTO `categorias` VALUES ('01', 'Titular', '1', '2017-01-26 09:59:33', '2017-01-26 09:59:33');
INSERT INTO `categorias` VALUES ('80', 'Otros', '1', '2017-01-26 09:59:33', '2017-01-26 09:59:33');

-- ----------------------------
-- Table structure for clientes
-- ----------------------------
DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` int(10) unsigned DEFAULT NULL,
  `cliente` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `apellido_paterno` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `apellido_materno` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sexo` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `edad` int(11) NOT NULL,
  `fecha_nacimiento` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `documento` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` mediumtext COLLATE utf8_unicode_ci,
  `dpto` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `provincia` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `distrito` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entidad` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `linea_credito` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono1` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `telefono2` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono3` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono4` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono5` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `correo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `clientes_status_id_foreign` (`status_id`),
  KEY `clientes_users_id_foreign` (`users_id`),
  CONSTRAINT `clientes_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  CONSTRAINT `clientes_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of clientes
-- ----------------------------
INSERT INTO `clientes` VALUES ('1', null, 'DIAZ MURRUGARRA, JEANNETE MARGARITA - PRUEBA', '', '', '', '0', '', '19254852', 'direccionsaa', 'departamento', 'provincia', 'distrito', '', 'credito', '956748032', '34213', '021234523', '02121150304', '021234585832', '2017-01-27', '', '0', '2017-01-27 13:39:36', '2017-02-02 04:51:24');
INSERT INTO `clientes` VALUES ('2', null, 'VELIZ SOTO MARIA ESTRELLA DEL CARMEN', '', '', '', '0', '', '46995329', 'su casa', '', '', '', '', '', '956748072', '3343434', '0424123746', '02123473517', '34324324324324', '2017-01-27', '', '0', '2017-01-27 13:39:36', '2017-02-01 15:27:06');
INSERT INTO `clientes` VALUES ('4', null, 'GUZMAN ARROYO YHON ROBER', '', '', '', '0', '', '7893140', 'mi casa', '', '', '', '', '', '989345156', '4545', '434343', '343434', '323232', '2017-01-27', '', '0', '2017-01-27 13:39:36', '2017-02-02 05:04:38');
INSERT INTO `clientes` VALUES ('5', null, 'TATINA', '', '', '', '0', '', '44115252', 'AV PARTICIPACION 510ALTURA CUADRA 5 CON CALLE ZARAGOZA', null, null, null, '', null, '979292129', '1263650', '1263650', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', '2017-02-02 11:34:49');
INSERT INTO `clientes` VALUES ('6', null, 'LAYA', '', '', '', '0', '', '79404975', 'AV PARTICIPACION 510 ALTURA CUADRA 5 CON CALLE ZARAGOZA', null, null, null, '', null, '979292129', '1263650', '1263650', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', '2017-02-02 12:56:50');
INSERT INTO `clientes` VALUES ('7', null, 'AGUSTIN', '', '', '', '0', '', '41796437', 'AV PARTICIPACION 510 ALTURA CUADRA 5 CON CALLE ZARAGOZA', null, null, null, '', null, '949598322', '1263650', '1263650', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', '2017-02-02 19:48:43');
INSERT INTO `clientes` VALUES ('8', null, 'MARTHA', '', '', '', '0', '', '07621209', 'AVENIDA 28 DE JULIO 314 DEPARTAMENTO 203 ESQUINA CALLE OCHARAN', null, null, null, '', null, '992546650', '22222222', '22222222', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', '2017-02-02 11:40:05');
INSERT INTO `clientes` VALUES ('9', null, 'JAMES', '', '', '', '0', '', '62020922', 'CALLE CHAVIN 277  REF AL COSTADO DEL DIARIO LA VERDAD DEL PUEBLO', null, null, null, '', null, '943539052', '1111111', '1111111', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', '2017-02-02 19:50:23');
INSERT INTO `clientes` VALUES ('10', null, 'JAMES', '', '', '', '0', '', '42741576', 'CALLE CHAVIN 277  REF AL COSTADO DEL DIARIO LA VERDAD DEL PUEBLO', null, null, null, '', null, '943539052', '1111111', '1111111', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', '2017-02-02 20:07:40');
INSERT INTO `clientes` VALUES ('11', null, 'JANE NICOLE', '', '', '', '0', '', '79302728', 'CALLE CHAVIN 277  REF AL COSTADO DEL DIARIO LA VERDAD DEL PUEBLO', null, null, null, '', null, '943539052', '1111111', '1111111', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', '2017-02-02 20:08:34');
INSERT INTO `clientes` VALUES ('12', null, 'JOHANN', '', '', '', '0', '', '72163703', 'AV. FLORA TRISTAN 506 TABLADA DE LURIN REF. AL COSTADO DE LA POSTA MEDICA. VMT', null, null, null, '', null, '992660116', '4444444', '4444444', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', '2017-02-02 21:05:51');
INSERT INTO `clientes` VALUES ('13', null, 'DAVID', '', '', '', '0', '', '72180132', 'AV. FLORA TRISTAN 506 TABLADA DE LURIN REF. AL COSTADO DE LA POSTA MEDICA. VMT', null, null, null, '', null, '992660116', '4444444', '4444444', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', '2017-02-02 21:08:28');
INSERT INTO `clientes` VALUES ('14', null, 'EDUARDO', '', '', '', '0', '', '72163686', 'AV. FLORA TRISTAN 506 TABLADA DE LURIN REF. AL COSTADO DE LA POSTA MEDICA. VMT', null, null, null, '', null, '992660116', '4444444', '4444444', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', '2017-02-02 21:09:22');
INSERT INTO `clientes` VALUES ('15', null, 'LUZ', '', '', '', '0', '', '75767274', 'JIRON PALCAMARCA 334 URBANIZACION TUPAC AMARU PAYET', null, null, null, '', null, '992986381', '111111111', '111111111', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', '2017-02-02 21:11:05');
INSERT INTO `clientes` VALUES ('16', null, 'NELLY', '', '', '', '0', '', '42317907', 'AV LIBERTAD 2432 2436 SAN MIGUEL ALT CDRA 23 AV LA PAZ DE SAN MIGUE', null, null, null, '', null, '997340043', '011111111', '011111111', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', '2017-02-02 21:11:46');
INSERT INTO `clientes` VALUES ('17', '2', 'JOSE', '', '', '', '0', '', '09643504', 'AV LIBERTAD 2432 2436 SAN MIGUEL ALT CDRA 23 AV LA PAZ DE SAN MIGUEL', null, null, null, '', null, '997340043', '011111111', '011111111', null, null, '2017-01-27', '', '5', '2017-01-27 13:39:36', '2017-02-08 05:04:19');
INSERT INTO `clientes` VALUES ('18', '2', 'ALEXANDER', '', '', '', '0', '', '09743990', 'URB PARIACHI MZ P LT 37 TERCERA ETAPA ATE VITARTE ALT PARQUE CENTRAL 7', null, null, null, '', null, '983450144', '44444444', '44444444', null, null, '2017-01-27', '', '3', '2017-01-27 13:39:36', '2017-02-08 01:27:58');
INSERT INTO `clientes` VALUES ('19', '2', 'JERSON', '', '', '', '0', '', '71769487', 'URB PARIACHI MZ P LT 37 TERCERA ETAPA ATE VITARTE ALT PARQUE CENTRAL 7', null, null, null, '', null, '983450144', '44444444', '4444444', null, null, '2017-01-27', '', '3', '2017-01-27 13:39:36', '2017-02-08 01:27:51');
INSERT INTO `clientes` VALUES ('20', '2', 'MILAGROS', '', '', '', '0', '', '10064085', 'URB PARIACHI MZ P LT 37 TERCERA ETAPA ATE VITARTE ALT PARQUE CENTRAL 7', null, null, null, '', null, '983450144', '44444444', '4444444', null, null, '2017-01-27', '', '3', '2017-01-27 13:39:36', '2017-02-03 09:10:41');
INSERT INTO `clientes` VALUES ('21', '2', 'RENATTO', '', '', '', '0', '', '71221097', 'AV. JP. OESTE 315 DTO.902 REF. A 3 CUADRAS DE LA AV. BRASIL  MAGDALENA', null, null, null, '', null, '999952987', '4444444', '4444444', null, null, '2017-01-27', '', '3', '2017-01-27 13:39:36', '2017-02-03 05:59:29');
INSERT INTO `clientes` VALUES ('22', '2', 'HUGO', '', '', '', '0', '', '71221097', 'AV. JAVIER PRADO OESTE 315 DTO.902 REF. A 3 CUADRAS DE LA AV. BRASIL  MAGDALENA', null, null, null, '', null, '999952987', '4444444', '4444444', null, null, '2017-01-27', '', '3', '2017-01-27 13:39:36', '2017-02-03 05:59:29');
INSERT INTO `clientes` VALUES ('23', '2', 'ANDRES', '', '', '', '0', '', '42638617', 'AV CARLOS VILLARAN 140 TORRE INTERBANK PISO 3 TORRE B', null, null, null, '', null, '989127576', '4444444', '4444444', null, null, '2017-01-27', '', '3', '2017-01-27 13:39:36', '2017-02-03 05:59:29');
INSERT INTO `clientes` VALUES ('24', '2', 'MONICA', '', '', '', '0', '', '08274507', 'AV SAN BORJA SUR 1158 DPTO 302', null, null, null, '', null, '955702370', '000000000', '000000000', null, null, '2017-01-27', '', '3', '2017-01-27 13:39:36', '2017-02-03 05:59:29');
INSERT INTO `clientes` VALUES ('25', '2', 'JORGE', '', '', '', '0', '', '62600109', 'AV SAN BORJA SUR 1158 DPTO 302', null, null, null, '', null, '955702370', '000000000', '000000000', '02123473517', null, '2017-01-27', '', '3', '2017-01-27 13:39:36', '2017-02-03 05:59:29');
INSERT INTO `clientes` VALUES ('26', '2', 'JOSE', '', '', '', '0', '', '70314466', 'CAMINARTU@GMAIL.COM', null, null, null, '', null, '955702370', '000000000', '000000000', '02121133989', null, '2017-01-27', '', '3', '2017-01-27 13:39:36', '2017-02-03 05:59:29');
INSERT INTO `clientes` VALUES ('27', null, 'JUAN', '', '', '', '0', '', '41764601', 'CALLE ROSARIO NUMERO 300 GROCIO PRADO', null, null, null, '', null, '956995524', '956563707', '956563707', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', null);
INSERT INTO `clientes` VALUES ('28', null, 'DARWIN', '', '', '', '0', '', '62487562', 'CALLE ROSARIO NUMERO 300 GROCIO PRADO', null, null, null, '', null, '956995524', '956563707', '956563707', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', null);
INSERT INTO `clientes` VALUES ('29', null, 'DIANA', '', '', '', '0', '', '41137561', 'CALLE ROSARIO NUMERO 300 GROCIO PRADO', null, null, null, '', null, '956995524', '956563707', '956563707', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', null);
INSERT INTO `clientes` VALUES ('30', null, 'HIRWIN', '', '', '', '0', '', '72624785', 'CALLE ROSARIO NUMERO 300 GROCIO PRADO', null, null, null, '', null, '956995524', '956563707', '956563707', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', null);
INSERT INTO `clientes` VALUES ('31', null, 'LILIANA', '', '', '', '0', '', '18074040', 'MZ C LT 10 AA HH LADERAS DE CHILLON 1ERA EXPLANADA REF A MEDIA CUADRA DE POSTA MEDIA DE LADERAS DE CHILLON ENTRANDO POR CHANGRILA', null, null, null, '', null, '993868554', '111111111', '111111111', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', null);
INSERT INTO `clientes` VALUES ('32', null, 'JESUS', '', '', '', '0', '', '42120097', 'AV 5 DE ABRIL MZ 8 LT 7 SEKEDA SECTOR 2  REF FRENTE A LA POSTA MEDICA', null, null, null, '', null, '949741938', '010000000', '010000000', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', null);
INSERT INTO `clientes` VALUES ('33', null, 'DOMITILA', '', '', '', '0', '', '03870239', 'URB EL PINAR CA 13 MZ U LT 43 CONDOMINIOS DEL PINAR TORRE B DPTO 504 REF A 3 CRDAS DEL AEROCLUB', null, null, null, '', null, '993674538', '111111111', '111111111', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', null);
INSERT INTO `clientes` VALUES ('34', null, 'CRISTHIAN', '', '', '', '0', '', '78243936', 'PASAJE 8 DE OCTUBRE MZ N LT 41 URB MIGUEL GRAU DEL CENTRO POBLADO ANDRES ARAUJO MORAN', null, null, null, '', null, '938134805', '631733', '631733', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', null);
INSERT INTO `clientes` VALUES ('35', null, 'SAIDA', '', '', '', '0', '', '43676686', 'PASAJE 8 DE OCTUBRE MZ N LT 41 URB MIGUEL GRAU DEL CENTRO POBLADO ANDRES ARAUJO MORAN', null, null, null, '', null, '938134805', '631733', '631733', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', null);
INSERT INTO `clientes` VALUES ('36', null, 'PIERRE', '', '', '', '0', '', '72307235', 'JR LARRA 117 URB HUAQUILLAY COMAS', null, null, null, '', null, '986312954', '444444444', '444444444', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', null);
INSERT INTO `clientes` VALUES ('37', null, 'JORGE', '', '', '', '0', '', '45243579', 'JR LARRA 117 URB HUAQUILLAY COMAS', null, null, null, '', null, '986312954', '444444444', '444444444', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', null);
INSERT INTO `clientes` VALUES ('38', null, 'ADRIANA', '', '', '', '0', '', '77367460', 'JR LARRA 117 URB HUAQUILLAY COMAS', null, null, null, '', null, '986312954', '444444444', '444444444', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', null);
INSERT INTO `clientes` VALUES ('39', null, 'JULIO', '', '', '', '0', '', '72307241', 'JR LARRA 117 URB HUAQUILLAY COMAS', null, null, null, '', null, '986312954', '444444444', '444444444', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', null);
INSERT INTO `clientes` VALUES ('40', null, 'UMER', '', '', '', '0', '', '08752228', 'CONDOMINIO LOS PROCERES DE SURCO CAL TRISTAN Y MOSCOZO 260 TORRE N DPT 404 REF CUATRO CUADRAS DE LA BOLICHERA DE SURCO', null, null, null, '', null, '993027641', '010000000', '010000000', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', null);
INSERT INTO `clientes` VALUES ('41', null, 'MAURICIO', '', '', '', '0', '', '76584196', 'CONDOMINIO LOS PROCERES DE SURCO CAL TRISTAN Y MOSCOZO 260 TORRE N DPT 404 REF CUATRO CUADRAS DE LA BOLICHERA DE SURCO', null, null, null, '', null, '993027641', '010000000', '010000000', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', null);
INSERT INTO `clientes` VALUES ('42', null, 'GABRIEL', '', '', '', '0', '', '70627394', 'CONDOMINIO LOS PROCERES DE SURCO CAL TRISTAN Y MOSCOZO 260 TORRE N DPT 404 REF CUATRO CUADRAS DE LA BOLICHERA DE SURCO', null, null, null, '', null, '993027641', '010000000', '010000000', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', null);
INSERT INTO `clientes` VALUES ('43', null, 'LIBIA', '', '', '', '0', '', '74662329', 'JR BALTAZAR VALLE 387 URB AÐO NUEVO', null, null, null, '', null, '954762663', '000000000', '000000000', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', null);
INSERT INTO `clientes` VALUES ('44', null, 'BRENDA', '', '', '', '0', '', '72204480', 'JR BALTAZAR VALLE 387 URB AÐO NUEVO', null, null, null, '', null, '954762663', '000000000', '000000000', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', null);
INSERT INTO `clientes` VALUES ('45', null, 'LUIS', '', '', '', '0', '', '70466167', 'AV UNIVERSITARIA 1951 DPTO 608 REF TORRE 1 DEL CONDOMINIO ATLANTIS', null, null, null, '', null, '982058409', '6568752', '6568752', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', null);
INSERT INTO `clientes` VALUES ('46', '2', 'OSKAR', '', '', '', '0', '', '71301589', 'JR MUQUIYAUYOS 131 URB TAWUANTINSUYO SEGUNDA ZONA REF ALT DEL PARADERO CINE', null, null, null, '', null, '940428803', '5261366', '5261366', null, null, '2017-01-27', '', '3', '2017-01-27 13:39:36', '2017-02-03 05:59:29');
INSERT INTO `clientes` VALUES ('47', null, 'PATRICIA', '', '', '', '0', '', '10506632', 'JR MUQUIYAUYOS 131 URB TAWUANTINSUYO SEGUNDA ZONA REF ALT DEL PARADERO CINE', null, null, null, '', null, '940428803', '5261366', '5261366', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', null);
INSERT INTO `clientes` VALUES ('48', null, 'ERNESTO', '', '', '', '0', '', '71301597', 'JR MUQUIYAUYOS 131 URB TAWUANTINSUYO SEGUNDA ZONA REF ALT DEL PARADERO CINE', null, null, null, '', null, '940428803', '5261366', '5261366', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', null);
INSERT INTO `clientes` VALUES ('49', null, 'ANGELA', '', '', '', '0', '', '48085067', 'JIRON PONGO DE AGUIRRE 146 MZN C LOTE 7 LLEGANDO AL OVALO DE LOS CONDORES', null, null, null, '', null, '965452330', '987712998', '987712998', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', null);
INSERT INTO `clientes` VALUES ('50', null, 'CARLOS', '', '', '', '0', '', '46847289', 'JIRON PONGO DE AGUIRRE 146 MZN C LOTE 7 LLEGANDO AL OVALO DE LOS CONDORES', null, null, null, '', null, '965452330', '987712998', '987712998', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', null);
INSERT INTO `clientes` VALUES ('51', null, 'CARLOS', '', '', '', '0', '', '79099527', 'JIRON PONGO DE AGUIRRE 146 MZN C LOTE 7 LLEGANDO AL OVALO DE LOS CONDORES', null, null, null, '', null, '965452330', '987712998', '987712998', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', null);
INSERT INTO `clientes` VALUES ('52', null, 'FRANCIE', '', '', '', '0', '', '70655267', 'CARRETERA SAN ANTONIO 105 REF ESPALD DE HOTEL SAN MARINO', null, null, null, '', null, '942492291', '011111111', '011111111', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', null);
INSERT INTO `clientes` VALUES ('53', null, 'JOHANNA', '', '', '', '0', '', '09675588', 'JR CESAR LOPEZ ROJAS 272 MARANGA', null, null, null, '', null, '997918032', '000000000', '000000000', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', null);
INSERT INTO `clientes` VALUES ('54', null, 'LAURA', '', '', '', '0', '', '23009966', 'CALLE ESTEBAN COMPODONICO 185 DPTO 502', null, null, null, '', null, '942119503', '000000000', '000000000', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', null);
INSERT INTO `clientes` VALUES ('55', null, 'ANDREA', '', '', '', '0', '', '75246945', 'CALLE ESTEBAN COMPODONICO 185 DPTO 502', null, null, null, '', null, '942119503', '000000000', '000000000', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', null);
INSERT INTO `clientes` VALUES ('56', null, 'JOSE', '', '', '', '0', '', '10246697', 'CALLE ESTEBAN COMPODONICO 185 DPTO 502', null, null, null, '', null, '942119503', '000000000', '000000000', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', null);
INSERT INTO `clientes` VALUES ('57', null, 'RENATA', '', '', '', '0', '', '75255973', 'CALLE ESTEBAN COMPODONICO 185 DFPTO 502', null, null, null, '', null, '942119503', '000000000', '000000000', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', null);
INSERT INTO `clientes` VALUES ('58', null, 'KATHERINE', '', '', '', '0', '', '46141732', 'ASOC NUEVO ZENAY MZ F LOTE 08', null, null, null, '', null, '940643846', '000000000', '000000000', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', null);
INSERT INTO `clientes` VALUES ('59', null, 'LUZ', '', '', '', '0', '', '21113939', 'ASOC NUEVO ZENAY MZ F LOTE 08', null, null, null, '', null, '940643846', '000000000', '000000000', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', null);
INSERT INTO `clientes` VALUES ('60', null, 'LESLY', '', '', '', '0', '', '25782989', 'AV NENUFARES 712 VIPOL', null, null, null, '', null, '944245271', '', '', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', null);
INSERT INTO `clientes` VALUES ('61', null, 'DULCINEA', '', '', '', '0', '', '44587072', 'MZ N2 LT7 1RA ETAPA ASOCIACION VIRGEN DEL CARMEN LA ERA ÐAÐA  CHOSICA LURIGANCHO LIMA', null, null, null, '', null, '991264378', '444444444', '444444444', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', null);
INSERT INTO `clientes` VALUES ('62', null, 'JHADDE', '', '', '', '0', '', '77835910', 'MZ N2 LT7 1RA ETAPA ASOCIACION VIRGEN DEL CARMEN LA ERA ÐAÐA  CHOSICA LURIGANCHO LIMA', null, null, null, '', null, '991264378', '444444444', '444444444', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', null);
INSERT INTO `clientes` VALUES ('63', null, 'SAUL', '', '', '', '0', '', '48169971', 'CALLE TERESA DE FANNING 1189 URB LOS JARDINES TRUJILLO', null, null, null, '', null, '992526461', '444444444', '444444444', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', null);
INSERT INTO `clientes` VALUES ('64', null, 'DAVID', '', '', '', '0', '', '22289288', 'JR MANUEL CUADROS 144 OFIC 605', null, null, null, '', null, '991972697', '000000000', '000000000', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', null);
INSERT INTO `clientes` VALUES ('65', null, 'JOSE', '', '', '', '0', '', '42085612', 'MZ V LOTE 6 HUASCATA', null, null, null, '', null, '940171734', '4444444', '4444444', null, null, '2017-01-27', '', '0', '2017-01-27 13:39:36', '2017-02-02 19:45:33');
INSERT INTO `clientes` VALUES ('66', '2', 'LUIS', '', '', '', '0', '', '06566068', 'AV LOS PARQUES 509 URB VALDIVIESO', null, null, null, '', null, '992773354', '0212323', '', null, null, '2017-01-27', '', '7', '2017-01-27 13:39:36', '2017-02-03 06:09:28');
INSERT INTO `clientes` VALUES ('67', '2', 'KATHERINE', '', '', '', '0', '', '48017081', 'AV LOS PARQUES 509 URB VALDIVIESO', null, null, null, '', null, '992773354', '02123473517', '', null, null, '2017-01-27', '', '7', '2017-01-27 13:39:36', '2017-02-03 09:29:41');
INSERT INTO `clientes` VALUES ('69', '2', 'DAVID', '', '', '', '0', '', '22289288', 'JR MANUEL CUADROS 144 OFIC 605', '', '', '', '', '', '991972697', '000000000', '000000000', '', '', '2017-01-27', '', '3', '2017-01-27 13:39:36', '2017-02-03 04:44:13');
INSERT INTO `clientes` VALUES ('70', '2', 'JOSE', '', '', '', '0', '', '42085612', 'MZ V LOTE 6 HUASCATA', '', '', '', '', '', '940171734', '4444444', '4444444', '', '', '2017-01-27', '', '3', '2017-01-27 13:39:36', '2017-02-03 04:42:54');
INSERT INTO `clientes` VALUES ('71', '2', 'LUIS', '', '', '', '0', '', '06566068', 'AV LOS PARQUES 509 URB VALDIVIESO', '', '', '', '', '', '992773354', '02123483748', '', '', '', '2017-01-27', '', '7', '2017-01-27 13:39:36', '2017-02-03 09:28:07');
INSERT INTO `clientes` VALUES ('72', '2', 'KATHERINE', '', '', '', '0', '', '48017081', 'AV LOS PARQUES 509 URB VALDIVIESO', '', '', '', '', '', '992773354', '', '', '', '', '2017-01-27', '', '3', '2017-01-27 13:39:36', '2017-02-03 16:05:58');
INSERT INTO `clientes` VALUES ('73', '2', 'KATHERINE', '', '', '', '0', '', '48017081', 'mkm', '', '', '', '', '', '992773354', '992773354', '', '32232', '', '2017-01-27', '', '3', '2017-01-27 13:39:36', '2017-02-03 14:24:42');
INSERT INTO `clientes` VALUES ('74', '2', 'JOSE', '', '', '', '0', '', '42085612', 'MZ V LOTE 6 HUASCATA', '', '', '', '', '', '940171734', '4444444', '4444444', '4545454', '', '2017-01-27', '', '3', '2017-01-27 13:39:36', '2017-02-08 00:11:29');
INSERT INTO `clientes` VALUES ('75', '2', 'LUIS', '', '', '', '0', '', '06566068', 'AV LOS PARQUES 509 URB VALDIVIESO', '', '', '', '', '', '992773354', '', '', '', '', '2017-01-27', '', '3', '2017-01-27 13:39:36', '2017-02-03 04:44:30');
INSERT INTO `clientes` VALUES ('76', '2', 'KATHERINE', '', '', '', '0', '', '48017081', 'AV LOS PARQUES 509 URB VALDIVIESO', '', '', '', '', '', '992773354', '', '', '', '', '2017-01-27', '', '3', '2017-01-27 13:39:36', '2017-02-03 04:45:29');
INSERT INTO `clientes` VALUES ('77', '2', 'KATHERINE', '', '', '', '0', '', '48017081', '', '', '', '', '', '', '992773354', '992773354', '', '', '', '2017-01-27', '', '3', '2017-01-27 13:39:36', '2017-02-03 04:45:59');
INSERT INTO `clientes` VALUES ('78', '2', 'JOSE', '', '', '', '0', '', '42085612', 'MZ V LOTE 6 HUASCATA', '', '', '', '', '', '940171734', '4444444', '4444444', '', '', '2017-01-27', '', '3', '2017-01-27 13:39:36', '2017-02-03 04:46:54');
INSERT INTO `clientes` VALUES ('79', '2', 'LUIS', '', '', '', '0', '', '06566068', 'AV LOS PARQUES 509 URB VALDIVIESO', '', '', '', '', '', '992773354', '', '', '', '', '2017-01-27', '', '3', '2017-01-27 13:39:36', '2017-02-03 04:50:05');
INSERT INTO `clientes` VALUES ('80', '2', 'KATHERINE', '', '', '', '0', '', '48017081', 'AV LOS PARQUES 509 URB VALDIVIESO', '', '', '', '', '', '992773354', '', '', '', '', '2017-01-27', '', '3', '2017-01-27 13:39:36', '2017-02-03 04:54:48');
INSERT INTO `clientes` VALUES ('81', '2', 'KATHERINE', '', '', '', '0', '', '48017081', '', '', '', '', '', '', '992773354', '992773354', '', '', '', '2017-01-27', '', '3', '2017-01-27 13:39:36', '2017-02-03 05:59:29');
INSERT INTO `clientes` VALUES ('82', '2', 'JOSE', '', '', '', '0', '', '42085612', 'MZ V LOTE 6 HUASCATA', '', '', '', '', '', '940171734', '4444444', '4444444', '', '', '2017-01-27', '', '3', '2017-01-27 13:39:36', '2017-02-03 16:05:59');
INSERT INTO `clientes` VALUES ('83', '2', 'LUIS', '', '', '', '0', '', '06566068', 'AV LOS PARQUES 509 URB VALDIVIESO', '', '', '', '', '', '992773354', '', '', '', '', '2017-01-27', '', '3', '2017-01-27 13:39:36', '2017-02-03 05:58:52');
INSERT INTO `clientes` VALUES ('84', '2', 'KATHERINE', '', '', '', '0', '', '48017081', 'AV LOS PARQUES 509 URB VALDIVIESO', '', '', '', '', '', '992773354', '', '', '', '', '2017-01-27', '', '3', '2017-01-27 13:39:36', '2017-02-03 16:05:59');
INSERT INTO `clientes` VALUES ('85', '2', 'KATHERINE', '', '', '', '0', '', '48017081', '', '', '', '', '', '', '992773354', '992773354', '', '', '', '2017-01-27', '', '3', '2017-01-27 13:39:36', '2017-02-03 16:05:59');
INSERT INTO `clientes` VALUES ('86', '2', 'JOSE', '', '', '', '0', '', '42085612', 'MZ V LOTE 6 HUASCATA', '', '', '', '', '', '940171734', '4444444', '4444444', '', '', '2017-01-27', '', '3', '2017-01-27 13:39:36', '2017-02-03 16:05:59');
INSERT INTO `clientes` VALUES ('87', '2', 'LUIS', '', '', '', '0', '', '06566068', 'AV LOS PARQUES 509 URB VALDIVIESO', '', '', '', '', '', '992773354', '', '', '', '', '2017-01-27', '', '3', '2017-01-27 13:39:36', '2017-02-03 05:59:29');
INSERT INTO `clientes` VALUES ('88', '2', 'KATHERINE', '', '', '', '0', '', '48017081', 'AV LOS PARQUES 509 URB VALDIVIESO', '', '', '', '', '', '992773354', '', '', '', '', '2017-01-27', '', '3', '2017-01-27 13:39:36', '2017-02-03 16:05:59');
INSERT INTO `clientes` VALUES ('89', '2', 'KATHERINE', '', '', '', '0', '', '48017081', '', '', '', '', '', '', '992773354', '992773354', '', '', '', '2017-01-27', '', '3', '2017-01-27 13:39:36', '2017-02-03 05:59:29');

-- ----------------------------
-- Table structure for contactos
-- ----------------------------
DROP TABLE IF EXISTS `contactos`;
CREATE TABLE `contactos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `clientes_id` int(10) unsigned NOT NULL,
  `tpfnivel1_id` int(10) unsigned NOT NULL,
  `tpfnivel2_id` int(10) unsigned DEFAULT NULL,
  `tpfnivel3_id` int(10) unsigned DEFAULT NULL,
  `tpfnivel4_id` int(10) unsigned DEFAULT NULL,
  `users_id` int(10) unsigned NOT NULL,
  `telefono` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `comentario` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contactos_clientes_id_foreign` (`clientes_id`),
  KEY `contactos_tpfnivel1_id_foreign` (`tpfnivel1_id`),
  KEY `contactos_tpfnivel2_id_foreign` (`tpfnivel2_id`),
  KEY `contactos_tpfnivel3_id_foreign` (`tpfnivel3_id`),
  KEY `contactos_tpfnivel4_id_foreign` (`tpfnivel4_id`),
  KEY `contactos_users_id_foreign` (`users_id`),
  KEY `contactos_status_id_foreign` (`status_id`),
  CONSTRAINT `contactos_clientes_id_foreign` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`id`),
  CONSTRAINT `contactos_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  CONSTRAINT `contactos_tpfnivel1_id_foreign` FOREIGN KEY (`tpfnivel1_id`) REFERENCES `tpfnivel1` (`id`),
  CONSTRAINT `contactos_tpfnivel2_id_foreign` FOREIGN KEY (`tpfnivel2_id`) REFERENCES `tpfnivel2` (`id`),
  CONSTRAINT `contactos_tpfnivel3_id_foreign` FOREIGN KEY (`tpfnivel3_id`) REFERENCES `tpfnivel3` (`id`),
  CONSTRAINT `contactos_tpfnivel4_id_foreign` FOREIGN KEY (`tpfnivel4_id`) REFERENCES `tpfnivel4` (`id`),
  CONSTRAINT `contactos_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of contactos
-- ----------------------------
INSERT INTO `contactos` VALUES ('1', '67', '1', '1', '1', null, '2', '02123473517', 'Esto es un comentario de una cita agendada', '7', '2017-02-03 05:21:32', '2017-02-03 06:09:27');
INSERT INTO `contactos` VALUES ('2', '66', '1', '1', '1', null, '2', '0212323', 'j fdf dfdhf d df', '1', '2017-02-03 06:04:33', '2017-02-03 06:04:33');
INSERT INTO `contactos` VALUES ('3', '66', '2', '5', null, null, '2', '0212323', 'r ewrwer  rtrtr', '1', '2017-02-03 06:07:02', '2017-02-03 06:07:02');
INSERT INTO `contactos` VALUES ('4', '66', '2', '5', null, null, '2', '0212323', 'dg d hfgh', '1', '2017-02-03 06:08:14', '2017-02-03 06:08:14');
INSERT INTO `contactos` VALUES ('5', '66', '1', '1', '8', null, '2', '992773354', ' regerger ', '1', '2017-02-03 06:09:27', '2017-02-03 06:09:27');
INSERT INTO `contactos` VALUES ('6', '71', '1', '1', '1', null, '2', '02123483748', 'agendo para elmartes', '5', '2017-02-03 09:16:39', '2017-02-03 09:16:39');
INSERT INTO `contactos` VALUES ('7', '67', '1', '1', '1', null, '2', '02123473517', 'lo      vuelvo a gendar          ', '1', '2017-02-03 09:17:57', '2017-02-03 09:17:57');
INSERT INTO `contactos` VALUES ('8', '71', '1', '1', '8', null, '1', '992773354', 'fdjf jfefef', '5', '2017-02-03 09:28:07', '2017-02-08 04:50:17');
INSERT INTO `contactos` VALUES ('9', '67', '1', '1', '1', null, '1', '992773354', 'fg hrth htr', '1', '2017-02-03 09:28:47', '2017-02-03 09:28:47');
INSERT INTO `contactos` VALUES ('10', '67', '1', '1', '8', null, '1', '992773354', 'y uygyy g', '1', '2017-02-03 09:29:41', '2017-02-03 09:29:41');
INSERT INTO `contactos` VALUES ('11', '17', '1', '1', '1', null, '1', '997340043', ' erger ger ger ge gerg', '1', '2017-02-08 04:50:17', '2017-02-08 04:50:17');
INSERT INTO `contactos` VALUES ('12', '17', '1', '1', '1', null, '1', '997340043', 'd ed e f efe f', '1', '2017-02-08 05:04:18', '2017-02-08 05:04:18');

-- ----------------------------
-- Table structure for contratantes
-- ----------------------------
DROP TABLE IF EXISTS `contratantes`;
CREATE TABLE `contratantes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `clientes_id` int(10) unsigned NOT NULL,
  `docxventa_id` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `apellido_paterno` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `apellido_materno` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nombre_uno` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nombre_dos` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sexo_id` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `ff_nacimiento` date NOT NULL,
  `documento_id` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `nro_documento` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `razon_social` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `ruc` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `ubigeo_id` int(6) unsigned NOT NULL,
  `co_postal` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `celular` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `correo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `prov_id` int(10) unsigned NOT NULL,
  `dpto_id` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `supervisor_users_id` int(10) unsigned NOT NULL,
  `vendedor_users_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contratantes_docxventa_id_foreign` (`docxventa_id`),
  KEY `contratantes_sexo_id_foreign` (`sexo_id`),
  KEY `contratantes_documento_id_foreign` (`documento_id`),
  KEY `contratantes_ubigeo_id_foreign` (`ubigeo_id`),
  KEY `contratantes_status_id_foreign` (`status_id`),
  KEY `contratantes_clientes_id_foreign` (`clientes_id`),
  KEY `contratantes_dpto_id_foreign` (`dpto_id`),
  KEY `contratantes_prov_id_foreign` (`prov_id`),
  KEY `contratantes_supervisor_users_id_foreign` (`supervisor_users_id`),
  KEY `contratantes_vendedor_users_id_foreign` (`vendedor_users_id`),
  CONSTRAINT `contratantes_clientes_id_foreign` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`id`),
  CONSTRAINT `contratantes_documento_id_foreign` FOREIGN KEY (`documento_id`) REFERENCES `documentos` (`id`),
  CONSTRAINT `contratantes_docxventa_id_foreign` FOREIGN KEY (`docxventa_id`) REFERENCES `docxventas` (`id`),
  CONSTRAINT `contratantes_dpto_id_foreign` FOREIGN KEY (`dpto_id`) REFERENCES `dptos` (`id`),
  CONSTRAINT `contratantes_prov_id_foreign` FOREIGN KEY (`prov_id`) REFERENCES `provs` (`id`),
  CONSTRAINT `contratantes_sexo_id_foreign` FOREIGN KEY (`sexo_id`) REFERENCES `sexos` (`id`),
  CONSTRAINT `contratantes_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  CONSTRAINT `contratantes_supervisor_users_id_foreign` FOREIGN KEY (`supervisor_users_id`) REFERENCES `users` (`id`),
  CONSTRAINT `contratantes_ubigeo_id_foreign` FOREIGN KEY (`ubigeo_id`) REFERENCES `ubigeos` (`id`),
  CONSTRAINT `contratantes_vendedor_users_id_foreign` FOREIGN KEY (`vendedor_users_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of contratantes
-- ----------------------------

-- ----------------------------
-- Table structure for documentos
-- ----------------------------
DROP TABLE IF EXISTS `documentos`;
CREATE TABLE `documentos` (
  `id` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `nb_documento` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `documentos_status_id_foreign` (`status_id`),
  CONSTRAINT `documentos_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of documentos
-- ----------------------------
INSERT INTO `documentos` VALUES ('01', 'DNI', '1', '2017-01-26 09:56:33', '2017-01-26 09:56:33');
INSERT INTO `documentos` VALUES ('02', 'LMIL', '1', '2017-01-26 09:56:33', '2017-01-26 09:56:33');
INSERT INTO `documentos` VALUES ('03', 'CEXT', '1', '2017-01-26 09:56:33', '2017-01-26 09:56:33');
INSERT INTO `documentos` VALUES ('05', 'DIE', '1', '2017-01-26 09:56:33', '2017-01-26 09:56:33');

-- ----------------------------
-- Table structure for docxventas
-- ----------------------------
DROP TABLE IF EXISTS `docxventas`;
CREATE TABLE `docxventas` (
  `id` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `nb_docxventa` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `docxventas_status_id_foreign` (`status_id`),
  CONSTRAINT `docxventas_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of docxventas
-- ----------------------------
INSERT INTO `docxventas` VALUES ('01', 'Boleta', '1', '2017-02-01 11:28:11', '2017-02-01 11:28:14');
INSERT INTO `docxventas` VALUES ('02', 'Factura', '1', '2017-02-01 11:28:27', '2017-02-01 11:28:30');

-- ----------------------------
-- Table structure for dptos
-- ----------------------------
DROP TABLE IF EXISTS `dptos`;
CREATE TABLE `dptos` (
  `id` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `nb_dpto` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dptos_status_id_foreign` (`status_id`),
  CONSTRAINT `dptos_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of dptos
-- ----------------------------
INSERT INTO `dptos` VALUES ('00', 'PERU', '1', '2017-01-26 10:08:59', '2017-01-26 10:08:59');
INSERT INTO `dptos` VALUES ('01', 'AMAZONAS', '1', '2017-01-26 10:08:59', '2017-01-26 10:08:59');
INSERT INTO `dptos` VALUES ('02', 'ANCASH', '1', '2017-01-26 10:08:59', '2017-01-26 10:08:59');
INSERT INTO `dptos` VALUES ('03', 'APURIMAC\r\n', '1', '2017-01-26 10:08:59', '2017-01-26 10:08:59');
INSERT INTO `dptos` VALUES ('04', 'AREQUIPA', '1', '2017-01-26 10:08:59', '2017-01-26 10:08:59');
INSERT INTO `dptos` VALUES ('05', 'AYACUCHO', '1', '2017-01-26 10:08:59', '2017-01-26 10:08:59');
INSERT INTO `dptos` VALUES ('06', 'CAJAMARCA', '1', '2017-01-26 10:08:59', '2017-01-26 10:08:59');
INSERT INTO `dptos` VALUES ('07', 'CALLAO', '1', '2017-01-26 10:08:59', '2017-01-26 10:08:59');
INSERT INTO `dptos` VALUES ('08', 'CUSCO', '1', '2017-01-26 10:08:59', '2017-01-26 10:08:59');
INSERT INTO `dptos` VALUES ('09', 'HUANCAVELICA', '1', '2017-01-26 10:08:59', '2017-01-26 10:08:59');
INSERT INTO `dptos` VALUES ('10', 'HUANUCO', '1', '2017-01-26 10:08:59', '2017-01-26 10:08:59');
INSERT INTO `dptos` VALUES ('11', 'ICA', '1', '2017-01-26 10:08:59', '2017-01-26 10:08:59');
INSERT INTO `dptos` VALUES ('12', 'JUNIN', '1', '2017-01-26 10:08:59', '2017-01-26 10:08:59');
INSERT INTO `dptos` VALUES ('13', 'LA LIBERTAD', '1', '2017-01-26 10:08:59', '2017-01-26 10:08:59');
INSERT INTO `dptos` VALUES ('14', 'LAMBAYEQUE', '1', '2017-01-26 10:08:59', '2017-01-26 10:08:59');
INSERT INTO `dptos` VALUES ('15', 'LIMA', '1', '2017-01-26 10:08:59', '2017-01-26 10:08:59');
INSERT INTO `dptos` VALUES ('16', 'LORETO', '1', '2017-01-26 10:08:59', '2017-01-26 10:08:59');
INSERT INTO `dptos` VALUES ('17', 'MADRE DE DIOS', '1', '2017-01-26 10:08:59', '2017-01-26 10:08:59');
INSERT INTO `dptos` VALUES ('18', 'MOQUEGUA', '1', '2017-01-26 10:08:59', '2017-01-26 10:08:59');
INSERT INTO `dptos` VALUES ('19', 'PASCO', '1', '2017-01-26 10:08:59', '2017-01-26 10:08:59');
INSERT INTO `dptos` VALUES ('20', 'PIURA', '1', '2017-01-26 10:08:59', '2017-01-26 10:08:59');
INSERT INTO `dptos` VALUES ('21', 'PUNO', '1', '2017-01-26 10:08:59', '2017-01-26 10:08:59');
INSERT INTO `dptos` VALUES ('22', 'SAN MARTIN', '1', '2017-01-26 10:08:59', '2017-01-26 10:08:59');
INSERT INTO `dptos` VALUES ('23', 'TACNA', '1', '2017-01-26 10:08:59', '2017-01-26 10:08:59');
INSERT INTO `dptos` VALUES ('24', 'TUMBES', '1', '2017-01-26 10:08:59', '2017-01-26 10:08:59');
INSERT INTO `dptos` VALUES ('25', 'UCAYALI', '1', '2017-01-26 10:08:59', '2017-01-26 10:08:59');

-- ----------------------------
-- Table structure for emisoras
-- ----------------------------
DROP TABLE IF EXISTS `emisoras`;
CREATE TABLE `emisoras` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nb_emisora` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `emisoras_status_id_foreign` (`status_id`),
  CONSTRAINT `emisoras_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of emisoras
-- ----------------------------
INSERT INTO `emisoras` VALUES ('1', 'Falabella\r\nFalabella', '1', '2017-02-01 20:57:23', '2017-02-01 20:57:23');
INSERT INTO `emisoras` VALUES ('2', 'Banco de Credito', '1', '2017-02-01 20:57:23', '2017-02-01 20:57:23');
INSERT INTO `emisoras` VALUES ('3', 'Banco Continental', '1', '2017-02-01 20:57:23', '2017-02-01 20:57:23');
INSERT INTO `emisoras` VALUES ('5', 'Diners', '1', '2017-02-01 20:57:23', '2017-02-01 20:57:23');
INSERT INTO `emisoras` VALUES ('6', 'Interbank', '1', '2017-02-01 20:57:23', '2017-02-01 20:57:23');
INSERT INTO `emisoras` VALUES ('9', 'Otros', '1', '2017-02-01 20:57:23', '2017-02-01 20:57:23');

-- ----------------------------
-- Table structure for fumadores
-- ----------------------------
DROP TABLE IF EXISTS `fumadores`;
CREATE TABLE `fumadores` (
  `id` int(11) NOT NULL,
  `nb_fumador` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fumadores_status_id_foreign` (`status_id`),
  CONSTRAINT `fumadores_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of fumadores
-- ----------------------------
INSERT INTO `fumadores` VALUES ('0', 'NO', '1', '2017-01-26 10:00:14', '2017-01-26 10:00:17');
INSERT INTO `fumadores` VALUES ('1', 'SI', '1', '2017-01-26 09:59:56', '2017-01-26 09:59:59');

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status_id` int(10) unsigned NOT NULL,
  `nombre` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `orden` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_status_id_foreign` (`status_id`) USING BTREE,
  CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', '1', 'USUARIOS', 'fa  fa-users', '1', '2017-01-26 07:22:40', '2017-01-26 07:22:43');
INSERT INTO `menu` VALUES ('3', '1', 'CALL CENTER', 'fa fa-phone-square', '1', '2017-01-26 07:22:47', '2017-01-26 07:22:50');
INSERT INTO `menu` VALUES ('4', '1', 'REPORTES', 'fa fa-database', '1', '2017-02-02 08:14:29', '2017-02-02 08:14:31');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('3', '2015_10_25_000000_update_users_table', '1');
INSERT INTO `migrations` VALUES ('4', '2016_12_27_160406_create_status', '1');
INSERT INTO `migrations` VALUES ('5', '2017_01_16_181644_create_menu', '1');
INSERT INTO `migrations` VALUES ('6', '2017_01_16_181659_create_submenu', '1');
INSERT INTO `migrations` VALUES ('7', '2017_01_16_184337_create_roles', '1');
INSERT INTO `migrations` VALUES ('40', '2017_01_26_124335_create_productos', '2');
INSERT INTO `migrations` VALUES ('41', '2017_01_26_124514_create_sexos', '2');
INSERT INTO `migrations` VALUES ('42', '2017_01_26_124541_create_documentos', '2');
INSERT INTO `migrations` VALUES ('43', '2017_01_26_124611_create_categorias', '2');
INSERT INTO `migrations` VALUES ('44', '2017_01_26_124630_create_programas', '2');
INSERT INTO `migrations` VALUES ('45', '2017_01_26_124649_create_fumadores', '2');
INSERT INTO `migrations` VALUES ('46', '2017_01_26_124852_create_dptos', '2');
INSERT INTO `migrations` VALUES ('49', '2017_01_26_124910_create_provs', '3');
INSERT INTO `migrations` VALUES ('52', '2017_01_26_125022_create_ubigeos', '4');
INSERT INTO `migrations` VALUES ('62', '2017_01_26_153236_create_afiliados', '5');
INSERT INTO `migrations` VALUES ('63', '2017_01_26_162801_create_emisoras', '5');
INSERT INTO `migrations` VALUES ('64', '2017_01_26_162826_create_procesadoras', '5');
INSERT INTO `migrations` VALUES ('65', '2017_01_26_162909_create_docxventas', '5');
INSERT INTO `migrations` VALUES ('66', '2017_01_26_163109_create_contratantes', '5');
INSERT INTO `migrations` VALUES ('72', '2017_01_26_170340_create_tipoproducto', '6');
INSERT INTO `migrations` VALUES ('73', '2017_01_26_164417_create_tarjetascuentas', '7');
INSERT INTO `migrations` VALUES ('74', '2017_01_27_163111_create_clientes', '8');
INSERT INTO `migrations` VALUES ('75', '2017_01_27_170357_create_tpfnivel1', '9');
INSERT INTO `migrations` VALUES ('76', '2017_01_27_170406_create_tpfnivel2', '9');
INSERT INTO `migrations` VALUES ('77', '2017_01_27_170413_create_tpfnivel3', '9');
INSERT INTO `migrations` VALUES ('78', '2017_01_27_170459_create_tpfnivel4', '9');
INSERT INTO `migrations` VALUES ('80', '2017_01_27_172039_create_contactos', '10');
INSERT INTO `migrations` VALUES ('81', '2017_01_27_174520_alter_users_clientes', '10');
INSERT INTO `migrations` VALUES ('82', '2017_01_30_161346_alter_telefonos_clientes', '11');
INSERT INTO `migrations` VALUES ('83', '2017_01_30_163227_alter_ultima_tipificacion_clientes', '12');
INSERT INTO `migrations` VALUES ('87', '2017_01_30_184026_create_toques_telefono', '13');
INSERT INTO `migrations` VALUES ('89', '2017_01_30_230145_create_toques', '14');
INSERT INTO `migrations` VALUES ('90', '2017_01_31_004752_create_aperturas', '15');
INSERT INTO `migrations` VALUES ('93', '2017_01_31_052104_create_reglas', '16');
INSERT INTO `migrations` VALUES ('94', '2017_01_31_134137_alter_reglas', '17');
INSERT INTO `migrations` VALUES ('96', '2017_01_31_212330_alter_afiliados', '18');
INSERT INTO `migrations` VALUES ('97', '2017_02_01_150640_alter_contrantantes', '19');
INSERT INTO `migrations` VALUES ('98', '2017_02_02_001608_alter_tarjetascuentas', '20');
INSERT INTO `migrations` VALUES ('99', '2017_02_02_015107_alter_afiliados_obigeo', '21');
INSERT INTO `migrations` VALUES ('100', '2017_02_02_015604_alter_contratante_obigeo', '22');
INSERT INTO `migrations` VALUES ('101', '2017_02_02_061313_alter_user_type', '23');
INSERT INTO `migrations` VALUES ('102', '2017_02_02_170840_create_agencias', '24');
INSERT INTO `migrations` VALUES ('103', '2017_02_02_170900_create_vendedores', '24');
INSERT INTO `migrations` VALUES ('104', '2017_02_02_171606_create_ventas', '25');
INSERT INTO `migrations` VALUES ('105', '2017_02_02_201738_create_agendamientos', '26');
INSERT INTO `migrations` VALUES ('106', '2017_02_03_033043_alter_user_status', '27');
INSERT INTO `migrations` VALUES ('107', '2017_02_08_011534_alter_clientes_campos', '28');
INSERT INTO `migrations` VALUES ('108', '2017_02_22_193942_create_tipopagos', '29');
INSERT INTO `migrations` VALUES ('109', '2017_02_22_194232_alter_afialiados_rel_tipopago', '30');
INSERT INTO `migrations` VALUES ('110', '2017_02_22_194550_alter_contratanes_rel_users_id', '31');
INSERT INTO `migrations` VALUES ('111', '2017_02_22_195841_alter_clientes_rel_clientes', '32');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`) USING BTREE,
  KEY `password_resets_token_index` (`token`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for procesadoras
-- ----------------------------
DROP TABLE IF EXISTS `procesadoras`;
CREATE TABLE `procesadoras` (
  `id` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `nb_procesadora` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `procesadoras_status_id_foreign` (`status_id`),
  CONSTRAINT `procesadoras_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of procesadoras
-- ----------------------------
INSERT INTO `procesadoras` VALUES ('02', 'Visa', '1', '2017-02-01 20:58:46', '2017-02-01 20:58:46');
INSERT INTO `procesadoras` VALUES ('04', 'Amex', '1', '2017-02-01 20:58:46', '2017-02-01 20:58:46');
INSERT INTO `procesadoras` VALUES ('05', 'Diners', '1', '2017-02-01 20:58:46', '2017-02-01 20:58:46');
INSERT INTO `procesadoras` VALUES ('06', 'Mastercard', '1', '2017-02-01 20:58:46', '2017-02-01 20:58:46');

-- ----------------------------
-- Table structure for productos
-- ----------------------------
DROP TABLE IF EXISTS `productos`;
CREATE TABLE `productos` (
  `id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `nb_producto` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `productos_status_id_foreign` (`status_id`),
  CONSTRAINT `productos_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of productos
-- ----------------------------
INSERT INTO `productos` VALUES ('400010201', ' (ANUAL)', '1', null, null);
INSERT INTO `productos` VALUES ('401010201', '(CREDITO)', '1', null, null);
INSERT INTO `productos` VALUES ('402010201', '(DEBITO)', '1', null, null);

-- ----------------------------
-- Table structure for programas
-- ----------------------------
DROP TABLE IF EXISTS `programas`;
CREATE TABLE `programas` (
  `id` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `nb_programa` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `programas_status_id_foreign` (`status_id`),
  CONSTRAINT `programas_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of programas
-- ----------------------------
INSERT INTO `programas` VALUES ('20', 'Senior', '1', '2017-01-26 09:58:51', '2017-01-26 09:58:51');
INSERT INTO `programas` VALUES ('22', 'Clasico', '1', '2017-01-26 09:58:51', '2017-01-26 09:58:51');
INSERT INTO `programas` VALUES ('30', 'Vida', '1', '2017-01-26 09:58:51', '2017-01-26 09:58:51');
INSERT INTO `programas` VALUES ('60', 'Plus\r\n', '1', '2017-01-26 09:58:51', '2017-01-26 09:58:51');
INSERT INTO `programas` VALUES ('62', 'Plus Master', '1', '2017-01-26 09:58:51', '2017-01-26 09:58:51');

-- ----------------------------
-- Table structure for provs
-- ----------------------------
DROP TABLE IF EXISTS `provs`;
CREATE TABLE `provs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dpto_id` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `nb_prov` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `provs_dpto_id_foreign` (`dpto_id`),
  KEY `provs_status_id_foreign` (`status_id`),
  CONSTRAINT `provs_dpto_id_foreign` FOREIGN KEY (`dpto_id`) REFERENCES `dptos` (`id`),
  CONSTRAINT `provs_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of provs
-- ----------------------------
INSERT INTO `provs` VALUES ('1', '00', 'PERU', '1', '2017-01-26 11:05:31', '2017-01-26 11:05:31');
INSERT INTO `provs` VALUES ('2', '01', 'CHACHAPOYAS', '1', '2017-01-27 11:05:31', '2017-01-27 11:05:31');
INSERT INTO `provs` VALUES ('3', '01', 'BAGUA', '1', '2017-01-28 11:05:31', '2017-01-28 11:05:31');
INSERT INTO `provs` VALUES ('4', '01', 'BONGARA', '1', '2017-01-29 11:05:31', '2017-01-29 11:05:31');
INSERT INTO `provs` VALUES ('5', '01', 'CONDORCANQUI', '1', '2017-01-30 11:05:31', '2017-01-30 11:05:31');
INSERT INTO `provs` VALUES ('6', '01', 'LUYA', '1', '2017-01-31 11:05:31', '2017-01-31 11:05:31');
INSERT INTO `provs` VALUES ('7', '01', 'RODRIGUEZ DE MENDOZA', '1', '2017-02-01 11:05:31', '2017-02-01 11:05:31');
INSERT INTO `provs` VALUES ('8', '01', 'UTCUBAMBA', '1', '2017-02-02 11:05:31', '2017-02-02 11:05:31');
INSERT INTO `provs` VALUES ('9', '02', 'ANCASH', '1', '2017-02-03 11:05:31', '2017-02-03 11:05:31');
INSERT INTO `provs` VALUES ('10', '02', 'HUARAZ', '1', '2017-02-04 11:05:31', '2017-02-04 11:05:31');
INSERT INTO `provs` VALUES ('11', '02', 'AIJA', '1', '2017-02-05 11:05:31', '2017-02-05 11:05:31');
INSERT INTO `provs` VALUES ('12', '02', 'ANTONIO RAYMONDI', '1', '2017-02-06 11:05:31', '2017-02-06 11:05:31');
INSERT INTO `provs` VALUES ('13', '02', 'ASUNCION', '1', '2017-02-07 11:05:31', '2017-02-07 11:05:31');
INSERT INTO `provs` VALUES ('14', '02', 'BOLOGNESI', '1', '2017-02-08 11:05:31', '2017-02-08 11:05:31');
INSERT INTO `provs` VALUES ('15', '02', 'RECUAY', '1', '2017-02-09 11:05:31', '2017-02-09 11:05:31');
INSERT INTO `provs` VALUES ('16', '02', 'SANTA', '1', '2017-02-10 11:05:31', '2017-02-10 11:05:31');
INSERT INTO `provs` VALUES ('17', '02', 'SIHUAS', '1', '2017-02-11 11:05:31', '2017-02-11 11:05:31');
INSERT INTO `provs` VALUES ('18', '02', 'YUNGAY', '1', '2017-02-12 11:05:31', '2017-02-12 11:05:31');
INSERT INTO `provs` VALUES ('19', '02', 'BOLOGNESI', '1', '2017-02-13 11:05:31', '2017-02-13 11:05:31');
INSERT INTO `provs` VALUES ('20', '02', 'CARHUAZ', '1', '2017-02-14 11:05:31', '2017-02-14 11:05:31');
INSERT INTO `provs` VALUES ('21', '02', 'CARLOS FERMIN FITZCA', '1', '2017-02-15 11:05:31', '2017-02-15 11:05:31');
INSERT INTO `provs` VALUES ('22', '02', 'CASMA', '1', '2017-02-16 11:05:31', '2017-02-16 11:05:31');
INSERT INTO `provs` VALUES ('23', '02', 'CORONGO', '1', '2017-02-17 11:05:31', '2017-02-17 11:05:31');
INSERT INTO `provs` VALUES ('24', '02', 'HUARI', '1', '2017-02-18 11:05:31', '2017-02-18 11:05:31');
INSERT INTO `provs` VALUES ('25', '02', 'HUARMEY', '1', '2017-02-19 11:05:31', '2017-02-19 11:05:31');
INSERT INTO `provs` VALUES ('26', '02', 'HUAYLAS', '1', '2017-02-20 11:05:31', '2017-02-20 11:05:31');
INSERT INTO `provs` VALUES ('27', '02', 'MARISCAL LUZURIAGA', '1', '2017-02-21 11:05:31', '2017-02-21 11:05:31');
INSERT INTO `provs` VALUES ('28', '02', 'OCROS', '1', '2017-02-22 11:05:31', '2017-02-22 11:05:31');
INSERT INTO `provs` VALUES ('29', '02', 'PALLASCA', '1', '2017-02-23 11:05:31', '2017-02-23 11:05:31');
INSERT INTO `provs` VALUES ('30', '02', 'POMABAMBA', '1', '2017-02-24 11:05:31', '2017-02-24 11:05:31');
INSERT INTO `provs` VALUES ('31', '02', 'RECUAY', '1', '2017-02-25 11:05:31', '2017-02-25 11:05:31');
INSERT INTO `provs` VALUES ('32', '03', 'APURIMAC', '1', '2017-02-26 11:05:31', '2017-02-26 11:05:31');
INSERT INTO `provs` VALUES ('33', '03', 'ABANCAY', '1', '2017-02-27 11:05:31', '2017-02-27 11:05:31');
INSERT INTO `provs` VALUES ('34', '03', 'ANDAHUAYLAS', '1', '2017-02-28 11:05:31', '2017-02-28 11:05:31');
INSERT INTO `provs` VALUES ('35', '03', 'ANTABAMBA', '1', '2017-03-01 11:05:31', '2017-03-01 11:05:31');
INSERT INTO `provs` VALUES ('36', '03', 'AYMARAES', '1', '2017-03-02 11:05:31', '2017-03-02 11:05:31');
INSERT INTO `provs` VALUES ('37', '03', 'COTABAMBAS', '1', '2017-03-03 11:05:31', '2017-03-03 11:05:31');
INSERT INTO `provs` VALUES ('38', '03', 'CHINCHEROS', '1', '2017-03-04 11:05:31', '2017-03-04 11:05:31');
INSERT INTO `provs` VALUES ('39', '03', 'GRAU', '1', '2017-03-05 11:05:31', '2017-03-05 11:05:31');
INSERT INTO `provs` VALUES ('40', '04', 'AREQUIPA', '1', '2017-03-06 11:05:31', '2017-03-06 11:05:31');
INSERT INTO `provs` VALUES ('41', '04', 'CAMANA', '1', '2017-03-07 11:05:31', '2017-03-07 11:05:31');
INSERT INTO `provs` VALUES ('42', '04', 'CARAVELI', '1', '2017-03-08 11:05:31', '2017-03-08 11:05:31');
INSERT INTO `provs` VALUES ('43', '04', 'CASTILLA', '1', '2017-03-09 11:05:31', '2017-03-09 11:05:31');
INSERT INTO `provs` VALUES ('44', '04', 'CAYLLOMA', '1', '2017-03-10 11:05:31', '2017-03-10 11:05:31');
INSERT INTO `provs` VALUES ('45', '04', 'CONDESUYOS', '1', '2017-03-11 11:05:31', '2017-03-11 11:05:31');
INSERT INTO `provs` VALUES ('46', '04', 'ISLAY', '1', '2017-03-12 11:05:31', '2017-03-12 11:05:31');
INSERT INTO `provs` VALUES ('47', '04', 'UNION', '1', '2017-03-13 11:05:31', '2017-03-13 11:05:31');
INSERT INTO `provs` VALUES ('48', '05', 'HUAMANGA', '1', '2017-03-14 11:05:31', '2017-03-14 11:05:31');
INSERT INTO `provs` VALUES ('49', '05', 'AYACUCHO', '1', '2017-03-15 11:05:31', '2017-03-15 11:05:31');
INSERT INTO `provs` VALUES ('50', '05', 'HUAMANGA', '1', '2017-03-16 11:05:31', '2017-03-16 11:05:31');
INSERT INTO `provs` VALUES ('51', '05', 'CANGALLO', '1', '2017-03-17 11:05:31', '2017-03-17 11:05:31');
INSERT INTO `provs` VALUES ('52', '05', 'HUANCA SANCOS', '1', '2017-03-18 11:05:31', '2017-03-18 11:05:31');
INSERT INTO `provs` VALUES ('53', '05', 'HUANTA', '1', '2017-03-19 11:05:31', '2017-03-19 11:05:31');
INSERT INTO `provs` VALUES ('54', '05', 'LA MAR', '1', '2017-03-20 11:05:31', '2017-03-20 11:05:31');
INSERT INTO `provs` VALUES ('55', '05', 'LUCANAS', '1', '2017-03-21 11:05:31', '2017-03-21 11:05:31');
INSERT INTO `provs` VALUES ('56', '05', 'PARINACOCHAS', '1', '2017-03-22 11:05:31', '2017-03-22 11:05:31');
INSERT INTO `provs` VALUES ('57', '05', 'PAUCAR DEL SARA SARA', '1', '2017-03-23 11:05:31', '2017-03-23 11:05:31');
INSERT INTO `provs` VALUES ('58', '05', 'SUCRE', '1', '2017-03-24 11:05:31', '2017-03-24 11:05:31');
INSERT INTO `provs` VALUES ('59', '05', 'VICTOR FAJARDO', '1', '2017-03-25 11:05:31', '2017-03-25 11:05:31');
INSERT INTO `provs` VALUES ('60', '05', 'VILCAS HUAMAN', '1', '2017-03-26 11:05:31', '2017-03-26 11:05:31');
INSERT INTO `provs` VALUES ('61', '06', 'SAN PABLO', '1', '2017-03-27 11:05:31', '2017-03-27 11:05:31');
INSERT INTO `provs` VALUES ('62', '06', 'CAJAMARCA', '1', '2017-03-28 11:05:31', '2017-03-28 11:05:31');
INSERT INTO `provs` VALUES ('63', '06', 'CELENDIN', '1', '2017-03-29 11:05:31', '2017-03-29 11:05:31');
INSERT INTO `provs` VALUES ('64', '06', 'CHOTA', '1', '2017-03-30 11:05:31', '2017-03-30 11:05:31');
INSERT INTO `provs` VALUES ('65', '06', 'CONTUMAZA', '1', '2017-03-31 11:05:31', '2017-03-31 11:05:31');
INSERT INTO `provs` VALUES ('66', '06', 'CUTERVO', '1', '2017-04-01 11:05:31', '2017-04-01 11:05:31');
INSERT INTO `provs` VALUES ('67', '06', 'HUALGAYOC', '1', '2017-04-02 11:05:31', '2017-04-02 11:05:31');
INSERT INTO `provs` VALUES ('68', '06', 'JAEN', '1', '2017-04-03 11:05:31', '2017-04-03 11:05:31');
INSERT INTO `provs` VALUES ('69', '06', 'SAN IGNACIO', '1', '2017-04-04 11:05:31', '2017-04-04 11:05:31');
INSERT INTO `provs` VALUES ('70', '06', 'SAN MARCOS', '1', '2017-04-05 11:05:31', '2017-04-05 11:05:31');
INSERT INTO `provs` VALUES ('71', '06', 'SAN MIGUEL', '1', '2017-04-06 11:05:31', '2017-04-06 11:05:31');
INSERT INTO `provs` VALUES ('72', '06', 'CAJAMARCA', '1', '2017-04-07 11:05:31', '2017-04-07 11:05:31');
INSERT INTO `provs` VALUES ('73', '06', 'SANTA CRUZ', '1', '2017-04-08 11:05:31', '2017-04-08 11:05:31');
INSERT INTO `provs` VALUES ('74', '07', 'CALLAO', '1', '2017-04-09 11:05:31', '2017-04-09 11:05:31');
INSERT INTO `provs` VALUES ('75', '07', 'XXX', '1', '2017-04-10 11:05:31', '2017-04-10 11:05:31');
INSERT INTO `provs` VALUES ('76', '08', 'CUSCO', '1', '2017-04-11 11:05:31', '2017-04-11 11:05:31');
INSERT INTO `provs` VALUES ('77', '08', 'ACOMAYO', '1', '2017-04-12 11:05:31', '2017-04-12 11:05:31');
INSERT INTO `provs` VALUES ('78', '08', 'ANTA', '1', '2017-04-13 11:05:31', '2017-04-13 11:05:31');
INSERT INTO `provs` VALUES ('79', '08', 'CALCA', '1', '2017-04-14 11:05:31', '2017-04-14 11:05:31');
INSERT INTO `provs` VALUES ('80', '08', 'CANAS', '1', '2017-04-15 11:05:31', '2017-04-15 11:05:31');
INSERT INTO `provs` VALUES ('81', '08', 'CANCHIS', '1', '2017-04-16 11:05:31', '2017-04-16 11:05:31');
INSERT INTO `provs` VALUES ('82', '08', 'CHUMBIVILCAS', '1', '2017-04-17 11:05:31', '2017-04-17 11:05:31');
INSERT INTO `provs` VALUES ('83', '08', 'ESPINAR', '1', '2017-04-18 11:05:31', '2017-04-18 11:05:31');
INSERT INTO `provs` VALUES ('84', '08', 'LA CONVENCION', '1', '2017-04-19 11:05:31', '2017-04-19 11:05:31');
INSERT INTO `provs` VALUES ('85', '08', 'PARURO', '1', '2017-04-20 11:05:31', '2017-04-20 11:05:31');
INSERT INTO `provs` VALUES ('86', '08', 'PAUCARTAMBO', '1', '2017-04-21 11:05:31', '2017-04-21 11:05:31');
INSERT INTO `provs` VALUES ('87', '08', 'QUISPICANCHI', '1', '2017-04-22 11:05:31', '2017-04-22 11:05:31');
INSERT INTO `provs` VALUES ('88', '08', 'URUBAMBA', '1', '2017-04-23 11:05:31', '2017-04-23 11:05:31');
INSERT INTO `provs` VALUES ('89', '09', 'HUANCAVELICA', '1', '2017-04-24 11:05:31', '2017-04-24 11:05:31');
INSERT INTO `provs` VALUES ('90', '09', 'ACOBAMBA', '1', '2017-04-25 11:05:31', '2017-04-25 11:05:31');
INSERT INTO `provs` VALUES ('91', '09', 'ANGARAES', '1', '2017-04-26 11:05:31', '2017-04-26 11:05:31');
INSERT INTO `provs` VALUES ('92', '09', 'CASTROVIRREYNA', '1', '2017-04-27 11:05:31', '2017-04-27 11:05:31');
INSERT INTO `provs` VALUES ('93', '09', 'CHURCAMPA', '1', '2017-04-28 11:05:31', '2017-04-28 11:05:31');
INSERT INTO `provs` VALUES ('94', '09', 'HUAYTARA', '1', '2017-04-29 11:05:31', '2017-04-29 11:05:31');
INSERT INTO `provs` VALUES ('95', '09', 'TAYACAJA', '1', '2017-04-30 11:05:31', '2017-04-30 11:05:31');
INSERT INTO `provs` VALUES ('96', '10', 'HUANUCO', '1', '2017-05-01 11:05:31', '2017-05-01 11:05:31');
INSERT INTO `provs` VALUES ('97', '10', 'AMBO', '1', '2017-05-02 11:05:31', '2017-05-02 11:05:31');
INSERT INTO `provs` VALUES ('98', '10', 'DOS DE MAYO', '1', '2017-05-03 11:05:31', '2017-05-03 11:05:31');
INSERT INTO `provs` VALUES ('99', '10', 'HUACAYBAMBA', '1', '2017-05-04 11:05:31', '2017-05-04 11:05:31');
INSERT INTO `provs` VALUES ('100', '10', 'HUAMALIES', '1', '2017-05-05 11:05:31', '2017-05-05 11:05:31');
INSERT INTO `provs` VALUES ('101', '10', 'LEONCIO PRADO', '1', '2017-05-06 11:05:31', '2017-05-06 11:05:31');
INSERT INTO `provs` VALUES ('102', '10', 'MARAÑON', '1', '2017-05-07 11:05:31', '2017-05-07 11:05:31');
INSERT INTO `provs` VALUES ('103', '10', 'PACHITEA', '1', '2017-05-08 11:05:31', '2017-05-08 11:05:31');
INSERT INTO `provs` VALUES ('104', '10', 'PUERTO INCA', '1', '2017-05-09 11:05:31', '2017-05-09 11:05:31');
INSERT INTO `provs` VALUES ('105', '10', 'LAURICOCHA', '1', '2017-05-10 11:05:31', '2017-05-10 11:05:31');
INSERT INTO `provs` VALUES ('106', '10', 'YAROWILCA', '1', '2017-05-11 11:05:31', '2017-05-11 11:05:31');
INSERT INTO `provs` VALUES ('107', '11', 'NAZCA', '1', '2017-05-12 11:05:31', '2017-05-12 11:05:31');
INSERT INTO `provs` VALUES ('108', '11', 'PALPA', '1', '2017-05-13 11:05:31', '2017-05-13 11:05:31');
INSERT INTO `provs` VALUES ('109', '11', 'PISCO', '1', '2017-05-14 11:05:31', '2017-05-14 11:05:31');
INSERT INTO `provs` VALUES ('110', '11', 'ICA', '1', '2017-05-15 11:05:31', '2017-05-15 11:05:31');
INSERT INTO `provs` VALUES ('111', '11', 'CHINCHA', '1', '2017-05-16 11:05:31', '2017-05-16 11:05:31');
INSERT INTO `provs` VALUES ('112', '11', 'NAZCA', '1', '2017-05-17 11:05:31', '2017-05-17 11:05:31');
INSERT INTO `provs` VALUES ('113', '12', 'JUNIN', '1', '2017-05-18 11:05:31', '2017-05-18 11:05:31');
INSERT INTO `provs` VALUES ('114', '12', 'HUANCAYO', '1', '2017-05-19 11:05:31', '2017-05-19 11:05:31');
INSERT INTO `provs` VALUES ('115', '12', 'CONCEPCION', '1', '2017-05-20 11:05:31', '2017-05-20 11:05:31');
INSERT INTO `provs` VALUES ('116', '12', 'CHANCHAMAYO', '1', '2017-05-21 11:05:31', '2017-05-21 11:05:31');
INSERT INTO `provs` VALUES ('117', '12', 'JAUJA', '1', '2017-05-22 11:05:31', '2017-05-22 11:05:31');
INSERT INTO `provs` VALUES ('118', '12', 'SATIPO', '1', '2017-05-23 11:05:31', '2017-05-23 11:05:31');
INSERT INTO `provs` VALUES ('119', '12', 'TARMA', '1', '2017-05-24 11:05:31', '2017-05-24 11:05:31');
INSERT INTO `provs` VALUES ('120', '12', 'YAULI', '1', '2017-05-25 11:05:31', '2017-05-25 11:05:31');
INSERT INTO `provs` VALUES ('121', '12', 'CHUPACA', '1', '2017-05-26 11:05:31', '2017-05-26 11:05:31');
INSERT INTO `provs` VALUES ('122', '13', 'VIRU', '1', '2017-05-27 11:05:31', '2017-05-27 11:05:31');
INSERT INTO `provs` VALUES ('123', '13', 'LA LIBERTAD', '1', '2017-05-28 11:05:31', '2017-05-28 11:05:31');
INSERT INTO `provs` VALUES ('124', '13', 'TRUJILLO', '1', '2017-05-29 11:05:31', '2017-05-29 11:05:31');
INSERT INTO `provs` VALUES ('125', '13', 'ASCOPE', '1', '2017-05-30 11:05:31', '2017-05-30 11:05:31');
INSERT INTO `provs` VALUES ('126', '13', 'BOLIVAR', '1', '2017-05-31 11:05:31', '2017-05-31 11:05:31');
INSERT INTO `provs` VALUES ('127', '13', 'CHEPEN', '1', '2017-06-01 11:05:31', '2017-06-01 11:05:31');
INSERT INTO `provs` VALUES ('128', '13', 'JULCAN', '1', '2017-06-02 11:05:31', '2017-06-02 11:05:31');
INSERT INTO `provs` VALUES ('129', '13', 'OTUZCO', '1', '2017-06-03 11:05:31', '2017-06-03 11:05:31');
INSERT INTO `provs` VALUES ('130', '13', 'PACASMAYO', '1', '2017-06-04 11:05:31', '2017-06-04 11:05:31');
INSERT INTO `provs` VALUES ('131', '13', 'PATAZ', '1', '2017-06-05 11:05:31', '2017-06-05 11:05:31');
INSERT INTO `provs` VALUES ('132', '13', 'SANCHEZ CARRION', '1', '2017-06-06 11:05:31', '2017-06-06 11:05:31');
INSERT INTO `provs` VALUES ('133', '13', 'SANTIAGO DE CHUCO', '1', '2017-06-07 11:05:31', '2017-06-07 11:05:31');
INSERT INTO `provs` VALUES ('134', '13', 'GRAN CHIMU', '1', '2017-06-08 11:05:31', '2017-06-08 11:05:31');
INSERT INTO `provs` VALUES ('135', '13', 'VIRU', '1', '2017-06-09 11:05:31', '2017-06-09 11:05:31');

-- ----------------------------
-- Table structure for reglas
-- ----------------------------
DROP TABLE IF EXISTS `reglas`;
CREATE TABLE `reglas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cierre` enum('SI','NO') COLLATE utf8_unicode_ci NOT NULL,
  `accion` enum('SI','NO') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'NO',
  `nb_accion` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tpfnivel1_id` int(10) unsigned NOT NULL,
  `tpfnivel2_id` int(10) unsigned DEFAULT NULL,
  `tpfnivel3_id` int(10) unsigned DEFAULT NULL,
  `tpfnivel4_id` int(10) unsigned DEFAULT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reglas_tpfnivel1_id_foreign` (`tpfnivel1_id`),
  KEY `reglas_tpfnivel2_id_foreign` (`tpfnivel2_id`),
  KEY `reglas_tpfnivel3_id_foreign` (`tpfnivel3_id`),
  KEY `reglas_tpfnivel4_id_foreign` (`tpfnivel4_id`),
  KEY `reglas_status_id_foreign` (`status_id`),
  CONSTRAINT `reglas_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  CONSTRAINT `reglas_tpfnivel1_id_foreign` FOREIGN KEY (`tpfnivel1_id`) REFERENCES `tpfnivel1` (`id`),
  CONSTRAINT `reglas_tpfnivel2_id_foreign` FOREIGN KEY (`tpfnivel2_id`) REFERENCES `tpfnivel2` (`id`),
  CONSTRAINT `reglas_tpfnivel3_id_foreign` FOREIGN KEY (`tpfnivel3_id`) REFERENCES `tpfnivel3` (`id`),
  CONSTRAINT `reglas_tpfnivel4_id_foreign` FOREIGN KEY (`tpfnivel4_id`) REFERENCES `tpfnivel4` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of reglas
-- ----------------------------
INSERT INTO `reglas` VALUES ('1', 'NO', 'SI', 'agendar-telefono/', '1', '1', '1', null, '5', '2017-01-31 01:43:45', '2017-01-31 01:43:45');
INSERT INTO `reglas` VALUES ('2', 'NO', 'NO', null, '1', '1', '2', null, '4', '2017-01-31 01:43:45', '2017-01-31 01:43:45');
INSERT INTO `reglas` VALUES ('3', 'NO', 'NO', null, '1', '1', '3', null, '6', '2017-01-31 01:43:45', '2017-01-31 01:43:45');
INSERT INTO `reglas` VALUES ('4', 'NO', 'NO', null, '1', '1', '4', null, '3', '2017-01-31 01:43:45', '2017-01-31 01:43:45');
INSERT INTO `reglas` VALUES ('5', 'NO', 'NO', null, '1', '1', '5', null, '3', '2017-01-31 01:43:45', '2017-01-31 01:43:45');
INSERT INTO `reglas` VALUES ('6', 'SI', 'NO', null, '1', '1', '6', '1', '8', '2017-01-31 01:43:45', '2017-01-31 01:43:45');
INSERT INTO `reglas` VALUES ('7', 'SI', 'NO', null, '1', '1', '6', '2', '8', '2017-01-31 01:43:45', '2017-01-31 01:43:45');
INSERT INTO `reglas` VALUES ('8', 'SI', 'NO', null, '1', '1', '6', '3', '8', '2017-01-31 01:43:45', '2017-01-31 01:43:45');
INSERT INTO `reglas` VALUES ('9', 'SI', 'NO', null, '1', '1', '6', '4', '8', '2017-01-31 01:43:45', '2017-01-31 01:43:45');
INSERT INTO `reglas` VALUES ('10', 'SI', 'NO', null, '1', '1', '6', '5', '8', '2017-01-31 01:43:45', '2017-01-31 01:43:45');
INSERT INTO `reglas` VALUES ('11', 'NO', 'NO', null, '1', '1', '7', null, '3', '2017-01-31 01:43:45', '2017-01-31 01:43:45');
INSERT INTO `reglas` VALUES ('12', 'SI', 'SI', 'venta-aprobada', '1', '1', '8', null, '7', '2017-01-31 01:43:45', '2017-01-31 01:43:45');
INSERT INTO `reglas` VALUES ('13', 'NO', 'NO', null, '1', '1', '9', null, '3', '2017-01-31 01:43:45', '2017-01-31 01:43:45');
INSERT INTO `reglas` VALUES ('14', 'NO', 'NO', null, '1', '2', null, null, '3', '2017-01-31 01:43:45', '2017-01-31 01:43:45');
INSERT INTO `reglas` VALUES ('15', 'NO', 'NO', null, '1', '3', null, null, '3', '2017-01-31 01:43:45', '2017-01-31 01:43:45');
INSERT INTO `reglas` VALUES ('16', 'NO', 'NO', null, '2', '4', null, null, '3', '2017-01-31 01:43:45', '2017-01-31 01:43:45');
INSERT INTO `reglas` VALUES ('17', 'NO', 'NO', null, '2', '5', null, null, '3', '2017-01-31 01:43:45', '2017-01-31 01:43:45');
INSERT INTO `reglas` VALUES ('18', 'NO', 'NO', null, '2', '6', null, null, '1', '2017-01-31 01:43:45', '2017-01-31 01:43:45');
INSERT INTO `reglas` VALUES ('19', 'SI', 'NO', null, '2', '7', null, null, '8', '2017-01-31 01:43:45', '2017-01-31 01:43:45');

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `submenu_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `roles_status_id_foreign` (`status_id`) USING BTREE,
  KEY `roles_user_id_foreign` (`user_id`) USING BTREE,
  KEY `roles_submenu_id_foreign` (`submenu_id`) USING BTREE,
  CONSTRAINT `roles_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  CONSTRAINT `roles_ibfk_2` FOREIGN KEY (`submenu_id`) REFERENCES `submenu` (`id`),
  CONSTRAINT `roles_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', '1', '1', '1', '2017-02-01 16:18:33', '2017-01-17 13:13:56');
INSERT INTO `roles` VALUES ('2', '1', '1', '2', '2017-02-01 16:18:36', '2017-01-17 13:13:52');
INSERT INTO `roles` VALUES ('30', '1', '1', '7', '2017-02-03 16:04:38', '2017-02-03 16:04:38');
INSERT INTO `roles` VALUES ('31', '1', '1', '4', '2017-02-03 16:04:42', '2017-02-03 16:04:42');
INSERT INTO `roles` VALUES ('32', '1', '1', '5', '2017-02-03 16:04:44', '2017-02-03 16:04:44');
INSERT INTO `roles` VALUES ('33', '1', '1', '8', '2017-02-03 16:04:45', '2017-02-03 16:04:45');
INSERT INTO `roles` VALUES ('34', '1', '1', '9', '2017-02-03 16:04:48', '2017-02-03 16:04:48');
INSERT INTO `roles` VALUES ('35', '1', '1', '12', '2017-02-03 16:04:51', '2017-02-03 16:04:51');
INSERT INTO `roles` VALUES ('36', '1', '1', '10', '2017-02-03 16:04:53', '2017-02-03 16:04:53');
INSERT INTO `roles` VALUES ('37', '1', '1', '11', '2017-02-03 16:04:54', '2017-02-03 16:04:54');
INSERT INTO `roles` VALUES ('38', '1', '1', '17', '2017-02-03 16:04:58', '2017-02-03 16:04:58');
INSERT INTO `roles` VALUES ('46', '1', '2', '4', '2017-02-03 06:01:56', '2017-02-03 06:01:56');
INSERT INTO `roles` VALUES ('47', '1', '2', '5', '2017-02-03 06:01:57', '2017-02-03 06:01:57');
INSERT INTO `roles` VALUES ('48', '1', '2', '8', '2017-02-03 06:01:57', '2017-02-03 06:01:57');
INSERT INTO `roles` VALUES ('49', '1', '2', '9', '2017-02-03 06:01:59', '2017-02-03 06:01:59');
INSERT INTO `roles` VALUES ('50', '1', '2', '12', '2017-02-03 06:02:00', '2017-02-03 06:02:00');
INSERT INTO `roles` VALUES ('51', '1', '2', '10', '2017-02-03 06:02:01', '2017-02-03 06:02:01');
INSERT INTO `roles` VALUES ('52', '1', '2', '11', '2017-02-03 06:02:02', '2017-02-03 06:02:02');

-- ----------------------------
-- Table structure for sexos
-- ----------------------------
DROP TABLE IF EXISTS `sexos`;
CREATE TABLE `sexos` (
  `id` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `nb_sexo` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sexos_status_id_foreign` (`status_id`),
  CONSTRAINT `sexos_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of sexos
-- ----------------------------
INSERT INTO `sexos` VALUES ('F', 'FEMENINO', '1', '2017-01-26 09:57:16', '2017-01-26 09:57:16');
INSERT INTO `sexos` VALUES ('M', 'MASCULINO', '1', '2017-01-26 09:57:16', '2017-01-26 09:57:16');

-- ----------------------------
-- Table structure for status
-- ----------------------------
DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nb_status` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of status
-- ----------------------------
INSERT INTO `status` VALUES ('0', 'ASIGNAR', '2017-02-03 11:22:48', null);
INSERT INTO `status` VALUES ('1', 'ACTIVO', '2017-01-27 13:56:34', null);
INSERT INTO `status` VALUES ('2', 'INACTIVO', '2017-01-27 13:56:30', null);
INSERT INTO `status` VALUES ('3', 'ASIGNADOS', '2017-01-27 13:56:27', null);
INSERT INTO `status` VALUES ('4', 'PROSPECTADOS', '2017-01-27 14:26:25', null);
INSERT INTO `status` VALUES ('5', 'AGENDADOS', '2017-01-31 01:26:06', null);
INSERT INTO `status` VALUES ('6', 'TOCADOS /NO TAC', '2017-01-31 01:31:27', null);
INSERT INTO `status` VALUES ('7', 'VENTA', '2017-01-31 01:34:30', null);
INSERT INTO `status` VALUES ('8', 'NO VENTA', '2017-01-31 01:34:41', null);
INSERT INTO `status` VALUES ('9', 'PRES. EFECTIVA', '2017-01-31 07:52:38', null);

-- ----------------------------
-- Table structure for submenu
-- ----------------------------
DROP TABLE IF EXISTS `submenu`;
CREATE TABLE `submenu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status_id` int(10) unsigned NOT NULL,
  `menu_id` int(10) unsigned NOT NULL,
  `nombre` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `ruta` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `orden` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `submenu_status_id_foreign` (`status_id`) USING BTREE,
  KEY `submenu_menu_id_foreign` (`menu_id`) USING BTREE,
  CONSTRAINT `submenu_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`),
  CONSTRAINT `submenu_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of submenu
-- ----------------------------
INSERT INTO `submenu` VALUES ('1', '1', '1', 'Listado Usuarios', 'listado-usuarios', 'fa fa-users', '1', '2017-01-26 07:45:46', '2017-01-26 07:45:46');
INSERT INTO `submenu` VALUES ('2', '1', '1', 'Agregar Usuario', 'usuario-create', 'fa fa-user-plus', '1', '2017-01-26 07:45:46', '2017-01-26 07:45:46');
INSERT INTO `submenu` VALUES ('4', '3', '3', 'Asignado', 'clientes-asignados', 'fa fa-thumbs-o-up', '2', '2017-01-26 07:45:46', '2017-01-26 07:45:46');
INSERT INTO `submenu` VALUES ('5', '6', '3', 'Tocados - No Cont.', 'clientes-tocados', 'fa fa-hand-o-up', '3', '2017-01-26 07:45:46', '2017-01-26 07:45:46');
INSERT INTO `submenu` VALUES ('7', '0', '3', 'Asignar', 'clientes-asignar', 'fa fa-universal-access', '1', '2017-01-26 07:45:46', '2017-01-26 07:45:46');
INSERT INTO `submenu` VALUES ('8', '4', '3', 'Prospectados', 'clientes-prospectado', 'fa fa-hand-peace-o', '4', '2017-01-26 07:45:46', '2017-01-26 07:45:46');
INSERT INTO `submenu` VALUES ('9', '9', '3', 'Presentación Efectiva', 'clientes-efectiva', 'fa fa-television', '5', '2017-01-26 07:45:46', '2017-01-26 07:45:46');
INSERT INTO `submenu` VALUES ('10', '7', '3', 'Ventas', 'clientes-ventas', 'fa fa-paper-plane-o', '6', '2017-01-26 07:45:46', '2017-01-26 07:45:46');
INSERT INTO `submenu` VALUES ('11', '8', '3', 'No Ventas', 'clientes-noventa', 'fa fa-thumbs-o-down', '7', '2017-01-26 07:45:46', '2017-01-26 07:45:46');
INSERT INTO `submenu` VALUES ('12', '5', '3', 'Agendados', 'clientes-agendado', 'fa fa-star-o', '8', '2017-01-31 08:11:21', '2017-01-31 08:11:44');
INSERT INTO `submenu` VALUES ('17', '1', '4', 'Generar TXT', 'genera-txt', 'fa fa-file-text-o', '1', '2017-02-02 08:15:45', '2017-02-02 08:15:51');
INSERT INTO `submenu` VALUES ('18', '2', '4', 'Data Cruda', 'data-cruda', 'fa fa-file-excel-o', '2', '2017-02-02 08:17:12', '2017-02-02 08:17:18');

-- ----------------------------
-- Table structure for tarjetascuentas
-- ----------------------------
DROP TABLE IF EXISTS `tarjetascuentas`;
CREATE TABLE `tarjetascuentas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `clientes_id` int(10) unsigned NOT NULL,
  `contratante_id` int(10) unsigned NOT NULL,
  `emisora_id` int(2) unsigned NOT NULL,
  `procesadora_id` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `tipoproducto_id` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `nro` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ff_vencimiento` date NOT NULL,
  `titular` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tarjetascuentas_emisora_id_foreign` (`emisora_id`),
  KEY `tarjetascuentas_procesadora_id_foreign` (`procesadora_id`),
  KEY `tarjetascuentas_tipoproducto_id_foreign` (`tipoproducto_id`),
  KEY `tarjetascuentas_status_id_foreign` (`status_id`),
  KEY `tarjetascuentas_clientes_id_foreign` (`clientes_id`),
  KEY `tarjetascuentas_contratante_id_foreign` (`contratante_id`),
  CONSTRAINT `tarjetascuentas_clientes_id_foreign` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`id`),
  CONSTRAINT `tarjetascuentas_contratante_id_foreign` FOREIGN KEY (`contratante_id`) REFERENCES `contratantes` (`id`),
  CONSTRAINT `tarjetascuentas_emisora_id_foreign` FOREIGN KEY (`emisora_id`) REFERENCES `emisoras` (`id`),
  CONSTRAINT `tarjetascuentas_procesadora_id_foreign` FOREIGN KEY (`procesadora_id`) REFERENCES `procesadoras` (`id`),
  CONSTRAINT `tarjetascuentas_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  CONSTRAINT `tarjetascuentas_tipoproducto_id_foreign` FOREIGN KEY (`tipoproducto_id`) REFERENCES `tipoproductos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tarjetascuentas
-- ----------------------------

-- ----------------------------
-- Table structure for tipopagos
-- ----------------------------
DROP TABLE IF EXISTS `tipopagos`;
CREATE TABLE `tipopagos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_pago` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tipopagos_status_id_foreign` (`status_id`),
  CONSTRAINT `tipopagos_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tipopagos
-- ----------------------------
INSERT INTO `tipopagos` VALUES ('1', 'Pago Anual Contado', '1', null, null);
INSERT INTO `tipopagos` VALUES ('2', 'Pago Mensual Recurrente', '1', null, null);

-- ----------------------------
-- Table structure for tipoproductos
-- ----------------------------
DROP TABLE IF EXISTS `tipoproductos`;
CREATE TABLE `tipoproductos` (
  `id` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `nb_producto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tipoproductos_status_id_foreign` (`status_id`),
  CONSTRAINT `tipoproductos_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tipoproductos
-- ----------------------------
INSERT INTO `tipoproductos` VALUES ('004', 'Tarjeta Visa', '1', '2017-02-01 20:55:56', '2017-02-01 20:55:56');
INSERT INTO `tipoproductos` VALUES ('005', 'Tarjeta Amex', '1', '2017-02-01 20:55:56', '2017-02-01 20:55:56');
INSERT INTO `tipoproductos` VALUES ('006', 'Tarjeta Mastercard', '1', '2017-02-01 20:55:56', '2017-02-01 20:55:56');
INSERT INTO `tipoproductos` VALUES ('009', 'Diners', '1', '2017-02-01 20:55:56', '2017-02-01 20:55:56');

-- ----------------------------
-- Table structure for toques
-- ----------------------------
DROP TABLE IF EXISTS `toques`;
CREATE TABLE `toques` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `max_toques` int(11) NOT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `toques_status_id_foreign` (`status_id`),
  CONSTRAINT `toques_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of toques
-- ----------------------------
INSERT INTO `toques` VALUES ('1', '3', '1', '2017-01-30 19:11:34', '2017-01-30 19:11:37');

-- ----------------------------
-- Table structure for toques_telefono
-- ----------------------------
DROP TABLE IF EXISTS `toques_telefono`;
CREATE TABLE `toques_telefono` (
  `id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `toques` int(11) NOT NULL,
  `clientes_id` int(10) unsigned NOT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `toques_telefono_clientes_id_foreign` (`clientes_id`),
  KEY `toques_telefono_status_id_foreign` (`status_id`),
  CONSTRAINT `toques_telefono_clientes_id_foreign` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`id`),
  CONSTRAINT `toques_telefono_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of toques_telefono
-- ----------------------------
INSERT INTO `toques_telefono` VALUES ('0212323', '3', '66', '1', '2017-02-03 06:04:33', '2017-02-03 06:08:14');
INSERT INTO `toques_telefono` VALUES ('02123473517', '2', '67', '1', '2017-02-03 05:21:33', '2017-02-03 09:17:57');
INSERT INTO `toques_telefono` VALUES ('02123483748', '1', '71', '1', '2017-02-03 09:16:40', '2017-02-03 09:16:40');
INSERT INTO `toques_telefono` VALUES ('992773354', '4', '66', '1', '2017-02-03 06:09:27', '2017-02-03 09:29:41');
INSERT INTO `toques_telefono` VALUES ('997340043', '2', '17', '1', '2017-02-08 04:50:17', '2017-02-08 05:04:19');

-- ----------------------------
-- Table structure for tpfnivel1
-- ----------------------------
DROP TABLE IF EXISTS `tpfnivel1`;
CREATE TABLE `tpfnivel1` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nb_tpfnivel1` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `orden` int(11) NOT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tpfnivel1_status_id_foreign` (`status_id`),
  CONSTRAINT `tpfnivel1_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tpfnivel1
-- ----------------------------
INSERT INTO `tpfnivel1` VALUES ('1', 'CONTACTADO', '1', '1', '2017-01-27 20:58:06', '2017-01-27 20:58:06');
INSERT INTO `tpfnivel1` VALUES ('2', 'NO CONTACTADO', '2', '1', '2017-01-27 20:58:06', '2017-01-27 20:58:06');

-- ----------------------------
-- Table structure for tpfnivel2
-- ----------------------------
DROP TABLE IF EXISTS `tpfnivel2`;
CREATE TABLE `tpfnivel2` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tpfnivel1_id` int(10) unsigned NOT NULL,
  `nb_tpfnivel2` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `orden` int(11) NOT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tpfnivel2_tpfnivel1_id_foreign` (`tpfnivel1_id`),
  KEY `tpfnivel2_status_id_foreign` (`status_id`),
  CONSTRAINT `tpfnivel2_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  CONSTRAINT `tpfnivel2_tpfnivel1_id_foreign` FOREIGN KEY (`tpfnivel1_id`) REFERENCES `tpfnivel1` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tpfnivel2
-- ----------------------------
INSERT INTO `tpfnivel2` VALUES ('1', '1', 'CON GESTION', '1', '1', '2017-01-27 20:58:38', '2017-01-27 20:58:38');
INSERT INTO `tpfnivel2` VALUES ('2', '1', 'SIN GESTION', '2', '1', '2017-01-27 20:58:38', '2017-01-27 20:58:38');
INSERT INTO `tpfnivel2` VALUES ('3', '1', 'ABANDONO', '3', '1', '2017-01-27 20:58:38', '2017-01-27 20:58:38');
INSERT INTO `tpfnivel2` VALUES ('4', '2', 'MAQUINA', '1', '1', '2017-01-27 20:58:38', '2017-01-27 20:58:38');
INSERT INTO `tpfnivel2` VALUES ('5', '2', 'NO CONTESTA', '2', '1', '2017-01-27 20:58:38', '2017-01-27 20:58:38');
INSERT INTO `tpfnivel2` VALUES ('6', '2', 'OCUPADO', '3', '1', '2017-01-27 20:58:38', '2017-01-27 20:58:38');
INSERT INTO `tpfnivel2` VALUES ('7', '2', 'NO EXISTE', '4', '1', '2017-01-27 20:58:38', '2017-01-27 20:58:38');

-- ----------------------------
-- Table structure for tpfnivel3
-- ----------------------------
DROP TABLE IF EXISTS `tpfnivel3`;
CREATE TABLE `tpfnivel3` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tpfnivel2_id` int(10) unsigned NOT NULL,
  `nb_tpfnivel3` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `orden` int(11) NOT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tpfnivel3_tpfnivel2_id_foreign` (`tpfnivel2_id`),
  KEY `tpfnivel3_status_id_foreign` (`status_id`),
  CONSTRAINT `tpfnivel3_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  CONSTRAINT `tpfnivel3_tpfnivel2_id_foreign` FOREIGN KEY (`tpfnivel2_id`) REFERENCES `tpfnivel2` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tpfnivel3
-- ----------------------------
INSERT INTO `tpfnivel3` VALUES ('1', '1', 'AGENDADO', '1', '1', '2017-01-27 21:03:34', '2017-01-27 21:03:34');
INSERT INTO `tpfnivel3` VALUES ('2', '1', 'CLIENTE CRITICO', '2', '1', '2017-01-27 21:03:34', '2017-01-27 21:03:34');
INSERT INTO `tpfnivel3` VALUES ('3', '1', 'CONTESTADORA', '3', '1', '2017-01-27 21:03:34', '2017-01-27 21:03:34');
INSERT INTO `tpfnivel3` VALUES ('4', '1', 'LLAMADA CORTADA', '4', '1', '2017-01-27 21:03:34', '2017-01-27 21:03:34');
INSERT INTO `tpfnivel3` VALUES ('5', '1', 'NO COLABORA', '5', '1', '2017-01-27 21:03:34', '2017-01-27 21:03:34');
INSERT INTO `tpfnivel3` VALUES ('6', '1', 'NO VENTA', '6', '1', '2017-01-27 21:03:34', '2017-01-27 21:03:34');
INSERT INTO `tpfnivel3` VALUES ('7', '1', 'REGISTRO ERRONEO', '7', '1', '2017-01-27 21:03:34', '2017-01-27 21:03:34');
INSERT INTO `tpfnivel3` VALUES ('8', '1', 'VENTA', '8', '1', '2017-01-27 21:03:34', '2017-01-27 21:03:34');
INSERT INTO `tpfnivel3` VALUES ('9', '1', 'VOLVER A LLAMAR', '9', '1', '2017-01-27 21:03:34', '2017-01-27 21:03:34');

-- ----------------------------
-- Table structure for tpfnivel4
-- ----------------------------
DROP TABLE IF EXISTS `tpfnivel4`;
CREATE TABLE `tpfnivel4` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tpfnivel3_id` int(10) unsigned NOT NULL,
  `nb_tpfnivel4` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `orden` int(11) NOT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tpfnivel4_tpfnivel3_id_foreign` (`tpfnivel3_id`),
  KEY `tpfnivel4_status_id_foreign` (`status_id`),
  CONSTRAINT `tpfnivel4_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  CONSTRAINT `tpfnivel4_tpfnivel3_id_foreign` FOREIGN KEY (`tpfnivel3_id`) REFERENCES `tpfnivel3` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tpfnivel4
-- ----------------------------
INSERT INTO `tpfnivel4` VALUES ('1', '6', 'YA ES CLIENTE', '1', '1', '2017-01-27 21:05:58', '2017-01-27 21:05:58');
INSERT INTO `tpfnivel4` VALUES ('2', '6', 'TIENEN EN OTRO LADO', '2', '1', '2017-01-27 21:05:58', '2017-01-27 21:05:58');
INSERT INTO `tpfnivel4` VALUES ('3', '6', 'NO NECESITA', '3', '1', '2017-01-27 21:05:58', '2017-01-27 21:05:58');
INSERT INTO `tpfnivel4` VALUES ('4', '6', 'NO LE INTERESA', '4', '1', '2017-01-27 21:05:58', '2017-01-27 21:05:58');
INSERT INTO `tpfnivel4` VALUES ('5', '6', 'LE PARECE CARO', '5', '1', '2017-01-27 21:05:58', '2017-01-27 21:05:58');

-- ----------------------------
-- Table structure for ubigeos
-- ----------------------------
DROP TABLE IF EXISTS `ubigeos`;
CREATE TABLE `ubigeos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `prov_id` int(10) unsigned NOT NULL,
  `nb_ubigeo` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `co_ubigeo` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ubigeos_prov_id_foreign` (`prov_id`),
  KEY `ubigeos_status_id_foreign` (`status_id`),
  CONSTRAINT `ubigeos_prov_id_foreign` FOREIGN KEY (`prov_id`) REFERENCES `provs` (`id`),
  CONSTRAINT `ubigeos_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of ubigeos
-- ----------------------------
INSERT INTO `ubigeos` VALUES ('1', '1', 'PERU', '000000', '1', '2017-01-26 11:29:23', '2017-01-26 11:29:23');
INSERT INTO `ubigeos` VALUES ('2', '2', 'CHACHAPOYAS', '010100', '1', '2017-01-26 11:29:23', '2017-01-26 11:29:23');
INSERT INTO `ubigeos` VALUES ('5', '2', 'CHACHAPOYAS', '010101', '1', '2017-01-26 11:29:23', '2017-01-26 11:29:23');
INSERT INTO `ubigeos` VALUES ('6', '2', 'ASUNCION', '010102', '1', '2017-01-26 11:29:23', '2017-01-26 11:29:23');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` enum('AGENTES','SUPERVISOR','ADMINISTRADOR','CLIENTE') COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_id` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`) USING BTREE,
  KEY `users_status_id_foreign` (`status_id`),
  CONSTRAINT `users_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'Germain R Bueno T', 'gerbless@gmail.com', '$2y$10$qf0wz6sa8wK1MAXmgugMl.dtNDfNFgm4AQktixnbn9LW2ypLP81cO', 'ADMINISTRADOR', 'qL9vpUvqAnamc8Eb5f3WMEShgaGX5Cf1IU884xzj1bypsSBEhY8q1ss8HvMo', '2016-12-27 15:51:46', '2017-02-22 16:50:48', '1');
INSERT INTO `users` VALUES ('2', 'Asdrubal Bandres', 'abandres@gmail.com', '$2y$10$veAHlDD5lGJ/5/TNKx7R/uYxjN2cqGpFTY9f5WjHXLIsEeZC/F0hK', 'AGENTES', 'F0NUh2IgaeLlEESBH2D4KBCM01om9BSh0iC3ZYKGoIc2lKX7D8UPyz713wb2', '2017-02-01 20:23:38', '2017-02-03 06:23:08', '1');
INSERT INTO `users` VALUES ('3', 'Andres Villegas', 'andres@gmail.com', '$2y$10$OnV8pQyDZZ2bsktfH1thQOMPG3VYLnaFqY2hp66ZOUn41/r/O3qZ.', 'AGENTES', null, '2017-02-02 02:57:32', '2017-02-02 12:19:16', '1');
INSERT INTO `users` VALUES ('4', 'operador', 'operador@gmail.com', '$2y$10$Yu36ci18jHD9MlrBalE.NeBtzm53DBaOA.uWwTNzhLMZz8HdEuUI6', 'AGENTES', '2h3rhnLl42Ug00D01t970MBl8w9oQTdhm2KOKU9MhSCsahIa1AetFJM9rpjh', '2017-02-02 06:19:23', '2017-02-03 16:00:30', '1');

-- ----------------------------
-- Table structure for vendedores
-- ----------------------------
DROP TABLE IF EXISTS `vendedores`;
CREATE TABLE `vendedores` (
  `id` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `nb_vendedor` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vendedores_status_id_foreign` (`status_id`),
  CONSTRAINT `vendedores_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of vendedores
-- ----------------------------
INSERT INTO `vendedores` VALUES ('111111', 'vendedor 1', '1', '2017-02-02 13:31:39', '2017-02-02 13:31:42');
INSERT INTO `vendedores` VALUES ('222222', 'vendedor2', '1', '2017-02-02 13:31:59', '2017-02-02 13:32:02');

-- ----------------------------
-- Table structure for ventas
-- ----------------------------
DROP TABLE IF EXISTS `ventas`;
CREATE TABLE `ventas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `clientes_id` int(10) unsigned NOT NULL,
  `contratante_id` int(10) unsigned NOT NULL,
  `agencia_id` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `vendedor_id` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ventas_clientes_id_foreign` (`clientes_id`),
  KEY `ventas_contratante_id_foreign` (`contratante_id`),
  KEY `ventas_agencia_id_foreign` (`agencia_id`),
  KEY `ventas_vendedor_id_foreign` (`vendedor_id`),
  KEY `ventas_status_id_foreign` (`status_id`),
  CONSTRAINT `ventas_agencia_id_foreign` FOREIGN KEY (`agencia_id`) REFERENCES `agencias` (`id`),
  CONSTRAINT `ventas_clientes_id_foreign` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`id`),
  CONSTRAINT `ventas_contratante_id_foreign` FOREIGN KEY (`contratante_id`) REFERENCES `contratantes` (`id`),
  CONSTRAINT `ventas_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  CONSTRAINT `ventas_vendedor_id_foreign` FOREIGN KEY (`vendedor_id`) REFERENCES `vendedores` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of ventas
-- ----------------------------
