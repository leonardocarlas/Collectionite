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

            </ul>
        </div>
    </nav>

</div>

<br>






<div class="row justify-content-center">

    <div class="list-group" id="show-list">
        <!-- Here autocomplete list will be display -->
    </div>

</div>





<div class="row justify-content-center">
    <div class = "col-8">
        <div id = "posting_wanted_list">


        </div>
    </div>
</div>






<br><br><br>
<br><br><br><br>
<br><br><br><br>
<br><br><br><br>









<?php 
    require "footer.php";
?>

<script type ="text/javascript">

    function save_text_wantedlist(idcollezione){    
        
        $.post("php/CRUD_wantedlist.php",{"idcollezione": idcollezione, "testo_wantedlist":document.getElementById('wantedlist-text').value},function(data){
            if(data.trim() == "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'La tua wanted list è stata registrata',
                        });
            }
        });
    }

    function sleep(milliseconds) {
        const date = Date.now();
        let currentDate = null;
        do {
            currentDate = Date.now();
        } while (currentDate - date < milliseconds);
    }


    window.onload = function() {
        return_wantedlist(1);
    };
    
    function return_wantedlist(id_collection){
        $.post("php/CRUD_wantedlist.php",{"collezione":id_collection},function(data){
            $("#posting_wanted_list").html(data);
        });
    }
    
    function cerca_wanted_list_con_carta(){
        $.post("php/CRUD_wantedlist.php",{"testo_cercato":document.getElementById('card_searched').value},function(data){
            $("#show-list").html(data);
        });
    }

    // script per auto completamento   query = searchText

    $(document).ready( function(){
        $("#card_searched").keyup(function(){
            var searchText = $(this).val();
            if(searchText != '')
            {
                $("#show-list").fadeIn();
                $.post("php/action.php",{"query_card_set":searchText},function(data){
                    $("#show-list").html(data);
                });
            }
            else{
                $("#show-list").fadeOut();
                $("#show-list").html('');
            }
        });
        $("#show-list").on('click','li',function(){
            $("#card_searched").val($(this).text());
            $("#show-list").fadeOut();
        });

    });

    

</script>