<?php

  if(!isset($_SESSION))
  {
      session_start();
  }
if (!isset($_SESSION['login']))
{
    echo '<script>window.location="login.php"</script>';
}
require("header.php");
require("includes/upload.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <!-- <link rel="stylesheet" href="css/filters.css" /> -->
  <!-- <link rel="stylesheet" href="css/main.css" /> -->

</head>
<body>
    <div class="container">
    <br />
    <?php require("upload_m.php"); ?>
    <form method = "post" action = "camera.php">
            <div class = "row">
                <div class = "col-md-6">
                    <video id="video" autoplay class="embed-responsive">Something went wrong while streaming</video>
                    <div class = "form-group">
    <button id="capture" name = "sub"class = "btn btn-primary">
    Take Picture
    </button>
    </div>
                </div>
    <div class = "col-md-6" style="overflow-y: scroll; height:550px;">
      <?php
        $dirname = "uploads/";
        $images = glob($dirname."*.jpeg");
        foreach($images as $image) {
          ?>
          <hr style = "opacity:0;">
          <img src= "<?php echo $image ?>" class="img-thumbnail float-left" style="width: 300px;height: 300px;display: block;">
          <br>
          <?php
      }
    ?>
        </div>
      </div>

<br>
    <input type = "hidden" id = "url" name = "url">
  </form>

    <canvas  id="canvas"></canvas>

    <div class="center-block" id="thumbnail"></div>
    </div>
    <?php
    if (isset($_POST["sub"]))
    {

      $_SESSION['url'] = $_POST["url"];
     $_SESSION['done'] = "0";
      echo '<script>window.location= "discam.php"</script>';
    }
    ?>
    <script src="js/capture.js"></script>
</body>
<?php
    require('footer.html');
    ?>
</html>
