<?php

if(!isset($_SESSION))
{
    session_start();
}

if(isset($_GET['id']))
{
    $id = $_GET['id'];

    //echo $_GET['id'];
  //  die();
    require '../includes/connect.php';
    try{
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
                $like = $con->prepare("SELECT COUNT(id) as co FROM likes WHERE imageid = ?");
                if ($like->execute([$id]))
                {
                    $res = $like->fetchAll();
                    echo $res[0]["co"];
                }
            }
        else
            {
                $sql = $con->prepare("DELETE FROM likes WHERE username = ? AND imageid = ?");
                $arr = array($_SESSION['login'], $id);
                $sql->execute($arr);
                $like = $con->prepare("SELECT COUNT(id) as co FROM likes WHERE imageid = ?");
                if ($like->execute([$id]))
                {
                    $res = $like->fetchAll();
                    echo $res[0]["co"];
                }
            }
        }
    }
    catch(PDOException $e)
    {
        echo $e;
    }
    $con = null;
    unset($_GET['id']);
}

if(isset($_POST['commet']))
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

?>
