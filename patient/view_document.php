<?php
if(isset($_GET)){
    if($_GET['var']==1)
    $file="uploads/identity_documents/".$_GET['value'];
else if($_GET['var']==2)
    $file="uploads/medical_documents/".$_GET['value'];
header('Content-type: application/pdf');
header('Content-Disposition: inline; filename:"' .$file1. '"');
header('Content-Transfer-Encoding: binary');
header('Accept-Ranges: bytes');
@readfile($file);
}
?>
