<?php

if(isset($_POST['reset-request-submit'])){

    require "dbh.php";

    $selector = bin2hex( random_bytes(8) );
    $token = random_bytes(32);


    $url = "https://collectionsight.com/create_new_password.php?selector=" . $selector . "&validator=" . bin2hex($token);

    $expires = date("U") + 1800;

    $user_mail = mysqli_real_escape_string($connessione, $_POST['email']);

    $sql = "DELETE FROM passwordreset WHERE Emailreset=?";
    $stmt = mysqli_stmt_init($connessione);

    if(!mysqli_stmt_prepare($stmt, $sql)){

        echo "There was an error";
        exit();

    } else {
    
        mysqli_stmt_bind_param($stmt, "s", $user_mail);
        mysqli_stmt_execute($stmt);

    }

    $sql = "INSERT INTO passwordreset (Emailreset, Selectorreset, Tokenreset, Expiresreset) VALUES (?,?,?,?)";
    $stmt = mysqli_stmt_init($connessione);

    if(!mysqli_stmt_prepare($stmt, $sql)){

        echo "There was an error";
        exit();

    } else {
        $hashed_token = password_hash($token, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ssss", $user_mail, $selector, $hashed_token, $expires);
        mysqli_stmt_execute($stmt);

    }

    mysqli_stmt_close($stmt);
    mysqli_close($connessione);

    $to = $user_mail;
    $subject = "Reset password for Collection Sight";

    $message = '<p> We received a password-reset request. The link to reset your password is right below in this mail. If you did not any request, please ignore this email.</p>
                
                
                <br><br>
                                <text>
                                <p> Here is your reset link: <p>
                                    <br>
                                    <br>
                                    <a href="'. $url. '">' . $url . '</a></p> 
                                    <br>
                                    <br>
                                    Thank you and enjoy your collection!
                                    <br>
                                    The Team of Collection Sight.
                                </text> ';

    $headers = "From: Collection Sight\r\n";

    $mail = new PHPMailer();
    $mail->isSMTP();

    $mail->Host='smtp.gmail.com';
    $mail->Port='465';
    $mail->SMTPAuth=true;
    $mail->SMTPSecure='ssl';

    $mail->Username='collectionsight@gmail.com';
    $mail->Password='xefeco87';

    $mail->setFrom('collectionsight@gmail.com','Collection Sight');
    $mail->AddAddress($to);
    $mail->addReplyTo('collectionsight@gmail.com');

    $mail->isHTML(TRUE);
    $mail->Subject = $subject;
    $mail->Body = $message;
                   
    if(!$mail->send()){
            echo "Message could not be sent";
    }
    else{
        //PUT THE USER TO THE VERIFICATION PAGE
        header("Location: ../reset_password.php?reset=success");
        exit();
    }

}
else {
    header("Location: ../index.php");
}