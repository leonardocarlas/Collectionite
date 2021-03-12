<?php

    require "dbh.php";
    set_time_limit(100000000000000);

    $id_espansioni = get_all_expansions();




    //for($j = 0; $j < 1; $j++){

        //$id_espansione = $id_espansioni[$j];
        $id_espansione = 1530;
        echo $id_espansione. "<br>";
        $double_array_espansione_carte = cards_in_the_set($id_espansione);

        if( $double_array_espansione_carte[0] == "NO CARDS") {
            echo "NO CARDS". "<br>";
        }
        else {
            $array_espansione = $double_array_espansione_carte[0];
            $array_carte = $double_array_espansione_carte[1];
            
            fill_expansion_table($id_espansione, $array_espansione[1], $array_espansione[2], $array_espansione[3], $array_espansione[4]);
            
            for($i=0; $i<count($array_carte); $i=$i+10){

                //$card->idProduct, $card->website, $card->image, $card->countArticles, $card->countFoils);
                //Inglese, Francese, Tedesco, Spagnolo, Italiano
                $id_carta = $array_carte[$i]; //0
                $website = $array_carte[$i+1]; //1
                $image_link = $array_carte[$i+2]; //2
                $count_articles = $array_carte[$i+3]; //3
                $count_foils = $array_carte[$i+4]; //4
                $english_card_name = $array_carte[$i+5]; //5
                $french_card_name = $array_carte[$i+6]; //6
                $german_card_name = $array_carte[$i+7]; //7
                $spanish_card_name = $array_carte[$i+8]; //8
                $italian_card_name = $array_carte[$i+9]; //9

                fill_cards_table($id_carta, $id_espansione, $english_card_name, $french_card_name, $german_card_name, $spanish_card_name, $italian_card_name, $count_articles, $count_foils, $website, $image_link);
                echo "ok carta";
            }
            
        }
        //sleep(60);
        
    //} 

    

function fill_expansion_table($id_espansione, $nome_francese, $nome_tedesco, $nome_spagnolo, $nome_italiano ){
    
    require "dbh.php";
    $sql = "UPDATE expansion SET French_set_name = '$nome_francese', German_set_name = '$nome_tedesco', Spanish_set_name = '$nome_spagnolo', Italian_set_name= '$nome_italiano' WHERE Idset = '$id_espansione'";
    $stmt = mysqli_stmt_init($connessione);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "Errore nell'inserimento dei nomi stranieri";
    }else{
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

    }
}

function fill_cards_table($idcard, $idset, $english_card_name, $french_card_name, $german_card_name, $spanish_card_name, $italian_card_name, $count_articles, $count_foils, $website, $image_link){
    
    require "dbh.php";
    $sql = "INSERT INTO nigga_card (Idcard, Idset, English_card_name, French_card_name, German_card_name, Spanish_card_name, Italian_card_name, Count_articles, Count_foils, Website, Image_link) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = mysqli_stmt_init($connessione);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "Errore nell'inserimento della carta". $idcard;
    }else{
        mysqli_stmt_bind_param($stmt, "iisssssiiss", $idcard, $idset, $english_card_name, $french_card_name, $german_card_name, $spanish_card_name, $italian_card_name, $count_articles, $count_foils, $website, $image_link);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

    }
}


function get_all_expansions() {
    require "dbh.php";
    $id_espansioni = array();
    $sql = "SELECT DISTINCT Idset FROM expansion";  
    $stmt = mysqli_stmt_init($connessione);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "Errore nella lettura delle espansioni";
    }
    else{
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $id_corrente = $row['Idset'];
                array_push($id_espansioni, $id_corrente);
            }

        }
        return $id_espansioni;
    }
}







function cards_in_the_set($id_set)
{

        //GET https://api.cardmarket.com/ws/v2.0/expansions/1469/singles

        //search=".$encoded_nome_carta."&idGame=".$idcollezione."&idLanguage=1

        //$encoded_nome_carta = urlencode($nome_carta);

        $method             = "GET";
        $url                = "https://api.cardmarket.com/ws/v2.0/output.json/expansions/".$id_set."/singles";
        $appToken           = "D5lSR859bgB50sVj";
        $appSecret          = "DLszKXEZCrNbZRQ8dTc1kLo6QxyDkicR";
        $accessToken        = "";
        $accessSecret       = "";
        $nonce              = "53eb1f44909d6";
        $timestamp          = "1407917892";
        $signatureMethod    = "HMAC-SHA1";
        $version            = "1.0";

        /**
        * Gather all parameters that need to be included in the Authorization header and are know yet
        *
        * Attention: If you have query parameters, they MUST also be part of this array!
        *
        * @var $params array|string[] Associative array of all needed authorization header parameters
        */
        $params             = array(
        'realm'                     => $url,
        'oauth_consumer_key'        => $appToken,
        'oauth_token'               => $accessToken,
        'oauth_nonce'               => $nonce,
        'oauth_timestamp'           => $timestamp,
        'oauth_signature_method'    => $signatureMethod,
        'oauth_version'             => $version
        );

        /**
        * Start composing the base string from the method and request URI
        *  $url    = "https://api.cardmarket.com/ws/v2.0/articles/".$id_product. "&idLanguage=".$language."&minCondition=".$cond."&start=0&maxResults=10";
        * Attention: If you have query parameters, don't include them in the URI
        *
        * @var $baseString string Finally the encoded base string for that request, that needs to be signed
        */
        $baseString         = strtoupper($method) . "&";
        $baseString        .= rawurlencode($url) . "&";

        /*
        * Gather, encode, and sort the base string parameters
        */
        $encodedParams      = array();
        foreach ($params as $key => $value)
        {
        if ("realm" != $key)
        {
            $encodedParams[rawurlencode($key)] = rawurlencode($value);
        }
        }
        ksort($encodedParams);

        /*
        * Expand the base string by the encoded parameter=value pairs
        */
        $values             = array();
        foreach ($encodedParams as $key => $value)
        {
        $values[] = $key . "=" . $value;
        }
        $paramsString       = rawurlencode(implode("&", $values));
        $baseString        .= $paramsString;

        /*
        * Create the signingKey
        */
        $signatureKey       = rawurlencode($appSecret) . "&" . rawurlencode($accessSecret);

        /**
        * Create the OAuth signature
        * Attention: Make sure to provide the binary data to the Base64 encoder
        *
        * @var $oAuthSignature string OAuth signature value
        */
        $rawSignature       = hash_hmac("sha1", $baseString, $signatureKey, true);
        $oAuthSignature     = base64_encode($rawSignature);

        /*
        * Include the OAuth signature parameter in the header parameters array
        */
        $params['oauth_signature'] = $oAuthSignature;

        /*
        * Construct the header string
        */
        $header             = "Authorization: OAuth ";
        $headerParams       = array();
        foreach ($params as $key => $value)
        {
        $headerParams[] = $key . "=\"" . $value . "\"";
        }
        $header            .= implode(", ", $headerParams);

        /*
        * Get the cURL handler from the library function
        */
        $curlHandle         = curl_init();

        /*
        * Set the required cURL options to successfully fire a request to MKM's API
        *
        * For more information about cURL options refer to PHP's cURL manual:
        * http://php.net/manual/en/function.curl-setopt.php
        */
        $url = "https://api.cardmarket.com/ws/v2.0/output.json/expansions/".$id_set."/singles";

        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlHandle, CURLOPT_URL, $url);
        curl_setopt($curlHandle, CURLOPT_HTTPHEADER, array($header));
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, false);

        /**
        * Execute the request, retrieve information about the request and response, and close the connection
        *
        * @var $content string Response to the request
        * @var $info array Array with information about the last request on the $curlHandle
        */
        $content            = curl_exec($curlHandle);
        $info               = curl_getinfo($curlHandle);
        curl_close($curlHandle);


        //$decoded            = json_decode($content);
        
        //$decoded            = simplexml_load_string($content);

        //echo "Contenuto". $content;
        //echo gettype($content);
        //echo "Informazioni  ";
        //print_r($info );
        
        
        if(!($content === '') || !($content === NULL)) {
            /* Caso in cui il set contiene carte*/
            
            $expansion_json = json_decode($content);
            
            if ($expansion_json === NULL)
            {
                echo "Si è rotto". '<br>';
                return cards_in_the_set($id_set);
            }
            else{
                
                //var_dump($expansion_json);

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
        
                return $double_array_espansione_carte;
            
            }
            
            
        }
        else {
            /* Caso in cui il set non contiene carte al suo interno*/
            $vuoto =  array();
            $stringa_avvertiva = "NO CARDS";
            $double_array_espansione_carte = array($stringa_avvertiva, $vuoto);

            return $double_array_espansione_carte;
        }      

}//chiusura funzione