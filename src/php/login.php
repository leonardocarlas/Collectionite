<?php

///////////////     Connessione al database       ////////////

////////////      Login       ////////////


if(isset($_POST['login-submit']))
{
    require 'dbh.php';

    $username = mysqli_real_escape_string($connessione, $_POST['username']);
    $password = mysqli_real_escape_string($connessione, $_POST['password']);

    if(empty($username) || empty($password)){
        header("Location: ../get_started.php?error=emptyfields");
        exit();
    }
    else{

        $sql = "SELECT * FROM user WHERE Username=?;";  
        $stmt = mysqli_stmt_init($connessione);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../get_started.php?error=sqlerror");
            exit();

        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);

            if($row) {    ////row not null
                
                
                $pwdcheck = password_verify($password, $row['Hashed_password']); 
                                
                if($pwdcheck == false){
                    header("Location: ../get_started.php?error=wrongpassword");
                    exit();
                }
                if($row['Verified'] == 0){
                    header("Location: ../get_started.php?error=accountNOTVERIFIED");
                    exit();
                }
                else if($pwdcheck == true){
                    session_start();
                    $_SESSION['idusersession'] =  $row['Iduser'];
                    $_SESSION['usernamesession'] =  $row['Username'];

                    $_SESSION['compile'] = true;


                    header("Location: ../home.php?LOGIN=SUCCESS");
                    exit();
                }
                else{
                    header("Location: ../get_started.php?error=wrongvalueofpwdcheck");
                    exit();
                }
                


            }
            else{
                header("Location: ../get_started.php?error=nouserinthedatabase");
                exit();
            }
        }

    
   

    }
}

else{
    header("Location: ../get_started.php");
    exit(); 
}




?>