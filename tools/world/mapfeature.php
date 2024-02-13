<?php
  //SQL Connect
   $sqlpath = $_SERVER['DOCUMENT_ROOT'];
   $sqlpath .= "/sql-connect.php";
   include_once($sqlpath);

   //Header
   $pgtitle = 'Map Features - ';
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
     <div class="pagetitle" id="pgtitle">Map Features</div>
     <div class="sidebartext" id="test"></div>
   </div>
     <div class="body sidebartext col-xs-12" id="body">
       <div class="table-responsive">
   <table id="establishment" class="table table-condensed table-striped table-responsive dt-responsive" cellspacing="0" width="100%">
           <thead class="thead-dark">
               <tr>
                   <th scope="col">Coord</th>
                   <th scope="col">Text</th>
                   <th scope="col">Edit</th>

               </tr>
           </thead>
           <tfoot>
               <tr>
               <th scope="col">Coord</th>
               <th scope="col">Text</th>
               <th scope="col">Edit</th>
              </tr>
            </tfoot>
          <tbody>
             <?php
               $sqlcompendium = "SELECT * FROM mapfeatures WHERE active=1";
               $compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
               while($row = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
                echo ('<tr>');
                echo ('<td>'.$row['coord'].'</td>');
                echo ('<td>'.$row['text'].'</td>');
                echo ('<td><a href="mapedit.php?id='.$row['id'].'"><button class="btn btn-success">Edit</button></a></td>');


             }
               ?>

</tbody>
</table>
<script>
$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#establishment tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" class="form-control" placeholder="Search '+title+'" />' );
    } );

    // DataTable
    var table = $('#establishment').DataTable();

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

/*function editmap(value){
  var mapId = value;
  $('#test').html(value);
}*/
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
