
<?php
session_start();
include "config.php";

$username = $_SESSION['username'];

if (isset($_POST['image'])) {
$image=$_POST['image'];

    $sql_statement = "UPDATE User
      SET  `User`.`profile_picture` = '$image'
      WHERE `User`.username = '$username'";

      mysqli_query($db, $sql_statement);

}
header("Location: profile.php"); 
exit();
?>
