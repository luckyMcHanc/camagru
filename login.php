<?php
require("header.php");
require("includes/login_inc.php");
?>
<body style=" background-image: url('https://repository-images.githubusercontent.com/185094183/ff64fd00-706f-11e9-9b53-d05acb2d0989'); color:white;"> 
<div class = "login">
<div class="container">
        <div class = "row">
            <div class = "col-md-5 container-fluid">
                <form action="#" method="POST">
                    <h1 class = "text-center">Have an account?</h1>
                    <div class="input-group mb-3 input-group-md">
                        <input type="text" name="username" maxlength = "40" class = "form-control" placeholder="username or email" autocomplete="on" required><br>
                    </div>
                    <div class="input-group mb-3 input-group-md">
                        <input type="password" class = "form-control" maxlength = "40" name="password" placeholder="password" autocomplete="off" required>
                    </div>
                    <div class="input-group mb-3 input-group-md">
                        <input type="submit" name="login" value="Sign_in" class="btn btn-success">
                    </div>
                    <a href="forgot.php">Forgot Password?</a><br>
                    Don't have an account? <a href="signup.php">sign_up</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body> 
<?php
    require('footer.html');
    ?>
