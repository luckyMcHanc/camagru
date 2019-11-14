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
  <link rel="stylesheet" href="css/main.css" />
  
</head>
<body>
    <div class="container">
    <div class = "row">
    <br />
    <?php require("upload_m.php"); ?>
    <form method = "post" action = "camera.php">
    
    <div class="container">
    <div class = "center-block">
    <video class="container-fluid"  id="video" autoplay>Something went wrong while streaming</video>
</div>
</div>
<br>
    <button id="capture" name = "sub"class = "btn btn-primary">
    Take Picture
    </button>
  </div>
    <input type = "hidden" id = "url" name = "url">
  </form>
    <canvas  id="canvas"></canvas>

    <div class="center-block" id="thumbnail"></div>
    </div>
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