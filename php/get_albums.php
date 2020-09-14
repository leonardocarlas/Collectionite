<?php
    session_start();
    //require 'dbh.php';
    $ricarica = $_SESSION['reload-album'];
    //prende l'username
    if(isset($_SESSION['usernamesession'])){
        $user=$_SESSION['usernamesession'];
    }


///////////////     Connessione al database       ////////////

////////////    Get Albums related to a Username from the database   ////////////


if(isset($_POST['selected-collection']))
{
    
    //prende il tipo di collezione
    $name_collection=$_POST['collection-type'];
    //ci associa l'id
    $idcollection=0;
    if($name_collection == "Pokemon"){
        $idcollection=6;
    }
    else if($name_collection == "Yu-gi-oh!"){
        $idcollection=3;
    }
    else if($name_collection == "Magic: The Gathering"){
        $idcollection=1;
    }
    else if($name_collection == "Vanguard"){
        $idcollection=8;
    }
    else if($name_collection == "Force of Will"){
        $idcollection=7;
    }
    else if($name_collection == "World of Warcraft TCG"){
        $idcollection=2;
    }
    else if($name_collection == "Star Wars: Destiny"){
        $idcollection=15;
    }
    else if($name_collection == "Dragoborne"){
        $idcollection=11;
    }
    else if($name_collection == "My Little Pony CCG"){
        $idcollection=12;
    }
    else if($name_collection == "Dragon Ball Cardgame"){
        $idcollection=13;
    }
    else if($name_collection == "WeiB Swharz"){
        $idcollection=10;
    }
    else if($name_collection == "The Spoils"){
        $idcollection=15;
    }
    else if($name_collection == "Final Fantasy TCG"){
        $idcollection=9;
    }


    if($idcollection == 0 ){
        header("Location: ../home.php?error=nocolletionsel");
        exit();
    }

    $_SESSION['idcollezione'] = $idcollection;
    $_SESSION['collezione-selezionata']=true;
    $_SESSION['namecollection'] = $name_collection;
 

    header("Location: ../home.php?COLLEZIONE=".$idcollection);
    exit();
    
        
        
}elseif(isset($_GET['MODIFIED'])){
    header("Location: home.php?MODIFIED=SUCCESS");
    exit();
}elseif(isset($_GET['DELETED'])){
    header("Location: home.php?DELETED=CORRECTLY");
    exit();
}elseif(isset($_GET['DELETED'])){
    header("Location: home.php?Insert=SUCCESS");
    exit();
}
else {
        header("Location: ../home.php?ERRORENELFILE");
        exit();

}








////////    RICARICA DELLE PAGINE    //////////

/*

 if($ricarica == true ){

    $idcollection = $_SESSION['idcollezione'] ;

    $sql = "SELECT Nome, IDAlbum FROM album WHERE Username='$user' AND IdCollection='$idcollection' ; ";
    $result = mysqli_query($connessione, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $row = mysqli_fetch_assoc($result);
       
        
        $nomi = array();
       

        while($row = $result->fetch_assoc()) {
            $nomi[] = $row["Nome"] ;
            $nomi[] = $row["IDAlbum"];
        }
        
        
        $_SESSION['album_risultati'] = $nomi;
        $_SESSION['reload-album'] =  false ;

        header("Location: ../home.php?ALBUM=RICARICATI");
        exit();

}
}



   
    
mysqli_close($connessione);
*/