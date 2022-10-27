<?php
include "config.php";

$passPostId = $_GET['passPostId'];

if (isset($_POST['text'])) {
	$text = $_POST['text'];
	$location = $_POST['location'];

    $sql_statement = "UPDATE Post
      SET  `Post`.`text` = '$text', `Post`.`location` = '$location'
      WHERE `Post`.post_id = '$passPostId'";

      mysqli_query($db, $sql_statement);
	}

header("Location: profile.php"); 
exit();
?>