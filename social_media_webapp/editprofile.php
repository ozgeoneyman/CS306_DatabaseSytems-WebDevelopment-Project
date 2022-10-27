<!DOCTYPE html>
<html lang="en">
<html>
<head>
	<title>EDIT PROFILE</title>
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

<div style="padding-left:16px">
  <h2>SOCIALGRAM</h2>
</div>
<div class="topnav">
  <a href="homepage.php">Home</a>
  
  <a class="active" href="profile.php">Profile</a>
  
  <a href="messages.php">Messages</a>
  
  <a href="settings.php">My Account</a>
  
  <a href="index.php">Exit</a>

  <form action = "searchingLocation.php" method="POST" >
  <textarea name= "searchLocation" placeholder="Search Location.."></textarea>
  <button>Search Location</button></form>

  <form action = "searchingUser.php" method="POST" >
  <textarea name= "searchUser" placeholder="Search Username.."></textarea>
  <button>Search Username</button></form>

  <form action = "add.php" method="POST" >
  <br>
  <button>Add New Post</button>
  </form>

  <form action = "editprofile.php" method="POST" >
  <br>
  <button>Edit Profile </button>
  </form>
  


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: black;
}

* {
  box-sizing: border-box;
}

/* Add padding to containers */
.container {
  padding: 16px;
  background-color: white;
}

/* Full-width input fields */
input[type=text], input[type=text] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=text]:focus {
  background-color: #ddd;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the share button */
.sharebtn {
  background-color: #ffb2b2;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.sharebtn:hover {
  opacity: 1;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
  background-color: #f1f1f1;
  text-align: center;
}
</style>
</head>
<body>



</body>
</html>
</div>


<form action= "editprofile_password.php" method="POST" >
  <div class="container">
    <h1>Edit</h1>
    <p>Edit your profile.</p>
    <hr>


 <br>
   <b>Change your password</b>
    <input type="password" placeholder="Enter new password" name="password" > 
    <button> submit </button>
    <br>
    <br>

  </div>
 </form>
 <form action= "editprofile_username.php" method="POST" >
  <div class="container">
   <b>Change your username</b>    
 
   <input type="u_name" placeholder="Enter new username" name="u_name">
     <button> submit </button>
       </div>
</form>
<form action= "editprofile_bio.php" method="POST" >
  <div class="container">
   <b>Change your bio</b>    
 
   <input type="bio" placeholder="Enter new biography" name="bio">
     <button> submit </button>
       </div>
</form>
<form action= "editprofile_image.php" method="POST" >
  <div class="container">
    <hr>

      <label for="img">Choose a new profile picture:</label>
  <input type="file" id="img" name="image" accept="image/*">
  <input type="submit">


 <br>

  </div>
</form>

</form>
</div>
</body>
</html>
