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
                        <h5 class="card-title m-0">The transaction has been succesffull</h5>
                    </div>
                    <div class="card-body">

                    <br>

                        <div class="row justify-content-center" >
                            <div class="col-mb-8">
                            <center>
                            <text>
                                The Team of Collection Sight thank you. Starting from now, your datas will be stored forever in our databases.
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
                        <h5 class="card-title m-0">An error occurs in the transaction</h5>
                    </div>
                    <div class="card-body">

                    <br>

                        <div class="row justify-content-center" >
                            <div class="col-mb-8">
                            <center>
                            <text>
                                This error occurs in the attempt of the transaction: '.$_GET["error"].'
                                Please contact the PayPal Support Service.
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
