<?php
include "conn/conn.php";
session_start();
$userid = $_SESSION['user_id'];
if (!empty($_GET['ID'])) {
    $ID=$_GET['ID'];
    $sql="SELECT * FROM balancesheet WHERE BalanceID='$ID'";
    $result=$conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo $row['BName'] . "|" . $row['BDescription'] . "|" . $row['BAmount'] . "|" . $row['BDate'] . "|" . $row['BalanceID'];
    }
}

elseif(!empty($_POST['bid']) && !empty($_POST['name']) && !empty($_POST['desp']) && !empty($_POST['amount']) && !empty($_POST['cat']) && !empty($_POST['deb']) && !empty($_POST['date']))
{
    $name=addslashes($_POST['name']);
    $desp=addslashes($_POST['desp']);
    $bid=$_POST['bid'];
    $amount=$_POST['amount'];
    $cat=$_POST['cat'];
    $deb=$_POST['deb'];
    $date=$_POST['date'];
    // echo $desp;
    // date_default_timezone_set("Asia/Karachi");
    // $filedate=date("Y-m-d h-i-sa");
    if($deb == "d"){
        $sql1 = "SELECT SUM(BAmount) AS total FROM balancesheet WHERE BCredit=1";
        $result1=$conn->query($sql1);
        $row1 = $result1->fetch_assoc();
        $credit = $row1['total'];
        $sql2 = "SELECT SUM(BAmount) AS total FROM balancesheet WHERE BDebit=1";
        $result2=$conn->query($sql2);
        $row2 = $result2->fetch_assoc();
        $debit = $row2['total'];
        $total = $credit - $debit;
        if($amount <= $total){
            $sql="UPDATE balancesheet SET BName='$name',BDescription='$desp',CategoryID='$cat',BAmount='$amount',BDebit=1,BCredit=0,BDate='$date',UserId = '".$userid."' WHERE BalanceID='$bid'";
            if ($conn->query($sql) === TRUE) 
            {
                echo "Updated Successfully"; 
            } 
            else 
            {
                echo "Error Uploading Expence: " . $conn->error;
            }
        }
        else{
            echo "You only enter less than or equal to: ".$total;
        }
    }
    else{
        $sql="UPDATE balancesheet SET BName='$name',BDescription='$desp',CategoryID='$cat',BAmount='$amount',BDebit=0,BCredit=1,BDate='$date' WHERE BalanceID='$bid'";
        if ($conn->query($sql) === TRUE) 
        {
            echo "Updated Successfully"; 
        } 
        else 
        {
            echo "Error Uploading Expence: " . $conn->error;
        }
    }
}
?>