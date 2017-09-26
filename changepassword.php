<?php
  ob_start();
  include_once 'config/database.php';
  if ($_POST['password'] && $_POST['confirm'] && $_POST['user']) {
  	if (($_POST['password'] != $_POST['confirm']) || (strlen($_POST['password']) < 8)){
  		header('Location: index.php?error=not_identical_or_length');
  	}
    else {
      $id = htmlspecialchars($_POST['user'], ENT_QUOTES);
      $password = hash('sha512', $_POST['password']);
      $query = $pdo->query("UPDATE Users SET password = '$password', token='' WHERE id = '$id'");
      header('Location: index.php?info=new_password');
    }
  }
  else {
  	header('Location: index.php');
  }
?>