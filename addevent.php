<?php
include "conn/conn.php";

if(!empty($_POST['eventname']) && !empty($_POST['desp']))
{
    if(file_exists($_FILES['file']['tmp_name']) || is_uploaded_file($_FILES['file']['tmp_name'])){
        $file = $_FILES['file'];
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];
        $file_size = $file['size'];
        $file_error = $file['error'];
        date_default_timezone_set("Asia/Karachi");
        $filedate=date("Y-m-d h-i-sa");

        $file_ext = explode('.',$file_name);
        $file_ext = strtolower(end($file_ext));

        $allowed = array('jpg','png','jpeg');

        if(in_array($file_ext,$allowed)){
            if($file_error === 0){
                if($file_size <= 5000000){
                    $filename_new = $filedate . '.' . $file_ext;
                    if (!file_exists('uploads/event')) {
                        mkdir('uploads/event', 0777, true);
                    }
                    $file_destination = 'uploads/event/'. $filename_new;
                    if(move_uploaded_file($file_tmp,$file_destination)){
                        // echo $file_destination;
                        if(!empty($_POST['eventname']) && !empty($_POST['desp'])){
                            $eventname=addslashes($_POST['eventname']);
                            $desp=addslashes($_POST['desp']);
                            $sql="INSERT INTO events (Name,Desp,Image,Date) VALUES('$eventname','$desp','$file_destination','$filedate')";
                            if ($conn->query($sql) === TRUE) 
                            {
                                echo "Event Uploaded Successfully"; 
                            } 
                            else 
                            {
                                echo "Error Uploading Event: " . $conn->error;
                            }
                        }
                        else{
                            echo "Please fill out all the feilds";
                        }
                    }
                }
            }
        }
    
    }
}
else{
    echo "Please fill out all the feilds";
}
?>