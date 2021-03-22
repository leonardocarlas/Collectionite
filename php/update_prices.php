<?php
set_time_limit(100000000000000);
$row = 1;

if (($handle = fopen("all_datas.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        echo "<p> $num fields in line $row: <br /></p>\n";
        
        if ($row >= 2){
            $id_carta = $data[0];
            //$avg_sell_price = $data[1];
            $low_price = $data[2];
            $trend_price = $data[3];
            $suggested_price = $data[5];
            $foil_sell = $data[6];
            $foil_low = $data[7];
            $foil_trend = $data[8];
            //$low_price_ex = $data[9];
            $avg1 = $data[10];
            $avg7 = $data[11];
            $avg30 = $data[12];
            $foil_avg1 = $data[13];
            $foil_avg7 = $data[14];
            $foil_avg30 = $data[15];
            
            update_cards_prices($id_carta, $low_price, $trend_price, $suggested_price, $avg1, $avg7, $avg30, $foil_sell, $foil_low, $foil_trend, $foil_avg1, $foil_avg7, $foil_avg30);
        }
        /*
        for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";
        }
        */
        $row++;
        
    }
    fclose($handle);
}



function update_cards_prices($id_carta, $low_price, $trend_price, $suggested_price, $avg1, $avg7, $avg30, $foil_sell, $foil_low, $foil_trend, $foil_avg1, $foil_avg7, $foil_avg30){
    require "dbh.php";
    $sql = "UPDATE cards SET Min_value = '$low_price', Trend_value = '$trend_price', Suggested_price = '$suggested_price', AVG1= '$avg1', AVG7= '$avg7', AVG30= '$avg30', Foil_sell= '$foil_sell', Foil_low= '$foil_low', Foil_trend= '$foil_trend', Foil_avg1= '$foil_avg1', Foil_avg7= '$foil_avg7', Foil_avg30= '$foil_avg30' WHERE Idcard = $id_carta";
    $stmt = mysqli_stmt_init($connessione);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "Error updating record: " . mysqli_error($connessione);
    }else{
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

    }
}