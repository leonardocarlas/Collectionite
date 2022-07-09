<?php 
    require 'header.php';
    require 'php/dbh.php';
    

    if ( isset( $_GET['READ']) ) { 
    
        $id_article =  mysqli_real_escape_string($connessione, $_GET['READ']);

        $array_dati_articolo = get_article($id_article);

        echo'

            <div class="d-flex flex-row m-4">
                <h5><a href= "articles.php" class="text-dark" ><u> Torna agli articoli </u></a></h5>
            </div>

            <div class = "row justify-content-center">
                <h3>'. $array_dati_articolo[2] .'</h3>
            </div>

            <div class = "row justify-content-center">
                <h4>'. $array_dati_articolo[1] .'</h4>
            </div>

            <div class = "row justify-content-center">
                <h4>'. substr($array_dati_articolo[0],0,10)  .'</h4>
            </div>

            <div class = "row justify-content-center">
                <img src = " ARTICOLI/intestazioni/i_'.$id_article.'.png " >
            </div>

            <br><br><br>

            <div class = "row justify-content-center">
        ';
        require "ARTICOLI/articolo_".$id_article.".php";
        echo '</div>';

    } else { 

        echo '

            <div class = "row justify-content-center">
                <h1>Articles</h1>
            </div>

            <br>

            <div class = "row justify-content-center"  >

                <nav class="navbar navbar-expand-lg" style = "background:transparent; background-color:transparent;">
                
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <img src="immagini/magic_logo.png"  onClick = "return_articles(1)" width="90" height="40" style="cursor: pointer;" >
                        </li>
                    </ul>

                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <img src="immagini/pokemon_logo.png" onClick = "return_articles(6)" width="90" height="40" style="cursor: pointer;" >
                        </li>
                    </ul>

                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <img src="immagini/ygo_logo.png" onClick = "return_articles(3)" width="90" height="40" style="cursor: pointer;" >
                        </li>
                    </ul>
                    
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <img src="immagini/fow_logo.png"  onClick = "return_articles(7)" width="90" height="40" style="cursor: pointer;" >
                            </li>
                            <li class="nav-item">
                                <img src="immagini/vanguard_logo.png" onClick = "return_articles(8)"   width="90" height="40" style="cursor: pointer;" >
                            </li>
                            <li class="nav-item">
                                <img src="immagini/ff_logo.png"   onClick = "return_articles(9)"  width="90" height="40" style="cursor: pointer;" >
                            </li>
                            <li class="nav-item">
                                <img src="immagini/starwars_logo.png" onClick = "return_articles(15)"  width="90" height="40" style="cursor: pointer;" >
                            </li>
                            <li class="nav-item">
                                <img src="immagini/dbs_logo.png" onClick = "return_articles(13)"  width="90" height="40" style="cursor: pointer;" >
                            </li>
                            <li class="nav-item">
                                <img src="immagini/dragoborne_logo.png" onClick = "return_articles(11)" width="90" height="40" style="cursor: pointer;" >
                            </li>
                            <li class="nav-item">
                                <img src="immagini/wow_logo.png" onClick = "return_articles(2)" width="90" height="40" style="cursor: pointer;" >
                            </li>
                            <li class="nav-item">
                                <img src="immagini/spoils_logo.png" onClick = "return_articles(5)" width="90" height="40" style="cursor: pointer;" >
                            </li>
                            <li class="nav-item">
                                <img src="immagini/ws_logo.png" onClick = "return_articles(10)" width="90" height="40" style="cursor: pointer;" >
                            </li>
                            <!--
                            <li class="nav-item">
                                <button class="nav-link text-white" onClick = <?php // echo "return_articles(12)";?> type="button" class="btn btn-outline-primary"> My Little Pony </button>
                            </li>
                            -->
                        </ul>
                    </div>
                </nav>

            </div>

            <br>

            <div class = "row justify-content-center">
                <h3>Vuoi scrivere degli articoli?</h3>
            </div>
            <div class = "row justify-content-center">
                <a class="btn m-2 text-white" style="background-color: #5401a7;" href = "contact.php">Mandaci una mail</a> 
            </div>

            <br>

            <div id = "articles"> 
            </div>

        ';

    } 

?>

<br><br><br><br>

<?php require "footer.php"; ?>







<script type ="text/javascript">
    
    window.onload = function() {
        return_articles(1);
    };

    function return_articles(id_collection){
        $.post("php/CRUD_articles.php",{"collezione":id_collection},function(data){
            $("#articles").html(data);
            });
    }
    
</script>




<?php

    function get_article ($id_article) {

        require 'php/dbh.php';
            
        $sql = "SELECT Article_date, Author, Title
        FROM article
        WHERE Idarticle = ? " ;

        $stmt = mysqli_stmt_init($connessione);

        if(!mysqli_stmt_prepare($stmt, $sql)) {

            echo "Error in the database";

        }
        else {
                mysqli_stmt_bind_param($stmt, "i", $id_article);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt); 
                
                $dati_articolo = array();

                if ($result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {

                        array_push($dati_articolo, $row['Article_date']);
                        array_push($dati_articolo, $row['Author']);
                        array_push($dati_articolo, $row['Title']);

                    }

                    return $dati_articolo;

                } else {

                    return $dati_articolo;

                }
        }
}