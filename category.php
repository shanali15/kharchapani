<?php
include "conn/conn.php";
session_start();
if (!isset($_SESSION['login_user'])) {
    header("Location:index.php");
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
    <style>
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
   <script src="sidebar/js/popper.js"></script>
<script src="sidebar/js/bootstrap.min.js"></script>
<script src="sidebar/js/main.js"></script>
 
</head>

<body>

    <div class="wrapper d-flex align-items-stretch">
        <?php
        include("sidebar.php");
        ?>
        <div class="container" id="main-body">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-primary">
                        <i class="fa fa-bars"></i>
                        <span class="sr-only">Toggle Menu</span>
                    </button>



                </div>
            </nav>
            <h1 class="text-center m-3">Categories</h1>
            <div>
                <a href="addcategory.php" class="btn btn-outline-primary mb-3" role="button" style="margin-top: 10px;" aria-pressed="true">Add Category</a>
            </div>

            <div style="max-height:100vh;width:82vw; overflow-x: auto; overflow-y: auto;" id="task_table">
                <div class="tablebg">
                    <table class="table table-bordered table-responsive" style="border: none; max-height:100vh; width: 100%; overflow-x: auto; overflow-y: auto; border-radius:20px;">
                        <tr class="bg-dark"  style="color:white;">
                            <th style="text-align : center">Action</th>
                            <!-- <th style="text-align : center">Task ID</th> -->
                            <th style="text-align : center">Category</th>
                        </tr>

                        <?php
                        $userid = $_SESSION['user_id'];
                        $sql = "SELECT * FROM category WHERE UserId = '".$userid."' ";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <tr>
                                    <td>
                                        <a class="btn btn-danger" href="deletecategory.php?id=<?php echo $row['CategoryID']; ?>" role="button">Delete</a>
                                    </td>
                                    <td>
                                        <?php if (isset($row['CName'])) {
                                            print_r($row['CName']);
                                        } ?>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>

                    </table>
                </div>

            </div>
        </div>






        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    </div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="sidebar/js/popper.js"></script>
<script src="sidebar/js/bootstrap.min.js"></script>
<script src="sidebar/js/main.js"></script>

</html>