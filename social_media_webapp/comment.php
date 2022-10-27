<?php
session_start();
include "config.php";
$username = $_SESSION['username'];

$passPostId = $_GET['passPostId'];

if (isset($_POST['comment'])) {

		$passComment = $_POST['comment'];
} 

mysqli_query($db, "INSERT INTO `Has_Comment` (`post_id`, `username`, `comment_text`) VALUES ('$passPostId', '$username', '$passComment')");
header("Location: homepage.php"); 
exit();



?>