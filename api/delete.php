<?php
include("connect.php");

if($_SERVER['REQUEST_METHOD']=='POST') {
$json = @file_get_contents('php://input');
$jsonObj = json_decode($json, true);

$data = "";
$ID=$jsonObj['ID'];
$sql="DELETE FROM balancesheet WHERE BalanceID=".$ID;
if($conn->query($sql)) 
       $data = 'successful';
else
       $data = 'Error occurred while deleting entry.';
$jsonObj = new \StdClass;
$jsonObj->data = $data;
echo json_encode($jsonObj);
}
?>