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
   <script src="/plugins/isotope.pkgd.min.js"></script>

   <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap.min.css">
   <div class="mainbox col-lg-10 col-xs-12 col-lg-offset-1">

     <!-- Page Header -->
     <div class="col-md-12">
     <div class="pagetitle" id="pgtitle">World Gallery</div>
   </div>
   <p><input type="text" class="quicksearch" placeholder="Search" /></p>
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
       echo ('<div class="grid-item imgbox">');
       echo ('<img src="uploads/'.$stripid.'.jpg" />');
       echo ('<div class="overlay">');
       echo ('<div class="imgtext">'.$row['title']);
    /*   if ($row['type'] = 'npc') {
         echo ('<p>'.$row['npc_est'].'</p>');
         echo ('<p>'.$row['npc_location'].'</p>');
       }*/

       echo ('</div></div></div>');
     }

     else if (file_exists($pngurl)){

       echo ('<div class="grid-item imgbox">');
       echo ('<img src="uploads/'.$stripid.'.png" />');
       echo ('<div class="overlay">');
       echo ('<div class="imgtext">'.$row['title']);
    /*   if ($row['type'] = 'npc') {
         echo ('<p>'.$row['npc_est'].'</p>');
         echo ('<p>'.$row['npc_location'].'</p>');
       }*/

       echo ('</div></div></div>');
     }
     else {

     }
   }
?>
</div>

<script>
/*$('.grid').masonry({
  // options
  itemSelector: '.grid-item',
  columnWidth: 200
});*/

// quick search regex
var qsRegex;

// init Isotope
var $grid = $('.grid').isotope({
  itemSelector: '.grid-item',
  layoutMode: 'fitRows',
  filter: function() {
    return qsRegex ? $(this).text().match( qsRegex ) : true;
  }
});

// use value of search field to filter
var $quicksearch = $('.quicksearch').keyup( debounce( function() {
  qsRegex = new RegExp( $quicksearch.val(), 'gi' );
  $grid.isotope();
}, 200 ) );

// debounce so filtering doesn't happen every millisecond
function debounce( fn, threshold ) {
  var timeout;
  threshold = threshold || 100;
  return function debounced() {
    clearTimeout( timeout );
    var args = arguments;
    var _this = this;
    function delayed() {
      fn.apply( _this, args );
    }
    timeout = setTimeout( delayed, threshold );
  };
}

</script>
</div>
   <?php
   //Footer
   $footpath = $_SERVER['DOCUMENT_ROOT'];
   $footpath .= "/footer.php";
   include_once($footpath);
    ?>
