<?php



if(isset($_POST['collezione']) && isset($_POST['user'])) {

    $id_user = $_POST['user'];
    $id_collezione = $_POST['collezione'];

    require "dbh.php";
    $array_album = array();
    $sql = "SELECT Album_name, Idalbum FROM album WHERE Iduser=? AND Idcollection=? ; ";
    $stmt = mysqli_stmt_init($connessione);
    if(!mysqli_stmt_prepare($stmt, $sql)){
    echo "Error in the database";
    }
    else{
    mysqli_stmt_bind_param($stmt, "ii", $id_user, $idcollection);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt); 

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
         
            //echo ' Album : '. $row['Album_name'].' ID : '.$row['Idalbum']. '<br>';
            //GENERO GLI ALBUM
            array_push($array_album,  $row['Album_name']);
            array_push($array_album,  $row['Idalbum']);
        }
        echo $array_album; 
    } else {
        array_push($array_album,  "NO ALBUM");
        echo "<p>No hai ancora inserito album per questa sezione</p>";
    }

    }
    mysqli_stmt_close($stmt);
    mysqli_close($connessione);
}


