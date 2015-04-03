<?php
  include('config/mysqli.php');
  include('config/setting.php');
  require 'vendor/autoload.php';
  use Aws\S3\S3Client;
  session_start();

  //$userId = 4;
  $userId = $_SESSION['userId'];
  $email = $_SESSION['email'];
  $sql = "SELECT * FROM image WHERE category_id IN (SELECT category_id FROM user_category WHERE user_id='$userId') ORDER BY category_id";
  $result = $link->query($sql);
  $mySub="";

  $sql = "SELECT name FROM category ORDER BY id";
  $result2 = $link->query($sql);
  $category = array();
  while($name = $result2->fetch_array(MYSQLI_BOTH)){
    array_push($category, $name['name']);
  }

  for($i=0;$i<count($category);$i++){
      while($img = $result->fetch_array(MYSQLI_BOTH)){
        $mySub .= '<div class="row">
        <div class="col-md-12">
          <div class="thumbnail">
            <img src="' .$S3_URL.'user_upload/'.$img['s3_link'].'" alt="...">
            <div class="caption">
              <h4>'.$category[$img['category_id']-1].'<h4>
              <h3>'.$img['title'].'</h3>
              <p>'.$img['caption'].'</p>
            </div>
          </div>
        </div>';
      }
    }
  $result->close();
  $result2->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Home</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/home.css">
</head>
<body>

  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#"><?php echo $email;?></a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li><a href="./home.php">My Images</a></li>
          <li class="active"><a href="#">My Subscription<span class="sr-only">(current)</span></a></li>
          <li><a href="./showAllImg.php">All</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
          <li><a href="./logout.php">Log out</a></li>

        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>


  <div class="container">

    <div class="col-md-8">
      <?php
        echo $mySub;
      ?>
    </div>
  </div>

    <script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>
</html>
