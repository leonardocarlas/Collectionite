<?php

    require "php/dbh.php";



if(isset($_GET['VKey'])){
    
    require "header.php";

    $verification_key = $_GET['VKey'];

    
    $sql = "SELECT Verified, Verification_key FROM USER WHERE Verified = 0 AND Verification_key = '$verification_key' LIMIT 1";
    $result = $connessione->query($sql);

    if ($result->num_rows == 1) {
        
        $sql_update = "UPDATE USER SET Verified = 1 WHERE Verification_key = '$verification_key' LIMIT 1";

        if ($connessione->query($sql_update) === TRUE) {  ?>
        
        <div class="content">
            <div class="container">

                <div class="row justify-content-center">
                      
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <p class="card-text"><h1>The account it's been verified correctly . Please back to the Home Page</h1></p>

                                <div class ="row justify-content-center">
                                    <imgrc="immagini/img2.jpg"> 
                                </div>
                            </div>

                        

                        </div>
                </div>
                           
            </div>
        </div>

<?php

        } else {
        echo "Error updating record: " . $connessione->error;
        }
    
    
    } else {
    echo '<div class="content">
            <div class="container">

                <div class="row justify-content-center">
              
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <p class="card-text"><h1>The account is already verified. You can log in</h1></p>

                        <div class ="row justify-content-center">
                            <imgrc="immagini/img2.jpg"> 
                        </div>
                    </div>

                

                </div>
        </div>
                   
    </div>
</div>';
    }
    $connessione->close();


}
if(isset($_GET['SIGNUP'])){  

    
   echo '
    
    <!DOCTYPE html>
    <head>
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/adminlte.min.css">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <title>Leo Collection</title>
        <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">
    </head>
    </body>

        <div class="content">
        <div class="container">

            <div class="row justify-content-center">
                    
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <div col=4>
                                <p class="card-text"><h1>Thank you for your registration.</h1></p>
                                <p class="card-text">We have sent you an email to confirm the account. Go and Check it. Also, you can close this page.</p>
                            </div>

                            <br>
        
                            <div class="row justify-content-center">
                                <img src="immagini/img2.jpg"> 
                            </div>

                            <br>

                            <p class="card-text" ><h3>Sincerily, The Team of Dragon Collection</h3></p>
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