<?php

    require "../mail/phpmailer/PHPMailerAutoload.php";



if(isset($_POST['tasto_invia'])){

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
        $sql= "SELECT Username FROM USER WHERE Username=?";
        $stmt = mysqli_stmt_init($connessione);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../get_started.php?error=sqlerror");
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


                $sql = "INSERT INTO USER ( Username, Email, Real_name, Hashed_password, Verification_key) VALUES (?,?,?,?,?)";
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
                    $subject = "Email Verification: Welcome to Dragon Collection!";
                    $message = "<h1> Hi ".$username."! Welcome to the Dragon Collection! </h1>
                                <br><br>
                                <text>
                                    To ultimate your registration procedure be sure to click the button below to confirm your email adress.
                                    <br>
                                    <br>
                                    <button><a href='http://localhost/Leo%20Collection/verification_page.php?VKey=$verification_key'> Confirm the Account</a></button>
                                    <br>
                                    <br>
                                    Thank you and enjoy your collection!
                                    <br>
                                    The Team of Dragon Collection
                                </text>    
                                    ";
                   
                    
                    $mail = new PHPMailer();
                    $mail->isSMTP();
                    $mail->SMTPAuth = true ;
                    $mail->SMTPSecure='ssl';

                    $mail->Host='smtp.gmail.com';
                    $mail->Port='465';
                    $mail->isHTML();
                    
                    $mail->Username='lio.del.bronx@gmail.com';
                    $mail->Password='xefeco87';

                    $mail->SetFrom('lio.del.bronx@gmail.com','Dragon Collection');
                    $mail->Subject = $subject;
                    $mail->Body = $message;
                    $mail->AddAddress($to);
                    //$mail->addReplyTo('lio.del.bronx@gmail.com');
                   
                    if(!$mail->send()){
                        echo "Message could not be sent";
                    }
                    else{
                        //PUT THE USER TO THE VERIFICATION PAGE
                        header("Location: ../verification_page.php?SIGNUP=SUCCESS");
                        exit();
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


