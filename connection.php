<?php
$server = "localhost";
$user = "root";
$pass = "root";
$db = "scrapbook";
$connect = mysqli_connect($server,$user,$pass,$db) or die(mysqli_error($connect));
?>
