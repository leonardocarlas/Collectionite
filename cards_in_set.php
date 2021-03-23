<?php
    require "header.php";
    require "php/dbh.php";
?>



<!-- Time Line -->

<div class="row mb-2">
    <div class = "col">
        <h5><a href= "home.php" >My collection </a></h5>  > <h5>Album: <?php echo $_SESSION['album-selezionato']; ?></h5> > <h5>Aggiungi carte</h5> > <h5>Set completo</h5>
    </div>   
</div>





<?php
if(isset($_GET['EXP']))
{
    $id_espansione = mysqli_real_escape_string($connessione, $_GET['EXP']);

    $carte_nel_set = cards_in_the_set($id_espansione);

                                     ?>
    
    <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="img01">
        <div id="caption">
        </div>
    </div>

    <div class="card card-info card-outline">
        <div class="card-header">
            <h3 class="card-title">Carte presenti nel set <?php echo $carte_nel_set[3]; ?></h3>
        </div>
        
        <div class="card-body">
            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
                <div class="col-sm-12 table-responsive">
                    <table id="example" class="display table table-striped table-bordered table-hover display" role="grid" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">Image</th>
                                <th scope="col">Card Number</th>
                                <th scope="col">Card Name</th>
                                <th scope="col">Expansion</th>
                                <th scope="col">Action</th>   
                            </tr>
                        </thead> 
                        <tbody>  
                                <?php
                                $contatore_carte = count($carte_nel_set)/4;
                                for($i = 0; $i < count($carte_nel_set); $i = $i + 4)
                                {
                                    $numero_carta = intdiv($i, 4) + 1;
                                    $imgId = 'myImg'.$numero_carta;
                                    echo '<tr>';
                                    echo '<td><img class="carta_pokemon"
                                                    alt="'.$carte_nel_set[$i+1].'"
                                                    src="'.$carte_nel_set[$i].'" alt="alternatetext" width = "200" height = "250"
                                                    class="myImg"
                                                    id="'.$imgId.'"
                                              ></td>';
                                    echo '</td>';
                                    echo '<td>'. $numero_carta .' su '.$contatore_carte.'</td>';
                                    echo '<td>'.$carte_nel_set[$i+1].'</td>';
                                    echo '<td>'.$carte_nel_set[$i+2].'</td>';
                                    $link_for_adding = 'php/CRUD_card.php?Insertcard='.$carte_nel_set[$i+3];
                                    echo '<td><a href='.$link_for_adding.'>Aggiungi Carta</td>';
                                    echo '</tr>';
                                    //echo "Nome della carta: ". $returned_cards[$i+1]." Id carta: ".$returned_cards[$i]. " <img src='".$returned_cards[$i+2]."' alt='alternatetext' width = '10' height = '15'> <br>";                            
                                }

                                ?>
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table> 
                </div><!-- /.col-sm-12 -->
            </div><!-- /.row -->
            </div><!-- /.wrapper -->
        </div><!-- /.cardbody -->
        <script>
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

        </script>
    </div><!-- /.card -->


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
                    while($row = $result->fetch_assoc()) {

                        $carte_nel_set = array();
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