<?php
  
session_start();
if (!isset($_SESSION['login']))
{
    echo '<script>window.location="login.php"</script>';
}
require ("includes/upload.php");
?>
<body>
    <form  method = "POST" enctype="multipart/form-data"> 
    <input type = "file" name="fileToUpload" id="fileToUpload">

    SELECT STICKER
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
    <input type = "submit" name = "image" value = "Upload Image">
    </form>
</body>