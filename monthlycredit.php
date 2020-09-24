<?php
include "conn/conn.php";
session_start();
$userid = $_SESSION['user_id'];
$sql1 = 'SELECT SUM(BAmount) AS total FROM balancesheet WHERE BCredit=1 AND UserId="'.$userid.'" AND BDate LIKE "'.$_POST['mydate'].'%"';
                    $result1 = $conn->query($sql1);
                    $row1 = $result1->fetch_assoc();
                    $credit = $row1['total'];
                    $sql2 = 'SELECT SUM(BAmount) AS total FROM balancesheet WHERE BDebit=1 AND UserId="'.$userid.'" AND BDate LIKE "'.$_POST['mydate'].'%"';
                    $result2 = $conn->query($sql2);
                    $row2 = $result2->fetch_assoc();
                    $debit = $row2['total'];
                    $total = $credit - $debit;
                    if ($credit == null ){
                        $credit = 0;
                    }
                    if ($debit == null ){
                        $debit = 0;
                    }
                    echo '  
                    <div class="col-md-3"> <div class="rcorners" style="margin-top: 10px; "><img src="images1/kharcha-09.png" alt="home" width="70px" height="70px"><span style="font-size:100%; color:white;">  Credit Amount: <br>  <span id="totalcredit" style="font-size:180%;  color:white;">RS  ' . $credit . '</span></span></div></div>
                    <div class="col-md-1"></div>
                    <div class="col-md-3"> <div class="rcorners" style="margin-top: 10px; "><img src="images1/kharcha-09.png" alt="home" width="70px" height="70px"><span style="font-size:100%; color:white;">Debit Amount: <br><span style="font-size:180%; color:white;"> RS  ' . $debit . '</span></span></div></div>
                    <div class="col-md-1"></div>
                    <div class="col-md-3"> <div class="rcorners" style="margin-top: 10px; "><img src="images1/kharcha-09.png" alt="home" width="70px" height="70px"><span style="font-size:100%; color:white;">Remaining Amount: <span style="font-size:180%; color:white;"><br>RS   '   . $total . '</span></span></div></div>
                    
                        ';
?>