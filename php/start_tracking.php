<?php  

if(isset($_GET['start-track'])){

    require "dbh.php";

    $id_album = mysqli_real_escape_string($connessione, $_GET['start-track']);

    $sql = "INSERT INTO statistic (Idalbum) VALUES ('$id_album')";

    if ($connessione->query($sql) === TRUE) {
        header("Location: ../album.php?ALBUM=REGISTERED");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $connessione->error;
    }

    $connessione->close();
}