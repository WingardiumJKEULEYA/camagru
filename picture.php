<?php
  ob_start();
  include_once "config/database.php";
  $log = $_SESSION['loggued_on_user'];
  if ($log === "" || $pdo->query("SELECT * FROM Users WHERE login = '$log'")->rowCount() == 0) {
    $_SESSION['loggued_on_user'] = "" ;
  	header('Location: index.php');
  }
  session_start();
  $img = $_POST['cam'];
  $img = str_replace('data:image/png;base64,', '', $img);
  $img = str_replace(' ', '+', $img);
  $data = base64_decode($img);
  $dest = imagecreatefromstring($data);
  $src = imagecreatefrompng($_POST['img']);
  imagecopy($dest, $src, 0, 0, 0, 0, imagesx($src), imagesy($src));
  $file = "galerie/" . uniqid() . '.jpg';
  imagejpeg($dest, $file);
  $login = $_SESSION['loggued_on_user'];
  $req = $pdo->prepare("SELECT id FROM Users where login = :login");
  $req->execute(array(
      'login' => $login));
  $user = $req->fetch()[0];
  $req = $pdo->prepare('INSERT INTO Pictures(user, link, date) VALUES(:user, :link, :date)');
  $req->execute(array(
    'user' => $user,
    'link' => $file,
    'date' => date('Y-m-d H:i:s',time())));
  $arr = array ('img'=>$file);
  echo json_encode($arr);
?>