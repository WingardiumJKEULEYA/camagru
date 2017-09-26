<?php require 'inc/header.php'; ?>
<?php include_once 'config/database.php'; ?>
<?php $log = $_SESSION['loggued_on_user']; ?>
<?php $id = intval($_GET['picture']); ?>
<?php if ($log === "" || $pdo->query("SELECT * FROM Users WHERE login = '$log'")->rowCount() == 0) {
  $_SESSION['loggued_on_user'] = "" ;
	header('Location: index.php');
} else if ($pdo->query("SELECT * FROM Pictures WHERE id = '$id'")->rowCount() == 0) {
	header('Location: index.php');
} ?>
<?php $sql = "SELECT * FROM Pictures WHERE id = '$id'"; ?>
<?php $result = $pdo->query($sql);
      $image = $result->fetch(PDO::FETCH_ASSOC);
?>
<?php $use = $image['user'];
      $sql = "SELECT * FROM Users WHERE id = '$use'";
      $result = $pdo->query($sql);
      $user = $result->fetch(PDO::FETCH_ASSOC);
?>
<?php $sql = "SELECT * FROM Comments WHERE picture = '$id'";
      $comments = $pdo->query($sql);
?>
<table>
  <tr>
    <td><img src="<?=$image['link']?>"/></td>
  </tr>
  <tr>
    <td>Login: <?= $user['login'] ?></td>
  </tr>
  <tr>
    <?php $imid = $image['id']; ?>
    <td>Nombre de like: <?= $pdo->query("SELECT id FROM Likes WHERE picture = '$imid'")->rowCount() ?>
      <?php $req = $pdo->prepare("SELECT id FROM Users where login = :login");
            $req->execute(array(
              'login' => $log));
            $userid = $req->fetch()[0];
            $query = $pdo->query("SELECT * FROM Likes WHERE picture = '$imid' AND user = '$userid'"); ?>
      <?php if ($query->rowCount() == 0) { ?>
        <form action="like.php" method="post">
          <td>
            <input type="hidden" name="picture" value="<?=$image['id']?>" />
            <input type="submit" value="Like" id="confirm_sign" name="submit" />
          </td>
        </form>
      <?php } else { ?>
        <form action="like.php" method="post">
          <td>
            <input type="hidden" name="picture" value="<?=$image['id']?>" />
            <input type="submit" value="Unlike" id="confirm_sign" name="submit" />
          </td>
        </form>
      <?php } ?>
      <?php if (($user['login'] == $log) || ($_SESSION['user_admin'] == TRUE)) { ?>
        <form action="delpicture.php" method="post">
          <td>
            <input type="hidden" name="picture" value="<?=$image['id']?>" />
            <input type="submit" value="Supprimer" id="confirm_sign" name="submit" />
          </td>
        </form>
      <?php } ?>
    </td>
  </tr>
  <tr>
    <td>Comments:</td>
  </tr>
  <?php while ($comment = $comments->fetch(PDO::FETCH_ASSOC)) { ?>
    <tr>
      <td><?= $comment['body'] ?></td>
      <?php $id = $comment['user']; ?>
      <td>Ecrit par <?= $pdo->query("SELECT * FROM Users WHERE id = '$id'")->fetch(PDO::FETCH_ASSOC)['login'];?></td>
    </tr>
  <?php } ?>
  <form action="comment.php" method="post">
    <tr>
      <td>
        <input type="text" name="comment" placeholder="Enter your comment here" required />
        <input type="hidden" name="picture" value="<?=$image['id']?>" />
      </td>
    </tr>
    <tr>
      <td><input type="submit" value="Comment" id="confirm_sign" name="submit"></td>
    </tr>
  </form>
</table>