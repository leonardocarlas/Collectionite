
<?php

require "dbh.php";
session_start();
$idcollection = $_SESSION['idcollezione'];


if(isset($_POST['query_set'])){

    $input_text =  mysqli_real_escape_string($connessione, $_POST['query_set']);
    
    $sql = "SELECT DISTINCT Set_name FROM card WHERE Set_name LIKE '%$input_text%' AND idCollection = ? ";
    $stmt = mysqli_stmt_init($connessione);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "Error in the database";
    }
    else{
        mysqli_stmt_bind_param($stmt, "i", $idcollection);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt); 
        
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
    mysqli_stmt_close($stmt);
    mysqli_close($connessione);

}

if(isset($_POST['query_card'])){

    $input_text =  mysqli_real_escape_string($connessione, $_POST['query_card']);
    
    $sql = "SELECT DISTINCT Card_name FROM card WHERE Card_name LIKE '%$input_text%' AND idCollection= ? ";
    $stmt = mysqli_stmt_init($connessione);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "Error in the database";
    }
    else{
        mysqli_stmt_bind_param($stmt, "i" , $idcollection);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt); 
        
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
    mysqli_stmt_close($stmt);
    mysqli_close($connessione);


}

if(isset($_POST['query_card_set'])){

    require "dbh.php";

    $input_text =  mysqli_real_escape_string($connessione, $_POST['query_card_set']);
    
    $sql = "SELECT DISTINCT English_card_name, cards.Idset, Idcard, Image_link 
    FROM cards
    INNER JOIN expansion ON cards.Idset = expansion.Idset 
    WHERE Italian_card_name LIKE '%$input_text%'  AND expansion.Idcollection = '$idcollection' LIMIT 10";

    $stmt = mysqli_stmt_init($connessione);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "Error in the database";
    }
    else{
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt); 
        
        $output = '<ul class="list-unstyled"';
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $output .=   '<a><li>' . $row['English_card_name'] .'   '. $row['Idset'].'   '.'BAMBA'.'   '.'<a class="btn text-white" style="background-color: #5401a7;" href="" >Aggiungi Carta</a>' .'</li></a>';   
            }
        }
        else{
            $output .= '<li>Carta non nel Database</li>';
        }
        $output .= '</ul>';
        echo $output;


    }    
    mysqli_stmt_close($stmt);
    mysqli_close($connessione);

}






/*
require "dbh.php";

if(isset($_SESSION['idcollezione'])){
    $idcollection = $_SESSION['idcollezione'];
}


if(isset($_POST['query_set'])){

    $input_text = mysqli_real_escape_string($connessione, $_POST['query_set']);
    
    $sql = "SELECT DISTINCT Set_name FROM card WHERE Set_name LIKE '%$input_text%'  ";

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

    $input_text = mysqli_real_escape_string($connessione, $_POST['query_card']);
    
    $sql = "SELECT DISTINCT Card_name FROM card WHERE Card_name LIKE '%$input_text%'  ";

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

*/

