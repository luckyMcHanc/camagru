<?php

if(!isset($_SESSION))
{
    session_start();
}
if (isset($_GET['email_change']))
{
    include_once("connect.php");

        $change = $_GET['email'];
        $userid = $_SESSION['login'];
        if (!filter_var($change, FILTER_VALIDATE_EMAIL))
        {
           // echo '<script>alert("Invalid Email")</script>';
            exit();
        }
        else
        {
            try
            {
                $sql = $con->prepare("UPDATE users SET email = ? WHERE id = ?");
                $arr = array($change, $userid);
                if ($sql->execute($arr) === TRUE)
                {
                    mail($change, "Email Changed", "Your email has been changed");
                    echo ' <input type="email" class="form-control input-lg" id = "email" maxlength = "40" placeholder="enter new email" required>';
                   echo '<script>alert("changedetails.php")</script>';
                }
                else
                {
                    echo '<script>alert("no changes made")</script>';
                }
                $con = null;
            }
            catch(PDOException $e)
            {
                    echo "erro".$e;
            }
        }
    }

    if (isset($_GET['user']))
{
    include_once("connect.php");

        $change = $_GET['username'];
        $userid = $_SESSION['login'];
       
            try
            {
                $sql = $con->prepare("UPDATE users SET userid = ? WHERE id = ?");
                $arr = array($change, $userid);
                if ($sql->execute($arr) === TRUE)
                {
                    echo '<input type="text" class="form-control input-lg" id = "username" maxlength = "40" placeholder="enter new username" required>';
                    // echo '<script>alert("Your username has been change!")</script>';
                    // echo '<script>window.location = "changedetails.php"</script>';
                 //   mail($change, "Email Changed", "Your email has been changed");
                }
                else
                {
                    echo '<script>alert("no changes")</script>';
                }
                $con = null;
            }
            catch(PDOException $e)
            {
                    echo "erro".$e;
            }
        }

    if (isset($_POST['update']))
    {
        function validPass($password)
        {
            if(strlen($password) >= 8){
                if(!ctype_alpha($password) && !ctype_lower($password)){
                    return TRUE;
                }
            }
        }
        $userid = isset($_GET['v']) ? $_GET['v'] : $_SESSION['email'];
        $password = $_POST['newpassword'];
        $conpass = $_POST['retypepassword'];


        if (strcmp($password, $conpass))
        {
            echo '<script>alert("Passwords not the same!")</script>';
        }
        elseif (validPass($password) !== TRUE)
        {
            echo '<script>alert("Password did not meet minimun complexity!")</script>';
        }
        else
        {
            if (empty($userid))
            {
                $userid = $_SESSION['email'];
            }
            try
            {
                include_once("connect.php");
                $sql = $con->prepare("SELECT userid FROM token_t WHERE token = ?");
                $sql->execute([$userid]);

                $res = $sql->fetchAll();

                $userid = isset($res[0]['userid']) ? $res[0]['userid'] : $userid;

                if (!empty($useridd))
                {
                    $userid = $useridd;
                }
                $options = [ 'cost' =>12,];
                $hash = password_hash($password, PASSWORD_BCRYPT, $options);
                $sql = $con->prepare("UPDATE users SET password = ? WHERE email = ?");
                $arr = array($hash, $userid);
                if ($sql->execute($arr) === TRUE)
                {
                    $del = $con->prepare("DELETE FROM token_t WHERE token = '$userid'");
                    if ($del->execute())
                    {
                        echo '<script>alert("password updated!")</script>';
                    }
                }
                else
                {
                    echo '<script>alert("password Not updated, Try again!")</script>';
                }
                $con = null;
            }
            catch(PDOException $e)
            {
                echo "error".$e;
            }
        }
    }
    if (isset($_GET['notific']))
    {
        require 'connect.php';
        $cha = $_GET['notif'];
        if (!empty($cha))
        {
            if (!strcmp($cha, "yes"))
            {

                $sql = $con->prepare("UPDATE users SET notific = 1 WHERE id = ?");
                if ($sql->execute([$_SESSION['login']]))
                {
                    echo '<div class ="col-md-4">
                    <label class="radio-inline">
                        <input class="checkbox-inline" type="radio" name="notif" value="yes"> YES
                    </label>
                </div>
                <div class ="col-md-4">
                    <label class="radio-inline">
                        <input class="checkbox-inline" type="radio" name="notif" value="no"> NO
                    </label>
                </div>';
                }
            }
            else
            {
                $sql = $con->prepare("UPDATE users SET notific = 0 WHERE id = ?");
                if ($sql->execute([$_SESSION['login']]))
                {
                    echo '<div class ="col-md-4">
                    <label class="radio-inline">
                        <input class="checkbox-inline" type="radio" name="notif" value="yes"> YES
                    </label>
                </div>
                <div class ="col-md-4">
                    <label class="radio-inline">
                        <input class="checkbox-inline" type="radio" name="notif" value="no"> NO
                    </label>
                </div>';
                }
            }
        }
    }
?>
