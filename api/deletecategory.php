
<?php
include("connect.php");

if($_SERVER['REQUEST_METHOD']=='POST') {
$json = @file_get_contents('php://input');
$jsonObj = json_decode($json, true);

$catid=$jsonObj ['catid'];
$data = '';
$sql="DELETE FROM category WHERE CategoryID = '".$catid."' ";

if($conn->query($sql))
     $data = 'Successfully Deleted';
else
     $data = 'Not Deteled';

$jsonObj = new \StdClass;
$jsonObj->data = $data;
echo json_encode($jsonObj);
}
?>