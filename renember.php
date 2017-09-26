<?php require 'inc/header.php';?>
<?php
	ob_start();
	include_once 'config/database.php';
?>

<?php if ($_GET['error'] == 'email_not_found') { ?>
    <div class="alert-warning" id="alertme">
        Email non existant
      <button type="button" class="close" onclick="hide()" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
    <?php } else if ($_GET['error'] == 'email') { ?>
    <div class="alert-warning" id="alertme">
      Erreur !
      <button type="button" class="close" onclick="hide()" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
    <?php } ?>

<form action="reset.php" method="post">
  <table align="center" width="100%" border="0">
    <tr>
      <td><input type="email" name="email" placeholder="Your Email" required /></td>
    </tr>
    <tr>
      <td><input type="submit" value="Reset you're password" id="confirm_sign" name="submit"></td>
    </tr>
  </table>
</form>

<script>
  function hide() {
    document.getElementById("alertme").style.display = 'none';
  }
</script>
