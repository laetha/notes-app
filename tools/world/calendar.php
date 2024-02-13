<?php
  //SQL Connect
   $sqlpath = $_SERVER['DOCUMENT_ROOT'];
   $sqlpath .= "/sql-connect.php";
   include_once($sqlpath);
   $pgtitle = $_GET['id'].' - ';
   if(empty($_GET['id'])) {
     $pgtitle = 'Calendar - ';
   }
   $pgtitle = 'Calendar - ';
   //Header
   $headpath = $_SERVER['DOCUMENT_ROOT'];
   $headpath .= "/header.php";
   include_once($headpath);
   if ($loguser !== 'tarfuin') {
   echo ('<script>window.location.replace("/oops.php"); </script>');
   }
?>
<div class="mainbox">

<img src="/assets/images/calendar.png" style="width:95%; max-width: 1000px; margin-top: 20px;"/>
</div>
<?php
//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath);
?>
