<?php
// 

// da eseguire query per prendere dati carte dell'album -> id utente passare tramite session
// formatta stringa
$outString = "scrivi qui";

$file = "test.txt";
$txt = fopen($file, "w") or die("Unable to open file!");
fwrite($txt, $outString);
fclose($txt);

header('Content-Description: File Transfer');
header('Content-Disposition: attachment; filename='.basename($file));
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($file));
header("Content-Type: text/plain");
readfile($file);

?>