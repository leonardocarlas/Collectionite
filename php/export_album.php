<?php


$file = date("Y-m-d_H-i-s")."".$_POST["id_album"].".txt";
$txt = fopen($file, "w") or die("Unable to open file!");
fwrite($txt, "lorem ipsum");
fclose($txt);
echo $file;
?>