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
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <title>University of Karachi</title>
</head>

<body>
    <?php include "navbar.php"; ?>
    <div class="container" id="main-body">
        <h1 class="m-5" style="text-align: center!important;">Events</h1>
        <div>
            <a href="" data-toggle="modal" data-target="#eventmodal" class="btn btn-outline-dark" role="button" style="margin-top: 10px;"
                aria-pressed="true">Add Events</a>
        </div>

        <div style="margin-top: 15px;">
            <table class="table table-bordered table-responsive" style="border: none; max-height:100vh;width:82vw; overflow-x: auto; overflow-y: auto;">
                <tr>
                    <!-- <th style="text-align : center">StudentID</th> -->
                    <th style="text-align : center" colspan="1">Action</th>
                    <th style="text-align : center">Event Name</th>
                    <th style="text-align : center">Description</th>
                    <th style="text-align : center">Image</th>
                    <th style="text-align : center">Date</th>
                </tr>

                <?php
                        $sql = "SELECT * FROM events";
                        $result=$conn->query($sql);
                        if ($result->num_rows > 0) {
                        // output data of each row
                            while($row = $result->fetch_assoc()) {
                                 ?>
                <tr>
                    <!-- <td>
                                <a class="btn btn-primary" href="updatedept.php?id=" role="button">Edit</a>
                            </td> -->
                    <td>
                        <a class="btn btn-danger del_event" id="<?php echo $row['EventID']; ?>" href="" role="button">Delete</a>
                    </td>
                    <td>
                        <?php if(isset($row['Name'])){print_r($row['Name']);} ?>
                    </td>
                    <td>
                        <?php if(isset($row['Desp'])){ print_r($row['Desp']);} ?>
                    </td>
                    <td>
                        <?php if(isset($row['Image'])){ print_r($row['Image']);} ?>
                    </td>
                    <td>
                        <?php if(isset($row['Date'])){ print_r($row['Date']);} ?>
                    </td>
                </tr>
                <?php
                            }
                        }
                        ?>

            </table>
        </div>
    </div>
    <!-- model add event -->
    <div class="modal" id="eventmodal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="details">
                        <form id="event_form" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-form-label" for="inputDefault">Event Name:</label>
                                <input type="text" name="eventname" class="form-control" placeholder="Enter Event Name"
                                    id="inputDefault">
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea">Please Mention Event Description:</label>
                                <textarea class="form-control" name="desp" id="exampleTextarea" rows="8"></textarea>
                            </div>
                            <div class="form-group mt-2">
                                <label for="exampleFormControlFile1">Choose File to Upload (Optional) <small>(Not more
                                        than 5MB)</small></label>
                                <input type="file" accept=".jpg,.png,.jpeg" name="file" class="form-control-file" id="exampleFormControlFile1">
                                <small>Allowed Formats (.jpg, .jpeg, .png)</small>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="forward1" class="btn btn-primary">Add Event</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- model add event -->



    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>

<script>
    $(document).ready(function () {
        $(".del_event").click(function(e){
            e.preventDefault();
            var c = confirm("Sure to remove event?");
            if(c == true){
                var ID = $(this).attr("id");
                $.ajax({  
                    url:"deleteevent.php?ID="+ID, 
                    success:function(data){
                       alert(data);
                       location.reload();
                    }  
                });
            }
        });

        $('#event_form').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'addevent.php',
                data: new FormData(this),
                contentType: false,          // The content type used when sending data to the server.  
                cache: false,                // To unable request pages to be cached  
                processData: false,
                success: function (data) {
                    if (data === "Please fill out all the feilds") {
                        alert(data);
                    }
                    else {
                        alert(data);
                        $('#event_form')[0].reset();
                        location.reload();
                    }
                }
            });
        });
    });
</script>

</html>