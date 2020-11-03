<?php  

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