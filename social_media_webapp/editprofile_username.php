
<?php
session_start();
include "config.php";

$username = $_SESSION['username'];

if (isset($_POST['u_name'])) {

	$u_name = $_POST['u_name'];

	$query = mysqli_query($db,"SELECT * FROM User WHERE username='".$u_name."'");

 	if (!$query) {
        die('Error: ' . mysqli_error($db));
    }

	if (mysqli_num_rows($query) > 0) {

    	echo " <script type='text/javascript'>
				alert('Username already exists! Try another.');
				history.go(-1);
					</script>";

		
	}

	else {

		$user = mysqli_query($db, "SELECT * FROM User
							WHERE username = '$username'");
		$userInfo = mysqli_fetch_array($user);

		$phone = $userInfo['phone_number'];
		$birthday = $userInfo['date_of_birth'];
		$pic = $userInfo['profile_picture'];
		$bio = $userInfo['biography'];
		$pass = $userInfo['password'];
		$srnm = $userInfo['surname'];
		$nm = $userInfo['name'];
		$ml = $userInfo['mail'];

		mysqli_query($db, "DELETE FROM User
		      WHERE `User`.`username` = '$username'");

		mysqli_query($db, "INSERT INTO `User` (`phone_number`, `date_of_birth`, `profile_picture`, `biography`, `password`, `username`, `surname`, `name`, `mail`) 
		   	   VALUES ('$phone', '$birthday', '$pic', '$bio', '$pass', '$u_name', '$srnm', '$nm', '$ml') ");
		   	 
		mysqli_query($db, "INSERT INTO `Has_Account` (`username`, `deactivate`) 
		 VALUES ('$u_name', b'0')");

		$_SESSION['username'] = $u_name;
		session_write_close(); 

		header("Location: profile.php"); 
		exit();
	}
}


?>
