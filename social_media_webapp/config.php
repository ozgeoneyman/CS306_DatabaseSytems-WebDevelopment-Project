<?php
$db = mysqli_connect('localhost','root','','social_media');

if ($db->connect_errno>0) {
	die('Unable to connect to the database[' . $db->connect_error . ']');
}
?>