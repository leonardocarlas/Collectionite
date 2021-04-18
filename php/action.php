
<?php

require "dbh.php";
session_start();
$idcollection = $_SESSION['idcollezione'];

//INNER JOIN expansion ON cards.Idset = expansion.Idset 

if (isset($_POST['testo_cercato'])) {

    $testo_cercato = mysqli_real_escape_string($connessione, $_POST['testo_cercato']);

    $sql = "SELECT DISTINCT English_card_name, cards.Idset, Idcard, Image_link, expansion.English_set_name
    FROM cards
    INNER JOIN expansion ON cards.Idset = expansion.Idset 
    WHERE English_card_name LIKE '%$testo_cercato%'  AND expansion.Idcollection = '$idcollection' LIMIT 70";

    $stmt = mysqli_stmt_init($connessione);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "Error in the database";
    }
    else{
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt); 
        
        
        $output = '<table>';
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                if ( str_contains($row['English_card_name'], "Online")  == true ) {
                    continue;
                }
                else {
                    $output .=   '<tr>
                                        <td style="padding:0 15px 0 15px;" ><img src="'.$row['Image_link'] .'" width = "30" height = "35" ></td>
                                        <td style="padding:0 15px 0 15px;">' . $row['English_card_name'] .' </td> 
                                        <td style="padding:0 15px 0 15px;"> <img src = "immagini/'.$row['Idset'].'.png"> </td> 
                                        <td style="padding:0 15px 0 15px;">'. $row['English_set_name'].' </td> 
                                        <td style="padding:0 15px 0 15px;"> <button class="btn text-white" style="background-color: #5401a7;" onclick="insert_card('.$row['Idcard'] .')" >Aggiungi Carta</button> </td>
                                 </tr> ';   
                }
            }
            
        }
        else{
            $output .= '<ul><li>Carta non nel Database</li></ul>';
        }
        $output .= '</table>';
        
        echo $output;


    }    
    mysqli_stmt_close($stmt);
    mysqli_close($connessione);
}


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
    
    $sql = "SELECT DISTINCT English_card_name, cards.Idset, Idcard, Image_link, expansion.English_set_name
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
        
        
        $output = '<table>';
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                if ( str_contains($row['English_card_name'], "Online")  == true ) {
                    continue;
                }
                else {
                    $output .=   '<tr>
                                    <td style="padding:0 15px 0 15px;"><img src="'.$row['Image_link'] .'" width = "30" height = "35" ></td>
                                    <td style="padding:0 15px 0 15px;">' . $row['English_card_name'] .' </td> 
                                    <td style="padding:0 15px 0 15px;"> <img src = "immagini/'.$row['Idset'].'.png"> </td> <td>'. $row['English_set_name'].' </td> 
                                    <td style="padding:0 15px 0 15px;"> <button class="btn text-white" style="background-color: #5401a7;" onclick="insert_card('.$row['Idcard'] .')" >Aggiungi Carta</button> </td> 
                                    </tr> ';   
                }
            }
            
        }
        else{
            $output .= '<ul><li>Carta non nel Database</li></ul>';
        }
        $output .= '</table>';
        
        echo $output;


    }    
    mysqli_stmt_close($stmt);
    mysqli_close($connessione);

}


function str_contains(string $haystack, string $needle): bool {

    return '' === $needle || false !== strpos($haystack, $needle);

}


?>



<script type ="text/javascript">

    function insert_card(id_card){
        $.post("php/CRUD_card.php",{"insert_id_card":id_card},function(data){
                if(data.trim() == "success")
                {
                    Swal.fire({
                        icon: 'success',
                        title: 'Carta inserita',
                        });
                }
            });
    }

</script>





<?php

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

