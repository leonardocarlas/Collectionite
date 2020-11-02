<?php

    require "header.php";
?>


    <main>
        <div class="wrapper-main">
            <section class="section-default">

                <?php
                    $selector = mysqli_real_escape_string($connessione, $_GET['selector']);
                    $validator = mysqli_real_escape_string($connessione, $_GET['validator']);

                    if(empty($selector) || empty($validator)){
                        echo "Could not validate you request";
                    }
                    else{
                        
                        if(ctype_xdigit($selector) !== false && ctype_xdigit($validator)!==false){
                            ?>
                            
                            <form action="new_password.php" method="POST">
                                <input type="hidden" name="selector" value="<?php echo $selector ?>">
                                <input type="hidden" name="validator" value="<?php echo $validator ?>">
                                <input type="password" name="pass" placeholder="Enter a new password">
                                <input type="password" name="pass-repeat" placeholder="Repeat the new password">
                                <button type="submit" name="reset-password-submit">Reset password</button>
                            </form>

                            <?php
                        }
                    }

                    
                ?>
                

            </section>
        </div>
    </main>






<?php
    require "footer.php";
?>



