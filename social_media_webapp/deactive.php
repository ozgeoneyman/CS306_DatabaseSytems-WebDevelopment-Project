<?php
session_start();
include "config.php";


$username = $_SESSION['username'];


$query2 = mysqli_query($db, "UPDATE `Has_Account`
SET `deactivate`= b'1'
WHERE `Has_Account`.username = '".$username."'");
header("Location: index.php"); 
exit();

?> 
