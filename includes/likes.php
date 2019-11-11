<?php

if(isset($_POST['like']))
{
    include_once('connect.php');

    try{
        $id = $_POST['id'];
        $try = $con->prepare("SELECT id FROM likes WHERE username = ? AND imageid = ?");
        $a = array($_SESSION['login'], $id);
        if ($try->execute($a) === TRUE)
        {
           $res = $try->fetchAll();
           if (empty($res))
           {
                
                $sql = $con->prepare("INSERT INTO likes (username, imageid) values (?,?)");
                $arr = array($_SESSION['login'], $id);
                $sql->execute($arr);
                echo '<script>window.location="home.php"</script>';
            }
        else
            {   
                $sql = $con->prepare("DELETE FROM likes WHERE username = ? AND imageid = ?");
                $arr = array($_SESSION['login'], $id);
                $sql->execute($arr);
                echo '<script>window.location="home.php"</script>';
            }
        }
    }
    catch(PDOException $e)
    {
        echo $e;
    }
    $con = null;
}

if (isset($_POST['commet']))
{
    $id = $_POST['id'];
    $comment = strip_tags($_POST['comment']);
    $us = $_POST['userid'];

    if (empty($comment))
    {
        echo '<script>alert("No Comment")</script>';
    }
    else
    {
        include_once('connect.php');

    try{
        
        $sql = $con->prepare("INSERT INTO comments (userid, imageid, comments) values (?,?,?)");
        $arr = array($_SESSION['login'], $id, $comment);
        $sql->execute($arr);

        $send = $con->prepare("SELECT email from users where notific = 1 AND userid = (SELECT userid FROM images WHERE userid = ? AND imageid = ?)");
        
        $send->execute([$us, $id]);
        $res= $send->fetchAll();
     
            if (!empty($res))
            {
                $email = $res[0]['email'];
                mail($email,"Gram notification","Someone commented on your picture. Login to check");
            }
    echo '<script>window.location="home.php"</script>';
    }
    catch(PDOException $e)
    {
        echo $e;
    }
    $con = null;
    }
}

if (isset($_POST['delete']))
{
    $del = $_POST['id'];
    include_once('connect.php');
    $sql = $con->prepare("DELETE FROM images WHERE imageid = ?");
    $sql = $con->prepare("DELETE FROM comments WHERE imageid = ?");

    if ($sql->execute([$del]))
    {
        echo '<script>alert("Deleted")</script>';
        echo '<script>window.location="home.php"</script>'; 
    }
    else
    {
        echo '<script>alert(Could not delete)</script>';
        echo '<script>window.location="home.php"</script>';
    }
}
?>