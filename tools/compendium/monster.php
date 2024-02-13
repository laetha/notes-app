<?php
  //SQL Connect
   $sqlpath = $_SERVER['DOCUMENT_ROOT'];
   $sqlpath .= "/sql-connect.php";
   include_once($sqlpath);

   //Header
   $pgtitle = 'Monsters - ';
   $headpath = $_SERVER['DOCUMENT_ROOT'];
   $headpath .= "/header.php";
   include_once($headpath);
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
     <div class="pagetitle" id="pgtitle">Monsters</div>
   </div>
     <div class="body sidebartext col-xs-12" id="body">
       <div class="table-responsive">
   <table id="allspells" class="table table-condensed table-striped table-responsive dt-responsive" cellspacing="0" width="100%">
           <thead class="thead-dark">
               <tr>
                   <th scope="col">Name</th>
                   <th scope="col">Image</th>
                   <th scope="col">Size</th>
                   <th scope="col">Type</th>
                   <th scope="col">CR</th>
                   <th scope="col">Source</th>
               </tr>
           </thead>
           <tfoot>
               <tr>
                 <th scope="col">Name</th>
                 <th scope="col">Image</th>
                 <th scope="col">Size</th>
                 <th scope="col">Type</th>
                 <th scope="col">CR</th>
                 <th scope="col">Source</th>
               </tr>
           </tfoot>
           <tbody>
             <?php
               $sqlcompendium = "SELECT * FROM compendium WHERE type LIKE 'monster'";
               $compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
               while($row = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
                 $jpgurl = 'bestiary/'.$row['title'].'.jpg';
                 $jpgurl = str_replace("JPG","jpg", $jpgurl);
                 $jpegurl = 'bestiary/'.$row['title'].'.jpeg';
                 $pngurl = 'bestiary/'.$row['title'].'.png';
                 $genurl = 'bestiary/'.$row['monsterType'].'.png';
               echo ('<tr><td>');
               $entry = $row['title'];
               echo "<a href=\"compendium.php?id=$entry\">";
               echo $entry;
               echo "</a></td>";
               if (file_exists($jpgurl)){
                 echo ('<td><img class="tableimg" src="'.$jpgurl.'"></td>');
               }
               else if (file_exists($pngurl)){
                 echo ('<td><img class="tableimg" src="'.$pngurl.'"></td>');
               }
               else if (file_exists($jpegurl)){
                echo ('<td><img class="tableimg" src="'.$jpegurl.'"></td>');
              }
               else {
                 echo ('<td><img class="tableimg" src="'.$genurl.'"></td>');
               }
               echo ('<td>'.$row['monsterSize'].'</td>');
               echo ('<td>'.$row['monsterType'].'</td>');
               if($row['monsterCr'] ==0.125){
                 echo ('<td>0.125</td>');

               }
               elseif($row['monsterCr'] ==0.25){
                 echo ('<td>0.25</td>');

               }
               elseif($row['monsterCr'] ==0.5){
                 echo ('<td>0.5</td>');

               }
               else{
               echo ('<td>'.number_format((float)$row['monsterCr'], 0, '.', '').'</td>');
             }
             echo ('<td>'.$row['monsterTrait1'].'</td>');
             echo ('</tr>');

             }
               ?>

</tbody>
</table>
<script>
$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#allspells tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" class="form-control" placeholder="Search '+title+'" />' );
    } );

    // DataTable
    var table = $('#allspells').DataTable();

    // Apply the search
    table.columns().every( function () {
        var that = this;

        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
} );
</script>
</div>
</div>
</div>
   <?php
   //Footer
   $footpath = $_SERVER['DOCUMENT_ROOT'];
   $footpath .= "/footer.php";
   include_once($footpath);
    ?>
