<?php
    require "header.php";
    $col_selected = $_SESSION['collezione-selezionata'];
    $id_user = $_SESSION['idusersession'];
?>



<?php 

    if(isset($_GET['DELETED'])){ ?>
    <script type="text/javascript">
        Swal.fire(
        'Album Eliminato!',
        '',
        'success'
        );
    </script>
<?php } ?>

<?php 
    if(isset($_GET['MODIFIED'])){ ?>
    <script type="text/javascript">
        Swal.fire(
        'Questo album è stato modificato correttamente',
        '',
        'success'
        );
    </script>

<?php } ?>

<?php 
    if(isset($_GET['error'])){ 
        $error = $_GET['error'];
        if($error == "nocolletionsel"){  ?>
        <script type="text/javascript">
            Swal.fire(
            'Errore nel database, contatta l\'assistenza',
            '',
            'error'
            );
        </script>
<?php }} ?>

<br>


        
        <div class = "row justify-content-center">
            <h1>My Collection</h1>
        </div>
            
        <div class = "row justify-content-center">
            <p>Qui sullo sfondo ci metto un disegno</p>
        </div>

        <br>
        
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    
                    <button class="nav-link btn_load_screen" onClick = <?php echo "return_albums(1," . $id_user . ")";?>  >Magic: The Gathering</button>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link btn_load_screen">Pokémon</a>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link btn_load_screen">Yu-gi-oh!</a>
                </li>
            </ul>
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Force of Will</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Cardfight! Vanguard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Final Fantasy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Star Wars</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Dragonball Z</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Dragoborne</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">World of Warcraft</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">The Spoils</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Weib Schwarz</a>
                    </li>
                    <li class="nav-item">
                    <button class="nav-link btn_load_screen" onClick = <?php echo "return_albums(13," . $id_user . ")";?> > My Little Pony </button>
                    </li>
                </ul>
            </div>
        </nav>


      

<div id = "album_ritornati">

</div>





















        <!--
        <div class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Prima di tutto, seleziona un tipo di Collezione</h3>
                    </div>
                    
                   
                    <form method="POST" action="php/get_albums.php" role="form">
                        <div class="card-body">
                        <div class="form-group" data-children-count="1">
                        <select name="collection-type" class="form-control">
                            <option>--Choose the collection--</option>
                            <option>Pokemon</option>
                            <option>Yu-gi-oh!</option>
                            <option>Magic: The Gathering</option>
                            <option>Vanguard</option>
                            <option>Force of Will</option>
                            <option>World of Warcraft TCG</option>
                            <option>Star Wars: Destiny</option>
                            <option>Dragoborne</option>
                            <option>My Little Pony CCG</option>
                            <option>Dragon Ball Cardgame</option>
                            <option>WeiB Swharz</option>
                            <option>The Spoils</option>
                            <option>Final Fantasy TCG</option>
                            </select>
                        </div>
                        </div>
                        

                        <div class="card-footer">
                            <button class="btn text-white" style="background-color: #5401a7;" type="submit" name="selected-collection">Conferma</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        -->

<!-- 
        <div class="row justify-content-center mt-5">
            <div class="col-10">
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">Titolo</h3>
                    </div>
                    
                    <div class="card-body">
                    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="example2" class="table table-bordered table-hover dataTable" role="grid">
                                    <thead>
                                        <tr role="row">
                                            <th>Album</th>
                                            <th>Azione</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                   
                                        <tr role="row" class="even">
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>




                <div class="content-wrapper">
                <div class="content-header">
                    <div class="container">
                    <div class="row mb-3">
                        <div class="col-sm-6">
                        <h1 class="m-0 text-dark"> Tipo di collezione: '. $name_collection .'</h1>
                        </div> 
                    </div>
                    <div class="row mb-5">
                        <form method="POST" action="php/change_collection.php">
                            <button class="btn text-white" style="background-color: #5401a7;" type="submit" name="change-collection">Cambia Collezione</button> 
                        </form>
                    </div>
                    </div>
                </div>
            
-->


<br><br><br><br><br><br><br><br><br>


<?php
    require "footer.php";
?>


<script type ="text/javascript">
    //data è echo
    function return_albums(id_collection, id_user){
        $.post("php/return_albums.php",{"collezione":id_collection, "user":id_user},function(data){
            $("#album_ritornati").html(data);
            });
    }

</script>


<?php

function get_albums($id_user, $id_collection) {

    require "php/dbh.php";
    $array_album = array();
    $sql = "SELECT Album_name, Idalbum FROM album WHERE Iduser=? AND Idcollection=? ; ";
    $stmt = mysqli_stmt_init($connessione);
    if(!mysqli_stmt_prepare($stmt, $sql)){
    echo "Error in the database";
    }
    else{
    mysqli_stmt_bind_param($stmt, "ii", $id_user, $idcollection);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt); 

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
         
            echo ' Album : '. $row['Album_name'].' ID : '.$row['Idalbum']. '<br>';
            array_push($array_album,  $row['Album_name']);
            array_push($array_album,  $row['Idalbum']);
        }
        return $array_album; 
    } else {
        array_push($array_album,  "NO ALBUM");
        return $array_album;
    }

    }
    mysqli_stmt_close($stmt);
    mysqli_close($connessione);

}

function get_new_url () {

}