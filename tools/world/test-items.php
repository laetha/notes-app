<?php
  //SQL Connect
   $sqlpath = $_SERVER['DOCUMENT_ROOT'];
   $sqlpath .= "/sql-connect.php";
   include_once($sqlpath);

   //Header
   $headpath = $_SERVER['DOCUMENT_ROOT'];
   $headpath .= "/header.php";
   include_once($headpath);
?>
   <div class="mainbox col-md-12">

     <!-- Page Header -->
     <div class="col-md-12">
     <div class="pagetitle" id="pgtitle">Items
   </div>
   </div>
     <div class="body bodytext col-xs-12" id="body">
       <!-- Body Text -->
         <?php
           $itemtitle = "SELECT * FROM `items`";
           $itemdata = mysqli_query($dbcon, $itemtitle) or die('error getting data');
           while($itemrow =  mysqli_fetch_array($itemdata, MYSQLI_ASSOC)) {
             echo ('<div class="row">');
             echo ('<div class="col-md-1">'.nl2br($itemrow['name']).'</div>');
             echo ('<div class="col-md-1">'.nl2br($itemrow['type']).'</div>');
             echo ('<div class="col-md-10">'.nl2br($itemrow['text']).'</div>');
             echo ('</div>');
             echo ('<p></p>');
           }
         ?>
       </table>
         </div>


   </div>
<?php

//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath);
?>
