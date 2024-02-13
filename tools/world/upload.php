<?php

   //Header
   $headpath = $_SERVER['DOCUMENT_ROOT'];
   $headpath .= "/header.php";
   include_once($headpath);
?>
<script src="/plugins/dropzone-master/dist/dropzone.js"></script>
<link href="/plugins/dropzone-master/dropzone.css" type="text/css" rel="stylesheet" />
<div class="col-centered">
<form action="upload.php" class="dropzone"></form>
</div>
<?php
$ds          = DIRECTORY_SEPARATOR;  //1

$storeFolder = '/tools/world/uploads';   //2

if (!empty($_FILES)) {

    $tempFile = $_FILES['file']['tmp_name'];          //3

    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4

    $targetFile =  $targetPath. $_FILES['file']['name'];  //5

    move_uploaded_file($tempFile,$targetFile); //6

}




//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath);
?>
