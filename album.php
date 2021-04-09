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
    <h5><a href= "home.php" class="text-dark" ><u> My collection </u></a></h5>
    <h5> > </h5>
    <h5>Album: <?php echo $_SESSION['album-selezionato']; ?></h5>
</div>
            


<!-- Sommario -->



<div class="row justify-content-center">
    <h1>Sommario</h1>
</div>
<div class="row justify-content-center">
    <h2>Prezzo totale dell'album</h2>
</div>

<br>

<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-auto">
            <h4> Prezzo minimo:  <?php echo $total_min; ?> € </p> </h4>
        </div>   
        <div class="col-md-auto">
            <h4> Prezzo di tendenza: <?php echo $total_trend; ?> € </h4>
        </div>
        <div class="col-md-auto">
            <h4> Prezzo di valutazione: <?php echo $total_avarage; ?> € </h4>
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

        echo '<br><br>
                <div class="row justify-content-center">
                    <h3> Non hai ancora inserito carte per questo album </h3>
                </div>
            <br><br>
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
                        </tbody>
                    </table> 
                </div>
            </div>
            <br><br><br>
            ';
    }
    else {

        // Sono già state inserite delle carte, le mostro nella tabella
            
?>

        <br><br>
        <div class="row justify-content-center">
            <div class="col-sm-12 table-responsive">
                <table id="example2" class="table table-borderless table-hover" role="grid">
                    <thead class="table-dark">
                        <tr>
                            <th style = "text-align: center;" scope="col">#</th>
                            <th style = "text-align: center;" scope="col">Image</th>
                            <th style = "text-align: center;" scope="col">Carta</th>
                            <th style = "text-align: center;" scope="col">Espansione</th>
                            <th style = "text-align: center;" scope="col">Min Price</th>
                            <th style = "text-align: center;" scope="col">Trend Price</th>
                            <th style = "text-align: center;" scope="col">Quantità</th>
                            <th style = "text-align: center;" scope="col">Lingua</th>
                            <th style = "text-align: center;" scope="col">Valori Extra</th>
                            <th style = "text-align: center;" scope="col">Condizioni</th>
                            <th style = "text-align: center;" scope="col">Evaluation Price</th> 
                            <th style = "text-align: center;" scope="col">Link</th>      
                            <th style = "text-align: center;" scope="col" colspan="2">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Solo per debugging:  array_push($dati_tabella, $row['Idcard'], $row['Idset'], $row['Image_link'], $row['Min_value'], $row['Trend_Value'], $row['Quantity'], $row['Language'], $row['ExtraValues'], $row['Conditions'], $row['Website'], $row['Idpossession'] ); -->
                        <?php for($i = 0; $i < count($array_carte); $i = $i + 11) { ?>
                            <tr>
                                <td style = "text-align: center;"> <?php echo $i/11 ?></td>
                                <td style = "text-align: center;"> <?php echo '<img src="'.$array_carte[$i+2] .'" alt="Foto" width="100" height="150">'?></td>
                                <td style = "text-align: center;"> <?php echo $array_carte[$i] ?></td>
                                <td style = "text-align: center;"> <?php echo $array_carte[$i+1] ?></td>
                                <td style = "text-align: center;"> <?php echo $array_carte[$i+3].'€';  ?></td>
                                <td style = "text-align: center;"> <?php echo $array_carte[$i+4].'€';  ?></td>
                                <td style = "text-align: center;"> <?php echo $array_carte[$i+5];  ?></td>
                                <td style = "text-align: center;"> <?php echo $array_carte[$i+6] ?></td>
                                <td style = "text-align: center;"> <?php echo $array_carte[$i+7] ?></td>
                                <td style = "text-align: center;"> <?php echo $array_carte[$i+8] ?></td>
                                <td style = "text-align: center;"> <?php echo " - "?></td>
                                <td style = "text-align: center;"> <?php $link = "https://www.cardmarket.com" . $array_carte[$i+9];  echo '<a href="'.$link.'"> link </a>'; ?></td>
                                <td style = "text-align: center;"> <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#myModal" > Modifica </button> </td>
                                <td style = "text-align: center;"> <button type="button" <?php echo 'onclick="delete_card('.$array_carte[$i+10].')" '; ?> class="btn btn-outline-danger" > Elimina </button> </td> 
                            </tr>
                        <?php } ?>
                    </tbody>
                </table> 
            </div><!-- /.col-sm-12 -->
        </div><!-- /.row -->
 

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
            echo '<button ';

            if(check_album_registration($id_album) || empty($array_carte)) {
                echo "disabled";
            }
            
             echo ' class="btn text-white" style="background-color: #5401a7;" onclick = "start_tracking(' .$id_album. ')" > Start Tracking </button> '; 

        ?>
    </div>
    <br>
     
    <div class="row justify-content-center">
        <h5><p class="font-weight-bold">Registra il valore totale dell'album (prezzo minimo e di tendenza).</p></h5>
    </div>
    <div class="row justify-content-center">
        <p>Ti consigliamo di farlo una volta a settimana (per esempio, il noiosissimo lunedì).</p>
    </div>
    <div class="row justify-content-center">
        <?php
            echo '<button type="submit"  ';

            if(check_album_registration($id_album)==false)
            {
                echo "disabled";
            }
            
            echo ' class="btn text-white" style="background-color: #5401a7;" onClick = "insert_statistic('. $total_min . ',' .$total_trend. ' )" > Registra un nuovo valore </button> ';
                    
        ?>
    </div>
    <br>
    <div class="row justify-content-center">
        <h5><p class="font-weight-bold">Esporta l'album.</p></h5>
    </div>
    <div class="row justify-content-center">
        <p>Cliccando sul bottone sottostante, viene scaricato un file .txt contente i dati della tabella dell'album, in modo tale da poterlo condividere.</p>
    </div>
    <div class="row justify-content-center">
        <?php
            echo '<button type="submit"  ';

            if (empty($array_carte)) 
            {
                echo "disabled";
            }
            
            echo ' id="export_album_a" onclick="export_album(' . $id_album. ')" class="btn text-white" style="background-color: #5401a7;" download > Esporta Album </button>' ;
        ?>
    </div>
    <!-- if (empty($array_carte)) { -->
   
   <br> 

    <div class="row justify-content-center">
        <h5><p class="font-weight-bold">Prezzo di Valutazione. [Coming Soon]</p></h5>
    </div>
    <div class="row justify-content-center">
        <p>Cliccando sul bottone sottostante, la tabella contenente i dati viene ricaricata con un prezzo di valutazione basato
         su due caratteristiche, la condizione e la lingua della carta.<br>Calcola la media delle prime cinque inserzioni degli utenti
          di carmarket con quelle esatte caratteristiche della carta. L'operazione può richiedere un po' di tempo.</p>
    </div>
    <div class="row justify-content-center">
        <button type="submit" disabled class="btn text-white" style="background-color: #5401a7;" > Prezzo di valutazione </button>
    </div>
   





<!-- Grafico che mostra i valori dell'album -->

    <div class="row justify-content-center mt-5">
            <div class="col-10">
                <div class="card">

                        <div class="card-header">
                            <?php 
                                $chart_data = get_graph_datas($id_album);
                                //var_dump($chart_data);
                                
                                if( empty($chart_data) ) { 
                            ?>
                                <h3 class="card-title">L'album non è ancora stato registrato</h3>
                            <?php } else { 
                            ?>
                                <h3 class="card-title">Dati dell'album</h3>
                            <?php } ?>
                        </div>                     
                        

                        <div class="card-body">
                            
                                <div class="row">
                                    <div class="container" style="width:900px;">

                                        <br /><br />
                                        <div id="chart"></div>

                                    </div>
                                </div>
                            
                        </div> <!-- /.card-body -->
                </div> <!-- /.card-->
        </div><!-- /.col-->
    </div><!-- /.row-->



    </div>
</div>




<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
        <div class = "col">
                        <div class = "row justify-content-center">
                            Condizione:
                        </div>

                        <div class = "row justify-content-center">
                            <select name="conditions" class="form-control">
                                <option>--Conditions--</option>
                                <option>M</option>
                                <option>NM</option>
                                <option>EX</option>
                                <option>GD</option>
                                <option>LP</option>
                                <option>PL</option>
                                <option>P</option>
                            </select>
                        </div>

                        <div class = "row justify-content-center">
                            Valori Extra:
                        </div>

                        <div class = "row justify-content-center">
                            <select name="extravalues" class="form-control">
                                <option>--Extra Values--</option>
                                <option>Normal</option>
                                <option>Foil</option>
                                <option>Signed</option>
                                <option>Playset</option>
                                <option>First Edition</option>
                                <option>Alieved</option>
                                
                            </select>
                        </div>

                        <div class = "row justify-content-center">
                            Linguaggi:
                        </div>

                        <div class = "row justify-content-center">
                            <select name="languages" class="form-control">
                                <option>--Languages--</option>
                                <option>Italian</option>
                                <option>English</option>
                                <option>Spanish</option>
                                <option>German</option>
                                <option>French</option>
                                <option>Portuguese</option>
                                <option>Russian</option>
                                <option>Korean</option>
                                <option>Japanese</option>
                                <option>Traditional Chinese</option>
                                <option>Simplified Chinese</option>
                            </select>
                        </div>

                        <div class = "row justify-content-center">
                            <div class="col">
                                <button class = "btn" onclick = "" > Annulla </button>
                            </div>   
                            <div class="col">
                                <button class = "btn" onclick = ""  ?>  Modifica </button>
                            </div>  
                        </div>

                    </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
 
    </div>
  </div>








                <div id = "modify_card_box" style = "display: none;" >
                    <div class = "col">
                        <div class = "row justify-content-center">
                            Condizione:
                        </div>

                        <div class = "row justify-content-center">
                            <select name="conditions" class="form-control">
                                <option>--Conditions--</option>
                                <option>M</option>
                                <option>NM</option>
                                <option>EX</option>
                                <option>GD</option>
                                <option>LP</option>
                                <option>PL</option>
                                <option>P</option>
                            </select>
                        </div>

                        <div class = "row justify-content-center">
                            Valori Extra:
                        </div>

                        <div class = "row justify-content-center">
                            <select name="extravalues" class="form-control">
                                <option>--Extra Values--</option>
                                <option>Normal</option>
                                <option>Foil</option>
                                <option>Signed</option>
                                <option>Playset</option>
                                <option>First Edition</option>
                                <option>Alieved</option>
                                
                            </select>
                        </div>

                        <div class = "row justify-content-center">
                            Linguaggi:
                        </div>

                        <div class = "row justify-content-center">
                            <select name="languages" class="form-control">
                                <option>--Languages--</option>
                                <option>Italian</option>
                                <option>English</option>
                                <option>Spanish</option>
                                <option>German</option>
                                <option>French</option>
                                <option>Portuguese</option>
                                <option>Russian</option>
                                <option>Korean</option>
                                <option>Japanese</option>
                                <option>Traditional Chinese</option>
                                <option>Simplified Chinese</option>
                            </select>
                        </div>

                        <div class = "row justify-content-center">
                            <div class="col">
                                <button class = "btn" onclick = "" > Annulla </button>
                            </div>   
                            <div class="col">
                                <button class = "btn" onclick = ""  ?>  Modifica </button>
                            </div>  
                        </div>

                    </div>
                </div>




<br><br><br>

<?php
    require "footer.php";
?>


<!-- Esporta l'album in formato .txt -->

<script type ="text/javascript">

    var c = 0;
    function pop() {
        if (c == 0){
            document.getElementById("modify_card_box").style.display = "block";
            c = 1;
        } else {
            document.getElementById("modify_card_box").style.display = "none";
            c = 0;
        }
    }

    function modify_card(){
        $.post("php/CRUD_card.php",{"delete_id_possession":id_possession},function(data){
                if(data == "success")
                {
                    Swal.fire({
                        icon: 'success',
                        title: 'Carta rimossa dall\'album',
                        }).then((result) => {
                            location.reload();
                    });
                }
            });
    }

    Morris.Line({
            element : 'chart',
            data:[<?php echo $chart_data; ?>],
            xkey:'date',
            ykeys:['Trend_value','Min_value'], 
            labels:['Trend Value', 'Min Value'],
            hideHover:'auto',
            stacked:true
            
    });
    
    function start_tracking(id_album){
        $.post("php/CRUD_statistic.php",{"start_tracking_id_album":id_album},function(data){
            if(data == "success")
                {
                    Swal.fire({
                        icon: 'success',
                        title: 'Ora puoi registrare i valori della tua collezione',
                        });
                }
            });
    }

    function export_album(id_album){
        $.post("php/export_album.php",{"id_album":id_album},function(data){
                var link = document.createElement("a");
                link.download = data;
                link.href = "php/"+data;
                link.click();
            });
    }


    function delete_card(id_possession)
    {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        });

        Swal.fire({
        title: 'Sei sicuro?',
        text: "La carta verrà eliminata dal tuo album!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
        }).then((result) => {
            if(result.value){
                delete_card_ajax(id_possession);
            } 
        });
    }

    function delete_card_ajax(id_possession){
        $.post("php/CRUD_card.php",{"delete_id_possession":id_possession},function(data){
                if(data == "success")
                {
                    Swal.fire({
                        icon: 'success',
                        title: 'Carta rimossa dall\'album',
                        }).then((result) => {
                            location.reload();
                    });
                }
            });
    }

    

</script>


<!-- Registra un nuovo valore dell'album in CRUD_statistic.php -->

<script type ="text/javascript">
    
    function insert_statistic(min_value, trend_value){
        $.post("php/CRUD_statistic.php",{"minimo":min_value, "trend":trend_value},function(data){
            if(data == "success")
                {
                    Swal.fire({
                        icon: 'success',
                        title: 'Il grafico dei valore è stato aggiornato con successo',
                        }).then((result) => {
                            Morris.Line();
                    });
                }
            });
    }

    function show_graph_datas(id_album){
        $.post("php/return_albums.php",{"collezione":id_collection},function(data){
            $("#album_ritornati").html(data);
            });
    }

    /* SWAL CON SELECT
        const { value: fruit } = await Swal.fire({
        title: 'Select field validation',
        input: 'select',
        inputOptions: {
            'Fruits': {
            apples: 'Apples',
            bananas: 'Bananas',
            grapes: 'Grapes',
            oranges: 'Oranges'
            },
            'Vegetables': {
            potato: 'Potato',
            broccoli: 'Broccoli',
            carrot: 'Carrot'
            },
            'icecream': 'Ice cream'
        },
        inputPlaceholder: 'Select a fruit',
        showCancelButton: true,
        inputValidator: (value) => {
            return new Promise((resolve) => {
            if (value === 'oranges') {
                resolve()
            } else {
                resolve('You need to select oranges :)')
            }
            })
        }
        })

        if (fruit) {
        Swal.fire(`You selected: ${fruit}`)
        }
    */

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

    function get_graph_datas($id_album) {

        require "php/dbh.php";
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

                    return $chart_data;

                } else {
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