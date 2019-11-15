<?php

if (isset($_SESSION['login']))
{
?>
<body>

<div class = "container">
    <div class = "row">
    <!-- <div class = "col-md-4"> -->
    <form method = "POST" action="./home.php" enctype="multipart/form-data">
    <!-- </div> -->
   <br>
    <label >Select Image
        <input type = "file" name="fileToUpload" id="fileToUpload" size="30" >
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
?>
