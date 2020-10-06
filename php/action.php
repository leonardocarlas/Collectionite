<?php

    require "dbh.php";

    if(isset($_POST['query'])){

        $input_text = $_POST['query'];
        
        $sql = "SELECT DISTINCT Set_name FROM card WHERE Set_name LIKE '%$input_text%' ";

        $result = $connessione->query($sql);

        if($result->num_rows > 0){

            while($row = $result->fetch_assoc()){
                echo "
                    <a href='#' class='list-group-item list-group-item-action'>". $row['Set_name'] ."</a>
                ";
            }
        }
        else{
            echo "<p class='list-group-item border-1'>No Record with this name </p>";
        }

    }