<?php require 'inc/header.php'; ?>
<?php include_once 'config/database.php'; ?>
<?php $log = $_SESSION['loggued_on_user']; ?>
<?php if ($log === "" || $pdo->query("SELECT * FROM Users WHERE login = '$log'")->rowCount() == 0) {
  $_SESSION['loggued_on_user'] = "" ;
	header('Location: index.php');
} ?>
<?php if ($_SESSION['user_admin'] == FALSE){
  header('Location: index.php');
}
$result = $pdo->query("SELECT * FROM Likes ORDER BY id DESC LIMIT 5;");
?>
<style>
	td {
	  border: 1px solid black;
	}
</style>


<table style="width:50%;margin: auto;">
	<caption><b><font size="8">5 derniers Likes</font></b></caption>
	<tr>
		<th>ID</th>
		<th>User</th>
		<th>Picture</th>
		<th>Date</th>
	</tr>
	<?php
	while($row = $result->fetch(PDO::FETCH_ASSOC)) {
		?>
		<tr>
		<td><?php echo $row["id"] ?></td>
		<td><?php echo $row["user"] ?></td>
		<td><?php echo $row["picture"] ?></td>
		<td><?php echo $row["date"] ?></td>
		</tr>
		<?php
	}
	?>
</table>

<?php

$result2 = $pdo->query("SELECT * FROM Comments ORDER BY id DESC LIMIT 5;");
?>
<style>
	td {
	  border: 1px solid black;
	}
</style>


<table style="width:50%;margin: auto;">
	<caption><b><font size="8">5 derniers Comments</font></b></caption>
	<tr>
		<th>ID</th>
		<th>User</th>
		<th>Picture</th>
		<th>Body</th>
		<th>Date</th>
	</tr>
	<?php
	while($row2 = $result2->fetch(PDO::FETCH_ASSOC)) {
		?>
		<tr>
		<td><?php echo $row2["id"] ?></td>
		<td><?php echo $row2["user"] ?></td>
		<td><?php echo $row2["picture"] ?></td>
		<td><?php echo $row2["body"] ?></td>
		<td><?php echo $row2["date"] ?></td>
		</tr>
		<?php
	}
	?>
</table>