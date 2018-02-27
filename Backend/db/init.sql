-- -------------------------------------------------------------------------------------------------------
-- MySQL Workbench Migration
-- Migrated Schemata: treaty
-- Source Schemata: treaty
-- Created Mon Jan 21 12:49:41 2018
-- Workbench Version: 6.3.10
-- -------------------------------------------------------------------------------------------------------

SET FOREIGN_KEY_CHECKS = 0;

-- -------------------------------------------------------------------------------------------------------
-- Schema treaty
-- -------------------------------------------------------------------------------------------------------
DROP SCHEMA IF EXISTS `treaty`;
CREATE SCHEMA IF NOT EXISTS `treaty`;

-- -------------------------------------------------------------------------------------------------------
-- Table treaty.users
-- -------------------------------------------------------------------------------------------------------
DROP TABLE IF EXISTS `treaty`.`user`;

CREATE TABLE IF NOT EXISTS `treaty`.`user` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) CHARACTER SET `utf8` NOT NULL,
  `phonenumber` VARCHAR(11) NOT NULL,
  `role` VARCHAR(20) CHARACTER SET `utf8` NULL DEFAULT NULL,
  `lastlogintime` TIMESTAMP NULL DEFAULT NULL,
  `encryptedpassword` VARCHAR(255) NOT NULL,
  `isactive` BIGINT(20) NOT NULL DEFAULT '1',
  `modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `ix_user_email` (`email` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

-- -------------------------------------------------------------------------------------------------------
-- Table treaty.userdetails
-- -------------------------------------------------------------------------------------------------------
DROP TABLE IF EXISTS `treaty`.`userdetail`;

CREATE TABLE IF NOT EXISTS `treaty`.`userdetail` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `userid` BIGINT(20) NOT NULL,
  `firstname` VARCHAR(50) CHARACTER SET 'utf8' NOT NULL,
  `lastname` VARCHAR(50) CHARACTER SET 'utf8' NOT NULL,
  `phonenumber` VARCHAR(11) NOT NULL,
  `address1` VARCHAR(100) CHARACTER SET `utf8` NOT NULL,
  `address2` VARCHAR(100) CHARACTER SET `utf8` NULL DEFAULT NULL,
  `city` VARCHAR(80) CHARACTER SET `utf8` NOT NULL,
  `state` VARCHAR(50) CHARACTER SET `utf8` NOT NULL,
  `country` VARCHAR(50) CHARACTER SET `utf8` NOT NULL,
  `zipcode` MEDIUMINT(5) UNSIGNED ZEROFILL NOT NULL,
  `isactive` BIGINT(20) NOT NULL DEFAULT '1',
  `modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `ix_userdetail_phonenumber` (`phonenumber` ASC),
  INDEX `ix_userdetail_userid` (`userid` ASC),
  CONSTRAINT `fk_userdetail_userid`
    FOREIGN KEY (`userid`)
    REFERENCES `treaty`.`user` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

-- -------------------------------------------------------------------------------------------------------
-- Table treaty.businesssecotr
-- -------------------------------------------------------------------------------------------------------
DROP TABLE IF EXISTS `treaty`.`businesssector`;
CREATE TABLE IF NOT EXISTS `treaty`.`businesssector` (
`id` BIGINT(20) NOT NULL AUTO_INCREMENT,
`businesssector` VARCHAR(50) CHARACTER SET 'utf8' NOT NULL,
PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -------------------------------------------------------------------------------------------------------
-- Table treaty.businessdetail
-- -------------------------------------------------------------------------------------------------------
DROP TABLE IF EXISTS `treaty`.`businessdetail`;

CREATE TABLE IF NOT EXISTS `treaty`.`businessdetail` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `userid` BIGINT(20) NOT NULL,
  `businessname` VARCHAR(100) CHARACTER SET 'utf8' NOT NULL,
  `businesssector` BIGINT(20) NOT NULL,
  `address1` VARCHAR(100) CHARACTER SET `utf8` NOT NULL,
  `address2` VARCHAR(100) CHARACTER SET `utf8` NULL DEFAULT NULL,
  `city` VARCHAR(80) CHARACTER SET `utf8` NOT NULL,
  `state` VARCHAR(50) CHARACTER SET `utf8` NOT NULL,
  `country` VARCHAR(50) CHARACTER SET `utf8` NOT NULL,
  `zipcode` MEDIUMINT(5) UNSIGNED ZEROFILL NOT NULL,  
  `latitude` FLOAT(10,6) NOT NULL,
  `longitude` FLOAT(10,6) NOT NULL,
  `isactive` BIGINT(20) NOT NULL DEFAULT '1',
 -- `businessimage` LONGBLOB NOT NULL,
  `modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `ix_businessdetail_userid_businessname_businesssector_zip_addr1` (`userid`, `businessname`, `businesssector`, `zipcode`, `address1`),
  CONSTRAINT `fk_businessdetail_userid`
    FOREIGN KEY (`userid`)
    REFERENCES `treaty`.`user` (`id`),
  CONSTRAINT `fk_businessdetail_businesssector`
    FOREIGN KEY (`businesssector`)
    REFERENCES `treaty`.`businesssector` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

-- -------------------------------------------------------------------------------------------------------
-- Table treaty.businessoffer
-- -------------------------------------------------------------------------------------------------------
DROP TABLE IF EXISTS `treaty`.`businessoffer`;

CREATE TABLE IF NOT EXISTS `treaty`.`businessoffer` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `userid` BIGINT(20) NOT NULL,
  `businessid` BIGINT(20) NOT NULL,
  `offername` VARCHAR(100) CHARACTER SET 'utf8' NOT NULL,
  `offerdescription` VARCHAR(100) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `creditedpoints` BIGINT(80) NOT NULL,
  `startdate` DATE NOT NULL,
  `expirationdate` DATE NOT NULL,
  `isactive` BIGINT(20) NOT NULL DEFAULT '1',
  `modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `ix_businessoffer_userid_businessid_offername` (`userid`, `businessid`, `offername`),
  CONSTRAINT `fk_businessoffer_userid`
    FOREIGN KEY (`userid`)
    REFERENCES `treaty`.`user` (`id`),
  CONSTRAINT `fk_businessoffer_businessid`
    FOREIGN KEY (`businessid`)
    REFERENCES `treaty`.`businessdetail` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

-- -------------------------------------------------------------------------------------------------------
-- Table treaty.customeroffer
-- -------------------------------------------------------------------------------------------------------
DROP TABLE IF EXISTS `treaty`.`customerbusiness`;

CREATE TABLE IF NOT EXISTS `treaty`.`customerbusiness` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `userid` BIGINT(20) NOT NULL,
  `businessid` BIGINT(20) NOT NULL,
  `earnedpoints` BIGINT(80) NULL DEFAULT NULL,
  `redeemedpoints` BIGINT(80) NULL DEFAULT NULL,
  `balance` BIGINT(80) NULL DEFAULT NULL,
  `isactive` BIGINT(20) NOT NULL DEFAULT '1',
  `modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_customeroffer_userid`
    FOREIGN KEY (`userid`)
    REFERENCES `treaty`.`user` (`id`),
  CONSTRAINT `fk_customeroffer_businessid`
    FOREIGN KEY (`businessid`)
    REFERENCES `treaty`.`businessdetail` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


