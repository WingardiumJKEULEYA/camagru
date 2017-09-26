<?php require 'inc/header.php';?>
<?php
	ob_start();
	include_once 'config/database.php';
  $token = $_GET['token'];
  $sql = "SELECT * FROM Users WHERE token = '$token'";
  $result = $pdo->query($sql);
  if ($result->rowCount() == 0) {
    header('Location: index.php');
  }
  $user = $result->fetch(PDO::FETCH_ASSOC);
?>

<form action="changepassword.php" method="post">
  <table align="center" width="100%" border="0">
    <tr>
      <td><input type="password" name="password" placeholder="Your New Password" required /></td>
      <input type="hidden" name="user" value="<?= $user['id'] ?>"/>
    </tr>
    <tr>
      <td><input type="password" name="confirm" placeholder="Confirm Your New Password" required /></td>
    </tr>
    <tr>
      <td><input type="submit" value="Reset your password" id="confirm_sign" name="submit"></td>
    </tr>
  </table>
</form>
