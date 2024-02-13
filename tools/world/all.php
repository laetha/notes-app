<?php
  //SQL Connect
   $sqlpath = $_SERVER['DOCUMENT_ROOT'];
   $sqlpath .= "/sql-connect.php";
   include_once($sqlpath);

   //Header
   $pgtitle = 'All - ';
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
  <script>
  $(function () {
  $('[data-toggle="popover"]').popover()
})</script>
   <div class="mainbox col-lg-10 col-xs-12 col-lg-offset-1">

     <!-- Page Header -->
     <div class="col-md-12">
     <div class="pagetitle" id="pgtitle">All</div>


   </div>
     <div class="body sidebartext col-xs-12" id="body">
       <div class="table-responsive">
   <table id="npcs" class="table table-condensed table-striped table-responsive dt-responsive" cellspacing="0" width="100%">
           <thead class="thead-dark">
               <tr>
                   <th scope="col">Name</th>
                <!--   <th scope="col">Location</th> -->
                   <th scope="col">Text</th>

                   <th scope="col">Image</th>
              <!--     <th scope="col">Created</th>
                   <th scope="col">Edited</th> -->


               </tr>
           </thead>
           <tfoot>
             <tr>
               <th scope="col">Name</th>
              <!-- <th scope="col">Location</th> -->
               <th scope="col">Text</th>

               <th scope="col">Image</th>
             <!--  <th scope="col">Created</th>
               <th scope="col">Edited</th> -->

             </tr>
           </tfoot>
           <tbody>
             <?php
               $sqlcompendium = "SELECT * FROM world WHERE worlduser LIKE '$loguser'";
               $compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
               while($row = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
               echo ('<tr><td>');
               $entry = $row['title'];
               $type = $row['type'];
               $jpgurl = 'uploads/'.$row['title'].'.jpg';
               $pngurl = 'uploads/'.$row['title'].'.png';
               echo ('<a onclick="worldModal(\''.$entry.'\')" data-toggle="modal" data-target="#myModal">'.$entry.' :: '.$row['npc_title'].$row['est_type']);
               if (($type != 'npc') && ($type != 'establishment')){
                echo $row['type'];
               }
               echo ('</a></td>');
               /* echo ('<td>'.$row['npc_location'].$row['est_location'].'</td>');*/
               echo ('<td>'.$row['body'].'</td>');

               
               if (file_exists($jpgurl)){
                 echo ('<td><img class="tableimg" src="'.$jpgurl.'"></td>');
               }
               else if (file_exists($pngurl)){
                 echo ('<td><img class="tableimg" src="'.$pngurl.'"></td>');
               }
               else {
                 echo ('<td></td>');
               }
             /*  echo ('<td>'.$row['created'].'</td>');
               echo ('<td>'.$row['edited'].'</td>');*/

               echo ('</tr>');
             }
               ?>

</tbody>
</table>
<script>
function worldModal(value){
  var newURL = '<div class="col-md-12"><iframe width="100%" height="600" src="world.php?id=' + value + '" /></div>';
  $('#worldmodal').html(newURL);
}
</script>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style="background-color: rgb(45, 45, 45);">
        <div class="modal-body" id="worldmodal">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

<script>
$(document).ready(function() {
    // Setup - add a text input to each footer cell
    var x = 1;
    $('#npcs tfoot th').each( function () {
        var title = $(this).text();
        if (x <= 2){
        $(this).html( '<input type="text" class="form-control" placeholder="Search '+title+'" />' );
        }
        else {

        }
        x++;
       
    } );

    // DataTable
    var table = $('#npcs').DataTable(
      {
    "order": [[ 0, "desc" ]],
    "columnDefs": [
  { "width": "15%", "targets": 0 },
  { "width": "70%", "targets": 1 },
  { "width": "15%", "targets": 2 }
  //{ "width": "5%", "targets": 3 },
  //{ "width": "5%", "targets": 4 }

]
  }
    );

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
