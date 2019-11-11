<?php
require("header.php");
require("includes/signup_inc.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <main>
    <br />
    <div class="container" id="wrap">
	  <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h1>Register</h1>
            <p>Create your account</p>
            <br />
            <br />
                <form method  = "post" accept-charset="utf-8" class="form" role="form">
            <div class="row">
                <div class="col-xs-6 col-md-6">
                    <input type="text" class="form-control input-lg" name="name" placeholder="Full Name" autocomplete="on"required><br>
                    </div>
                    <div class="col-xs-6 col-md-6">
                    <input type="text" class="form-control input-lg" name="username" placeholder="Username" autocomplete="on" required><br>
                    </div>
                </div>
                    <input type="text" class="form-control input-lg" name="email" placeholder="email" autocomplete="on" required><br>
                    <input type="password" class="form-control input-lg" name="password" placeholder="Password" autocomplete="on" required><br>
                    <input type="password" class="form-control input-lg" name="repassword" placeholder="Retype Password" autocomplete="off" required><br>
                    <label class="radio-inline">
                        <input type="radio" class="checkbox-inline" name="gender" value="male">Male
                    </label>
                    <label class="radio-inline">
                        <input type="radio" class="checkbox-inline" name="gender" value="female">Female
                    </label>
                    <label class="radio-inline">
                        <input type="radio" class="checkbox-inline" name="gender" value="other">Other<br>
                    </label>
                    <br />
                    <br />
                    <span class="help-block">By clicking Create my account, you agree to our Terms and that you have read our Data Use Policy, including our Cookie Use.</span> 
                    <br />
                    <br />
                    <input type="submit" class="btn btn-lg btn-success btn-block signup-btn" name="signup" value="Sign_up">
                </form>
            <div class ="container sign">
                Have an account? <a href="login.php">sign_in</a>
            </div>
        </div>
    </div>
</div>
</main>
</body>
</html>