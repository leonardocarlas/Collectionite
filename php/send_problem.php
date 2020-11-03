<?php


if(isset($_POST['invia-problema'])){

    require_once('../mail/phpmailer/PHPMailerAutoload.php');

    $sender = mysqli_real_escape_string($connessione, $_POST['sender-email']);
    $subject = mysqli_real_escape_string($connessione, $_POST['subject-problem']);
    $message = "";
    $txt = $_POST['mail-problem'];
    $to = "collectionsight@gmail.com";


    $headers = "From: $sender" . "\r\n" ;

    $message = $headers . "\r\n" . $txt ;

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP(true);
        $mail->SMTPAuth = true ;
        $mail->SMTPSecure='ssl';

        $mail->Host='smtp.gmail.com';
        $mail->Port='465';
        $mail->isHTML();
                        
        $mail->Username='collectionsight@gmail.com';
        $mail->Password='xefeco87';

        $mail->SetFrom('collectionsight@gmail.com','Collection Sight');
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->AddAddress($to);

        $mail->Send();
        //echo "Message Sent OK\n";
        header("Location: ../contact.php?Email=SENT");
        exit();

    } catch (phpmailerException $e) {
      echo $e->errorMessage(); //Pretty error messages from PHPMailer
    } catch (Exception $e) {
      echo $e->getMessage(); //Boring error messages from anything else!
    }





}