<?php

    require "php/dbh.php";
    require "header.php";

?>

<div class="content-wrapper" style="min-height: 636.763px;">

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-5">

          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Search for a User's Collection</h1>
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

                        <input type="text" name="user-searched" class="form-control" placeholder="Enter the name of the user to see his collection" aria-label="User collection search item" aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                        </div>
                    </div>
                </form>
                
            </div><!-- /.col -->
        </div>
        <!-- 1. FINISH  -->
        
        <!-- 2. VISUALIZZAZIONE DEGLI ALBUM DELL'UTENTE X   -->
        <?php if(isset($_GET['OPENu'])) { 
        
        $id_user = $_GET['OPENu'];
        
        ?>

        <div class="row justify-content-center mt-5">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">Album from the Collection of user</h3>
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
                                            <th>Type of Collection</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php 
                                        $sql = "SELECT * FROM album WHERE Iduser='$id_user'; ";
                                        $result = $connessione->query($sql);
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
                                                            <td> <a href="album.php?OPENida='. $row["Idalbum"].'&idu='.$id_user .'&idc='.$idcollection .'&na='.$row["Album_name"].'&nu=si">View Album</a> </td>
                                                        </tr>';
                                            }
                                        }
                                        else{
                                            echo '<tr>
                                                    <td> This user has no album in his cllection</td>
                                                  </tr>';
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
        <?php  }  ?>

        <!-- 3. VISUALIZZAZIONE DEGLI UTENTI TROVATI DAL SEARCH FIELD   -->
        <?php if(isset($_GET['user-searched'])) { ?>

        <?php 
            $user_searched = $_GET['user-searched'];
         ?>

        <div class="row justify-content-center mt-5">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">Users:</h3>
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
                                            <th>Actions:</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php 
                                        $sql = "SELECT Iduser,Username FROM user WHERE Username LIKE '%$user_searched%' ; ";
                                        $result = $connessione->query($sql);
                                        if ($result->num_rows > 0) {

                                            while($row = $result->fetch_assoc()) {
                            
                                                echo '
                                                        <tr>
                                                            <td> '.$row["Username"].' </td>
                                                            <td> <a href="search_page.php?OPENu='. $row["Iduser"].'">View Collection</a> </td>
                                                        </tr>';
                                            }
                                        }
                                        else{
                                            echo '<tr>
                                                    <td> There are no user with this username</td>
                                                  </tr>';
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

        <?php  }  ?>



      </div>
    </div>






























<br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br>






<?php
    require "footer.php";
?>