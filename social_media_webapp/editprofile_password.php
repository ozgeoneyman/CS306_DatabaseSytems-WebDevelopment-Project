<?php
session_start();
include "config.php";


$username = $_SESSION['username'];

if (isset($_POST['password'])) {
$password=$_POST['password'];


    $sql_statement = "UPDATE User
      SET  `User`.`password` = '$password'
      WHERE `User`.username = '$username'";

      mysqli_query($db, $sql_statement);
}
header("Location: profile.php"); 
exit();
?>