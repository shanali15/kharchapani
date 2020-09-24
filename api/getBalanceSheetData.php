<?php
// include "connect.php";
include('connect.php');

if($_SERVER['REQUEST_METHOD']=='POST') {
$json = @file_get_contents('php://input');
$jsonObj = json_decode($json, true);

$readId=$jsonObj['readId'];
$data = '';
$sql = 'SELECT * FROM balancesheet JOIN category ON category.CategoryID = balancesheet.CategoryID WHERE BalanceID="'.$readId.'"'; 
//echo $sql;
$result = $conn->query($sql);
if($result->num_rows > 0) {
$row = mysqli_fetch_assoc($result);
$data = $row;
}
$jsonObj = new \StdClass;
$jsonObj->data = $data;
echo json_encode($jsonObj);
}
?>