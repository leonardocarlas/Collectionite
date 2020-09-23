<?php
    require "header.php";
    require "php/dbh.php";
    $col_selected = $_SESSION['collezione-selezionata'];

    $id_user = $_SESSION['idusersession'];

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
        'Deleted Album!',
        '',
        'success'
        );
    </script>
<?php } ?>

<?php 
    if(isset($_GET['MODIFIED'])){ ?>
    <script type="text/javascript">
        Swal.fire(
        'The album it s been succesfully modified',
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
            'Error in the databse, please contact the administrator',
            '',
            'error'
            );
        </script>
<?php }} ?>


<?php
if(isset($col_selected)){

    if($col_selected == false){

    echo '
    <div class="content-wrapper">
    <div class="content-header">
        <div class="container">
        <div class="row mb-5">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Welcome back '.$_SESSION['usernamesession'].'!</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">First, select a Card Collection</h3>
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
                        <button class="btn btn-primary" type="submit" name="selected-collection">Conferma</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
    <div class="row justify-content-center mt-5">
        <div class="col-6">
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
                                        <th>Action</th>
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
                    <h1 class="m-0 text-dark"> Collection type: '. $name_collection .'</h1>
                    </div><!-- /.col -->
                </div>
                <div class="row mb-5">
                    <form method="POST" action="php/change_collection.php">
                        <button class="btn btn-primary" type="submit" name="change-collection">Change Collection</button> 
                    </form>
                </div>
                </div><!-- /.container-fluid -->
            </div>' ;

        

        $sql = "SELECT Album_name, Idalbum FROM album WHERE Iduser='$id_user' AND Idcollection='$idcollection' ; ";
        
        $result = $connessione->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
            echo'
            <div class="content">
            <div class="container">
            <div class="row justify-content-center mt-2">
                <div class="col-10">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                        <h3 class="card-title">Your albums</h3>
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
                                                <th colspan="2">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';           
            
                
                        while($row = $result->fetch_assoc()) {
                            
                            echo '
                                    <tr onclick="location.href=\'album.php?OPEN='.$row["Album_name"]."&ID=".$row["Idalbum"].'\'">
                                        <td> '.$row["Album_name"].' </td>
                                        <td> <a href="php/albuminsert.php?edit='. $row["Idalbum"].'">Edit</a> </td>
                                        <td> <a href="php/albuminsert.php?delete='. $row["Idalbum"] .'">Delete</a> </td>
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
        $connessione->close();
        
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
                        <label for="old_album_name">Modifica titolo album</label>
                    </div>
                    <div class="form-group mx-sm-3">
                        <input type="text" class="form-control" name="old_album_name"  value='.$album_to_edit.'>
                    </div>
                    <input type="submit" class="btn btn-info" name="update_album" value="Update" >
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
                    <label for="inputalbum">Add a new Album</label>  
                </div>
                <div class="form-group mx-sm-3">
                    <input  id="inputalbum" type="text" name="album_name" class="form-control"  placeholder="Album Name">
                </div>  
                <button type="submit" class="btn btn-primary" name="aggiungi_album" value="Add Album">Add</button>
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

?>


<?php
    require "footer.php";
?>

