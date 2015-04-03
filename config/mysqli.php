<?php

$server = 'db-cp08-100062101.ce1qdppaipso.us-east-1.rds.amazonaws.com';
$user = 'cp08';
$password = 'group008';
$name = 'cp08';
$port = 3306;

$link = mysqli_connect($server, $user, $password, $name, $port);

?>
