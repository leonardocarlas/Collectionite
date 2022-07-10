<?php

require "dbh.php";
session_start();

if(isset($_POST['minimo']) && isset($_POST['trend'])) {

    $min = mysqli_real_escape_string($connessione, $_POST['minimo']);
    $trend = mysqli_real_escape_string($connessione, $_POST['trend']);
    $idalbum = $_SESSION['idalbum'];

    $sql = "INSERT INTO statistic (Trend_value, Min_Value, Idalbum) VALUES (?,?,?)";
    $stmt = mysqli_stmt_init($connessione);

    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("Location: ../album.php?error=sqldatabase");
        echo "error";

    }
    else{

        mysqli_stmt_bind_param($stmt, "iii", $trend, $min, $idalbum);
        mysqli_stmt_execute($stmt);

        echo "success";
    
    }

    mysqli_stmt_close($stmt);
    mysqli_close($connessione);

}

if(isset($_POST['start_tracking_id_album'])){
    require "dbh.php";

    $id_album = mysqli_real_escape_string($connessione, $_POST['start_tracking_id_album']);

    $sql = "INSERT INTO statistic (Idalbum) VALUES (?)";
    $stmt = mysqli_stmt_init($connessione);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "error";
        header("Location: ../album.php?error=sqldatabase");
    }
    else{
        mysqli_stmt_bind_param($stmt, "i", $id_album);
        mysqli_stmt_execute($stmt);

        echo "success";

    }

    mysqli_stmt_close($stmt);
    mysqli_close($connessione);

}