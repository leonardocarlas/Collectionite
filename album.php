<?php
    require "header.php";
    require 'php/dbh.php';

    $total_avarage = 0;
    $total_trend = 0;
    $total_min = 0;
    $array_dati_album = array();



    // APERTURA DA HOME.PHP, DOPO AVER SELEZIONATO L'ALBUM   --------   NORMAL MODE
    if(isset($_GET['ID']) && isset($_GET['NAME']) ){
        $_SESSION['album-selezionato'] =  mysqli_real_escape_string($connessione, $_GET['NAME']);
        $id_album = mysqli_real_escape_string($connessione, $_GET['ID']);
        $_SESSION['idalbum'] = $id_album;    
    }


    // Variabili globali
    $album_corrente = $_SESSION['album-selezionato'];
    $user = $_SESSION['usernamesession'];
    $idcollection = $_SESSION['idcollezione'];  
    $id_user = $_SESSION['idusersession'];
    $id_album = $_SESSION['idalbum'];



    $array_carte = get_cards_for_the_album($id_user, $id_album);
    for($i = 0; $i < count($array_carte); $i = $i + 11) {
        $total_trend += $array_carte[$i+4]; 
        $total_min += $array_carte[$i+3];
    }

?>



<!-- Time Line -->

<div class="d-flex flex-row m-4">
    <h5><a href= "home.php" >My collection </a></h5>
    <h5> > </h5>
    <h5>Album: <?php echo $_SESSION['album-selezionato']; ?></h5>
</div>
            



<!-- Sommario -->

<br>

<div class="row justify-content-center">
    <h2>Sommario</h2>
</div>
<div class="row justify-content-center">
    <h5>Prezzo totale dell'album</h5>
</div>

<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-auto">
            Prezzo minimo: <?php echo $total_min; ?> €
        </div>   
        <div class="col-md-auto">
            Prezzo di tendenza: <?php echo $total_trend; ?> €
        </div>
        <div class="col-md-auto">
            Prezzo di valutazione: <?php echo $total_avarage; ?> €
        </div>     
    </div>
</div>





<!-- Bottone che manda a new_add_card.php per far inserire all'utente le carte -->

<br><br>

<div class="row justify-content-center">
    <div class="col-auto-sm">
        <a class="btn text-white" href="new_add_card.php" style="background-color: #5401a7;">
            <h4>Aggiungi nuove carte all'album</h4>
            <img src="immagini/tre_carte.png" width="30" height="30">
        </a>
    </div>
</div>

<br>





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

    
    if (empty($array_carte)) {

        // Non ci sono carte, mostro solamente la tabella all'utente e spiego che non sono presenti

        echo "<br><br>" . "Non hai ancora inserito carte per questo album". "<br>";
    }
    else {

        // Sono già state inserite delle carte, le mostro nella tabella
            
?>

    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4 m-4">
        <div class="row justify-content-center">
            <div class="col-sm-12 table-responsive">
                <table id="example2" class="table table-bordered table-hover dataTable" role="grid">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
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
                            <th scope="col" colspan="2">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Solo per debugging:  array_push($dati_tabella, $row['Idcard'], $row['Idset'], $row['Image_link'], $row['Min_value'], $row['Trend_Value'], $row['Quantity'], $row['Language'], $row['ExtraValues'], $row['Conditions'], $row['Website'], $row['Idpossession'] ); -->
                        <?php for($i = 0; $i < count($array_carte); $i = $i + 11) { ?>
                            <tr>
                                <td> <?php echo $i/11 ?></td>
                                <td> <?php echo '<img src="'.$array_carte[$i+2] .'" alt="Foto" width="100" height="150">'?></td>
                                <td> <?php echo $array_carte[$i] ?></td>
                                <td> <?php echo $array_carte[$i+1] ?></td>
                                <td> <?php echo $array_carte[$i+3].'€';  ?></td>
                                <td> <?php echo $array_carte[$i+4].'€';  ?></td>
                                <td> <?php echo $array_carte[$i+5];  ?></td>
                                <td> <?php echo $array_carte[$i+6] ?></td>
                                <td> <?php echo $array_carte[$i+7] ?></td>
                                <td> <?php echo $array_carte[$i+8] ?></td>
                                <td> <?php echo " - "?></td>
                                <td> <?php $link = "https://www.cardmarket.com" . $array_carte[$i+9];  echo '<a href="'.$link.'"> link </a>'; ?></td>
                                <td> <a href="php/CRUD_card.php?Edit=". $array_carte[$i+9] > Modifica</a> </td>
                                <td> <a href="php/CRUD_card.php?Delete=". $array_carte[$i+9] > Elimina</a> </td>
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










<!-- Strumenti per l'album -->

<br><br><br>

    <div class="row justify-content-center">
        <h2>Strumenti per l'album</h2>
    </div>
    
    <br>

    <div class="row justify-content-center">
        <h5><p class="font-weight-bold">Comincia a tracciare il tuo album.</p></h5>
    </div>
    <div class="row justify-content-center">
        <p>Ti consigliamo di cliccare il bottone se e solo se il tuo Album è completo e per un periodo di tempo non dovrai aggiungere altre carte.</p>
        <br>
        <p>
        In questo modo il sito potrà disegnare un grafico davvero indicativo dell'andamento dei prezzi del tuo album.
        </p>
        
    </div>
    <div class="row justify-content-center">
        <?php
        echo '<button type="submit" class="btn btn-link" name="start-track"';
        if(check_album_registration($id_album))
            echo "disabled";
        
        echo ">";
                
                    $start_track = "php/CRUD_statistic.php?start-track=" . $id_album ;
                    
                    echo '<a class="btn text-white" style="background-color: #5401a7;" href="'.$start_track.'" >Start Tracking</a> '; 
                
        echo '</button>';
        ?>
    </div>
    <br>
    <!-- <button class="nav-link btn_load_screen" onClick = <?php echo "return_albums(10," . $id_user . ")";?>  type="button" class="btn btn-outline-primary">Weiss Schwarz</button> --> 
    <div class="row justify-content-center">
        <h5><p class="font-weight-bold">Registra il valore totale dell'album (prezzo minimo e di tendenza).</p></h5>
    </div>
    <div class="row justify-content-center">
        <p>Ti consigliamo di farlo una volta a settimana (per esempio, il noiosissimo lunedì).</p>
    </div>
    <div class="row justify-content-center">
        <button class="btn text-white" style="background-color: #5401a7;" onClick = <?php echo "insert_statistic(" . $total_min . ",".$total_trend.")";?>  type="button" >Registra un nuovo valore</button>
    </div>
    <br>
    <div class="row justify-content-center">
        <h5><p class="font-weight-bold">Esporta l'album.</p></h5>
    </div>
    <div class="row justify-content-center">
        <p>Cliccando sul bottone sottostante, viene scaricato un file .txt contente i dati della tabella dell'album, in modo tale da poterlo condividere.</p>
    </div>
    <div class="row justify-content-center">
        <button onClick = <?php echo "export_album()"; ?>  type="button" class="btn text-white" style="background-color: #5401a7;" name="register-total"> Esporta Album </button>
    </div>
   
   





<!-- Grafico che mostra i valori dell'album -->

<?php

$sql = "SELECT Stat_date, Trend_value, Min_value FROM statistic WHERE Idalbum = ? ";
$stmt = mysqli_stmt_init($connessione);
if(!mysqli_stmt_prepare($stmt, $sql)) {
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





<br><br><br>

<?php
    require "footer.php";
?>


<!-- Esporta l'album in formato .txt -->

<script type ="text/javascript">
    
    function export_album(){
        strings = "dd";
        $.post("php/export_album.php",{"array":stringa},function(data){
            //$("#").html(data);
            });
    }
</script>


<!-- Registra un nuovo valore dell'album in CRUD_statistic.php -->

<script type ="text/javascript">
    //data è echo
    function insert_statistic(min_value, trend_value){
        $.post("php/CRUD_statistic.php",{"minimo":min_value, "trend":trend_value},function(data){
            //$("#").html(data);
            });
    }
</script>




























































































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
                    $dati_tabella = array();
                    while($row = $result->fetch_assoc()) {                        
                        array_push($dati_tabella, $row['Idcard'], $row['Idset'], $row['Image_link'], $row['Min_value'], $row['Trend_Value'], $row['Quantity'], $row['Language'], $row['ExtraValues'], $row['Conditions'], $row['Website'], $row['Idpossession']);   
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
    function manipulationlink($collegamento) {
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

<?php
    function check_album_registration($id_album) {

        // Controlla se l'album è già registrato nella tabella Statistic. In questo modo possiamo abilitareo meno
        // il pulsante "Start register"
        require "php/dbh.php";
        $sql = "SELECT Idalbum FROM statistic WHERE Idalbum = ? ";
        $stmt = mysqli_stmt_init($connessione);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "SQL error";
        }
        else{

            mysqli_stmt_bind_param($stmt, "i", $id_album);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($result->num_rows > 0) {
                return true; //l'album è registrato
            } else {
                return false; //l'album non è registrato
            }
        }
    }
?>

