<?php
  ob_start();
	include_once 'config/database.php';
  $log = $_SESSION['loggued_on_user'];
  if ($log == "" || $pdo->query("SELECT * FROM Users WHERE login = '$log'")->rowCount() == 0) {
    $_SESSION['loggued_on_user'] = "" ;
  	header('Location: index.php');
  }
  if ($_POST['submit']) {
    $id = intval($_POST['picture']);
    $req = $pdo->query("SELECT id FROM Users where login = '$log'");
    $user = $req->fetch()[0];
    $query = $pdo->query("SELECT id FROM Likes WHERE picture = '$id' AND user = '$user'");
    if ($query->rowCount() == 0) {
      $req = $pdo->prepare('INSERT INTO Likes(user, picture, date) VALUES(:user, :picture, :date)');
      $req->execute(array(
      'user' => $user,
      'picture' => $id,
      'date' => date('Y-m-d H:i:s', time())));
    }
    else {
      $pdo->query("DELETE FROM Likes WHERE user = '$user'");
    }
    header("Location: photo.php?picture=$id");
  }
  else {
    header("Location: photo.php?picture=$id");
  }
?>