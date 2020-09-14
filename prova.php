<?php

$cardname = "Groudon ☆";
$cardset = "EX Delta Species";
$idcollection = 6;
/*
if(isset($_SESSION['compile'])){
        if(($_SESSION['compile']) == true){
        echo exec('javac -cp .;json-java.jar TestMain.java');
        }

}
*/
if (strpos($cardname, '☆') !== false) {
        $cardname = str_replace("☆", "", "$cardname");
      }

if (strpos($cardname, '|') !== false) {
        $cardname = str_replace("|", "", "$cardname");
        
 }

?>
        <div>
                <table>
                        <table>
                        <tr>
                                <td>Card Name</td>
                                <td>Trend Price</td>
                        </tr>
                        <tr>
                                <td> <?php echo $cardname ?>  </td>
                                <td> <?php echo exec("java -cp .;json-java.jar TestMain ". $cardname . " + ". $cardset . " ". $idcollection ); ?> </td>
                        </tr>
                        </table>
        </div>
      

