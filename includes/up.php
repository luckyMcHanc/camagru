<?php
if (isset($_POST['apply']))
{

  $selected = $_POST["stickers"];
   if (!empty($selected))
   {
        $im = imagecreatefromjpeg("uploads/".$image);
        $stamp = imagecreatefrompng($selected);
   
        $marge_right = 10;
        $marge_bottom = 10;
        $sx = imagesx($stamp);
        $sy = imagesy($stamp);

        imagecopy($im, $stamp, 0, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));

        $out=$image;
  
        imagejpeg($im,"uploads/".$out);
        imagedestroy($im);
   }
   else
   {
       $out = $image;
   }
  $_SESSION['url'] = $out;

  copy("uploads/".$out, $target.$name);
  die();
          try
          {
              $sql = $con->prepare("INSERT INTO images (userid, `description`, `image`, `target`, `time`) VALUES(?,?,?,?,now())");
              $arr = array($_SESSION['login'],"",$name, "images/".$name);
              if ($sql->execute($arr) === TRUE)
              {
                  echo '<script>alert("Image added succesfully")</script>';
                  echo '<script>window.location = "index.php"</script>';
              }
          }
          catch(PDOException $e)
          {
              echo $e;
          }
}

?>