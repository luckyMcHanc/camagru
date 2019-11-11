<?php
   
   if (isset($_POST['signup']))
   {
    include_once("connect.php");
        $email = $_POST['email'];
        $fullname = strip_tags($_POST['name']);
        $username = strip_tags($_POST['username']);
        $password = $_POST['password'];
        $repassword = $_POST['repassword'];
        $gender = $_POST['gender'];

        function validPass($password)
        {
            if(strlen($password) >= 8){
                if(!ctype_alpha($password) && !ctype_lower($password)){
                    return TRUE;
                }
            }
        }
        if ($password !== $repassword)
        {
            echo '<script>alert("Password Do not Match")</script>';
        }
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            echo '<script>alert("Invalid Email")</script>'; 
        }
        elseif (validPass($password) !== TRUE)
        {
            echo '<script>alert("Password Does not meet minimum requirements")</script>';
        }
        else if(!preg_match("/^[a-zA-Z ]*$/", $fullname))
        {
            echo '<script>alert("Fullname Incorrectly Structured")</script>';
        }
        else
        {
            $pos = strpos($fullname, " ", 0);
            if ($pos > 0)
            {
                $first = substr($fullname,0,$pos);
                $second = substr($fullname, $pos + 1);
            }
            else
            {
                $first = $fullname;
                $second = ""; 
            }
            try
            {
                $select = $con->prepare("SELECT * FROM users WHERE email = ? OR userid = ?");
                $array = array($email, $username);
                $select->execute($array);
                $res = $select->fetchAll();
                
                if (empty($res))
                {
                    $options = [
                    'cost' => 12,
                    ];
                    $hashing = password_hash($password, PASSWORD_BCRYPT, $options);
                    $ver = 0;
                    $token = random_bytes(32);
                    $tok = bin2hex($token);
                    $sql = $con->prepare("INSERT INTO users (firstname, lastname, userid, password, gender, email, verified) VALUES (?,?,?,?,?,?,?)");
                    $sql2 = $con->prepare("INSERT INTO token_t (userid, token, expire) VALUES (?,?,NOW() + INTERVAL 1 HOUR)");
                    $arr = array($first, $second, $username, $hashing, $gender,$email,$ver);
                    $arr2 = array($username, $tok);
                    if ($sql2->execute($arr2) === TRUE && $sql->execute($arr) === TRUE)
                    {
                        $checker = bin2hex(random_bytes(10));

                        $message = '<a href ="http://localhost:8080/camagru/includes/verify.php?checker='.$checker.'&v='.$tok.'">Click here to verify your account</a>';
                        
                        $headers  = 'MIME-Version: 1.0' . "\r\n";
                        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                        mail($email,"Confirm your Email",$message, $headers);

                        echo '<script>alert("Registered Successfully. Please check your email for a verification link")</script>';
                        echo '<script>window.location="login.php"</script>';
                    }
                    else
                    {
                        echo '<script>alert("Registration not Succesful. Please try again later")</script>';
                    }
                }
                else
                {
                    echo '<script>alert("The email or username already exit in the system. Please try another one")</script>';
                }
                $con = null;
            }
            catch(PDOException $e)
            {
                echo "error".$e;   
            }
        }
    
    }
?> 