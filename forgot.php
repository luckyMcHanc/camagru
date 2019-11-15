<?php
require("header.php");
require("includes/recover_inc.php");
?>
<main>
<div class="container">
<form  method="POST">
<p>Recover Password</p>
<hr>
<input type="text" name="email" placeholder="email"required><br>
<input type="submit" name="forgot" value="Recover"required>
<div class ="container sign">
Have an account? <a href="login.php">sign_in</a><br>
Don't have an account? <a href="signup.php">sign_up</a>
</div>
</form>
</div>
</main>
<?php
    require('footer.html');
    ?>
