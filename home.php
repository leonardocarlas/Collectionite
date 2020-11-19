<?php
    require "header.php";
    require "php/dbh.php";
    $col_selected = $_SESSION['collezione-selezionata'];

    $id_user = $_SESSION['idusersession'];

    $ban_temporaneo = verify_if_is_payed($id_user);

    if(isset($_SESSION['reload-album'])){
        $ricarica = $_SESSION['reload-album'];
    }

    
?>

<?php  ///////////  GESTIONE DEI MESAGGI DI ELIMINAZIONE/INSERIMENTO  /////////
    /*
    if(isset($_GET['Insert'])){ ?>
    <script type="text/javascript">
        Swal.fire(
        'Your album it s been succesfully created!',
        '',
        'success'
        );
    </script>
    </script>
<?php }
*/ ?>


<?php 

    if(isset($_GET['DELETED'])){ ?>
    <script type="text/javascript">
        Swal.fire(
        'Album Eliminato!',
        '',
        'success'
        );
    </script>
<?php } ?>

<?php 
    if(isset($_GET['MODIFIED'])){ ?>
    <script type="text/javascript">
        Swal.fire(
        'Questo album è stato modificato correttamente',
        '',
        'success'
        );
    </script>

<?php } ?>

<?php 
    if(isset($_GET['error'])){ 
        $error = $_GET['error'];
        if($error == "nocolletionsel"){  ?>
        <script type="text/javascript">
            Swal.fire(
            'Errore nel database, contatta l\'assistenza',
            '',
            'error'
            );
        </script>
<?php }} ?>


<?php
if($ban_temporaneo == 0){


    if(isset($col_selected)){

        if($col_selected == false){

        echo '
        <div class="content-wrapper">
        <div class="content-header">
            <div class="container">
            <div class="row mb-5">
                <div class="col-sm-6">
                <h1 class="m-0 text-dark"> Ben tornato '.$_SESSION['usernamesession'].'!</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <div class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Prima di tutto, seleziona un tipo di Collezione</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST" action="php/get_albums.php" role="form">
                        <div class="card-body">
                        <div class="form-group" data-children-count="1">
                        <select name="collection-type" class="form-control">
                            <option>--Choose the collection--</option>
                            <option>Pokemon</option>
                            <option>Yu-gi-oh!</option>
                            <option>Magic: The Gathering</option>
                            <option>Vanguard</option>
                            <option>Force of Will</option>
                            <option>World of Warcraft TCG</option>
                            <option>Star Wars: Destiny</option>
                            <option>Dragoborne</option>
                            <option>My Little Pony CCG</option>
                            <option>Dragon Ball Cardgame</option>
                            <option>WeiB Swharz</option>
                            <option>The Spoils</option>
                            <option>Final Fantasy TCG</option>
                            </select>
                        </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button class="btn text-white" style="background-color: #5401a7;" type="submit" name="selected-collection">Conferma</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        <!-- /.row -->
        </div><!-- /.container-fluid -->
        <div class="row justify-content-center mt-5">
            <div class="col-10">
                <div class="card">
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
                                        <tr role="row">
                                            <th>Album</th>
                                            <th>Azione</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <!--   QUA METTI UN FOR PER GENERERARE RIGHE DELLA TABELLA -->
                                        <tr role="row" class="even">
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>
                ';

        }
        
        else{

            $idcollection = $_SESSION['idcollezione'];

            if(isset($_SESSION['namecollection'])){
                $name_collection = $_SESSION['namecollection'];
            }

            echo '
                <div class="content-wrapper">
                <div class="content-header">
                    <div class="container">
                    <div class="row mb-3">
                        <div class="col-sm-6">
                        <h1 class="m-0 text-dark"> Tipo di collezione: '. $name_collection .'</h1>
                        </div><!-- /.col -->
                    </div>
                    <div class="row mb-5">
                        <form method="POST" action="php/change_collection.php">
                            <button class="btn text-white" style="background-color: #5401a7;" type="submit" name="change-collection">Cambia Collezione</button> 
                        </form>
                    </div>
                    </div><!-- /.container-fluid -->
                </div>' ;

            

            $sql = "SELECT Album_name, Idalbum FROM album WHERE Iduser=? AND Idcollection=? ; ";
            $stmt = mysqli_stmt_init($connessione);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                echo "Error in the database";
            }
            else{
                mysqli_stmt_bind_param($stmt, "ii", $id_user, $idcollection);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt); 

                if ($result->num_rows > 0) {
                // output data of each row
                    echo'
                    <div class="content">
                    <div class="container">
                    <div class="row justify-content-center mt-2">
                        <div class="col-10">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                <h3 class="card-title">I tuoi album</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table style="cursor:pointer" id="example2" class="table table-bordered table-hover dataTable" role="grid">
                                                <thead>
                                                    <tr role="row">
                                                        <th>Album</th>
                                                        <th colspan="2">Azione</th>
                                                    </tr>
                                                </thead>
                                                <tbody>';           
                    
                        
                                while($row = $result->fetch_assoc()) {
                                    
                                    echo '
                                            <tr onclick="location.href=\'album.php?OPEN='.$row["Album_name"]."&ID=".$row["Idalbum"].'\'">
                                                <td> '.$row["Album_name"].' </td>
                                                <td> <a href="php/albuminsert.php?edit='. $row["Idalbum"].'">Modifica</a> </td>
                                                <td> <a href="php/albuminsert.php?delete='. $row["Idalbum"] .'">Elimina</a> </td>
                                            </tr>';
                                }

                                echo '       
                                        </tbody>
                                        </table>
                                    </div>
                                </div>
                            <!-- /.card-body --> 
                            </div>
                            </div>';  
                    
                } else {
                    echo '';
                }
            }
            mysqli_stmt_close($stmt);
            mysqli_close($connessione);
            
        }
            
    }



    ?>

    <?php
        if(isset($_SESSION['collezione-selezionata'])){
            
        if($_SESSION['collezione-selezionata'] == false){
            echo '';
        }else{

            if(isset($_GET['Edit'])){
                $album_to_edit = $_GET['Edit'];
                $id = $_GET['ID'];
                

                echo'  
                <div class="card-footer">
                <div class="row justify-content-center"> 
                    <form method="POST" action="php/albuminsert.php?E='.$id .'" class="form-inline">
                        <div class="form-group">
                            <label for="old_album_name">Modifica il titolo dell\'album</label>
                        </div>
                        <div class="form-group mx-sm-3">
                            <input type="text" class="form-control" name="old_album_name"  value='.$album_to_edit.'>
                        </div>
                        <input type="submit" class="btn btn-info" name="update_album" value="Aggiorna" >
                    </form>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>';
            }
            else{
                echo'   

                <div class="card-footer">
                <div class="row justify-content-center"> 
                <form method="POST" action="php/albuminsert.php" class="form-inline">
                    <div class="form-group">
                        <label for="inputalbum">Aggiungi un nuovo album</label>  
                    </div>
                    <!--<div class="form-group mx-sm-3">  -->
                    <table>
                        <tr>
                            <td>
                                <input  id="inputalbum" type="text" name="album_name" class="form-control"  placeholder="Nome dell\'album">
                            </td>
                            <!--</div>  -->
                            <td>
                                <button type="submit" style="background-color: #5401a7;" class="btn text-white" name="aggiungi_album" value="Aggiungi Album">Add</button>
                            </td>
                        </tr>
                    </table>
                </form>
                </div>
                </div>
                </div>
                </div>
                </div>
                </div>
                </div>
                </div>
            ';
            }
            
        }
        }
} // fine if del ban == 0

elseif($ban_temporaneo == 1){

    echo '
    <br><br><br><br>
            <div class="row justify-content-center" >
                <div class="col-10">
                    <div class="card card-danger card-outline">

                    <div class="card-header">
                        <h5 class="card-title m-0">Il periodo di prova dei 30 giorni è terminato.</h5>
                    </div>
                    <div class="card-body">

                    <br>

                        
                            <center>
                            <text>
                                La prova gratuita di 30 giorni è scaduta, ma vorremmo che continuaste ad utilizzare la nostra piattaforma. <br>
                                Per farlo, è sufficiente andare alla pagina <a href="https://collectionsight.com/payments.php">Iscriviti</a> e pagare una e una sola volta 2.99 € utilizzando i Servizi Paypal, <br>
                                dopodiché, i tuoi dati saranno memorizzati nei nostri server.
                                <br><br><br>
                                Il team di Collection Sight.
                            </text>
                            </center>
                                                           
                            
                    </div>
            
         

                </div>
            </div>
            
    
                    ';


}

?>

<br><br><br><br><br><br><br><br><br><br>


<?php
    require "footer.php";
?>


<?php

function verify_if_is_payed($id_user)
{
    require "php/dbh.php";

    $ban_temporaneo = false;

    $sql = "SELECT Create_date, Payed, Payment_date FROM user WHERE Iduser=? LIMIT 1";
    $stmt = mysqli_stmt_init($connessione);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "Error in the database";
    }
    else{
        mysqli_stmt_bind_param($stmt, "i", $id_user);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt); 

        if ($result->num_rows > 0)
        {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $data_creazione = $row['Create_date'];
            $pagato = $row['Payed'];
            $data_pagamento = $row['Payment_date'];

            }
        } 
        else {
             echo "0 results";
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($connessione);

    $ora_attuale = date("Y-m-d H:i:s");

    $date=date_create($data_creazione);
    date_add($date, date_interval_create_from_date_string("30 days"));
    $data_creazione_piu_un_mese = date_format($date,"Y-m-d H:i:s");


    if($pagato == 0 && $ora_attuale > $data_creazione_piu_un_mese ){
        $ban_temporaneo = true;
    }
    else{
        $ban_temporaneo = false;
    }

    return $ban_temporaneo;

}

