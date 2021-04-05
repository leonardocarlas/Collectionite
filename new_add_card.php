<?php
    require "header.php";
    $album_corrente = $_SESSION['album-selezionato'];
    $idcollection = $_SESSION['idcollezione'];
?>


<!-- Time Line -->

<div class="d-flex flex-row m-4">
    <h5><a href= "home.php" >My collection </a></h5>
    <h5> > </h5>
    <h5><a href= "album.php" >Album: <?php echo $_SESSION['album-selezionato']; ?></a></h5>
    <h5> > </h5>
    <h5> Aggiungi carte </h5>
</div>
<br>

<!-- Content Header  -->


<div class="row justify-content-center">
    <h4 class="m-0 text-dark">Aggiungi nuove carte all'album <?php echo $album_corrente; ?></h4>
</div>
<br>
<div class="row justify-content-center">
    <p>Le carte aggiunte in questa seziona saranno di default EX, English e Normal. Questi parametri potranno essere poi modificati nell'album.<p>
</div>



<br>



<!-- 1. SEARCH FIELD   -->
<div class="row justify-content-center">
    <div class="col-sm-6">
        <form action="">
            <div class="input-group mb-3 float-right">

                <input type="text" name="card_searched" id="card_searched" class="form-control" placeholder="Inserisci il nome della carta che vuoi inserire" aria-label="User collection search item" aria-describedby="button-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cerca</button>
                </div>
                                
            </div>
        </form>  
    </div>
</div>
<div class="row justify-content-center">
    
        <div class="list-group" id="show-list">
            <!-- Here autocomplete list will be display -->
        </div>

</div>


<!-- script per auto completamento   query = searchText-->
<script>
    $(document).ready( function(){
        $("#card_searched").keyup(function(){
            var searchText = $(this).val();
            if(searchText != '')
            {
                $("#show-list").fadeIn();
                $.post("php/action.php",{"query_card_set":searchText},function(data){
                    $("#show-list").html(data);
                });
            }
            else{
                $("#show-list").fadeOut();
                $("#show-list").html('');
            }
        });
        $("#show-list").on('click','li',function(){
            $("#card_searched").val($(this).text());
            $("#show-list").fadeOut();
        });

    });
</script>

<!-- 1. FINISH  -->



<br><br><br><br>



<div class="row justify-content-center">
    <h4>Altrimenti cercala tra i Set:</h4>
</div>



<br><br><br><br>




<?php

require 'php/dbh.php';
$sql = "SELECT English_set_name, Idset, Release_date FROM expansion WHERE Idcollection=? ORDER BY Release_date DESC; ";
$stmt = mysqli_stmt_init($connessione);
 if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "Error in the database";
 }else{
    mysqli_stmt_bind_param($stmt, "i", $idcollection);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt); 

    if ($result->num_rows > 0) {
        $array_data_id_nome_espansione = array();
        $array_vuoto = array();
        while($row = $result->fetch_assoc()) {

            $data_in_anno = substr($row['Release_date'],0,4);
            
            array_push($array_data_id_nome_espansione, $data_in_anno);
            array_push($array_data_id_nome_espansione, $row['Idset']);
            array_push($array_data_id_nome_espansione, $row['English_set_name']);
            $id = $row['Idset'];
            $set = $row['English_set_name'];

            if (array_key_exists($data_in_anno, $array_vuoto)) {
                array_push($array_vuoto[$data_in_anno]["Set"], $set);
                array_push($array_vuoto[$data_in_anno]["Id"], $id);
            } else {
                $array_vuoto[$data_in_anno] = array( 'Set' => array(), 'Id' => array());
                array_push($array_vuoto[$data_in_anno]["Set"], $set);
                array_push($array_vuoto[$data_in_anno]["Id"], $id);
            }
        }

        $array_di_date = array();
        
        for ($i=0; $i<count($array_data_id_nome_espansione); $i = $i + 3) {
            $array_di_date[] = $array_data_id_nome_espansione[$i] ;
        }

        $array_date_contate = array_count_values($array_di_date);
        $array_data_righe_riporto = array();
        echo '<br>';

        foreach ($array_date_contate as $data => $contatore) {
            $righe_giuste = intdiv($contatore, 5);
            $riporto = $contatore % 5;
            $array_righe_riporto['RigheGiuste'] = $righe_giuste;
            $array_righe_riporto['Riporto'] = $riporto;
            $array_data_righe_riporto[$data] = $array_righe_riporto;
            
        }
        //print_r($array_data_id_nome_espansione);
        //echo '<br>';
        //print_r($array_data_righe_riporto);
        //Array ( [2020] => Array ( [RigheGiuste] => 5 [Riporto] => 0 )
        //print_r($array_vuoto);
        // Array ( [2020] => Array ( [Set] => Array ( [0] => Commander Collection: Green) [24] => 2999 ) [Righe] => 5 [Riporto] => 0 )
        foreach($array_data_righe_riporto as $data => $array){
            $righe_giuste = $array['RigheGiuste'];
            $riporto = $array['Riporto'];
            $array_vuoto[$data]['Righe'] = $righe_giuste;
            $array_vuoto[$data]['Riporto'] = $riporto; 
        }


        // Array ( [2020] => Array ( [Set] => Array ( [0] => Commander Collection: Green) [24] => 2999 ) [Righe] => 5 [Riporto] => 0 )
        //print_r($array_data_righe_riporto);

     
       
            foreach ($array_vuoto as $data => $array){

                $righe = $array['Righe'];
                $riporto = $array['Riporto'];
                $set_array = $array['Set'];
                $id_array = $array['Id'];

                echo '
                        <div class="row justify-content-center">
                            <h2>Anno:  ' .$data. '</h2>
                        </div>
                        <br>';

                echo '<br>';
                $k = 0;
                for ($i = 0; $i < $righe; $i++) //27
                {
                    $set_name =  str_replace(' ','_', $set_array[$k] );

                    echo '<div class="row justify-content-center">';

                    for ($j = 0; $j < 5; $j++) {

                        echo '
                            
                            <div class="col"> 
                                <div class="card">
                                    <img
                                        
                                        src="immagini/magic_exp/'. $set_name .'_logo.png "
                                        class="card-img-top"
                                        alt="Foto dell\'espansione"
                                    />
                        
                                <div class="card-body">
                                        <div class="row justify-content-center">
                                            <h5 class="card-title">'. $set_name  .'</h5>
                                        </div>
                                        <div class="row justify-content-center">
                                            <img
                                            src="immagini/magic_exp/'. $set_array[$k]  .'_icon.png "
                                            alt="Icona dell\'espansione"
                                            />
                                        </div>
                                        <div class="row justify-content-center">
                                            <a class="btn text-white" style="background-color: #5401a7;" href="cards_in_set.php?EXP='.$id_array[$k].'">Apri Album</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        ';
                    }

                    echo '</div>';






















                    echo '

                        <div class="row justify-content-center">

                            <div class="col"> 
                                <div class="card">
                                    <img
                                        
                                        src="immagini/magic_exp/'. $set_name .'_logo.png "
                                        class="card-img-top"
                                        alt="Foto dell\'espansione"
                                    />
                        
                                <div class="card-body">
                                        <div class="row justify-content-center">
                                            <h5 class="card-title">'. $set_name  .'</h5>
                                        </div>
                                        <div class="row justify-content-center">
                                            <img
                                            src="immagini/magic_exp/'. $set_array[$k]  .'_icon.png "
                                            alt="Icona dell\'espansione"
                                            />
                                        </div>
                                        <div class="row justify-content-center">
                                            <a class="btn text-white" style="background-color: #5401a7;" href="cards_in_set.php?EXP='.$id_array[$k].'">Apri Album</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="card">
                                    <img
                                        src="immagini/magic_exp/'. $set_array[$k+1]  .'_logo.png "
                                        class="card-img-top"
                                        alt="Foto dell\'espansione"
                                    />
                        
                                    <div class="card-body">
                                        <div class="row justify-content-center">
                                            <h5 class="card-title">'. $set_array[$k+1]  .'</h5>
                                        </div>
                                        <div class="row justify-content-center">
                                            <img
                                            src="immagini/magic_exp/'. $set_array[$k+1]  .'_icon.png "
                                            alt="Icona dell\'espansione"
                                            />
                                        </div>
                                        <div class="row justify-content-center">
                                            <a class="btn text-white" style="background-color: #5401a7;" href="cards_in_set.php?EXP='.$id_array[$k+1].'">Apri Album</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="card">
                                    <img
                                        src="immagini/magic_exp/'. $set_array[$k+2]  .'_logo.png "
                                        class="card-img-top"
                                        alt="Foto dell\'espansione"
                                    />
                                    
                                    <div class="card-body">
                                        <div class="row justify-content-center">
                                            <h5 class="card-title">'. $set_array[$k+2]  .'</h5>
                                        </div>
                                        <div class="row justify-content-center">
                                            <img
                                            src="immagini/magic_exp/'. $set_array[$k+2]  .'_icon.png "
                                            alt="Icona dell\'espansione"
                                            />
                                        </div>
                                        <div class="row justify-content-center">
                                            <a class="btn text-white" style="background-color: #5401a7;" href="cards_in_set.php?EXP='.$id_array[$k+2].'">Apri Album</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="card">
                                        <img
                                            src="immagini/magic_exp/'. $set_array[$k+3]  .'_logo.png "
                                            class="card-img-top"
                                            alt="Foto dell\'espansione"
                                        />
                                    
                                    <div class="card-body">
                                        <div class="row justify-content-center">
                                            <h5 class="card-title">'. $set_array[$k+3]  .'</h5>
                                        </div>
                                        <div class="row justify-content-center">
                                            <img
                                            src="immagini/magic_exp/'. $set_array[$k+3]  .'_icon.png "
                                            alt="Icona dell\'espansione"
                                            />
                                        </div>
                                        <div class="row justify-content-center">
                                            <a class="btn text-white" style="background-color: #5401a7;" href="cards_in_set.php?EXP='.$id_array[$k+3].'">Apri Album</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">

                                <div class="card">
                                        <img
                                            src="immagini/magic_exp/'. $set_array[$k+4]  .'_logo.png "
                                            class="card-img-top"
                                            alt="Foto dell\'espansione"
                                        />
                                    
                                    <div class="card-body">
                                        <div class="row justify-content-center">
                                            <h5 class="card-title">'. $set_array[$k+4]  .'</h5>
                                        </div>
                                        <div class="row justify-content-center">
                                            <img
                                            src="immagini/magic_exp/'. $set_array[$k+4]  .'_icon.png "
                                            alt="Icona dell\'espansione"
                                            />
                                        </div>
                                        <div class="row justify-content-center">
                                            <a class="btn text-white" style="background-color: #5401a7;" href="cards_in_set.php?EXP='.$id_array[$k+4].'">Apri Album</a>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            
                        </div>';
                        echo '<br>';
                }

                echo '<div class="row justify-content-center">';
                for ($i = 0; $i < $riporto; $i++) {
                echo '
                        <div class="col">
                            <a href="cards_in_set.php?EXP='.$id_array[count($id_array) - ($i + 1)].'">'.$set_array[count($set_array) - ($i + 1)] .'</a>
                        </div>';
                }
                echo '</div>';
                echo '<br><br><br>';
                
            }
          
           
         
        
    } else {
        echo '';
    }
}
mysqli_stmt_close($stmt);
mysqli_close($connessione);




?>





<br><br><br><br>
<?php
    require "footer.php";