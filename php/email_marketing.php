<?php

if(isset($_GET['Password']))
{
    $password = $_GET['Password'];
    static $TRUE_PASSWORD = 'Dragalge3';

    if( $password != $TRUE_PASSWORD ) {
        echo 'Password errata';
    }
    else {
        echo 'Ben tornato leo' . '<BR>';
        
        require 'dbh.php';
        require "../mail/phpmailer/PHPMailerAutoload.php";

        $sql = "SELECT DISTINCT Email, Real_name FROM user; ";
        $stmt = mysqli_stmt_init($connessione);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo "Error in the database";
        }
        else {
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt); 

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
                    echo $row['Email'] . '<BR>';
                    
                    $to = $row['Email'];
                    $subject = "";
                    $message = "Ciao ".$row['Real_name'].", sono Leonardo, il programmatore che sta dietro Collection Sight!
                    

                    Sinceramente, Leonardo";

                                    
                   
                        $mail = new PHPMailer(true);
                        
                        try {
                            $mail->isSMTP(true);
                            
                            $mail->SMTPAuth = true ;
                            $mail->SMTPKeepAlive = true;
                            $mail->SMTPSecure='ssl';
                            $mail->Username='collectionsight@gmail.com';
                            $mail->Password='xefeco87';
                            $mail->Host='smtp.gmail.com';
                            $mail->Port='465';
                            
                                                        
                            
                                
                            $mail->SetFrom('collectionsight@gmail.com','Collection Sight');
                            $mail->addReplyTo('collectionsight@gmail.com','Collection Sight');
                            $mail->addAddress($to);
                            $mail->Subject = $subject;
                            $mail->Body = $message;
                            
                            //$mail->AddEmbeddedImage('immagini/logocollection.png', 'logo');
                            

                                
                            $mail->Send();
                            //PUT THE USER TO THE VERIFICATION PAGE
                            header("Location: ../verification_page.php?SIGNUP=SUCCESS");
                            exit();
                        } catch (phpmailerException $e) {
                            echo $e->errorMessage(); //Pretty error messages from PHPMailer
                        } catch (Exception $e) {
                            echo $e->getMessage(); //Boring error messages from anything else!
                        }

                }
            }
        }


    }
}





else{
    echo 'Non hai le credenziali per accedere';
}