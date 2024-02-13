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
     <style>
     th, td { white-space: nowrap; }
     </style>
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
                   <th scope="col">AC</th>
                   <th scope="col">HP</th>
                   <th scope="col">Speed</th>
                   <th scope="col">STR</th>
                   <th scope="col">DEX</th>
                   <th scope="col">CON</th>
                   <th scope="col">INT</th>
                   <th scope="col">WIS</th>
                   <th scope="col">CHA</th>
                   <th scope="col">Saves</th>
                   <th scope="col">Resistences</th>
                   <th scope="col">Vulnerabilities</th>
                   <th scope="col">Immunities</th>
                   <th scope="col">Condition Immunities</th>
                   <th scope="col">Senses</th>
                   <th scope="col">Passive Perception</th>
                   <th scope="col">Languages</th>
                   <th scope="col">Trait1</th>
                   <th scope="col">Trait2</th>
                   <th scope="col">Trait3</th>
                   <th scope="col">Trait4</th>
                   <th scope="col">Trait5</th>
                   <th scope="col">Trait6</th>
                   <th scope="col">Trait7</th>
                   <th scope="col">Trait8</th>
                   <th scope="col">Action1</th>
                   <th scope="col">Action2</th>
                   <th scope="col">Action3</th>
                   <th scope="col">Action4</th>
                   <th scope="col">Action5</th>
                   <th scope="col">Action6</th>
                   <th scope="col">Action7</th>
                   <th scope="col">Action8</th>
                   <th scope="col">Legendary1</th>
                   <th scope="col">Legendary2</th>
                   <th scope="col">Legendary3</th>
                   <th scope="col">Legendary4</th>
                   <th scope="col">Legendary5</th>
                   <th scope="col">Legendary6</th>
                   <th scope="col">Legendary7</th>
                   <th scope="col">Legendary8</th>
                   <th scope="col">Reaction</th>

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
                 <th scope="col">AC</th>
                 <th scope="col">HP</th>
                 <th scope="col">Speed</th>
                 <th scope="col">STR</th>
                 <th scope="col">DEX</th>
                 <th scope="col">CON</th>
                 <th scope="col">INT</th>
                 <th scope="col">WIS</th>
                 <th scope="col">CHA</th>
                 <th scope="col">Saves</th>
                 <th scope="col">Resistences</th>
                 <th scope="col">Vulnerabilities</th>
                 <th scope="col">Immunities</th>
                 <th scope="col">Condition Immunities</th>
                 <th scope="col">Senses</th>
                 <th scope="col">Passive Perception</th>
                 <th scope="col">Languages</th>
                 <th scope="col">Trait1</th>
                 <th scope="col">Trait2</th>
                 <th scope="col">Trait3</th>
                 <th scope="col">Trait4</th>
                 <th scope="col">Trait5</th>
                 <th scope="col">Trait6</th>
                 <th scope="col">Trait7</th>
                 <th scope="col">Trait8</th>
                 <th scope="col">Action1</th>
                 <th scope="col">Action2</th>
                 <th scope="col">Action3</th>
                 <th scope="col">Action4</th>
                 <th scope="col">Action5</th>
                 <th scope="col">Action6</th>
                 <th scope="col">Action7</th>
                 <th scope="col">Action8</th>
                 <th scope="col">Legendary1</th>
                 <th scope="col">Legendary2</th>
                 <th scope="col">Legendary3</th>
                 <th scope="col">Legendary4</th>
                 <th scope="col">Legendary5</th>
                 <th scope="col">Legendary6</th>
                 <th scope="col">Legendary7</th>
                 <th scope="col">Legendary8</th>
                 <th scope="col">Reaction</th>
               </tr>
           </tfoot>
           <tbody>
             <?php
               $sqlcompendium = "SELECT * FROM compendium WHERE type LIKE 'monster'";
               $compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
               while($row = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
                 $jpgurl = 'bestiary/'.$row['title'].'.jpg';
                 $pngurl = 'bestiary/'.$row['title'].'.png';
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
               else {
                 echo ('<td>n/a</td>');
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
             echo ('<td>'.$row['monsterAc'].'</td>');
             echo ('<td>'.$row['monsterHp'].'</td>');
             echo ('<td>'.$row['monsterSpeed'].'</td>');
             echo ('<td>'.$row['monsterStr'].'</td>');
             echo ('<td>'.$row['monsterDex'].'</td>');
             echo ('<td>'.$row['monsterCon'].'</td>');
             echo ('<td>'.$row['monsterInt'].'</td>');
             echo ('<td>'.$row['monsterWis'].'</td>');
             echo ('<td>'.$row['monsterCha'].'</td>');
             echo ('<td>'.$row['monsterSave'].'</td>');
             echo ('<td>'.$row['monsterResist'].'</td>');
             echo ('<td>'.$row['monsterVulnerable'].'</td>');
             echo ('<td>'.$row['monsterImmune'].'</td>');
             echo ('<td>'.$row['monsterConditionImmune'].'</td>');
             echo ('<td>'.$row['monsterSenses'].'</td>');
             echo ('<td>'.$row['monsterPassive'].'</td>');
             echo ('<td>'.$row['monsterLanguages'].'</td>');
             echo ('<td>'.$row['monsterTrait1'].'</td>');
             echo ('<td>'.$row['monsterTrait2'].'</td>');
             echo ('<td>'.$row['monsterTrait3'].'</td>');
             echo ('<td>'.$row['monsterTrait4'].'</td>');
             echo ('<td>'.$row['monsterTrait5'].'</td>');
             echo ('<td>'.$row['monsterTrait6'].'</td>');
             echo ('<td>'.$row['monsterTrait7'].'</td>');
             echo ('<td>'.$row['monsterTrait8'].'</td>');
             echo ('<td>'.$row['monsterAction1'].'</td>');
             echo ('<td>'.$row['monsterAction2'].'</td>');
             echo ('<td>'.$row['monsterAction3'].'</td>');
             echo ('<td>'.$row['monsterAction4'].'</td>');
             echo ('<td>'.$row['monsterAction5'].'</td>');
             echo ('<td>'.$row['monsterAction6'].'</td>');
             echo ('<td>'.$row['monsterAction7'].'</td>');
             echo ('<td>'.$row['monsterAction8'].'</td>');
             echo ('<td>'.$row['monsterLegendary1'].'</td>');
             echo ('<td>'.$row['monsterLegendary2'].'</td>');
             echo ('<td>'.$row['monsterLegendary3'].'</td>');
             echo ('<td>'.$row['monsterLegendary4'].'</td>');
             echo ('<td>'.$row['monsterLegendary5'].'</td>');
             echo ('<td>'.$row['monsterLegendary6'].'</td>');
             echo ('<td>'.$row['monsterLegendary7'].'</td>');
             echo ('<td>'.$row['monsterLegendary8'].'</td>');
             echo ('<td>'.$row['monsterReaction'].'</td>');

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
    var table = $('#allspells').DataTable(
      {
         "scrollX": true,
         "responsive": false
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
