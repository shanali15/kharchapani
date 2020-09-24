<?php
include("connect.php");

if($_SERVER['REQUEST_METHOD']=='POST') {
    $json = @file_get_contents('php://input');
    $jsonObj = json_decode($json, true);
    $username=$jsonObj['username'];
    $password=$jsonObj['pass'];
    $email=$jsonObj['email'];
    $sqlCheck = 'SELECT * FROM users WHERE UserName = "'.$username.'"';
    $result = mysqli_query($conn, $sqlCheck);
    if(mysqli_num_rows($result) <= 0) {
        
        $sql ="INSERT INTO `users` (`UserName`,`Password`,`email`) VALUES ('".$username."','".$password."','".$email."')";
        $_result = mysqli_query($conn,$sql);
        $data = 'registered succesfully';


    }else{
        $data = "please select a different username";
    }
$jsonObj = new \StdClass;
$jsonObj->data = $data;
echo json_encode($jsonObj);
}


?>