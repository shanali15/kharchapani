<?php
include "conn/conn.php";
session_start();
$userid = $_SESSION['user_id'];
$sql = 'SELECT * FROM balancesheet JOIN category ON category.CategoryID = balancesheet.CategoryID WHERE  BDate LIKE "'.$_POST['mydate'].'%" AND balancesheet.UserId="'.$userid.'" '; 
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)){
        $BalanceID = $row['BalanceID'];
        if( $row['BDebit'] == 1){

                echo '<tr>
                <td> <a class="btn btn-danger del_update" id="'.$BalanceID.'" href="" role="button" style="border-radius:40px/24px; background-color:red; color:white">Delete</a></td>
                <td> <a class="btn btn-primary edit_sheet" id="'.$BalanceID.'" href="" role="button" style="border-radius:40px/32px; background-color:#39b54a; color:white">Edit</a></td>
                <td>'.$row['BName'].'</td>
                <td>'.$row['BDescription'].'</td>
                <td>'.date("d-M-Y", strtotime($row['BDate'])).'</td>
                <td>'.$row['CName'].'</td>
                <td>'.$row['BAmount'].'</td>
                <td>0</td>
                </tr>';


        }else{

                echo '<tr>
                <td> <a class="btn btn-danger del_update" id="'.$BalanceID.'" href="" role="button" style="border-radius:40px/24px; background-color:red; color:white">Delete</a></td>
                <td> <a class="btn btn-primary edit_sheet" id="'.$BalanceID.'" href="" role="button" style="border-radius:40px/32px; background-color:#39b54a; color:white">Edit</a></td>
                <td>'.$row['BName'].'</td>
                <td>'.$row['BDescription'].'</td>
                <td>'.date("d-M-Y", strtotime($row['BDate'])).'</td>
                <td>'.$row['CName'].'</td>
                <td>0</td>
                <td>'.$row['BAmount'].'</td>
                </tr>';

        };         
}


?>