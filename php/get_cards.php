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
        header("Location: ../album.php?Deleted=True");
        exit();
}
else
{
    header("Location: ../album.php?CARD=INSERTED");
    exit();
}