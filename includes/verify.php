<?php

try
{
        include_once("connect.php");
        $user = $_GET['v'];
        if (!isset($user))
        {
            echo '<script>window.location="../login.php"</script>';
        }

        $sql = $con->prepare("SELECT userid FROM token_t WHERE token = ?");
        $sql->execute([$user]);

        $res = $sql->fetchAll();

        $userid = ($res[0]['userid']);

        if (!empty($userid))
        {
            $update = $con->prepare("UPDATE users SET verified = 1 WHERE id = ? AND verified = 0");
            if ($update->execute([$userid]) === TRUE)
            {
                $del = $con->prepare("DELETE FROM token_t WHERE token = '$user'");
                if ($del->execute())
                {
                    echo "email verified. Close the tab and go to Camagru website!";
                }
            }
        }
        else
        {
            echo "link no longer available. Close the tab and go to Camagru website!";
        }
        $con = null;
    }
    catch(PDOException $e)
    {
        echo $e;
    }
?>
