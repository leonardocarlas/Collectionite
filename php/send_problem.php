<?php

    require "../mail/phpmailer/PHPMailerAutoload.php";



if(isset($_POST['invia-problema'])){

    $sender = $_POST['sender-email'];
    $subject = $_POST['subject-problem'];
    $message = "";
    $txt = $_POST['mail-problem'];
    $to = "lio.del.bronx@gmail.com";


    $headers = "From: $sender" . "\r\n" ;

    $message = $headers . "\r\n" . $txt ;

    $mail = new PHPMailer();
    $mail->isSMTP();

    $mail->Host='smtp.gmail.com';
    $mail->Port='465';
    $mail->SMTPAuth=true;
    $mail->SMTPSecure='ssl';

    $mail->Username='lio.del.bronx@gmail.com';
    $mail->Password='xefeco87';

    $mail->setFrom($sender);
    $mail->AddAddress($to);
    //$mail->addReplyTo('lio.del.bronx@gmail.com');

    $mail->isHTML(TRUE);
    $mail->Subject = $subject;
    $mail->Body = $message;
    
    if(!$mail->send()){
         echo "Message could not be sent";
    }
    else{
        //PUT THE USER TO THE VERIFICATION PAGE
    header("Location: ../contact.php?Email=SENT");
        exit();
    }

    
    



}