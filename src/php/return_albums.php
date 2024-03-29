<?php

if(isset($_POST['collezione']) || isset($_GET['collezione'])) {

    session_start();
    require "dbh.php";

    if (isset($_SESSION['idusersession'])){
        $id_user = $_SESSION['idusersession'];
    }
    if (isset($_POST['collezione'])){
        $id_collezione = $_POST['collezione'];
    }
    if (isset($_GET['collezione'])){
        $id_collezione = $_GET['collezione'];
    }
    
    $_SESSION['idcollezione'] = $id_collezione;

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
            if (is_mobile() == false) {

                $numero_album = count ($array_album)/2;
                $righe = floor(intdiv($numero_album, 4));
                $riporto = $numero_album % 4;
                

                if ($righe > 0){
                    
                    for ($i = 0, $k = 0; $i < $righe; $i++, $k = $i * 4) //27
                    {
                        
                        echo '
                        
                            <div class="row justify-content-center">

                                <div class="col"> 
                                    <a href = "album.php?ID='.$array_album[$k+1].'&NAME='.$array_album[$k].'" >
                                        <div>
                                            <div class = "row justify-content-center">
                                                <img src = "immagini/album_nuovo.png" width = "100" height = "100" >
                                            </div>
                                            <div class = "row justify-content-center">
                                                <p> '.$array_album[$k].' </p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class = "row justify-content-center">
                                        <button type="button" class="btn btn-outline-info" onclick="modify_name('.$array_album[$k+1].','.$_SESSION["idcollezione"].')"> Cambia nome </button><p> </p><a type="button" onclick="delete_album('.$array_album[$k+1].','.$_SESSION["idcollezione"].')" class="btn btn-outline-danger" > Elimina album </a>
                                    </div>
                                </div>

                                <div class="col">
                                    <a href = "album.php?ID='.$array_album[$k+3].'&NAME='.$array_album[$k+2].'" >
                                        <div>
                                            <div class = "row justify-content-center">
                                                <img src = "immagini/album_nuovo.png" width = "100" height = "100" >
                                            </div>
                                            <div class = "row justify-content-center">
                                                <p> '.$array_album[$k+2].' </p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class = "row justify-content-center">
                                        <button type="button" class="btn btn-outline-info" onclick="modify_name('.$array_album[$k+3].','.$_SESSION["idcollezione"].')"> Cambia nome </button><p> </p><a type="button" onclick="delete_album('.$array_album[$k+3].','.$_SESSION["idcollezione"].')" class="btn btn-outline-danger" > Elimina album </a>
                                    </div>
                                </div>

                                <div class="col">
                                    <a href = "album.php?ID='.$array_album[$k+5].'&NAME='.$array_album[$k+4].'" >
                                        <div>
                                            <div class = "row justify-content-center">
                                                <img src = "immagini/album_nuovo.png" width = "100" height = "100" >
                                            </div>
                                            <div class = "row justify-content-center">
                                                <p> '.$array_album[$k+4].' </p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class = "row justify-content-center">
                                        <button type="button" class="btn btn-outline-info" onclick="modify_name('.$array_album[$k+5].','.$_SESSION["idcollezione"].')"> Cambia nome </button><p> </p><a type="button" onclick="delete_album('.$array_album[$k+5].','.$_SESSION["idcollezione"].')" class="btn btn-outline-danger" > Elimina album </a>
                                    </div>
                                </div>

                                <div class="col">
                                    <a href = "album.php?ID='.$array_album[$k+7].'&NAME='.$array_album[$k+6].'" >
                                        <div>
                                            <div class = "row justify-content-center">
                                                <img src = "immagini/album_nuovo.png" width = "100" height = "100" >
                                            </div>
                                            <div class = "row justify-content-center">
                                                <p> '.$array_album[$k+6].' </p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class = "row justify-content-center">
                                        <button type="button" class="btn btn-outline-info" onclick="modify_name('.$array_album[$k+7].','.$_SESSION["idcollezione"].')"> Cambia nome </button><p> </p><a type="button" onclick="delete_album('.$array_album[$k+7].','.$_SESSION["idcollezione"].')" class="btn btn-outline-danger" > Elimina album </a>
                                    </div>
                                </div>

                            </div>';
                            echo '<br>';
                    }
                }

                echo '<div class="row justify-content-center">';

                    for ($i = 0; $i < $riporto*2; $i=$i+2) {
                        echo '
                            <div class="col">
                                <a href = "album.php?ID='.$array_album[$i+1].'&NAME='.$array_album[$i].'" >
                                    <div>
                                        <div class = "row justify-content-center">
                                            <img src = "immagini/album_nuovo.png" width = "100" height = "100" >
                                        </div>
                                        <div class = "row justify-content-center">
                                            <p class="text-dark" > '.$array_album[$i].' </p>
                                        </div>
                                    </div>
                                </a>
                                <div class = "row justify-content-center">
                                    <button type="button" class="btn btn-outline-info" onclick="modify_name('.$array_album[$i+1].','.$_SESSION["idcollezione"].')"> Cambia nome </button><p> </p><a type="button" onclick="delete_album('.$array_album[$i+1].','.$_SESSION["idcollezione"].')" class="btn btn-outline-danger" > Elimina album </a>
                                </div>
                            </div>
                        ';
                    }

                echo '</div>';




               

            }
            else {

                for ($i = 0; $i < count ($array_album); $i = $i + 2){
                    echo '
                        <div class = "row justify-content-center">
                            <div class = "col">
                                <a href = "album.php?ID='.$array_album[$i+1].'&NAME='.$array_album[$i].'" >
                                    <div>
                                        <div class = "row justify-content-center">
                                            <img src = "immagini/album_nuovo.png" width = "100" height = "100" >
                                        </div>
                                        <div class = "row justify-content-center">
                                            <p> '.$array_album[$i].' </p>
                                        </div>
                                    </div>
                                </a>
                                <div class = "row justify-content-center">
                                    <button type="button" class="btn btn-outline-info" onclick="modify_name('.$array_album[$i+1].','.$_SESSION["idcollezione"].')"> Cambia nome </button><p> </p><a type="button" onclick="delete_album('.$array_album[$i+1].','.$_SESSION["idcollezione"].')" class="btn btn-outline-danger" > Elimina album </a>
                                </div>
                            </div>
                        </div> 
    
                        <br>
                        ';
                } 

            }
            

            //DO LA POSSIBILITA' DI CREARE ALBUM
            echo '
                <br><br>
                <div class="row justify-content-center">
                    <div class = "col" > 
                        <div class="row justify-content-center"> 
                            <p>Aggiungi un nuovo album</p>  
                        </div>

                        <div class="row justify-content-center">
                            <form method="POST" action="php/CRUD_album.php"> 
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
                            <form method="POST" action="php/CRUD_album.php"> 
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






    function is_mobile() {
        $ua = strtolower($_SERVER['HTTP_USER_AGENT']);
        $isMob = is_numeric(strpos($ua, "mobile"));
        return $isMob;
    }

?>



<script type = "text/javascript">
    function modify_name(id_album,id_collezione) {

        Swal.fire({
        title: 'Cambia il nome dell\'album',
        input: 'text',
        showCancelButton: true,
        confirmButtonText: 'Conferma',
        }).then((result) => {
                
            if(result.value){
                update_album( id_album , result.value,id_collezione);
                
            }
                
        })
    }   

    function delete_album(id_album, id_collezione)
    {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        });

        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
        }).then((result) => {
            if(result.value){
                delete_album_ajax(id_album,id_collezione);
            } 
        });
    }

</script>



<script type ="text/javascript">

    function update_album(id_album, new_album_name,id_collezione){
        $.post("php/CRUD_album.php",{"id_album":id_album, "new_album_name":new_album_name},function(data){
                return_albums(id_collezione);
            });
    }

    function delete_album_ajax(id_album,id_collezione){
        $.post("php/CRUD_album.php",{"delete_id_album":id_album},function(data){
                if(data == "success")
                {
                    Swal.fire({
                        icon: 'success',
                        title: 'Eliminato con successo',
                        }).then((result) => {
                            return_albums(id_collezione);
                    });
                }
            });
    }

</script>

