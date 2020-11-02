<?php
    session_start();

    if(isset($_POST['change-collection'])){

        $col_selected = false;
        $_SESSION['collezione-selezionata'] = $col_selected;
        $_SESSION['reload-album'] = false;

        header("Location: ../home.php");
        exit();


    }