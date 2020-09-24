
<?php
include("connect.php");

if($_SERVER['REQUEST_METHOD']=='POST') {
$json = @file_get_contents('php://input');
$jsonObj = json_decode($json, true);

$name=$jsonObj ['name'];
$userid=$jsonObj ['userid'];
$data = '';
$sql="INSERT INTO category (CName,UserId) VALUES('$name','$userid')";

if($conn->query($sql))
     $data = 'Successfully saved';
else
     $data = 'Error occurred while saving.';

$jsonObj = new \StdClass;
$jsonObj->data = $data;
echo json_encode($jsonObj);
}
?>