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



<?php
    $carta = "Dark Blastoise [Hydrocannon | Rocket Tackle] (V.1)";
    echo "Pre:  " .$carta  ;
    echo "<br><br>";
    $carta = preparation_name($carta);
    echo "Post : " . $carta;

?>