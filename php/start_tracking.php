<?php  

if(isset($_GET['start-track'])){
    $id_album = $_GET['start-track'];

    require "dbh.php";

    $sql = "INSERT INTO statistic (Idalbum) VALUES ('$id_album')";

    if ($connessione->query($sql) === TRUE) {
        header("Location: ../album.php?ALBUM=REGISTERED");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $connessione->error;
    }

    $connessione->close();
}