<?php
  include('config/mysqli.php');
  require('config/setting.php');
  require 'vendor/autoload.php';
  use Aws\S3\S3Client;
  session_start();

  $time = Time();
  $name = $_FILES["file"]["name"] . (string)$time;


  $title = $_POST['title'];
  $caption = $_POST['caption'];
  $s3_link = "user_upload/".$name;
  $user_id = $_SESSION['userId'];
  $category_id = 1;

  $sql = "INSERT INTO image VALUES (NULL, '$title', '$caption', '$name', '$user_id', '$category_id')";
  $link->query($sql);


  $client = S3Client::factory(array(
    'key' => $AWS_KEY,
    'secret' => $AWS_SECRET
  ));

  //insert object into bucket
  $result = $client->putObject(array(
          'Bucket' => $BUCKET_NAME,
          'Key'    => $s3_link,
          'SourceFile'   => $_FILES["file"]["tmp_name"],
          'ContentType' => 'image/jpeg'
  ));
  echo '<meta http-equiv="Refresh" content="0;url=http://'.$SERVER_IP.'/cloud_programming/home.php">';
?>
