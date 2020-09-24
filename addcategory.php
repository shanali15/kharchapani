<?php
include "conn/conn.php";
session_start();
if (!isset($_SESSION['login_user'])) {
    header("Location:index.php");
}
$userid = $_SESSION['user_id'];


if (isset($_POST['submit'])) {

    if (!empty($_POST['cname'])) {
        $cname=$_POST['cname'];
        $sql2="SELECT * FROM category WHERE CName='$cname'";
        $result=$conn->query($sql2);
        if ($result->num_rows > 0) {
            echo "<script> alert('Category Already Exist! Please Enter Another One') </script>";
            echo "<script>setTimeout(\"location.href = 'addcategory.php';\",100);</script>";
        }
        else{
            $sql="INSERT INTO category (CName,UserId) VALUES('$cname','$userid')";
            if ($conn->query($sql) === TRUE) 
            {
                echo "<script> alert('Category Created Successfully') </script>";
                echo "<script>setTimeout(\"location.href = 'addcategory.php';\",100);</script>";
            } 
            else 
            {
                echo "Error Adding Category: " . $conn->error;
                echo "<script>setTimeout(\"location.href = 'addcategory.php';\",100);</script>";
            }
        }
    }
    else{
        echo "<script> alert('Please Fill all the Required Feilds') </script>";
    }
}
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Matz</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="sidebar/css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="sidebar/js/popper.js"></script>
    <script src="sidebar/js/bootstrap.min.js"></script>
    <script src="sidebar/js/main.js"></script>
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        .rcorners {
            border-radius: 25px;
            background: #0d5e50;
            padding: 10px;
            width: 250px;
            height: 150px;
        }

        .tablebg {
            padding: 15px;
            border-radius: 15px;
            background-color: white;
        }
    </style>
</head>

    <body>
    <div class="wrapper d-flex align-items-stretch">
        <?php 
        include ("sidebar.php");
        ?>

        <!-- Page Content  -->
        <div class="container" id="main-body">

            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-primary">
                        <i class="fa fa-bars"></i>
                        <span class="sr-only">Toggle Menu</span>
                    </button>



                </div>
            </nav>
     
        <div class="container" id="main-body">
        <h1 class="text-center m-3">Add Category</h1>
            <form action="addcategory.php" method="post">
                <div style="margin-top: 15px;">
                    <table class="table table-hover">
                        <tr>
                            <td>Category Name:</td>
                            <td>  
                                <input type="text" name="cname" class="form-control" value="">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                            <button type="submit" name="submit" class="btn btn-primary btn-md">Add Category</button>
                            &nbsp;
                            <a href="category.php" class="btn btn-success" role="button" aria-pressed="true">Back to Category</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </form>

        </div>




        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
        </div>
        </body>

    </html>