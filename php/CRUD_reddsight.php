<?php

require 'dbh.php';

if( isset($_POST['collezione']) ) {

    $id_collezione =  mysqli_real_escape_string($connessione, $_POST['collezione']);

    //$lista = get_posts($id_collezione);

    for($i = 0; $i < 5; $i++) {
        echo "ciao";
    }

}



//function get_posts($id_collezione) {

    $string = file_get_contents("../REDDITPOSTS/data.json");
    $json_post = json_decode($string);

    if ($json_post === NULL) {
        echo "Non va". '<br>';
    }
    else {

        var_dump($json_post);
        echo '<br><br>';

        $titolo = $json_post[1]->title;

        var_dump($titolo);
        



        /*
        $espansione_nome_inglese = "";
        $espansione_nome_francese = "";
        $espansione_nome_tedesco = "";
        $espansione_nome_spagnolo = "";
        $espansione_nome_italiano = "";

        $primo_blocco = $expansion_json->expansion->localization[0];
        $secondo_blocco = $expansion_json->expansion->localization[1];
        $terzo_blocco = $expansion_json->expansion->localization[2];
        $quarto_blocco = $expansion_json->expansion->localization[3];
        $quinto_blocco = $expansion_json->expansion->localization[4];

        $espansione_nome_inglese = $primo_blocco->name;
        $espansione_nome_francese = $secondo_blocco->name;
        $espansione_nome_tedesco = $terzo_blocco->name;
        $espansione_nome_spagnolo = $quarto_blocco->name;
        $espansione_nome_italiano = $quinto_blocco->name;

        //Nome inglese, francese, tedesco, spagnolo, italiano
        $array_parametri_espansione = array();
        array_push($array_parametri_espansione, $espansione_nome_inglese, $espansione_nome_francese, $espansione_nome_tedesco, $espansione_nome_spagnolo, $espansione_nome_italiano);


        $array_parametri_carte = array();

        foreach ($expansion_json->single as $card ) {
            //echo $card->idProduct . "<br>";
            //echo $card->website . "<br>";
            //echo $card->image . "<br>";
            //echo $card->countArticles . "<br>";
            //echo $card->countFoils . "<br>";
            array_push($array_parametri_carte, $card->idProduct, $card->website, $card->image, $card->countArticles, $card->countFoils);
            //Inglese, Francese, Tedesco, Spagnolo, Italiano
            foreach($card->localization as $language){
                //echo $language->name . "<br>";
                array_push($array_parametri_carte, $language->name);
            }
        }
         //print_r($array_parametri_carte);

         $double_array_espansione_carte = array($array_parametri_espansione, $array_parametri_carte);

        */

    }

//}