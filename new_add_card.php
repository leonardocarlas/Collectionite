<?php
    require "header.php";
    $album_corrente = $_SESSION['album-selezionato'];
    $idcollection = 1;
?>


<div class="content-wrapper" style="min-height: 636.763px;">

<br>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container">
        <div class="row mb-5">

          <div class="col-sm-8">
            <h4 class="m-0 text-dark">Aggiungi nuove carte all'album <?php echo $album_corrente; ?></h4> <br>
            <h7>Attenzione: CardMarket ci ha fornito solamente 1/3 del database delle carte visualizzabili sulla barra di ricerca. Se non la trovi li, ci riuscirai sicuramente tra i Set in basso. </h7> <br>
            <h6>Le carte aggiunte in questa seziona saranno di default EX, English e Normal. Uqesti parametri potranno essere poi modificati nell'album.
          </div><!-- /.col -->
        </div>
    </div>
</div>
<!-- FINE Content Header  -->

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
        
    </div><!-- /.col -->
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
                $.ajax({
                    url:'php/action.php',
                    method:'POST',
                    data:{query_card_set:searchText},
                    success:function(data)
                    {
                        $("#show-list").fadeIn();
                        $("#show-list").html(data);
                    }
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
    <div class="col-6">
        <h4>Altrimenti cercala tra i Set:</h4>
    </div>
<div>


<br><br><br><br>


<?php
require 'php/dbh.php';
$sql = "SELECT nameExpansion, idExpansion, releaseDate FROM texp WHERE idCollection=? ORDER BY releaseDate DESC; ";
$stmt = mysqli_stmt_init($connessione);
if(!mysqli_stmt_prepare($stmt, $sql)){
    echo "Error in the database";
}
else{
    mysqli_stmt_bind_param($stmt, "i", $idcollection);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt); 

    if ($result->num_rows > 0) {
        $i=0;
        $array_di_date = array();
        while($row = $result->fetch_assoc()) {
            $data_in_anno = substr($row['releaseDate'],0,4);
            if (in_array($data_in_anno, $array_di_date) == false) {
                array_push($array_di_date, $data_in_anno);
                echo "<br><br>" . "Anno: " . $data_in_anno . "<br><br>";
            }
            echo '<a href="cards_in_set.php?EXP='.$row['idExpansion'].'">Set: '.$row['nameExpansion'].'</a>';
            //<a class="btn text-white" href="" style="background-color: #5401a7;">'.$row["nameExpansion"].'</a>
            $i=$i+1;
            if($i%5==0)
                echo '<br>';
            
        }
  
        
    } else {
        echo '';
    }
}
mysqli_stmt_close($stmt);
mysqli_close($connessione);


?>




































