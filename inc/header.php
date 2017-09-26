<?php session_start(); ?>
<?php ob_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Camagru42</title>

    <link href="css/app.css" rel="stylesheet">
  </head>

<body>
  <div id="wrapper">
    <nav class="navbar">
      <div class="navbar-header">
        <ul>
          <?PHP if ($_SESSION['loggued_on_user'] !== "") { ?>
            <li><a href="cam.php">Home</a></li>
            <li><a href="galerie.php">Gallery</a></li>
            <?php if ($_SESSION['user_admin'] == TRUE){
              echo "<li><a href='admin.php'>Admin Panel</a></li>";
            }?>
          <?PHP } else { ?>
            <li><a href="/">Home</a></li>
          <?PHP } ?>
          <ul style="float:right;list-style-type:none;">
            <?PHP if ($_SESSION['loggued_on_user'] !== "") { ?>
              <li><a href="change.php">Edit pwd</a></li>
              <li><a href="logout.php">Logout</a></li>
            <?PHP } else { ?>
              <li><a href="index.php">Login</a></li>
            <?PHP } ?>
          </ul>
        </ul>
      </div>
    </nav>
    <div class="container">