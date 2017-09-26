<?php
  ob_start();
	include_once 'config/database.php';
  $log = $_SESSION['loggued_on_user'];
  if ($log == "" || $pdo->query("SELECT * FROM Users WHERE login = '$log'")->rowCount() == 0) {
    $_SESSION['loggued_on_user'] = "" ;
  	header('Location: index.php');
  }
  $id = intval($_POST['picture']);
  if ($_POST['submit']) {
    $req = $pdo->query("SELECT user FROM Pictures where id = '$id'");
    $user = $req->fetch()[0];
    $req = $pdo->query("SELECT login FROM Users where id = '$user'");
    $login = $req->fetch()[0];
    if (($login == $log) || ($_SESSION['user_admin'] == TRUE)) {
      $pdo->query("DELETE FROM Pictures WHERE id = '$id'");
    }
    header("Location: galerie.php");
  }
  else {
    header("Location: galerie.php");
  }
?>