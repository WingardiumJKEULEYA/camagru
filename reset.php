<?php
	ob_start();
	include_once 'config/database.php';

  if ($_POST['submit'] && $_POST['email']) {
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES);
    $sql = "SELECT * FROM Users WHERE email = '$email'";
    $result = $pdo->query($sql);
    if ($result->rowCount() == 0) {
      header('Location: renember.php?error=email_not_found');
    }
    else {
      $user = $result->fetch(PDO::FETCH_ASSOC);
      $login = $user['login'];
      $token = uniqid();
      $sql = "UPDATE Users SET token = '$token' WHERE email = '$email'";
      $pdo->query($sql);
      $to = $email;
      $object = "Reset ton mot de passe";
      $message = "$login,<br>Une demande de reset de mot de passe a ete faite, voici ton lien de reset:<br><a href='http://localhost:8080/change.php?token=$token'>Reset ton mdp ici</a><br>Cordialement.";
      $headers  = 'From: jkeuleya@student.42.fr'."\r\n";
      $headers .= 'Reply-To: jkeuleya@student.42.fr'."\r\n";
      $headers .= 'MIME-Version: 1.0' . "\r\n";
      $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
      mail($to, $object, $message, $headers);
      header('Location: index.php?info=mail_reset');
    }
  }
  else {
    header('Location: renember.php?email=error');
  }
?>