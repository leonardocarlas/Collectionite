<?php
    require "header.php";
    require "php/dbh.php";

?>



<!-- Time Line -->

<div class="d-flex flex-row m-4">
    <h5><a href= "home.php" class="text-dark"> <u> My collection </u></a></h5>
    <h5> > </h5>
    <h5><a href= "album.php" class="text-dark"> <u> Album: <?php echo $_SESSION['album-selezionato']; ?> </u></a></h5>
    <h5> > </h5>
    <h5><a href= "new_add_card.php" class="text-dark"> <u> Aggiungi carte </u></a></h5>
    <h5> > </h5>
    <h5> Espansione </h5>
</div>




<?php

if(isset($_GET['EXP'])) {

    $array_carte_album = $_SESSION['carte_album_corrente'] ;

    $id_espansione = mysqli_real_escape_string($connessione, $_GET['EXP']);

    $carte_nel_set = cards_in_the_set($id_espansione);
    
    $numero_carte = (count($carte_nel_set))/4;

    $righe = floor($numero_carte / 5); //27 = 5 * 5 + 2
 
    $riporto = $numero_carte % 5;
    
    $intersezione_carte = array_intersect($array_carte_album, $carte_nel_set);

    $int_percentage = count($intersezione_carte) / $numero_carte;
?>
    
    <div class="row justify-content-center">
        <h1>Carte presenti nel set <?php echo $carte_nel_set[2]; ?></h1>
    </div>

    <br>

    <div class="w3-light-grey w3-round-xlarge">
        <?php echo '<div class="w3-container w3-blue w3-round-xlarge" style="width:'.$int_percentage.'%">'.$int_percentage.'%</div>'; ?>
    </div>

    <br><br>


<!-- 
    <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="img01">
        <div id="caption">
        </div>
    </div>
-->
    <?php

        // Scanditore dell'array delle carte
        $k = 0;

        // Inserimento nell'array $carte_nel_set, $row['Image_link'], $row['English_card_name'], $row['English_Set_name'], $row['Idcard']
        for ($i = 0 ; $i < $righe;  $i++ ) {

            echo '
            
                <div class="row">
            ';
            //if (in_array($carte_nel_set[$k+3], $array_carte_album)) echo 'V';
            for ($j = 0; $j < 5; $j++) {
                echo '
                    <div class="col">
                        <div class="row justify-content-center">
                            <img class="carta_pokemon" alt="'.$carte_nel_set[$k + 1].'" src="'.$carte_nel_set[$k].'" alt="alternatetext" width = "200" height = "250" class="myImg" id="'.'myImg'. ($k + 1) .'">
                        </div>
                        <div class="row justify-content-center">
                            <h4>'. (($k/4)+1).' / '. $numero_carte .'</h4>
                        </div>
                        <div class="row justify-content-center">';
                            if (in_array($carte_nel_set[$k+3], $array_carte_album)){
                                echo '<del>';
                            }
                            echo   '<h6 style = "text-align: center;" >'. $carte_nel_set[$k + 1] .'</h6>';
                            if (in_array($carte_nel_set[$k+3], $array_carte_album)) {
                                echo '</del>';
                            }
                        echo '
                        </div>
                        <div class="row justify-content-center">
                            <button class="btn text-white" ';
                        if (in_array($carte_nel_set[$k+3], $array_carte_album)){
                            echo ' disabled ';
                        }
                        echo 'style="background-color: #5401a7;" type = "button" onclick="insert_card('.$carte_nel_set[$k + 3] .')"> Aggiungi Carta </button>
                        </div>
                    </div>
                ';

                $k += 4;

            }
     
            echo ' </div>';
            echo '<br>'; 
            
        }

        if ( $riporto > 0 ) {

            echo '<div class="row">';

            for ( $r = 0; $r < $riporto; $r++ ) {

                echo '
                    <div class="col">
                        <div class="row justify-content-center">
                            <img class="carta_pokemon" alt="'.$carte_nel_set[$k + 1].'" src="'.$carte_nel_set[$k].'" alt="alternatetext" width = "200" height = "250" class="myImg" id="'.'myImg'. ($k + 1) .'">
                        </div>
                        <div class="row justify-content-center">
                            <h3>'. (($k/4)+1).' / '. $numero_carte .'</h3>
                        </div>
                        <div class="row justify-content-center">
                            <h5>'. $carte_nel_set[$k + 1] .'</h5>
                        </div>
                        <div class="row justify-content-center">
                            <button class="btn text-white" style="background-color: #5401a7;" type = "button" onclick="insert_card('.$carte_nel_set[$k + 3] .')"> Aggiungi Carta </button>
                        </div>
                    </div>
                    <br>
                ';
                
                $k += 4;
            }
            echo '</div>';

        }

        ?>





        
        <!--<script>
                        // Get the modal
                        var modalImg = document.getElementById("img01");
                        var captionText = document.getElementById("caption");
                        var modal = document.getElementById("myModal");
                        for (i = 1; i < 100; i++) {
                            var img = document.getElementById("myImg" + i);
                        
                          img.onclick = function() {
                            modal.style.display = "block";
                            modalImg.src = this.src;
                            captionText.innerHTML = this.alt;
                            var span = document.getElementsByClassName("close")[0];
                            span.onclick = function() { 
                            modal.style.display = "none";
                            }
                          }
                          // Get the <span> element that closes the modal
                        }
                        // When the user clicks on <span> (x), close the modal

        </script>-->
    </div><!-- /.card -->








<script type ="text/javascript">

    function insert_card(id_card){
        $.post("php/CRUD_card.php",{"insert_id_card":id_card},function(data){
                if(data.trim() == "success")
                {
                    Swal.fire({
                        icon: 'success',
                        title: 'Carta inserita',
                        });
                }
            });
    }

</script>











<?php
}
?>

<br><br><br>

<?php 
    require "footer.php";
?>


<?php
    function cards_in_the_set($id_espansione){
    
        require "php/dbh.php";
        $sql = "SELECT cards.Idcard, cards.English_card_name, cards.Image_link, expansion.English_Set_name
        FROM cards
        INNER JOIN expansion ON cards.Idset = expansion.Idset
        WHERE cards.Idset = ?
        GROUP BY cards.Idcard; " ;

        $stmt = mysqli_stmt_init($connessione);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "Error in the database";
        }
        else{
                mysqli_stmt_bind_param($stmt, "i", $id_espansione);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt); 

                if ($result->num_rows > 0) {
                    $carte_nel_set = array();
                    while($row = $result->fetch_assoc()) {
                        
                        array_push($carte_nel_set, $row['Image_link'], $row['English_card_name'], $row['English_Set_name'], $row['Idcard']);
                    }
                    return $carte_nel_set;
                }
                else{
                    $vuoto = array();
                    return $vuoto;
                }

        }
        mysqli_stmt_close($stmt);
        mysqli_close($connessione);
    }

?>


 














<?php

function old_cards_in_the_set($id_set)
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




?>