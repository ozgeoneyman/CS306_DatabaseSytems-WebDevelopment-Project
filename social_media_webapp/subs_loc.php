<?php
session_start();
include "config.php";
$username = $_SESSION['username'];
$passLoc = $_GET['passLoc'];


    $sql_statement = "INSERT INTO `Subscribe_Location` (`username`, `loc`) 
      VALUES ('$username', '$passLoc')";

      mysqli_query($db, $sql_statement);

	
header("Location: homepage.php"); 
exit();
?>