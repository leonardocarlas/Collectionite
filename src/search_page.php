<?php

    require "php/dbh.php";
    require "header.php";

    $total_trend = 0;
    $total_min = 0;

?>

<div class="content-wrapper" style="min-height: 636.763px;">

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-5">

          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Ricerca la collezione di un utente</h1>
          </div><!-- /.col -->
        </div>
        </div>
    </div>

    
    <!-- Content  -->
    
    <div class="content">
      <div class="container">

        <!-- 1. SEARCH FIELD   -->
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <form action="search_page.php">
                    <div class="input-group mb-3 float-right">

                        <input type="text" name="user-searched" class="form-control" placeholder="Inserisci l'username di un utente per vedere la sua collezione" aria-label="User collection search item" aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cerca</button>
                        </div>
                    </div>
                </form>
                
            </div><!-- /.col -->
        </div>
        <!-- 1. FINISH  -->


        
<!-- 2. VISUALIZZAZIONE DEGLI ALBUM DELL'UTENTE X   -->
<?php 
if(isset($_GET['OPENu'])) { 
    require "php/dbh.php";
        $id_user =  mysqli_real_escape_string($connessione, $_GET['OPENu']);
        
        ?>

        <div class="row justify-content-center mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">Album dalla collezione dell'utente</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table id="example2" class="table table-bordered table-hover dataTable" role="grid">
                                    <thead>
                                        <tr role="row">
                                            <th>Album</th>
                                            <th>Tipo di collezione</th>
                                            <th>Azioni</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php 
                                        $sql = "SELECT * FROM album WHERE Iduser=?; ";
                                        $stmt = mysqli_stmt_init($connessione);
                                        if(!mysqli_stmt_prepare($stmt, $sql)){
                                            echo "Error in the database";
                                        }
                                        else{
                                            mysqli_stmt_bind_param($stmt, "i", $id_user);
                                            mysqli_stmt_execute($stmt);
                                            $result = mysqli_stmt_get_result($stmt);

                                            if ($result->num_rows > 0) {

                                                while($row = $result->fetch_assoc()) {
    
                                                    $idcollection = $row["Idcollection"];
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
    
                                                    
                                
                                                    echo '
                                                            <tr>
                                                                <td> '.$row["Album_name"].' </td>
                                                                <td> '.$name_collection.' </td>
                                                                <td> <a href="search_page.php?OPENida='. $row["Idalbum"].'&idu='.$id_user .'&idc='.$idcollection .'&na='.$row["Album_name"].'&nu=si">Apri Album</a> </td>
                                                            </tr>';
                                                }
                                            }
                                            else{
                                                echo '<tr>
                                                        <td> Questo utente non ha album nella sua collezione</td>
                                                      </tr>';
                                            }
                                        
                                        } 
                                                                            
                                        
                                    ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <!-- /.card-body -->
                        </div>
                </div>
            </div>
        </div>
        <!-- 2. FINISH -->
<?php  
}
?>





<!-- 3. VISUALIZZAZIONE DEGLI UTENTI TROVATI DAL SEARCH FIELD   -->
<?php if(isset($_GET['user-searched'])) { 
    require "php/dbh.php";
    $user_searched = mysqli_real_escape_string($connessione, $_GET['user-searched']);
?>

        <div class="row justify-content-center mt-5">
            <div class="col-10">
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">Utenti:</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="example2" class="table table-bordered table-hover dataTable" role="grid">
                                    <thead>
                                        <tr role="row">
                                            <th>Username:</th>
                                            <th>Azioni:</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php 
                                        $sql = "SELECT Iduser,Username FROM user WHERE Username LIKE ? ";
                                        $stmt = mysqli_stmt_init($connessione);
                                        if(!mysqli_stmt_prepare($stmt, $sql)){
                                            echo "Error in the database";
                                            echo("Error description: " . $connessione -> error);
                                        }
                                        else{
                                            mysqli_stmt_bind_param($stmt, "s", $user_searched);
                                            mysqli_stmt_execute($stmt);
                                            $result = mysqli_stmt_get_result($stmt);

                                            if ($result->num_rows > 0) {

                                                while($row = $result->fetch_assoc()) {
                                
                                                    echo '
                                                            <tr>
                                                                <td> '.$row["Username"].' </td>
                                                                <td> <a href="search_page.php?OPENu='. $row["Iduser"].'">Vedi Collezione</a> </td>
                                                            </tr>';
                                                }
                                            }
                                            else{
                                                echo '<tr>
                                                        <td> Non ci sono utenti con questo username</td>
                                                    </tr>';
                                            }
                                        }
      
                                    ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <!-- /.card-body -->
                        </div>
                </div>
            </div>
        </div>
<!-- 3. FINISH -->
<?php
}
?>


<!-- 4. Page for showing the album-->
<?php 
if(isset($_GET['OPENida'])) {
    require "php/dbh.php";
            $album_corrente =  mysqli_real_escape_string($connessione, $_GET['na']);
            $user =  mysqli_real_escape_string($connessione, $_GET['nu']);
            $idcollection =  mysqli_real_escape_string($connessione, $_GET['idc']);  
            $id_user =  mysqli_real_escape_string($connessione, $_GET['idu']);
            $id_album =  mysqli_real_escape_string($connessione, $_GET['OPENida']) ;
        ?>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                            <div class="col-sm-6">
                                    <h1 class="m-0 text-dark"> Sei all'iterno dell'album: <?php echo $album_corrente; ?></h1>                                                                   
                            </div><!-- /.col -->
                    </div><!-- /.row -->
                        <div class="row mb-2">
                            <?php 
                                $return_to_search_page = "search_page.php?OPENu=" . $id_user ;
                                echo '<a class="btn text-white" style="background-color: #5401a7;" href="'.$return_to_search_page.'">Torna a selezionare gli Album</a> '; 
                            ?>
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
            <div>
        </div>


        <!-- & VMODE TABLE OF CARDS -->

        <?php
        
            
        $sql = "SELECT Idpossession, card.Idcard, Card_name, Set_name, Quantity, Language, ExtraValues, Conditions FROM possesses JOIN card ON possesses.Idcard = card.Idcard WHERE possesses.Iduser = ? AND possesses.Idalbum = ? " ;
        $stmt = mysqli_stmt_init($connessione);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "Error in the database";
        }
        else{
            mysqli_stmt_bind_param($stmt, "ii",$id_user, $id_album );
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            

            if ($result->num_rows > 0) {

            ?>

            <div class="row justify-content-center mt-5">
                <div class="col-12">
                    <div class="card card-info card-outline">

                        <div class="card-header">
                            <h3 class="card-title">Album:</h3>
                        </div><!-- /.card-header -->


                        <div class="card-header">
                                
                        <br>
                                
                        </div><!-- /.card-header -->
                            
                            <div class="card-body">
                                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                        <div class="col-sm-12 table-responsive">
                                        <table id="example" class="display table table-striped table-bordered table-hover display" role="grid" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Card Name</th>
                                                    <th scope="col">Card Set</th>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col">Language</th>
                                                    <th scope="col">Extra Values</th>
                                                    <th scope="col">Conditions</th>
                                                    <th scope="col">Minimum Price</th>
                                                    <th scope="col">Trend Price</th>
                                                    <th scope="col">Open it in cardmarket.com</th>        
                                                </tr>
                                            </thead>

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

                                        <?php
                                                $lo = low_trend($row['Idcard']);
                                        ?>

                                            <td> <?php echo $lo[1]; $total_min = $total_min + $lo[1]; ?></td>
                                            <td> <?php echo $lo[2]; $total_trend = $total_trend + $lo[2]; ?>   </td>
                                            <td> <?php  
                                                        $link = $lo[0];
                                                        echo '<a href="'.$link.'">link<a>';

                                            ?>
                                            </td>
                                        </tr>

                                    <?php   }   ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                    
                                    <?php 
                                            echo  '
                                                <td> Total price of the album: </td> 
                                                <td> Minimun price: '.$total_min.' </td>
                                                <td> Trend price: '.$total_trend.' </td>' ; 
            }//chiusura if result
        }//chiusura else


                            ?> 
                                </tr>
                            </tfoot>
                        </table> 
                    </div><!-- /.col-sm-12 -->
                </div><!-- /.row -->
              </div><!-- /.wrapper -->

              <script>
                    $(document).ready(function() {
                    $('#example').DataTable();
                } );
                </script>



            </div><!-- /.cardbody -->
          </div><!-- /.card -->
        </div><!-- /.col-sm-12 -->
     </div><!-- /.row-->
    

<?php     
}
?>
        
        <!-- 4. FINISH -->


      </div>
    </div>




















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










<br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br>






<?php
    require "footer.php";
?>