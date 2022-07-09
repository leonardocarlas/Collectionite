<?php

require 'dbh.php';

if( isset($_POST['collezione']) ) {

    $id_collezione =  mysqli_real_escape_string($connessione, $_POST['collezione']);

    //echo get_posts($id_collezione);

    $string = file_get_contents("../REDDITPOSTS/".$id_collezione.".json");
    $json_posts = json_decode($string);

    for($i = 0; $i < 15; $i++ ) { 

        
        echo '
            
                <div class="card">
                    <div class = "row justify-content-center" style="background-color: #5401a7;">
                        <h5 class="card-header text-white"  > <a href = "https://www.reddit.com/'.$json_posts[$i]->permalink.'"> <u> Posted by: Ott '.$json_posts[$i]->created_utc.' ago</u> </a></h5>              
                    </div>    
                    <div class="card-body">
                        <div class = "row justify-content-center">
                            <h5 class="card-title">'.$json_posts[$i]->title.'</h5>
                        </div>
                        <br>
                        <div class = "row justify-content-center">
                            <p class="card-text">
            ';

        if ($json_posts[$i]->selftext_html != null) {

            echo $json_posts[$i]->selftext_html;

        }
        if ( str_contains( $json_posts[$i]->url, ".com") == true ) {
            
        } else {

            echo '<img src="'.$json_posts[$i]->url.'" style = "display: block;
                                                                max-width:230px;
                                                                max-height:95px;
                                                                width: auto;
                                                                height: auto;" 
            >';
        }
        if ($json_posts[$i]->media_metadata == "") {

        }
        else {

            /*
            foreach ($json_posts[$i]->media_metadata as $key => $value) {
                echo $key . "<br>";
                echo $json_posts[$i]->media_metadata->$key->p[0]->u. "<br>";
            }
            

            echo '

            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
            ';
            */

            foreach ($json_posts[$i]->media_metadata as $key => $value) {
                /*
                echo'
                <div class="carousel-item">
                    <img class="d-block w-100" width="100" height="100" src="'.$json_posts[$i]->media_metadata->$key->p[0]->u .'" alt="Foto">
                </div>
                ';
                */
                echo '<img width="100" height="100" src="'.$json_posts[$i]->media_metadata->$key->p[0]->u .'" alt="Foto">' .'<br><br>';
            }
            
            /*
            echo '       
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
                </a>
            </div>

            ';
            */
            
        }

        echo '

                            </p>
                        </div>
                    </div>
                </div>
            
            <br>
        ';
    }

}


function str_contains(string $haystack, string $needle): bool {

    return '' === $needle || false !== strpos($haystack, $needle);

}


function get_posts($id_collezione) {

    $string = file_get_contents("../REDDITPOSTS/".$id_collezione.".json");
    $json_posts = json_decode($string);

    var_dump($json_posts[1]->media_metadata);

    if ($json_posts[14]->media_metadata == "") {
        echo "daje";
    }
    /*
    $r = "";

    if ($json_posts === NULL) {
        $r .= "Non va";
    }
    else {

        
        for ($i = 0; $i < 15; $i++) {
            $r .= $json_posts[$i]->title;
        }
        
        //if(array_key_exists('media_metadata',$json_posts[0])) {
  

    }
    */





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