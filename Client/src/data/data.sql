-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema youtube
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema youtube
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `youtube` ;
USE `youtube` ;

-- -----------------------------------------------------
-- Table `youtube`.`category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `youtube`.`category` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `youtube`.`video`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `youtube`.`video` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NULL,
  `description` VARCHAR(45) NULL,
  `privacy` VARCHAR(30) NULL DEFAULT 0,
  `filePath` VARCHAR(200) NULL,
  `category` VARCHAR(45) NULL DEFAULT 0,
  `uploadDate` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP(),
  `uploadedBy` VARCHAR(45) NULL,
  `views` INT NULL DEFAULT 0,
  `duration` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `youtube`.`thumbnail`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `youtube`.`thumbnail` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `videoId` INT NULL,
  `filePath` VARCHAR(200) NULL,
  `selected` INT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `youtube`.`category`
-- -----------------------------------------------------
START TRANSACTION;
USE `youtube`;
INSERT INTO `youtube`.`category` (`id`, `name`) VALUES (1, 'Film & Animation');
INSERT INTO `youtube`.`category` (`id`, `name`) VALUES (2, 'Autos & Vehicles');
INSERT INTO `youtube`.`category` (`id`, `name`) VALUES (3, 'Music');
INSERT INTO `youtube`.`category` (`id`, `name`) VALUES (4, 'Pets & Animals');
INSERT INTO `youtube`.`category` (`id`, `name`) VALUES (5, 'Sports');
INSERT INTO `youtube`.`category` (`id`, `name`) VALUES (6, 'Travel & Events');
INSERT INTO `youtube`.`category` (`id`, `name`) VALUES (7, 'Gaming');
INSERT INTO `youtube`.`category` (`id`, `name`) VALUES (8, 'People & Blogs');
INSERT INTO `youtube`.`category` (`id`, `name`) VALUES (9, 'Comedy');
INSERT INTO `youtube`.`category` (`id`, `name`) VALUES (10, 'Entertainment');
INSERT INTO `youtube`.`category` (`id`, `name`) VALUES (11, 'News & Politics');
INSERT INTO `youtube`.`category` (`id`, `name`) VALUES (12, 'Howto & Style');
INSERT INTO `youtube`.`category` (`id`, `name`) VALUES (13, 'Education');
INSERT INTO `youtube`.`category` (`id`, `name`) VALUES (14, 'Science & Technology');
INSERT INTO `youtube`.`category` (`id`, `name`) VALUES (15, 'Nonprofits & Activism');

COMMIT;

