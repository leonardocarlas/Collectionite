<?php
    require "header.php";
    
    if (isset($_SESSION['idcollezione'])){
        $id_collection = $_SESSION['idcollezione'];
    }
    if (isset($_SESSION['idusersession'])){
        $id_user = $_SESSION['idusersession'];
    }


?>


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
                    <button class="nav-link btn_load_screen" onClick = <?php if(isset($_SESSION['idusersession'])){ echo "return_albums(1)"; } else { echo "advise_login()" ;} ?>  type="button" class="btn btn-outline-primary" >Magic: The Gathering</button>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <button class="nav-link btn_load_screen" onClick = <?php if(isset($_SESSION['idusersession'])){ echo "return_albums(6)"; } else { echo "advise_login()" ;}?>  type="button" class="btn btn-outline-primary"> Pokémon </button>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <button class="nav-link btn_load_screen" onClick = <?php if(isset($_SESSION['idusersession'])){ echo "return_albums(3)"; } else { echo "advise_login()" ;}?>  type="button" class="btn btn-outline-primary">Yu-gi-oh!</button>
                </li>
            </ul>
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <button class="nav-link btn_load_screen" onClick = <?php if(isset($_SESSION['idusersession'])){ echo "return_albums(7)"; } else { echo "advise_login()" ;}?>  type="button" class="btn btn-outline-primary">Force of Will</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link btn_load_screen" onClick = <?php if(isset($_SESSION['idusersession'])){ echo "return_albums(8)"; } else { echo "advise_login()" ;}?>  type="button" class="btn btn-outline-primary">Cardfight! Vanguard</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link btn_load_screen" onClick = <?php if(isset($_SESSION['idusersession'])){ echo "return_albums(9)"; } else { echo "advise_login()" ;}?>  type="button" class="btn btn-outline-primary">Final Fantasy</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link btn_load_screen" onClick = <?php if(isset($_SESSION['idusersession'])){ echo "return_albums(15)"; } else { echo "advise_login()" ;}?>  type="button" class="btn btn-outline-primary">Star Wars</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link btn_load_screen" onClick = <?php if(isset($_SESSION['idusersession'])){ echo "return_albums(13)"; } else { echo "advise_login()" ;}?>  type="button" class="btn btn-outline-primary">Dragonball Super</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link btn_load_screen" onClick = <?php if(isset($_SESSION['idusersession'])){ echo "return_albums(11)"; } else { echo "advise_login()" ;}?>  type="button" class="btn btn-outline-primary">Dragoborne</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link btn_load_screen" onClick = <?php if(isset($_SESSION['idusersession'])){ echo "return_albums(2)"; } else { echo "advise_login()" ;}?>  type="button" class="btn btn-outline-primary">World of Warcraft</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link btn_load_screen" onClick = <?php if(isset($_SESSION['idusersession'])){ echo "return_albums(5)"; } else { echo "advise_login()" ;}?>  type="button" class="btn btn-outline-primary">The Spoils</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link btn_load_screen" onClick = <?php if(isset($_SESSION['idusersession'])){ echo "return_albums(10)"; } else { echo "advise_login()" ;}?>  type="button" class="btn btn-outline-primary">Weiss Schwarz</button>
                    </li>
                    <!--
                    <li class="nav-item">
                    <button class="nav-link btn_load_screen" onClick = <?php // echo "return_albums(12)";?> type="button" class="btn btn-outline-primary"> My Little Pony </button>
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
    function return_albums(id_collection){
        $.post("php/return_albums.php",{"collezione":id_collection},function(data){
            $("#album_ritornati").html(data);
            });
    }
</script>


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



    <script type="text/javascript">
        function advise_login(){
                Swal.fire(
                'Prima di creare un album devi registrarti!',
                '',
                'success'
                );
        }
    </script>


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



