<main>
<?php
$email = $_GET['id'];
require("includes/change.php");
require("header.php");
?>

<div class="container">
    <div class = "row">
        <div class = "col-md-4 container-fluid">
<form  method="POST">
    
<p>Create new password</p>

    <div class = "form-group">
<input type="password" class = "form-control input-lg" name="newpassword" placeholder="New Password"required><br>
    </div>
    <div class = "form-group">
<input type="password" class = "form-control input-lg" name="retypepassword" placeholder="Retype password"required><br>
    </div>
<div class = "form-group">
<input type="submit" name="update" value="update" class="btn btn-secondary container-fluid"> 
</div>
</form>
        </div>    
    </div>
</div>
</main> 
<?php
    require('footer.html');
    ?>