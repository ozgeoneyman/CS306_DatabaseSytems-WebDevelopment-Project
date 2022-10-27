<?php
session_start();
include "config.php";
$username = $_SESSION['username'];
$passusername = $_GET['passusername'];


    $sql_statement = "INSERT INTO `Friend` (`username`, `friends_username`) 
      VALUES ('$username', '$passusername')";

      mysqli_query($db, $sql_statement);

      echo "<script type='text/javascript'>
            alert('Subscribed to the user successfully!');
            history.go(-1);
            </script>";
?>