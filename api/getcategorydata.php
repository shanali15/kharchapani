<?php 
include("connect.php");

if($_SERVER['REQUEST_METHOD']=='POST') {
$json = @file_get_contents('php://input');
$jsonObj = json_decode($json, true);
$userid=$jsonObj ['userid'];
$sql = "SELECT * FROM category WHERE UserId = '".$userid."' ";
$result = $conn->query($sql);
$balance1= array();

while($row = mysqli_fetch_assoc($result)){
    // $balance  = array("category" => $row["CName"]);
    // array_push($balance1, $balance);
    array_push($balance1, $row);
}
echo json_encode($balance1);
}
?>