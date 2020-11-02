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
            </div> 
        <div>
    </div>

<?php 
    /////////   GESTIONE MESSAGGI   ///////
    if(isset($_GET['error'])){
        $message = mysqli_real_escape_string($connessione, $_GET['error']);
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
        }if($message == "Usernametaken"){     ?>
            
          <div class="alert alert-danger" role="alert">
            This username it's been already taken from another user. Try with another one.
          </div>
<?php             
        }

    }
?>

 <!-- Main content -->
<div class="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-primary card-outline">

                    <div class="card-header">
                        <h5 class="card-title m-0">Register your datas</h5>
                    </div>

                    <div class="card-body">
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
                              <td></td>
                              <td><button class="btn btn-link"><a href="reset_password.php" > Forgot your password? </a></button></td>
                            </tr>
                            <tr>
                              <td><input type="submit" class="btn text-white" style="background-color: #5401a7;" value="Send your datas"></td>
                            </tr>

                          </form>
                          <?php
                              if(isset($_GET['newpass'])){
                                  if($_GET['newpass'] == "passwordupdated"){
                                    echo '<p class="signupsuccess"> Your password has benn updated </p>';
                                  }
                              }
                          ?>
                          

                        </table>
                    </div> <!--.\ card-body -->
                  <div> <!--.\ card -->
                </div>  <!--.\ col -->
              </div>  <!--.\ row -->
            </div> <!--.\ content -->
          </div>  <!--.\ container -->
        </section>

    </main>

<br><br><br>

<?php
    require "footer.php";
?>