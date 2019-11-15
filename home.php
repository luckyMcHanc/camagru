<?php 
//require ("includes/upload.php");
require ("header.php");
?> <body>
     <br / >
     <?php
    require('display.php');
if(isset($_POST['submit']))
{
    $selected = $_POST["stickers"];
    $tmp = $_FILES["fileToUpload"]["tmp_name"];
    $check = getimagesize($tmp);
    if(empty($tmp))
    {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    else if (!strcmp($selected, "none"))
    {
        require 'includes/upload.php';
        upload($_FILES["fileToUpload"]["name"], $_FILES["fileToUpload"]["tmp_name"]);
    }
    else
    {
        $out=$_FILES["fileToUpload"]["name"];
        move_uploaded_file($tmp,"uploads/".$out);
        $stamp = imagecreatefrompng($selected);
        $im = imagecreatefromjpeg( "uploads/".$out);
        $marge_right = 10;
        $marge_bottom = 10;
        $sx = imagesx($stamp);
        $sy = imagesy($stamp);

        imagecopy($im, $stamp, 0, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));

        imagejpeg($im,"uploads/".$out);
        imagedestroy($im);

        $images = "output".date('Y-m-dH-i-s').".jpeg";
        copy("uploads/".$out, "images/".$images);

        try
        {
            require 'includes/connect.php';
            $sql = $con->prepare("INSERT INTO images (userid, `description`, `image`, `target`, `time`) VALUES(?,?,?,?,now())");
            $arr = array($_SESSION['login'],"",$out, "images/".$images);
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
       //echo "<img src = $out>";
    }
}
?> 
</body>
 <?php
    require('footer.html');
    ?>