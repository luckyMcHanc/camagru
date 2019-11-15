<?php
require ("header.php");
if(!isset($_SESSION))
{
    session_start();
}
if (!isset($_SESSION['login']))
{
    echo '<script>window.location="login.php"</script>';
}
elseif(!isset($_SESSION['url']))
{
    echo '<script>window.location="camera.php"</script>';
}
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>

    <body>
        <br />
        <div class="container">
            <form method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <select name="stickers" id="stickers" class="form-control">
                                <option value="none">Default</option>
                                <option value="./stickers/sticker1.png">Greentoon</option>
                                <option value="./stickers/sticker2.png">Linkedin</option>
                                <option value="./stickers/sticker3.png">Jordan</option>
                                <option value="./stickers/sticker4.png">Google Store</option>
                                <option value="./stickers/sticker5.png">Hippy</option>
                                <option value="./stickers/sticker7.png">Linux</option>
                                <option value="./stickers/sticker8.png">Linux Drunk</option>
                                <input type="hidden" id="url" name="url">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <input type="submit" name="apply" value="Apply" class="btn btn-secondary">
                    </div>
                </div>
            </form>
        </div>
    </body>

    <?php

    $target = $_SESSION['url'];

   if (!strcmp($_SESSION['done'], "0"))
   {
    $image = "output".date('Y-m-dH-i-s').".jpeg";
    imagejpeg(imagecreatefromstring(file_get_contents($target)), "uploads/".$image);

    $_SESSION['url'] = $image;
    $_SESSION['done'] = "1";
   }
   $image =  $_SESSION['url'];

   ?>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="thumbnail">
                        <img src="<?php echo 'uploads/'.$image; ?>" class = "img-responsive">
                    </div>
                </div>
            </div>
            <hr style="opacity:0">
            <div class="row">
                <form method="post">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="submit" value="Upload" name="data" class="btn btn-secondary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php
   if (isset($_POST['apply']))
    {
        $selected = $_POST["stickers"];
        if (strcmp($selected, "none"))
        {
            $im = imagecreatefromjpeg("uploads/".$_SESSION['url']);
            $stamp = imagecreatefrompng($selected);

            $marge_right = 10;
            $marge_bottom = 10;
            $sx = imagesx($stamp);
            $sy = imagesy($stamp);

            imagecopy($im, $stamp, 0, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));

            $out=$_SESSION['url'];

            imagejpeg($im,"uploads/".$out);
            imagedestroy($im);
            echo '<script>window.location = "discam.php"</script>';
        }
   else
   {
       $out = $_SESSION['url'];
   }
    }
   if (isset($_POST['data']))
   {
    $out = $_SESSION['url'];
    copy("uploads/".$out, "images/".$out);

          try
          {
              require 'includes/connect.php';
              $sql = $con->prepare("INSERT INTO images (userid, `description`, `image`, `target`, `time`) VALUES(?,?,?,?,now())");
              $arr = array($_SESSION['login'],"",$out, "images/".$out);
              if ($sql->execute($arr) === TRUE)
              {
                  echo '<script>alert("Image added succesfully")</script>';
                  echo '<script>window.location = "home.php"</script>';
              }
          }
          catch(PDOException $e)
          {
              echo $e;
          }
    }

    require('footer.html');

?>

    </html>
