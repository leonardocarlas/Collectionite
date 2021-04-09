<?php



$array_magic = get_expansions(1);
//echo '<pre>' , var_dump($array_magic) , '</pre>';
foreach($array_magic as $data => $dati_relativi) {
    echo "$data is at " . $dati_relativi[0] . "<br>";
  }










/**
*  Metodo che ritorna un array contenente due array:
*  array di date
*  array con i dati delle espansioni
*/

function get_expansions($idcollection) {

    require 'php/dbh.php';

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
