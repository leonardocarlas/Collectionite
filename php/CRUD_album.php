<?php
    require 'dbh.php';
    session_start();

    $idcollection = $_SESSION['idcollezione'];
    $user = $_SESSION['usernamesession'];
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






// FROM: home.php --- Gestione eliminazione Album 
 
elseif(isset($_POST['delete_id_album'])){

    $id_album = mysqli_real_escape_string($connessione,$_POST['delete_id_album']);
    
    $sql = "DELETE FROM album WHERE Idalbum = ? ";
    $stmt = mysqli_stmt_init($connessione);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../home.php?error=sqlerror");
        echo "error";
    }else{
        mysqli_stmt_bind_param($stmt, "i", $id_album);
        mysqli_stmt_execute($stmt);

        echo "success";

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


elseif ( isset( $_POST['magic_number'] ) ) {

    $id_album = $_SESSION['idalbum'];

    $file = date("Y-m-d_H-i-s")."".$id_album.".txt";

    $txt = fopen($file, "w") or die("Unable to open file!");

    $content = "Collection Sight Format, Album of cards \n";

    $carte = get_cards_for_the_album($_SESSION['idusersession'], $id_album);

    $content .= $carte . "\n";

    $content .= "End Collection Sight Format, www.collectionsight.com";

    fwrite($txt, $content);

    fclose($txt);

    echo $file;

}






//////////// ALTRIMENTI   ///////////


else{
    echo  "Failure";

}









function get_cards_for_the_album($id_user, $id_album) {

    require "dbh.php";
    $sql = "SELECT Idpossession, cards.Idcard, cards.Idset, Quantity, cards.English_card_name,
    Language, ExtraValues, Conditions, cards.Website, cards.Image_link, prices.Min_value, prices.Trend_Value, expansion.English_set_name
    FROM possesses 
    INNER JOIN cards ON possesses.Idcard = cards.Idcard
    INNER JOIN prices ON prices.Idcard = possesses.Idcard
    INNER JOIN expansion ON expansion.Idset = cards.Idset
    WHERE possesses.Iduser = ? AND possesses.Idalbum = ?
    GROUP BY possesses.Idcard; " ;

    $stmt = mysqli_stmt_init($connessione);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "Error in the database";
    }
    else{
            mysqli_stmt_bind_param($stmt, "ii", $id_user, $id_album);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt); 

            if ($result->num_rows > 0) {

                $string = "Card name, Set name, Min Value, Trend_value, Quantity, Language, Extra values, Conditions \n";
                while($row = $result->fetch_assoc()) {                        
                    $string .= $row['English_card_name'] .",  ". $row['English_set_name'] .",  ".  $row['Min_value']. ",  ". $row['Trend_Value'] .",  ". $row['Quantity'] .",  ". $row['Language'] .",  ". $row['ExtraValues'].",  ". $row['Conditions'] . "\n";   
                }
                return $string;
            }
            else{
                
                return "No carte ";
            }

    }
    mysqli_stmt_close($stmt);
    mysqli_close($connessione);

     
}
?>