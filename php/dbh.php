<?php

$servername=  	"localhost";
$dbUsername=  'root';
$passdb= '';
$dbname= "userdragon";

///////////////     Connessione al database       ////////////
////variabili:

//connessione al database
$connessione= mysqli_connect($servername, $dbUsername, $passdb, $dbname)
or die("impossibile connettersi al server".mysqli_connect_error());
