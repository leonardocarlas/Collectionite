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
        exit();

    }
    else{

        mysqli_stmt_bind_param($stmt, "iii", $trend, $min, $idalbum);
        mysqli_stmt_execute($stmt);

        header("Location: ../album.php?STATISTIC=INSERTED");
        exit();
    }

    mysqli_stmt_close($stmt);
    mysqli_close($connessione);

}

if(isset($_GET['start-track'])){

    require "dbh.php";

    $id_album = mysqli_real_escape_string($connessione, $_GET['start-track']);

    $sql = "INSERT INTO statistic (Idalbum) VALUES (?)";
    $stmt = mysqli_stmt_init($connessione);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "SQL statement failed";
        echo "Error: " . $sql . "<br>" . $connessione->error;
    }
    else{
        mysqli_stmt_bind_param($stmt, "i", $id_album);
        mysqli_stmt_execute($stmt);

        header("Location: ../album.php?ALBUM=REGISTERED");
        exit();

    }

    mysqli_stmt_close($stmt);
    mysqli_close($connessione);

}