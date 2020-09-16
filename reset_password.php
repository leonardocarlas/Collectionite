<?php

    require "header.php";
?>


    <main>
        <div class="wrapper-main">
            <section class="section-default">
                <h1>Reset your password </h1>
                <p>An email will be send to you with instructions on how to resete your password. </p>
                
                <form action="php/reset.php" method="POST">
                    <input type="text" name="email" placeholder="Enter your e-mail address">
                    <button type="submit" name="resete-request-submit"> Receive new passwrod by e-mail </button>

                </form>

                <?php

                    if(isset($_GET['reset'])){
                        if($_GET['reset'] == "success"){
                            echo '<p class"signupsuccess">Check your e-mail account</p>';
                        }
                    }

                ?>

            </section>
        </div>
    </main>






<?php
    require "footer.php";
?>



