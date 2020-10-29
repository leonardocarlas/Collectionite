<?php

require "dbh.php";


if(isset($_GET['register'])){
    $min = $_GET['min'];
    $trend = $_GET['trend'];
    $idalbum = $_GET['album'];

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