<?php
// 

// da eseguire query per prendere dati carte dell'album -> id utente passare tramite session
// formatta stringa
$outString = "scrivi qui";

$file = "test.txt";

$content .= $outString.PHP_EOL;


header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-disposition: attachment; filename=S3S.cfg');
header('Content-Length: '.strlen($content));
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Expires: 0');
header('Pragma: public');
echo $content;
exit;

?>