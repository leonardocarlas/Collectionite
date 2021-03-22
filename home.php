<?php
    require "header.php";
    
    if (isset($_SESSION['idcollezione'])){
        $id_collection = $_SESSION['idcollezione'];
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
                    <button class="nav-link btn_load_screen" onClick = <?php echo "return_albums(1," . $id_user . ")"; ?>  type="button" class="btn btn-outline-primary" >Magic: The Gathering</button>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <button class="nav-link btn_load_screen" onClick = <?php echo "return_albums(6," . $id_user . ")";?>  type="button" class="btn btn-outline-primary"> Pokémon </button>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <button class="nav-link btn_load_screen" onClick = <?php echo "return_albums(3," . $id_user . ")";?>  type="button" class="btn btn-outline-primary">Yu-gi-oh!</button>
                </li>
            </ul>
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <button class="nav-link btn_load_screen" onClick = <?php echo "return_albums(7," . $id_user . ")";?>  type="button" class="btn btn-outline-primary">Force of Will</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link btn_load_screen" onClick = <?php echo "return_albums(8," . $id_user . ")";?>  type="button" class="btn btn-outline-primary">Cardfight! Vanguard</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link btn_load_screen" onClick = <?php echo "return_albums(9," . $id_user . ")";?>  type="button" class="btn btn-outline-primary">Final Fantasy</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link btn_load_screen" onClick = <?php echo "return_albums(15," . $id_user . ")";?>  type="button" class="btn btn-outline-primary">Star Wars</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link btn_load_screen" onClick = <?php echo "return_albums(13," . $id_user . ")";?>  type="button" class="btn btn-outline-primary">Dragonball Super</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link btn_load_screen" onClick = <?php echo "return_albums(11," . $id_user . ")";?>  type="button" class="btn btn-outline-primary">Dragoborne</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link btn_load_screen" onClick = <?php echo "return_albums(2," . $id_user . ")";?>  type="button" class="btn btn-outline-primary">World of Warcraft</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link btn_load_screen" onClick = <?php echo "return_albums(5," . $id_user . ")";?>  type="button" class="btn btn-outline-primary">The Spoils</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link btn_load_screen" onClick = <?php echo "return_albums(10," . $id_user . ")";?>  type="button" class="btn btn-outline-primary">Weiss Schwarz</button>
                    </li>
                    <!--
                    <li class="nav-item">
                    <button class="nav-link btn_load_screen" onClick = <?php // echo "return_albums(12," . $id_user . ")";?> type="button" class="btn btn-outline-primary"> My Little Pony </button>
                    </li>
                    -->
                </ul>
            </div>
        </nav>


      
<!-- in questo div vengono ritornati gli album a seconda della collezione selezionata -->
<div id = "album_ritornati">



</div>






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





