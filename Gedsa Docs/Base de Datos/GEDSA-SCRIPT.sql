SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `b17_13401040_gedsa` DEFAULT CHARACTER SET utf8 ;
USE `b17_13401040_gedsa` ;

-- -----------------------------------------------------
-- Table `b17_13401040_gedsa`.`descripcion_usuarios`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `b17_13401040_gedsa`.`descripcion_usuarios` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created_at` DATETIME NOT NULL ,
  `updated_at` DATETIME NOT NULL ,
  `nombre` VARCHAR(45) NOT NULL ,
  `apellido_paterno` VARCHAR(45) NOT NULL ,
  `apellido_materno` VARCHAR(45) NULL DEFAULT NULL ,
  `direccion` VARCHAR(200) NULL DEFAULT NULL ,
  `telefono` VARCHAR(20) NOT NULL ,
  `email` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `b17_13401040_gedsa`.`administradores`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `b17_13401040_gedsa`.`administradores` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `descripcion_usuarios_id` INT(11) NOT NULL ,
  `nombre` VARCHAR(45) NOT NULL ,
  `password` VARCHAR(45) NOT NULL ,
  `activo` TINYINT(1) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `nombre_usuario_UNIQUE` (`nombre` ASC) ,
  INDEX `fk_Administradores_Descripcion_Usuarios1_idx` (`descripcion_usuarios_id` ASC) ,
  CONSTRAINT `fk_Administradores_Descripcion_Usuarios1`
    FOREIGN KEY (`descripcion_usuarios_id` )
    REFERENCES `b17_13401040_gedsa`.`descripcion_usuarios` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `b17_13401040_gedsa`.`albums`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `b17_13401040_gedsa`.`albums` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `administradores_id` INT(11) NOT NULL ,
  `created_at` DATETIME NOT NULL ,
  `updated_at` DATETIME NOT NULL ,
  `nombre` VARCHAR(45) NOT NULL ,
  `descripcion` VARCHAR(45) NULL DEFAULT NULL ,
  `url` TEXT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Albums_Usuarios1_idx` (`administradores_id` ASC) ,
  CONSTRAINT `fk_Albums_Usuarios1`
    FOREIGN KEY (`administradores_id` )
    REFERENCES `b17_13401040_gedsa`.`administradores` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `b17_13401040_gedsa`.`clientes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `b17_13401040_gedsa`.`clientes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NOT NULL ,
  `apellido_paterno` VARCHAR(45) NOT NULL ,
  `apellido_materno` VARCHAR(45) NULL DEFAULT NULL ,
  `direccion` VARCHAR(200) NULL DEFAULT NULL ,
  `telefono` VARCHAR(20) NOT NULL ,
  `email` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `b17_13401040_gedsa`.`clientes_registrados`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `b17_13401040_gedsa`.`clientes_registrados` (
  `fecha` DATETIME NOT NULL ,
  `clientes_id` INT(11) NOT NULL ,
  INDEX `fk_Clientes_Registrados_Clientes1_idx` (`clientes_id` ASC) ,
  CONSTRAINT `fk_Clientes_Registrados_Clientes1`
    FOREIGN KEY (`clientes_id` )
    REFERENCES `b17_13401040_gedsa`.`clientes` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `b17_13401040_gedsa`.`fotos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `b17_13401040_gedsa`.`fotos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `administradores_id` INT(11) NOT NULL ,
  `albums_id` INT(11) NOT NULL ,
  `created_at` DATETIME NOT NULL ,
  `updated_at` DATETIME NOT NULL ,
  `nombre` VARCHAR(100) NOT NULL ,
  `descripcion` VARCHAR(500) NULL DEFAULT NULL ,
  `url` TEXT NOT NULL ,
  PRIMARY KEY (`id`) ,
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
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `b17_13401040_gedsa`.`presentaciones`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `b17_13401040_gedsa`.`presentaciones` (
  `administradores_id` INT(11) NOT NULL ,
  `created_at` DATETIME NOT NULL ,
  `updated_at` DATETIME NOT NULL ,
  `nombre` VARCHAR(45) NOT NULL ,
  `descripcion` VARCHAR(500) NULL DEFAULT NULL ,
  PRIMARY KEY (`nombre`) ,
  INDEX `fk_Presentaciones_Usuarios1_idx` (`administradores_id` ASC) ,
  CONSTRAINT `fk_Presentaciones_Usuarios1`
    FOREIGN KEY (`administradores_id` )
    REFERENCES `b17_13401040_gedsa`.`administradores` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `b17_13401040_gedsa`.`presentaciones_has_fotos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `b17_13401040_gedsa`.`presentaciones_has_fotos` (
  `presentacion_nombre` VARCHAR(45) NOT NULL ,
  `foto_id` INT(11) NOT NULL ,
  `id` INT(11) NOT NULL ,
  `created_at` DATETIME NULL DEFAULT NULL ,
  `updated_at` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`, `presentacion_nombre`, `foto_id`) ,
  INDEX `fk_presentaciones_has_fotos_fotos1_idx` (`foto_id` ASC) ,
  INDEX `fk_presentaciones_has_fotos_presentaciones1_idx` (`presentacion_nombre` ASC) ,
  CONSTRAINT `fk_presentaciones_has_fotos_fotos1`
    FOREIGN KEY (`foto_id` )
    REFERENCES `b17_13401040_gedsa`.`fotos` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_presentaciones_has_fotos_presentaciones1`
    FOREIGN KEY (`presentacion_nombre` )
    REFERENCES `b17_13401040_gedsa`.`presentaciones` (`nombre` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `b17_13401040_gedsa`.`servicios`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `b17_13401040_gedsa`.`servicios` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `administradores_id` INT(11) NOT NULL ,
  `created_at` DATETIME NOT NULL ,
  `updated_at` DATETIME NOT NULL ,
  `nombre` VARCHAR(45) NOT NULL ,
  `descripcion` TEXT NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Servicios_Administradores1_idx` (`administradores_id` ASC) ,
  CONSTRAINT `fk_Servicios_Administradores1`
    FOREIGN KEY (`administradores_id` )
    REFERENCES `b17_13401040_gedsa`.`administradores` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `b17_13401040_gedsa`.`promociones`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `b17_13401040_gedsa`.`promociones` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `administradores_id` INT(11) NOT NULL ,
  `servicios_id` INT(11) NOT NULL ,
  `created_at` DATETIME NOT NULL ,
  `updated_at` DATETIME NOT NULL ,
  `nombre` VARCHAR(100) NOT NULL ,
  `descripcion` TEXT NOT NULL ,
  `disponible` TINYINT(1) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC) ,
  INDEX `fk_Promociones_Servicios1_idx` (`servicios_id` ASC) ,
  INDEX `fk_Promociones_Administradores1_idx` (`administradores_id` ASC) ,
  CONSTRAINT `fk_Promociones_Administradores1`
    FOREIGN KEY (`administradores_id` )
    REFERENCES `b17_13401040_gedsa`.`administradores` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Promociones_Servicios1`
    FOREIGN KEY (`servicios_id` )
    REFERENCES `b17_13401040_gedsa`.`servicios` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `b17_13401040_gedsa`.`servicios_solicitados`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `b17_13401040_gedsa`.`servicios_solicitados` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `clientes_id` INT(11) NOT NULL ,
  `servicios_id` INT(11) NOT NULL ,
  `fecha` DATETIME NOT NULL ,
  `descripcion` VARCHAR(500) NULL DEFAULT NULL ,
  `atendido` TINYINT(1) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Servicios_Solicitados_Servicios1_idx` (`servicios_id` ASC) ,
  INDEX `fk_Servicios_Solicitados_Clientes1_idx` (`clientes_id` ASC) ,
  CONSTRAINT `fk_Servicios_Solicitados_Clientes1`
    FOREIGN KEY (`clientes_id` )
    REFERENCES `b17_13401040_gedsa`.`clientes` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Servicios_Solicitados_Servicios1`
    FOREIGN KEY (`servicios_id` )
    REFERENCES `b17_13401040_gedsa`.`servicios` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

USE `b17_13401040_gedsa` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
