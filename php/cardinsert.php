<?php
    require 'dbh.php';

    session_start();

    if(isset($_SESSION['idusersession'])){
        $id_user = $_SESSION['idusersession'];
    }
    if(isset($_SESSION['idalbum'])){
        $id_album = $_SESSION['idalbum'];
    }


//////  FROM: add_card.php (album.php) ---  INSERIMENTO NEL DB DI UNA CARTA TRAMITE SET E NAME   //////////

if(isset($_POST['inserisci-carta']) AND isset($_SESSION['ONLY-LINK']) AND $_SESSION['ONLY-LINK'] == FALSE){

    $nome_set = $_POST['set_name'];
    $nome_carta = $_POST['card_name'];
    $conditions = $_POST['conditions'];
    $languages = $_POST['languages'];
    $quantity = $_POST['quantities'];
    $extravalues = $_POST['extravalues'];

    $nome_carta = preparation_name($nome_carta);
    $nome_set = preparation_set($nome_set);
    
   
    ////////  Gestire errori //////////
    if(empty($nome_set) || empty($nome_carta)){
        header("Location: ../album.php?error=emptyfields");
        exit();
    }
    if( $conditions==="--Conditions--" || $languages==="--Languages--" || $quantity==="--Quantities--" || $extravalues==="--Extra Values--"){
        header("Location: ../album.php?error=features-not-selected");
        exit();
    }
    
    ////// Check existance of the card and get the id   /////

    else{
      

        $sql = "SELECT Idcard FROM card WHERE Set_name = '$nome_set' AND Card_name = '$nome_carta'";
        $result = $connessione->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {

            $id_carta = $row['Idcard'];

            $sql = "INSERT INTO possesses (Iduser, Idcard, Idalbum, Quantity, Language, ExtraValues, Conditions) VALUES (?,?,?,?,?,?,?)";
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

//////  FROM: add_card.php (album.php) ---  INSERIMENTO NEL DB DI UNA CARTA TRAMITE LINK   //////////

else if( isset($_POST['inserisci-carta']) AND isset($_SESSION['ONLY-LINK']) AND $_SESSION['ONLY-LINK'] == TRUE){

    $link = $_POST['link_card'];
    $conditions = $_POST['conditions'];
    $languages = $_POST['languages'];
    $quantity = $_POST['quantities'];
    $extravalues = $_POST['extravalues'];  
   
    ////////  Gestire errori //////////
    if(empty($link)){
        header("Location: ../album.php?error=emptyfields");
        exit();
    }
    if( $conditions==="--Conditions--" || $languages==="--Languages--" || $quantity==="--Quantities--" || $extravalues==="--Extra Values--"){
        header("Location: ../album.php?error=features-not-selected");
        exit();
    } 

    ////// Check existance of the card and get the id   /////
    else{

        // Processamento del link della carta
        $a = manipulationlink($link);
        if($a == 0){
            header("Location: ../album.php?error=problemIntheLink");
            exit();
        }
        else{

            $nome_carta = $a[0];
            $nome_set = $a[1];

            $sql = "SELECT Idcard FROM card WHERE Set_name = '$nome_set' AND Card_name = '$nome_carta'";
            $result = $connessione->query($sql);

            if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {

                $id_carta = $row['Idcard'];

                $sql = "INSERT INTO possesses (Iduser, Idcard, Idalbum, Quantity, Language, ExtraValues, Conditions) VALUES (?,?,?,?,?,?,?)";
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
        }
        $connessione->close();
    }

}



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

    function preparation_set(string $card_set){
        $nome_set = $card_set;
        
        if($nome_set === "Expedition"){
            $nome_set = "Expedition Base Set";
        }
        return $nome_set;
    }

    function manipulationlink($collegamento)
    {

        require "dbh.php";
          //https://www.cardmarket.com/en/Pokemon/Products/Singles/Wizards-Black-Star-Promos/Scizor-Pokemon-League
          $mystring = $collegamento;
          $pos = strpos($mystring, 'Singles');
  
          // Note our use of ===.  Simply == would not work as expected
          // because the position of 'a' was the 0th (first) character.
          if ($pos === false) {
              return 0;
          } else {
              $mystring = substr($mystring, $pos + 8, strlen($mystring));
              echo $mystring;
  
              $findme   = '/';
              $pos = strpos($mystring, $findme);
  
              $nome_set = substr($mystring, 0, $pos);
              $nome_carta = substr($mystring, $pos+1, strlen($mystring));
  
              //$array_carta = str_split($nome_carta);
              $nome_carta_in_array = explode("-", $nome_carta);
              $nome_set_in_array = explode("-", $nome_set);
  
              $numero_parole_carta = count( $nome_carta_in_array );
              $numero_parole_set = count( $nome_set_in_array);
  
              $nome_carta = str_replace("-", " ", $nome_carta);
              $nome_set = str_replace("-", " ", $nome_set);
  
              echo "Nome carta: " . $nome_carta;
              echo "Nome set: " . $nome_set;
              print_r($nome_carta_in_array);
              print_r($nome_set_in_array);
  
  
              $sql = "SELECT Card_name, Set_Name FROM card WHERE Card_name LIKE ";
              // PER LA CARTA
              if($numero_parole_carta > 1){
  
                 foreach( $nome_carta_in_array  as  $nomi ){
  
                    if($nomi === $nome_carta_in_array[$numero_parole_carta-1]){
                       $add_to_like = "'%". $nomi . "%'";
                       $sql = $sql . $add_to_like;
                       break;
                    }
                    else{
                       $add_to_like = "'%". $nomi . "%'";
                       $sql = $sql . $add_to_like;
                       $sql = $sql . " AND Card_name LIKE ";
                    }
                    
                 }
              }
              else {
                 $sql = $sql ."'%". $nome_carta_in_array[0] . "%'";
              }
  
              $sql = $sql . "AND Set_name LIKE ";
              //PER IL SET
  
              if($numero_parole_set > 1){
  
                 foreach( $nome_set_in_array  as  $nomi ){
  
                    if($nomi === $nome_set_in_array[$numero_parole_set-1]){
                       $add_to_like = "'%". $nomi . "%'";
                       $sql = $sql . $add_to_like;
                       break;
                    }
                    else{
                       $add_to_like = "'%". $nomi . "%'";
                       $sql = $sql . $add_to_like;
                       $sql = $sql . " AND Set_name LIKE ";
                    }
                    
                 }
              }
              else {
                 $sql = $sql ."'%". $nome_set_in_array[0] . "%'";
              } 
              
  
              $result = $connessione->query($sql);
  
              if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    
                    $a = array();
                    array_push($a, $row["Card_name"],  $row["Set_Name"]);
                    ///////////   punto definitivo   ////////// echo "Carta: " . $row["Card_name"] . " Set: ". $row["Set_Name"] . "<br>";        
                }
                return $a;
              
              } else {
                return 0;
              }
              $connessione->close();
              
  
        }
    }
?>





