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
    </style>
</head>

<body>
    <?php
    //  include "navbar.php"; 
    ?>
    <?php 
        include ("sidebar/sidebar.php");
    ?>
    <div class="container" id="main-body">
        <h1 class="m-5" style="text-align: center!important;">Balance Sheet</h1>
        <div>
            <a href="" data-toggle="modal" data-target="#updatemodal" class="btn btn-outline-danger" role="button" style="margin-top: 10px;" aria-pressed="true">Out (Debit)</a>
            <a href="" data-toggle="modal" data-target="#creditmodal" class="btn btn-outline-success" role="button" style="margin-top: 10px; float: right;" aria-pressed="true">In (Credit)</a>
        </div>
        
        <div style="margin-top: 15px;">
            <table class="table table-bordered table-responsive" style="border: none; max-height:100vh; width: 100%; overflow-x: auto; overflow-y: auto;">
                <tr class="table-primary bg-primary">
                    <!-- <th style="text-align : center">StudentID</th> -->
                    <th style="text-align : center; width: 20%" colspan="2">Action</th>
                    <th style="text-align : center; width: 10%">Name</th>
                    <th style="text-align : center; width: 30%">Description</th>
                    <th style="text-align : center; width: 15%">Date</th>
                    <th style="text-align : center; width: 15%">Category</th>
                    <!-- <th style="text-align : center">Amount</th> -->
                    <th style="text-align : center; width: 5%">Debit</th>
                    <th style="text-align : center; width: 5%">Credit</th>
                </tr>

                <?php
                $sql = "SELECT * FROM balancesheet JOIN category ON balancesheet.CategoryID=category.CategoryID";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <tr>
                            <!-- <td>
                                <a class="btn btn-primary" href="updatedept.php?id="" role="button">Edit</a>
                            </td> -->
                            <td>
                                <a class="btn btn-danger del_update" id="<?php echo $row['BalanceID']; ?>" href="" role="button">Delete</a>
                            </td>
                            <td>
                                <a href="" id="<?php echo $row['BalanceID']; ?>" class="btn btn-primary edit_sheet" role="button">Edit</a>
                            </td>
                            <td>
                                <?php if (isset($row['BName'])) {
                                    print_r($row['BName']);
                                } ?>
                            </td>
                            <td>
                                <?php if (isset($row['BDescription'])) {
                                    print_r($row['BDescription']);
                                } ?>
                            </td>
                            <td>
                                <?php if (isset($row['BDate'])) {
                                    $newDate = date("d-M-Y", strtotime($row['BDate']));
                                    print_r($newDate);
                                } ?>
                            </td>
                            <td>
                                <?php if (isset($row['CName'])) {
                                    print_r($row['CName']);
                                } ?>
                            </td>
                            <!-- <td>
                        <?php
                        // if(isset($row['BAmount'])){print_r($row['BAmount']);} 
                        ?>
                    </td> -->
                            <td>
                                <?php
                                if (isset($row['BDebit']) && $row['BDebit'] == 1) {
                                    print_r($row['BAmount']);
                                } else {
                                    print_r("0");
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if (isset($row['BCredit']) && $row['BCredit'] == 1) {
                                    print_r($row['BAmount']);
                                } else {
                                    print_r("0");
                                }
                                ?>
                            </td>

                        </tr>
                <?php
                    }
                }
                ?>

            </table>
        </div>
        <div>
            <?php
            $sql1 = "SELECT SUM(BAmount) AS total FROM balancesheet WHERE BCredit=1";
            $result1 = $conn->query($sql1);
            $row1 = $result1->fetch_assoc();
            $credit = $row1['total'];
            $sql2 = "SELECT SUM(BAmount) AS total FROM balancesheet WHERE BDebit=1";
            $result2 = $conn->query($sql2);
            $row2 = $result2->fetch_assoc();
            $debit = $row2['total'];
            $total = $credit - $debit;
            echo '
                    <div class="row">
                        <div class="col-lg-4">
                            <p>
                                Credit Amount: ' . $credit . '
                            </p>
                        </div>
                        <div class="col-lg-4">
                            <p>
                                Debit Amount: ' . $debit . '
                            </p>
                        </div>
                        <div class="col-lg-4">
                            <p>
                                Remaining Amount: ' . $total . '
                            </p>
                        </div>
                    </div>
                    
                    

                    
 
                ';
            ?>
        </div>
    </div>
    <!-- model add event -->
    <div class="modal" id="updatemodal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Debit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="details">
                        <form id="update_form">
                            <div class="form-group">
                                <label class="col-form-label" for="inputDefault">Account of:</label>
                                <input type="text" name="name" class="form-control" placeholder="Name of Person" id="inputDefault" value="" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea">Please Mention Description:</label>
                                <textarea class="form-control" name="desp" id="exampleTextarea" rows="6" value="" required></textarea>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label" for="inputDefault">Amount:</label>
                                <input type="number" name="amount" class="form-control" placeholder="Enter Amount" id="inputDefault" value="">
                            </div>

                            <div class="row">
                                <input type="hidden" name="deb" value="d">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <select class="form-control" name="cat" id="cat" required>
                                            <option value="">Choose Head-Wise</option>
                                            <?php
                                            $sql = "SELECT * FROM category";
                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo '<option value="' . $row['CategoryID'] . '">' . $row['CName'] . '</option>';
                                                }
                                            }

                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="date" id="date" name="date" class="form-control mb-4" value="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="forward1" class="btn btn-primary">Add</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- model add event -->

    <!-- model add credit -->
    <div class="modal" id="creditmodal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Credit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="details">
                        <form id="credit_form">
                            <div class="form-group">
                                <label class="col-form-label" for="inputDefault">Account of:</label>
                                <input type="text" name="name" class="form-control" placeholder="Name of Person" id="inputDefault" value="" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea">Please Mention Description:</label>
                                <textarea class="form-control" name="desp" id="exampleTextarea" rows="6" value="" required></textarea>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label" for="inputDefault">Amount:</label>
                                <input type="number" name="amount" class="form-control" placeholder="Enter Amount" id="inputDefault" value="" required>
                            </div>

                            <div class="row">
                                <input type="hidden" name="deb" value="c">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <select class="form-control" name="cat" id="cat" required>
                                            <option value="">Choose Head-Wise</option>
                                            <?php
                                            $sql = "SELECT * FROM category";
                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo '<option value="' . $row['CategoryID'] . '">' . $row['CName'] . '</option>';
                                                }
                                            }

                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="date" id="date" name="date" class="form-control mb-4" value="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="forward1" class="btn btn-primary">Add</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- model add credit -->

    <!-- model edit -->
    <div class="modal" id="editmodal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="details">
                        <form id="edit_form">
                            <div class="form-group">
                                <label class="col-form-label" for="inputDefault">Account of:</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name of Person" id="inputDefault">
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea">Please Mention Description:</label>
                                <textarea class="form-control" name="desp" id="desp" rows="6"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label" for="inputDefault">Amount:</label>
                                <input type="number" name="amount" id="amount" class="form-control" placeholder="Enter Amount" id="inputDefault">
                            </div>

                            <div class="row">
                                <input type="hidden" id="bid" name="bid" value="">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <select class="form-control" name="cat" id="cat">
                                            <option>Choose Head-Wise</option>
                                            <?php
                                            $sql = "SELECT * FROM category";
                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo '<option value="' . $row['CategoryID'] . '">' . $row['CName'] . '</option>';
                                                }
                                            }

                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="date" id="date" name="date" class="form-control mb-4" value="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <select class="form-control" name="deb" id="deb">
                                            <option>Choose One Option</option>
                                            <option value="d">Debit</option>
                                            <option value="c">Credit</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="forward1" class="btn btn-primary">Add</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- model edit -->



    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
<script>
    $(document).ready(function() {
        $(".del_update").click(function(e) {
            e.preventDefault();
            var c = confirm("Sure to remove this record?");
            if (c == true) {
                var ID = $(this).attr("id");
                $.ajax({
                    url: "deleteupdate.php?ID=" + ID,
                    success: function(data) {
                        alert(data);
                        location.reload();
                    }
                });
            }
        });

        $(".edit_sheet").click(function(e) {
            e.preventDefault();
            var ID = $(this).attr("id");
            $.ajax({
                url: "editupdates.php?ID=" + ID,
                success: function(data) {
                    var exp = data.split("|");
                    $("#name").val(exp[0]);
                    $("#desp").val(exp[1]);
                    $("#amount").val(exp[2]);
                    $("#date").val(exp[3]);
                    $("#bid").val(exp[4]);
                    $('#editmodal').modal('show');
                }
            });
        });
        $('#edit_form').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'editupdates.php',
                data: new FormData(this),
                contentType: false, // The content type used when sending data to the server.  
                cache: false, // To unable request pages to be cached  
                processData: false,
                success: function(data) {
                    if (data === "Updated Successfully") {
                        alert(data);
                        $('#edit_form')[0].reset();
                        location.reload();
                    } else {
                        alert(data);

                    }
                }
            });
        });

        $('#update_form').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'addupdate.php',
                data: new FormData(this),
                contentType: false, // The content type used when sending data to the server.  
                cache: false, // To unable request pages to be cached  
                processData: false,
                success: function(data) {
                    if (data === "Uploaded Successfully") {
                        alert(data);
                        $('#update_form')[0].reset();
                        location.reload();
                    } else {
                        alert(data);

                    }
                }
            });
        });

        $('#credit_form').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'addupdate.php',
                data: new FormData(this),
                contentType: false, // The content type used when sending data to the server.  
                cache: false, // To unable request pages to be cached  
                processData: false,
                success: function(data) {
                    if (data === "Uploaded Successfully") {
                        alert(data);
                        $('#update_form')[0].reset();
                        location.reload();
                    } else {
                        alert(data);

                    }
                }
            });
        });
    });
</script>


<!-- <script>
    function validDate() {
        var today = new Date().toISOString().split('T')[0];
        var nextWeekDate = new Date(new Date().getTime() + 6 * 24 * 60 * 60 * 1000).toISOString().split('T')[0]
        //   document.getElementsByName("date")[0].setAttribute('min', today);
        document.getElementsByName("date")[0].setAttribute('max', today)
        document.getElementsByName("date1")[0].setAttribute('max', today)
        document.getElementsByName("date2")[0].setAttribute('max', today)
    }
</script> -->


</html>