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

          <div class="col-sm-6">
            <h4 class="m-0 text-dark">Aggiungi nuove carte all'album <?php echo $album_corrente; ?></h4>
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

                <input type="text" name="card-searched" class="form-control" placeholder="Inserisci il nome della carta che vuoi inserire" aria-label="User collection search item" aria-describedby="button-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cerca</button>
                </div>
            </div>
        </form>
        
    </div><!-- /.col -->
</div>
<!-- 1. FINISH  -->

<br><br><br><br>

<div class="row justify-content-center">
    <div class="col-sm-auto">
        <h4>Altrimenti cercala tra i Set:</h4>
    </div>
<div>


<br><br><br><br>


<?php
require 'php/dbh.php';
$sql = "SELECT nameExpansion FROM texp WHERE idCollection=? ; ";
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
        while($row = $result->fetch_assoc()) {
            
            echo '
                <a class="btn text-white" href="" style="background-color: #5401a7;">'.$row["nameExpansion"].'</a>
                ';
            $i=$i+1;
            if($i%3==0)
                echo '<br>';
            
        }
  
        
    } else {
        echo '';
    }
}
mysqli_stmt_close($stmt);
mysqli_close($connessione);


?>




































