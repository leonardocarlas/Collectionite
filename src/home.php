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
    <p>Crea il tuo album. Inserisci le carte. Tieni i prezzi aggiornati.</p>
</div>

<br>
    
<div class = "row justify-content-center">

    <nav class="navbar navbar-expand-lg" style = "background:transparent; background-color:transparent;">
    
        <ul class="navbar-nav">
            <li class="nav-item">
                <img src="immagini/magic_logo.png"  onClick = <?php if(isset($_SESSION['idusersession'])){ echo "return_albums(1)"; } else { echo "advise_login()" ;} ?> 
                    style=" cursor: pointer;
                            display: block;
                            max-width:100px;
                            max-height:100px;
                            width: auto;
                            height: auto;" 
                >
            </li>
        </ul>

        <ul class="navbar-nav">
            <li class="nav-item">
                <img src="immagini/pokemon_logo.png" onClick = <?php if(isset($_SESSION['idusersession'])){ echo "return_albums(6)"; } else { echo "advise_login()" ;}?> 
                    style=" cursor: pointer;
                            display: block;
                            max-width:100px;
                            max-height:100px;
                            width: auto;
                            height: auto;"
                >
            </li>
        </ul>

        <ul class="navbar-nav">
            <li class="nav-item">
                <img src="immagini/ygo_logo.png" onClick = <?php if(isset($_SESSION['idusersession'])){ echo "return_albums(3)"; } else { echo "advise_login()" ;}?>   style=" cursor: pointer;
                            display: block;
                            max-width:100px;
                            max-height:100px;
                            width: auto;
                            height: auto;">
            </li>
        </ul>
        
        <!--
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <img src="immagini/fow_logo.png"  onClick = <?php if(isset($_SESSION['idusersession'])){ echo "return_albums(7)"; } else { echo "advise_login()" ;}?>  
                     style="cursor: pointer; 
                            display: block;
                            max-width:100px;
                            max-height:100px;
                            width: auto;
                            height: auto;" 
                    >
                </li>
                <li class="nav-item">
                    <img src="immagini/vanguard_logo.png" onClick = <?php if(isset($_SESSION['idusersession'])){ echo "return_albums(8)"; } else { echo "advise_login()" ;}?>    style=" cursor: pointer;
                            display: block;
                            max-width:100px;
                            max-height:100px;
                            width: auto;
                            height: auto;">
                </li>
                <li class="nav-item">
                    <img src="immagini/ff_logo.png"   onClick = <?php if(isset($_SESSION['idusersession'])){ echo "return_albums(9)"; } else { echo "advise_login()" ;}?>    style=" cursor: pointer;
                            display: block;
                            max-width:100px;
                            max-height:100px;
                            width: auto;
                            height: auto;">
                </li>
                <li class="nav-item">
                    <img src="immagini/starwars_logo.png" onClick = <?php if(isset($_SESSION['idusersession'])){ echo "return_albums(15)"; } else { echo "advise_login()" ;}?>   style=" cursor: pointer;
                            display: block;
                            max-width:100px;
                            max-height:100px;
                            width: auto;
                            height: auto;">
                </li>
                <li class="nav-item">
                    <img src="immagini/dbs_logo.png" onClick = <?php if(isset($_SESSION['idusersession'])){ echo "return_albums(13)"; } else { echo "advise_login()" ;}?>   style=" cursor: pointer;
                            display: block;
                            max-width:100px;
                            max-height:100px;
                            width: auto;
                            height: auto;">
                </li>
                <li class="nav-item">
                    <img src="immagini/dragoborne_logo.png" onClick = <?php if(isset($_SESSION['idusersession'])){ echo "return_albums(11)"; } else { echo "advise_login()" ;}?>   style=" cursor: pointer;
                            display: block;
                            max-width:100px;
                            max-height:100px;
                            width: auto;
                            height: auto;">
                </li>
                <li class="nav-item">
                    <img src="immagini/wow_logo.png" onClick = <?php if(isset($_SESSION['idusersession'])){ echo "return_albums(2)"; } else { echo "advise_login()" ;}?>   style=" cursor: pointer;
                            display: block;
                            max-width:100px;
                            max-height:100px;
                            width: auto;
                            height: auto;">
                </li>
                <li class="nav-item">
                    <img src="immagini/spoils_logo.png" onClick = <?php if(isset($_SESSION['idusersession'])){ echo "return_albums(5)"; } else { echo "advise_login()" ;}?>   style=" cursor: pointer;
                            display: block;
                            max-width:100px;
                            max-height:100px;
                            width: auto;
                            height: auto;">
                </li>
                <li class="nav-item">
                    <img src="immagini/ws_logo.png" onClick = <?php if(isset($_SESSION['idusersession'])){ echo "return_albums(10)"; } else { echo "advise_login()" ;}?>   style=" cursor: pointer;
                            display: block;
                            max-width:100px;
                            max-height:100px;
                            width: auto;
                            height: auto;"
                            >
                </li>
            </ul>
        </div>
-->
    </nav>

</div>

      
<!-- In questo div vengono ritornati gli album a seconda della collezione selezionata -->
<div id = "album_ritornati">


</div>


<br><br><br><br><br><br><br><br><br>


<?php
    require "footer.php";
?>




<script type ="text/javascript">
    window.onload = function() {
        return_albums(1);
    };
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
                ).then((result) => {
                        window.location.href = 'get_started.php?Action=Register';
                    });
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

