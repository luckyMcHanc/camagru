<?php
if (isset($_POST['forgot']))
{
    $checker = bin2hex(random_bytes(10));
    $token = random_bytes(32);
    $tok = bin2hex($token);
    $email = $_POST['email'];

    if (empty($email))
    {
        echo '<script>alert("Invalid Email")</script>';
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        echo '<script>alert("Invalid Email")</script>';
    }
    else
    {
        include_once("connect.php");
        $sql = $con->prepare("INSERT INTO token_t (userid, token, expire) VALUES (?,?,NOW() + INTERVAL 1 HOUR)");
        $arr = array($email, $tok);
        if ($sql->execute($arr) === TRUE)
        {
            $message = '<a href ="http://localhost:8080/camagru/passwordrecovery.php?checker='.$checker.'&v='.$tok.'">Click here to change your password</a>';       
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            mail($email, "email Recovery", $message, $headers);
            echo '<script>alert("check your inbox. Follow the link sent to your email to change your password")</script>';
            echo '<script>window.location = "login.php"<script>';
        }
    }
}
?>