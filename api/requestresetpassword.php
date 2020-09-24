<?php
include("connect.php");

if($_SERVER['REQUEST_METHOD']=='POST') {
    $json = @file_get_contents('php://input');
    $jsonObj = json_decode($json, true);
    $email=$jsonObj['email'];
    $sqlCheck = 'SELECT * FROM users WHERE email = "'.$email.'"';
    $result = mysqli_query($conn, $sqlCheck);
    $randkey = base64_encode(openssl_random_pseudo_bytes(8));
    if(mysqli_num_rows($result) > 0) {
        $sqlreset = 'UPDATE users SET resetkey="'.$randkey.'" WHERE email= "'.$email.'"';
        $_result = mysqli_query($conn,$sqlreset);
        require 'PHPMailer/PHPMailerAutoload.php';
        $mail = new PHPMailer;
    
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
    
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host = "smtp.ipage.com"; // host name
        $mail->Port = 465;
        $mail->Username = "notification@matz.group"; //email id
        $mail->Password = "Qwerty@12";  //password
    
        $mail->setFrom('notification@matz.group', 'Kharcha Pani'); //from email
        //    $mail->addAddress('info@edusol.co'); //same email id as line16 
        $mail->addAddress($email); //same email id as line16 
        $mail->addReplyTo("notification@matz.group");
    
    
        $mail->isHTML(true);
        $mail->Subject = 'Reset Password';
        //    $mail->Body='Name :'.$name.'<br>Email :'.$email.'<br>Subject :'.$subject.'<br>Message: '.':'.$message;
        $mail->Body = 'To Reset Password copy the code and paste it "'.$randkey.'" ';
    
        if (!$mail->Send()) {
            $data = '"Mailer Error: " '. $mail->ErrorInfo;
            
        } else {
           $data = "mail sent";}
        
    
    
        }else{
            $data = "THIS EMAIL DOESNT EXIST";
        }
    $jsonObj = new \StdClass;
    $jsonObj->data = $data;
    echo json_encode($jsonObj);
    }
    
    
    ?>