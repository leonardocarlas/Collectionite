<?php

    require "../mail/phpmailer/PHPMailerAutoload.php";



if(isset($_POST['nome'])){

    require 'dbh.php';

    $name=mysqli_real_escape_string($connessione, $_POST['nome']);
    $email=mysqli_real_escape_string($connessione, $_POST['email']);
    $username=mysqli_real_escape_string($connessione, $_POST['username']);
    $password=mysqli_real_escape_string($connessione, $_POST['password']);
    $pass2=mysqli_real_escape_string($connessione, $_POST['pass2']);

    if(empty($username) || empty($email) || empty($username) || empty($password) || empty($pass2)){
        header("Location: ../get_started.php?error=emptyfields&nome=".$username."&email=".$email);
        exit();
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)){
        header("Location: ../get_started.php?error=invalidemailusername");
        exit();
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: ../get_started.php?error=invalidemail&nome=".$username);
        exit();
    }
    else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        header("Location: ../get_started.php?error=invalidusername&email=".$email);
        exit();
    }
    else if ($password !== $pass2){
        header("Location: ../get_started.php?error=passwordcheck&username=".$username."&email=".$email);
        exit();        

    }
    else {
        $sql= "SELECT Username FROM user WHERE Username=?";
        $stmt = mysqli_stmt_init($connessione);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../get_started.php?error=sqlerrorusername");
            exit();
        }
        else{
            ///prosegue qui il corretto funzionamento
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultcheck= mysqli_stmt_num_rows($stmt);

            if($resultcheck > 0)
            {
                header("Location: ../get_started.php?error=Usernametaken&email=".$email);
                exit();
            }
            else{
                
                //create the verification key
                $verification_key = md5( time().$username );


                $sql = "INSERT INTO user ( Username, Email, Real_name, Hashed_password, Verification_key) VALUES (?,?,?,?,?)";
                $stmt = mysqli_stmt_init($connessione);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../get_started.php?error=sqlerror");
                    exit();

                }
                else{
                    $hashpwd = password_hash($password, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt, "sssss", $username, $email, $name, $hashpwd, $verification_key);
                    mysqli_stmt_execute($stmt);

                    //SEND EMAIL
                    $to = $email;
                    $subject = "Verifica Email: Benvenuto su Collection Sight!";
                    $message = "Ciao ".$username."! Benvenuto su Collection Sight!
Per completare la procedura di registrazione clicca il link sottostante per confermare il tuo indirizzo email.

https://collectionsight.com/verification_page.php?VKey=$verification_key

Collection Sight e' un progetto che vuole espandersi e offrire sempre piu' strumenti per i collezionisti.

Siamo davvero lieti di averti nella nostra community.

Il Team di Collection Sight.    
        ";

                                    
                   
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
    mysqli_stmt_close($stmt);
    mysqli_close($connessione);
}
else{

    echo  "Failure";

}


