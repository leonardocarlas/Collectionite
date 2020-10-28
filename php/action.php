
<?php

require "dbh.php";

if(isset($_SESSION['idcollezione'])){
    $idcollection = $_SESSION['idcollezione'];
}


if(isset($_POST['query_set'])){

    $input_text = $_POST['query_set'];
    
    $sql = "SELECT DISTINCT Set_name FROM card WHERE Set_name LIKE '%$input_text%' AND idCollection='$idcollection' ";

    $result = $connessione->query($sql);

    $output = '<ul class="list-unstyled"';

    if($result->num_rows > 0){

        while($row = $result->fetch_assoc()){
    
            $output .=   '<a><li>' . $row['Set_name'] .'</li></a>';
            
        }
    }
    else{
        $output .= '<li>Set Not Found</li>';
    }

    $output .= '</ul>';
    echo $output;

}

if(isset($_POST['query_card'])){

    $input_text = $_POST['query_card'];
    
    $sql = "SELECT DISTINCT Card_name FROM card WHERE Card_name LIKE '%$input_text%' AND idCollection='$idcollection' ";

    $result = $connessione->query($sql);

    $output = '<ul class="list-unstyled"';

    if($result->num_rows > 0){

        while($row = $result->fetch_assoc()){
    
            $output .=   '<a><li>' . $row['Card_name'] .'</li></a>';
            
        }
    }
    else{
        $output .= '<li>Card Not Found</li>';
    }

    $output .= '</ul>';
    echo $output;

}

