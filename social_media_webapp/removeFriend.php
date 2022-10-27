<?php
session_start();
include "config.php";
$username = $_SESSION['username'];

$removeFriend = $_GET['removeFriend'];


mysqli_query($db, "DELETE FROM `Friend` WHERE username = '$username' AND friends_username = '$removeFriend'");

header("Location: homepage.php"); 
exit();

?>