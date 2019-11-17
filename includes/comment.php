
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
