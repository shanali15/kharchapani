<?php
include('connect.php');

if($_SERVER['REQUEST_METHOD']=='POST') {
$json = @file_get_contents('php://input');
$jsonObj = json_decode($json, true);

$sql = "SELECT * FROM balancesheet JOIN category ON balancesheet.CategoryID=category.CategoryID";

// $sql = 'SELECT * FROM balancesheet';
$result = $conn->query($sql);
$balance1= array();
while($row = mysqli_fetch_assoc($result)){
    $ammountd = 0;
    $ammountc = 0;
    if ($row["BDebit"]==1 ){
        $ammountd = $row["BAmount"];        
    } else {
        $ammountc = $row["Bamount"];
    }

    $balance  = array("name" => $row["BName"], "Description" => $row["BDescription"], "date" => $row["BDate"], "Categoy" =>$row["CName"], "Debit"=>$ammountd, "Credit"=>$ammountc ); 
    array_push($balance1, $balance);
}
echo json_encode($balance1);
}
 ?>


	
		