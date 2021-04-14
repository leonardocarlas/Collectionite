<?php

session_start();
$id_album = $_SESSION['idalbum'];

$file = date("Y-m-d_H-i-s")."".$id_album.".txt";

$txt = fopen($file, "w") or die("Unable to open file!");

$content = "Collection Sight Format, Album of cards \n";

$carte = get_cards_for_the_album($_SESSION['idusersession'], $id_album);

$content .= $carte . "\n";

$content .= "End Collection Sight Format, www.collectionsight.com";

echo $content;

fwrite($txt, $content);


fclose($txt);

if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
}



unlink($file);




function get_cards_for_the_album($id_user, $id_album){

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