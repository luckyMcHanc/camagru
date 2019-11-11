<?php
require("header.php");
require("includes/login_inc.php");
?>
<body>
<div class = "login">
<div class="container">
        <div class = "row">
            <div class = "col-md-5">
                <form action="#" method="POST">
                    <h1 class = "text-center">Have an account?</h1>
                    <div class="input-group mb-3 input-group-md">
                        <input type="text" name="username" class = "form-control" placeholder="username or email" autocomplete="on" required><br>
                    </div>
                    <div class="input-group mb-3 input-group-md">
                        <input type="password" class = "form-control" name="password" placeholder="password" autocomplete="off" required>
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
