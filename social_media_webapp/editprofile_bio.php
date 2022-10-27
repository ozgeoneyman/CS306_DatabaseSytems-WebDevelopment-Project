<?php
session_start();
include "config.php";


$username = $_SESSION['username'];

if (isset($_POST['bio'])) {
$bio=$_POST['bio'];

    $sql_statement = "UPDATE User
      SET  `User`.`biography` = '$bio'
      WHERE `User`.username = '$username'";

      mysqli_query($db, $sql_statement);
}

header("Location: profile.php"); 
exit();
?>