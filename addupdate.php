<?php
include "conn/conn.php";

if(!empty($_POST['name']) && !empty($_POST['desp']) && !empty($_POST['amount']) && !empty($_POST['cat']) && !empty($_POST['deb']) && !empty($_POST['date']))
{
    session_start();
    $userid = $_SESSION['user_id'];
    $name=addslashes($_POST['name']);
    $desp=addslashes($_POST['desp']);
    $amount=$_POST['amount'];
    $cat=$_POST['cat'];
    $deb=$_POST['deb'];
    $date=$_POST['date'];
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
        
            $sql="INSERT INTO balancesheet (UserId,BName,BDescription,CategoryID,BAmount,BDebit,BCredit,BDate) VALUES('$userid','$name','$desp','$cat','$amount',1,0,'$date')";
            if ($conn->query($sql) === TRUE) 
            {
                echo "Uploaded Successfully"; 
            } 
            else 
            {
                echo "Error Uploading Expence: " . $conn->error;
            }
        
     
    }
    else{
        $sql="INSERT INTO balancesheet (UserId,BName,BDescription,CategoryID,BAmount,BDebit,BCredit,BDate) VALUES('$userid','$name','$desp','$cat','$amount',0,1,'$date')";
        if ($conn->query($sql) === TRUE) 
        {
            echo "Uploaded Successfully"; 
        } 
        else 
        {
            echo "Error Uploading Expence: " . $conn->error;
        }
    }
}
?>