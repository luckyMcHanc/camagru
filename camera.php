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
require("includes/likes.php")
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
    <div class = "row">
      <div class = "col-md-6">
        <form method = "post" action = "camera.php">
                    <video id="video" autoplay class="embed-responsive">Something went wrong while streaming</video>
                    <div class = "form-group">
    <button id="capture" name = "sub" class = "btn btn-primary">
    Take Picture
    </button>
                  
    <input type = "hidden" id = "url" name = "url">
  </form>
    </div>
                </div>
    <div class = "col-md-6" style="overflow-y: scroll; height:550px;">

    <div class="container">

<h1 class="font-weight-light text-center text-lg-left mt-4 mb-0">Click any picture to delete it!</h1>

<hr class="mt-2 mb-5">

<div class="row text-center text-lg-left">
      <?php
        require 'includes/connect.php';
        $im = $con->prepare("SELECT * FROM images WHERE userid  = ? order by time DESC");
        if ($im->execute([$_SESSION['login']]))
        {
          $res = $im->fetchAll();

          foreach($res as $image) {
            ?>
            <hr style = "opacity:0;">

            <div class="col-lg-3 col-md-4 col-6">
              <form method="post">
                <button class="btn btn-default" style = "width : 120px; height : 130px;" name = "delete">
                  <div  class="d-block mb-4 h-100">
                        <input type = "hidden" value="<?php echo $image['imageid']; ?>" name  = "id">
                        <img class="img-fluid img-thumbnail" src="<?php echo $image['target']; ?>" alt="" style = "width : 250px; height : 130px;">
                  </div>
                </button>
              </form>
                </div>
            <?php
        }
          
        }
      //   $dirname = "uploads/";
      //   $images = glob($dirname."*.jpeg");
      //   foreach($images as $image) {
      //     ?>
      <!-- //     <hr style = "opacity:0;">
      //     <img src= "<?php echo $image ?>" class="img-thumbnail float-left" style="width: 300px;height: 300px;display: block;">
      //     <br> -->
           <?php
      // }
    ?>
        </div>

</div>
        </div>
      </div>

<br>
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
