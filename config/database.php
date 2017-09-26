<?php
    $DB_USER = "root";
    $DB_PASSWORD = "root";
    $DB_DSN = "mysql:dbname=camagru;host=localhost";

    $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Check connection
    if ($pdo->connect_error) {
        die("Connection failed: " . $pdo->connect_error);
    }
    session_start();
 ?>