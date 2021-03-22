<?php
    require "header.php";
    require 'php/dbh.php';

    $total_avarage = 0;
    $total_trend = 0;
    $total_min = 0;

    $inserimento_per_link = false;
    $inserimento_per_set_nome = false;
    $ricarica_prezzi_min_trend = false;
    $ricarica_prezzi_lan_cond = false;


    // APERTURA DA HOME.PHP, DOPO AVER SELEZIONATO L'ALBUM   --------   NORMAL MODE
    if(isset($_GET['ID']) && isset($_GET['NAME']) ){
        $_SESSION['album-selezionato'] =  mysqli_real_escape_string($connessione, $_GET['NAME']);
        $id_album = mysqli_real_escape_string($connessione, $_GET['ID']);
        $_SESSION['idalbum'] = $id_album;    
    }

    

    if( isset( $_POST['EV']) AND $_POST['EV']=="Minimum & Trend Prices"){
        $ricarica_prezzi_min_trend = TRUE;
    }
    if( isset( $_POST['EV']) AND $_POST['EV']=="Evaluation Prices based on Language & Condition"){
        $ricarica_prezzi_lan_cond = TRUE;
    }
    if(isset( $_POST['INS']) AND $_POST['INS']=="Set & Name"){
        $inserimento_per_set_nome = TRUE;
        $_SESSION['ONLY-LINK'] = FALSE;
    }
    if(isset( $_POST['INS']) AND $_POST['INS']=="Only Link"){
        $inserimento_per_link = TRUE;
        $_SESSION['ONLY-LINK'] = TRUE;
    }


    //VARIABILI GLOBALI
    $album_corrente = $_SESSION['album-selezionato'];
    $user = $_SESSION['usernamesession'];
    $idcollection = $_SESSION['idcollezione'];  
    $id_user = $_SESSION['idusersession'];
    $id_album = $_SESSION['idalbum'];

?>

<!-- 1. Time Line -->

    <div class="row mb-2">
        <div class = "col">
            <h5><a href= "home.php" >My collection </a></h5> <p> ></p> <h5 >Album: <?php echo $_SESSION['album-selezionato']; ?></h5> 
        </div>   
    </div>
            
<!-- 1.E FINISH -->



<!-- 2.E E NORMAL INSERT NEW CARD -->
<?php
/*
    require "add_card.php";
*/
?>
<br><br>
<div class="row justify-content-center">
    <div class="col-auto-sm">
        <a class="btn text-white" href="new_add_card.php" style="background-color: #5401a7;">
        <h4>Aggiungi nuove carte all'album</h4>
        <img src="immagini/tre_carte.png" width="30" height="30">
        </a>
    </div>
</div>

<!-- 2.E FINISH -->





<!--  GESTIONE ERRORI    -->

<?php   if(isset($_GET['CARD'])){  ?>

        <div class="alert alert-success" role="alert" >
            La carta è stata inserita correttamente.
        </div>

<?php } if(isset($_GET['Deleted'])){   ?>

        <script type="text/javascript">
            Swal.fire(
            'La carta è stata rimossa dall\'album',
            '',
            'success'
            );
        </script>

<?php } ?>














<!-- Tabella delle carte. Vengono mostrati tutti i dati delle carte contenute dall'utente in quell'album -->

<?php

    $array_carte = get_cards_for_the_album($id_user, $id_album);

    if (empty($array_carte)) {

        // Non ci sono carte, mostro solamente la tabella all'utente e spiego che non sono presenti

        echo "<br><br>" . "Non hai ancora inserito carte per questo album". "<br>";
    }
    else {

        // Sono già state inserite delle carte, le mostro nella tabella
            
?>

    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
        <div class="row justify-content-center">
            <div class="col-sm-12 table-responsive">
                <table id="example2" class="table table-bordered table-hover dataTable" role="grid">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Carta</th>
                            <th scope="col">Espansione</th>
                            <th scope="col">Min Price</th>
                            <th scope="col">Trend Price</th>
                            <th scope="col">Quantità</th>
                            <th scope="col">Lingua</th>
                            <th scope="col">Valori Extra</th>
                            <th scope="col">Condizioni</th>
                            <th scope="col">Evaluation Price</th> 
                            <th scope="col">Link</th>      
                            <th scope="col">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Solo per debugging:  array_push($dati_tabella, $row['Idcard'], $row['Idset'], $row['Image_link'], $row['Min_value'], $row['Trend_Value'], $row['Quantity'], $row['Language'], $row['ExtraValues'], $row['Conditions'], $row['Website'] ); -->
                        <?php for($i = 0; $i < count($array_carte); $i = $i + 10) { ?>
                            <tr>
                                <td> <?php echo $i/10 ?></td>
                                <td> <?php echo $array_carte[$i] ?></td>
                                <td> <?php echo $array_carte[$i+1] ?></td>
                                <td> <?php echo $array_carte[$i+3] ?></td>
                                <td> <?php echo $array_carte[$i+4] ?></td>
                                <td> <?php echo $array_carte[$i+5] ?></td>
                                <td> <?php echo $array_carte[$i+6] ?></td>
                                <td> <?php echo $array_carte[$i+7] ?></td>
                                <td> <?php echo $array_carte[$i+8] ?></td>
                                <td> <?php echo " - "?></td>
                                <td> <?php $link = "https://www.cardmarket.com" . $array_carte[$i+9];  echo '<a href="'.$link.'"> link </a>'; ?></td>
                                <td> <?php echo 'Elimina - Modifica ' ?></td>
                            
                            </tr>
                        <?php } ?>
                    </tbody>
                </table> 
            </div><!-- /.col-sm-12 -->
        </div><!-- /.row -->
    </div><!-- /.wrapper -->

    
<?php 
    } 

?>









<!-- 5.E VMODE & NORMAL. GRAFICO-->

<?php

$sql = "SELECT Stat_date, Trend_value, Min_value FROM statistic WHERE Idalbum = ? ";
$stmt = mysqli_stmt_init($connessione);
if(!mysqli_stmt_prepare($stmt, $sql)){
     echo "Error in the database";
}
else{
        mysqli_stmt_bind_param($stmt, "i", $id_album);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt); 

        if ($result->num_rows > 0) {

            $chart_data = '';
            while($row = $result->fetch_assoc()) {
                $ora_in_breve = $row["Stat_date"];
                $ora_in_breve = substr($ora_in_breve, 0, 10); 
                $chart_data .= "{ date:'". $ora_in_breve ."', Trend_value:".$row["Trend_value"].",  Min_value:".$row["Min_value"]."}, ";
            }
            $chart_data = substr($chart_data, 0, -2); //elimina },
            $no_data = false;

        } else {
          $no_data = true;
        }

}
mysqli_stmt_close($stmt);
mysqli_close($connessione);


?>

    <div class="row justify-content-center mt-5">
            <div class="col-10">
                <div class="card">

                        <div class="card-header">
                            <?php if( $no_data == true) { ?>
                                <h3 class="card-title">L'album non è ancora stato registrato</h3>
                            <?php } else { ?>
                                <h3 class="card-title">Dati dell'album</h3>
                            <?php } ?>
                        </div><!-- /.card-header -->                      
                        

                        <div class="card-body">
                            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="container" style="width:900px;">

                                        <br /><br />
                                        <div id="chart"></div>

                                    </div>
                                </div>
                            </div>
                        </div> <!-- /.card-body -->
                </div> <!-- /.card-->
        </div><!-- /.col-->
    </div><!-- /.row-->

    <script>
        Morris.Line({
        element : 'chart',
        data:[<?php echo $chart_data; ?>],
        xkey:'date',
        ykeys:['Trend_value','Min_value'], 
        labels:['Trend Value', 'Min Value'],
        hideHover:'auto',
        stacked:true
        });
    </script>

<!-- 5.E FINISH-->


    </div>
</div>



<?php   
   ////   SCRIPT TO UPLOADS IN THE DATABASE THE VALUES

?>



<br><br><br>

<?php
    require "footer.php";
?>





<?php
    function get_cards_for_the_album($id_user, $id_album){

        require "php/dbh.php";
        $sql = "SELECT Idpossession, cards.Idcard, Idset, Quantity, 
        Language, ExtraValues, Conditions, cards.Website, cards.Image_link, prices.Min_value, prices.Trend_Value
        FROM possesses 
        INNER JOIN cards ON possesses.Idcard = cards.Idcard
        INNER JOIN prices ON prices.Idcard = possesses.Idcard 
        WHERE possesses.Iduser = ? AND possesses.Idalbum = ?
        GROUP BY possesses.Idcard; " ;

        $stmt = mysqli_stmt_init($connessione);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "Error in the database";
        }
        else{
                mysqli_stmt_bind_param($stmt, "ii", $id_user, $id_album);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt); 

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {

                        $dati_tabella = array();
                        array_push($dati_tabella, $row['Idcard'], $row['Idset'], $row['Image_link'], $row['Min_value'], $row['Trend_Value'], $row['Quantity'], $row['Language'], $row['ExtraValues'], $row['Conditions'], $row['Website'] );
                    }
                    return $dati_tabella;
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
    function avarage_price( $id, $lan, $con){

        $id_product = $id;
        $language = 5 ;
        $cond = $con;
        $maxResults = 5;
        $start = 0;
        
        $method             = "GET";
        $url                = "https://api.cardmarket.com/ws/v2.0/output.json/articles/".$id_product;
        $appToken           = "D5lSR859bgB50sVj";
        $appSecret          = "DLszKXEZCrNbZRQ8dTc1kLo6QxyDkicR";
        $accessToken        = "";
        $accessSecret       = "";
        $nonce              = "53eb1f44909d6";
        $timestamp          = "1407917892";
        $signatureMethod    = "HMAC-SHA1";
        $version            = "1.0";

        $params             = array(
           'realm'                     => $url,
           'oauth_consumer_key'        => $appToken,
           'oauth_token'               => $accessToken,
           'oauth_nonce'               => $nonce,
           'oauth_timestamp'           => $timestamp,
           'oauth_signature_method'    => $signatureMethod,
           'oauth_version'             => $version,
           'idLanguage'                => $language,
           'minCondition'              => $cond,
           'start'                     => $start,
           'maxResults'                => $maxResults
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

        $url = "https://api.cardmarket.com/ws/v2.0/output.json/articles/".$id_product. "?idLanguage=".$language."&minCondition=".$cond."&start=".$start."&maxResults=".$maxResults;
        
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

        if(strlen($content)!=0)
        {
            //$decoded            = json_decode($content);
            //$decoded            = simplexml_load_string($content);
            
            //echo "Contenuto  ". $content;
            //echo "Informazioni  ";
            //print_r($info );

            
            $jsonIterator = new RecursiveIteratorIterator(
            new RecursiveArrayIterator(json_decode($content, TRUE)),
            RecursiveIteratorIterator::SELF_FIRST);
            
            $prezzi = array();
            $verification = false;
            
            foreach ($jsonIterator as $key => $val) {
                if(is_array($val)) {
                    //echo "$key:\n";
                } else {
                    //echo "$key => $val\n";
                    if($key == "comments"){
                            $verification = true;
                    }
                    if($key == "price" and $verification == true){
                        array_push($prezzi, $val);
                        $verification =false;
                    }
                    
                }
            }
            if(count($prezzi)) {
            $average = array_sum($prezzi)/count($prezzi);
            }
        
        } else {
            $average = 0;
        }

        return $average;


    }
?>


<?php
//1 for English; 2 for French; 3 for German; 4 for Spanish; 5 for Italian; 6 for Simplified Chinese; 7 for Japanese;
// 8 for Portuguese; 9 for Russian; 10 for Korean; 11 for Traditional Chinese)
    function lingua($l)
    {
        $id_language = 0;
        if($l == "English")
        {
            $id_language = 1 ;
        }
        if($l == "French")
        {
            $id_language = 2;
        }
        if($l == "German")
        {
            $id_language = 3;
        }
        if($l == "Spanish")
        {
            $id_language = 4;
        }
        if($l == "Italian")
        {
            $id_language = 5;
        }
        if($l == "Simplified Chinese")
        {
            $id_language = 6;
        }
        if($l == "Japanese")
        {
            $id_language = 7;
        }
        if($l == "Portuguese")
        {
            $id_language = 8;
        }
        if($l == "Russian")
        {
            $id_language = 9;
        }
        if($l == "Korean")
        {
            $id_language = 10;
        }
        if($l == "Traditional Chinese")
        {
            $id_language = 11;
        }
        return $id_language;
    }
?>


<?php

    function low_trend($idcarta){

        $id_product = $idcarta;


        $method             = "GET";
        $url                = "https://api.cardmarket.com/ws/v2.0/output.json/products/".$id_product;
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
        $url = "https://api.cardmarket.com/ws/v2.0/output.json/products/".$id_product;

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

        $low_trend = array();

        foreach ($jsonIterator as $key => $val) {
            if(is_array($val)) {
                
            } else {
                
                if($key == "LOW"){
                        array_push($low_trend, $val);
                }
                if($key == "TREND"){
                    array_push($low_trend, $val);
                }
                if($key == "website"){
                    array_push($low_trend, $val);
                   }
                  
                  
                  
              }
            }
        $uncomplete_link = $low_trend[0];
        $complete_link = "https://www.cardmarket.com".$uncomplete_link ;
        $low_trend[0] = $complete_link;

        return $low_trend;

}//chiusura funzione


?>



<?php
    function manipulationlink($collegamento){
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
        }


    }

?>

