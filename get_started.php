<?php
    require "header.php";
?>


    <main>

    <div class="content-wrapper">
            <div class="content-header">
                <div class="container">
                  <div class="row mb-3">
                      <div class="col-sm-6">
                      <h1 class="m-0 text-dark">Iniziamo!</h1>
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
                    Nessun username o password sono stati inseriti
                </div>
            
<?php   }
        if($message == "invalidemailusername"){    ?>
            
                <div class="alert alert-danger" role="alert">
                Non sono ammessi caratteri speciali nel nome utente. Questo Username non è consentito.
                </div>
            
<?php   }
        if($message == "invalidemail"){     ?>
            
                <div class="alert alert-danger" role="alert">
                  Questa Email non è ammessa.
                </div>
<?php   }
        if($message == "invalidusername"){     ?>
            
                <div class="alert alert-danger" role="alert">
                  Questo Username non è consentito.
                </div>
<?php   }
        if($message == "passwordcheck"){     ?>
            
                <div class="alert alert-danger" role="alert">
                  Le due password sono diverse.
                </div>
<?php             
        }if($message == "Usernametaken"){     ?>
            
          <div class="alert alert-danger" role="alert">
            Questo Username è già stato preso da un altro utente. Prova con un altro.
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
                        <h5 class="card-title m-0">Registra i tuoi dati</h5>
                    </div>

                    <div class="card-body">
                      <div class="row justify-content-center" class="form-group">
                      <table>
                          <form method="POST" action="php/insert.php">
                            <tr>
                              <td>Nome</td>
                              <td><input type="text" class="form-control" name="nome" placeholder="Name"></td>
                            </tr>
                            <tr>
                              <td>Email</td>
                              <td><input type="text" class="form-control" name="email" placeholder="Email"></td>
                            </tr>
                            <tr>
                              <td>Username</td>
                              <td><input type="text" class="form-control" name="username" placeholder="Scegli un nome utente"></td>
                            </tr>
                            <tr>
                              <td>Password</td>
                              <td><input type="password" class="form-control" name="password" placeholder="Password"></td>
                            </tr>
                            <tr>
                              <td>Ripeti la Password</td>
                              <td><input type="password" class="form-control" name="pass2" placeholder="Ripeti la password"></td>
                            </tr>
                            <tr>
                              <td></td>
                              <td><button class="btn btn-link"><a href="reset_password.php" > Hai dimenticato la tua password? </a></button></td>
                            </tr>
                            <tr>
                              <td><input type="submit" class="btn text-white" style="background-color: #5401a7;" value="Invia i tuoi dati"></td>
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