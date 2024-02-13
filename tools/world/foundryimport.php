
<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath); ?>

<!-- Header -->
<?php
$headpath = $_SERVER['DOCUMENT_ROOT'];
$headpath .= "/header.php";
include_once($headpath);

?>
<div class="mainbox col-lg-10 col-xs-12 col-lg-offset-1">
    <div class ="body bodytext">
  <h1 class="pagetitle">Foundry Import</h1>
<div class="col-md-10 col-centered">
<form method="post" action="foundryprocess.php" id="import" enctype="multipart/form-data">
<input class="col-centered" type="file" name="fileToUpload1" id="fileToUpload1" accept="application/JSON">
<input class="col-centered btn btn-primary" form="import" type="submit" value="Submit">
</div>
</div>


<?php
//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath); ?>
