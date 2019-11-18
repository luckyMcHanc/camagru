<?php
  
  if(!isset($_SESSION)) 
  { 
      session_start(); 
  }
if (!isset($_SESSION['login']))
{
    echo '<script>window.location="login.php"</script>';
}
require("includes/change.php");
require 'header.php';
$email = $_SESSION['email'];
?>
<body>
        <hr style = "opacity:0;">
        <hr style = "opacity:0;">

<div class = "container">
    <div class = "row">
        <div class="col-md-6" id = "email_c">
            <input type="email" class="form-control input-lg" id = "email" maxlength = "40" placeholder="enter new email" required>
       </div>
       <div class = "col-md-6">
            <input type = "submit" id = "email_change" value = "change email" class="btn btn-secondary" onclick="change_email()">
        </div>
        </div>
    </div>

        <hr style = "opacity:0;">
        <hr style = "opacity:0;">
    <div class = "container">
        <!-- <form method = "POST"> -->
        <div class = "row">
            <div class="col-md-6" id = "user_c">
                <input type="text" class="form-control input-lg" id = "username" maxlength = "40" placeholder="enter new username" required>
        </div>
        <div class = "col-md-6">
                <input type = "submit" id = "user" value = "change username" class="btn btn-secondary" onclick="username()">
            </div>
            </div>
        <!-- </form> -->
        </div>

        <hr style = "opacity:0;">
        <hr style = "opacity:0;">
        <div class = "container">
    <form method = "POST" action = "#">
            <div class = "row">
            <div class = "col-md-4">
                <div class="form-group">
                    <input class = "form-control" type="password" name = "newpassword" maxlength = "40" placeholder="Enter new Password" required>
                </div>
            </div>
            <div class = "col-md-4">
                <div class="form-group">
                    <input class = "form-control" type="password" name = "retypepassword" maxlength = "40" placeholder="Enter new Password" required>
                </div>
            </div>

            <div class ="col-md-6">
                <input type = "submit" name = "update" value = "change password" class="btn btn-secondary">
            </div>
        </div>
    </form>
    </div>
    <hr style = "opacity:0;">
    <div class = "container">
        <!-- <form method = "POST" action = "#"> -->
            <p>Do you want to continue recicieving emails on notifications?</p>
        <div id = "notific_c">
        <div class ="col-md-4">
            <label class="radio-inline">
                <input class="checkbox-inline" type="radio" name="notif" value="yes"> YES
            </label>
        </div>
        <div class ="col-md-4">
            <label class="radio-inline">
                <input class="checkbox-inline" type="radio" name="notif" value="no"> NO
            </label>
        </div>
        </div>
        <hr style = "opacity:0;">
        <div class ="col-md-6">
            <div class = "form-group">
                <input type = "submit" id = "notific" onclick="notification()" value = "Change Notification"  class="btn btn-secondary" >
            </div>
        </div>
    <!-- </form> -->
    </div>
    <script src="js/change.js"></script>
</body>

<?php
    require('footer.html');
?>