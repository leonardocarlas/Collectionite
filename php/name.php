<?php

    function preparation_name(string $card_name){
        $nome = $card_name;
        if (strpos($nome, ' (V.1)') == true){
            $nome = str_replace(' (V.1)', '', $nome);
        }
        if (strpos($nome, ' (V.2)') == true){
            $nome = str_replace(' (V.2)', '', $nome);
        }
        if (strpos($nome, ' δ') == true){
            $nome =  str_replace(' δ', '', $nome);
        }
        if (strpos($nome, ']') == true){
            $nome =  str_replace(']', '', $nome);
        }
        if (strpos($nome, '[') == true){
            $nome =  str_replace('[', '', $nome);
        }
        if (strpos($card_name, '|') == true){
            $nome =  str_replace('|', '', $nome);
        }
        

        return $nome;
    }
?>




<?php
    $carta = "Simisage [Seed Bomb | Giga Impact]";  //"Kyogre ☆";
    echo "Pre:  " .$carta  ;
    echo "<br><br>";
    $carta = preparation_name($carta);
    echo "Post : " . $carta;

?>