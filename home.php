 <?php 
//require ("includes/upload.php");
require ("header.php");
if (isset($_SESSION['login']))
{
?>


<body>
    <br />
    <div class = "container">
    <form method = "POST" action="./home.php" enctype="multipart/form-data">
   
    <label >Select Image
        <input type = "file" name="fileToUpload" id="fileToUpload" size="30">
    </label>   
    Select Sticker
    <select name="stickers" id="stickers">
        <option value="none">Default</option>
        <option value="./stickers/sticker1.png">Greentoon</option>
        <option value="./stickers/sticker2.png">Linkedin</option>
        <option value="./stickers/sticker3.png">Jordan</option>
        <option value="./stickers/sticker4.png">Google Store</option>
        <option value="./stickers/sticker5.png">Hippy</option>
        <option value="./stickers/sticker7.png">Linux</option>
        <option value="./stickers/sticker8.png">Linux Drunk</option>
    </select>
    <input type="submit" value="Upload Image" name="submit">
    </form>
    </div>
    <?php
}
    require('display.php');
// if(isset($_FILES["fileToUpload"]))
// {

    // $target_dir = "images/";
    // $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    // $uploadOk = 1;
    // $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    // if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    //     echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    // } else {
    //     echo "<br>Sorry, there was an error uploading your file.";
    //     exit;
    // }
//     $name = $_FILES["fileToUpload"]["name"];
//     echo $name;
    
//      echo "<img src=$name >";
//     die();
// }

?>
<?php


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
