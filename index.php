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
                    Username o password non sono stati inseriti.
                </div>
            
<?php   }
        if($message == "nouserinthedatabase"){    ?>
            
                <div class="alert alert-danger" role="alert">
                    Username inesistente.
                </div>
            
<?php   }
        if($message == "wrongpassword"){     ?>
            
                <div class="alert alert-danger" role="alert">
                    Password errata.
                </div>
<?php             
        }

    }
    if(isset($_GET['SIGNUP'])){  ?>
        <div class="alert alert-success" role="alert">
            This is a success alert—check it out!
        </div>

<?php }?>


    <!-- SPOSTARE DI POSIZIONE        
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
    </div>row -->
    <!-- RICORDARSI DEL SEARCH ---->


<div class="content-wrapper" style="min-height: 636.763px;">

  <!-- Introduction -->
  <div style="background-color: #5401a7;">

      <!-- Content Header (Page header) -->
      
      <div class="row justify-content-center">
        <div class="col-sm-auto">
          <br>
          <h1 class="m-0 text-white mt-2">Benvenuto su Collection Sight!</h1>
        </div>
      </div><!-- row -->

      <br><br>
      
      <div class="row justify-content-center">
        <div class="col-sm-auto">
          <h4 class="text-white"><b>Tracciamo per te i prezzi della tua collezione di carte.</b></h4>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-sm-auto">
          <p class="text-white">Con 13 tipi di TCG disponibili, il nostro database di carte è direttamente collegato a quello di CardMarket.</p>
        </div>            
      </div>

      <br>

      <div class="row">
        <a href="get_started.php" style="background-color: #FFFFFF;"class="btn text-dark btn-lg mx-auto d-block mb-5">Inizia</a>
            <?php
                        
                if(isset($_SESSION['usernamesession'])){
                    $username=$_SESSION['usernamesession'];

                    echo ' <a class="btn text-dark btn-lg mx-auto d-block mb-5" style="background-color: #FFFFFF;" href="home.php">My Collection</a>
                          ';
                        
                }else{
                    echo '' ;
                }
            ?>
      </div>

</div> <!-- row -->
  <!-- fine introduction --->



<br><br>
    <!-- Main content -->
    <div class="content">
      <div class="container">

        <!-- SLIDER DI IMMAGINI -->
        <div class="row justify-content-center">
          <div class="col-sm-10">
            <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active" data-interval="4000">
                  <img src="immagini/alltcg.png" class="d-block w-100" alt="...">
                  
                </div>
                <div class="carousel-item" data-interval="3000">
                  <img src="immagini/logocollection.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item" data-interval="4000">
                  <img src="immagini/logocardmarket.png" class="d-block w-100" alt="...">
                  <div class="carousel-caption d-none d-md-block">
                    <h5 class="text-dark">Siamo in collaborazione con CardMarket</h5>
                    <p class="text-dark">Abbiamo il loro supporto al nostro progetto</p>
                  </div>
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

        <br><br><br>


        <div class="card-group">
          <div class="card">
            <img class="card-img-top" src="immagini/album.png" alt="Card image cap" width="297" height="180">
            <div class="card-body">
              <h5 class="card-title"><b>Crea il tuo Album virtuale</b></h5>
              <p class="card-text">Un album virtuale ti permette di inserirvi all'interno tutte le carte che possiedi nella realtà, salvando i parametri che la distinguono: nome della carta, nome del set, lingua, condizioni e valori</p>
            </div>
          </div>
          <div class="card">
            <img class="card-img-top" src="immagini/zard.png" alt="Card image cap"  width="297" height="180">
            <div class="card-body">
              <h5 class="card-title"><b>Mantieni aggiornati i prezzi delle carte</b></h5>
              <p class="card-text">Utilizzando lo strumento apposito, i prezzi delle tue carte verranno aggiornati al secondo, facendo una richiesta direttamente al server di CardMarket.</p>
            </div>
          </div>
          <div class="card">
            <img class="card-img-top" src="immagini/graph.png" alt="Card image cap" width="297" height="180">
            <div class="card-body">
              <h5 class="card-title"><b>Tieni tracciati i prezzi delle carte nel tempo</b></h5>
              <p class="card-text">Nel nostro sito è presente un'opzione per creare un grafico che tenga tracciato due parametri: il prezzo minimo dell'album ed il suo prezzo di tendenza. Questi due valori sono in grado di descrivere l'andamento dei prezzi della tua collezione.</p>
            </div>
          </div>
        </div>

        <br><br><br>

        <div class="row mb-5">
        </div>
        <div class="row">
          <div class="col">  
          <div class="card card-primary card-outline">
                <div class="card-header">
                <h5 class="card-title m-0">Cos'è Collection Sight?</h5>
                </div>
                <div class="card-body">

                <p class="card-text">La nostra applicazione è direttamente collegata al server di CardMarket: <a href="https://www.cardmarket.com/">https://www.cardmarket.com/</a>. Abbiamo il loro supporto al nostro progetto.
                <p>Cosa puoi fare con Collection Sight?</p>
                        <text>
                        In primo luogo, puoi creare un album virtuale in cui inserire le stesse carte che possiedi nella tua vera collezione a casa. I tipi di TCG supportati dal nostro sito sono 13:
                        </text>
                        
                        <p>Magic: The Gathering, Yu-gi-oh!, Pokémon, Force of Will, Vanguard, World of Warcraft TCG, Star Wars: Destiny, My Little Pony CCG, Dragon Ball Cardgame, The Spoils, Final Fantasy TCG and Weiß Schwarz.</p>
                        <text>
                        Per tutte le carte, il nostro sito sarà in grado di connettersi ai server di cardmarket.com, accedere ai dati delle carte
                        e recuperare alcune informazioni molto utili come: </text>
                        <ul>
                            <li><b> prezzo minimo</b>;  </li>
                            <li><b> prezzo di tendenza</b>;  </li>
                            <li><b> prezzo di valutazione basato su due caratteristiche</b>, la <b>condizione</b> e la <b>lingua della carta</b>, facendo poi la media delle prime cinque inserzioni degli utenti di carmarket con quelle esatte caratteristiche della carta.  </li>
                        </ul>
                        <text>
                        Inoltre, puoi condividire i tuoi album con i tuoi amici o compratori semplicemente dicendo loro il tuo username.
                        <br>
                        Collection Sight è stato un progetto sviluppato in diversi mesi da due studenti universitari, Leonardo e Thomas.
                        <br><br><br><br>
                        Il Team di Collection Sight.
                        </text>
                </div>
            </div>
          </div>
          </div>
                
          <br><br><br>
                
          <div class="card mb-3">
            <img class="card-img-top" src="immagini/news.png" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">News e aggiornamenti</h5>
              <p class="card-text"><b>19/11/2020</b>: Nuovo re-styling del sito.</p>
              <p class="card-text"><b>4/11/2020</b>: Lancio ufficiale del sito.</p>
              <p class="card-text"><small class="text-muted">Ultimo aggiornamentoo 19/11/2020</small></p>
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