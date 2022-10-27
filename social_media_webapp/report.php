<?php
session_start();
include "config.php";
$username = $_SESSION['username'];

$passPostId = $_GET['passPostId'];


mysqli_query($db, "INSERT INTO `Report_Post` (`post_id`, `username`) VALUES ('$passPostId', '$username')");

header("Location: homepage.php"); 
exit();

?>