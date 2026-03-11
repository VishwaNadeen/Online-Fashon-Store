CREATE DATABASE IF NOT EXISTS `mystore` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `mystore`;

CREATE TABLE IF NOT EXISTS `user_table` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NULL,
  `username` VARCHAR(100) NOT NULL,
  `user_email` VARCHAR(255) NOT NULL,
  `user_password` VARCHAR(255) NOT NULL,
  `user_name` VARCHAR(255) NOT NULL,
  `user_gender` VARCHAR(20) NOT NULL,
  `user_address` VARCHAR(255) NOT NULL,
  `user_mobile` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_user_id` (`user_id`),
  UNIQUE KEY `uniq_user_email` (`user_email`),
  UNIQUE KEY `uniq_username` (`username`)
) ENGINE=InnoDB;

DROP TRIGGER IF EXISTS `user_table_set_user_id`;
DELIMITER $$
CREATE TRIGGER `user_table_set_user_id`
AFTER INSERT ON `user_table`
FOR EACH ROW
BEGIN
  IF NEW.user_id IS NULL THEN
    UPDATE `user_table` SET `user_id` = NEW.id WHERE `id` = NEW.id;
  END IF;
END$$
DELIMITER ;

CREATE TABLE IF NOT EXISTS `faqq` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fqs` TEXT NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `pro` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `pName` VARCHAR(255) NOT NULL,
  `pPrice` VARCHAR(50) NOT NULL,
  `Qty` INT NOT NULL,
  `size` VARCHAR(50) NOT NULL,
  `Edate` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `payment` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cNumber` VARCHAR(40) NOT NULL,
  `exDate` VARCHAR(20) NOT NULL,
  `cvv` VARCHAR(10) NOT NULL,
  `cName` VARCHAR(100) NOT NULL,
  `holderName` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `delivery` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `address` VARCHAR(255) NOT NULL,
  `city` VARCHAR(100) NOT NULL,
  `province` VARCHAR(100) NOT NULL,
  `pcode` VARCHAR(20) NOT NULL,
  `phone` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `cupage` (
  `u_email` VARCHAR(255) NOT NULL,
  `u_first_name` VARCHAR(100) NOT NULL,
  `u_last_name` VARCHAR(100) NOT NULL,
  `u_message` TEXT NOT NULL,
  `u_phonenumber` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`u_email`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `catagories` (
  `category_id` INT NOT NULL AUTO_INCREMENT,
  `category_name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` INT NOT NULL AUTO_INCREMENT,
  `product_title` VARCHAR(255) NOT NULL,
  `category_id` INT NOT NULL,
  `product_keyword` VARCHAR(255) NOT NULL,
  `product_image` VARCHAR(255) NOT NULL,
  `product_price` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `idx_product_category_id` (`category_id`),
  CONSTRAINT `fk_product_category` FOREIGN KEY (`category_id`) REFERENCES `catagories` (`category_id`) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `supplement_orders` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `supplement_id` INT NOT NULL,
  `supplement_name` VARCHAR(255) NOT NULL,
  `supplement_price` DECIMAL(10,2) NOT NULL,
  `user_name` VARCHAR(255) NOT NULL,
  `user_email` VARCHAR(255) NOT NULL,
  `user_address` VARCHAR(255) NOT NULL,
  `user_phone` VARCHAR(30) NOT NULL,
  `card_number` VARCHAR(40) NOT NULL,
  `card_expiry` VARCHAR(10) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `placeorder` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `country` VARCHAR(100) NOT NULL,
  `address` VARCHAR(255) NOT NULL,
  `city` VARCHAR(100) NOT NULL,
  `pcode` VARCHAR(20) NOT NULL,
  `phone` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;
