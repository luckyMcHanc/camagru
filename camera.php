<?php
  
session_start();
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
    <form method = "post" action = "camera.php">

     <br>
     <br>
     <br>
    <div class="container">
    <div class = "center-block">
    <video  id="video" autoplay>Something went wrong while streaming</video>
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
    
  //  session_start();
    if (isset($_POST["sub"]))
    {

      $_SESSION['url'] = $_POST["url"];

   //   echo $_SESSION['url'];
     // require 'discam.php';
     // dis();
     $_SESSION['done'] = "0";
      echo '<script>window.location= "discam.php"</script>';
    }
    ?>
    <script src="capture.js"></script>
</body>

</html>