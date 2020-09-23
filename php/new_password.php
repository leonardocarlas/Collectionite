<?php

if(isset($_POST['reset-password-submit'])){

    $selector = $_POST['selector'];
    $validator = $_POST['validator'];
    $password = $_POST['pass'];
    $password_repeat = $_POST['pass-repeat'];

    if(empty($password) || empty($password_repeat)){
        header("Location: ../create_new_password.php?newpwd=empty");
        exit();
    }  else if ($password != $password_repeat){
        header("Location: ../create_new_password.php?newpwd=pwdnotsame");
        exit();
    }

    $current_date = date("U");

    require "dbh.php";

    $sql = "SELECT * FROM passwordreset WHERE Selectorreset = ? AND Expiresreset >=? ";
    $stmt = mysqli_stmt_init($connessione);

    if(!mysqli_stmt_prepare($stmt, $sql)){

        echo "There was an error";
        exit();

    } else {
    
        mysqli_stmt_bind_param($stmt, "ss", $selector, $current_date);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if(!$row = mysqli_fetch_assoc($result)){
            echo "You need to re-submit your reset request.";
            exit();
        } else {
            $token_binary = hex2bin($validator);
            $token_check = password_verify($token_binary, $row['Tokenreset']);

            if($token_check === false){
                echo "You need to re-submit your reset request.";
                exit();
            } elseif ($token_check === true) {

                $token_email = $row['Emailreset'];

                $sql = "SELECT * FROM user WHERE USER.Email = ?";
                $stmt = mysqli_stmt_init($connessione);

                if(!mysqli_stmt_prepare($stmt, $sql)){

                    echo "There was an error";
                    exit();

                } else {
                
                    mysqli_stmt_bind_param($stmt, "s", $token_email);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    if(!$row = mysqli_fetch_assoc($result)){
                        echo "You need to re-submit your reset request.";
                        exit();
                    } else {
                        $sql = "UPDATE user SET Hashed_password =? WHERE Email = ?";
                        $stmt = mysqli_stmt_init($connessione);

                        if(!mysqli_stmt_prepare($stmt, $sql)){

                            echo "There was an error";
                            exit();

                        } else {
                            $new_hashed_password = password_hash($password, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt, "sS",  $new_hashed_password, $token_email);
                            mysqli_stmt_execute($stmt); 

                            $sql = "DELETE FROM passwordreset WHERE Emailreset=?";
                            $stmt = mysqli_stmt_init($connessione);

                            if(!mysqli_stmt_prepare($stmt, $sql)){

                                echo "There was an error";
                                exit();

                            } else {
                            
                                mysqli_stmt_bind_param($stmt, "s", $token_email);
                                mysqli_stmt_execute($stmt);
                                header("Location: ../get_started.php?newpass=passwordupdated");
                            }

                            
                        }

                    }
                }

            }
        } 


    }

} else {
    header("Location: ../index.php");
}