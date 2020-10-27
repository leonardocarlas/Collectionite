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
                    echo '<div class="card card-success card-outline">

                    <div class="card-header">
                        <h5 class="card-title m-0">Transazione avvenuta correttamente</h5>
                    </div>
                    <div class="card-body">

                    <br>

                        <div class="row justify-content-center" >
                            <div class="col-mb-8">
                                Il tuo abbonamento fatto con successo etc.
                                                               
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
                        <h5 class="card-title m-0">Errore nella transazione</h5>
                    </div>
                    <div class="card-body">

                    <br>

                        <div class="row justify-content-center" >
                            <div class="col-mb-8">
                                Avvenuto errore nel pagamento: '.$_GET["error"].'
                                                               
                            </div>
                        </div>  
                    </div>
                    ';
                }
                else
                    header("Location: index.php");
            }
            else
                header("Location: index.php");

        ?>

             <!--.\ card-body -->
            <div> <!--.\ card -->
        </div> <!--.\ content -->
    </div>  <!--.\ container -->






<br><br><br><br><br><br><br><br>



<?php

 require "footer.php";
?>
