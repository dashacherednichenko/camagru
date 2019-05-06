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
?>