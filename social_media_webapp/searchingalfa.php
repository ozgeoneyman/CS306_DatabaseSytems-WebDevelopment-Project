
<!DOCTYPE html>
<html lang="en">
<html>
<head>
	<title>SEARCH</title>
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
  <a href="profile.php">Profile</a>
  <a href="messages.php">Messages</a>
  <a href="settings.php">My Account</a>
  <a href="index.php">Exit</a>
 <form action = "searchingalfa.php" method="POST" >
  <textarea name= "search" placeholder="Search.."></textarea>
  <button>Search</button></form>
 
  <form action = "add.php" method="POST" >
  <br>
 <button>Add New Post</button>
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

<?php

include "config.php";
if (isset($_POST['search'])) {

$search = $_POST['search'];
$sel = mysqli_query($db, "SELECT * FROM `Post` WHERE `Post`.`location` = '".$search ."'");
$sel3 = mysqli_query($db, "SELECT * FROM `User` WHERE `User`.`username` = '".$search ."'");

if (mysqli_num_rows($sel)>0) {
  
while($row = mysqli_fetch_array($sel)) {

  $sel2 = mysqli_query($db, "SELECT username FROM Has_Post WHERE post_id = ".$row['post_id']." ");
  $postOwner = mysqli_fetch_assoc($sel2);

  echo "<table> "; 

  echo "<tr>";
  echo "<td>" . $postOwner['username'] . ": </td>";
  echo "</tr>";

  echo "<tr>";
  echo "<td>" . "<img src=" . $row['image'] . ' width="300" ' .  ' height="400" ' . ">" . "</td>";
  echo "</tr>";

  echo "<tr>";
  echo "<td>" . $row['text'] . "</td>";
  echo "</tr>";

   echo "<tr>";
            echo "<td> Location: " . $row['location'] . "</td>";
             echo "<td>"."<form action = 'subs_loc.php?passLoc=".$row["location"]."' method='POST'>
           <button>Subsribe Location</button>
          </form>"."</td>";

                                
             echo "<td>"."<form action = 'unsubs_loc.php?passLoc=".$row["location"]."' method='POST'>
           <button>Unsubscribe Location</button>
          </form>"."</td>";
              

  echo "<br><br><br><br><br>";
    echo "<tr>";
  echo "<td>"."<form action = 'like.php?passPostId=".$row["post_id"]."' method='POST'>
 <button>Like</button>
</form>"."</td>";

  echo "<td>"."<form action = 'dislike.php?passPostId=".$row["post_id"]."' method='POST'>
    <button>Dislike</button>
    </form>"."</td>";


echo "<td>" . "<button>Report</button>" . "</td>";

echo "<td>"."<form action = 'comment.php?passPostId=".$row["post_id"]."' method='POST'>
    <textarea name='comment' placeholder="."Comment"."></textarea>" . "<button>Comment</button>"."
    </form>"."</td>";
  echo "</tr>";
 echo "<tr>";
echo "<td>" . "Comments:" . "</td>";
 echo "</tr>";
$comments = mysqli_query($db, "SELECT * FROM Has_Comment WHERE post_id = ".$row['post_id']."");
    while($commentRow = mysqli_fetch_assoc($comments)) {
      
        echo "<table> "; 

        echo "<tr>";
        echo "<td>" . $commentRow['username'] . ": </td>";
        echo "<td>" . $commentRow['comment_text'] . " </td>";
        echo "</tr>"; 
        echo "</table>";
    }
}

echo "<td>" . "<button>Report</button>" . "</td>";
echo "</tr>";
echo "</table>";

}
else if (mysqli_num_rows($sel3)>0) {

  $sel4 = mysqli_query($db, "SELECT `post_id` FROM `Has_Post` WHERE `Has_Post`.`username` = '".$search ."'");

if (mysqli_num_rows($sel4)>0) {
 
  while($row = mysqli_fetch_array($sel4)) {

  $sel2 = mysqli_query($db, "SELECT username FROM Has_Post WHERE post_id = ".$row['post_id']." ");
  $postOwner = mysqli_fetch_assoc($sel2);

  echo "<table> "; 

  echo "<tr>";
  echo "<td>" . $postOwner['username'] . ": </td>";
  echo "</tr>";

  echo "<tr>";
  echo "<td>" . "<img src=" . $row['image'] . ' width="300" ' .  ' height="400" ' . ">" . "</td>";
  echo "</tr>";

  echo "<tr>";
  echo "<td>" . $row['text'] . "</td>";
  echo "</tr>";

  echo "<tr>";
  echo "<td> Location: " . $row['location'] . "</td>";
  echo "</tr>";

  echo "<br><br><br><br><br>";
  
  echo "<td>"."<form action = 'like.php?passPostId=".$row["post_id"]."' method='POST'>
 <button>Like</button>
</form>"."</td>";

  echo "<td>"."<form action = 'dislike.php?passPostId=".$row["post_id"]."' method='POST'>
    <button>Dislike</button>
    </form>"."</td>";


echo "<td>" . "<button>Report</button>" . "</td>";

echo "<td>"."<form action = 'comment.php?passPostId=".$row["post_id"]."' method='POST'>
    <textarea name='comment' placeholder="."Comment"."></textarea>" . "<button>Comment</button>"."
    </form>"."</td>";

 echo "<tr>";
echo "<td>" . "Comments:" . "</td>";
 echo "</tr>";
$comments = mysqli_query($db, "SELECT * FROM Has_Comment WHERE post_id = ".$row['post_id']."");
    while($commentRow = mysqli_fetch_assoc($comments)) {
      
        echo "<table> "; 

        echo "<tr>";
        echo "<td>" . $commentRow['username'] . ": </td>";
        echo "<td>" . $commentRow['comment_text'] . " </td>";
        echo "</tr>"; 
        echo "</table>";
    }
}

echo "<td>" . "<button>Report</button>" . "</td>";
echo "</tr>";
echo "</table>";

}

else{
  echo'<br><br><br><br>User does not have any post!';
}
}
else{
echo'<br><br><br><br>Could not find in database!';
}

}


?>
</div>
</body>
</html>
