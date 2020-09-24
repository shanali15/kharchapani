<?php
include "conn/conn.php";
$username = $_POST['text'];
$password = $_POST['pass'];
$email = $_POST['email'];

$sqlCheck = 'SELECT * FROM users WHERE UserName = "'.$username.'"';
$result = mysqli_query($conn, $sqlCheck);
if(mysqli_num_rows($result) <= 0) {
	$sql ="INSERT INTO `users` (`UserName`,`Password`,`email`) VALUES ('".$username."','".$password."','".$email."')";
	$_result = mysqli_query($conn,$sql);
	header('location:index.php');
} else {
	echo '<script>alert("Username already exists.");window.open("signup.php", "_self");</script>';
}






//Query to check if username is available

?>

