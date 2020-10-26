<?php
    require 'dbh.php';

    session_start();

    if(isset($_SESSION['idusersession'])){
        $id_user = $_SESSION['idusersession'];
    }
    if(isset($_SESSION['idalbum'])){
        $id_album = $_SESSION['idalbum'];
    }
    if(isset($_SESSION['idcollezionne'])){
        $id_collezione = $_SESSION['idcollezione'];
    }


//////  FROM: add_card.php (album.php) ---  INSERIMENTO NEL DB DI UNA CARTA TRAMITE SET E NAME   //////////

if(isset($_POST['inserisci-carta']) AND isset($_SESSION['ONLY-LINK']) AND $_SESSION['ONLY-LINK'] == FALSE){

    $nome_set = $_POST['set_name'];
    $nome_carta = $_POST['card_name'];
    $conditions = $_POST['conditions'];
    $languages = $_POST['languages'];
    $quantity = $_POST['quantities'];
    $extravalues = $_POST['extravalues'];

    $nome_carta = preparation_name($nome_carta);
    $nome_set = preparation_set($nome_set);
    
   
    ////////  Gestire errori //////////
    if(empty($nome_set) || empty($nome_carta)){
        header("Location: ../album.php?error=emptyfields");
        exit();
    }
    if( $conditions==="--Conditions--" || $languages==="--Languages--" || $quantity==="--Quantities--" || $extravalues==="--Extra Values--"){
        header("Location: ../album.php?error=features-not-selected");
        exit();
    }
    
    ////// Check existance of the card and get the id   /////

    else{
      

        $sql = "SELECT Idcard FROM card WHERE Set_name = '$nome_set' AND Card_name = '$nome_carta'";
        $result = $connessione->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {

                $id_carta = $row['Idcard'];

                $sql = "INSERT INTO possesses (Iduser, Idcard, Idalbum, Quantity, Language, ExtraValues, Conditions) VALUES (?,?,?,?,?,?,?)";
                $stmt = mysqli_stmt_init($connessione);

                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../add_card.php?error=sqlerror");
                    exit();
                }else{    ////////modificareeee
                    mysqli_stmt_bind_param($stmt, "iiiisss", $id_user, $id_carta, $id_album, $quantity, $languages, $extravalues, $conditions );
                    mysqli_stmt_execute($stmt);


                header("Location: get_cards.php?CARD=INSERTED");
                exit();

                }
        }
        } else {
            //prova con la ricerca per nome e set e prendere l'id  
            //conenuto array: idProduct, Link della carta da completare, Nome Set, NOME CARTA IN ENGLISH
            $nome_carta = modify_name($nome_carta);
            $array_containing_id = array();
            $array_containing_id = search_for_name($nome_carta, $nome_set, $id_collezione);

            if(count($array_containing_id)>0){
                //sql insert into Table Possession
                $id_carta = $array_containing_id[0];
                                
                $sql = "INSERT INTO possesses (Iduser, Idcard, Idalbum, Quantity, Language, ExtraValues, Conditions) VALUES (?,?,?,?,?,?,?)";
                $stmt = mysqli_stmt_init($connessione);

                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../add_card.php?error=sqlerror");
                    exit();
                }else{    
                    mysqli_stmt_bind_param($stmt, "iiiisss", $id_user, $id_carta, $id_album, $quantity, $languages, $extravalues, $conditions );
                    mysqli_stmt_execute($stmt);
                    header("Location: get_cards.php?CARD=INSERTED");
                    exit();
                }
                

            }
            else{
                header("Location: ../album.php?error=SQL_CardNotInDB");
                exit();
            }

        }
        $connessione->close();
    }
}

//////  FROM: add_card.php (album.php) ---  INSERIMENTO NEL DB DI UNA CARTA TRAMITE LINK   //////////

else if( isset($_POST['inserisci-carta']) AND isset($_SESSION['ONLY-LINK']) AND $_SESSION['ONLY-LINK'] == TRUE){

    $link = $_POST['link_card'];
    $conditions = $_POST['conditions'];
    $languages = $_POST['languages'];
    $quantity = $_POST['quantities'];
    $extravalues = $_POST['extravalues'];  
   
    ////////  Gestire errori //////////
    if(empty($link)){
        header("Location: ../album.php?error=emptyfields");
        exit();
    }
    if( $conditions==="--Conditions--" || $languages==="--Languages--" || $quantity==="--Quantities--" || $extravalues==="--Extra Values--"){
        header("Location: ../album.php?error=features-not-selected");
        exit();
    } 

    ////// Check existance of the card and get the id   /////
    else{

        // Processamento del link della carta
        $a = manipulationlink($link);
        if($a == 0){
            header("Location: ../album.php?error=problemIntheLink");
            exit();
        }
        else{

            $nome_carta = $a[0];
            $nome_set = $a[1];

            $sql = "SELECT Idcard FROM card WHERE Set_name = '$nome_set' AND Card_name = '$nome_carta'";
            $result = $connessione->query($sql);

            if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {

                    $id_carta = $row['Idcard'];

                    $sql = "INSERT INTO possesses (Iduser, Idcard, Idalbum, Quantity, Language, ExtraValues, Conditions) VALUES (?,?,?,?,?,?,?)";
                    $stmt = mysqli_stmt_init($connessione);

                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        header("Location: ../add_card.php?error=sqlerror");
                        exit();
                    }else{    ////////modificareeee
                        mysqli_stmt_bind_param($stmt, "iiiisss", $id_user, $id_carta, $id_album, $quantity, $languages, $extravalues, $conditions );
                        mysqli_stmt_execute($stmt);


                        header("Location: get_cards.php?CARD=INSERTED");
                        exit();

                    }

            }
            } else {
                /// RICHIESTA PER NOME
                //prova con la ricerca per nome e set e prendere l'id  
                //conenuto array: idProduct, Link della carta da completare, Nome Set, NOME CARTA IN ENGLISH
                $array_containing_id = array();
                $array_containing_id = search_for_name($nome_carta, $nome_set, $id_collezione);

                if(count($array_containing_id)>0){
                    //sql insert into Table Possession
                    $id_carta = $array_containing_id[0];
                                    
                    $sql = "INSERT INTO possesses (Iduser, Idcard, Idalbum, Quantity, Language, ExtraValues, Conditions) VALUES (?,?,?,?,?,?,?)";
                    $stmt = mysqli_stmt_init($connessione);

                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        header("Location: ../add_card.php?error=sqlerror");
                        exit();
                    }else{    
                        mysqli_stmt_bind_param($stmt, "iiiisss", $id_user, $id_carta, $id_album, $quantity, $languages, $extravalues, $conditions );
                        mysqli_stmt_execute($stmt);
                        header("Location: get_cards.php?CARD=INSERTED");
                        exit();
                    }
                    

                }
                else{
                    header("Location: ../album.php?error=SQL_CardNotInDB");
                    exit();
                }

            }
        }
        $connessione->close();
    }

}



////////////   FROM: add_card.php (album.php) --- CANCELLAMENTO DI UNA CARTA DAL DB  ////////////

else if(isset($_GET['delete'])){

    $id_possession = $_GET['delete'];

    // sql to delete a record
    $sql = "DELETE FROM possesses WHERE Idpossession = '$id_possession' ";

    if ($connessione->query($sql) === TRUE) {

       
        header("Location: get_cards.php?Deleted=True");
        exit();
        //header a get_card con ? = deleted

    } else {
    echo "Error deleting record: " . $connessione->error;
    }

    $connessione->close();


}


?>


<?php

    function preparation_name(string $card_name)
    {
        $nome = $card_name;
        if (strpos($nome, ' (V.1)') == true){
            $nome = str_replace(' (V.1)', '', $nome);
        }
        if (strpos($nome, ' (V.2)') == true){
            $nome = str_replace(' (V.2)', '', $nome);
        }
    
        return $nome;
    }

    function preparation_set(string $card_set)
    {
        $nome_set = $card_set;
        
        if($nome_set === "Expedition"){
            $nome_set = "Expedition Base Set";
        }
        return $nome_set;
    }

    function manipulationlink($collegamento)
    {

        require "dbh.php";
          //https://www.cardmarket.com/en/Pokemon/Products/Singles/Wizards-Black-Star-Promos/Scizor-Pokemon-League
          $mystring = $collegamento;
          $pos = strpos($mystring, 'Singles');
  
          // Note our use of ===.  Simply == would not work as expected
          // because the position of 'a' was the 0th (first) character.
          if ($pos === false) {
              return 0;
          } else {
              $mystring = substr($mystring, $pos + 8, strlen($mystring));
              echo $mystring;
  
              $findme   = '/';
              $pos = strpos($mystring, $findme);
  
              $nome_set = substr($mystring, 0, $pos);
              $nome_carta = substr($mystring, $pos+1, strlen($mystring));
  
              //$array_carta = str_split($nome_carta);
              $nome_carta_in_array = explode("-", $nome_carta);
              $nome_set_in_array = explode("-", $nome_set);
  
              $numero_parole_carta = count( $nome_carta_in_array );
              $numero_parole_set = count( $nome_set_in_array);
  
              $nome_carta = str_replace("-", " ", $nome_carta);
              $nome_set = str_replace("-", " ", $nome_set);
  
              echo "Nome carta: " . $nome_carta;
              echo "Nome set: " . $nome_set;
              print_r($nome_carta_in_array);
              print_r($nome_set_in_array);
  
  
              $sql = "SELECT Card_name, Set_Name FROM card WHERE Card_name LIKE ";
              // PER LA CARTA
              if($numero_parole_carta > 1){
  
                 foreach( $nome_carta_in_array  as  $nomi ){
  
                    if($nomi === $nome_carta_in_array[$numero_parole_carta-1]){
                       $add_to_like = "'%". $nomi . "%'";
                       $sql = $sql . $add_to_like;
                       break;
                    }
                    else{
                       $add_to_like = "'%". $nomi . "%'";
                       $sql = $sql . $add_to_like;
                       $sql = $sql . " AND Card_name LIKE ";
                    }
                    
                 }
              }
              else {
                 $sql = $sql ."'%". $nome_carta_in_array[0] . "%'";
              }
  
              $sql = $sql . "AND Set_name LIKE ";
              //PER IL SET
  
              if($numero_parole_set > 1){
  
                 foreach( $nome_set_in_array  as  $nomi ){
  
                    if($nomi === $nome_set_in_array[$numero_parole_set-1]){
                       $add_to_like = "'%". $nomi . "%'";
                       $sql = $sql . $add_to_like;
                       break;
                    }
                    else{
                       $add_to_like = "'%". $nomi . "%'";
                       $sql = $sql . $add_to_like;
                       $sql = $sql . " AND Set_name LIKE ";
                    }
                    
                 }
              }
              else {
                 $sql = $sql ."'%". $nome_set_in_array[0] . "%'";
              } 
              
  
              $result = $connessione->query($sql);
  
              if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    
                    $a = array();
                    array_push($a, $row["Card_name"],  $row["Set_Name"]);
                    ///////////   punto definitivo   ////////// echo "Carta: " . $row["Card_name"] . " Set: ". $row["Set_Name"] . "<br>";        
                }
                return $a;
              
              } else {
                return 0;
              }
              $connessione->close();
              
  
        }
    }

    function search_for_name($nome_carta, $set_carta, $idcollezione)
    {

        //GET https://api.cardmarket.com/ws/v2.0/products/find?search=Springleaf%20Drum&exact=true&idGame=1&idLanguage=1

        //search=".$encoded_nome_carta."&idGame=".$idcollezione."&idLanguage=1

        $encoded_nome_carta = urlencode($nome_carta);

        $method             = "GET";
        $url                = "https://api.cardmarket.com/ws/v2.0/output.json/products/find";
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
        'oauth_version'             => $version,
        'search'                    => $nome_carta,
        'idGame'                    => $idcollezione,
        'idLanguage'                => 1
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
        $url = "https://api.cardmarket.com/ws/v2.0/output.json/products/find?search=".$encoded_nome_carta."&idGame=".$idcollezione."&idLanguage=1";

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
        $possessione = array();


        foreach ($jsonIterator as $key => $val) {
            if(is_array($val)) {
                //echo "$key:\n";
            } else {
                //echo "$key => $val\n";
                if( $key == "idProduct"){
                    array_push($aaa, $val);
                }
                if( $key == "expansionName"){
                    array_push($aaa, $val);
                }
                if( $key == "website"){
                    array_push($aaa, $val);
                }
                if( $key == "enName"){
                    array_push($aaa, $val);
                }
                
                

            }
        }

        for($i=0; $i<count($aaa); $i++){
            if($aaa[$i] == $set_carta){
                array_push($possessione, $aaa[$i-3]);
                array_push($possessione, $aaa[$i]);
                array_push($possessione, $aaa[$i-2]);

            }
        }

        require "dbh.php";

        $sql = "SELECT idExpansion FROM card,texp WHERE card.Set_name = texp.nameExpansion AND texp.nameExpansion = '$possessione[1]'";
        $result = $connessione->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {

            $id_carta = $possessione[0];
            $exp_name = $possessione[1];
            $c_name = $possessione[2];
            $id_exp = $row['idExpansion'];

            $sql = "INSERT INTO CARD (Idcard, Idset, Card_name, Set_name) VALUES (?,?,?,?)";
            $stmt = mysqli_stmt_init($connessione);

            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../add_card.php?error=sqlerror");
                exit();
            }else{    
                mysqli_stmt_bind_param($stmt, "iiss", $id_carta, $id_exp, $c_name, $exp_name);
                mysqli_stmt_execute($stmt);

                //INSERIMENTO RIUSCITO
            }

            }
        } else {
            header("Location: ../album.php?error=SQL_CardNotInDB");
            exit();
        }





        return $possessione;
        //conenuto array: idProduct, Link della carta da completare, Nome Set, NOME CARTA IN ENGLISH
    
        
        

    }

    
    function modify_name($card_name) 
    {

        
        if (strpos($card_name, ' δ') == true){
            $card_name =  str_replace(' δ', '', $card_name);
        }
        if (strpos($card_name, ']') == true){
            $card_name =  str_replace(']', '', $card_name);
        }
        if (strpos($card_name, '[') == true){
            $card_name =  str_replace('[', '', $card_name);
        }
        if (strpos($card_name, '|') == true){
            $card_name =  str_replace('|', '', $card_name);
        }
        if (strpos($card_name, ')') == true){
            $card_name =  str_replace(')', '', $card_name);
        }
        if (strpos($card_name, '(') == true){
            $card_name =  str_replace('(', '', $card_name);
        }
        if (strpos($card_name, '.') == true){
            $card_name =  str_replace('.', '', $card_name);
        }
        if (strpos($card_name, ',') == true){
            $card_name =  str_replace(',', '', $card_name);
        }
        if (strpos($card_name, '☆') == true){
            $card_name =  str_replace('☆', '', $card_name);
        } 

        
        return $card_name;
    }
?>





