<?php
    require 'dbh.php';

    session_start();

    if(isset($_SESSION['idusersession'])){
        $id_user = $_SESSION['idusersession'];
    }
    if(isset($_SESSION['idalbum'])){
        $id_album = $_SESSION['idalbum'];
    }


//////  FROM: add_card.php (album.php) ---  INSERIMENTO NEL DB DI UNA CARTA   //////////

if(isset($_POST['inserisci-carta'])){

    $nome_set = $_POST['set_name'];
    $nome_carta = $_POST['card_name'];
    $conditions = $_POST['conditions'];
    $languages = $_POST['languages'];
    $quantity = $_POST['quantities'];
    $extravalues = $_POST['extravalues'];

    $nome_carta = preparation_name($nome_carta);
    
   
    ////////  Gestire errori //////////
    if(empty($nome_set) || empty($nome_carta)){
        header("Location: ../album.php?error=emptyfields");
        exit();
    }
    
    ////// Check existance of the card and get the id   /////

    else{
      

        $sql = "SELECT Idcard FROM CARD WHERE Set_name = '$nome_set' AND Card_name = '$nome_carta'";
        $result = $connessione->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {

            $id_carta = $row['Idcard'];

            $sql = "INSERT INTO POSSESSES (Iduser, Idcard, Idalbum, Quantity, Language, ExtraValues, Conditions) VALUES (?,?,?,?,?,?,?)";
                $stmt = mysqli_stmt_init($connessione);

                echo "4";

                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../add_card.php?error=sqlerror");
                    exit();
                }else{    ////////modificareeee
                    mysqli_stmt_bind_param($stmt, "iiiisss", $id_user, $id_carta, $id_album, $quantity, $languages, $extravalues, $conditions );
                    mysqli_stmt_execute($stmt);


                header("Location: get_cards.php?CARD=INSERTED");
                exit();

                }




        }
        } else {
            header("Location: ../album.php?error=SQL_CardNotInDB");
            exit();
        }
        $connessione->close();
    }
}


/*
if(isset(($_GET['edit']))){

    $name_tomod = $_GET['edit'];
    $sql = "SELECT CardName, CardSet FROM possesses WHERE CardName = '$name_tomod'  ";
    $result = mysqli_query($connessione, $sql);

    if (count($result)==1) {
        $row = $result->fetch_array();
        $name = $row['CardName'];
        $set = $row['CardSet'];

        header("Location: ../album.php?Edit=".$name_tomod."&Set=".$set);
        exit();
    }
    


}
*/

////////////   FROM: add_card.php (album.php) --- CANCELLAMENTO DI UNA CARTA DAL DB  ////////////

else if(isset($_GET['delete'])){

    $id_possession = $_GET['delete'];

    // sql to delete a record
    $sql = "DELETE FROM possesses WHERE Idpossession = '$id_possession' ";

    if ($connessione->query($sql) === TRUE) {

       
        header("Location: get_cards.php?Deleted=True");
        exit();
        //header a get_card con ? = deleted

    } else {
    echo "Error deleting record: " . $connessione->error;
    }

    $connessione->close();


}


?>


<?php

    function preparation_name(string $card_name){
        $nome = $card_name;
        if (strpos($nome, ' (V.1)') == true){
            $nome = str_replace(' (V.1)', '', $nome);
        }
        if (strpos($nome, ' (V.2)') == true){
            $nome = str_replace(' (V.2)', '', $nome);
        }
        return $nome;
    }
?>


