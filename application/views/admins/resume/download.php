<?php
header("Cache-Control: public");
header("Content-Description: File Transfer");
// header("Content-Length: ". fil.";");
header("Content-Disposition: attachment; filename=resume-" . $nim . ".txt");
header("Content-Type: application/octet-stream; "); 
header("Content-Transfer-Encoding: binary");

?>
<? echo $resume[0]->konten ?>