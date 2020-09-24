<?php
include("connect.php");
  
if($_SERVER['REQUEST_METHOD']=='POST') {
$json = @file_get_contents('php://input');
$jsonObj = json_decode($json, true);
$myuseremail = $jsonObj['text'];

$mypassword = $jsonObj['pass'];

$data = '';
$sql = "SELECT * FROM users WHERE UserName = '".$myuseremail."' AND Password = '".$mypassword."'";
$result = $conn->query($sql); 
if($result->num_rows > 0)  {
$data = $result->fetch_assoc()['UserID'];
} else
$data = 'Invalid Username/password';
$object = new \StdClass;
$object->data = $data;
echo json_encode($object);
}
?>