<?php
    require "header.php";
?>


    <main>

    <div class="content-wrapper">
            <div class="content-header">
                <div class="container">
                  <div class="row mb-3">
                      <div class="col-sm-6">
                      <h1 class="m-0 text-dark"> Get Started</h1>
                      </div><!-- /.col -->
                  </div>
                
                </div><!-- /.container-fluid -->
            </div>' 
        <div>
    </div>

<?php 
    /////////   GESTIONE MESSAGGI   ///////
    if(isset($_GET['error'])){
        $message = $_GET['error'];
        if($message == "emptyfields"){  ?>
            
                <div class="alert alert-danger" role="alert">
                    No username or password have been inserted
                </div>
            
<?php   }
        if($message == "invalidemailusername"){    ?>
            
                <div class="alert alert-danger" role="alert">
                    Special characters are not allowed in the Username.
                    This Main and This Username are not allowed
                </div>
            
<?php   }
        if($message == "invalidemail"){     ?>
            
                <div class="alert alert-danger" role="alert">
                  This Mail is not allowed
                </div>
<?php   }
        if($message == "invalidusername"){     ?>
            
                <div class="alert alert-danger" role="alert">
                  This Username is not allowed
                </div>
<?php   }
        if($message == "passwordcheck"){     ?>
            
                <div class="alert alert-danger" role="alert">
                  The two passwords are not the same
                </div>
<?php             
        }

    }
?>


          <div class="row justify-content-center" class="form-group">
           <table>
              <form method="POST" action="php/insert.php">
                <tr>
                  <td>Name</td>
                  <td><input type="text" class="form-control" name="nome" placeholder="Name"></td>
                </tr>
                <tr>
                  <td>Email</td>
                  <td><input type="text" class="form-control" name="email" placeholder="Your Email"></td>
                </tr>
                <tr>
                  <td>Username</td>
                  <td><input type="text" class="form-control" name="username" placeholder="Choose a username"></td>
                </tr>
                <tr>
                  <td>Password</td>
                  <td><input type="password" class="form-control" name="password" placeholder="Password"></td>
                </tr>
                <tr>
                  <td>Reapeat Password</td>
                  <td><input type="password" class="form-control" name="pass2" placeholder="Repeat password"></td>
                </tr>
                <tr>
                  <td><input type="submit" class="btn btn-primary" name="tasto_invia" value="Invia i tuoi dati"></td>
                </tr>

              </form>
              <?php
                  if(isset($_GET['newpass'])){
                      if($_GET['newpass'] == "passwordupdated"){
                        echo '<p class="signupsuccess"> Your password has benn updated </p>';
                      }
                  }
              ?>
              <a href="reset_password.php"> Forgot your password? </a>

            </table>
            </div>
          
        </section>

    </main>

<?php
    require "footer.php";
?>