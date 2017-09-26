<?php
  ob_start();
	include_once 'config/database.php';
  $log = $_SESSION['loggued_on_user'];
  if ($log === "" || $pdo->query("SELECT * FROM Users WHERE login = '$log'")->rowCount() == 0) {
    $_SESSION['loggued_on_user'] = "" ;
  	header('Location: index.php');
  }
  if ($_POST['comment'] && $_POST['comment'] != "" && $_POST['submit'] && $_POST['picture']) {
    $_POST['comment'] = trim($_POST['comment']);
    $_POST['comment'] = htmlspecialchars($_POST['comment'], ENT_QUOTES);
    $req = $pdo->prepare("SELECT id FROM Users where login = :login");
    $req->execute(array(
        'login' => $log));
    $user = $req->fetch()[0];
    $ids = intval($_POST['picture']);
    $req = $pdo->prepare('INSERT INTO Comments(user, picture, body, date) VALUES(:user, :picture, :body, :date)');
    echo date('Y-m-d H:i:s', time());
    $req->execute(array(
      'user' => $user,
      'picture' => $ids,
      'body' => $_POST['comment'],
      'date' => date('Y-m-d H:i:s', time())));
    $picture = $_POST['picture'];
    $req = $pdo->query("SELECT user FROM Pictures where id = '$picture' ");
    $id = $req->fetch()[0];
    $req = $pdo->query("SELECT * FROM Users where id = '$id' ");
    $user = $req->fetch(PDO::FETCH_ASSOC);
    if ($user['login'] != $_SESSION['loggued_on_user']) {
      $login = $user['login'];
      $to = $user['email'];
      $object = "Un commentaire a ete ajoute";
      $message = "$login,<br>Un commentaire a ete ajoute a une de vos images!<br><a href=\"http://localhost:8080/photo.php?picture=$picture\">Details</a><br>Cordialement.";
      $headers  = 'From: jkeuleya@student.42.fr'."\r\n";
      $headers .= 'Reply-To: jkeuleya@student.42.fr'."\r\n";
      $headers .= 'MIME-Version: 1.0' . "\r\n";
      $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

      mail($to, $object, $message, $headers);
    }
    header("Location: photo.php?picture=$ids");
  }
  else {
    header("Location: photo.php?picture=$ids");
  }
?>