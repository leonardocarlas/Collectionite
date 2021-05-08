<?php


require 'dbh.php';

if( isset($_POST['collezione']) ) {

    $id_collezione =  mysqli_real_escape_string($connessione, $_POST['collezione']);

    $array_articoli = get_articles($id_collezione);

    // Idarticle, Article_date, Author, Title

    $numero_articoli = count ($array_articoli)/4;
    
    $righe = floor(intdiv($numero_articoli, 4));
    
    $riporto = $numero_articoli % 4;

    $k = 0;

    for ($i = 0; $i < $righe; $i++) {

        echo '<div class = "row"> ';
        print_format_article($array_articoli[$k], $array_articoli[$k+1], $array_articoli[$k+2], $array_articoli[$k+3]);
        echo '</div>';
        $k += 4;
    }
    for ($i = 0; $i < $riporto; $i++) {

        echo '<div class = "row"> ';
        print_format_article($array_articoli[$k], $array_articoli[$k+1], $array_articoli[$k+2], $array_articoli[$k+3]);
        echo '</div>';
        $k += 4;
    }
}



function print_format_article ($id, $data, $author, $title) {

    echo '
        <div class = "col"> 
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="ARTICOLI/intestazioni/i_'.$id.'.png" alt="Card image cap">
                <div class="card-body">
                <h5 class="card-title">'. $title .'</h5>
                <p class="card-text">Author : '. $author .'</p>
                <a href="articles.php?READ='.$id.'" class="btn btn-primary">Leggi articolo</a>
                </div>
            </div>
        </div>
    ';

}


function get_articles ($id_collezione) {

    require 'dbh.php';
        
    $sql = "SELECT Idarticle, Article_date, Author, Title
    FROM article
    WHERE Idcollection = ? " ;

    $stmt = mysqli_stmt_init($connessione);

    if(!mysqli_stmt_prepare($stmt, $sql)) {
        echo "Error in the database";
    }
    else {
            mysqli_stmt_bind_param($stmt, "i", $id_collezione);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt); 
            
            $array_articoli = array();

            if ($result->num_rows > 0) {
   
                while ($row = $result->fetch_assoc()) {

                    array_push($array_articoli, $row['Idarticle']);
                    array_push($array_articoli, $row['Article_date']);
                    array_push($array_articoli, $row['Author']);
                    array_push($array_articoli, $row['Title']);

                }

                return $array_articoli;

            } else {

                return $array_articoli;

            }
    }
}