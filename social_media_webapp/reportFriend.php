<?php
session_start();
include "config.php";
$username = $_SESSION['username'];

$reportedFriend = $_GET['reportedUser'];


mysqli_query($db, "INSERT INTO `Report_User` (`friends_username`, `username`) VALUES ('$reportedFriend', '$username')");

header("Location: homepage.php"); 
exit();

?>