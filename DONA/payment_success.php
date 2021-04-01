<?php
    require "header.php";
    require "php/dbh.php";
?>

<br><br><br><br>



<div class="content">
      <div class="container">
      <?php
            if(isset($_GET["result"]))
            {
                if($_GET["result"] == "SUCCESS")
                {   
                    echo '
                    <div class="card card-success card-outline">

                    <div class="card-header">
                        <h5 class="card-title m-0">La transazione è andata a buon fine</h5>
                    </div>
                    <div class="card-body">

                    <br>

                        <div class="row justify-content-center" >
                            <div class="col-mb-8">
                            <center>
                            <text>
                                Il Team di Collection Sight ti ringrazia molto. A partire da ora i tuoi dati saranno per sempre salvati nel nostro database.
                            </text>
                            </center>                                   
                            </div>
                        </div>  
                    </div>
                    ';
                } 
                else if($_GET["result"] == "ERROR")
                {
                    // fare escape errore
                    echo '<div class="card card-danger card-outline">

                    <div class="card-header">
                        <h5 class="card-title m-0">E\' occorso un errore durante la transazione</h5>
                    </div>
                    <div class="card-body">

                    <br>

                        <div class="row justify-content-center" >
                            <div class="col-mb-8">
                            <center>
                            <text>
                                L\'errore è nato nel tentativo della transazione: '.$_GET["error"].'
                                Ti consigliamo di contattare il Servizio di Assistenza di PayPal e di verificare la connessione ad internet.
                            </text>
                            </center>                                   
                            </div>
                        </div>  
                    </div>
                    ';
                }  
                else
                    header("Location: index.php");
                    exit();
            }
            else{
                header("Location: index.php");
                exit();
            }
            
        ?>

             <!--.\ card-body -->
            <div> <!--.\ card -->
        </div> <!--.\ content -->
    </div>  <!--.\ container -->






<br><br><br><br><br><br><br><br>



<?php

 require "footer.php";
?>
