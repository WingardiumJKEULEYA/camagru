<?php require 'inc/header.php'; ?>
<?php include_once 'config/database.php'; ?>
<?php $log = $_SESSION['loggued_on_user']; ?>
<?php if ($log === "" || $pdo->query("SELECT * FROM Users WHERE login = '$log'")->rowCount() == 0) {
  $_SESSION['loggued_on_user'] = "" ;
	header('Location: index.php');
} ?>
<table>
  <?php $sql = 'SELECT * FROM Pictures ORDER BY date DESC';
  $result = $pdo->query($sql);
  $i = 1;
  if (!$_GET['page']) {
    $page = 1;
  }
  else {
    $page = intval($_GET['page']);
  }
  while ($image = $result->fetch(PDO::FETCH_ASSOC)) { ?>
    <?php if ($i > ($page - 1) * 4 && $i <= intval($page * 4)) { ?>
      <?php if ($i % 2 == 1) { ?>
        <tr>
      <?php } ?>
      <td><a href="photo.php?picture=<?=$image['id']?> "><img src="<?= $image['link'] ?>"/></a></td>
      <?php if ($i % 2 == 0) { ?>
        </tr>
      <?php } ?>
    <?php } ?>
    <?php $i = $i + 1 ?>
  <?php } ?>
</table>
<center>
  <?php $j = 1 ?>
  <?php while ($i > 1) { ?>
    <a href="?page=<?=$j?>"><?=$j?></a>
    <?php $i = $i - 4;
          $j = $j + 1;
    ?>
  <?php } ?>
</center>
<?#php require 'inc/footer.php'; ?>