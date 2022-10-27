<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>SOCIALGRAM</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
	
		body {
  background-image: url('wp.jpeg');
  background-repeat: no-repeat;
  background-attachment: fixed; 
  background-size: cover;
}

body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #ffb2b2;
  color: white;
}
</style>
</head>
<body>
<div align="center">


<?php
$username = $_SESSION['username'];
include "config.php";
  $query4 = mysqli_query($db, "UPDATE `Has_Account`
SET `deactivate`= b'0'
WHERE `Has_Account`.username = '".$username."'");
header("Location: homepage.php"); 
exit();

?>
</div>
</body>
</html>