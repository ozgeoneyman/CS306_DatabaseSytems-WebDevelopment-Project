<!DOCTYPE html>
<html lang="en">
<html>
<head>
	<title>PROFILE</title>
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
session_start();

$username = $_SESSION['username'];

include "config.php";

$sel = mysqli_query($db, "SELECT * 
  FROM User
  WHERE `User`.username = '".$username."'");

$row = mysqli_fetch_array($sel);

echo'<div style="padding-left:16px">
<h2>SOCIALGRAM</h2>
</div>';
echo'<div class="topnav">
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
  
  </div>';

echo"
<head>
<style>
* {
  box-sizing: border-box;
}

body {
  font-family: Arial, Helvetica, sans-serif;
}

header {
  background-color: #666;
  padding: 1px;
  text-align: center;
  font-size: 35px;
  color: white;
}

section {
  display: -webkit-flex;
  display: flex;
}

nav {
  -webkit-flex: 1;
  -ms-flex: 1;
  flex: 1;
  background: #ccc;
  padding: 50px;
}

nav ul {
  list-style-type: none;
  padding: 0;
}

article {
  -webkit-flex: 3;
  -ms-flex: 3;
  flex: 3;
  background-color: #f1f1f1;
  padding: 100px;
}

footer {
  background-color: #777;
  padding: 10px;
  text-align: center;
  color: white;
}

@media (max-width: 600px) {
  section {
    -webkit-flex-direction: column;
    flex-direction: column;
  }
}
</style>
</head>
<body>

<header>
  <h2> ".$row['name']." ".$row['surname']." </h2>
</header>

<section>
  <nav>
    <ul>
      <li><img src=" . $row['profile_picture'] . ' width="400" ' . ' height="400" ' . ">" . "</li>
    </ul>
  </nav>
  
  <article>
  <tr>
  <td> Username: ".$row['username']." </td><br><br>
  </tr>

  <tr>
  <td> Birth Date: ".$row['date_of_birth']." </td><br><br>
  </tr>

  <tr>
  <td> E-Mail: ".$row['mail']." </td><br><br>
  </tr>

  <tr>
  <td> Phone Number: ".$row['phone_number']." </td><br><br><br>
  </tr>

  <tr>
  <td> Biography: <br><br> ".$row['biography']." </td><br>
  </tr>

  </article>
</section>
<footer>
  <p>Subscribed Locations</p>
  </footer>
<br><br>


</body>
</html>";



$select2 = mysqli_query($db, "SELECT loc FROM Subscribe_Location WHERE username = '$username'");
while($row = mysqli_fetch_array($select2)) {
   echo "<tr>";
              echo "<td> " . $row['loc'] . "</td>";
                           echo "<td>"."<form action = 'unsub_locprofile.php?passLoc=".$row["loc"]."' method='POST'>
           <button>Unsubscribe Location</button>
          </form>"."</td>";
              echo "</tr>";
              echo "<br>";
}

 $sel3 = mysqli_query($db, "SELECT friends_username FROM `Friend` WHERE `username` = '".$username."' ");
 echo "<footer>
<p>Subscribed Friends:</p>
</footer>
<br><br>";
  while ($friendship = mysqli_fetch_array($sel3)) {
       
                      echo "
                      
                      <body>
                      <section>
                      <table>

                      <tr>
                      <td> ".$friendship['friends_username']." <form action = 'removeFriend.php?removeFriend=".$friendship['friends_username']."' method='POST'>
                      <button>Unsubscribe</button>
                      </form></td>
                      </tr>

                      </table>

                    </section>
                    </body>
                    "


                    ;

            

  }

echo"<footer>
  <p>Posts</p>
  </footer>";


$select = mysqli_query($db, "SELECT post_id FROM Has_Post WHERE username = '$username'");

while($postIds = mysqli_fetch_array($select)) {

        
        $select2 = mysqli_query($db, "SELECT * FROM Post WHERE post_id = ".$postIds['post_id']." ");

      while($row = mysqli_fetch_array($select2)) {

              echo "<table> "; 
              echo "<tr>";
              echo "<td>" . "<img src=" . $row['image'] . ' width="300" ' .  ' height="400" ' . ">" . "</td>";
              echo "</tr>";

              echo "<tr>";
              echo "<td>" . $row['text'] . "</td>";
              echo "</tr>";

              echo "<tr>";
              echo "<td> Location: " . $row['location'] . "</td>";
              echo "</tr>";

              echo "<td>"."<form action = 'editPostView.php?passPostId=".$row["post_id"]."' method='POST'>
              <button>Edit Post</button>
              </form>"."</td>";

              echo "<td>"."<form action = 'deletepost.php?passPostId=".$row["post_id"]."' method='POST'>
                <button>Delete Post</button>
                </form>"."</td>";

              echo "<br><br><br>";
              echo "<table> "; 
      }
}


?>

</div>

</body>
</html>