<?php require 'inc/header.php';?>
  <center>
    <?php if ($_GET['error'] == 'already_used') { ?>
    <div class="alert-warning" id="alertme">
        Email or Username already used.
      <button type="button" class="close" onclick="hide()" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
    <?php } if ($_GET['error'] == 'pwd') { ?>
    <div class="alert-warning" id="alertme">
        Mot de passe trop court / mauvaise confirmation de mot de passe
      <button type="button" class="close" onclick="hide()" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
    <?php } else if ($_GET['error'] == 'sanitize') { ?>
      <div class="alert-warning" id="alertme">
        Seul les chiffres et les lettres sont tolérés
        <button type="button" class="close" onclick="hide()" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
    <?php } ?>
    <div id="login-form">
      <form action="create.php" method="post">
        <table align="center" width="100%" border="0">
          <tr>
            <td><input type="email" name="email" placeholder="Your Email" required /></td>
          </tr>
          <tr>
            <td><input type="text" name="login" placeholder="Your Login" required /></td>
          </tr>
          <tr>
            <td><input type="password" name="passwd" placeholder="Your Password (8 min)" required /></td>
          </tr>
          <tr>
            <td><input type="password" name="confirm" placeholder="Confirm Password" required /></td>
          </tr>
          <tr>
            <td><input type="submit" name="submit" id="confirm_sign" value="Sign Me Up"></td>
          </tr>
          <tr>
            <td><a href="index.php">Sign In Here</a></td>
          </tr>
        </table>
      </form>
    </div>
  </center>
</body>
<?php require 'inc/footer.php'; ?>

<script>
  
      function hide() {
    document.getElementById("alertme").style.display = 'none';
        }
  
</script>
