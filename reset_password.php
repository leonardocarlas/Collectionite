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
        
                                <h1>Reset your password </h1>
                                <p>An email will be send to you with instructions on how to reset your password. </p>
                                    
                                <form action="php/reset.php" method="POST">

                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="email" placeholder="Enter your e-mail address" aria-label="Enter your e-mail address" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" name="reset-request-submit" type="submit"> Receive new passwrod by e-mail</button>
                                        </div>
                                </div>
                                </form>
                                
                                <?php

                                    if(isset($_GET['reset'])){
                                        if($_GET['reset'] == "success"){
                                            echo '<p class"signupsuccess">Check your e-mail account</p>';
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



