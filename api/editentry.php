
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
$deb = $jsonObj ['isDebit'];
$bid = $jsonObj ['BalanceID'];

if($deb=="d"){
    $sql="UPDATE balancesheet SET BName='$name',BDescription='$desp',CategoryID='$cat',BAmount='$amount',BDebit=1,BCredit=0,BDate='$date',UserId='$UserId'  WHERE BalanceID='$bid'";

}else{
    $sql="UPDATE balancesheet SET BName='$name',BDescription='$desp',CategoryID='$cat',BAmount='$amount',BDebit=0,BCredit=1,BDate='$date',UserId='$UserId'  WHERE BalanceID='$bid'";
}

if($conn->query($sql))
     $data = 'Successfully saved';
else
     $data = 'Error occurred while saving.';

$jsonObj = new \StdClass;
$jsonObj->data = $data;
echo json_encode($jsonObj);
}
?>
