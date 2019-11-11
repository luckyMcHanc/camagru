<header>
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
</header>
 <body>
 <div class = "container">
<?php 
include_once("includes/connect.php");
require("includes/likes.php");
try
{
    $x = 0;
    $sql = $con->prepare("SELECT COUNT(`image`) AS amount FROM images");
    if ($sql->execute() === TRUE)
    {
        $res = $sql->setFetchMode(PDO::FETCH_ASSOC);
        foreach($sql->fetchAll() as $v)
        {
            $c = $v;
        }
    }
    $x = $c['amount'];
    //$_SESSION['pos'] = 0;
    if (empty($_SESSION['pos']))
    {
        $_SESSION['pos'] = 0;
    }
    if ($_SESSION['pos'] <= $x)
    {
        if (isset($_POST['next']))
        {
            $_SESSION['pos'] = $_SESSION['pos'] + 5;
            echo '<script> window.location= "index.php"</script>';
        }
        if (isset($_POST['prev']))
        {
            $_SESSION['pos'] = $_SESSION['pos'] - 5;
            echo '<script> window.location= "index.php"</script>';
        }
        $pos = $_SESSION['pos'];
        $sql = $con->prepare("SELECT * FROM images ORDER BY `time` DESC LIMIT $pos, 5");
        if ($sql->execute() === TRUE)
        {
            $res = $sql->setFetchMode(PDO::FETCH_ASSOC);    
            foreach($sql->fetchAll() as $v)
            {
                
                if (!empty($v))
                {
                    ?>
                       <div class="row">
                            <div class="col-md-4">
                                <div class="thumbnail">
                    <img src = "<?php  echo $v['target']?>" alt = "<?php  echo $v['image']?>" style = "width: 500px;height: 300px;display: block;" class="img-rounded active">
                        </div>
                        </div>
                        </div>
                    <?php 
                    $like = $con->prepare("SELECT COUNT(id) as co FROM likes WHERE imageid = ?");
                    if ($like->execute([$v['imageid']]))
                    {
                        $res = $like->fetchAll();
                        echo "number of likes: ".$res[0]["co"];
                    }
                    ?>
                    <div class = "">
                        <?php
                        if (isset($_SESSION['login']))
                        {
                        $try = $con->prepare("SELECT id FROM likes WHERE imageid = ?");
                        $a = array( $v['imageid']);
                        if ($try->execute($a) === TRUE)
                        {
                           $res = $try->fetchAll();
                           if (empty($res))
                           {
                               ?>
                            <form method = "post">
                            <input type = "hidden" name = "id" value = "<?php echo $v['imageid']?>">
                            <button name = "like" class = "btn btn-primary">like</button>
                        </form>
                            <?php
                            }
                        else
                            {   
                                ?>
                                <form method = "post">
                                <input type = "hidden" name = "id" value = "<?php echo $v['imageid']?>">
                                <button name = "like" class = "btn btn-warning">unlike</button>
                            </form>
                                <?php
                            }
                        }

                        $try = $con->prepare("SELECT userid, comments FROM comments WHERE imageid = ? ");
                        $a = array( $v['imageid']);
                        if ($try->execute($a) === TRUE)
                        {
                           foreach($try->fetchAll() as $com)
                           {
                               ?>
<div class="container">
    <div class="row">
        <div class="comments col-md-9" id="comments">
            <!-- comment -->
            <div class="comment mb-2 row">
                <div class="comment-avatar col-md-1 col-sm-2 text-center pr-1">
                    <a href=""><img class="mx-auto rounded-circle img-fluid" src="https://i0.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?fit=256%2C256&quality=100&ssl=1" alt="avatar"></a>
                </div>
                <div class="comment-content col-md-11 col-sm-10">
                    <h6 class="small comment-meta"><a href="#"><?php echo $com["userid"]?></a> </h6>
                    <div class="comment-body">
                        <p>
                        <p> <?php echo $com["comments"]?> </p>
                        </p>
                    </div>
                </div>
        </div>
    </div>
    </div>
    </div>
                               <?php
                           }
                        }
                        ?>
                        <div class="container">
                        <form method = "post">
                            <div class="form-group">
                            <label for="comment">Comment:</label>
                            <textarea class="form-control" rows="5" id="comment"></textarea>
                            <input type = "hidden" name = "id" value = "<?php echo $v['imageid']?>">
                            <input type = "hidden" name = "userid" value = "<?php echo $v['userid']?>">
                            </div>
                            <button name = "commet" class = "btn btn-success">Comment</button>
                        </form>
                        </div>
                        

                   
                        <?php
                            if (!strcmp($_SESSION['login'], $v['userid']))
                            {
                        ?>
                    <div class = "container">
                        <form method = "post">
                        <input type = "hidden" name = "id" value = "<?php echo $v['imageid']?>">
                        <button name = "delete" class = "btn btn-danger">Delete Image</button>
                        </form>
                    </div>
                    <?php
                            }
                }
            }
            }
        }
    }
    else
    {
        echo '<script>alert("No more pictures to view")</script>';
        $_SESSION['pos'] = $_SESSION['pos'] - 5;
        echo '<script> window.location= "index.php"</script>';
    }
}
catch(PODEXception $e)
{
    echo $e;
}
?>
<hr>
<form method = "post" action = "index.php">
<input type = "submit" value = "next" name  = "next" class = "btn btn-primary">
</form>
<?php if($_SESSION['pos'] > 0)
{?>
<form method = "post" action = "index.php">
<input type = "submit" value = "prev" name  = "prev" class = "btn btn-primary">
</form>
<?php }?>
</div>

</body>