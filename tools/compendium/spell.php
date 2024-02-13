<?php
  //SQL Connect
   $sqlpath = $_SERVER['DOCUMENT_ROOT'];
   $sqlpath .= "/sql-connect.php";
   include_once($sqlpath);

   //Header
   $pgtitle = 'Spells - ';
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
     <div class="pagetitle" id="pgtitle">Spells</div>
   </div>
     <div class="body sidebartext col-xs-12" id="body">
       <div class="table-responsive">
   <table id="allspells" class="table table-condensed table-striped table-responsive dt-responsive" cellspacing="0" width="100%">
           <thead class="thead-dark">
               <tr>
                   <th scope="col">Name</th>
                   <th scope="col">Level</th>
                   <th scope="col">School</th>
                   <th scope="col">Casting Time</th>

                   <th scope="col">Classes</th>
                   <th scope="col">Description</th>

               </tr>
           </thead>
           <tfoot>
               <tr>
                 <th>Name</th>
                 <th>Level</th>
                 <th>School</th>
                 <th>Casting Time</th>

                 <th>Classes</th>
                 <th scope="col">Description</th>
               </tr>
           </tfoot>
           <tbody>
             <?php
               $sqlcompendium = "SELECT * FROM compendium WHERE type LIKE 'spell' AND title NOT LIKE '%*' AND title NOT LIKE '%(Ritual Only)' AND title NOT LIKE '%invocation%'";
               $compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
               while($row = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
               echo ('<tr><td>');
               $entry = $row['title'];
               echo "<a href=\"compendium.php?id=$entry\">";
               echo $entry;
               echo "</a></td>";
               echo ('<td>'.$row['spellLevel'].'</td>');
               echo ('<td>'.$row['spellSchool'].'</td>');
               echo ('<td>'.$row['spellTime'].'</td>');

               echo ('<td>'.$row['spellClasses'].'</td>');
               echo ('<td>'.$row['text'].'</td>');
             }
               ?>

</tbody>
</table>
<script>
$(document).ready(function() {
    // Setup - add a text input to each footer cell


    // DataTable
    var table = $('#allspells').DataTable(

        {

          "columnDefs": [ {
                "targets": [0,1],
                "width": "20px"
            },
            {
                "targets": 2,
                "width": "50px"
            },
            {
                "targets": [3,4,5],
                "width": "auto"
            }]
        }
    );


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
