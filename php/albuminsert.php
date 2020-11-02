<?php
    require 'dbh.php';
    session_start();

    $idcollection=$_SESSION['idcollezione'];
    $user=$_SESSION['usernamesession'];
    $id_user = $_SESSION['idusersession'];
    $_SESSION['reload-album'] = false;


////////// FROM: home.php --- Inserisce nel db l'album inserito dall'utente    ///////////

if(isset($_POST['aggiungi_album'])){


    $albumname = mysqli_real_escape_string($connessione, $_POST['album_name']);
    
    if(empty($albumname)){
        header("Location: ../home.php?error=emptyfield");
        exit();
    }
    else{
        $sql = "INSERT INTO album (Album_name, Idcollection, Iduser) VALUES (?,?,?)";
        $stmt = mysqli_stmt_init($connessione);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../home.php?error=sqlerror");
            exit();
        }else{
            mysqli_stmt_bind_param($stmt, "sii", $albumname, $idcollection, $id_user );
            mysqli_stmt_execute($stmt);

            $_SESSION['reload-album'] = true;
            

            header("Location: ../home.php?Insert=SUCCESS");
            exit();

        }

    }
    mysqli_stmt_close($stmt);
    mysqli_close($connessione);
  
}






/////////////// FROM: home.php --- Gestione eliminazione Album ////////////////
 
else if(isset($_GET['delete'])){

    $id = mysqli_real_escape_string($connessione, $_GET['delete']);
    // sql to delete a record
    $sql = "DELETE FROM album WHERE Idalbum = '$id' ";

    if ($connessione->query($sql) === TRUE) {

        $_SESSION['reload-album'] = true;
        $_SESSION['MESSAGE'] = "Album has been deleted!";
        $_SESSION['msg-type'] = "danger";

        header("Location: ../home.php?DELETED=CORRECTLY");
        exit();

    } else {
    echo "Error deleting record: " . $connessione->error;
    }

    $connessione->close();
}





//////////  FROM: home.php --- GESTIONE RICHIESA DI MODIFICA DELL'ALBUM ///////////

elseif(isset ($_GET['edit'])) {

    $id = mysqli_real_escape_string($connessione, $_GET['edit']);

    $sql = "SELECT Album_name, Idalbum FROM album WHERE Idalbum = '$id' ";
    $result = mysqli_query($connessione, $sql);

    if (count($result)==1) {
        $row = $result->fetch_array();
        $name = $row['Album_name'];

        header("Location: ../home.php?Edit=".$name."&ID=".$id);
        exit();
    }
    
}





////////// FROM: home.php --- MODIFICA EFFETTIVA DEL NOME DELL'ALBUM //////////////

elseif(isset($_POST['update_album'])){

    $nome= mysqli_real_escape_string($connessione, $_POST['old_album_name']);
    $id = mysqli_real_escape_string($connessione,$_GET['E']);
    
    $sql = "UPDATE album SET Album_name='$nome' WHERE Idalbum='$id' ";

    if ($connessione->query($sql) === TRUE) {

        $_SESSION['reload-album'] = true;
        header("Location: ../home.php?MODIFIED=SUCCESS");
        exit();

    } else {
    echo "Error updating record: " . $connessione->error;
    }

    $connessione->close();
}



//////////// ALTRIMENTI   ///////////


else{
    echo  "Failure";

}

