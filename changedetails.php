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
    <form method = "POST">
    <div class = "row">
        <div class="col-md-6">
            <input type="email" class="form-control input-lg" name = "email" placeholder="enter new email" required>
       </div>
       <div class = "col-md-6">
            <input type = "submit" name = "email_change" value = "change email" class="btn btn-secondary">
        </div>
        </div>
    </form>
    </div>

        <hr style = "opacity:0;">
        <hr style = "opacity:0;">
        <div class = "container">
    <form method = "POST" action = "#">
            <div class = "row">
            <div class = "col-md-4">
                <div class="form-group">
                    <input class = "form-control" type="password" name = "newpassword" placeholder="Enter new Password" required>
                </div>
            </div>
            <div class = "col-md-4">
                <div class="form-group">
                    <input class = "form-control" type="password" name = "retypepassword" placeholder="Enter new Password" required>
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
        <form method = "POST" action = "#">
            <p>Do you want to continue recicieving emails on notifications?</p>
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
        <hr style = "opacity:0;">
        <div class ="col-md-6">
            <div class = "form-group">
                <input type = "submit" name = "notific" value = "Change Notification" class="btn btn-secondary">
            </div>
        </div>
    </form>
    </div>
</body>

<?php
    require('footer.html');
?>