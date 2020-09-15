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

                <p class="card-text">Our application is directly linked to the server of <a href="https://www.cardmarket.com/">https://www.cardmarket.com/</a>.
                <p>What can you do with Dragon Collection?</p>
                        <text>
                        First of all, you can create a virtual album where you can put the cards that you possess in real life time.
                        The types of TCGs that are supported by our site are 13:
                        </text>
                        
                        <p>Magic: The Gathering, Yu-gi-oh!, Pokémon, Force of Will, Vanguard, World of Warcraft TCG, Star Wars: Destiny, My Little Pony CCG, Dragon Ball Cardgame, The Spoils, Final Fantasy TCG and Weibb Swharz.</p>
                        <text>
                        For all this cards, our site will be able to connect to the servers of cardmarket.com, access to the datas of the cards
                        and retrieve for you some useful informations like: </text>
                        <ul>
                            <li> minimum price  </li>
                            <li> trend price    </li>
                            <li> an evalution price based on 2 features, the condition and the language of the card, using the selling prices of the users of cardmarket.  </li>
                        </ul>
                        <text>
                        You can also share your collections with your friends.
                        <br>
                        For the first month the use of this platform is free. To mantain your data for a long time (life-long), 
                        you only need to pay 2€. After that, your account will be mantained forever in our databases.
                        Try yourself for the first month and enjoy.
                        <br><br><br><br>
                        The Team of Dragon Collection.
                        </text>
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



