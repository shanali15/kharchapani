<?php 
// session_start();

include("connect.php");
if($_SERVER['REQUEST_METHOD']=='POST') {
    $json = @file_get_contents('php://input');
    $jsonObj = json_decode($json, true);
    $userid=$jsonObj ['user_id'];
    $date=$jsonObj ['mydate'];
    $balance1= array();
    $sql1 = 'SELECT SUM(IFNULL(BAmount, 0)) AS total FROM balancesheet WHERE BCredit=1 AND UserId="'.$userid.'" AND BDate LIKE "'.$date.'%"';
    $result1 = $conn->query($sql1);
    $row1 = $result1->fetch_assoc();
    $credit = $row1['total'];
    $sql2 = 'SELECT SUM(IFNULL(BAmount, 0)) AS total FROM balancesheet WHERE BDebit=1 AND UserId="'.$userid.'" AND BDate LIKE "'.$date.'%"';
    $result2 = $conn->query($sql2);
    $row2 = $result2->fetch_assoc();
    $debit = $row2['total'];
    if ($credit == null ){
        $credit = 0;
    }
    if ($debit == null ){
        $debit = 0;
    }
    $total = $credit - $debit;
    $stats  = array("credit"=>$credit,"debit"=>$debit,"total"=>$total);
    array_push($balance1, $stats);
    echo json_encode($balance1);
}
    ?>