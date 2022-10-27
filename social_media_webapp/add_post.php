<?php
session_start();
include "config.php";


$username = $_SESSION['username'];


if (isset($_POST['text'])) {
$image=$_POST['image'];
$text = $_POST['text'];
$location = $_POST['location'];

  
    $sql_statement = "INSERT INTO Post (`image`, `text`, `location`) 
      VALUES ('$image', '$text', '$location')";
      mysqli_query($db, $sql_statement);


    $getPostId = mysqli_query($db, "SELECT post_id 
      	FROM Post
      	WHERE `Post`.`image` = '$image', `Post`.`text` = '$text', `Post`.`location` = '$location'");


	$sql_statement2 = "INSERT INTO Has_Post (`post_id`,`username`) 
	      VALUES ('$getPostId',  '$username')";
	     mysqli_query($db, $sql_statement2);
	 
}
    header("Location: homepage.php"); 
	exit();

?>


