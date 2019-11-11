<?php
if (isset($_FILES['post']))
{
    $name = $_FILES['fileToUpload']['name'];
    $type = $_FILES['fileToUpload']['tmp_name'];
    $tmpn =  getimagesize($_FILES['fileToUpload']['tmp_name']);
    $target = "../images/";
    
    if (strlen($content) > 250){
        echo "<script>alert('Please Use 250 or less than 250 words!')</script>";
        echo "<script>window.open('home.php', '_self')</script>";
    }
    else
    {
        if (strlen('$name') >= 1 && strlen($content) >= 1)
        {
            move_uploaded_file($type, $target.$name);
        }
    }
}