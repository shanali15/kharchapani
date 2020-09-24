
<?php
include "conn/conn.php";


if(isset($_POST['text']) && isset($_POST['pass']))
{
    $myuseremail = $_POST['text'];

    $mypassword = $_POST['pass'];
    // error_log($myuseremail." ".$mypassword);

    $sql = "SELECT * FROM users WHERE UserName = ? AND Password = ?";

    $stmt=mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "Error: <br>" . $conn->error;
    }
    else{
        mysqli_stmt_bind_param($stmt,"ss",$myuseremail,$mypassword);
        mysqli_stmt_execute($stmt);
        $result=mysqli_stmt_get_result($stmt);
        $row = $result->fetch_assoc();
		$userid = $row['UserID'];
		$user=$row['UserName'];
        $pass=$row['Password'];
        if($myuseremail==$user && $mypassword==$pass) {
            // session_start();
			$_SESSION['login_user'] = $user;
			$_SESSION['user_id'] = $userid;
            header("Location:monthly.php");
        }
        else {
            $error = "Your Login ID or Password is invalid";
            echo "<script>alert('".$error."');</script>";
        }
    }
    
    
}



?>