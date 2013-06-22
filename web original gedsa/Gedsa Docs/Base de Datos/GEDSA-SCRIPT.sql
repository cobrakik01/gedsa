SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `b17_13401040_gedsa` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `b17_13401040_gedsa` ;

-- -----------------------------------------------------
-- Table `b17_13401040_gedsa`.`descripcion_usuarios`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `b17_13401040_gedsa`.`descripcion_usuarios` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `created_at` DATETIME NOT NULL ,
  `updated_at` DATETIME NOT NULL ,
  `nombre` VARCHAR(45) NOT NULL ,
  `apellido_paterno` VARCHAR(45) NOT NULL ,
  `apellido_materno` VARCHAR(45) NULL ,
  `direccion` VARCHAR(200) NULL ,
  `telefono` VARCHAR(20) NOT NULL ,
  `email` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `b17_13401040_gedsa`.`administradores`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `b17_13401040_gedsa`.`administradores` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `descripcion_usuarios_id` INT NOT NULL ,
  `nombre` VARCHAR(45) NOT NULL ,
  `password` VARCHAR(45) NOT NULL ,
  `activo` TINYINT(1) NOT NULL ,
  PRIMARY KEY (`id`, `descripcion_usuarios_id`) ,
  UNIQUE INDEX `nombre_usuario_UNIQUE` (`nombre` ASC) ,
  INDEX `fk_Administradores_Descripcion_Usuarios1_idx` (`descripcion_usuarios_id` ASC) ,
  CONSTRAINT `fk_Administradores_Descripcion_Usuarios1`
    FOREIGN KEY (`descripcion_usuarios_id` )
    REFERENCES `b17_13401040_gedsa`.`descripcion_usuarios` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `b17_13401040_gedsa`.`albums`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `b17_13401040_gedsa`.`albums` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `administradores_id` INT NOT NULL ,
  `created_at` DATETIME NOT NULL ,
  `updated_at` DATETIME NOT NULL ,
  `nombre` VARCHAR(45) NOT NULL ,
  `descripcion` VARCHAR(45) NULL ,
  `url` TEXT NOT NULL ,
  PRIMARY KEY (`id`, `administradores_id`) ,
  INDEX `fk_Albums_Usuarios1_idx` (`administradores_id` ASC) ,
  CONSTRAINT `fk_Albums_Usuarios1`
    FOREIGN KEY (`administradores_id` )
    REFERENCES `b17_13401040_gedsa`.`administradores` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `b17_13401040_gedsa`.`fotos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `b17_13401040_gedsa`.`fotos` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `administradores_id` INT NOT NULL ,
  `albums_id` INT NOT NULL ,
  `created_at` DATETIME NOT NULL ,
  `updated_at` DATETIME NOT NULL ,
  `nombre` VARCHAR(100) NOT NULL ,
  `descripcion` VARCHAR(500) NULL ,
  `url` TEXT NOT NULL ,
  PRIMARY KEY (`id`, `administradores_id`) ,
  INDEX `fk_Fotos_Albums1_idx` (`albums_id` ASC) ,
  INDEX `fk_Fotos_Usuarios1_idx` (`administradores_id` ASC) ,
  CONSTRAINT `fk_Fotos_Albums1`
    FOREIGN KEY (`albums_id` )
    REFERENCES `b17_13401040_gedsa`.`albums` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Fotos_Usuarios1`
    FOREIGN KEY (`administradores_id` )
    REFERENCES `b17_13401040_gedsa`.`administradores` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `b17_13401040_gedsa`.`servicios`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `b17_13401040_gedsa`.`servicios` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `administradores_id` INT NOT NULL ,
  `created_at` DATETIME NOT NULL ,
  `updated_at` DATETIME NOT NULL ,
  `nombre` VARCHAR(45) NOT NULL ,
  `descripcion` TEXT NULL ,
  PRIMARY KEY (`id`, `administradores_id`) ,
  INDEX `fk_Servicios_Administradores1_idx` (`administradores_id` ASC) ,
  CONSTRAINT `fk_Servicios_Administradores1`
    FOREIGN KEY (`administradores_id` )
    REFERENCES `b17_13401040_gedsa`.`administradores` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `b17_13401040_gedsa`.`clientes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `b17_13401040_gedsa`.`clientes` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NOT NULL ,
  `apellido_paterno` VARCHAR(45) NOT NULL ,
  `apellido_materno` VARCHAR(45) NULL ,
  `direccion` VARCHAR(200) NULL ,
  `telefono` VARCHAR(20) NOT NULL ,
  `email` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `b17_13401040_gedsa`.`clientes_registrados`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `b17_13401040_gedsa`.`clientes_registrados` (
  `fecha` DATETIME NOT NULL ,
  `clientes_id` INT NOT NULL ,
  PRIMARY KEY (`clientes_id`) ,
  INDEX `fk_Clientes_Registrados_Clientes1_idx` (`clientes_id` ASC) ,
  CONSTRAINT `fk_Clientes_Registrados_Clientes1`
    FOREIGN KEY (`clientes_id` )
    REFERENCES `b17_13401040_gedsa`.`clientes` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `b17_13401040_gedsa`.`servicios_solicitados`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `b17_13401040_gedsa`.`servicios_solicitados` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `clientes_id` INT NOT NULL ,
  `servicios_id` INT NOT NULL ,
  `fecha` DATETIME NOT NULL ,
  `descripcion` VARCHAR(500) NULL ,
  `atendido` TINYINT(1) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Servicios_Solicitados_Servicios1_idx` (`servicios_id` ASC) ,
  INDEX `fk_Servicios_Solicitados_Clientes1_idx` (`clientes_id` ASC) ,
  CONSTRAINT `fk_Servicios_Solicitados_Servicios1`
    FOREIGN KEY (`servicios_id` )
    REFERENCES `b17_13401040_gedsa`.`servicios` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Servicios_Solicitados_Clientes1`
    FOREIGN KEY (`clientes_id` )
    REFERENCES `b17_13401040_gedsa`.`clientes` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `b17_13401040_gedsa`.`presentaciones`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `b17_13401040_gedsa`.`presentaciones` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `administradores_id` INT NOT NULL ,
  `fotos_id` INT NOT NULL ,
  `created_at` DATETIME NOT NULL ,
  `updated_at` DATETIME NOT NULL ,
  `nombre` VARCHAR(45) NOT NULL ,
  `descripcion` VARCHAR(500) NULL ,
  PRIMARY KEY (`id`, `administradores_id`, `fotos_id`) ,
  INDEX `fk_Presentaciones_Fotos1_idx` (`fotos_id` ASC) ,
  INDEX `fk_Presentaciones_Usuarios1_idx` (`administradores_id` ASC) ,
  CONSTRAINT `fk_Presentaciones_Fotos1`
    FOREIGN KEY (`fotos_id` )
    REFERENCES `b17_13401040_gedsa`.`fotos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Presentaciones_Usuarios1`
    FOREIGN KEY (`administradores_id` )
    REFERENCES `b17_13401040_gedsa`.`administradores` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `b17_13401040_gedsa`.`promociones`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `b17_13401040_gedsa`.`promociones` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `administradores_id` INT NOT NULL ,
  `servicios_id` INT NOT NULL ,
  `created_at` DATETIME NOT NULL ,
  `updated_at` DATETIME NOT NULL ,
  `nombre` VARCHAR(100) NOT NULL ,
  `descripcion` TEXT NOT NULL ,
  `disponible` TINYINT(1) NOT NULL ,
  PRIMARY KEY (`id`, `administradores_id`, `servicios_id`) ,
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC) ,
  INDEX `fk_Promociones_Servicios1_idx` (`servicios_id` ASC) ,
  INDEX `fk_Promociones_Administradores1_idx` (`administradores_id` ASC) ,
  CONSTRAINT `fk_Promociones_Servicios1`
    FOREIGN KEY (`servicios_id` )
    REFERENCES `b17_13401040_gedsa`.`servicios` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Promociones_Administradores1`
    FOREIGN KEY (`administradores_id` )
    REFERENCES `b17_13401040_gedsa`.`administradores` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `b17_13401040_gedsa` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
