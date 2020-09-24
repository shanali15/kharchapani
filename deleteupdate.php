<?php
include "conn/conn.php";
if (!empty($_GET['ID'])) {
    $ID=$_GET['ID'];
    $sql="DELETE FROM balancesheet WHERE BalanceID='$ID'";
    if ($conn->query($sql) === TRUE)
    {
        echo "Record Deleted Successfully";
    }
    else {
        echo "Error Deleting Record: ".$conn->error;
    }
}
?>