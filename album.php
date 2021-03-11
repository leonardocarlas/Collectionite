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

<?php  } if(isset($_GET['error'])){  ?>
            
            <?php  if($_GET['error'] == "emptyfields"){ ?>
                <div class="alert alert-danger" role="alert" >
                    Attento: hai dimenticato di inserire il nome del set o il nome della carta.
                </div>

            <?php }?>
            
            <?php if($_GET['error'] == "features-not-selected"){  ?>
                <div class="alert alert-danger" role="alert">
                    Attento: hai dimenticato di inserire le caratteristiche della carta.
                </div>

            <?php } ?>

            <?php if($_GET['error'] == "SQL_CardNotInDB"){  ?>
                <div class="alert alert-danger" role="alert">
                    L'inserimento della carta non è andato a buon fine. Se hai provato l'opzione "Only Link" prova ora "Set & Name" o viceversa. Se il problema persiste, contattaci attraverso la pagina "Contattaci".
                </div>

            <?php } ?>

            <?php if($_GET['error'] == "strangeerror"){  ?>
                <div class="alert alert-danger" role="alert">
                    L'inserimento della carta non è andato a buon fine. Se hai provato l'opzione "Only Link" prova ora "Set & Name" o viceversa. Se il problema persiste, contattaci attraverso la pagina "Contattaci".
                </div>

            <?php } ?>

            <?php if($_GET['error'] == "problemIntheLink"){  ?>
                <div class="alert alert-danger" role="alert">
                    Sembra che il link di cardmarket non sia stato copiato correttamente. Ricontrolla e riprova.
                </div>

            <?php } ?>


<?php } ?>


    
<!-- 4.E NORMAL & VMODE TABLE OF CARDS -->

<?php
            
$sql = "SELECT Idpossession, card.Idcard, Card_name, Set_name, Quantity, Language, ExtraValues, Conditions FROM possesses JOIN card ON possesses.Idcard = card.Idcard WHERE possesses.Iduser = ? AND possesses.Idalbum =? " ;
$stmt = mysqli_stmt_init($connessione);
if(!mysqli_stmt_prepare($stmt, $sql)){
    echo "SQL error";
}
else{
        mysqli_stmt_bind_param($stmt, "ii", $id_user, $id_album);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

            if ($result->num_rows > 0) 
            {
                // output data of each row
                ?>
                <div class="row justify-content-center mt-5">
                <div class="col-12">
                    <div class="card card-primary card-outline">

                        <div class="card-header">
                            <h3 class="card-title">Album: <?php echo $album_corrente; ?> </h3>
                        </div><!-- /.card-header -->

                        <br>

                        <div class="card-header">
                            <div class="row justify-content-center">
                                <div class="col-sm-auto">
                                    <text>
                                        <h5><p class="font-weight-bold">2. Secondo step.</p> Seleziona il tipo di valutazione delle carte. Il sito impiegherà <br> pochi secondi per aggiornare tutti i prezzi delle carte.</h5>
                             
                                    <div class="btn-group" role="group" aria-label="Basic example" id="contenitore-pulsanti">
                                        <form action="album.php" method="POST">
                                            <div class="form-group">
                                                <input type="submit" name="EV" class="btn text-white" style="background-color: #5401a7;" value="Minimum & Trend Prices">
                                            </div>
                                        </form>
                                        <form action="album.php" method="POST">
                                            <div class="form-group">
                                                <input type="submit" name="EV" class="btn text-white" style="background-color: #5401a7;" value="Evaluation Prices based on Language & Condition">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                                    
                        </div>

                        <br>
                        
                        <div class="card-body">
                            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12 table-responsive">
                                    <table id="example2" class="table table-bordered table-hover dataTable" role="grid">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nome della carta</th>
                                                <th scope="col">Nome del Set</th>
                                                <th scope="col">Quantità</th>
                                                <th scope="col">Lingua</th>
                                                <th scope="col">Valori Extra</th>
                                                <th scope="col">Condizioni</th>

                                            <?php if( $ricarica_prezzi_min_trend == TRUE){ ?>

                                                <th scope="col">Prezzo minimo</th>
                                                <th scope="col">Tendenza di prezzo</th>

                                            <?php } else if($ricarica_prezzi_lan_cond == TRUE) { ?>

                                                <th scope="col">Prezzo di valutazione</th> 

                                            <?php }  ?>

                                                <th scope="col">Aprilo su cardmarket.com</th>      
                                                <th  scope="col">Azioni</th>

                                            </tr>
                                        </thead>


                                        <?php    
                                            while($row = $result->fetch_assoc()) {  ?>
                                        <tbody>
                                            <tr>
                                                <th scope="row"> <?php echo $row['Card_name'] ?></td>
                                                <td> <?php echo $row['Set_name'] ?></td>
                                                <td> <?php echo $row['Quantity'] ?></td>
                                                <td> <?php echo $row['Language'] ?></td>
                                                <td> <?php echo $row['ExtraValues'] ?></td>
                                                <td> <?php echo $row['Conditions'] ?></td>

                                            <?php if( $ricarica_prezzi_min_trend === TRUE ){ 
                                                    $lo = low_trend($row['Idcard']);
                                            ?>

                                                <td> <?php echo $lo[1]; $total_min = $total_min + $lo[1]; ?></td>
                                                <td> <?php echo $lo[2]; $total_trend = $total_trend + $lo[2]; ?>   </td>

                                            
                                            <?php } else if($ricarica_prezzi_lan_cond === TRUE) { ?>

                                                <td> <?php 
                                                            $media = avarage_price($row['Idcard'], lingua($row['Language']), $row['Conditions']);
                                                            if($media != 0){
                                                                echo $media;
                                                                $total_avarage = $total_avarage + $media;
                                                            }
                                                            else
                                                            {
                                                                echo "For this card there are too few data. Check it on Minimum & Trend option";
                                                            }    
                                                        ?>
                                                </td>
                                                <?php } ?>

                                                    <td> <?php  
                                                        if( $ricarica_prezzi_min_trend === TRUE ){
                                                                $link = $lo[0];
                                                        }else{
                                                                $link = li($row['Card_name'],$row['Set_name']);
                                                        }
                                                                echo '<a href="'.$link.'">link<a>';

                                                        ?>
                                                    </td>
                                                    <td> <?php
                                                        
                                                            $delete = "php/cardinsert.php?delete=" . $row['Idpossession'] ;
                                                            echo '<a href="'.$delete.'">Elimina carta</a> </td> '; 
                                                        ?> 
                                                    </td>
                                                </tr>

                                                <?php   }   ?>

                                            </tbody>
                                            <tr>
                                                <?php 
                                                    if( $ricarica_prezzi_min_trend === TRUE){
                                                        echo  '
                                                            <td> Prezzo totale dell\'album: </td> 
                                                            <td> Prezzo minimo: '.$total_min.' </td>
                                                            <td> Prezzo di tendenza: '.$total_trend.' </td>' ; 
                                                    } else{
                                                        echo '
                                                            <td> Prezzo totale dell\'album: </td> 
                                                            <td> Prezzo di valutazione: '.$total_avarage.' </td> ';

                                                    }
                                                ?> 
                                            </tr>
                                        </table> 
                                    </div><!-- /.col-sm-12 -->
                                </div><!-- /.row -->
                            </div><!-- /.wrapper -->

                        <?php   $sql = "SELECT Idalbum FROM statistic WHERE Idalbum = ? ";
                                $stmt = mysqli_stmt_init($connessione);
                                if(!mysqli_stmt_prepare($stmt, $sql)){
                                    echo "SQL error";
                                }
                                else{

                                    mysqli_stmt_bind_param($stmt, "i", $id_album);
                                    mysqli_stmt_execute($stmt);
                                    $result = mysqli_stmt_get_result($stmt);

                                    if ($result->num_rows > 0) {
                                        $check = false; //l'album è già registrato
                                    } else {
                                        $check = true; //l'album non è registrato
                                    }
                                }
                                    
                                if($check == true) {  ?>                                   
                                
                                        <div class="card-footer">
                                            <h5><p class="font-weight-bold">Comincia a tracciare il tuo album.</p> Ti consigliamo di cliccare il bottone se e solo se il tuo Album è completo e per un periodo di tempo non dovrai aggiungere altre carte. In questo modo il sito potrà disegnare un grafico davvero indicativo dell'andamento dei prezzi del tuo album. </h5>
                                            <!--  <form method="GET" action="" >    -->
                                                <button type="submit" class="btn btn-link" name="start-track">
                                                    <?php
                                                        $start_track = "php/start_tracking.php?start-track=" . $id_album ;
                                                        echo '<a href="'.$start_track.'">Start Tracking</a> '; 
                                                    ?>
                                                </button>
                                            <!-- </form>  -->
                                        </div>
                
                                <?php } 
                                if($check == false && $ricarica_prezzi_min_trend === TRUE ){   ?>

                                        <div class="card-footer">
                                            <h5><p class="font-weight-bold">Resgistra il valore totale dell'album (prezzo minimo e di tendenza).</p>Ti consigliamo di farlo una volta a settimana (per esempio, il noiosissimo lunedì). </h5>
                                                <button type="submit" class="btn btn-link" name="register-total">
                                                    <?php
                                                        $register_values = "php/update_statistic.php?register=true&trend=".$total_trend."&min=".$total_min."&album=".$id_album;
                                                        echo '<a href="'.$register_values.'">Register new values</a> '; 
                                                    ?>
                                                </button>
                                            <!-- </form>  -->
                                        </div>

                                <?php
                                }
                                ?>




            </div><!-- /.cardbody -->
          </div><!-- /.card -->
        </div><!-- /.col-sm-12 -->
     </div><!-- /.row-->
    
<?php 



    } // chiusure if result
}//chiusura primo if/else gigante
?>




<!-- 4.E FINISH  -->     




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
    function collection($idcollection){

        $name_collection = "";
                                                //i vari if per la type collection
                                                if($idcollection==6){
                                                    $name_collection = "Pokemon";    
                                                }
                                                else if($idcollection==3){
                                                    $name_collection = "Yu-gi-oh!";
                                                }
                                                else if($idcollection==1){
                                                    $name_collection = "Magic: The Gathering";
                                                }
                                                else if($idcollection==8){
                                                    $name_collection = "Vanguard";
                                                    
                                                }
                                                else if($idcollection==7){
                                                    $name_collection = "Force of Will";
                                                }
                                                else if($idcollection==2){
                                                    $name_collection = "World of Warcraft TCG";
                                                }
                                                else if($idcollection==15){
                                                    $name_collection = "Star Wars: Destiny";
                                                }
                                                else if($idcollection==11){
                                                    $name_collection = "Dragoborne";
                                                }
                                                else if($idcollection==12){
                                                    $name_collection = "My Little Pony CCG";
                                                }
                                                else if($idcollection==13){
                                                    $name_collection = "Dragon Ball Cardgame";
                                                }
                                                else if($idcollection==10){
                                                    $name_collection = "WeiB Swharz";
                                                }
                                                else if($idcollection==15){
                                                    $name_collection = "The Spoils";
                                                }
                                                else if($idcollection==9){
                                                    $name_collection = "Final Fantasy TCG";
                                                }
        return $name_collection;

    }
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

