<?php

require 'dbh.php';

if( isset($_POST['collezione']) ) {

    $id_collezione =  mysqli_real_escape_string($connessione, $_POST['collezione']);

    $lista = get_lists($id_collezione);

    /*[2] => Array ( [0] => 2021-04-22 21:13:00.000000 [1] => Ciao Campione! [2] => leo [3] => 11 [4] => 36013 
                [5] => //static.cardmarket.com/img/e832b58b6e948146b747f68dc68b0829/items/51/BS/273698.jpg [6] => Chansey [7] => Base Set [8] => 3 [9] => 3 [10] => 32
      [1] => Array ( [0] => 2021-04-22 21:13:35.860580 [1] => Il charizard lo voglio gradato PSA. [2] => leo [3] => 11 [4] => 36013 
                [5] => //static.cardmarket.com/img/e832b58b6e948146b747f68dc68b0829/items/51/BS/273699.jpg [6] => Charizard [Fire Spin] [7] => Base Set [8] => 1 [9] => 1 [10] => 450.34 
                [11] => //static.cardmarket.com/img/e832b58b6e948146b747f68dc68b0829/items/51/BS/273700.jpg [12] => Clefairy [13] => Base Set [14] => 2 [15] => 3 [16] => 304.89 
    */

    // Itera sulle Idwantedlist

    for($i = 0; $i < count(array_keys($lista)); $i++ ) { 

        $array_informazioni_carte = $lista[$i+1];
        //print_r($array_informazioni_carte);

        echo '
            <div class="card">
                <h5 class="card-header text-white" style="background-color: #5401a7;" ><a href=user.php/U='.$array_informazioni_carte[3].' ><u>'.$array_informazioni_carte[2].'</u></a> ha postato questa Wanted List in data '.$array_informazioni_carte[0].'. Luogo: '.$array_informazioni_carte[4].'</h5>
                <div class="card-body">
                    <h5 class="card-title">'.$array_informazioni_carte[1].'</h5>
                    <p class="card-text">

                        <!-- Ora printo le carte -->

                        <table>
        ';
        $contatore_carte = (count($array_informazioni_carte)-5)/6;

        for($j = 0, $k = 5; $j < $contatore_carte; $j++, $k += 6) {
        echo'
                            <tr>
                                <td><img src="'.$array_informazioni_carte[$k].'" width = "40" height = "55"></td>
                                <td>'.$array_informazioni_carte[$k+1].' </td>
                                <td>'.$array_informazioni_carte[$k+2].' </td>
                                <td>Language: '.$array_informazioni_carte[$k+3].' </td>
                                <td>Conditions: '.$array_informazioni_carte[$k+4].' + </td>
                                <td>Max Price: '.$array_informazioni_carte[$k+5].' - </td>
                            </tr>
        ';
        }
        echo'
                        </table>
                    </p>

                    <div class = "row justify-content-center" > 
                        <button onClick = " '; 
                            if(isset($_SESSION['idusersession'])){ 
                                echo 'contatta(2918)'; 
                            } else { 
                                echo 'advise_login()';
                            }
                        echo '" 
                            style="background-color: #5401a7;" class="btn text-white" > Contatta il collezionista 
                        </button>
                    </div>
                </div>
            </div>
            <br>
        ';
    }

    

}








if ( isset($_POST['testo_cercato']) ) {

    $testo_cercato = mysqli_real_escape_string($connessione, $_POST['testo_cercato']);

    $sql = "SELECT DISTINCT English_card_name, cards.Idset, Idcard, Image_link, expansion.English_set_name
    FROM cards
    INNER JOIN expansion ON cards.Idset = expansion.Idset 
    WHERE English_card_name LIKE '%$testo_cercato%'  AND expansion.Idcollection = '$idcollection' LIMIT 70";

    $stmt = mysqli_stmt_init($connessione);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "Error in the database";
    }
    else{
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt); 
        
        
        $output = '<table>';
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                if ( str_contains($row['English_card_name'], "Online")  == true ) {
                    continue;
                }
                else {
                    $output .=   '<tr>
                                        <td style="padding:0 15px 0 15px;" ><img src="'.$row['Image_link'] .'" width = "30" height = "35" ></td>
                                        <td style="padding:0 15px 0 15px;">' . $row['English_card_name'] .' </td> 
                                        <td style="padding:0 15px 0 15px;"> <img src = "immagini/'.$row['Idset'].'.png"> </td> 
                                        <td style="padding:0 15px 0 15px;">'. $row['English_set_name'].' </td> 
                                        <td style="padding:0 15px 0 15px;"> <button class="btn text-white" style="background-color: #5401a7;" onclick="insert_card('.$row['Idcard'] .')" >Aggiungi Carta</button> </td>
                                 </tr> ';   
                }
            }
            
        }
        else{
            $output .= '<ul><li>Carta non nel Database</li></ul>';
        }
        $output .= '</table>';
        
        echo $output;


    }    
    mysqli_stmt_close($stmt);
    mysqli_close($connessione);
}


?>





<?php

    function get_lists($id_collezione){
        
        require 'dbh.php';
        
        $sql = "SELECT wanted_list.Idwantedlist, Date_wantedlist, Description, Username, user.Iduser, City_CAP, Image_link, English_card_name, English_set_name, Min_condition, Language_wanted, Max_price
        FROM desires
        INNER JOIN wanted_list ON desires.Idwantedlist = wanted_list.Idwantedlist
		INNER JOIN user ON desires.Iduser = user.Iduser
        INNER JOIN cards ON cards.Idcard = desires.Idcard
        INNER JOIN expansion ON cards.Idset = expansion.Idset
        WHERE wanted_list.Idcollection = ?
        ORDER BY wanted_list.Date_wantedlist
        LIMIT 50 " ;

        $stmt = mysqli_stmt_init($connessione);

        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo "Error in the database";
        }
        else {
                mysqli_stmt_bind_param($stmt, "i", $id_collezione);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt); 
                        
                //  wanted_list.Idwantedlist, Date_wantedlist, Description, Username, user.Iduser, City_CAP, Image_link, English_card_name, English_set_name, Min_condition, Language_wanted, Max_price
                
                if ($result->num_rows > 0) {
    
                    $array_completo = array();
                    $array_wanted_list = array();
        
                    // Metto tutte le informazioni che ho preso dalla query in un array completo
        
                    while ($row = $result->fetch_assoc()) {
                               
                        array_push($array_completo, $row['Idwantedlist']); //0
                        array_push($array_completo, substr($row['Date_wantedlist'],0,10) );
                        array_push($array_completo, $row['Description']);
                        array_push($array_completo, $row['Username']);
                        array_push($array_completo, $row['Iduser']);
                        array_push($array_completo, $row['City_CAP']);
                        array_push($array_completo, $row['Image_link']);
                        array_push($array_completo, $row['English_card_name']);
                        array_push($array_completo, $row['English_set_name']);
                        array_push($array_completo, $row['Min_condition']);
                        array_push($array_completo, $row['Language_wanted']);
                        array_push($array_completo, $row['Max_price']); //11
                        
                    }
        
                    for ($i = 0; $i < count($array_completo); $i += 12 ) {
        
                        // La data è già registrata
        
                        if (array_key_exists($array_completo[$i], $array_wanted_list)) { 
        
                            //array_push($array_wanted_list[$array_completo[$i]], $array_completo[$i+1]);
                            //array_push($array_wanted_list[$array_completo[$i]], $array_completo[$i+2]);
                            //array_push($array_wanted_list[$array_completo[$i]], $array_completo[$i+3]);
                            //array_push($array_wanted_list[$array_completo[$i]], $array_completo[$i+4]);
                            //array_push($array_wanted_list[$array_completo[$i]], $array_completo[$i+5]);
                            array_push($array_wanted_list[$array_completo[$i]], $array_completo[$i+6]);
                            array_push($array_wanted_list[$array_completo[$i]], $array_completo[$i+7]);
                            array_push($array_wanted_list[$array_completo[$i]], $array_completo[$i+8]);
                            array_push($array_wanted_list[$array_completo[$i]], $array_completo[$i+9]);
                            array_push($array_wanted_list[$array_completo[$i]], $array_completo[$i+10]);
                            array_push($array_wanted_list[$array_completo[$i]], $array_completo[$i+11]);
        
                        } 
        
                        // La data NON è già registrata
        
                        else { 
        
                            $array_wanted_list[$array_completo[$i]] = array();
                            array_push($array_wanted_list[$array_completo[$i]], $array_completo[$i+1]);
                            array_push($array_wanted_list[$array_completo[$i]], $array_completo[$i+2]);
                            array_push($array_wanted_list[$array_completo[$i]], $array_completo[$i+3]);
                            array_push($array_wanted_list[$array_completo[$i]], $array_completo[$i+4]);
                            array_push($array_wanted_list[$array_completo[$i]], $array_completo[$i+5]);
                            array_push($array_wanted_list[$array_completo[$i]], $array_completo[$i+6]);
                            array_push($array_wanted_list[$array_completo[$i]], $array_completo[$i+7]);
                            array_push($array_wanted_list[$array_completo[$i]], $array_completo[$i+8]);
                            array_push($array_wanted_list[$array_completo[$i]], $array_completo[$i+9]);
                            array_push($array_wanted_list[$array_completo[$i]], $array_completo[$i+10]);
                            array_push($array_wanted_list[$array_completo[$i]], $array_completo[$i+11]);
        
                        }
                    }
                    
                    return $array_wanted_list;
                   
                }
                else {

                    $vuoto = array();
                    return $vuoto;
                }

        }
        mysqli_stmt_close($stmt);
        mysqli_close($connessione);

    }

?>