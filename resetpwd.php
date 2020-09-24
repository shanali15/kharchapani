<?php
include "conn/conn.php";
$email = $_POST['email'];

$sqlCheck = 'SELECT * FROM users WHERE email = "'.$email.'"';
$result = mysqli_query($conn, $sqlCheck);
$randkey = base64_encode(openssl_random_pseudo_bytes(8));
$time = time();
if(mysqli_num_rows($result) > 0) {
    $sqlreset = 'UPDATE users SET resetkey="'.$randkey.'" WHERE email= "'.$email.'"';
    // echo $sqlreset;
    $_result = mysqli_query($conn,$sqlreset);
    require 'PHPMailer/PHPMailerAutoload.php';
    $mail = new PHPMailer;

    $mail->IsSMTP();
    $mail->SMTPDebug = 2;

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
    $mail->Body = 'To Reset Password copy the code and paste it on the following link "'.$randkey.'" ';

    if (!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        header('location:newpassword.php?email_sent');
    }
    


} else {
    echo "email not registered";
}

?>

