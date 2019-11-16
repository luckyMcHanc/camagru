<header>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</header>

<body>
    <div class="container">
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
  //  echo $x;
    $x = ceil($x / 5);

    //$_SESSION['pos'] = 0;
    // if (empty($_SESSION['pos']))
    // {
    //     $_SESSION['pos'] = 0;
    // }
    // if ($_SESSION['pos'] <= $x)
    // {
    //     if (isset($_POST['next']))
    //     {
    //         $_SESSION['pos'] = $_SESSION['pos'] + 5;
    //         echo '<script> window.location= "home.php"</script>';
    //     }
    //     if (isset($_POST['prev']))
    //     {
    //         $_SESSION['pos'] = $_SESSION['pos'] - 5;
    //         echo '<script> window.location= "home.php"</script>';
    //     }
    //     $pos = $_SESSION['pos'];
        $pos = isset($_GET["page"]) ? $_GET["page"] : 1;
        
       // echo $x;
        if (($pos  > 0  && $pos <= $x) || $x == 0)
        {
        $pos = ($pos - 1) * 5;
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
                    <p> Posted By: <?php 
                        $post = $con->prepare("SELECT * FROM users WHERE id = ?");
                        $pers = $v['userid'];
                      //  echo $pers;
                        if ($post->execute([$pers]))
                        {
                            $p = $post->fetchAll();
                           // print_r($p);
                            echo $p[0]['userid']." Date: ".$v['time']; 
                        }
                    ?>
                    <div class="thumbnail">
                        <img src="<?php  echo $v['target']?>" alt="<?php  echo $v['image']?>" style="width: 500px;height: 300px;display: block;" class="img-thumbnail">
                    </div>
                </div>
            </div>
            <hr style="opacity:0" ;>
            <!-- <div id = "" -->
            <?php
                        if (isset($_SESSION['login']))
                        {
                        ?>
                number of likes: <span id="<?php echo $v['imageid']?>">
                        <?php
                             $like = $con->prepare("SELECT COUNT(id) as co FROM likes WHERE imageid = ?");
                             if ($like->execute([$v['imageid']]))
                             {
                                 $res = $like->fetchAll();
                                 echo $res[0]["co"];
                             }
                        ?>
                </span>
                <hr style="opacity : 0;">
                <div class="row">
                    <div class="col-md-4">
                    <!-- <form name = "like"> -->
                    <input type="hidden" id="id" value="<?php echo $v['imageid']?>">
                    <div class = "form-grop"> 
                    <input type="button" id="like" class="btn btn-primary" onclick="likes(<?php echo $v['imageid']?>)" value="like">
                    </div>
                    <!-- </form> -->
                    </div>
                </div>
    
                    <?php
                        $try = $con->prepare("SELECT userid, comments FROM comments WHERE imageid = ? ");
                        $a = array( $v['imageid']);
                        if ($try->execute($a) === TRUE)
                        {
                           foreach($try->fetchAll() as $com)
                           {
                               ?>
                        <hr style="opacity : 0;">
                        <div class="container">
                            <div class="row">
                                <div class="comments col-md-9" id="comments">
                                    <!-- comment -->
                                    <div class="comment mb-2 row">
                                        <div class="comment-avatar col-md-1 col-sm-2 text-center pr-1">
                                            <a href=""><img class="mx-auto rounded-circle img-fluid" src="https://i0.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?fit=256%2C256&quality=100&ssl=1" alt="avatar"></a>
                                        </div>
                                        <div class="comment-content col-md-11 col-sm-10">
                                            <h6 class="small comment-meta"><a href="#"><?php 
                                            $nam = $con->prepare("SELECT userid FROM users WHERE id = ?");
                                            $idd = $com["userid"];
                                           // echo $idd;
                                            if ($nam->execute([$idd]))
                                            {
                                                $res = $nam->fetchAll();
                                               // print_r ($res);
                                                echo $res[0]["userid"];
                                            }
                                            ?>
                                        </a> </h6>
                                            <div class="comment-body">
                                                <p>
                                                    <?php echo $com["comments"]?>
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
                                <form method="post">
                                    <div class="form-group">
                                        <label for="comment">Comment:</label>
                                        <textarea class="form-control" rows="5" name="comment"></textarea>
                                        <input type="hidden" name="id" value="<?php echo $v['imageid']?>">
                                        <input type="hidden" name="userid" value="<?php echo $v['userid']?>">
                                    </div>
                                    <button name="commet" class="btn btn-success">Comment</button>
                                </form>
                            </div>

                            <?php
                            if (!strcmp($_SESSION['login'], $v['userid']))
                            {
                                ?>
                                <!-- <div class="container">
                                    <form method="post">
                                        <input type="hidden" name="id" value="<?php echo $v['imageid']?>">
                                        <button name="delete" class="btn btn-danger">Delete Image</button>
                                    </form>
                                </div> -->
                                <?php
                            }
                }
            }
            }
        }
    else
    {
        echo '<script>alert("No more pictures to view")</script>';
        $_SESSION['pos'] = $_SESSION['pos'] - 5;
        echo '<script> window.location= "home.php"</script>';
    }
}
else {
    echo '<script>alert("No more pictures to view")</script>';
    echo '<script> window.location= "home.php"</script>';
}
}
catch(PODEXception $e)
{
    echo $e;
}

?>
                                    <hr>
                                    <!-- <form method = "post" action = "home.php">
<input type = "submit" value = "next" name  = "next" class = "btn btn-primary">
</form>
<?php if($_SESSION['pos'] > 0)
{?>
<form method = "post" action = "home.php">
<input type = "submit" value = "prev" name  = "prev" class = "btn btn-primary">
</form>
<?php }

?> -->

                                    <?php
?>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="container-fluid">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <?php for($i = 1; $i <= $x; $i++)
  {
      ?>
                              <li class="page-item">
                                  <a class="page-link" href="home.php?page=<?php echo $i ?>">
                                      <?php echo $i ?>
                                  </a>
                              </li>
    <?php } ?>
                              </ul>
                          </nav>
                      </div>
                  </div>
              </div>
                <script src="js/likes.js"></script>
    </div>
</body>
