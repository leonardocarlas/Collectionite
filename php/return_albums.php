<?php

if(isset($_POST['collezione']) && isset($_POST['user'])) {

    $id_user = $_POST['user'];
    $id_collezione = $_POST['collezione'];

    session_start();
    $_SESSION['idcollezione'] = $id_collezione;

    require "dbh.php";
    $array_album = array();

    $sql = "SELECT Album_name, Idalbum FROM album WHERE Iduser=? AND Idcollection=? ; ";
    $stmt = mysqli_stmt_init($connessione);
    if(!mysqli_stmt_prepare($stmt, $sql)){
    echo "Error in the database";
    }
    else{
        mysqli_stmt_bind_param($stmt, "ii", $id_user, $id_collezione);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt); 

        if ($result->num_rows > 0) {
            echo '<br><br>';
            while($row = $result->fetch_assoc()) {
                array_push($array_album,  $row['Album_name']);
                array_push($array_album,  $row['Idalbum']);
            }
            for ($i = 0; $i < count ($array_album); $i = $i + 2){
                echo '
                    <div class = "row justify-content-center">
                        <a href = "album.php?ID='.$array_album[$i+1].'" >
                            <div>
                                <div class = "row justify-content-center">
                                    <img src = "immagini/album_nuovo.png" width = "100" height = "100" >
                                </div>
                                <div class = "row justify-content-center">
                                    <p> '.$array_album[$i].' </p>
                                </div>
                            </div>
                        </a>
                    </div> 
                    ';
            } 

            //DO LA POSSIBILITA' DI CREARE ALBUM
            echo '
                <br><br><br><br><br>
                <div class="row justify-content-center">
                    <div class = "col" > 
                        <div class="row justify-content-center"> 
                            <p>Aggiungi un nuovo album</p>  
                        </div>

                        <div class="row justify-content-center">
                            <form method="POST" action="php/albuminsert.php"> 
                                <table>
                                    <tr>
                                        <td>
                                            <input  id="inputalbum" type="text" name="album_name" class="form-control"  placeholder="Nome dell\'album">
                                        </td>
                                        
                                        <td>
                                            <button type="submit" style="background-color: #5401a7;" class="btn text-white" name="aggiungi_album" value="Aggiungi Album">Add</button>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                </div> 
                    ';

        } else {
           
            echo '
                <br><br>

                <div class="row justify-content-center">
                    <div class = "col" > 
                        <div class = "row justify-content-center">
                            <p>Non hai ancora inserito album per questa sezione</p>
                        </div>

                        <br><br><br><br>
                        
                        <div class="row justify-content-center"> 
                            <p>Aggiungi un nuovo album</p>  
                        </div>

                        <div class="row justify-content-center">
                            <form method="POST" action="php/albuminsert.php"> 
                                <table>
                                    <tr>
                                        <td>
                                            <input  id="inputalbum" type="text" name="album_name" class="form-control"  placeholder="Nome dell\'album">
                                        </td>
                                        
                                        <td>
                                            <button type="submit" style="background-color: #5401a7;" class="btn text-white" name="aggiungi_album" value="Aggiungi Album">Add</button>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                </div> 
                    ';

            
        }

    }
    mysqli_stmt_close($stmt);
    mysqli_close($connessione);
}


