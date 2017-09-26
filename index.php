<?php require 'inc/header.php';?>
<?php require 'config/database.php';?>
<?php $log = $_SESSION['loggued_on_user']; ?>
<?php if ($log != "" && $pdo->query("SELECT * FROM Users WHERE login = '$log'")->rowCount() > 0) {
	header('Location: cam.php');
} ?>
  <center>
    <?php if ($_GET['error'] == 'login') { ?>
    <div class="alert-warning" id="alertme">
        Mauvais mot de passe / login / mail non confirme
      <button type="button" class="close" onclick="hide()" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
    <?php } else if ($_GET['info'] == 'confirm') { ?>
    <div class="alert-warning" id="alertme">
      Email confirme, connecte toi!
      <button type="button" class="close" onclick="hide()" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
    <?php } else if ($_GET['info'] == 'new_password') { ?>
    <div class="alert-warning" id="alertme">
     Ton mot de passe a ete reset, connecte toi!
      <button type="button" class="close" onclick="hide()" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
      </div>
      <?php } else if ($_GET['error'] == 'not_identical_or_length') { ?>
    <div class="alert-warning" id="alertme">
     Mots de passe non identiques ou trop courts (8 caracteres mini)
      <button type="button" class="close" onclick="hide()" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
      </div>
       <?php } else if ($_GET['info'] == 'register_success') { ?>
    <div class="alert-warning" id="alertme">
     Compte créé ! Confirmez votre inscription par via le mail reçu
      <button type="button" class="close" onclick="hide()" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
      </div>
    <?php } else if ($_GET['info'] == 'mail_reset') { ?>
    <div class="alert-warning" id="alertme">
     Un email a ete envoye pour ton reset de mot de passe
      <button type="button" class="close" onclick="hide()" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
    <?php } ?>
    <div id="login-form">
      <form action="login.php" method="post">
        <table align="center" width="100%" border="0">
          <tr>
            <td><input type="text" name="login" value="<?= $_GET['login'] ?>" placeholder="Your Login" required /></td>
          </tr>
          <tr>
            <td><input type="password" name="passwd" placeholder="Your Password" required /></td>
          </tr>
          <tr>
            <td><input type="submit" value="Sign In" id="confirm_sign" name="submit"></td>
          </tr>
          <tr>
            <td><a href="register.php">Sign Up Here</a></td>
          </tr>
          <tr>
            <td><a href="renember.php">Forget your password ?</a></td>
          </tr>
        </table>
      </form>
    </div>
  </center>
  <?php require 'inc/footer.php'; ?>
</body>

<script>
  function hide() {
    document.getElementById("alertme").style.display = 'none';
  }
</script>
