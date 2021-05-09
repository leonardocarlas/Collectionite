<?php

require "header.php";
require 'php/dbh.php';


if ( isset( $_GET['U']) ) { 

    $id_user = mysqli_real_escape_string($connessione, $_GET['U']);
    $array_immagini = get_user_datas($id_user);

    echo '

        <h3> eh dio cana </h3>
        <div class = "row justify-content-center" >
            <img src = "immagini/onlylogo.png" alt = "immagine del profilo modified" width = "200" height = "250" > 
        </div> 
    ';

} else {

}

require 'footer.php';




function get_user_datas($id_user) {

    $array_dati = array();
    return $array_dati;

}