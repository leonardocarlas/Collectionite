<?php

if( isset($_POST['collezione']) ) {

    $id_collezione = $_POST['collezione'];

    $array_espansioni = get_expansions($id_collezione);

    foreach ($array_espansioni as $data => $array_dati_relativi) {

        echo '
                <div class="row justify-content-center">
                    <h2>Anno:  ' .$data. '</h2>
                </div>
                <br>';
        
        
        // Eseguo i calcoli sull'array dei dati relativi
        
        $numero_espansioni = count ($array_dati_relativi)/7;
        
        $righe = floor(intdiv($numero_espansioni, 5));
        
        $riporto = $numero_espansioni % 5;
        
        // Scanditore dell'array delle carte
        $k = 0;
        
        // Stampo le righe
        
        for ($i = 0; $i < $righe; $i++ ) {
        
            echo '<div class="row justify-content-center">';
                for ($j = 0; $j < 5; $j++) {
        
                    echo '
                        <div class="col"> 
                            <div class="card">';
        
                    if ($id_collezione == 1) {
                        magic_format( $array_dati_relativi[$k], $array_dati_relativi[$k+1], $array_dati_relativi[$k] );
                    }
                    if ($id_collezione == 3) {
                        yugioh_format( $array_dati_relativi[$k], $array_dati_relativi[$k+1], $array_dati_relativi[$k+6] );
                    }
                    if ($id_collezione == 6) {
                        pokemon_format( $array_dati_relativi[$k], $array_dati_relativi[$k+1], $array_dati_relativi[$k] );
                    }
                    if ($id_collezione == 5 || $id_collezione == 2 || $id_collezione == 7 || $id_collezione == 9 || $id_collezione == 8 || $id_collezione == 10 || $id_collezione == 11 || $id_collezione == 12 || $id_collezione == 13 ) {
                        whatever_format($array_dati_relativi[$k], $array_dati_relativi[$k+1], $array_dati_relativi[$k+6] ) ;
                    }
        
                    echo '
                                    <div class="row justify-content-center">
                                        <a class="btn text-white" style="background-color: #5401a7;" href="cinema.php?EXP='.$array_dati_relativi[$k].'">Apri Album</a>
                                    </div>
                                </div>
                            </div>
                        </div>';
        
                    $k += 7;
                }
            echo '</div> <br>';
        }
        
        // Riporto
        
        echo '<div class="row justify-content-center">';
            for ( $i = 0; $i < $riporto ; $i++ ) {
                
                echo '
                    <div class="col"> 
                        <div class="card">';

                if ($id_collezione == 1) {
                    magic_format( $array_dati_relativi[$k], $array_dati_relativi[$k+1], $array_dati_relativi[$k] );
                }
                if ($id_collezione == 3) {
                    yugioh_format( $array_dati_relativi[$k], $array_dati_relativi[$k+1], $array_dati_relativi[$k+6] );
                }
                if ($id_collezione == 6) {
                    pokemon_format( $array_dati_relativi[$k], $array_dati_relativi[$k+1], $array_dati_relativi[$k] );
                }
                if ($id_collezione == 5 || $id_collezione == 2 || $id_collezione == 7 || $id_collezione == 9 || $id_collezione == 8 || $id_collezione == 10 || $id_collezione == 11 || $id_collezione == 12 || $id_collezione == 13 ) {
                    whatever_format($array_dati_relativi[$k], $array_dati_relativi[$k+1], $array_dati_relativi[$k+6] ) ;
                }

                echo '
                                <div class="row justify-content-center">
                                    <a class="btn text-white" style="background-color: #5401a7;" href="cinema.php?EXP='.$array_dati_relativi[$k].'">Apri Album</a>
                                </div>
                            </div>
                        </div>
                    </div>';

                $k += 7; 
                }
            
        echo '</div><br><br>';
        
        }
}











/**
*  Metodo che ritorna un array contenente due array:
*  array di date
*  array con i dati delle espansioni
*/

function get_expansions($idcollection) {

    require 'dbh.php';

    $sql = "SELECT Release_date, Idset, English_set_name, French_set_name, German_set_name, Spanish_set_name, Italian_set_name,  Abbreviation FROM expansion WHERE Idcollection=? ORDER BY Release_date DESC; ";
    $stmt = mysqli_stmt_init($connessione);

    if (!mysqli_stmt_prepare($stmt, $sql)) {

        echo "Error in the database";

    }
    else {

        mysqli_stmt_bind_param($stmt, "i", $idcollection);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt); 

        if ($result->num_rows > 0) {

            $array_completo = array();
            $array_date = array();

            // Metto tutte le informazioni che o preso dalla query in un array completo

            while ($row = $result->fetch_assoc()) {

                $data_in_anno = substr($row['Release_date'],0,4);
                
                array_push($array_completo, $data_in_anno);
                array_push($array_completo, $row['Idset']);
                array_push($array_completo, $row['English_set_name']);
                array_push($array_completo, $row['French_set_name']);
                array_push($array_completo, $row['German_set_name']);
                array_push($array_completo, $row['Spanish_set_name']);
                array_push($array_completo, $row['Italian_set_name']);
                array_push($array_completo, $row['Abbreviation']);
             
            }

            for ($i = 0; $i < count($array_completo); $i += 8 ) {

                // La data è già registrata

                if (array_key_exists($array_completo[$i], $array_date)) { 

                    array_push($array_date[$array_completo[$i]], $array_completo[$i+1]);
                    array_push($array_date[$array_completo[$i]], $array_completo[$i+2]);
                    array_push($array_date[$array_completo[$i]], $array_completo[$i+3]);
                    array_push($array_date[$array_completo[$i]], $array_completo[$i+4]);
                    array_push($array_date[$array_completo[$i]], $array_completo[$i+5]);
                    array_push($array_date[$array_completo[$i]], $array_completo[$i+6]);
                    array_push($array_date[$array_completo[$i]], $array_completo[$i+7]);

                } 

                // La data NON è già registrata

                else { 

                    $array_date[$array_completo[$i]] = array();
                    array_push($array_date[$array_completo[$i]], $array_completo[$i+1]);
                    array_push($array_date[$array_completo[$i]], $array_completo[$i+2]);
                    array_push($array_date[$array_completo[$i]], $array_completo[$i+3]);
                    array_push($array_date[$array_completo[$i]], $array_completo[$i+4]);
                    array_push($array_date[$array_completo[$i]], $array_completo[$i+5]);
                    array_push($array_date[$array_completo[$i]], $array_completo[$i+6]);
                    array_push($array_date[$array_completo[$i]], $array_completo[$i+7]);

                }
            }

           
        }

    }

    mysqli_stmt_close($stmt);
    mysqli_close($connessione);

    return $array_date; 
}


function magic_format($logo, $titolo, $icona){

    echo ' 
            <img
                src="immagini/magic_exp/'. $logo .'_logo.png "
                class="card-img-top"
                alt="Foto dell\'espansione"
            />

            <div class="card-body">
                <div class="row justify-content-center">
                    <h5 class="card-title" style = "text-align: center;" >'. $titolo .'</h5>
                </div>
                <div class="row justify-content-center">
                    <img
                    src="immagini/magic_exp/'.  $icona  .'_icon.png "
                    alt="Icona dell\'espansione"
                    />
                </div>
            ';
}

function pokemon_format($logo, $titolo, $icona){

    echo ' 
            <img
                src="immagini/pokemon_exp/'. $logo .'_logo.png "
                class="card-img-top"
                alt="Foto dell\'espansione"
            />

            <div class="card-body">
                <div class="row justify-content-center">
                    <h5 class="card-title" style = "text-align: center;" >'. $titolo .'</h5>
                </div>
                <div class="row justify-content-center">
                    <img
                    src="immagini/pokemon_exp/'.  $icona  .'_icon.png "
                    alt="Icona dell\'espansione"
                    />
                </div>
            ';
}

function yugioh_format($logo, $titolo, $abbreviazione){

    echo ' 
            <img
                src="immagini/yugioh_exp/'. $logo .'_logo.png "
                class="card-img-top"
                alt="Foto dell\'espansione"
            />

            <div class="card-body">
                <div class="row justify-content-center">
                    <h5 class="card-title" style = "text-align: center;" >'. $titolo .'</h5>
                </div>
                <div class="row justify-content-center">
                    <strong> <h5 style = "text-align: center;" >'. $abbreviazione .'</h5></strong>
                </div>
            ';
}

function whatever_format($logo, $titolo, $abbreviazione){

    echo ' 
            <div class="card-body">
                <div class="row justify-content-center">
                    <h5 class="card-title" style = "text-align: center;" >'. $titolo .'</h5>
                </div>
                <div class="row justify-content-center">
                    <strong> <h5 style = "text-align: center;" >'. $abbreviazione .'</h5></strong>
                </div>
            ';
}