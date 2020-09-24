<?php
include("connect.php");

if($_SERVER['REQUEST_METHOD']=='POST') {
$json = @file_get_contents('php://input');
$jsonObj = json_decode($json, true);

$name=$jsonObj ['name'];
$desp=$jsonObj ['desp'];
$amount=$jsonObj ['amount'];
$cat = $jsonObj ['cat'];
$date=$jsonObj ['date'];
$UserId=$jsonObj ['UserId'];
$data = '';
$sql="INSERT INTO balancesheet (BName,BDescription,CategoryID,BAmount,BDebit,BCredit,BDate,UserId) VALUES('$name','$desp','$cat','$amount',1,0,'$date','$UserId')";

if($conn->query($sql))
     $data = 'Successfully saved';
else
     $data = 'Error occurred while saving.';

$jsonObj = new \StdClass;
$jsonObj->data = $data;
echo json_encode($jsonObj);
}
?>