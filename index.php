<?php
    require "header.php";

    $_SESSION['collezione-selezionata'] = false;
    $_SESSION['album_corrente'] = NULL;

?>

<?php 
    /////////   GESTIONE MESSAGGI   ///////
    if(isset($_GET['error'])){
        $message = mysqli_real_escape_string($connessione, $_GET['error']);
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

<br>

    <!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container">
    <div class="row align-items-start">
      <div class="col">
        <h1 class="m-0 text-dark"> Welcome to Collection Sight!</h1>
      </div>
    </div><!-- row -->
    <br>
    <div class="row ml-1">
      <div class="col-sm-6 ml-auto mr-3">
        <form action="search_page.php">
          <div class="input-group float-right">
            <input type="text" class="form-control" name="user-searched" placeholder="Enter the name of the user to see his collection" aria-label="User collection search item" aria-describedby="button-addon2">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit"  id="button-addon2">Search</button>
            </div>
          </div>
        </form>
      </div>
    </div><!-- row -->
  </div><!-- /.container -->
</div><!-- /.content-header -->


<br><br>
 

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
            <a href="get_started.php" style="background-color: #5401a7;" class="btn text-white btn-lg mx-auto d-block mb-5">Get started</a>
              <?php
                          
                  if(isset($_SESSION['usernamesession'])){
                      $username=$_SESSION['usernamesession'];

                      echo ' <a class="btn text-white btn-lg mx-auto d-block mb-5" style="background-color: #5401a7;" href="home.php">My Collection</a>
                            ';
                          
                  }else{
                      echo '' ;
                  }
              ?>
        </div>

        <!-- SLIDER DI IMMAGINI -->
        <div class="row justify-content-center">
          <div class="col-sm-10">
            <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active" data-interval="3000">
                  <img src="immagini/logocollection.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item" data-interval="4000">
                  <img src="immagini/logocardmarket.png" class="d-block w-100" alt="...">
                </div>
              

              </div>
              <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
          </div>
        </div>

        <div class="row mb-5">
        </div>
        <div class="row">
          <div class="col">  
          <div class="card card-primary card-outline">
                <div class="card-header">
                <h5 class="card-title m-0">What is Collection Sight?</h5>
                </div>
                <div class="card-body">

                <p class="card-text">Our application is directly linked to the server of <a href="https://www.cardmarket.com/">https://www.cardmarket.com/</a>. They support us in what we are doing.
                <p>What can you do with Collection Sight?</p>
                        <text>
                        First of all, you can create a virtual album where you can put the cards that you possess in real life time.
                        The types of TCGs that are supported by our site are 13:
                        </text>
                        
                        <p>Magic: The Gathering, Yu-gi-oh!, Pokémon, Force of Will, Vanguard, World of Warcraft TCG, Star Wars: Destiny, My Little Pony CCG, Dragon Ball Cardgame, The Spoils, Final Fantasy TCG and Weiß Schwarz.</p>
                        <text>
                        For all this cards, our site will be able to connect to the servers of cardmarket.com, access to the datas of the cards
                        and retrieve for you some useful informations like: </text>
                        <ul>
                            <li> minimum price;  </li>
                            <li> trend price;    </li>
                            <li> an evalution price based on 2 features, the condition and the language of the card, using the selling prices of the users of cardmarket.  </li>
                        </ul>
                        <text>
                        You can also share your collections with your friends.
                        <br>
                        For the first month the use of this platform is free. To mantain your data for a long time (life-long), 
                        you only need to pay 2.99 €. After that, your account will be mantained forever in our databases.
                        Try yourself for the first month and enjoy.
                        <br><br><br><br>
                        The Team of Collection Sight.
                        </text>
                </div>
            </div>
          </div>
          </div>

          <!--
          <div class="row justify-content-center">
            <div class="col-5">
                <img class="img-thumbnail" src="immagini/card.jpg">
            </div>
            <div class="col-5">
                <img class="img-thumbnail" src="immagini/img2.jpg">
            </div>
          </div>
          -->
          <!-- /.col-md-6 -->
        </div>
        <br><br>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>

<?php
    require "footer.php";
?>