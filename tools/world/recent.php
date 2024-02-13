<?php
  //SQL Connect
   $sqlpath = $_SERVER['DOCUMENT_ROOT'];
   $sqlpath .= "/sql-connect.php";
   include_once($sqlpath);

   //Header
   $pgtitle = 'Recent - ';
   $headpath = $_SERVER['DOCUMENT_ROOT'];
   $headpath .= "/header.php";
   include_once($headpath);
   /*if ($loguser !== 'tarfuin') {
   echo ('<script>window.location.replace("/oops.php"); </script>');
 }*/
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
     <div class="pagetitle" id="pgtitle">Recent</div>
   </div>
     <div class="body sidebartext col-xs-12" id="body">
      <?php
      $worldtitle = "SELECT * FROM world ORDER BY created DESC";
      $titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
      $i = 1;
      echo ('<div class="row">');
      while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
        if ($i % 3 == 0 ){
          echo ('<div class="row">');
        }
        else {
          echo ('<div>');
        }
        $jpgurl = 'uploads/'.$row['title'].'.jpg';
        $pngurl = 'uploads/'.$row['title'].'.png';
        ?>
        <div class="card col-md-4" style="border-style:solid; height:450px;">
        <?php if (file_exists($jpgurl)){
                 echo ('<img class="card-img-top" style="width:100%; max-height:70%;" src="'.$jpgurl.'">');
               }
               else if (file_exists($pngurl)){
                 echo ('<img class="card-img-top" style="width:100%; max-height:70%;" src="'.$pngurl.'">');
               }
               else {
                 echo ('');
               } ?>
  <div class="card-body">
    <h5 class="card-title"><?php echo $row['title']; ?></h5>
    <p class="card-text"></p>
  </div>
</div>
        <?php
        echo ('</div>');
        $i++;
      }

      ?>
</div>
</div>
   <?php
   //Footer
   $footpath = $_SERVER['DOCUMENT_ROOT'];
   $footpath .= "/footer.php";
   include_once($footpath);
    ?>
