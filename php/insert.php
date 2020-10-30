<?php

    require "../mail/phpmailer/PHPMailerAutoload.php";



if(isset($_POST['nome'])){

    require 'dbh.php';

    $name=$_POST['nome'];
    $email=$_POST['email'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $pass2=$_POST['pass2'];

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
                    $subject = "Email Verification: Welcome to Collection Sight!";
                    $message = "<h1> Hi ".$username."! Welcome to the Collection Sight! </h1>
                                <br><br>
                                <center>
                                <text>
                                    To ultimate your registration procedure be sure to click the link below to confirm your email adress.
                                    <br>
                                    <br>
                                    <a href='https://collectionsight.com/verification_page.php?VKey=$verification_key'> Confirm the Account</a>
                                    <br>
                                    <br><br>
                                </center> 
                                    Collection Sight is a project that wants to expand and get bigger.
                                    For the first month the use of this platform is free. To mantain your data for a long time (life-long), you only need to pay 2.99 €. After that, your account will be stored forever in our databases. Try yourself for the first month and enjoy.
                                    <br>
                                    <br><br>
                                <center>
                                    Thank you and enjoy your collection!
                                    <br>
                                    The Team of Collection Sight.
                                </text>
                                <img src='cid:logo' class='d-block w-100'>
                                </center>    
                                    ";
                   
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
                            $mail->AddEmbeddedImage('immagini/logocollection.png', 'logo');
                                
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


