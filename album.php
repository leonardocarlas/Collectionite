<?php
    require "header.php";

    $col_selected=$_SESSION['collezione-selezionata'];

    if(isset($_GET['OPEN'])){
        
        $album_corrente = $_GET['OPEN'];
        $_SESSION['album-selezionato'] = $album_corrente;
    }
    if(isset($_GET['ID'])){
        
        $id_album = $_GET['ID'];
        $_SESSION['idalbum'] = $id_album;
    }
    if(isset($_POST['selected-min&trend']))
    {
        $_SESSION['evaluation'] = "min&trend";
    }
    if(isset($_POST['selected-evaluation']))
    {
        $_SESSION['evaluation'] = "lan&cond";
    }

    $album_corrente = $_SESSION['album-selezionato'];
    
    $user = $_SESSION['usernamesession'];

    $idcollection = $_SESSION['idcollezione'];  

    $id_user = $_SESSION['idusersession'];

    $id_album = $_SESSION['idalbum'];
?>


    <div class="content-wrapper">
            <div class="content-header">
                <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    <h1 class="m-0 text-dark"> You are in the album: <?php echo $album_corrente; ?></h1>
                    </div><!-- /.col -->
                </div>
                <div class="row mb-2">
                    <a class="btn btn-primary" href="home.php">Back to Select the Album</a>
                </div>
                </div><!-- /.container-fluid -->
            </div>
        <div>
    </div>

       <!-- SELECTING THE EVALUATION METHOD -->

       <div class="content-wrapper">
            <div class="content-header">
                <div class="container">
                <div class="row justify-content-center mb-1">
                    <form action="album.php" method="POST">
                        <label for id="contenitore-pulsanti"><h5><p class="font-weight-bold">1. First Step.</p> Select the type of card evaluation.</h5>
                        <br>
                        <div class="btn-group" role="group" aria-label="Basic example" id="contenitore-pulsanti">
                            <button type="submit" name="selected-min&trend" class="btn btn-primary">Minimum & Trend Prices</button>
                            <button type="submit" name="selected-evaluation" class="btn btn-primary">Evaluation Prices based on Language & Condition</button>
                        </div>
                    </form>
                </div><!-- /.container-fluid -->
            </div>
        <div>
    </div>


<?php
    require "add_card.php";
    require 'php/dbh.php';

?>




<!--  GESTIONE ERRORI    -->

<?php   if(isset($_GET['Carte'])){  ?>

        <script type="text/javascript">
            Swal.fire(
            'Cards list is going to be ready. Please wait a few seconds',
            '',
            'success'
            );
        </script>

<?php } if(isset($_GET['Deleted'])){   ?>

        <script type="text/javascript">
            Swal.fire(
            'Deleted Card Succesfully',
            '',
            'success'
            );
        </script>

<?php  } if(isset($_GET['error'])){  ?>
            
            <?php  if($_GET['error'] == "emptyfields"){ ?>
                <div class="alert alert-danger" role="alert" >
                    Pay attention: you forgot to insert the card name or the set name.
                </div>

            <?php }?>
            
            <?php if($_GET['error'] == "features-not-selected"){  ?>
                <div class="alert alert-danger" role="alert">
                    Pay attention: you forgot to select the features of the cards.
                </div>

            <?php } ?>

            <?php if($_GET['error'] == "SQL_CardNotInDB"){  ?>
                <div class="alert alert-danger" role="alert">
                    There is a problem. Or you have wrongly inserted the card name &/or set or the site has a probelm. Retry. If the problem still exists, contact us in the spot for that.
                </div>

            <?php } ?>


<?php } ?>


    


    <?php
        if(isset($_GET['Carte'])){
            
            $sql = "SELECT Idpossession, card.Idcard, Card_name, Set_name, Quantity, Language, ExtraValues, Conditions FROM possesses JOIN card ON possesses.Idcard = card.Idcard WHERE possesses.Iduser = '$id_user' AND possesses.Idalbum = '$id_album' " ;
            $result = $connessione->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
            ?>
            <div class="row justify-content-center mt-5">
                <div class="col-12">
                    <div class="card card-info card-outline">
                        <div class="card-header">
                        <h3 class="card-title">Titolo</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example2" class="table table-bordered table-hover dataTable" role="grid">
                                        <thead>
                                            <tr>
                                                <th scope="col">Card Name</th>
                                                <th scope="col">Card Set</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Language</th>
                                                <th scope="col">Extra Values</th>
                                                <th scope="col">Conditions</th>

                                            <?php if(isset($_SESSION['evaluation']) && $_SESSION['evaluation'] == "min&trend"){ ?>

                                                <th scope="col">Minimum Price</th>
                                                <th scope="col">Trend Price</th>

                                            <?php } else if(isset($_SESSION['evaluation']) && $_SESSION['evaluation'] == "lan&cond") { ?>

                                                <th scope="col">Evaluation Price</th> 

                                            <?php }  ?>

                                                <th scope="col">Open it in cardmarket.com</th>                                  
                                                <th  scope="col">Action</th>
                                            </tr>
                                        </thead>
                
                                <!--
                                    //print_r($carte);  echo count($carte);
                                    //<td> <a href="php/cardinsert.php?edit='. $row['CardName'].'">Edit Name</a> </td>
                                    $_SESSION['evaluation'] = "min&trend";
                                --> 

                                <?php    
                                    while($row = $result->fetch_assoc()) {  ?>
                                <tbody>
                                    <tr>
                                        <td> <?php echo $row['Card_name'] ?></td>
                                        <td> <?php echo $row['Set_name'] ?></td>
                                        <td> <?php echo $row['Quantity'] ?></td>
                                        <td> <?php echo $row['Language'] ?></td>
                                        <td> <?php echo $row['ExtraValues'] ?></td>
                                        <td> <?php echo $row['Conditions'] ?></td>

                                    <?php if(isset($_SESSION['evaluation']) && $_SESSION['evaluation'] == "min&trend"){ 
                                            $lo = low_trend($row['Idcard']);
                                                    ?>

                                        <td> <?php echo $lo[1]; ?></td>
                                        <td> <?php echo $lo[2]; ?>   </td>

                                    
                                    <?php } else if(isset($_SESSION['evaluation']) && $_SESSION['evaluation'] == "lan&cond") { ?>

                                        <td> <?php 
                                                    $media = avarage_price($row['Idcard'], lingua($row['Language']), $row['Conditions']);
                                                    if($media != 0){
                                                        echo $media;
                                                    }
                                                    else
                                                    {
                                                        echo "For this card there is a problem. Pls contact us about it, meanwhile check it on Minimum & Trend ";
                                                    }    
                                        ?></td>
                                    <?php } ?>

                                        <td> <?php  
                                            if(isset($_SESSION['evaluation']) && $_SESSION['evaluation'] == "min&trend"){
                                                    $link = $lo[0];
                                            }else{
                                                    $link = li($row['Card_name'],$row['Set_name']);
                                            }
                                                    echo '<a href="'.$link.'">link<a>';

                                        ?></td>

                                        
                                        <td> <?php 
                                                $delete = "php/cardinsert.php?delete=" . $row['Idpossession'] ;
                                                echo '<a href="'.$delete.'">Delete Card</a> </td> ';  ?> 
                                        </td>
                                    </tr>

                                <?php   }   ?> 
                        </tbody> 
                    </table> 
                    </div> 
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
    <?php           
            }
            else {
                trigger_error('Invalid query: ' . $connessione->error);
            }
            
            
        }  
        ?>

    </div>
    </div>



<br><br><br><br><br><br>
<?php
    require "footer.php";
?>

<?php

function preparation_name($card_name){
    $nome = $card_name;
    if (strpos($nome, ' (V.1)') == true){
        $nome = str_replace(' (V.1)', '', $nome);
    }
    if (strpos($nome, ' (V.2)') == true){
        $nome = str_replace(' (V.2)', '', $nome);
    }
    return $nome;
}
?>

<?php
    
    function li($card_name,$set_name) {

        if(isset($_SESSION['namecollection'])){
            $name_collection = $_SESSION['namecollection'];
        }

        //https://www.cardmarket.com/it/Pokemon/Products/Singles/Darkness-Ablaze/Butterfree-V-Dizzying-Poison-Blasting-Wind
        $li = "https://www.cardmarket.com/en/";
        
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
        if (strpos($card_name, '☆') == true){
            $card_name =  str_replace('☆', '', $card_name);
        } 

        

        $card_name= preg_replace('/\s+/', '-', $card_name);
        $set_name= preg_replace('/\s+/', '-', $set_name);

        $li = $li.$name_collection."/Products/Singles/".$set_name."/".$card_name;
        
        return $li;
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

