<?php
if(isset($_GET)){
$file="uploads/identity_documents/".$_GET['value'];
header('Content-type: application/pdf');
header('Content-Disposition: inline; filename:"'.$file.'"');
header('Content-Transfer-Encoding: binary');
header('Accept-Ranges: bytes');
@readfile($file);
}
?>
