<?php

///////////////     Connessione al database       ////////////

////////////      Login       ////////////


if(isset($_POST['login-submit']))
{
    require 'dbh.php';

    $username=$_POST['username'];
    $password=$_POST['password'];

    if(empty($username) || empty($password)){
        header("Location: ../index.php?error=emptyfields");
        exit();
    }
    else{

        $sql = "SELECT * FROM user WHERE Username=?;";  
        $stmt = mysqli_stmt_init($connessione);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../index.php?error=sqlerror");
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
                    header("Location: ../index.php?error=wrongpassword");
                    exit();
                }
                if($row['Verified'] == 0){
                    header("Location: ../index.php?error=accountNOTVERIFIED");
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
                    header("Location: ../index.php?error=wrongvalueofpwdcheck");
                    exit();
                }
                


            }
            else{
                header("Location: ../index.php?error=nouserinthedatabase");
                exit();
            }
        }

    
   

    }
}

else{
    header("Location: ../index.php");
    exit(); 
}








?>