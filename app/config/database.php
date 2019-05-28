<?php
$DB_DSN = "mysql:host=localhost";
$DB_USER = 'root';
//$DB_PASSWORD = 'root';
$DB_PASSWORD = 'Trofimov2015';
$DB = "CREATE DATABASE IF NOT EXISTS db_camagru; USE db_camagru;";
$USERS = "CREATE TABLE IF NOT EXISTS `db_camagru`.`users`(
                      `id` INT NOT NULL AUTO_INCREMENT ,
                      `username` VARCHAR(15) NOT NULL ,
                      `email` VARCHAR(50) NOT NULL ,
                      `password` VARCHAR(150) NOT NULL ,
                      `activation` BOOLEAN NOT NULL DEFAULT FALSE,
                      PRIMARY KEY (`id`)) ENGINE = InnoDB;";
$PHOTOS = "CREATE TABLE IF NOT EXISTS `db_camagru`.`photos`(
                      `id` INT NOT NULL AUTO_INCREMENT ,
                      `filename` CHAR(150) NOT NULL,
                      `filesize` CHAR(50) NOT NULL,
                      `filetype` CHAR(50) NOT NULL,
                      `date` CHAR(50) NOT NULL,
                      `author` VARCHAR(15) NOT NULL ,
                      PRIMARY KEY (`id`)) ENGINE = InnoDB;";
$COMMENTS = "CREATE TABLE IF NOT EXISTS `db_camagru`.`comments`(
                      `id` INT NOT NULL AUTO_INCREMENT ,
                      `comment` VARCHAR(300) NOT NULL,
                      `photo` CHAR(50) NOT NULL,
                      `author` VARCHAR(15) NOT NULL ,
                      `date` CHAR(50) NOT NULL,
                      PRIMARY KEY (`id`)) ENGINE = InnoDB;";
?>