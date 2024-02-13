<?php
$headpath = $_SERVER['DOCUMENT_ROOT'];
$headpath .= "/header.php";
include_once($headpath);
if ($loguser !== 'tarfuin') {
echo ('<script>window.location.replace("/oops.php"); </script>');
}
?>
<div class="mainbox col-lg-10 col-xs-12 col-lg-offset-1">
<!-- Page Header -->
<div class="col-md-12">
<div class="pagetitle" id="pgtitle">World Map</div>
</div>
<div class="body sidebartext col-xs-12" id="body">

<iframe width="100%" height="500px" src="mapimg.php"></iframe>
</div>

     <?php
     //Footer
     $footpath = $_SERVER['DOCUMENT_ROOT'];
     $footpath .= "/footer.php";
     include_once($footpath);
      ?>
