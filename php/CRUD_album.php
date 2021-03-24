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
 
elseif(isset($_GET['Delete'])){

    $id_album = mysqli_real_escape_string($connessione, $_GET['delete']);

    $sql = "DELETE FROM album WHERE Idalbum = ? ";
    $stmt = mysqli_stmt_init($connessione);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../home.php?error=sqlerror");
        exit();
    }else{
        mysqli_stmt_bind_param($stmt, "i", $id_album);
        mysqli_stmt_execute($stmt);

        header("Location: ../home.php?DELETED=CORRECTLY");
        exit();

    }
    mysqli_stmt_close($stmt);
    mysqli_close($connessione);
}





//////////  FROM: home.php --- GESTIONE RICHIESA DI MODIFICA DELL'ALBUM ///////////

elseif(isset($_POST['id_album']) && isset($_POST['new_album_name'])) {

    $id_album = mysqli_real_escape_string($connessione, $_POST['id_album']);
    $new_album_name = mysqli_real_escape_string($connessione, $_POST['new_album_name']);


    $sql = "UPDATE album SET Album_name=? WHERE Idalbum=?";
    $stmt = mysqli_stmt_init($connessione);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "Error updating record: " . $connessione->error;
        header("Location: ../home.php");
        exit();
    }
    else{
        mysqli_stmt_bind_param($stmt, "si", $new_album_name, $id_album );
        mysqli_stmt_execute($stmt);

        header("Location: ../home.php?MODIFIED=SUCCESS");
        exit();

    }
    mysqli_stmt_close($stmt);
    mysqli_close($connessione);


    
}






//////////// ALTRIMENTI   ///////////


else{
    echo  "Failure";

}

