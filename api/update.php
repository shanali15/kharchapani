<?php
include("connect.php");

if($_SERVER['REQUEST_METHOD']=='POST') {
$json = @file_get_contents('php://input');
$jsonObj = json_decode($json, true);

$data = "";
$ID=$jsonObj ['ID'];
$name=$jsonObj ['name'];
$desp=$jsonObj ['desp'];
$amount=$jsonObj ['amount'];
$cat = $jsonObj ['cat'];
$deb=$jsonObj ['deb'];
$date=$jsonObj ['date'];
$UserId=$jsonObj ['UserId'];

if($deb==0){
    $cre=1;
    $debit =0;
}else{
    $cre=0;
    $debit =1;
}
$sql="UPDATE balancesheet set BName =".$name.", BDescription =".$desp." ,CategoryID =".$amount." ,BAmount =".$amount." ,BDebit = ".$debit.", BCredit = ".$cre.",BDate =".$date.",UserId=".$UserId." WHERE BalanceID =.$ID ";

// $conn->query($sql); 

if($conn->query($sql)) 
       $data = 'successful';
else
       $data = 'Error occurred while deleting entry.';
$jsonObj = new \StdClass;
$jsonObj->data = $data;
echo json_encode($jsonObj);
}

?>