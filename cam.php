<?php require 'inc/header.php'; ?>
<?php include_once 'config/database.php'; ?>
<?php $log = $_SESSION['loggued_on_user']; ?>
<?php if ($log === "" || $pdo->query("SELECT * FROM Users WHERE login = '$log'")->rowCount() == 0) {
  $_SESSION['loggued_on_user'] = "" ;
	header('Location: index.php');
} ?>

<div id="wrapper_cam">
  <table>
    <tr>
      <td>
       	<div class="video_box" id="videomore">
          <video id="video" width="640" height="480" autoplay></video>
          <img src="" id="replace" width="640" height="480"/>
          <img src="" class="img_over" id="overimg"/>
        </div>
        <input type="file" onchange="readURL(this);" accept=".jpg,.jpeg,.png"/>
        <button id="snap">TAKE A PICTURE</button>
        <button id="revideo" onclick="putvideo();">Remettre la cam</button>
        <select name="image1" onchange="displayImage(this);">
          <option name="select">Images</option>
          <?php
            foreach(glob("img/*") as $filename) {
              $file = explode("/", $filename);
              echo "<option value=$filename>".$file[1]."</option>";
            }
          ?>
        </select>
      </td>
      <td>
        <table>
          <?php $user = $pdo->query("SELECT id FROM Users WHERE login = '$log'")->fetch()[0]; ?>
          <?php $tab = $pdo->query("SELECT * FROM Pictures WHERE user = '$user' ORDER BY date DESC") ?>
          <?php while ($image = $tab->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
              <td><a href="photo.php?picture=<?=$image['id']?> "><img src="<?= $image['link'] ?>" width="50" height="50" /></a></td>
            </tr>
          <?php } ?>
        </table>
      </td>
    </tr>
    <tr>
      <td>
        <img id="snappics" width="640" height="480" />
        <canvas id="c" style="display:none;" width="640" height="480"></canvas>
      </td>
    </tr>
  </table>
</div>
<?php require 'inc/footer.php'; ?>
<script>
  var snap = document.getElementById("snap");
  var videorep = document.getElementById("video");
  var replace = document.getElementById("replace");
  var revideo = document.getElementById("revideo");
  image = document.getElementById("overimg");
  image.style.display = "none";
  revideo.style.display = "none";
  replace.style.display = "none";
  snap.style.display = "none";
  var select = "";
  function displayImage(elem) {
    image = document.getElementById("overimg");
    if (elem.value != "select") {
      snap.style.display = "block";
      image.style.display = "block";
      image.src = elem.value;
      select = elem.value;
    }
    else {
      snap.style.display = "none";
      image.style.display = "none";
    }
  }
  var canvas2 = document.getElementById("c");
  // Put event listeners into place
  window.addEventListener("DOMContentLoaded", function() {
    // Grab elements, create settings, etc.
    var video = document.getElementById("video"),
      videoObj = { "video": true },
      errBack = function(error) {
        console.log("Video capture error: ", error.code); 
      };
    // Put video listeners into place
    if (navigator.getUserMedia) { // Standard
      navigator.getUserMedia(videoObj, function(stream) {
        video.src = window.URL.createObjectURL(stream);
        video.play();
      }, errBack);
    } else if (navigator.webkitGetUserMedia) { // WebKit-prefixed
      navigator.webkitGetUserMedia(videoObj, function(stream){
        video.src = window.URL.createObjectURL(stream);
        video.play();
      }, errBack);
    }
    else if (navigator.mozGetUserMedia) { // Firefox-prefixed
      navigator.mozGetUserMedia(videoObj, function(stream){
        video.src = window.URL.createObjectURL(stream);
        video.play();
      }, errBack);
    }
   }, false);
  // Trigger photo take
  snap.addEventListener("click", function() {
    image = document.getElementById("overimg");
    if (image.style.display == "block") {
      var xhttp = new XMLHttpRequest();
      if (video.style.display == "none") {
        canvas2.getContext("2d").drawImage(replace, 0, 0, 640, 480);
      }
      else {
        canvas2.getContext("2d").drawImage(video, 0, 0, 640, 480);
      }
      var img = canvas2.toDataURL("image/jpg");
      xhttp.open("POST", "picture.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("cam=" + img + "&img=" + select);
      xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
          JSON.parse(xhttp.responseText, function(k, v) {
            if (k == "img") 
            {
              mysnap = document.getElementById("snappics");
              mysnap.src = v;
            }
          });
        }
      }
    }
  });
  function readURL(input) {
    revideo.style.display = "block";
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        videorep.style.display = "none";
        replace.style.display = "block";
        replace.src = e.target.result;
      }
      reader.readAsDataURL(input.files[0]);
    }
  }
  function putvideo() {
    revideo.style.display = "none";
    videorep.style.display = "block";
    replace.style.display = "none";
  }
</script>
