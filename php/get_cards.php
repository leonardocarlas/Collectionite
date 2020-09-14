<?php
    session_start();
    require 'dbh.php';
    $user = $_SESSION['usernamesession'];
    $album_corrente= $_SESSION['album-selezionato'] ;
    $idcollection = $_SESSION['idcollezione'];
    $id_user = $_SESSION['idusersession'];
    $id_album = $_SESSION['idalbum'];

if(isset($_POST['aggiorna_carte']) or isset($_GET['Deleted']))
{
    
    //$sql = "SELECT Idcard FROM POSSESSES WHERE POSSESSES.Iduser = '$id_user'  AND ALBUM.Idcollection='$idcollection' AND POSSESSES.Idalbum='$id_album' ";
    //$result = mysqli_query($connessione, $sql);

    //if (mysqli_num_rows($result) > 0) {
    
        header("Location: ../album.php?Carte=PRESENTI");
        exit();

    //} else {
    //    header("Location: ../album.php?error=NOCARDS4U");
    //    exit();

    //}

    //mysqli_close($connessione);
}
else{
    header("Location: ../album.php?CARD=INSERTED");
    exit();
}