
<!DOCTYPE html>
<html>
<head>
	<title>SIGN UP</title>
		<style>
		body {
  background-image: url('wp.jpeg');
  background-repeat: no-repeat;
  background-attachment: fixed; 
  background-size: cover;
}
</style>
</head>
<body>
<div align="center">
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<b> Create Your Account </b>
<br>
<br>
<br>
<form method="POST" >
  Enter your name: <input type = "text" name= "name" ><br>
  Enter your surname: <input type = "text" name= "surname" ><br>
	Enter your telephone number: <input type = "text" name= "phone_number" ><br>
	Date of Birth: <input type = "text" name= "date_of_birth" ><br>
	
	Enter an unique username: <input type = "text" name= "username" 
	required><br>
  Enter your password: <input type = "text" name= "password" required><br>
	Enter an unique email address: <input type = "text" name= "mail" required><br>

  Write about yourself for your biography: <textarea name= "biography" ></textarea><br>
  <label for="img">Select a profile picture: </label>
  <input type="file" id="profile_picture" name="profile_picture" accept="image/*" required><br>
  <input type="submit">

	<br>
<br>
</form>
<?php
include "config.php";

if (isset($_POST['phone_number'])) {


$phone_number = $_POST['phone_number'];
$date_of_birth = $_POST['date_of_birth'];
$profile_picture = $_POST['profile_picture'];
$biography = $_POST['biography'];
$password = $_POST['password'];
$username = $_POST['username'];
$surname = $_POST['surname'];
$mail = $_POST['mail'];
$name = $_POST['name'];




$query = mysqli_query($db,"SELECT * FROM User WHERE username='".$username."'");
 if (!$query)
    {
        die('Error: ' . mysqli_error($db));
    }

$query2 = mysqli_query($db, "SELECT * FROM User WHERE mail='".$mail."'");
 if (!$query2)
    {
        die('Error: ' . mysqli_error($db));
    }

if(mysqli_num_rows($query) > 0){


        echo " <script type='text/javascript'>
        alert('Username already exists! Try another.');
        history.go(-1);
        </script>";

}
elseif (mysqli_num_rows($query2) > 0) {
	 echo " <script type='text/javascript'>
        alert('E-mail already exists! Try another.');
        history.go(-1);
        </script>";
}
else{

   $sql_statement = "INSERT INTO `User` (`phone_number`, `date_of_birth`, `profile_picture`, `biography`, `password`, `username`, `surname`, `name`, `mail`) 
   	   VALUES ('$phone_number', '$date_of_birth', '$profile_picture', '$biography', '$password', '$username', '$surname', '$name', '$mail') ";
   	 mysqli_query($db, $sql_statement);
   	 $sql_statement2 = "INSERT INTO `Has_Account` (`username`, `deactivate`) 
 VALUES ('$username', b'0')";
 mysqli_query($db, $sql_statement2);
   echo"Success! Now, please go previous page to login!";
   echo'<form action = "index.php" method="POST" >
 <button>Login</button>
</form>';

}
}
?>
</form>
</div>
</body>
</html>

