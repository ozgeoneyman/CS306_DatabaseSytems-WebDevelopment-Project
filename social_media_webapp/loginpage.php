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

include "config.php";

if (isset($_POST['username'])) {

$username = $_POST['username'];
$password = $_POST['password'];

$_SESSION['username'] = $username;
session_write_close(); 
$query = mysqli_query($db,"SELECT * FROM User WHERE username='".$username."'");
 if (!$query)
    {
        die('Error: ' . mysqli_error($db));
    }

$query2 = mysqli_query($db, "SELECT * FROM User WHERE password='".$password."'");
 if (!$query2)
    {
        die('Error: ' . mysqli_error($db));
    }
$query3 = mysqli_query($db, "SELECT deactivate FROM `Has_Account` WHERE `Has_Account`.`username`='".$username."'");
 if (!$query3)
    {
        die('Error: ' . mysqli_error($db));
    }
if (mysqli_num_rows($query3)>0) {
   $sel2 = mysqli_query($db, "SELECT * FROM Has_Account WHERE deactivate = b'1'");
   if (mysqli_num_rows($sel2)>0) {
    echo"<br><br><br>";
   echo"Are you sure to activate your account?";
      echo'<form action = "index.php" method="POST" > <button>No</button></form>';
   echo'<form action = "activate.php" method="POST" > <button>Yes</button></form>';


  }
  else if(mysqli_num_rows($query)>0){

        if (mysqli_num_rows($query2) >0) {
              echo' <div style="padding-left:16px">
              <h2>SOCIALGRAM</h2>
              </div>';
              echo'<div class="topnav">
              <a class="active" href="homepage.php">Home</a>
              
              <a href="profile.php">Profile</a>
              
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

echo"  <br><br>
  <footer>
  <h3>Subscribed Friends</h3>
  </footer>
<br><br>
";
              include "config.php";
              $username = $_SESSION['username'];
              
              
              $sel = mysqli_query($db, "SELECT * FROM Post ORDER BY `post_id` DESC");
              
              while($row = mysqli_fetch_array($sel)) {
              
                $sel2 = mysqli_query($db, "SELECT username FROM Has_Post WHERE post_id = ".$row['post_id']." ");
                $postOwner = mysqli_fetch_assoc($sel2);
              
              
                $sel3 = mysqli_query($db, "SELECT friends_username FROM `Friend` WHERE `username` = '".$username."' ");
                while ($friendship = mysqli_fetch_array($sel3)) {
              
                      if ($friendship['friends_username'] == $postOwner['username']){
              
                          echo "<table> "; 
              
                          echo "<tr>";
                          echo "<td>" . $postOwner['username'] . ":<form action = 'friendsProfile.php?passusername=".$postOwner["username"]."' method='POST'>
                            <button>Go to Profile</button>
                            </form>" . " </td>";
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

                          echo "</tr>";
                          echo "<br><br><br><br><br>";
                          echo"<tr>"; 
                          echo "<td>"."<form action = 'like.php?passPostId=".$row["post_id"]."' method='POST'>
                         <button>Like</button>
                          </form>"."</td>";
              
                          echo "<td>"."<form action = 'dislike.php?passPostId=".$row["post_id"]."' method='POST'>
                            <button>Dislike</button>
                            </form>"."</td>";
              
              
                          echo "<td>"."<form action = 'reportPost.php?passPostId=".$row["post_id"]."' method='POST'>
                            <button>Report</button>
                            </form>"."</td>";
              
                          echo "<td>"."<form action = 'comment.php?passPostId=".$row["post_id"]."' method='POST'>
                            <textarea name='comment' placeholder="."Comment"."></textarea>" . "<button>Comment</button>"."
                            </form>"."</td>";
               echo "</tr>";
                          echo "<tr>";
                          echo "<td>" . "Comments:" . "</td>";
                          echo "</tr>";
              
                          echo "<tr>";
                          $comments = mysqli_query($db, "SELECT * FROM Has_Comment WHERE post_id = ".$row['post_id']."");
                              while($commentRow = mysqli_fetch_assoc($comments)) {
                              
                                  echo "<table> "; 
              
                                  echo "<tr>";
                                  echo "<td>" . $commentRow['username'] . ": </td>";
                                  echo "<td>" . $commentRow['comment_text'] . " </td>";
                                  echo "</tr>"; 
                                  echo "</table>";
                              }
                        
                          echo "</tr>";
                          echo "</table>";
                      }
                  }
            } 
            echo"  <br><br>
  <footer>
  <h3>Subscribed Locations</h3>
  </footer>
<br><br>
";


$select = mysqli_query($db, "SELECT loc FROM Subscribe_Location WHERE username = '$username'");
 if (mysqli_num_rows($select)>0) {
                     

while($postIds = mysqli_fetch_array($select)) {

       
        $select2 = mysqli_query($db, "SELECT * FROM `Post` WHERE `Post`.`location` = '".$postIds['loc']."'");
 if (mysqli_num_rows($select2)>0) {
 
      while($row = mysqli_fetch_array($select2)) {
  $sel2 = mysqli_query($db, "SELECT username FROM `Has_Post` WHERE `Has_Post`.`post_id` = '".$row['post_id']."'");
  $postOwner = mysqli_fetch_assoc($sel2);
              echo "<table> "; 
                    echo"<br>";  
      echo"<tr>";
      echo "<td>" . $row['location'] . ": </td>";
      echo"</tr>";           echo "<table> "; 

            echo "<tr>";
            echo "<td>" . $postOwner['username'] . ":<form action = 'friendsProfile.php?passusername=".$postOwner["username"]."' method='POST'>
              <button>Go to Profile</button>
              </form>" . " </td>";
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


            echo "<td>"."<form action = 'reportPost.php?passPostId=".$row["post_id"]."' method='POST'>
              <button>Report</button>
              </form>"."</td>";

            echo "<td>"."<form action = 'comment.php?passPostId=".$row["post_id"]."' method='POST'>
              <textarea name='comment' placeholder="."Comment"."></textarea>" . "<button>Comment</button>"."
              </form>"."</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>" . "Comments:" . "</td>";
            echo "</tr>";

            echo "<tr>";
            $comments = mysqli_query($db, "SELECT * FROM Has_Comment WHERE post_id = ".$row['post_id']."");
                while($commentRow = mysqli_fetch_assoc($comments)) {
                
                    echo "<table> "; 

                    echo "<tr>";
                    echo "<td>" . $commentRow['username'] . ": </td>";
                    echo "<td>" . $commentRow['comment_text'] . " </td>";
                    echo "</tr>"; 
                    echo "</table>";
                }
          echo "</tr>";
              echo "<table> "; 
      }
    }
}
}

        }
      
      

        else {
            echo'<br><br><br>
            <br>
            <br>
            <br>';
            echo "Your username or password is incorrect! Please try again. ";
            echo '<form action = "index.php" >
            <button>TRY AGAIN</button>
            </form>';
        }
  
}


  else {

      echo'<br>
      <br>
      <br>
      <br>
      <br>
      <br>';
        echo "Your username or password is incorrect! Please try again. ";
      echo '<form action = "index.php" >
      <button>TRY AGAIN</button>
      </form>';
  }


}
else if(mysqli_num_rows($query)>0){

      	if (mysqli_num_rows($query2) >0) {
            	echo'	<div style="padding-left:16px">
              <h2>SOCIALGRAM</h2>
              </div>';
              echo'<div class="topnav">
               <a class="active" href="homepage.php">Home</a>
              
              <a href="profile.php">Profile</a>
              
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

echo"  <br><br>
  <footer>
  <h3>Subscribed Friends</h3>
  </footer>
<br><br>
";
              include "config.php";
              $username = $_SESSION['username'];
              
              
              $sel = mysqli_query($db, "SELECT * FROM Post ORDER BY `post_id` DESC");
              
              while($row = mysqli_fetch_array($sel)) {
              
                $sel2 = mysqli_query($db, "SELECT username FROM Has_Post WHERE post_id = ".$row['post_id']." ");
                $postOwner = mysqli_fetch_assoc($sel2);
              
              
                $sel3 = mysqli_query($db, "SELECT friends_username FROM `Friend` WHERE `username` = '".$username."' ");
                while ($friendship = mysqli_fetch_array($sel3)) {
              
                      if ($friendship['friends_username'] == $postOwner['username']){
              
                          echo "<table> "; 
              
                          echo "<tr>";
                          echo "<td>" . $postOwner['username'] . ":<form action = 'friendsProfile.php?passusername=".$postOwner["username"]."' method='POST'>
                            <button>Go to Profile</button>
                            </form>" . " </td>";
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
              
              
                          echo "<td>"."<form action = 'report.php?passPostId=".$row["post_id"]."' method='POST'>
                            <button>Report</button>
                            </form>"."</td>";
              
                          echo "<td>"."<form action = 'comment.php?passPostId=".$row["post_id"]."' method='POST'>
                            <textarea name='comment' placeholder="."Comment"."></textarea>" . "<button>Comment</button>"."
                            </form>"."</td>";
               echo "</tr>";
                          echo "<tr>";
                          echo "<td>" . "Comments:" . "</td>";
                          echo "</tr>";
              
                          echo "<tr>";
                          $comments = mysqli_query($db, "SELECT * FROM Has_Comment WHERE post_id = ".$row['post_id']."");
                              while($commentRow = mysqli_fetch_assoc($comments)) {
                              
                                  echo "<table> "; 
              
                                  echo "<tr>";
                                  echo "<td>" . $commentRow['username'] . ": </td>";
                                  echo "<td>" . $commentRow['comment_text'] . " </td>";
                                  echo "</tr>"; 
                                  echo "</table>";
                              }
                        
                          echo "</tr>";
                          echo "</table>";
                      }
                  }
            } 
            echo"  <br><br>
  <footer>
  <h3>Subscribed Locations</h3>
  </footer>
<br><br>
";


$select = mysqli_query($db, "SELECT loc FROM Subscribe_Location WHERE username = '$username'");
 if (mysqli_num_rows($select)>0) {
                     

while($postIds = mysqli_fetch_array($select)) {

       
        $select2 = mysqli_query($db, "SELECT * FROM `Post` WHERE `Post`.`location` = '".$postIds['loc']."'");
 if (mysqli_num_rows($select2)>0) {
 
      while($row = mysqli_fetch_array($select2)) {
  $sel2 = mysqli_query($db, "SELECT username FROM `Has_Post` WHERE `Has_Post`.`post_id` = '".$row['post_id']."'");
  $postOwner = mysqli_fetch_assoc($sel2);
              echo "<table> "; 
                    echo"<br>";  
      echo"<tr>";
      echo "<td>" . $row['location'] . ": </td>";
      echo"</tr>";           echo "<table> "; 

            echo "<tr>";
            echo "<td>" . $postOwner['username'] . ":<form action = 'friendsProfile.php?passusername=".$postOwner["username"]."' method='POST'>
              <button>Go to Profile</button>
              </form>" . " </td>";
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


            echo "<td>"."<form action = 'reportPost.php?passPostId=".$row["post_id"]."' method='POST'>
              <button>Report</button>
              </form>"."</td>";

            echo "<td>"."<form action = 'comment.php?passPostId=".$row["post_id"]."' method='POST'>
              <textarea name='comment' placeholder="."Comment"."></textarea>" . "<button>Comment</button>"."
              </form>"."</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>" . "Comments:" . "</td>";
            echo "</tr>";

            echo "<tr>";
            $comments = mysqli_query($db, "SELECT * FROM Has_Comment WHERE post_id = ".$row['post_id']."");
                while($commentRow = mysqli_fetch_assoc($comments)) {
                
                    echo "<table> "; 

                    echo "<tr>";
                    echo "<td>" . $commentRow['username'] . ": </td>";
                    echo "<td>" . $commentRow['comment_text'] . " </td>";
                    echo "</tr>"; 
                    echo "</table>";
                }
          echo "</tr>";
              echo "<table> "; 
      }
    }
}
}

        }
      

      	else {
          	echo'<br><br><br>
            <br>
            <br>
            <br>';
          	echo "Your username or password is incorrect! Please try again. ";
            echo '<form action = "index.php" >
            <button>TRY AGAIN</button>
            </form>';
      	}
  
}


  else {

      echo'<br>
      <br>
      <br>
      <br>
      <br>
      <br>';
      	echo "Your username or password is incorrect! Please try again. ";
      echo '<form action = "index.php" >
      <button>TRY AGAIN</button>
      </form>';
  }

}

?>
</div>
</body>
</html>