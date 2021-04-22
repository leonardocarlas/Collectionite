<?php 
    require "header.php";
?>


<!--
<div class = "row justify-content-center">
    <img src = "immagini/most_wanted.png" alt = "Wanted List Logo" width = "400" height = "300">
</div>
-->
<div class = "row justify-content-center">
    <h1>Wanted List</h1>
</div>

<br>

<div class = "row justify-content-center">

    <nav class="navbar navbar-expand-lg" style = "background:transparent; background-color:transparent;">
    
        <ul class="navbar-nav">
            <li class="nav-item">
                <img src="immagini/magic_logo.png"  onClick = "return_wantedlist(1)" width="90" height="40" style="cursor: pointer;" >
            </li>
        </ul>

        <ul class="navbar-nav">
            <li class="nav-item">
                <img src="immagini/pokemon_logo.png" onClick = "return_wantedlist(6)" width="90" height="40" style="cursor: pointer;" >
            </li>
        </ul>

        <ul class="navbar-nav">
            <li class="nav-item">
                <img src="immagini/ygo_logo.png" onClick = "return_wantedlist(3)" width="90" height="40" style="cursor: pointer;" >
            </li>
        </ul>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <img src="immagini/fow_logo.png"  onClick = "return_wantedlist(7)" width="90" height="40" style="cursor: pointer;" >
                </li>
                <li class="nav-item">
                    <img src="immagini/vanguard_logo.png" onClick = "return_wantedlist(8)"   width="90" height="40" style="cursor: pointer;" >
                </li>
                <li class="nav-item">
                    <img src="immagini/ff_logo.png"   onClick = "return_wantedlist(9)"  width="90" height="40" style="cursor: pointer;" >
                </li>
                <li class="nav-item">
                    <img src="immagini/starwars_logo.png" onClick = "return_wantedlist(15)"  width="90" height="40" style="cursor: pointer;" >
                </li>
                <li class="nav-item">
                    <img src="immagini/dbs_logo.png" onClick = "return_wantedlist(13)"  width="90" height="40" style="cursor: pointer;" >
                </li>
                <li class="nav-item">
                    <img src="immagini/dragoborne_logo.png" onClick = "return_wantedlist(11)" width="90" height="40" style="cursor: pointer;" >
                </li>
                <li class="nav-item">
                    <img src="immagini/wow_logo.png" onClick = "return_wantedlist(2)" width="90" height="40" style="cursor: pointer;" >
                </li>
                <li class="nav-item">
                    <img src="immagini/spoils_logo.png" onClick = "return_wantedlist(5)" width="90" height="40" style="cursor: pointer;" >
                </li>
                <li class="nav-item">
                    <img src="immagini/ws_logo.png" onClick = "return_wantedlist(10)" width="90" height="40" style="cursor: pointer;" >
                </li>
                <!--
                <li class="nav-item">
                    <button class="nav-link text-white" onClick = <?php // echo "return_wantedlist(12)";?> type="button" class="btn btn-outline-primary"> My Little Pony </button>
                </li>
                -->
            </ul>
        </div>
    </nav>

</div>

<br>

<div class = "row justify-content-center">
    <h3>You a buyer?</h3>
</div>
<div class = "row justify-content-center">
    <a class="btn m-2 text-white" style="background-color: #5401a7;" href = "home.php?Advise-wanted-list">Post a Wanted List</a> 
</div>
<div class = "row justify-content-center">
    <h3>You an owner and want to buy?</h3>
</div>
<br>
<div class="row justify-content-center">
    <div class="col-sm-6">
        <form action="">
            <div class="input-group mb-3 float-right">

                <input type="text" name="card_searched" id="card_searched" class="form-control" placeholder="Inserisci il nome della carta che vuoi inserire" aria-label="User collection search item" aria-describedby="button-addon2">
                <div class="input-group-append">
                    <button onclick = "cerca_carta()" class="btn btn-outline-secondary" type="button" id="button-addon2">Cerca</button>
                </div>
                                
            </div>
        </form>  
    </div>
</div>

<div class="row justify-content-center">
    
        <div class="list-group" id="show-list">
            <!-- Here autocomplete list will be display -->
        </div>

</div>





<div id = "posting_wanted_list">


</div>
















<br><br><br>
<br><br><br><br>
<br><br><br><br>
<br><br><br><br>





















<?php 
    require "footer.php";
?>

<script type ="text/javascript">
    
    function return_wantedlist(id_collection){
        $.post("php/CRUD_wantedlist.php",{"collezione":id_collection},function(data){
            $("#posting_wanted_list").html(data);
            });
    }
    
</script>