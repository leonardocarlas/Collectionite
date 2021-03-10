<?php
    require "header.php";
    if (isset($_SESSION['idcollezione'])){
        $col_selected = $_SESSION['idcollezione'];
        echo "Collezione id: ". $col_selected;
    }
    
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
                    <button class="nav-link btn_load_screen" onClick = <?php echo "return_albums(1," . $id_user . ")"; ?>  >Magic: The Gathering</button>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <button class="nav-link btn_load_screen" onClick = <?php echo "return_albums(6," . $id_user . ")";?>  > Pokémon </button>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <button class="nav-link btn_load_screen" onClick = <?php echo "return_albums(3," . $id_user . ")";?>  >Yu-gi-oh!</button>
                </li>
            </ul>
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <button class="nav-link btn_load_screen" onClick = <?php echo "return_albums(7," . $id_user . ")";?>  >Force of Will</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link btn_load_screen" onClick = <?php echo "return_albums(8," . $id_user . ")";?>  >Cardfight! Vanguard</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link btn_load_screen" onClick = <?php echo "return_albums(9," . $id_user . ")";?>  >Final Fantasy</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link btn_load_screen" onClick = <?php echo "return_albums(15," . $id_user . ")";?>  >Star Wars</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link btn_load_screen" onClick = <?php echo "return_albums(13," . $id_user . ")";?>  >Dragonball Super</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link btn_load_screen" onClick = <?php echo "return_albums(11," . $id_user . ")";?>  >Dragoborne</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link btn_load_screen" onClick = <?php echo "return_albums(2," . $id_user . ")";?>  >World of Warcraft</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link btn_load_screen" onClick = <?php echo "return_albums(5," . $id_user . ")";?>  >The Spoils</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link btn_load_screen" onClick = <?php echo "return_albums(10," . $id_user . ")";?>  >Weiss Schwarz</button>
                    </li>
                    <li class="nav-item">
                    <button class="nav-link btn_load_screen" onClick = <?php echo "return_albums(12," . $id_user . ")";?> > My Little Pony </button>
                    </li>
                </ul>
            </div>
        </nav>


      
<!-- in questo div vengono ritornati gli album a seconda della collezione selezionata -->
<div id = "album_ritornati">



</div>



<?php
/*   
    if(isset($_GET['Edit'])){
        $album_to_edit = $_GET['Edit'];
        $id = $_GET['ID'];
        

        echo'  
        
        <div class="row justify-content-center"> 
            <form method="POST" action="php/albuminsert.php?E='.$id .'" class="form-inline">
                <div class="form-group">
                    <label for="old_album_name">Modifica il titolo dell\'album</label>
                </div>
                <div class="form-group mx-sm-3">
                    <input type="text" class="form-control" name="old_album_name"  value='.$album_to_edit.'>
                </div>
                <input type="submit" class="btn btn-info" name="update_album" value="Aggiorna" >
            </form>
        </div>
        
        ';
    }
*/
?>





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
