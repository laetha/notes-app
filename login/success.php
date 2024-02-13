<?php
  //SQL Connect
   $sqlpath = $_SERVER['DOCUMENT_ROOT'];
   $sqlpath .= "/sql-connect.php";
   include_once($sqlpath);

   //Header
   $pgtitle = 'Campaign Log - ';
   $headpath = $_SERVER['DOCUMENT_ROOT'];
   $headpath .= "/header.php";
   include_once($headpath);
?>


<div class="mainbox col-lg-10 col-xs-12 col-lg-offset-1">
  <div class ="body bodytext">
    <h1 class="pagetitle">Login Successful</h1>

			</div>
    </div>
      <?php
      //Footer
      $footpath = $_SERVER['DOCUMENT_ROOT'];
      $footpath .= "/footer.php";
      include_once($footpath);
      ?>
