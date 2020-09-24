<?php 
include "conn/conn.php";
$key = $_POST['key'];
$password = $_POST['pass'];

$sqlCheck = 'SELECT * FROM users WHERE resetkey = "'.$key.'"';
$result = mysqli_query($conn, $sqlCheck);
if(mysqli_num_rows($result) > 0) {
    $sql ="UPDATE users SET `Password`='".$password."',`resetkey`=null WHERE resetkey='".$key."' ";
    // echo $sql;
    $updatedpassword = mysqli_query($conn, $sql);
    echo '<script>alert("Password Reset Successful");</script>';
    echo '<script>window.location = "index.php";</script>';

    
}else{
    echo '<script>alert("Invalid Key");</script>';
    echo '<script>window.location = "newpassword.php";</script>';
}

?>