<?php
include "conn/conn.php";
session_start();
if (!isset($_SESSION['login_user'])) {
    header("Location:index.php");
}
// if(isset($_SESSION['login_user'])){
//     if((time() - $_SESSION['timestamp']) > 900) // 900 = 15 * 60  
//     {  
//         header("location: ../logout.php");  
//     }  
//     else  
//     {  
//         $_SESSION['timestamp'] = time();  
//     }  
// }
// if ($_SESSION['desg'] != "admin") {
//     header("Location:../logout.php");
// }

if (isset($_POST['submit'])) {
    $id=$_POST['id'];
    $sql="DELETE FROM category WHERE CategoryID='$id'";
    if ($conn->query($sql) === TRUE)
    {
        echo "<script> alert('Category Deleted Successfully') </script>";
        echo "<script>setTimeout(\"location.href = 'category.php';\",100);</script>";
    }
    else {
        echo "<script>alert('Error Deleting Category: ".$conn->error."');</script>";
        echo "<script>setTimeout(\"location.href = 'category.php';\",100);</script>";
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
            <link rel="stylesheet" href="../bs.css">
        <title>Matz</title>
    </head>

    <body>
        <?php include "navbar.php"; ?>
        <div class="container" id="main-body">
        <h1 class="text-center m-3">Delete Category</h1>
        <div class="alert alert-danger">
            <strong>Sure to Remove the this Category?</strong>
        </div>
            <?php
            if (isset($_GET['id'])) {
                $id=$_GET['id'];
                    ?>
                    <form action="deletecategory.php" method="post">
                        <input type="hidden" name="id" value="<?php print_r($id) ?>">
                            <div style="margin-top: 15px;">
                                <table class="table table-bordered">
                                     <tr>
                                        <td colspan="9">
                                        <button type="submit" name="submit" class="btn btn-danger btn-md">Delete Category</button>
                                        &nbsp;
                                        <a href="category.php" class="btn btn-success" role="button" aria-pressed="true">Back to Category</a>
                                        </td>
                                        </tr>
                                    </tr>
                                    
                                </table>
                            </div>
                            <?php
                            }
                            ?>

        </div>




        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    </body>

    </html>