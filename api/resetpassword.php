<?php
include("connect.php");

if($_SERVER['REQUEST_METHOD']=='POST') {
    $json = @file_get_contents('php://input');
    $jsonObj = json_decode($json, true);
    $key=$jsonObj['key'];
    $password=$jsonObj['pass'];
    $sqlCheck = 'SELECT * FROM users WHERE resetkey = "'.$key.'"';
    $result = mysqli_query($conn, $sqlCheck);
    if(mysqli_num_rows($result) > 0) {
        $sql ="UPDATE users SET `Password`='".$password."',`resetkey`=null WHERE resetkey='".$key."' ";
        $result = mysqli_query($conn, $sql);
        // echo $sql;
        $data = "password reset successfull";
    }else{
        $data = "Please enter Valid Key";
    }
    $jsonObj = new \StdClass;
    $jsonObj->data = $data;
    echo json_encode($jsonObj);
    }
    
    
    ?>