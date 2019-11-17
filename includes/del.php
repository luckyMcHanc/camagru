<?php


if(!isset($_SESSION))
{
    session_start();
}
if(isset($_GET['id']))
{
    $id = $_GET['id'];


    include_once('connect.php');
    $sql = $con->prepare("DELETE FROM images WHERE imageid = ?");
    if ($sql->execute([$id]))
    {
      //  echo '<script>alert("Deleted")</script>';
      $im = $con->prepare("SELECT * FROM images WHERE userid  = ? order by time DESC");
      if ($im->execute([$_SESSION['login']]))
      {
        $res = $im->fetchAll();

        foreach($res as $image) {
          ?>
          <hr style = "opacity:0;">

          <div class="col-lg-3 col-md-4 col-6">
              <button class="btn btn-default" style = "width : 120px; height : 130px;" name = "delete" onclick="delpic(<?php echo $image['imageid']; ?>)">
                <div  class="d-block mb-4 h-100">
                      <input type = "hidden" value="<?php echo $image['imageid']; ?>" name  = "id">
                      <img class="img-fluid img-thumbnail" src="<?php echo $image['target']; ?>" alt="" style = "width : 250px; height : 130px;">
                </div>
              </button>
              </div>
          <?php
      }  
    }
  
    }
    else
    {
        echo '<script>alert(Could not delete)</script>';
        echo '<script>window.location="camera.php"</script>';
    }
}
?>