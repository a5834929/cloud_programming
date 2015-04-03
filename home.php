<?php
  include('config/mysqli.php');
  include('config/setting.php');
  require 'vendor/autoload.php';
  use Aws\S3\S3Client;
  session_start();

  //$userId = 4;
  $userId = $_SESSION['userId'];
  $email = $_SESSION['email'];
  $sql = "SELECT * FROM image WHERE '$userId' = user_id";
  $result = $link->query($sql);
  $myImg="";

  while($res = $result->fetch_array(MYSQLI_BOTH)){
    $myImg .= '<div class="row">
    <div class="col-md-12">
      <div class="thumbnail">
        <img src="' .$S3_URL.'user_upload/'.$res['s3_link'].'" alt="...">
        <div class="caption">
          <h3>' .$res['title']. '</h3>
          <p>' .$res['caption']. '</p>
        </div>
      </div>
    </div>';
  }
  $result->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Home</title>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
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
        </button>
        <a class="navbar-brand" href="#">Instagram</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">My Images<span class="sr-only">(current)</span></a></li>
          <li><a href="#">My subscription</a></li>
          <li><a href="#">All</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
          <li><a href="./logout.php">Log out</a></li>

        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>


  <div class="container">
    <div class="col-md-5">

      <form enctype="multipart/form-data" method="post" action="uploadImage.php">
        <div class="form-group">
          <label for="title">Title: </label>
          <input type="text" class="form-control" id="title" name="title">
        </div>
        <div class="form-group">
          <label for="caption">Caption: </label>
          <input type="text" class="form-control" id="caption" name="caption">
        </div>
        <div class="form-group">
          <label>Upload image</label>
          <input type="file" name="file">
        </div>
        <input type="submit" value="upload image" class="btn btn-primary">
      </form>
      <hr>

      <?php
        echo $myImg;
      ?>
    </div>
      <div class="col-md-7">
          <?php
              //echo $myImg;
          ?>
      </div>
  </div>

    <script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>
</html>
