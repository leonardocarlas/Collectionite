<?php 
    require 'header.php';
?>
    
    <div class = "row justify-content-center">
        <h1>Redd Sight</h1>
    </div>

    <br>

    <div class = "row justify-content-center">

        <nav class="navbar navbar-expand-lg" style = "background:transparent; background-color:transparent;">
        
            <ul class="navbar-nav">
                <li class="nav-item">
                    <img src="immagini/magic_logo.png"  onClick = "return_posts(1)" width="90" height="40" style="cursor: pointer;" >
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <img src="immagini/pokemon_logo.png" onClick = "return_posts(6)" width="90" height="40" style="cursor: pointer;" >
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <img src="immagini/ygo_logo.png" onClick = "return_posts(3)" width="90" height="40" style="cursor: pointer;" >
                </li>
            </ul>
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <img src="immagini/fow_logo.png"  onClick = "return_posts(7)" width="90" height="40" style="cursor: pointer;" >
                    </li>
                    <li class="nav-item">
                        <img src="immagini/vanguard_logo.png" onClick = "return_posts(8)"   width="90" height="40" style="cursor: pointer;" >
                    </li>
                    <li class="nav-item">
                        <img src="immagini/ff_logo.png"   onClick = "return_posts(9)"  width="90" height="40" style="cursor: pointer;" >
                    </li>
                    <li class="nav-item">
                        <img src="immagini/starwars_logo.png" onClick = "return_posts(15)"  width="90" height="40" style="cursor: pointer;" >
                    </li>
                    <li class="nav-item">
                        <img src="immagini/dbs_logo.png" onClick = "return_posts(13)"  width="90" height="40" style="cursor: pointer;" >
                    </li>
                    <li class="nav-item">
                        <img src="immagini/dragoborne_logo.png" onClick = "return_posts(11)" width="90" height="40" style="cursor: pointer;" >
                    </li>
                    <li class="nav-item">
                        <img src="immagini/wow_logo.png" onClick = "return_posts(2)" width="90" height="40" style="cursor: pointer;" >
                    </li>
                    <li class="nav-item">
                        <img src="immagini/spoils_logo.png" onClick = "return_posts(5)" width="90" height="40" style="cursor: pointer;" >
                    </li>
                    <li class="nav-item">
                        <img src="immagini/ws_logo.png" onClick = "return_posts(10)" width="90" height="40" style="cursor: pointer;" >
                    </li>
                </ul>
            </div>
        </nav>

    </div>

    <br>

    <div class = "row justify-content-center">
        <button type="button" class="btn m-2 text-white" style="background-color: #5401a7;"  data-toggle="modal" data-target="#modal1">Crea un Post</button>
    </div>

    <br>


    <!-- Modal -->
    <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Limite versione beta</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <text>In questa versione di sviluppo non è ancora possibile creare dei post all'interno del sito. <br> Se vorrai farlo potrai andare al sito www.reddit.com e creare un post lì.</text> 
        </div>
        <div class="modal-footer">
            <button type="button"  class="btn m-2 text-white" style="background-color: #5401a7;" data-dismiss="modal">Ho capito</button>
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
        </div>
        </div>
    </div>
    </div>













    <div id = "posts"> 
    </div>




<br><br><br><br><br><br><br><br>
<?php require "footer.php"; ?>







<script type ="text/javascript">
    
    window.onload = function() {
        return_posts(1);
    };

    function return_posts(id_collection){
        $.post("php/CRUD_reddsight.php",{"collezione":id_collection},function(data){
            $("#posts").html(data);
            });
    }
    
</script>