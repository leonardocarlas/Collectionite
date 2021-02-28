<?php

    require "dbh.php";

    $id_espansioni = array();
    //Bisogna aggiornare la tabella delle espansioni TEXP
    $sql = "SELECT DISTINCT idExpansion FROM texp";  
    $stmt = mysqli_stmt_init($connessione);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../index.php?error=sqlerror");
        exit();

    }
    else{
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $id_corrente = $row['idExpansion'];
                array_push($id_espansioni, $id_corrente);
            }

        }
    } 

    print_r($id_espansioni);


    for( $j = 0; $j < count($id_espansioni); $j++){

        $id_espansione = $id_espansioni[$j];
        $double_arr = cards_in_the_set($id_espansione);
        $nome_set = $double_arr[0];
        $returned_cards = $double_arr[1];
        //print_r($returned_cards);

        //   ORDINE CREATO:
        //   0. IdExpansion 1. enName of Expansion 
        //   CARTE
        //   1. idCarta (inserire se non c'è)  2. enName_carta  3. link_image_card (inserire assolutamente)
        //   $primo = array_shift($aaa);
        //   $enName_Exp = array_shift($aaa);
        //   $double_array = array($enName_Exp, $aaa);

        
        for($i=0; $i<count($returned_cards); $i=$i+3){
            $id_carta = $returned_cards[$i];
            $en_name_carta = $returned_cards[$i+1];
            $link_image_card = $returned_cards[$i+2];
            echo "Id espansione:  ". $id_espansione ." Id carta: " . $id_carta . " en name: " . $en_name_carta . " link: " . $link_image_card . "<br>";

            $sql = "INSERT INTO all_cards (Idcard, Idset, Card_name, Set_name, Image_link) VALUES (?,?,?,?,?)";
            $stmt = mysqli_stmt_init($connessione);

            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../index.php?error=sqlerror");
                exit();
            }else{    ////////modificareeee
                mysqli_stmt_bind_param($stmt, "iisss", $id_carta, $id_espansione, $en_name_carta, $nome_set, $link_image_card);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

            }
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
    
            //echo "Contenuto  ". $content;
            //echo "Informazioni  ";
            //print_r($info );
    
    
    
            $jsonIterator = new RecursiveIteratorIterator(
            new RecursiveArrayIterator(json_decode($content, TRUE)),
            RecursiveIteratorIterator::SELF_FIRST);
    
            
            $aaa = array();
    
            foreach ($jsonIterator as $key => $val) {
                if(is_array($val)) {
                    /*echo "$key:\n";
                    echo "<br>";
                    echo "<br>"; */
                } else {
                    //echo "$key => $val\n";
                    //echo "<br>";
                    
                    if( $key == "idProduct"){
                        array_push($aaa, $val);
                    }
                    if( $key == "idExpansion"){
                        array_push($aaa, $val);
                    }
                    if( $key == "image"){
                        array_push($aaa, $val);
                    }
                    if( $key == "enName"){
                        array_push($aaa, $val);
                    }
                    
                }
            }
            
            
            
    
            // ORDINE CREATO:
            // 0. IdExpansion 1. enName of Expansion 
            // CARTE
            // 1. idCarta (inserire se non c'è)  2. enName_carta  3. link_image_card (inserire assolutamente)
            $primo = array_shift($aaa);
            $enName_Exp = array_shift($aaa);
            $double_array = array($enName_Exp, $aaa);
    
            return $double_array;
    
            /*
            for($i=0; $i<count($aaa); $i++){
                if($aaa[$i] == $set_carta){
                    array_push($possessione, $aaa[$i-3]);
                    array_push($possessione, $aaa[$i]);
                    array_push($possessione, $aaa[$i-2]);
    
                }
            }
            */
            //sql di inserimento di tutte le carte
    
    
            //sql di inserimento della possessione
    
    
            //print_r( $possessione );
            //conenuto array: idProduct, Link della carta da completare, Nome Set, 
         
            
            
    
    }//chiusura funzione