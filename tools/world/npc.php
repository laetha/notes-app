<?php
  //SQL Connect
   $sqlpath = $_SERVER['DOCUMENT_ROOT'];
   $sqlpath .= "/sql-connect.php";
   include_once($sqlpath);

   //Header
   $pgtitle = 'NPCs - ';
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
     <div class="pagetitle" id="pgtitle">NPCs</div>
   </div>
     <div class="body sidebartext col-xs-12" id="body">
       <div class="table-responsive">
   <table id="npcs" class="table table-condensed table-striped table-responsive dt-responsive" cellspacing="0" width="100%">
           <thead class="thead-dark">
               <tr>
                   <th scope="col">Name</th>

                   <th scope="col">Title</th>

                   <th scope="col">Establishment</th>

                   <th scope="col">Location</th>

                   <th scope="col">Faction</th>

                   <th scope="col">Image</th>

               </tr>
           </thead>
           <tfoot>
             <tr>
               <th scope="col">Name</th>

               <th scope="col">Title</th>

               <th scope="col">Establishment</th>

               <th scope="col">Location</th>

               <th scope="col">Faction</th>

               <th scope="col">Image</th>

             </tr>
           </tfoot>
           <tbody>
             <?php
               $sqlcompendium = "SELECT * FROM world WHERE type LIKE 'npc' AND worlduser LIKE '$loguser'";
               $compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
               while($row = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
               echo ('<tr><td>');
               $entry = $row['title'];
               $entryest = $row['npc_est'];
               $entryloc = $row['npc_location'];
               $entryfac = $row['npc_faction'];
               $jpgurl = 'uploads/'.$row['title'].'.jpg';
               $pngurl = 'uploads/'.$row['title'].'.png';
               $webpurl = 'uploads/'.$row['title'].'.webp';
               echo "<a href=\"world.php?id=$entry\">";
               echo $entry;
               echo "</a></td>";
               echo ('<td>'.$row['npc_title'].'</td>');
               echo "<td><a href=\"world.php?id=$entryest\">".$entryest."</a></td>";
               echo "<td><a href=\"world.php?id=$entryloc\">".$entryloc."</a></td>";
               echo "<td><a href=\"world.php?id=$entryfac\">".$entryfac."</a></td>";
               if (file_exists($jpgurl)){
                 echo ('<td><img class="tableimg" src="'.$jpgurl.'"></td>');
               }
               else if (file_exists($pngurl)){
                 echo ('<td><img class="tableimg" src="'.$pngurl.'"></td>');
               }
               else if (file_exists($webpurl)){
                echo ('<td><img class="tableimg" src="'.$webpurl.'"></td>');
              }
               else {
                 echo ('<td></td>');
               }
               echo "</tr>";

             }
               ?>

</tbody>
</table>
<script>
$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#npcs tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" class="form-control" placeholder="Search '+title+'" />' );
    } );

    // DataTable
    var table = $('#npcs').DataTable();

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
