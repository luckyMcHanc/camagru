<?php

include_once 'database.php';

try{
    $con = new PDO("mysql:host=$DB_DSN", $DB_USER, $DB_PASSWORD);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sqld = $con->prepare("DROP DATABASE camagru");
    $sqld->execute();
    $sql = $con->prepare("CREATE DATABASE camagru");
    $sql->execute();
    $con = null;
}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e;
}

try{
    $conn = new PDO("mysql:host=$DB_DSN;dbname=$dbname", $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $usertable = $conn->prepare("CREATE TABLE users(
        id INT(6) NOT NULL UNIQUE AUTO_INCREMENT,
        firstname VARCHAR(100),
        lastname VARCHAR(100),
        userid VARCHAR(100) PRIMARY KEY NOT NULL,
        `password` VARCHAR(100) NOT NULL,
        gender VARCHAR(10),
        email VARCHAR(100) UNIQUE,
        verified INT(2),
        notific INT NOT NULL DEFAULT '1'
        )
    ");
    $imagetable = $conn->prepare("CREATE TABLE images(
        imageid INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        userid VARCHAR(100) NOT NULL,
        `description` VARCHAR(200),
        `image` VARCHAR(100) NOT NULL,
        `target` VARCHAR(100) NOT NULL,
        `time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP )ENGINE = InnoDB"
    );
    $likes = $conn->prepare("CREATE TABLE `likes` 
    ( `id` INT NOT NULL AUTO_INCREMENT ,
    `username` VARCHAR(100) NOT NULL ,
    `imageid` VARCHAR(100) NOT NULL ,
    PRIMARY KEY (`id`)) ENGINE = InnoDB;
    ");
    $tok = $conn->prepare("CREATE TABLE `token_t` ( `id` INT NOT NULL AUTO_INCREMENT ,
    `userid` VARCHAR(100) NOT NULL ,
    `token` VARCHAR(100) NOT NULL ,
    `expire` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (`id`)) ENGINE = InnoDB;
    ");
    $comment = $conn->prepare("CREATE TABLE comments (
        id INT NOT NULL AUTO_INCREMENT ,
        `imageid` VARCHAR(100) NOT NULL ,
        `userid` VARCHAR(100) NOT NULL ,
        `comments` VARCHAR(2000) NOT NULL ,
        PRIMARY KEY (`id`)) ENGINE = InnoDB; "
    );
    $imagetable->execute();
    $usertable->execute();
    $comment->execute();
    $likes->execute();
    $tok->execute();
    $conn = null;
}
catch(PDOException $e)
{
    echo $e;
}