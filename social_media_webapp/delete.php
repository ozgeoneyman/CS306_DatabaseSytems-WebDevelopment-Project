<?php
session_start();
include "config.php";


$username = $_SESSION['username'];


$query2 = mysqli_query($db, "DELETE
	FROM `User`
WHERE `User`.username = '".$username."'");
header("Location: index.php"); 
exit();

?> 