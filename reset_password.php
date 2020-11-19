<?php

    require "header.php";
?>


    <main>

    <br><br><br>
        
    <div class="content">
            <div class="container">

                    <div class="row justify-content-center">
                        <div class="card card-primary card-outline">
                            <div class="card-body">
        
                                <h1>Resetta la tua password </h1>
                                <p>Un e-mail ti verrà inviata alla tua casella di posta con le istruzioni su come procedere. </p>
                                    
                                <form action="php/reset.php" method="POST">

                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="email" placeholder="Inserisci la tua e-mail" aria-label="Inserisci la tua e-mail" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" name="reset-request-submit" type="submit">Ricevi la nuava password per e-mail</button>
                                        </div>
                                </div>
                                </form>
                                
                                <?php

                                    if(isset($_GET['reset'])){
                                        if($_GET['reset'] == "success"){
                                            echo '<p class"signupsuccess">Controlla il tuo account e-mail</p>';
                                        }
                                    }

                                ?>

                            </div>
                        </div>
                    </div>
                           
            </div>
    </div>
    </main>



<br><br><br><br><br><br><br><br><br><br>


<?php
    require "footer.php";
?>



