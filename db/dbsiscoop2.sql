-- MySQL Script generated by MySQL Workbench
-- 03/01/19 15:06:02
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema dbsiscoop2
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema dbsiscoop2
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `dbsiscoop2` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `dbsiscoop2` ;

-- -----------------------------------------------------
-- Table `dbsiscoop2`.`categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbsiscoop2`.`categoria` (
  `idcategoria` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL,
  `nombre_corto` VARCHAR(5) NOT NULL,
  `descripcion` VARCHAR(256) NULL,
  `condicion` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idcategoria`),
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC),
  UNIQUE INDEX `nombre_corto_UNIQUE` (`nombre_corto` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbsiscoop2`.`planc`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbsiscoop2`.`planc` (
  `idplanc` INT NOT NULL AUTO_INCREMENT,
  `codigo` VARCHAR(50) NOT NULL,
  `nombre` VARCHAR(100) NOT NULL,
  `descripcion` VARCHAR(256) NULL,
  `condicion` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idplanc`),
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbsiscoop2`.`socio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbsiscoop2`.`socio` (
  `idsocio` INT NOT NULL AUTO_INCREMENT,
  `nsocio` INT NOT NULL,
  `tipo_persona` VARCHAR(20) NOT NULL,
  `nombre` VARCHAR(100) NOT NULL,
  `tipo_documento` VARCHAR(20) NOT NULL,
  `num_documento` VARCHAR(20) NOT NULL,
  `direccion` VARCHAR(70) NOT NULL,
  `telefono` VARCHAR(20) NULL,
  `email` VARCHAR(50) NULL,
  `fecha_nac` VARCHAR(20) NULL,
  `fecha_ins` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `condicion` VARCHAR(8) NOT NULL DEFAULT 'Activo',
  PRIMARY KEY (`idsocio`),
  UNIQUE INDEX `nsocio_UNIQUE` (`nsocio` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbsiscoop2`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbsiscoop2`.`usuario` (
  `idusuario` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `tipo_documento` VARCHAR(20) NOT NULL,
  `num_documento` VARCHAR(20) NOT NULL,
  `direccion` VARCHAR(70) NULL,
  `telefono` VARCHAR(20) NULL,
  `email` VARCHAR(50) NULL,
  `cargo` VARCHAR(20) NULL,
  `login` VARCHAR(20) NOT NULL,
  `clave` VARCHAR(64) NOT NULL,
  `imagen` VARCHAR(50) NULL,
  `condicion` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idusuario`),
  UNIQUE INDEX `login_UNIQUE` (`login` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbsiscoop2`.`contrato`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbsiscoop2`.`contrato` (
  `idcontrato` INT NOT NULL AUTO_INCREMENT,
  `idsocio` INT NOT NULL,
  `ncontrato` INT NOT NULL,
  `fecha` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `condicion` VARCHAR(15) NOT NULL DEFAULT 'Activo',
  PRIMARY KEY (`idcontrato`),
  INDEX `fk_contrato_socio_idx` (`idsocio` ASC),
  CONSTRAINT `fk_contrato_socio`
    FOREIGN KEY (`idsocio`)
    REFERENCES `dbsiscoop2`.`socio` (`idsocio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbsiscoop2`.`ingreso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbsiscoop2`.`ingreso` (
  `idingreso` INT NOT NULL AUTO_INCREMENT,
  `idsocio` INT NOT NULL,
  `idusuario` INT NOT NULL,
  `idcontrato` INT NOT NULL,
  `num_comprobante` INT NOT NULL,
  `fecha_hora` DATETIME NOT NULL,
  `total_ingreso` DECIMAL(11,2) NOT NULL,
  `estado` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`idingreso`),
  INDEX `fk_ingreso_socio_idx` (`idsocio` ASC),
  INDEX `fk_ingreso_usuario_idx` (`idusuario` ASC),
  INDEX `fk_ingreso_contrato_idx` (`idcontrato` ASC),
  CONSTRAINT `fk_ingreso_socio`
    FOREIGN KEY (`idsocio`)
    REFERENCES `dbsiscoop2`.`socio` (`idsocio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ingreso_usuario`
    FOREIGN KEY (`idusuario`)
    REFERENCES `dbsiscoop2`.`usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ingreso_contrato`
    FOREIGN KEY (`idcontrato`)
    REFERENCES `dbsiscoop2`.`contrato` (`idcontrato`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbsiscoop2`.`detalle_ingreso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbsiscoop2`.`detalle_ingreso` (
  `iddetalle_ingreso` INT NOT NULL AUTO_INCREMENT,
  `idingreso` INT NOT NULL,
  `idplanc` INT NOT NULL,
  `idcategoria` INT NOT NULL,
  `semana` INT NOT NULL,
  `cantidad_ingreso` DECIMAL(11,2) NOT NULL,
  PRIMARY KEY (`iddetalle_ingreso`),
  INDEX `fk_detalle_ingreso_ingreso_idx` (`idingreso` ASC),
  INDEX `fk_detalle_ingreso_planc_idx` (`idplanc` ASC),
  INDEX `fk_detalle_ingreso_categoria_idx` (`idcategoria` ASC),
  CONSTRAINT `fk_detalle_ingreso_ingreso`
    FOREIGN KEY (`idingreso`)
    REFERENCES `dbsiscoop2`.`ingreso` (`idingreso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalle_ingreso_planc`
    FOREIGN KEY (`idplanc`)
    REFERENCES `dbsiscoop2`.`planc` (`idplanc`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalle_ingreso_categoria`
    FOREIGN KEY (`idcategoria`)
    REFERENCES `dbsiscoop2`.`categoria` (`idcategoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbsiscoop2`.`egreso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbsiscoop2`.`egreso` (
  `idegreso` INT NOT NULL AUTO_INCREMENT,
  `idsocio` INT NOT NULL,
  `idusuario` INT NOT NULL,
  `idcontrato` INT NOT NULL,
  `tipo_comprobante` VARCHAR(20) NOT NULL,
  `serie_comprobante` VARCHAR(7) NULL,
  `num_comprobante` VARCHAR(10) NOT NULL,
  `fecha_hora` DATETIME NOT NULL,
  `total_egreso` DECIMAL(11,2) NOT NULL,
  `estado` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`idegreso`),
  INDEX `fk_egreso_socio_idx` (`idsocio` ASC),
  INDEX `fk_egreso_usuario_idx` (`idusuario` ASC),
  INDEX `fk_egreso_contrato_idx` (`idcontrato` ASC),
  CONSTRAINT `fk_egreso_socio`
    FOREIGN KEY (`idsocio`)
    REFERENCES `dbsiscoop2`.`socio` (`idsocio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_egreso_usuario`
    FOREIGN KEY (`idusuario`)
    REFERENCES `dbsiscoop2`.`usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_egreso_contrato`
    FOREIGN KEY (`idcontrato`)
    REFERENCES `dbsiscoop2`.`contrato` (`idcontrato`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbsiscoop2`.`detalle_egreso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbsiscoop2`.`detalle_egreso` (
  `iddetalle_egreso` INT NOT NULL AUTO_INCREMENT,
  `idingreso` INT NOT NULL,
  `idplanc` INT NOT NULL,
  `idcategoria` INT NOT NULL,
  `semana` INT NOT NULL,
  `cantidad_egreso` DECIMAL(11,2) NOT NULL,
  PRIMARY KEY (`iddetalle_egreso`),
  INDEX `fk_detalle_egreso_planc_idx` (`idplanc` ASC),
  INDEX `fk_detalle_egreso_ingreso_idx` (`idingreso` ASC),
  INDEX `fk_detalle_egreso_categoria_idx` (`idcategoria` ASC),
  CONSTRAINT `fk_detalle_egreso_planc`
    FOREIGN KEY (`idplanc`)
    REFERENCES `dbsiscoop2`.`planc` (`idplanc`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalle_egreso_ingreso`
    FOREIGN KEY (`idingreso`)
    REFERENCES `dbsiscoop2`.`ingreso` (`idingreso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalle_egreso_categoria`
    FOREIGN KEY (`idcategoria`)
    REFERENCES `dbsiscoop2`.`categoria` (`idcategoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbsiscoop2`.`permiso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbsiscoop2`.`permiso` (
  `idpermiso` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`idpermiso`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbsiscoop2`.`usuario_permiso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbsiscoop2`.`usuario_permiso` (
  `idusuario_permiso` INT NOT NULL AUTO_INCREMENT,
  `idusuario` INT NOT NULL,
  `idpermiso` INT NOT NULL,
  PRIMARY KEY (`idusuario_permiso`),
  INDEX `fk_usuario_permiso_usuario_idx` (`idusuario` ASC),
  INDEX `fk_usuario_permiso_permiso_idx` (`idpermiso` ASC),
  CONSTRAINT `fk_usuario_permiso_usuario`
    FOREIGN KEY (`idusuario`)
    REFERENCES `dbsiscoop2`.`usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_permiso_permiso`
    FOREIGN KEY (`idpermiso`)
    REFERENCES `dbsiscoop2`.`permiso` (`idpermiso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbsiscoop2`.`afiliado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbsiscoop2`.`afiliado` (
  `idafiliado` INT NOT NULL AUTO_INCREMENT,
  `idcontrato` INT NOT NULL,
  `tipo_persona` VARCHAR(20) NOT NULL,
  `nombre` VARCHAR(100) NOT NULL,
  `tipo_documento` VARCHAR(20) NOT NULL,
  `num_documento` VARCHAR(20) NOT NULL,
  `fecha` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `condicion` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idafiliado`),
  INDEX `fk_afiliado_contrato_idx` (`idcontrato` ASC),
  CONSTRAINT `fk_afiliado_contrato`
    FOREIGN KEY (`idcontrato`)
    REFERENCES `dbsiscoop2`.`contrato` (`idcontrato`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbsiscoop2`.`config_inicial`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbsiscoop2`.`config_inicial` (
  `idconfig_inicial` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `documento` VARCHAR(45) NOT NULL,
  `periodo` INT NOT NULL,
  PRIMARY KEY (`idconfig_inicial`),
  UNIQUE INDEX `periodo_UNIQUE` (`periodo` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbsiscoop2`.`config_sistema`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbsiscoop2`.`config_sistema` (
  `idconfig_sistema` INT NOT NULL AUTO_INCREMENT,
  `idconfig_inicial` INT NOT NULL,
  `semanas` INT NOT NULL,
  `costo` DECIMAL(11,2) NOT NULL,
  `fecha_inicio` DATE NOT NULL,
  `fecha_final` DATE NOT NULL,
  PRIMARY KEY (`idconfig_sistema`),
  INDEX `fk_config_sistema_config_inicial_idx` (`idconfig_inicial` ASC),
  CONSTRAINT `fk_config_sistema_config_inicial`
    FOREIGN KEY (`idconfig_inicial`)
    REFERENCES `dbsiscoop2`.`config_inicial` (`idconfig_inicial`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbsiscoop2`.`bancos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbsiscoop2`.`bancos` (
  `idbancos` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`idbancos`),
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbsiscoop2`.`conciliacion_b`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbsiscoop2`.`conciliacion_b` (
  `idconciliacion_b` INT NOT NULL AUTO_INCREMENT,
  `idbancos` INT NOT NULL,
  `idingreso` INT NOT NULL,
  `ref_transferencia` VARCHAR(10) NOT NULL,
  `ref_interna` VARCHAR(10) NOT NULL,
  `fecha` DATETIME NOT NULL,
  PRIMARY KEY (`idconciliacion_b`),
  INDEX `fk_conciliacion_b_ingreso_idx` (`idingreso` ASC),
  INDEX `fk_conciliacion_b_bancos_idx` (`idbancos` ASC),
  CONSTRAINT `fk_conciliacion_b_ingreso`
    FOREIGN KEY (`idingreso`)
    REFERENCES `dbsiscoop2`.`ingreso` (`idingreso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_conciliacion_b_bancos`
    FOREIGN KEY (`idbancos`)
    REFERENCES `dbsiscoop2`.`bancos` (`idbancos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
