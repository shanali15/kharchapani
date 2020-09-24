<?php
include "conn/conn.php";


if(isset($_POST['text']) && isset($_POST['pass']))
{
    $myuseremail = $_POST['email'];

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
        $user=$row['UserName'];
        $pass=$row['Password'];
        if($myuseremail==$user && $mypassword==$pass) {
            session_start();
            $_SESSION['login_user'] = $user;
            header("Location:updates.php");
        }
        else {
            $error = "Your Login ID or Password is invalid";
            echo "<script>alert('".$error."');</script>";
        }
    }
    
    
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <link rel="stylesheet" href="styles/styles.css">
    <title>Matz Accounts</title>
</head>

<body>
    <div class="container" id="main-body" >
        <div class="loginform">
            <div class="heading">
                <h3>Sign-In</h3>
            </div>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" style="padding-top: 20px;">
                <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">Username:</label>
                    <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Username">
                </div>

                <div class="form-group col-md-12">
                    <label for="exampleInputPassword1">Password:</label>
                    <input type="password" name="pass" class="form-control" id="exampleInputPassword1" placeholder="Enter Password">
                </div>
                <div class="button1">
                    <button type="submit" name="submit">Login</button>
                </div>
            </form>
        </div>
    </div>







    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>

</html>