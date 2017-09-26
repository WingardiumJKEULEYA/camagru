<?php
    ob_start();
    include_once 'database.php';
    
    $sql = "DROP Table IF EXISTS Users";
    $pdo->query($sql);
    
    $sql = "DROP Table IF EXISTS Pictures";
    $pdo->query($sql);

    $sql = "DROP Table IF EXISTS Comments";
    $pdo->query($sql);

    $sql = "DROP Table IF EXISTS Likes";
    $pdo->query($sql);

    $sql = "CREATE TABLE Users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(200),
    admin BOOLEAN DEFAULT 0,
    token VARCHAR(255),
    date TIMESTAMP,
    confirmation INT(6) DEFAULT 0)";
    $pdo->query($sql);

    $sql = "CREATE TABLE Pictures (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user INT(6),
    date TIMESTAMP,
    link VARCHAR(100))";
    $pdo->query($sql);
    
    $sql = "CREATE TABLE Comments (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user INT(6),
    picture INT(6),
    body VARCHAR(200),
    date TIMESTAMP)";
    $pdo->query($sql);
    
    $sql = "CREATE TABLE Likes (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user INT(6),
    picture INT(6),
    date TIMESTAMP)";
    $pdo->query($sql);
    header('Location: ../index.php');
?>