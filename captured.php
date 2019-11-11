<?php
require("header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <link rel="stylesheet" href="css/filters.css" />
  
</head>
<body>
    <section>
    <div class="booth">
        <canvas id="canvas" width="400" height="300"></canvas>
        <a href="#" class="button" id="btn-download" download="webcam.png" onclick"capture">Download</a>
      </div>
      <script src="capture.js"></script>
</section>
</body>
</html>