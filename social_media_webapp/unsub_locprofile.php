<?php
session_start();
include "config.php";
$username = $_SESSION['username'];
$passLoc = $_GET['passLoc'];


    $sql_statement = "DELETE FROM Subscribe_Location WHERE `Subscribe_Location`.loc = '".$passLoc."'";

      mysqli_query($db, $sql_statement);

	
header("Location: profile.php"); 
exit();
?>