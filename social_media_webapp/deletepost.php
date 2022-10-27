<?php
session_start();
include "config.php";

$passPostId = $_GET['passPostId'];


mysqli_query($db, "DELETE
	FROM `Post`
WHERE `Post`.post_id = '".$passPostId."'");

header("Location: profile.php"); 
exit();

?>
