<?php 
    require "header.php";
?>

<br>

<div class = "row justify-content-center">
    <img src = "immagini/wallstreet.png" alt = "Wall Street Logo" width = "180" height = "160">
</div>

<div class = "row justify-content-center">
    <h1>Wall Street</h1>
</div>

<br>

<div class = "row justify-content-center">
    <nav class="navbar navbar-expand-lg" style = "background:transparent; background-color:transparent;">
    
        <ul class="navbar-nav">
            <li class="nav-item">
                <img src="immagini/magic_logo.png"  onClick = "return_tables_wall_street(1)"  width="90" height="40" style="cursor: pointer;" >
            </li>
        </ul>

        <ul class="navbar-nav">
            <li class="nav-item">
                <img src="immagini/pokemon_logo.png" onClick = "return_tables_wall_street(6)" width="90" height="40" style="cursor: pointer;" >
            </li>
        </ul>

        <ul class="navbar-nav">
            <li class="nav-item">
                <img src="immagini/ygo_logo.png" onClick = "return_tables_wall_street(3)"  width="90" height="40" style="cursor: pointer;" >
            </li>
        </ul>
        
    </nav>
</div>


<br>

<!-- In questo div vengono ritornati gli album a seconda della collezione selezionata -->
<div id = "tabella_wallstreet">


</div>


<br><br><br>
<br><br><br><br>
<br><br><br><br>
<br><br><br><br>





















<?php 
    require "footer.php";
?>




<script type ="text/javascript">
    
    function return_tables_wall_street(id_collection){
        $.post("php/CRUD_wallstreet.php",{"collezione":id_collection},function(data){
            $("#tabella_wallstreet").html(data);
            });
    }
    
</script>