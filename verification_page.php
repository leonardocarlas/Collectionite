<?php

    require "php/dbh.php";



if(isset($_GET['VKey'])){
    
    require "header.php";

    $verification_key =  mysqli_real_escape_string($connessione, $_GET['VKey']);

    
    $sql = "SELECT Verified, Verification_key FROM user WHERE Verified = 0 AND Verification_key = ? LIMIT 1";
    $stmt = mysqli_stmt_init($connessione);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "Error in the database";
    }
    else{
        mysqli_stmt_bind_param($stmt, "s", $verification_key);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result->num_rows == 1)
        {
        
            $sql_update = "UPDATE user SET Verified = 1 WHERE Verification_key = '$verification_key' LIMIT 1";
            if ($connessione->query($sql_update) === TRUE) 
                {
?>
                
                <div class="content">
                    <div class="container">

                        <div class="row justify-content-center">
                            
                                <div class="card card-primary card-outline">
                                    <div class="card-body">
                                        <p class="card-text"><h1>Questo account è stato verificato correttamente. Ritorna alla home page ed effettua il login.</h1></p>

                                        <div class ="row justify-content-center">
                                            <imgrc="immagini/logofull.png"> 
                                        </div>
                                    </div>

                                

                                </div>
                        </div>
                                
                    </div>
                </div>
<?php
                } 
                else 
                {
                    echo "Error updating record: " . $connessione->error;
                }
        }
        else //ELSE DELL'IF PRINCIPALE
        {
                echo '<div class="content">
                        <div class="container">
            
                            <div class="row justify-content-center">
                        
                            <div class="card card-primary card-outline">
                                <div class="card-body">
                                    <p class="card-text"><h1>Questo account è già stato verificato. Puoi effettuare il login.</h1></p>
            
                                    <div class ="row justify-content-center">
                                        <imgrc="immagini/logofull.png" width="500" height="600"> 
                                    </div>
                                </div>
            
                            
            
                            </div>
                    </div>
                            
                </div>
            </div>';
        }
    
    }




    
    $connessione->close();
    
}
?>




<?php

if(isset($_GET['SIGNUP'])){  

    
   echo '
    
    
   <!DOCTYPE html>
   <head>
   <!-- Bootstrap -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   
   </head>
   <body>
   
   <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

       <div class="content">
       <div class="container">

           <div class="row justify-content-center">
                   
                   <div class="card card-primary card-outline">
                       <div class="card-body">
                           <div col=4>
                               <p class="card-text"><h1>Grazie per esserti registrato.</h1></p>
                               <p class="card-text">Abbiamo mandato una e-mail al tuo indirizzo di posta per confermare l\'account. Vai a controllare! Puoi pure chiudere questa pagina.</p>
                           </div>

                           <br>
       
                           <div class="row justify-content-center">
                               <img src="immagini/logofull.png" width="500" height="600"> 
                           </div>

                           <br>

                           <p class="card-text" ><h3>Il Team di Collection Sight.</h3></p>
                       </div>

                   

                   </div>
           </div>
                       
       </div>
       </div>

   </body>
   </html>
   ';
}

    
?>