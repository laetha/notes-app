<?php
  //SQL Connect
   $sqlpath = $_SERVER['DOCUMENT_ROOT'];
   $sqlpath .= "/sql-connect.php";
   include_once($sqlpath);

   //Header
   $pgtitle = 'Generator - ';
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

     <div class="sidebartext">
       <table id="generator" class="table table-condensed table-striped table-responsive dt-responsive" cellspacing="0" width="100%">
               <thead class="thead-dark">
                   <tr>
                       <th scope="col">Type</th>
                       <th scope="col">Text</th>
                       <th scope="col">Text2</th>
                   </tr>

               </thead>
               <tfoot>
                 <tr>
                     <th scope="col">Type</th>
                     <th scope="col">Text</th>
                     <th scope="col">Text2</th>
                 </tr>
               </tfoot>
               <tbody>
    <?php
    for ($i = 0; $i < 20; $i++) {
    $rand1 = rand(0,99);
    $type = '';
    $text1 = '';
    $text2 = '';
    $foundOverall = 0;
    $found2 = 0;

    ?>
     <?php
     $foundmon = 0;
     $typeedit = "SELECT * FROM `encounters` ORDER BY num";
     $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
     while($row =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
       if ($rand1 <= $row['num'] && $foundOverall == 0 && $row['type'] == 'overall') {
          echo ('<tr><td>'.$row['text'].'</td>');
          $foundOverall = 1;
          $type = $row['text'];
          $rand2 = rand(0,99);
       }

       if ($type == 'Wandering Monster') {
         $randmon = rand(0,99);
         if ($randmon >= 0 && $randmon <= 50 && $foundmon == 0) {
           echo ('<td>');
           echo ('Medium group of challenging monsters');
           echo('</td><td>-</td></tr>');
           $foundmon = 1;
           $text1 = 'Medium group of challenging monsters';
       }
      else if ($randmon >= 51 && $randmon <= 89 && $foundmon == 0) {
        echo ('<td>');
         echo ('Small group of formidable monsters');
         echo('</td><td>-</td></tr>');
         $foundmon = 1;
         $text1 = 'Small group of formidable monsters';
     }
     else if ($randmon >= 90 && $randmon <= 99 && $foundmon == 0) {
       echo ('<td>');
       echo ('Single elite monster');
       echo('</td><td>-</td></tr>');
       $foundmon = 1;
       $text1 = 'Single elite monster';
     }
  }
}
     $typeedit = "SELECT * FROM `encounters` ORDER BY num";
     $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
     while($row =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
       if ($type == 'NPC' && $rand2 <= $row['num'] && $found2 == 0 && $row['type'] == 'npc') {
         echo ('<td>');

         echo $row['text'];
         echo('</td><td>-</td></tr>');
         $found2 = 1;
         $text1 = $row['text'];
       }
       if ($type == 'Animal Herd' && $rand2 <= $row['num'] && $found2 == 0 && $row['type'] == 'animalherd') {
         echo ('<td>');

         echo $row['text'];
         echo('</td><td>-</td></tr>');
         $found2 = 1;
         $text1 = $row['text'];
       }
       if ($type == 'Past Event' && $rand2 <= $row['num'] && $found2 == 0 && $row['type'] == 'pastevent') {
         echo ('<td>');

         echo $row['text'];
         echo('</td><td>-</td></tr>');
         $found2 = 1;
         $text1 = $row['text'];
       }
       if ($type == 'Current Event' && $rand2 <= $row['num'] && $found2 == 0 && $row['type'] == 'currentevent') {
         echo ('<td>');

         echo $row['text'];
         echo('</td>');
         $found2 = 1;
         $text1 = $row['text'];

         if ($rand2 >= 0 && $rand2 <= 9) {
           $rand3 = rand(0,99);
           $found3 = 0;
           $typeedit = "SELECT * FROM `encounters` ORDER BY num";
           $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
           while($row =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
             if ($rand3 <= $row['num'] && $found3 == 0 && $row['type'] == 'animalattack') {
               echo ('<td>');
               echo $rand3;
               echo $row['text'];
               $found3 = 1;
               echo('</td></tr>');
               $text2 = $row['text'];
             }

           }

       }


       else if ($rand2 >= 20 && $rand2 <= 29) {
         $rand3 = rand(0,99);
         $found3 = 0;
         $typeedit = "SELECT * FROM `encounters` ORDER BY num";
         $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
         while($row =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
       if ($rand3 <= $row['num'] && $found3 == 0 && $row['type'] == 'monsterattack') {
         echo ('<td>');
         echo $rand3;
         echo $row['text'];
         $found3 = 1;
         echo('</td></tr>');
         $text2 = $row['text'];
       }
     }
   }
   else {
     echo('</td><td>-</td></tr>');
   }
}
       if ($type == 'Lost Item' && $rand2 <= $row['num'] && $found2 == 0 && $row['type'] == 'lostitem') {
         echo ('<td>');

         echo $row['text'];
         $found2 = 1;
         $text1 = $row['text'];
         echo('</td><td>-</td></tr>');
       }
       if ($type == 'Remarkable Event' && $rand2 <= $row['num'] && $found2 == 0 && $row['type'] == 'remarkableevent') {
         echo ('<td>');

         echo $row['text'];
         $found2 = 1;
         $text1 = $row['text'];
         echo('</td><td>-</td></tr>');
       }
     }

     $sql = "INSERT INTO savedencounters(type,text1,text2)
     				VALUES('$type','$text1','$text2')";

            if ($dbcon->query($sql) === TRUE) { ?>

              <script>
                        window.location.href = '/tools/campaign-log/campaign-log.php';
              </script>
            <?php
            }
            else {
                echo "Error: " . $sql . "<br>" . $dbcon->error;
            }

}

    ?>
</tbody>
</table>
    <script>
    $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('#generator tfoot th').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" class="form-control" placeholder="Search '+title+'" />' );
        } );

        // DataTable
        var table = $('#generator').DataTable(
              "bSort": false
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

   <?php
   //Footer
   $footpath = $_SERVER['DOCUMENT_ROOT'];
   $footpath .= "/footer.php";
   include_once($footpath);
    ?>
