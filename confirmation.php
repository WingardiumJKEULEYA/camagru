<?php
  ob_start();
  include_once 'config/database.php';
  if ($_GET['token'] && $_GET['token'] != "") {
    $token = $_GET['token'];
    $sql = "SELECT * FROM Users WHERE token = '$token'";
    $result = $pdo->query($sql);
    if ($result->rowCount() == 0) {
      header('Location: index.php');
    }
    else {
      $user = $result->fetch(PDO::FETCH_ASSOC);
      $id = $user['id'];
      $sql = "UPDATE Users SET confirmation=1, token='' WHERE id = '$id'";
      $pdo->query($sql);
      header('Location: index.php?info=confirm');
    }
  }
  else {
    header('Location: index.php');
  }
?>