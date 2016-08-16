-- MySQL Script generated by MySQL Workbench
-- Sun Mar 13 13:42:32 2016
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema db_tzthfdc
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `db_tzthfdc` ;

-- -----------------------------------------------------
-- Schema db_tzthfdc
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `db_tzthfdc` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
USE `db_tzthfdc` ;

-- -----------------------------------------------------
-- Table `db_tzthfdc`.`Tab_UserGroup`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_tzthfdc`.`Tab_UserGroup` ;

CREATE TABLE IF NOT EXISTS `db_tzthfdc`.`Tab_UserGroup` (
  `gid` MEDIUMINT NOT NULL AUTO_INCREMENT COMMENT '组ID',
  `group_name` VARCHAR(45) NULL COMMENT '用户组名',
  `level` INT NULL DEFAULT 0 COMMENT '用户的等级，等级越高，权限越大',
  `create_time` DATETIME NULL,
  `update_time` DATETIME NULL,
  PRIMARY KEY (`gid`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `level_Tab_UserGroup_UNIQUE` ON `db_tzthfdc`.`Tab_UserGroup` (`level` ASC);


-- -----------------------------------------------------
-- Table `db_tzthfdc`.`Tab_User`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_tzthfdc`.`Tab_User` ;

CREATE TABLE IF NOT EXISTS `db_tzthfdc`.`Tab_User` (
  `uid` INT NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `gid` INT COMMENT '用户ID',
  `user_name` VARCHAR(30) NULL COMMENT '用户名',
  `true_name` VARCHAR(45) NULL DEFAULT '顾客' COMMENT '用户真实姓名，如张三',
  `password` VARCHAR(100) NULL COMMENT '用户的密码',
  `salt` VARCHAR(50) NULL COMMENT '用户密码的盐值',
  `sex` TINYINT NULL COMMENT '用户性别',
  `contact_tel` VARCHAR(50) NULL COMMENT '联系方式',
  `contact_mobile` VARCHAR(50) NULL COMMENT '联系方式',
  `qqchat` VARCHAR(30) NULL COMMENT 'QQ号',
  `wechat` VARCHAR(30) NULL COMMENT '微信号',
  `email` VARCHAR(256) NULL COMMENT '邮箱',
  `address` VARCHAR(200) NULL COMMENT '联系地址',
  `avatar` VARCHAR(500) NULL COMMENT '头像',
  `permission` TINYINT(1) UNSIGNED NULL DEFAULT 0 COMMENT '是否有权限做操作',
  `create_time` DATETIME NULL,
  `update_time` DATETIME NULL,
  PRIMARY KEY (`uid`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `user_name_Tab_User_UNIQUE` ON `db_tzthfdc`.`Tab_User` (`user_name` ASC);


-- -----------------------------------------------------
-- Table `db_tzthfdc`.`Tab_Area`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_tzthfdc`.`Tab_Area` ;

CREATE TABLE IF NOT EXISTS `db_tzthfdc`.`Tab_Area` (
  `aid` INT NOT NULL AUTO_INCREMENT COMMENT '区域ID',
  `area_name` VARCHAR(45) NULL COMMENT '区域名',
  `create_time` DATETIME NULL,
  `update_time` DATETIME NULL,
  PRIMARY KEY (`aid`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_tzthfdc`.`Tab_RentHouse`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_tzthfdc`.`Tab_RentHouse` ;

CREATE TABLE IF NOT EXISTS `db_tzthfdc`.`Tab_RentHouse` (
  `hid` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(500) NULL,
  `rooms` TINYINT UNSIGNED NULL DEFAULT 0,
  `halls` TINYINT UNSIGNED NULL DEFAULT 0,
  `bathrooms` TINYINT UNSIGNED NULL DEFAULT 0,
  `size` MEDIUMINT UNSIGNED NULL DEFAULT 0 COMMENT '面积',
  `price` DECIMAL(7,0) UNSIGNED NULL DEFAULT 0 COMMENT '价格的值',
  `rent_type` TINYINT UNSIGNED NULL DEFAULT 0 COMMENT '出租方式',
  `rentpay_type` TINYINT UNSIGNED NULL DEFAULT 0 COMMENT '租金缴纳方式',
  `support_device` VARCHAR(200) NULL,
  `community` VARCHAR(45) NULL,
  `cid` INT NULL,
  `aid` INT NULL,
  `floors` SMALLINT NULL DEFAULT 0 COMMENT '楼层',
  `floors_total` SMALLINT NULL DEFAULT 0 COMMENT '总层数',
  `house_type` TINYINT UNSIGNED NULL DEFAULT 0,
  `decor` TINYINT UNSIGNED NULL DEFAULT 0,
  `orientation` TINYINT UNSIGNED NULL DEFAULT 0,
  `images` VARCHAR(10000) NULL,
  `details` TEXT NULL COMMENT '详情',
  `create_time` DATETIME NULL,
  `update_time` DATETIME NULL,
  `uid` INT NULL,
  `poster_name` VARCHAR(45) NULL COMMENT '联系人名称',
  `poster_contact` VARCHAR(50) NULL COMMENT '联系人联系号码',
  `f` TINYINT UNSIGNED NULL COMMENT '额外的字段',
  PRIMARY KEY (`hid`))
ENGINE = InnoDB;

CREATE INDEX `INDEX_Tab_RentHouse_HOUSE_TYPE` ON `db_tzthfdc`.`Tab_RentHouse` (`rooms` ASC, `halls` ASC, `bathrooms` ASC);

CREATE INDEX `INDEX_Tab_RentHouse_UpdateTime` ON `db_tzthfdc`.`Tab_RentHouse` (`update_time` ASC)  COMMENT '按照更新时间排序';


-- -----------------------------------------------------
-- Table `db_tzthfdc`.`Tab_UserGroup_has_Tab_User`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_tzthfdc`.`Tab_UserGroup_has_Tab_User` ;

CREATE TABLE IF NOT EXISTS `db_tzthfdc`.`Tab_UserGroup_has_Tab_User` (
  `gid` MEDIUMINT NOT NULL,
  `uid` INT NOT NULL,
  `create_time` DATETIME NULL,
  `update_time` DATETIME NULL,
  PRIMARY KEY (`gid`, `uid`),
  CONSTRAINT `fk_Tab_UserGroup_has_Tab_User_Tab_UserGroup`
    FOREIGN KEY (`gid`)
    REFERENCES `db_tzthfdc`.`Tab_UserGroup` (`gid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Tab_UserGroup_has_Tab_User_Tab_User1`
    FOREIGN KEY (`uid`)
    REFERENCES `db_tzthfdc`.`Tab_User` (`uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Tab_UserGroup_has_Tab_User_Tab_User1_idx` ON `db_tzthfdc`.`Tab_UserGroup_has_Tab_User` (`uid` ASC);

CREATE INDEX `fk_Tab_UserGroup_has_Tab_User_Tab_UserGroup_idx` ON `db_tzthfdc`.`Tab_UserGroup_has_Tab_User` (`gid` ASC);


-- -----------------------------------------------------
-- Table `db_tzthfdc`.`Tab_Community`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_tzthfdc`.`Tab_Community` ;

CREATE TABLE IF NOT EXISTS `db_tzthfdc`.`Tab_Community` (
  `cid` INT UNIQUE NOT NULL AUTO_INCREMENT COMMENT '小区ID',
  `cname` VARCHAR(45) NULL COMMENT '小区名',
  `pinyin` VARCHAR(45) NULL COMMENT '拼音首字母',
  `create_time` DATETIME NULL,
  `update_time` DATETIME NULL,
  PRIMARY KEY (`cid`));


-- -----------------------------------------------------
-- Table `db_tzthfdc`.`Tab_SellHouse`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_tzthfdc`.`Tab_SellHouse` ;

CREATE TABLE IF NOT EXISTS `db_tzthfdc`.`Tab_SellHouse` (
  `hid` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(500) NULL,
  `rooms` TINYINT UNSIGNED NULL DEFAULT 0 COMMENT '几室几厅几卫',
  `halls` TINYINT UNSIGNED NULL DEFAULT 0 COMMENT '几室几厅几卫',
  `bathrooms` TINYINT UNSIGNED NULL DEFAULT 0 COMMENT '几室几厅几卫',
  `size` MEDIUMINT UNSIGNED NULL DEFAULT 0 COMMENT '面积',
  `price` DECIMAL(6,2) UNSIGNED NULL DEFAULT 0.00 COMMENT '价格的值',
  `unit_price` DECIMAL(6,0) UNSIGNED NULL DEFAULT 0,
  `community` VARCHAR(45) NULL,
  `cid` INT NULL COMMENT '小区ID',
  `aid` INT NULL COMMENT '区域ID',
  `floors` SMALLINT NULL DEFAULT 0 COMMENT '楼层',
  `floors_total` SMALLINT NULL DEFAULT 0 COMMENT '总层数',
  `house_type` TINYINT UNSIGNED NULL DEFAULT 0,
  `decor` TINYINT UNSIGNED NULL DEFAULT 0,
  `orientation` TINYINT UNSIGNED NULL DEFAULT 0,
  `rights_len` TINYINT UNSIGNED NULL DEFAULT 0,
  `rights_type` TINYINT UNSIGNED NULL DEFAULT 0,
  `rights_from` SMALLINT UNSIGNED NULL,
  `primary_school` VARCHAR(100) NULL,
  `junior_school` VARCHAR(100) NULL,
  `images` VARCHAR(10000) NULL,
  `details` TEXT NULL COMMENT '详情',
  `create_time` DATETIME NULL,
  `update_time` DATETIME NULL,
  `uid` INT NULL COMMENT '用户ID',
  `poster_name` VARCHAR(45) NULL COMMENT '联系人名称',
  `poster_contact` VARCHAR(50) NULL COMMENT '联系人联系方式',
  `f` TINYINT UNSIGNED NULL COMMENT '额外的字段',
  PRIMARY KEY (`hid`))
ENGINE = InnoDB;

CREATE INDEX `INDEX_Tab_SellHouse_HOUSE_TYPE` ON `db_tzthfdc`.`Tab_SellHouse` (`rooms` ASC, `halls` ASC, `bathrooms` ASC);

CREATE INDEX `INDEX_Tab_SellHouse_UpdateTime` ON `db_tzthfdc`.`Tab_SellHouse` (`update_time` DESC)  COMMENT '按照更新时间排序';

USE `db_tzthfdc`;

DELIMITER $$

USE `db_tzthfdc`$$
DROP TRIGGER IF EXISTS `db_tzthfdc`.`Tab_UserGroup_BEFORE_INSERT` $$
USE `db_tzthfdc`$$
CREATE TRIGGER `db_tzthfdc`.`Tab_UserGroup_BEFORE_INSERT` BEFORE INSERT ON `Tab_UserGroup` FOR EACH ROW
BEGIN
set @temp_now = now(); set new.`create_time` = @temp_now ; set new.`update_time` = @temp_now ;
END$$


USE `db_tzthfdc`$$
DROP TRIGGER IF EXISTS `db_tzthfdc`.`Tab_UserGroup_BEFORE_UPDATE` $$
USE `db_tzthfdc`$$
CREATE TRIGGER `db_tzthfdc`.`Tab_UserGroup_BEFORE_UPDATE` BEFORE UPDATE ON `Tab_UserGroup` FOR EACH ROW
BEGIN
set new.`update_time` = now() ;
END$$


USE `db_tzthfdc`$$
DROP TRIGGER IF EXISTS `db_tzthfdc`.`Tab_User_BEFORE_INSERT` $$
USE `db_tzthfdc`$$
CREATE TRIGGER `db_tzthfdc`.`Tab_User_BEFORE_INSERT` BEFORE INSERT ON `Tab_User` FOR EACH ROW
BEGIN
set @temp_now = now(); set new.`create_time` = @temp_now ; set new.`update_time` = @temp_now ;
END$$


USE `db_tzthfdc`$$
DROP TRIGGER IF EXISTS `db_tzthfdc`.`Tab_User_BEFORE_UPDATE` $$
USE `db_tzthfdc`$$
CREATE TRIGGER `db_tzthfdc`.`Tab_User_BEFORE_UPDATE` BEFORE UPDATE ON `Tab_User` FOR EACH ROW
BEGIN
set new.`update_time` = now() ;
END$$


USE `db_tzthfdc`$$
DROP TRIGGER IF EXISTS `db_tzthfdc`.`Tab_Area_BEFORE_INSERT` $$
USE `db_tzthfdc`$$
CREATE TRIGGER `db_tzthfdc`.`Tab_Area_BEFORE_INSERT` BEFORE INSERT ON `Tab_Area` FOR EACH ROW
BEGIN
set @temp_now = now(); set new.`create_time` = @temp_now ; set new.`update_time` = @temp_now ;
END$$


USE `db_tzthfdc`$$
DROP TRIGGER IF EXISTS `db_tzthfdc`.`Tab_Area_BEFORE_UPDATE` $$
USE `db_tzthfdc`$$
CREATE TRIGGER `db_tzthfdc`.`Tab_Area_BEFORE_UPDATE` BEFORE UPDATE ON `Tab_Area` FOR EACH ROW
BEGIN
set new.`update_time` = now() ;
END$$


USE `db_tzthfdc`$$
DROP TRIGGER IF EXISTS `db_tzthfdc`.`Tab_RentHouse_BEFORE_INSERT` $$
USE `db_tzthfdc`$$
CREATE TRIGGER `db_tzthfdc`.`Tab_RentHouse_BEFORE_INSERT` BEFORE INSERT ON `Tab_RentHouse` FOR EACH ROW
BEGIN
set @temp_now = now(); set new.`create_time` = @temp_now ; set new.`update_time` = @temp_now ;
END$$


USE `db_tzthfdc`$$
DROP TRIGGER IF EXISTS `db_tzthfdc`.`Tab_RentHouse_BEFORE_UPDATE` $$
USE `db_tzthfdc`$$
CREATE TRIGGER `db_tzthfdc`.`Tab_RentHouse_BEFORE_UPDATE` BEFORE UPDATE ON `Tab_RentHouse` FOR EACH ROW
BEGIN
set new.`update_time` = now() ;
END$$


USE `db_tzthfdc`$$
DROP TRIGGER IF EXISTS `db_tzthfdc`.`Tab_UserGroup_has_Tab_User_BEFORE_INSERT` $$
USE `db_tzthfdc`$$
CREATE TRIGGER `db_tzthfdc`.`Tab_UserGroup_has_Tab_User_BEFORE_INSERT` BEFORE INSERT ON `Tab_UserGroup_has_Tab_User` FOR EACH ROW
BEGIN
set @temp_now = now(); set new.`create_time` = @temp_now ; set new.`update_time` = @temp_now ;
END$$


USE `db_tzthfdc`$$
DROP TRIGGER IF EXISTS `db_tzthfdc`.`Tab_UserGroup_has_Tab_User_BEFORE_UPDATE` $$
USE `db_tzthfdc`$$
CREATE TRIGGER `db_tzthfdc`.`Tab_UserGroup_has_Tab_User_BEFORE_UPDATE` BEFORE UPDATE ON `Tab_UserGroup_has_Tab_User` FOR EACH ROW
BEGIN
set new.`update_time` = now() ;
END$$


USE `db_tzthfdc`$$
DROP TRIGGER IF EXISTS `db_tzthfdc`.`Tab_Community_BEFORE_INSERT` $$
USE `db_tzthfdc`$$
CREATE TRIGGER `db_tzthfdc`.`Tab_Community_BEFORE_INSERT` BEFORE INSERT ON `Tab_Community` FOR EACH ROW
BEGIN
set @temp_now = now(); set new.`create_time` = @temp_now ; set new.`update_time` = @temp_now ;
END$$


USE `db_tzthfdc`$$
DROP TRIGGER IF EXISTS `db_tzthfdc`.`Tab_Community_BEFORE_UPDATE` $$
USE `db_tzthfdc`$$
CREATE TRIGGER `db_tzthfdc`.`Tab_Community_BEFORE_UPDATE` BEFORE UPDATE ON `Tab_Community` FOR EACH ROW
BEGIN
set new.`update_time` = now() ;
END$$


USE `db_tzthfdc`$$
DROP TRIGGER IF EXISTS `db_tzthfdc`.`Tab_SellHouse_BEFORE_INSERT` $$
USE `db_tzthfdc`$$
CREATE TRIGGER `db_tzthfdc`.`Tab_SellHouse_BEFORE_INSERT` BEFORE INSERT ON `Tab_SellHouse` FOR EACH ROW
BEGIN
set @temp_now = now(); set new.`create_time` = @temp_now ; set new.`update_time` = @temp_now ;
END$$


USE `db_tzthfdc`$$
DROP TRIGGER IF EXISTS `db_tzthfdc`.`Tab_SellHouse_BEFORE_UPDATE` $$
USE `db_tzthfdc`$$
CREATE TRIGGER `db_tzthfdc`.`Tab_SellHouse_BEFORE_UPDATE` BEFORE UPDATE ON `Tab_SellHouse` FOR EACH ROW
BEGIN
set new.`update_time` = now() ;
END$$


DELIMITER ;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
