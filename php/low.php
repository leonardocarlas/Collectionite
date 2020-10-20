<?php


    function manipulationlink($collegamento){

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

            ECHO $sql;

            

            $result = $connessione->query($sql);

            if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
               echo "Carta: " . $row["Card_name"] . " Set: ". $row["Set_Name"] . "<br>";

                     ///////////   punto definitivo   //////////
            }
            } else {
            echo "0 results";
            }
            $connessione->close();
            

        }

        


    }

    $link =   "https://www.cardmarket.com/it/Pokemon/Products/Singles/Legendary-Collection/Beedrill";
    manipulationlink($link);

?>