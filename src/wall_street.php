<?php 
    require "header.php";
?>


<div class = "row justify-content-center">
    <h1>Wall Street</h1>
</div>


<div class = "row justify-content-center">
    <img src = "immagini/wstreet.png" alt = "Wall Street Logo" width = "200" height = "160">
</div>


<br><br>

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

<div class = "row justify-content-center">
    <a href = "#legenda"><u>Legenda degli indici</u></a>
</div>

<br>

<!-- In questo div vengono ritornati gli album a seconda della collezione selezionata -->
<div id = "tabella_wallstreet">

</div>

<br><br>
<br><br>
<br><br>

<div id = "legenda" class = "row justify-content-center">
    <h3> Legenda degli indici di Wall Street </h3>
</div>

<br><br>

<div class = "row justify-content-center">
    <ul>
        <li>Low Price - The lowest price at the market for non-foils</li>
        <li>Trend Price - The trend price as shown at the website (and in the chart) for non-foils</li>
        <li>Foil Low - The lowest price at the market as shown at the website (for condition EX+) for foils</li>
        <li>Foil Trend - The trend price as shown at the website (and in the chart) for foils </li>
        <li>AVG1 - The average sale price over the last day</li>
        <li>AVG7 - The average sale price over the last 7 days</li>
        <li>AVG30 - The average sale price over the last 30 days</li>
        <li>Foil AVG1 - The average sale price over the last day for foils</li>
        <li>Foil AVG7 - The average sale price over the last 7 days for foils</li>
        <li>Foil AVG30 - The average sale price over the last 30 days for foils</li>

    </ul>
</div>

<br><br><br><br>    





















<?php 
    require "footer.php";
?>




<script type ="text/javascript">
    window.onload = function() {
        return_tables_wall_street(1);
    };
    function return_tables_wall_street(id_collection){
        $.post("php/CRUD_wallstreet.php",{"collezione":id_collection},function(data){
            $("#tabella_wallstreet").html(data);
            });
    }
    
</script>