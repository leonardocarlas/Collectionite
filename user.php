<?php

require "header.php";
require 'php/dbh.php';


if ( isset( $_GET['U']) ) { 

    $id_user = mysqli_real_escape_string($connessione, $_GET['U']);
    $array_album = get_albums($id_user);
    $array = get_posts($id_user);
    $lista = get_wanted_lists($id_user);

    $username = "leo";

    echo '
        <div class = "row justify-content-center" >
            <img src = "immagini/onlylogo.png" alt = "immagine del profilo modified" width = "200" height = "150" > 
        </div> 

        <div class = "row justify-content-center" >
            <h3> '.$username.' </h3>
        </div>

        <div class = "row justify-content-center" >
            <button class="btn m-2 text-white" style="background-color: #5401a7;"> Contatta l\'utente </button>
        </div>
    ';

    echo '<div class = "row justify-content-center" >';
    for ($i = 0; $i < count($array_album); $i= $i+3 ) {

        echo '
            <div class="col"> 
                <a href="#" >
                    <div>
                        <div class = "row justify-content-center">
                            <img src = "immagini/album_nuovo.png" width = "100" height = "100" >
                        </div>
                        <div class = "row justify-content-center">
                            <p> '.$array_album[$i].' </p>
                        </div>
                    </div>
                </a>
            </div>
        ';
    }

    for($i = 0; $i < count(array_keys($lista)); $i++ ) { 

        $array_informazioni_carte = $lista[$i+1];

        echo '
            <div class="card">
                <h5 class="card-header text-white" style="background-color: #5401a7;" ><a href=user.php?U='.$array_informazioni_carte[3].' ><u>'.$array_informazioni_carte[2].'</u></a> ha postato questa Wanted List in data '.$array_informazioni_carte[0].'. Luogo: '.$array_informazioni_carte[4].'</h5>
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

} else {

}


echo '<br><br><br><br><br><br>';
require 'footer.php';




function get_albums($id_user) {

    require 'php/dbh.php';

    $sql = "SELECT Album_name, Idalbum, Idcollection FROM album WHERE Iduser = ? ; ";
    $stmt = mysqli_stmt_init($connessione);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        echo "Error in the database";
    }
    else {
        mysqli_stmt_bind_param($stmt, "i", $id_user);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt); 

        $array_album = array();

        if ($result->num_rows > 0) { 

            while($row = $result->fetch_assoc()) {
                array_push($array_album,  $row['Album_name']);
                array_push($array_album,  $row['Idalbum']);
                array_push($array_album,  $row['Idcollection']);
            }

            
        }

        return $array_album;
    }

    mysqli_stmt_close($stmt);
    mysqli_close($connessione);

}

function get_posts($id_user) {


}

function get_wanted_lists($id_user) {

    require 'php/dbh.php';

    $sql = "SELECT wanted_list.Idwantedlist, Date_wantedlist, Description, Username, user.Iduser, City_CAP, Image_link, English_card_name, English_set_name, Min_condition, Language_wanted, Max_price
    FROM desires
    INNER JOIN wanted_list ON desires.Idwantedlist = wanted_list.Idwantedlist
    INNER JOIN user ON desires.Iduser = user.Iduser
    INNER JOIN cards ON cards.Idcard = desires.Idcard
    INNER JOIN expansion ON cards.Idset = expansion.Idset
    WHERE user.Iduser = ?
    ORDER BY wanted_list.Date_wantedlist" ;

    $stmt = mysqli_stmt_init($connessione);

    if(!mysqli_stmt_prepare($stmt, $sql)) {
        echo "Error in the database";
    }
    else {
            mysqli_stmt_bind_param($stmt, "i", $id_user);
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