<?php
 //session_start();
// if (isset($_FILES['fileToUpload']))
// {
    // $name = $_FILES['fileToUpload']['name'];
    // $type = $_FILES['fileToUpload']['tmp_name'];
    // $tmpn =  getimagesize($_FILES['fileToUpload']['tmp_name']);
    
    function upload($name, $tmp)
    {
    require "connect.php";

    //echo "asdasd";
    //die();
     $target = "images/";

    // if (!preg_match("/\.(gif|jpg|png)$/i", $name)){
    //     echo '<script>alert("invalid file type")</scipt>';
    // }
    // else if (!empty($tmpn))
    // {
        $image = "output".date('Y-m-dH-i-s').".jpeg";
        move_uploaded_file($tmp, $target.$image);
        
    
        try
        {
            $sql = $con->prepare("INSERT INTO images (userid, `description`, `image`, `target`, `time`) VALUES(?,?,?,?,now())");
            $arr = array($_SESSION['login'],"",$name, "images/".$image);
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
//     }
//     else
//     {
//         echo '<script>alert("invalid image Selected")</script>';
//     }
// }
?>