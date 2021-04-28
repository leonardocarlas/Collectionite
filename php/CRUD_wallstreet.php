<?php

if( isset($_POST['collezione']) ) {

    if (isset($_POST['collezione'])){
        $id_collezione = $_POST['collezione'];
    }

    get_things($id_collezione);

}



function get_things($id_collezione){

    require 'dbh.php';
        
    $sql = "SELECT cards.Image_link, cards.English_card_name, expansion.English_set_name, cards.Count_articles,
     cards.Count_foils , Min_value, Trend_value, ((AVG1 - Trend_value) / Trend_value) AS VAR1, 
     ((AVG7 - Trend_value) / Trend_value) AS VAR7, ((AVG30 - Trend_value) / Trend_value) AS VAR30, Foil_low, Foil_trend,
      ((Foil_avg1 - Foil_trend) / Foil_trend) AS FOILVAR1, ((Foil_avg7 - Foil_trend) / Foil_trend) AS FOILVAR7, 
      ((Foil_avg30 - Foil_trend)/ Foil_trend) AS FOILVAR30, (Trend_value * cards.Count_articles) AS EXPECTEDMC    
    FROM `prices`
    JOIN cards ON prices.Idcard = cards.Idcard
    JOIN expansion ON cards.Idset = expansion.Idset
    WHERE expansion.Idcollection = ?
    ORDER BY EXPECTEDMC DESC
    LIMIT 1000
     " ;

    // ORDER BY CAST(VAR30 AS SIGNED) DESC 

    $stmt = mysqli_stmt_init($connessione);

    if(!mysqli_stmt_prepare($stmt, $sql)) {
        echo "Error in the database";
    }
    else {
            mysqli_stmt_bind_param($stmt, "i", $id_collezione);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt); 
                                
            if ($result->num_rows > 0) {

                echo '
                    <div class = "row justify-content-center">
                        <div class="col-sm-12 table-responsive">
                            <table class="table table-borderless table-hover" role="grid">
                                <thead style="background-color: #5401a7;" class="text-white">
                                    <!-- <th style = "text-align: center;" scope="col">#</th> -->
                                    <th style = "text-align: center;" scope="col">Image</th>
                                    <th style = "text-align: center;" scope="col">Name</th>
                                    <th style = "text-align: center;" scope="col">Set</th>
                                    <th style = "text-align: center;" scope="col">Count Articles</th>
                                    <th style = "text-align: center;" scope="col">Count Foils</th>
                                    <th style = "text-align: center;" scope="col">Min Price</th>
                                    <th style = "text-align: center;" scope="col">Trend Price</th>
                                    <th style = "text-align: center;" scope="col">24h%</th>
                                    <th style = "text-align: center;" scope="col">7d%</th>
                                    <th style = "text-align: center;" scope="col">30d%</th>
                                    <th style = "text-align: center;" scope="col">Min Price Foil</th>
                                    <th style = "text-align: center;" scope="col">Trend Price Foil</th>
                                    <th style = "text-align: center;" scope="col">24h% Foil</th>
                                    <th style = "text-align: center;" scope="col">7d% Foil</th>
                                    <th style = "text-align: center;" scope="col">30d% Foil</th>
                                    <!-- <th style = "text-align: center;" scope="col">Expected Market Cap</th> -->
                                    
                                </thead>
                                <tbody>
                ';

                while ($row = $result->fetch_assoc()) {

                    $c = 0; 

                    echo '
                        

                                <tr>
                                    <!-- <td>'.$c.'</td> -->
                                    <td><img src = "'.$row['Image_link'].'" widtd = "20" height = "30" ></td>
                                    <td>'.$row['English_card_name'].'</td>
                                    <td>'.$row['English_set_name'].'</td>
                                    <td>'.$row['Count_articles'].'</td>
                                    <td>'.$row['Count_foils'].'</td>
                                    <td>'.$row['Min_value'].'</td>
                                    <td>'.$row['Trend_value'].'</td>
                                    <td>'.red_or_green($row['VAR1']).'</td>
                                    <td>'.red_or_green($row['VAR7']).'</td>
                                    <td>'.red_or_green($row['VAR30']).'</td>
                                    <td>'.$row['Foil_low'].'</td>
                                    <td>'.$row['Foil_trend'].'</td>
                                    <td>'.red_or_green($row['FOILVAR1']).'</td>
                                    <td>'.red_or_green($row['FOILVAR7']).'</td>
                                    <td>'.red_or_green($row['FOILVAR30']).'</td>
                                    <!-- <td>'.$row['EXPECTEDMC'].'</td> -->
                                </tr>
                            
                        ';
                    $c += 1;
                }
                echo '
                            </tbody>
                        </table>
                    </div>
                </div>
                ';
                
            }
            else {

            }
    }
}




function red_or_green($stringa) {

    $value = (float) $stringa;
    if ($value == 0) {
        return '<p> / </p>';
    }
    if ($value > 0) {
        return '<p class = "text-success" >' . round($value, 2). '%</p>';
    }
    else {
        return '<p class = "text-danger" >' . round($value, 2). '%</p>';
    }
        
}









































/*
    echo '
    <div class = "row justify-content-center">
        <table>
            <thead>
                <th>#</th>
                <th>Image</th>
                <th>Name</th>
                <th>Min Price</th>
                <th>Trend Price</th>
                <th>24h %</th>
                <th>7d %</th>
                <th>Count Articles</th>
                <th>Count Foils</th>
                <th>Count Wanted</th>
                <th>Expected Market Cap</th>
                <th>Sentimento</th>
            </thead>
        </table>
    </div>
    
    ';
*/