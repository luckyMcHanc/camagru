<?php

session_start();
if (isset($_POST['email_change']))
{
    include_once("connect.php");
        
        $change = $_POST['email'];
        $userid = $_SESSION['login'];
        if (!filter_var($change, FILTER_VALIDATE_EMAIL))
        {
            echo '<script>alert("Invalid Email")</script>';
            exit();
        }
        else
        {
            try
            {
                $sql = $con->prepare("UPDATE users SET email = ? WHERE userid = ?");
                $arr = array($change, $userid);
                if ($sql->execute($arr) === TRUE)
                {
                    echo '<script>alert("Your email has been change!")</script>';
                    echo '<script>window.location = "changedetails.php"</script>';
         
                }
                else
                {
                    echo '<script>alert("Your email has been change. Check your inbox for verification")</script>';
                }
                $con = null;
            }
            catch(PDOException $e)
            {
                    echo "erro".$e;
            }
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
        $userid = $_GET['v'];
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
                
                $useridd = ($res[0]['userid']);

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
                    $del = $con->prepare("DELETE FROM token_t WHERE token = '$user'");
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
    if (isset($_POST['notific']))
    {
        require 'connect.php';
        $cha = $_POST['notif'];
        if (!empty($cha))
        {
            if (!strcmp($cha, "yes"))
            {

                $sql = $con->prepare("UPDATE users SET notific = 1 WHERE userid = ?");
                if ($sql->execute([$_SESSION['login']]))
                {
                    echo '<script>alert("Infomation Changed.!")</script>';
                }
            }
            else
            {
                $sql = $con->prepare("UPDATE users SET notific = 0 WHERE userid = ?");
                if ($sql->execute([$_SESSION['login']]))
                {
                    echo '<script>alert("Infomation Changed.!")</script>';
                }
            }
        }
    }
?>