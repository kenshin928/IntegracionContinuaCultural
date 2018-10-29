/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.7.19 : Database - thexperto
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sic` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `sic`;

/*Table structure for table `carpeta` */

DROP TABLE IF EXISTS `carpeta`;

CREATE TABLE `carpeta` (
  `idCarpeta` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `idCarpetaPadre` INT(11) DEFAULT NULL,
  `codigo` VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` VARCHAR(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` TINYINT(1) NOT NULL DEFAULT '1',
  `fechaCreacion` DATETIME NOT NULL,
  `fechaModificacion` DATETIME NOT NULL,
  `idUsuarioCreacion` INT(11) NOT NULL,
  `idUsuarioModificacion` INT(11) NOT NULL,
  PRIMARY KEY (`idCarpeta`)
) ENGINE=INNODB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `formulario` */

DROP TABLE IF EXISTS `formulario`;

CREATE TABLE `formulario` (
  `idFormulario` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `idCarpeta` INT(11) NOT NULL,
  `nombreFormulario` VARCHAR(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ruta` VARCHAR(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icono` VARCHAR(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` TINYINT(1) NOT NULL DEFAULT '1',
  `fechaCreacion` DATETIME NOT NULL,
  `fechaModificacion` DATETIME NOT NULL,
  `idUsuarioCreacion` INT(11) NOT NULL,
  `idUsuarioModificacion` INT(11) NOT NULL,
  PRIMARY KEY (`idFormulario`)
) ENGINE=INNODB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` INT(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `reinicio_clave` */

DROP TABLE IF EXISTS `reinicio_clave`;

CREATE TABLE `reinicio_clave` (
  `idReinicioClave` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `idUsuario` INT(10) UNSIGNED NOT NULL,
  `token` VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fechaCreacion` DATETIME DEFAULT NULL,
  `fechaModificacion` DATETIME DEFAULT NULL,
  `idUsuarioCreacion` INT(11) DEFAULT NULL,
  `idUsuarioModificacion` INT(11) DEFAULT NULL,
  PRIMARY KEY (`idReinicioClave`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `rol` */

DROP TABLE IF EXISTS `rol`;

CREATE TABLE `rol` (
  `idRol` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` TINYINT(1) NOT NULL DEFAULT '1',
  `fechaCreacion` DATETIME NOT NULL,
  `fechaModificacion` DATETIME NOT NULL,
  `idUsuarioCreacion` INT(11) NOT NULL,
  `idUsuarioModificacion` INT(11) NOT NULL,
  PRIMARY KEY (`idRol`)
) ENGINE=INNODB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `rolformulario` */

DROP TABLE IF EXISTS `rolformulario`;

CREATE TABLE `rolformulario` (
  `idRolFormulario` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `idRol` INT(10) UNSIGNED NOT NULL,
  `idFormulario` INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`idRolFormulario`)
) ENGINE=INNODB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `rolusuario` */

DROP TABLE IF EXISTS `rolusuario`;

CREATE TABLE `rolusuario` (
  `idRolUsuario` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `idRol` INT(11) NOT NULL,
  `idUsuario` BIGINT(20) NOT NULL,
  PRIMARY KEY (`idRolUsuario`)
) ENGINE=INNODB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `tercero` */

DROP TABLE IF EXISTS `tercero`;

CREATE TABLE `tercero` (
  `idTercero` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `idTipoDocumento` INT(11) NOT NULL,
  `nit` VARCHAR(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `digitoVerificacion` INT(11) NOT NULL,
  `primerNombre` VARCHAR(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `segundoNombre` VARCHAR(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `primerApellido` VARCHAR(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `segundoApellido` VARCHAR(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `razonSocial` VARCHAR(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` VARCHAR(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefonoFijo` VARCHAR(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `celular` VARCHAR(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fechaNacimiento` DATE DEFAULT NULL,
  `email` VARCHAR(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` TINYINT(1) NOT NULL DEFAULT '1',
  `fechaCreacion` DATETIME NOT NULL,
  `fechaModificacion` DATETIME NOT NULL,
  `idUsuarioCreacion` INT(11) NOT NULL,
  `idUsuarioModificacion` INT(11) NOT NULL,
  PRIMARY KEY (`idTercero`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `tipodocumento` */

DROP TABLE IF EXISTS `tipodocumento`;

CREATE TABLE `tipodocumento` (
  `idTipoDocumento` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `codigo` VARCHAR(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` VARCHAR(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` TINYINT(1) NOT NULL DEFAULT '1',
  `fechaCreacion` DATETIME NOT NULL,
  `fechaModificacion` DATETIME NOT NULL,
  `idUsuarioCreacion` INT(11) NOT NULL,
  `idUsuarioModificacion` INT(11) NOT NULL,
  PRIMARY KEY (`idTipoDocumento`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `idUsuario` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `codigo` VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clave` VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `administrador` ENUM('0','1') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` TINYINT(1) NOT NULL DEFAULT '1',
  `fechaCreacion` DATETIME NOT NULL,
  `fechaModificacion` DATETIME NOT NULL,
  `idUsuarioCreacion` INT(11) NOT NULL,
  `idUsuarioModificacion` INT(11) NOT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=INNODB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
