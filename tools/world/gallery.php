<?php
  //SQL Connect
   $sqlpath = $_SERVER['DOCUMENT_ROOT'];
   $sqlpath .= "/sql-connect.php";
   include_once($sqlpath);

   //Header
   $pgtitle = 'World Gallery - ';
   $headpath = $_SERVER['DOCUMENT_ROOT'];
   $headpath .= "/header.php";
   include_once($headpath);
   if ($loguser !== 'tarfuin') {
   echo ('<script>window.location.replace("/oops.php"); </script>');
   }
   ?>
   <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>
   <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
   <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js" type="text/javascript"></script>
   <script src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap.min.js" type="text/javascript"></script>
   <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap.min.css">
   <div class="mainbox col-lg-10 col-xs-12 col-lg-offset-1">

     <!-- Page Header -->
     <div class="col-md-12">
     <div class="pagetitle" id="pgtitle">World Gallery</div>
   </div>
<div class="col-md-12 grid col-centered">
<?php


   $typeedit = "SELECT * FROM `world`";
   $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
   while($row =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
     $stripid = str_replace("'", "", $row['title']);
     $stripid = stripslashes($stripid);
     $jpgurl = 'uploads/'.$stripid.'.jpg';
     $pngurl = 'uploads/'.$stripid.'.png';

     if (file_exists($jpgurl)){
       echo ('<a href="world.php?id='.$row['title'].'"><div class="grid-item imgbox">');
       echo ('<img src="uploads/'.$stripid.'.jpg" />');
       echo ('<div class="overlay">');
       echo ('<div class="imgtext">'.$row['title']);
       if ($row['type'] = 'npc') {
         echo ('<p>--------</p>');
         echo ('<p>'.$row['npc_est'].'</p>');
         echo ('<p>--------</p>');
         echo ('<p>'.$row['npc_location'].'</p>');
       }
       echo ('</div></div></div></a>');
     }

     else if (file_exists($pngurl)){

       echo ('<div class="grid-item imgbox">');
       echo ('<img src="uploads/'.$stripid.'.png" />');
       echo ('<div class="overlay">');
       echo ('<div class="imgtext">'.$row['title']);
       if ($row['type'] = 'npc') {
         echo ('<p>'.$row['npc_est'].'</p>');
         echo ('<p>'.$row['npc_location'].'</p>');
       }

       echo ('</div></div></div>');
     }
     else {

     }
   }
?>
</div>

<script>
$('.grid').masonry({
  // options
  itemSelector: '.grid-item',
  columnWidth: 200
});
</script>

</div>
   <?php
   //Footer
   $footpath = $_SERVER['DOCUMENT_ROOT'];
   $footpath .= "/footer.php";
   include_once($footpath);
    ?>
