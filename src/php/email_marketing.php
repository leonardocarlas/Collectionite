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
                    $subject = "Sito Reso Gratuito per tutti";
                    $message = "Ciao ".$row['Real_name'].", sono Leonardo, il programmatore dietro Collection Sight.
Volevo dirti che ho eliminato tutto il discorso dell'abbonamento al sito e ora è completamente gratuito per tutti.
Chi lo aveva pagato é stato completamente rimborsato su PayPal.
Colgo l’occasione per anticiparti che nei prossimi mesi ci sarà un sostanziale aggiornamento con il quale renderò più intuitivo il meccanismo di inserimento delle carte.
Per qualsiasi suggerimento scrivimi a questa e-mail.
Ti ringrazio per il tuo supporto e ti auguro un felice 2021. 
    

Leonardo";

                                    
                   
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
                            echo 'Email mandate con succeso'.'<BR>';
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