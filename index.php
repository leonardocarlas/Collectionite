<?php
    require "header.php";

    $_SESSION['collezione-selezionata'] = false;
    $_SESSION['album_corrente'] = NULL;

?>

<?php 
    /////////   GESTIONE MESSAGGI   ///////
    if(isset($_GET['error'])){
        $message = $_GET['error'];
        if($message == "emptyfields"){  ?>
            
                <div class="alert alert-danger" role="alert">
                    No username or password have been inserted
                </div>
            
<?php   }
        if($message == "nouserinthedatabase"){    ?>
            
                <div class="alert alert-danger" role="alert">
                    No username like this is registered
                </div>
            
<?php   }
        if($message == "wrongpassword"){     ?>
            
                <div class="alert alert-danger" role="alert">
                    Wrong password
                </div>
<?php             
        }

    }
    if(isset($_GET['SIGNUP'])){  ?>
        <div class="alert alert-success" role="alert">
            This is a success alert—check it out!
        </div>

<?php }?>


<div class="content-wrapper" style="min-height: 636.763px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-5">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Welcome to Dragon Collection!</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
      <div class="row">
      <a href="get_started.php" class="btn btn-primary btn-lg mx-auto d-block mb-5">Get started</a>
        <?php
                    
            if(isset($_SESSION['usernamesession'])){
                $username=$_SESSION['usernamesession'];

                echo ' <a class="btn btn-primary btn-lg mx-auto d-block mb-5" href="home.php">My Collection</a>
                      ';
                    
            }else{
                echo '' ;
            }
        ?>
        </div>

        <div class="row mb-5">
        </div>
        <div class="row">
          <div class="col-7">  
          <div class="card card-primary card-outline">
                <div class="card-header">
                <h5 class="card-title m-0">What is Dragon Collection</h5>
                </div>
                <div class="card-body">

                <p class="card-text">Dragon collection is directly linked to the server of <a href="https://www.cardmarket.com/">https://www.cardmarket.com/</a>.
            The main function of our application is to create a place where an user can evaluate the value of its cards collection. To that, a user can save its card and organize them using some virtual album.
            To insert a card into an album the user needs to insert the set's and the card's name to activate the process of research of the value on Card Market.The datas of the card will be stored into our database so when the user wants to know the actual value of it’s collection, or its album he will be able to know the current value of each card.</p>
                </div>
            </div>
          </div>
          <div class="col-1">
          </div>
          <div class="col-md-2">
              <img class="img-thumbnail" src="immagini/card.jpg">
              </div>
            
            <div class="col-md-2">
              <img class="img-thumbnail" src="immagini/img2.jpg">
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>

<?php
    require "footer.php";
?>



